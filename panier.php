<?php
    session_start();

    $database = "agora francia";
    $db_handle = mysqli_connect('localhost', 'root', '');
    $db_found = mysqli_select_db($db_handle, $database);

    if ($db_found) {
        if (isset($_POST['payer'])) {
            $userID = $_SESSION['user_id'];
            $sql_solde_debt = "SELECT PrixAchat FROM commandes WHERE ID_acheteur = $userID AND Type_achat = '1'";
            $result_solde_debt = mysqli_query($db_handle, $sql_solde_debt);
            $solde_debt = 0;
            while ($data = mysqli_fetch_assoc($result_solde_debt)) {
                $solde_debt += $data['PrixAchat'];
            }
            $sql_solde_debt = "UPDATE acheteurs_vendeurs SET Solde = Solde - '$solde_debt'";
            $result_solde_debt = mysqli_query($db_handle, $sql_solde_debt);

            $sql = "UPDATE commandes SET Payement_effectue = '1' WHERE ID_acheteur = $userID AND Type_achat = '1'";
            $result = mysqli_query($db_handle, $sql);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agora Francia - Panier</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="images/logo_no_bg.ico" type="image/x-icon">
    <style>
        #container_payer {
            display: flex;
            justify-content: center;
            margin: 20px auto 40px auto;
        }
        
        #payer {
            padding: 20px 70px;
            background-color: #194f08;
            color: white;
            border-radius: 20px;
            font-size: x-large;
            font-weight: 700;
            cursor: pointer;
        }

        #payer:hover {
            background-color: #154002;
        }

        #payer:active {
            transform: translateY(2px);
        }

    </style>
</head>
<body>
    <header>
        <a href="accueil.php"><img src="images/logo_no_bg.png" alt="logo" id="logo"></a>
    </header>

    <nav>
        <a href="accueil.php"><button type="button" class="nav_button" id="acceuil">Accueil<img src="images/accueil.png" class="nav_icone"></button></a>
        <a href="parcourir.php"><button type="button" class="nav_button" id="parcourir">Tout Parcourir<img src="images/livre_ouvert.png" class="nav_icone"></button></a>
        <a href="notifications.php"><button type="button" class="nav_button" id="notifs">Notifications<img src="images/notification.png" class="nav_icone"></button></a>
        <a href="panier.php"><button type="button" class="nav_button" id="panier" style="background-color: #392eff;">Panier<img src="images/paniers.png" class="nav_icone"></button></a>
        <a href="compte.php"><button type="button" class="nav_button" id="compte">Votre compte<img src="images/utilisateur.png" class="nav_icone"></button></a>
    </nav>

    <section>
        <div id="overlay"></div>
        <h2>Votre panier</h2>

        <?php
            if (!isset($_SESSION['user_id'])) {
                echo "<p>Veuillez vous connecter pour accéder à votre panier.</p>";
            } else {
                //connexion base de données
                $db_handle = mysqli_connect("localhost", "root", "", "agora francia");
                if (!$db_handle) {
                    echo "Erreur de connexion à la base de données.";
                    exit();
                }

                $userID = $_SESSION['user_id'];

                //on récupere les commandes de l'utilisateur dont le paiement n'a pas été effectué
                $sql = "SELECT a.* FROM articles a 
                        JOIN commandes c ON a.ID = c.ID_article 
                        WHERE c.ID_acheteur = $userID AND c.Payement_effectue = 0";
                $result = mysqli_query($db_handle, $sql);

                if (mysqli_num_rows($result) == 0) {
                    echo "<p>Votre panier est vide.</p>";
                } else {
                    $sql_solde_debt = "SELECT PrixAchat FROM commandes WHERE ID_acheteur = $userID AND Type_achat = '1' AND Payement_effectue = '0'";
                    $result_solde_debt = mysqli_query($db_handle, $sql_solde_debt);
                    $solde_debt = 0;
                    while ($data = mysqli_fetch_assoc($result_solde_debt)) {
                        $solde_debt += $data['PrixAchat'];
                    }
                    echo "<div id='container_payer'>
                            <form action='panier.php' method='post'>
                                <button type='submit' id='payer' name='payer'>PAYER ".$solde_debt." €</button>
                            </form>
                        </div>";
                    echo "<div id='container_shop'>";
                    while ($data = mysqli_fetch_assoc($result)) {
                        echo "<div class='article'>
                                <a href='article_detail.php?id=".$data['ID']."'>
                                    <img src='".$data['Image']."' alt='".$data['NomArticle']."' class='article_img'>
                                </a>
                                <div class='article_description'>
                                    <h2>
                                        <a href='article_detail.php?id=".$data['ID']."' class='title_article'>".$data['NomArticle']."</a>
                                    </h2>
                                    <p>Catégorie : ".$data['Categorie']."</p>
                                    <p>
                                        Prix d'enchère : ".$data['PrixEnchere']." €";
                                        if ($data['TypeAchat'] = '2') {echo " VOTRE CHOIX EN COURS";};
                                        echo "<br>
                                        Fin des enchères : ".$data['DateFinEnchere']."<br>
                                        Prix d'achat immédiat : ".$data['PrixAchatImmediat']." €<br>
                                        Prix en négociation : ".$data['PrixNegociation']." €
                                    </p>
                                </div>
                            </div>";
                    }
                    echo "</div>";
                }

                mysqli_close($db_handle);
            }
        ?>
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