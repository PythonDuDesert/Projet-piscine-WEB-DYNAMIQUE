<?php
    session_start();

    //Si l'utilisateur est déja connecté redirige vers la page profil.php
    if (isset($_SESSION['user_id'])) {
        header("Location: profil.php");
        exit;
    }
    //Connexion à la base
    $database = "agora francia";
    $db_handle = mysqli_connect('localhost', 'root', '');
    $db_found = mysqli_select_db($db_handle, $database);

    // Récupération des données du formulaire d'inscription
    $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : '';
    $nom = isset($_POST['nom']) ? $_POST['nom'] : '';
    $pseudo = isset($_POST['pseudo']) ? $_POST['pseudo'] : '';
    $email = isset($_POST['email2']) ? $_POST['email2'] : '';
    $telephone = isset($_POST['telephone']) ? $_POST['telephone'] : '';
    $date_naissance = isset($_POST['date_naissance']) ? $_POST['date_naissance'] : '';
    $code_postal = isset($_POST['code_postal']) ? $_POST['code_postal'] : '';
    $adresse = isset($_POST['adresse']) ? $_POST['adresse'] : '';
    $motdepasse = isset($_POST['password2']) ? $_POST['password2'] : '';
    $confirmemdp = isset($_POST['password2confirm']) ? $_POST['password2confirm'] : '';
   
    $photo = $_FILES['photo']['name'] ?? '';
    $photo_temp = $_FILES['photo']['tmp_name'] ?? '';
    $destination = "images/" . basename($photo);

    // Récupération des données du formulaire de connexion
    $email_con = isset($_POST['email1']) ? $_POST['email1'] : '';
    $mdp_con = isset($_POST['password1']) ? $_POST['password1'] : '';
    
   
    $action = "";
    if (isset($_POST['Inscription'])) $action = "Inscription";
    if (isset($_POST['Connexion'])) $action = "Connexion";

    $message = "";

/** ------------------------------    INSCRIPTION  -------------------------------**/
    if ($db_found) {
        if ($action == "Inscription") {
            if (empty($prenom) || empty($nom) || empty($pseudo) || empty($email) || empty($telephone) || empty($date_naissance) || empty($code_postal) || empty($adresse) || empty($motdepasse)) {
                    $message = "Veuillez remplir tous les champs obligatoires";
            }
            elseif ($motdepasse !== $confirmemdp) {
            $message = "Les mots de passe ne correspondent pas";
            }

            else {
                // Vérifier si l'utilisateur existe déjà
                $sql = "SELECT * FROM acheteurs_vendeurs WHERE Email = '$email' OR Pseudo = '$pseudo'";
                $resultat = mysqli_query($db_handle, $sql);

                if (mysqli_num_rows($resultat) > 0) {
                    $message = "Un utilisateur avec cet email ou ce pseudo existe déjà";
                } else {
                     move_uploaded_file($photo_temp, $destination);
                    // Insérer le nouvel utilisateur
                    $sql = "INSERT INTO acheteurs_vendeurs (Nom, Prenom, DateNaissance, Email, Telephone, CodePostal, Adresse, Pseudo, MotDePasse, Photo, DateInscription) VALUES ('$nom', '$prenom', '$date_naissance', '$email', '$telephone', '$code_postal', '$adresse','$pseudo', '$motdepasse', '$destination', CURDATE())";
                    if (mysqli_query($db_handle, $sql)) {
                        $message = "Inscription réussie ! Bienvenue $pseudo !";
                    } else {
                        $message = "L'inscription a échoué";
                    }
                }
            }
        }
    } else {
        $message = "Erreur de connexion à la base de données";
    }

/** ------------------------------    CONNEXION  -------------------------------**/
    if ($action == "Connexion") {
        
        if ($db_found){
            if (empty($email_con) || empty($mdp_con)){
            $message = "Veuillez remplir tous les champs";
            }
            $sql = "SELECT * FROM acheteurs_vendeurs WHERE Email = '$email_con'";
            $resultat = mysqli_query($db_handle, $sql);

            if ($resultat && mysqli_num_rows($resultat) > 0) {
                $user = mysqli_fetch_assoc($resultat);
                if ($user['MotDePasse'] === $mdp_con) { 
                    $_SESSION['user_id'] = $user['ID'];
                   header("Location: profil.php");
                   exit;
                } else {
                    $message = "Mot de passe incorrect";
                }
            } else {
                $message = "Utilisateur introuvable";
            }
        } 
}
    mysqli_close($db_handle);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agora Francia - Compte</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="images/logo_no_bg.ico" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script>
    $(document).ready(function() {
        setTimeout(function() {
            $(".message").fadeOut("slow");
        }, 2000); //Fondu de 2 secondes
    });
    </script>
    <script src="compte.js"></script>
</head>

<body>
    <header>
        <h1>Agora Francia</h1>
        <a href="accueil.php"><img src="images/logo_no_bg.png" alt="logo" id="logo"></a>
    </header>

    <nav>
        <a href="accueil.php"><button type="button" class="nav_button" id="acceuil">Accueil<img src="images/accueil.png" class="nav_icone"></button></a>
        <a href="parcourir.php"><button type="button" class="nav_button" id="parcourir">Tout Parcourir<img src="images/livre_ouvert.png" class="nav_icone"></button></a>
        <a href="notifications.php"><button type="button" class="nav_button" id="notifs">Notifications<img src="images/notification.png" class="nav_icone"></button></a>
        <a href="panier.php"><button type="button" class="nav_button" id="panier">Panier<img src="images/paniers.png" class="nav_icone"></button></a>
        <a href="compte.php"><button type="button" class="nav_button" id="compte" style="background-color: #392eff;">Votre compte<img src="images/utilisateur.png" class="nav_icone"></button></a>
    </nav>

    <section>
        <div id="overlay"></div>

        <div class="message"><?= ($message) ?></div>
     
        <div id="container_compte">
            <div class="option_compte" id="se_connecter">Se connecter</div>
            <div class="option_compte" id="sinscrire">S'inscrire</div>
        </div>

        <div id="container_connexion">
            <form action="" method="post">
                <table class="table_inscription" border="1">
                    <tr>
                        <td>Email</td>
                        <td><input type="text" name="email1" required></td>
                    </tr>
                    <tr>
                        <td>Mot de passe</td>
                        <td><input type="password" name="password1" required></td>
                    </tr>
                </table>
                <div class="buttons_bar">
                    <button type="button" class="button_compte retour">Retour</button>
                    <button type="submit" class="button_compte" id="connexion" name ="Connexion">Connexion</button>
                </div>
            </form>
            <div class="container_blur" id="container_blur1"></div>
        </div>

     

        <div id="container_inscription"> 
            <form action="" method="post" enctype="multipart/form-data">
                <table class="table_inscription" border="1">
                    <tr>
                        <td>Prénom</td>
                        <td><input type="text" name="prenom" ></td>
                    </tr>
                    <tr>
                        <td>Nom</td>
                        <td><input type="text" name="nom"></td>
                    </tr>
                    <tr>
                        <td>Pseudo</td>
                        <td><input type="text" name="pseudo"></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><input type="email" name="email2"></td>
                    </tr>
                    <tr>
                        <td>Numéro de téléphone</td>
                        <td><input type="tel" name="telephone"></td>
                    </tr>
                    <tr>
                        <td>Date de Naissance</td>
                        <td><input type="date" name="date_naissance"></td>
                    </tr>
                    <tr>
                        <td>Code postal</td>
                        <td><input type="text" name="code_postal"></td>
                    </tr>
                    <tr>
                        <td>Adresse</td>
                        <td><input type="text" name="adresse"></td>
                    </tr>
                    <tr>
                        <td>Photo</td>
                        <td><input type="FILE" name="photo"></td>
                    </tr>
                    <tr>
                        <td>Mot de passe</td>
                        <td><input type="password" name="password2"></td>
                    </tr>
                    <tr>
                        <td>Confirmer Mot de passe</td>
                        <td><input type="password" name="password2confirm"></td>
                    </tr> <br>
                </table>
                <div class="buttons_bar">
                    <button type="button" class="button_compte retour">Retour</button>
                    <button type="submit" class="button_compte" id="inscription" value="Inscription" name="Inscription">S'inscrire</button>
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