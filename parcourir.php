<?php
session_start();

$database = "agora francia";
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);
$i = isset($_GET['i']) ? $_GET['i'] : 0;  // offset

if ($db_found) {
    $sql = "SELECT * FROM articles WHERE 1";
    $search = isset($_GET['search']) ? trim($_GET['search']) : '';
    $categorie = isset($_GET['categorie']) ? trim($_GET['categorie']) : '';
    date_default_timezone_set('Europe/Paris');

    if (!empty($search)) {
        $search = mysqli_real_escape_string($db_handle, $search);
        $sql .= " AND (NomArticle LIKE '%$search%')";
    }

    if (isset($_GET['min_price']) && is_numeric($_GET['min_price'])) {
        $min = floatval($_GET['min_price']);
        $sql .= " AND PrixAchatImmediat >= $min";
    }

    if (isset($_GET['max_price']) && is_numeric($_GET['max_price'])) {
        $max = floatval($_GET['max_price']);
        $sql .= " AND PrixAchatImmediat <= $max";
    }

    if (isset($_GET['quantite']) && is_numeric($_GET['quantite'])) {
        $quantite = intval($_GET['quantite']);
        $sql .= " AND QuantiteStock >= $quantite";
    }

    if (in_array($categorie, ['commun', 'rare', 'premium'])) {
        $categorie = mysqli_real_escape_string($db_handle, $_GET['categorie']);
        $sql .= " AND Categorie = '$categorie'";
    }

    if (empty($search) && !in_array($categorie, ['commun', 'rare', 'premium']) && !isset($_GET['min_price']) && !isset($_GET['max_price']) && !isset($_GET['QuantiteStock'])) {  // Si pas de recherche/filtre appliqué, on fait une pagination
        $sql = "SELECT * FROM articles LIMIT 10 OFFSET $i";
    }

    $result = mysqli_query($db_handle, $sql);
    if ($result) {
        $error = false;
    }
} else {
    echo "<p>Erreur de connexion à la base de données</p>";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agora Francia - Parcourir</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="images/logo_no_bg.ico" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="parcourir.js"></script>
    <script>
        $(document).ready(function() {
            $('#toggle_filters').click(function() {
                $('#filters_form').toggle();
            });
        });
    </script>
</head>

<body>
    <header>
        <h1>Agora Francia</h1>
        <a href="accueil.php"><img src="images/logo_no_bg.png" alt="logo" id="logo"></a>
    </header>

    <nav>
        <a href="accueil.php"><button type="button" class="nav_button" id="acceuil">Accueil<img src="images/accueil.png" class="nav_icone"></button></a>
        <a href="parcourir.php"><button type="button" class="nav_button" id="parcourir" style="background-color: #392eff;">Tout Parcourir<img src="images/livre_ouvert.png" class="nav_icone"></button></a>
        <a href="notifications.php"><button type="button" class="nav_button" id="notifs">Notifications<img src="images/notification.png" class="nav_icone"></button></a>
        <a href="panier.php"><button type="button" class="nav_button" id="panier">Panier<img src="images/paniers.png" class="nav_icone"></button></a>
        <a href="compte.php"><button type="button" class="nav_button" id="compte">Votre compte<img src="images/utilisateur.png" class="nav_icone"></button></a>
    </nav>

    <section>
        <div id="overlay"></div>

        <div id="search_menu"></div>

        <form method="GET" action="parcourir.php" id="search_form">
            <input type="text" name="search" placeholder="Rechercher un article..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
            <button type="submit">Rechercher</button>
            <button type="button" id="toggle_filters">Filtrer</button>

            <div id="filters_form" style="display: none; margin-top: 10px;">
                <!--permet aussi de garder en memeoire les données du formulaire du filtre (mais ne marche pas quand on change de page... bref à finir) -->

                <label for="min_price">Prix min :</label>
                <input type="number" name="min_price" id="min_price" min="0" value="<?php echo isset($_GET['min_price']) ? $_GET['min_price'] : ''; ?>">

                <label for="max_price">Prix max :</label>
                <input type="number" name="max_price" id="max_price" min="0" value="<?php echo isset($_GET['max_price']) ? $_GET['max_price'] : ''; ?>">

                <label for="quantite">Quantité min :</label>
                <input type="number" name="quantite" id="quantite" min="1" value="<?php echo isset($_GET['QuantiteStock']) ? $_GET['QuantiteStock'] : ''; ?>">

                <label for="categorie">Catégorie :</label>
                <select name="categorie" id="categorie">
                    <option value="">Toutes</option>
                    <option value="commun" <?php if (isset($_GET['categorie']) && $_GET['categorie'] == "commun") echo "selected"; ?>>Commun</option>
                    <option value="rare" <?php if (isset($_GET['categorie']) && $_GET['categorie'] == "rare") echo "selected"; ?>>Rare</option>
                    <option value="premium" <?php if (isset($_GET['categorie']) && $_GET['categorie'] == "premium") echo "selected"; ?>>Premium</option>
                </select>

                <br>
                <button type="submit" style="margin-top: 10px;">Valider les filtres</button>
            </div>
        </form>

        <div id="container_shop">
            <?php while ($data = mysqli_fetch_assoc($result)):
                $now = new DateTime(); // Date et heure actuelles
                $end = new DateTime($data['DateFinEnchere']); // Date de fin des enchères
                $time_valid = false;
                if ($now < $end) {
                    $time_valid = true;
                } else {
                    $time_valid = false;
                }
            ?>
                <div class="article">
                    <a href="article_detail.php?id=<?= urlencode($data['ID']) ?>">
                        <img src="<?= htmlspecialchars($data['Image']) ?>" alt="<?= htmlspecialchars($data['NomArticle']) ?>" class="article_img">
                    </a>
                    <div class="article_description">
                        <h2>
                            <a href="article_detail.php?id=<?= urlencode($data['ID']) ?>" class="title_article">
                                <?= htmlspecialchars($data['NomArticle']) ?>
                            </a>
                        </h2>
                        <p>Catégorie : <?= htmlspecialchars($data['Categorie']) ?></p>
                        <p>
                            Prix d'enchère : <?= htmlspecialchars($data['PrixEnchere']) ?> €
                            <br>Fin des enchères : <?= htmlspecialchars($data['DateFinEnchere']) ?>
                            <br>Prix d'achat immédiat : <?= htmlspecialchars($data['PrixAchatImmediat']) ?> €
                            <br>Prix en négociation : <?= htmlspecialchars($data['PrixNegociation']) ?> €
                        </p>
                        <form action="achat.php?id=<?= urlencode($data['ID']) ?>" method="post" class="container_option_achat">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($data['ID']) ?>">

                            <?php if ($time_valid === true): ?>
                                <button type="submit" name="encherir" class="option_achat" id="encherir">
                                    Enchérir<img src="images/encheres.png" class="achat_icone">
                                </button>
                            <?php endif; ?>

                            <button type="submit" name="negocier" class="option_achat" id="negocier">
                                Negocier <img src="images/accord.png" class="achat_icone">
                            </button>

                            <button type="submit" name="ajouter_panier" class="option_achat" id="ajouter_panier">
                                Ajouter au panier<img src="images/ajouter-au-panier.png" class="achat_icone">
                            </button>
                        </form>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

        <div id="page_navigation">
            <?php
            $sql_count = "SELECT COUNT(*) FROM articles";
            $result = mysqli_query($db_handle, $sql_count);
            $row = mysqli_fetch_array($result);
            $total_articles = $row[0];
            $last_i = (intval($total_articles / 10) * 10) + 1;

            $next_i = $i + 10;
            $prev_i = 0;
            if ($i >= 10) {
                $prev_i = $i - 10;
            }

            if (empty($search) && !in_array($categorie, ['commun', 'rare', 'premium'])) {
                echo "<a href='parcourir.php?i=$prev_i'><button type='button' class='button_navigation' id='previous_page'>Page précédente</button></a>
                        <a href='parcourir.php?i=$next_i'><button type='button' class='button_navigation' id='next_page'>Page suivante</button></a>";
            }
            ?>

        </div>
    </section>

    <footer>
        <h2>Contactez Agora Francia</h2>
        <p>Email : <a href="mailto:contact@agorafrancia.fr">contact@agorafrancia.fr</a></p>
        <p>Téléphone : <a href="tel:+33123456789">+33 1 23 45 67 89</a></p>
        <p>Adresse : 10 Rue Sextius Michel, 75015 Paris, France</p>
        <img src="images/location.png" alt="map_location" id="map_location">
        <br>
        <p>&copy; 2025 Agora Francia. Tous droits réservés.</p>
    </footer>
</body>

</html>