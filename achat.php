<?php
session_start();

$database = "agora francia";
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);
$id_article = null;
if (isset($_POST['valider_enchere']) && isset($_POST['id'])) {
    $id_article = intval($_POST['id']);
} else if (isset($_GET['id'])) {
    $id_article = intval($_GET['id']);
}
if ($id_article === null) {
    die("ID article manquant.");
}

/* Actions d'achats */
$action = "";
if (isset($_POST['encherir'])) {
    $action = "encherir";
} else if (isset($_POST['negocier'])) {
    $action = "negocier";
}

if ($db_found) {
    /* article */
    $sql = "SELECT * FROM articles WHERE ID = $id_article";
    $result = mysqli_query($db_handle, $sql);
    $data = mysqli_fetch_assoc($result);

    /* acheteur */
    $id_acheteur = isset($_SESSION['user_id']) ? intval($_SESSION['user_id']) : 0;
    if ($id_acheteur === 0) {
        header("Location: compte.php"); // Rediriger vers la page de connexion
        exit();
    }
    $sql_acheteur = "SELECT * FROM acheteurs_vendeurs WHERE ID = $id_acheteur";
    $result_acheteur = mysqli_query($db_handle, $sql_acheteur);
    $data_acheteur = mysqli_fetch_assoc($result_acheteur);

    if ($action == "encherir") {
        $now = new DateTime(); // Date et heure actuelles
        $end = new DateTime($data['DateFinEnchere']); // Date de fin des enchères
        if ($now < $end) {
            $time_valid = true;
        } else {
            $time_valid = false;
        }
    }

    if (isset($_POST['valider_enchere'])) {
        if (isset($_POST['slider_enchere'])) {
            $new_price = $_POST['slider_enchere'];
            $sql_new_price = "UPDATE articles SET PrixEnchere = $new_price WHERE ID = $id_article";
            $result_new_price = mysqli_query($db_handle, $sql_new_price);
            header("Location: achat.php?id=".$id_article.""); // refresh de la page
            exit();
        }
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

        .container_enchere div { /* Votre nouvelle enchère : prix */
            margin: 10px 0;
            font-size: large;
            color: #333;
        }

        .container_enchere input[type="range"] { /* slider */
            margin-top: -10px;
            width: 400px;
        }

        .container_enchere input[type="submit"] { /* bouton Enchérir */
            background-color: #392eff;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: large;
            padding: 10px 200px;
            cursor: pointer;
        }
    </style>
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
        <h2 style="margin-bottom: 50px;"><u>Enchères de cet article :</u></h2>
        <div id="overlay"></div>

        <div id="container_article_detail">
            <?php
            echo
            "<div class='article'>
                    <img src='".$data['Image']."' alt='".$data['NomArticle']."' class='article_img img_detail'>
                    <div class='article_description'>
                        <h2>".$data['NomArticle']."</h2>
                        <p>Description : ".$data['Description']."</p>
                        <p>Catégorie : ".$data['Categorie']."</p>
                        <p>Prix d'enchère : ".$data['PrixEnchere']." €
                        <br>Fin des enchères : ".$data['DateFinEnchere']."
                        <br>Prix d'achat immédiat : ".$data['PrixAchatImmediat']." €
                        <br>Prix en négociation : ".$data['PrixNegociation']." €
                        <br>Date d'ajout : ".$data['DateAjout']."
                        <br>Quantité en stock : ".$data['QuantiteStock']." / Quantité vendue : ".$data['QuantiteVendue']."
                        </p>
                    </div>
                </div>";
            ?>
        </div>

        <div class="container_enchere">
            <form action='achat.php' method='post' class="container_enchere">
                <input type="hidden" name="id" value="<?php echo $id_article; ?>">

                <input type="range" name="slider_enchere" min="<?php echo $data['PrixEnchere'] + 1; ?>" max="<?php echo $data_acheteur['Solde']; ?>" value="<?php echo $data['PrixEnchere'] + 1; ?>" oninput="document.getElementById('currentValue').textContent = this.value">

                <div>Votre nouvelle enchère: <strong><span id="currentValue"><?php echo $data['PrixEnchere'] + 1; ?>€</span></strong></div>
                <input type="submit" value="Enchérir" name="valider_enchere" class='option_achat'>
            </form>
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