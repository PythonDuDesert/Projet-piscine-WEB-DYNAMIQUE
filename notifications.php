<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agora Francia - Notifications</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="images/logo_no_bg.ico" type="image/x-icon">
</head>
<body>
    <header>
        <h1>Agora Francia</h1>
        <a href="accueil.php"><img src="images/logo_no_bg.png" alt="logo" id="logo"></a>
    </header>

    <nav>
        <a href="accueil.php"><button type="button" class="nav_button" id="acceuil">Accueil<img src="images/accueil.png" class="nav_icone"></button></a>
        <a href="parcourir.php"><button type="button" class="nav_button" id="parcourir">Tout Parcourir<img src="images/livre_ouvert.png" class="nav_icone"></button></a>
        <a href="notifications.php"><button type="button" class="nav_button" id="notifs" style="background-color: #392eff;">Notifications<img src="images/notification.png" class="nav_icone"></button></a>
        <a href="panier.php"><button type="button" class="nav_button" id="panier">Panier<img src="images/paniers.png" class="nav_icone"></button></a>
        <a href="compte.php"><button type="button" class="nav_button" id="compte">Votre compte<img src="images/utilisateur.png" class="nav_icone"></button></a>
    </nav>

    <section>
        <div id="overlay"></div>

        <div id="container_inscription"> 
            <form action="" method="post">
                <table class="table_inscription" border="1">
                    <tr>
                        <td>Catégorie d'article</td>
                        <td>
                            <select name="type_article" required>
                                <option value="">-- Sélectionnez un type d'article --</option>
                                <option value="1">Commun</option>
                                <option value="2">Rare</option>
                                <option value="3">Premium</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Prix</td>
                        <td>
                            <select name="tranche_prix" required>
                                <option value="">-- Sélectionnez une tranche de prix --</option>
                                <option value="1">0 à 50</option>
                                <option value="2">50 à 100</option>
                                <option value="3">100 à 500</option>
                                <option value="4">500 et plus</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Fin des enchères</td>
                        <td><input type="date" name="date_fin_encheres"></td>
                    </tr>
                </table>
                <div class="buttons_bar">
                    <a href="notifications.php"><button type="submit" class="nav_button" id="alerte" value="Alerte" name="alerte">Activer l'alerte<img src="images/alerte.png" class="nav_icone"></button></a>
                </div>
            </form>
            <div class="container_blur" id="container_blur2"></div>
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