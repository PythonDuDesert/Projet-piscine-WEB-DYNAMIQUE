<?php
    session_start();

    $database = "agora francia";
    $db_handle = mysqli_connect('localhost', 'root', '');
    $db_found = mysqli_select_db($db_handle, $database);
    $id_article = null;
    if ((isset($_POST['valider_enchere']) && isset($_POST['id'])) || (isset($_POST['valider_negociation']) && isset($_POST['id']))) {
        $id_article = intval($_POST['id']);
    } else if (isset($_GET['id'])) {
        $id_article = intval($_GET['id']);
    }

    /* Actions d'achats */
    $action = "";
    if (isset($_POST['encherir'])) {
        $action = "encherir";
    } else if (isset($_POST['negocier'])) {
        $action = "negocier";
    } else if (isset($_GET['action'])) {
        $action = $_GET['action'];
    }

    if ($db_found) {
        /* article */
        $sql = "SELECT * FROM articles WHERE ID = $id_article";
        $result = mysqli_query($db_handle, $sql);
        $data = mysqli_fetch_assoc($result);
        $time_valid = false;

        /* acheteur */
        $id_acheteur = isset($_SESSION['user_id']) ? intval($_SESSION['user_id']) : 0;
        if ($id_acheteur === 0) {
            header("Location: compte.php"); // Rediriger vers la page de connexion
            exit();
        }
        $sql_acheteur = "SELECT * FROM acheteurs_vendeurs WHERE ID = $id_acheteur";
        $result_acheteur = mysqli_query($db_handle, $sql_acheteur);
        $data_acheteur = mysqli_fetch_assoc($result_acheteur);

        $sql_historique_commandes = "SELECT PrixAchat FROM commandes WHERE ID_acheteur = $id_acheteur AND ID_article != $id_article";
        $result_historique_commandes = mysqli_query($db_handle, $sql_historique_commandes);
        $solde_temp = 0;
        while ($data_historique_commandes = mysqli_fetch_assoc($result_historique_commandes)) {
            $solde_temp += $data_historique_commandes['PrixAchat'];
        }

        /* action */
        if (isset($_POST['valider_enchere'])) {
            if (isset($_POST['slider_enchere'])) {
                $new_price = $_POST['slider_enchere'];
                $sql_new_price = "UPDATE articles SET PrixEnchere = $new_price WHERE ID = $id_article";
                $result_new_price = mysqli_query($db_handle, $sql_new_price);

                $sql_commande = "SELECT * FROM commandes WHERE ID_article = $id_article AND ID_acheteur = $id_acheteur";
                $result_commande = mysqli_query($db_handle, $sql_commande);
                if (mysqli_num_rows($result_commande) > 0) {
                    $sql_commande = "UPDATE commandes SET PrixAchat = '$new_price' WHERE ID_article = $id_article AND ID_acheteur = $id_acheteur";
                    $result_commande = mysqli_query($db_handle, $sql_commande);
                } else {
                    $sql_type_carte = "SELECT TypeCarte FROM acheteurs_vendeurs WHERE ID = $id_acheteur";
                    $resultat_type_carte = mysqli_query($db_handle, $sql_type_carte);
                    $type_carte = '';
                    if (mysqli_num_rows($resultat_type_carte) > 0) {
                        $row = mysqli_fetch_assoc($resultat_type_carte);
                        $type_carte = $row['TypeCarte'];
                    }
                    
                    date_default_timezone_set('Europe/Paris');
                    $now = new DateTime(); // Date et heure actuelles
                    $now_str = $now->format('Y-m-d H:i:s'); // Pour le SQL
                    $sql_commande = "INSERT INTO commandes (ID_article, DateAchat, PrixAchat, MoyenPayement, ID_acheteur, Type_achat, Payement_effectue) VALUES ('$id_article','$now_str','$new_price','$type_carte','$id_acheteur','2','0')";
                    $result_commande = mysqli_query($db_handle, $sql_commande);
                    if (!$result_commande) {
                        echo "Erreur SQL : " . mysqli_error($db_handle);
                    }
                }

                header("Location: achat.php?id=".$id_article."&action=encherir"); // refresh de la page
                exit();
            }
        }

        if (!isset($_SESSION['tentatives_negociation'])) {
            $_SESSION['tentatives_negociation'] = [];
        }
        
        if (isset($_POST['valider_negociation'])) {
            $tentatives = $_SESSION['tentatives_negociation'][$id_article] ?? 0;
        
            if ($tentatives >= 5) {
                echo "<script>alert('Vous avez atteint le nombre maximal de 5 tentatives de négociation pour cet article.'); window.location.href='achat.php?id=$id_article';</script>";
                exit();
            }
        
            $offre = intval($_POST['offre']);
            $categorie = $data['Categorie'];
        
            $acceptation = false;
            $contre_offre = $offre;
        
            switch (strtolower($categorie)) {
                case 'commun':
                    $proba_acceptation = rand(1, 100);
                    if ($proba_acceptation <= 50) {
                        $acceptation = true;
                    } else {
                        $contre_offre += rand(10, 30);
                        if ($contre_offre > $data['PrixAchatImmediat']) {
                            $contre_offre = $data['PrixAchatImmediat'];
                        }
                    }
                    break;
                case 'rare':
                    $proba_acceptation = rand(1, 100);
                    if ($proba_acceptation <= 40) {
                        $acceptation = true;
                    } else {
                        $contre_offre += rand(50, 100);
                        if ($contre_offre > $data['PrixAchatImmediat']) {
                            $contre_offre = $data['PrixAchatImmediat'];
                        }
                    }
                    break;
                case 'premium':
                    $proba_acceptation = rand(1, 100);
                    if ($proba_acceptation <= 25) {
                        $acceptation = true;
                    } else {
                        $contre_offre += rand(400, 600);
                        if ($contre_offre > $data['PrixAchatImmediat']) {
                            $contre_offre = $data['PrixAchatImmediat'];
                        }
                    }
                    break;
                default:
                    $acceptation = true;
                    break;
            }
        
            if ($acceptation) {
                unset($_SESSION['tentatives_negociation'][$id_article]);
        
                $sql_type_carte = "SELECT TypeCarte FROM acheteurs_vendeurs WHERE ID = $id_acheteur";
                $resultat_type_carte = mysqli_query($db_handle, $sql_type_carte);
                $type_carte = '';
                if (mysqli_num_rows($resultat_type_carte) > 0) {
                    $row = mysqli_fetch_assoc($resultat_type_carte);
                    $type_carte = $row['TypeCarte'];
                }

                date_default_timezone_set('Europe/Paris');
                $now = new DateTime(); // Date et heure actuelles
                $now_str = $now->format('Y-m-d H:i:s'); // Pour le SQL
                $sql_commande = "INSERT INTO commandes (ID_article, DateAchat, PrixAchat, MoyenPayement, ID_acheteur, Type_achat, Payement_effectue) VALUES ('$id_article','$now_str','$new_price','$type_carte','$id_acheteur','3','0')";
                $result_commande = mysqli_query($db_handle, $sql_commande);
                if (!$result_commande) {
                    echo "Erreur SQL : " . mysqli_error($db_handle);
                }
                $sql_new_solde = "UPDATE acheteurs_vendeurs SET Solde = Solde-'$new_price'";
                $result_new_solde = mysqli_query($db_handle, $sql_new_solde);
                echo "<script>alert('Félicitations ! Le vendeur a accepté votre offre de $offre €'); window.location.href='achat.php?id=$id_article';</script>";
                exit();
            }
            else {
                // Incrémenter compteur
                $_SESSION['tentatives_negociation'][$id_article] = $tentatives + 1;
                echo "<script>alert('Le vendeur a refusé votre offre. Il vous propose un nouveau prix de $contre_offre €'); window.location.href='achat.php?id=$id_article&contre_offre=$contre_offre';</script>";
                $sql_commande = "INSERT INTO commandes (ID_article, DateAchat, PrixAchat, MoyenPayement, ID_acheteur, Type_achat, Payement_effectue) VALUES ('$id_article', '$now_str', '$contre_offre', '$type_carte', '$id_acheteur', '3', '0')";
                $result_commande = mysqli_query($db_handle, $sql_commande);
                if (!$result_commande) {
                    echo "Erreur SQL : " . mysqli_error($db_handle);
                }
            }
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
    <title>Agora Francia - Achat</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="images/logo_no_bg.ico" type="image/x-icon">
    <style>
        .container_enchere {
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #f4f4fc;
            width: fit-content;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 1px 12px rgba(0, 0, 0, 0.25);
            margin: 20px auto;
        }

        .container_enchere div {
            /* Votre nouvelle enchère : prix */
            margin: 10px 0;
            font-size: large;
            color: #333;
        }

        .container_enchere input[type="range"] {
            /* slider */
            margin-top: -10px;
            width: 400px;
        }

        .container_enchere input[type="submit"] {
            /* bouton Enchérir */
            background-color: #392eff;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: large;
            padding: 10px 200px;
            cursor: pointer;
        }

        .container_negociation {
            display: flex;
            align-items: center;
            background-color: #f4f4fc;
            width: fit-content;
            padding: 30px 10px 20px 10px;
            border-radius: 12px;
            margin: 20px auto;
        }

        .container_negociation input[type="number"] {
            width: 200px;
        }

        .container_negociation input[type="submit"] {
            background-color: #392eff;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: large;
            padding: 10px 100px;
            cursor: pointer;
        }
    </style>
    <script>

    </script>
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
        <h2 style="margin-bottom: 50px;"><u>Enchères de cet article :</u></h2>
        <div id="overlay"></div>

        <div id="container_article_detail">
            <?php
            echo
            "<div class='article'>
                <img src='" . $data['Image'] . "' alt='" . $data['NomArticle'] . "' class='article_img img_detail'>
                <div class='article_description'>
                    <h2>" . $data['NomArticle'] . "</h2>
                    <p>Description : " . $data['Description'] . "</p>
                    <p>Catégorie : " . $data['Categorie'] . "</p>
                    <p>Prix d'enchère : " . $data['PrixEnchere'] . " €
                    <br>Fin des enchères : " . $data['DateFinEnchere'] . "
                    <br>Prix d'achat immédiat : " . $data['PrixAchatImmediat'] . " €
                    <br>Prix en négociation : " . $data['PrixNegociation'] . " €
                    <br>Date d'ajout : " . $data['DateAjout'] . "
                    <br>Quantité en stock : " . $data['QuantiteStock'] . " / Quantité vendue : " . $data['QuantiteVendue'] . "
                    </p>
                </div>
            </div>";
            ?>
        </div>

        <?php if ($action == "encherir"): ?>
            <!-- Formulaire d'enchère -->
            <div class="container_enchere">
                <form action='achat.php' method='post' class="container_enchere">
                    <input type="hidden" name="id" value="<?php echo $id_article; ?>">

                    <input type="range" name="slider_enchere" min="<?php echo $data['PrixEnchere'] + 1; ?>" max="<?php echo $data_acheteur['Solde'] - $solde_temp; ?>" value="<?php echo $data['PrixEnchere'] + 1; ?>" oninput="document.getElementById('currentValue').textContent = this.value">

                    <div>Votre nouvelle enchère: <strong><span id="currentValue"><?php echo $data['PrixEnchere'] + 1; ?>€</span></strong></div>
                    <input type="submit" value="Enchérir" name="valider_enchere" class='option_achat'>
                </form>
            </div>
        <?php elseif ($action == "negocier"): ?>
            <!-- Formulaire de négociation -->
            <div class="container_negociation">
                <form action='achat.php' method='post'>
                    <input type="hidden" name="id" value="<?php echo $id_article; ?>">
                    <label for="offre">Proposez un prix :</label>
                    <?php  $offre_auto = isset($_GET['contre_offre']) ? intval($_GET['contre_offre']) : ''; ?>
                    <input type="number" name="offre" min="1" max="<?php echo $data_acheteur['Solde'] - $solde_temp; ?>" required value="<?php echo $offre_auto; ?>">
                    <input type="submit" value="Proposer un prix" name="valider_negociation">
                </form>
            </div>
        <?php endif; ?>
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