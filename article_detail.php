<?php
    session_start();

    $database = "agora francia";
    $db_handle = mysqli_connect('localhost', 'root', '');
    $db_found = mysqli_select_db($db_handle, $database);
    $id_article = isset($_GET['id']) ? $_GET['id'] : 1;

    /* Affichage articles similaires */
    if ($db_found) {
        $sql = "SELECT * FROM articles WHERE ID = $id_article";
        $result = mysqli_query($db_handle, $sql);
        $data = mysqli_fetch_assoc($result);

        date_default_timezone_set('Europe/Paris');
        $now = new DateTime(); // Date et heure actuelles
        $end = new DateTime($data['DateFinEnchere']); // Date de fin des enchères
        $time_valid = false;
        if ($now < $end) {
            $time_valid = true;
        } else {
            $time_valid = false;
        }

        $search = mysqli_real_escape_string($db_handle, $data['NomArticle']);
        if (!empty($search)) {
            $sql2 = "SELECT * FROM articles WHERE (NomArticle LIKE '%$search%' OR Categorie = '$data[Categorie]') AND ID != $id_article LIMIT 6";
            $result2 = mysqli_query($db_handle, $sql2);
        }
    }
    else {
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
</head>

<body>
    <header>
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

        <div id="container_article_detail">
            <div class="article">
                <img src="<?= htmlspecialchars($data['Image']) ?>" alt="<?= htmlspecialchars($data['NomArticle']) ?>" class="article_img img_detail">
                <div class="article_description">
                    <h2><?= htmlspecialchars($data['NomArticle']) ?></h2>
                    <p>Description : <?= htmlspecialchars($data['Description']) ?></p>
                    <p>ID : <?= htmlspecialchars($data['ID']) ?></p>
                    <p>Catégorie : <?= htmlspecialchars($data['Categorie']) ?></p>
                    <p>
                        Prix d'enchère : <?= htmlspecialchars($data['PrixEnchere']) ?> €
                        <br>Fin des enchères : <?= htmlspecialchars($data['DateFinEnchere']) ?>
                        <br>Prix d'achat immédiat : <?= htmlspecialchars($data['PrixAchatImmediat']) ?> €
                        <br>Prix en négociation : <?= htmlspecialchars($data['PrixNegociation']) ?> €
                        <br>Date d'ajout : <?= htmlspecialchars($data['DateAjout']) ?>
                        <br>Quantité en stock : <?= htmlspecialchars($data['QuantiteStock']) ?> / Quantité vendue : <?= htmlspecialchars($data['QuantiteVendue']) ?>
                    </p>
                    <div class="container_option_achat">
                        <form action="achat.php?id=<?= $data['ID'] ?>" method="post" class="container_option_achat">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($data['ID']) ?>">
                            <?php if ($time_valid === true): ?>
                                <button type="submit" name="encherir" class="option_achat" id="encherir">
                                    Enchérir<img src="images/encheres.png" class="achat_icone">
                                </button>
                            <?php endif; ?>
                        </form>

                        <form action="achat.php?id=<?= $data['ID'] ?>" method="post" class="container_option_achat">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($data['ID']) ?>">
                            <button type="submit" name="negocier" class="option_achat" id="negocier">
                                Negocier <img src="images/accord.png" class="achat_icone">
                            </button>                            
                        </form>

                        <form action="parcourir.php" method="post">
                            <input type="hidden" name="ajouter_panier" value="<?= htmlspecialchars($data['ID']) ?>">
                            <button type="submit" class="option_achat" id="ajouter_panier">
                                Ajouter au panier <img src="images/ajouter-au-panier.png" class="achat_icone">
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div id="container_articles_similaires">
            <?php
            while ($data2 = mysqli_fetch_assoc($result2)) {
                echo
                "<div class='articles_similaires'>
                    <a href='article_detail.php?id=" . $data2['ID'] . "'><img src='" . $data2['Image'] . "' alt='" . $data2['NomArticle'] . "' class='article_img_similaire'></a>
                    <div class='article_description'>
                        <h2><a href='article_detail.php?id=" . $data2['ID'] . "' class='title_article'>" . $data2['NomArticle'] . "</a></h2>
                        <p>Catégorie : " . $data2['Categorie'] . "</p>
                        <p>Prix d'enchère : " . $data2['PrixEnchere'] . " €
                        <br>Fin des enchères : " . $data2['DateFinEnchere'] . "
                        <br>Prix d'achat immédiat : " . $data2['PrixAchatImmediat'] . " €
                        <br>Prix en négociation : " . $data2['PrixNegociation'] . " €
                        </p>
                    </div>
                </div>";
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