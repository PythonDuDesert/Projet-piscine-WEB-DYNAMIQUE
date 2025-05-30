<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agora Francia - Accueil</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="images/logo_no_bg.ico" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="accueil_carrousel.js"></script>
</head>
<body>
    <header>
        <h1>Agora Francia</h1>
        <a href="accueil.php"><img src="images/logo_no_bg.png" alt="logo" id="logo"></a>
    </header>

    <nav>
        <a href="accueil.php"><button type="button" class="nav_button" id="acceuil" style="background-color: #392eff;">Accueil<img src="images/accueil.png" class="nav_icone"></button></a>
        <a href="parcourir.php"><button type="button" class="nav_button" id="parcourir">Tout Parcourir<img src="images/livre_ouvert.png" class="nav_icone"></button></a>
        <a href="notifications.php"><button type="button" class="nav_button" id="notifs">Notifications<img src="images/notification.png" class="nav_icone"></button></a>
        <a href="panier.php"><button type="button" class="nav_button" id="panier">Panier<img src="images/paniers.png" class="nav_icone"></button></a>
        <a href="compte.php"><button type="button" class="nav_button" id="compte">Votre compte<img src="images/utilisateur.png" class="nav_icone"></button></a>
    </nav>

    <section>
        <div id="overlay"></div>

        <p id="description"><strong><i>Agora Francia</i></strong> est une place de marché en ligne inspirée de l'agora grecque antique, un lieu d'échanges, de discussions et de commerce. Ouvert à tous, notre site offre une expérience de magasinage moderne, accessible et interactive pour le grand public.
        <br>Achetez, vendez, négociez ou proposez votre meilleure offre sur une large sélection d'articles neufs, d'occasion ou uniques, grâce à nos trois modes de vente (vente immédiate, négociation, meilleure offre).
        </p>
        
        <br>
        <div id="carrousel"> 
            <h2>Sélection du jour</h2>
            <?php include 'carrousel_articles.php'; ?>
            <p id="nom_article"></p>
            <p id="prix_article"></p>
        </div>
        <div id="carrousel_nav">
            <button type="button" id="previous"><</button>
            <button type="button" id="next">></button>
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