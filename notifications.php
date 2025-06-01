<?php
    session_start();

    $database = "agora francia";
    $db_handle = mysqli_connect('localhost', 'root', '');
    $db_found = mysqli_select_db($db_handle, $database);
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
            <h2>Activer l'alerte selon vos critères !</h2>
            <form action="" method="post">
                <table class="table_inscription" border="1">
                    <tr>
                        <td>Catégorie d'article</td>
                        <td>
                            <select name="categorie" required>
                                <option value="">-- Sélectionnez un type d'article --</option>
                                <option value="Commun">Commun</option>
                                <option value="Rare">Rare</option>
                                <option value="Premium">Premium</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Prix</td>
                        <td>
                            <select name="prix" required>
                                <option value="">-- Sélectionnez une tranche de prix --</option>
                                <option value="0 à 50">0 à 50</option>
                                <option value="50 à 100">50 à 100</option>
                                <option value="100 à 500">100 à 500</option>
                                <option value="500 et plus">500 et plus</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Fin des enchères</td>
                        <td><input type="date" name="fin_encheres"></td>
                    </tr>
                    <tr>
                        <td>Quantité en stock</td>
                        <td><select name="stock" required>
                                <option value="">-- Sélectionnez une quantité --</option>
                                <option value="0 à 15">0 à 5</option>
                                <option value="6 à 10">6 à 10</option>
                                <option value="11 à 20">11 à 20</option>
                                <option value="20 et plus">20 et plus</option>
                        </select></td>
                    </tr>
                </table>
                <br><br>
                <div class="buttons_bar">
                    <button type="submit" class="nav_button" id="alerte" name="alerte">Activer l'alerte<img src="images/alerte.png" class="nav_icone"></button>
                </div>
            </form>
            <div class="container_blur" id="container_blur2"></div>
        </div>
        <div id="container_formulaire">
            <?php
                if(isset($_POST["alerte"])) {
                    if ($db_found){
                        $id_utilisateur = $_SESSION['user_id'];
                        $categorie = $_POST["categorie"];
                        $prix = $_POST["prix"];
                        $fin_encheres = $_POST["fin_encheres"];
                        $stock = $_POST["stock"];

                         

                        $sql = "INSERT INTO alertes_utilisateur (id_utilisateur, categorie, prix, fin_encheres, quantite) VALUES ('$id_utilisateur','$categorie', '$prix', '$fin_encheres', '$stock')";

                        $result = mysqli_query($db_handle, $sql); 

                        if ($result) {
                            echo "<h2>Vous avez activé l'alerte !</h2><br>";

                            $sql = "SELECT * FROM alertes_utilisateur WHERE categorie='$categorie' AND prix='$prix' AND fin_encheres='$fin_encheres' AND quantite='$stock'";
                            $result = mysqli_query($db_handle, $sql);

                            echo "<table border='1'>";
                            echo "<tr><th>Categorie</th><th>Prix</th><th>Date fin enchères</th><th>Quantité en stock</th></tr>";
                            while ($data = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $data['categorie'] . "</td>";
                                echo "<td>" . $data['prix'] . "</td>";
                                echo "<td>" . $data['fin_encheres'] . "</td>";
                                echo "<td>" . $data['quantite'] . "</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                            echo "Vous recevrez une notification sur votre compte Agora Francia si un article correspond à vos critères.";
                        }
                    }
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