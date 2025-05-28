<?php
    $database = "agora_francia";
    $db_handle = mysqli_connect('localhost', 'root', '');
    $db_found = mysqli_select_db($db_handle, $database);

    if ($db_found) {
        $sql = "SELECT * FROM articles";
        if (isset($_GET['search']) && !empty(trim($_GET['search']))) {
            $search = mysqli_real_escape_string($db_handle, $_GET['search']);
            $sql .= " WHERE NomArticle LIKE '%$search%' OR Description LIKE '%$search%'";
        }
        $result= mysqli_query($db_handle, $sql);
        if ($result) {
            $error = false;
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
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<body>
    <header>
        <h1>Agora Francia</h1>
        <a href="accueil.php"><img src="images/logo_no_bg.png" alt="logo" id="logo"></a>
    </header>

    <nav>
        <a href="accueil.php"><button type="button" class="nav_button" id="acceuil">Accueil<img src="images/accueil.png" class="nav_icone"></button></a>
        <a href="parcourir.php"><button type="button" class="nav_button" id="parcourir" style="background-color: #392eff;">Tout Parcourir<img src="images/livre_ouvert.png" class="nav_icone"></button></a>
        <a href="notifications.html"><button type="button" class="nav_button" id="notifs">Notifications<img src="images/notification.png" class="nav_icone"></button></a>
        <a href="panier.html"><button type="button" class="nav_button" id="panier">Panier<img src="images/paniers.png" class="nav_icone"></button></a>
        <a href="compte.php"><button type="button" class="nav_button" id="compte">Votre compte<img src="images/utilisateur.png" class="nav_icone"></button></a>
    </nav>

    <section>
        <div id="overlay"></div>

        <div id="search_menu"></div>

        <form method="GET" action="parcourir.php" id="search_form">
            <input type="text" name="search" placeholder="Rechercher un article..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
            <button type="submit">Rechercher</button>
        </form>

        <div id="container_shop">
            <?php
                while ($data = mysqli_fetch_assoc($result)) {
                    echo 
                    "<div class='article'>
                        <img src='".$data['Image']."' alt='".$data['Image']."' class='article_img'>
                        <div class='article_description'>
                            <h2>".$data['NomArticle']."</h2
                            <p>Prix d'enchère: ".$data['PrixEnchere']." €
                            <br>Fin des enchères: ".$data['DateFinEnchere']."
                            <br>Prix d'achat immédiat: ".$data['PrixAchatImmediat']." €
                            <br>Prix en négociation: ".$data['PrixNegociation']." €
                            </p>
                            <div class='container_option_achat'>
                                <button type='button' class='option_achat'>Encherir<img src='images/encheres.png' class='achat_icone'></button>
                                <button type='button' class='option_achat'>Acheter maintenant<img src='images/ajouter-au-panier.png' class='achat_icone'></button>
                                <button type='button' class='option_achat'>Négocier<img src='images/accord.png' class='achat_icone'></button>
                            </div>
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