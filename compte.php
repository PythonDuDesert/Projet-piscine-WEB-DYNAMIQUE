<?php
    $database = "agora francia";
    $db_handle = mysqli_connect('localhost', 'root', '');
    $db_found = mysqli_select_db($db_handle, $database);

    // Récupération des données du formulaire
    $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : '';
    $nom = isset($_POST['nom']) ? $_POST['nom'] : '';
    $pseudo = isset($_POST['pseudo']) ? $_POST['pseudo'] : '';
    $email = isset($_POST['email2']) ? $_POST['email2'] : '';
    $telephone = isset($_POST['telephone']) ? $_POST['telephone'] : '';
    $date_naissance = isset($_POST['date_naissance']) ? $_POST['date_naissance'] : '';
    $code_postal = isset($_POST['code_postal']) ? $_POST['code_postal'] : '';
    $adresse = isset($_POST['adresse']) ? $_POST['adresse'] : '';
    $photo = isset($_POST['photo']) ? $_POST['photo'] : '';
    $motdepasse = isset($_POST['password2']) ? $_POST['password2'] : '';
    $confirmemdp = isset($_POST['password2confirm']) ? $_POST['password2confirm'] : '';
    $solde = isset($_POST['solde']) ? $_POST['solde'] : 0;
    $type_carte = isset($_POST['type_carte']) ? $_POST['type_carte'] : '';
    $num_carte = isset($_POST['num_carte']) ? $_POST['num_carte'] : '';

    $action = "";
    if (isset($_POST['Inscription'])) $action = "Inscription";

    $message = "";

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
                    // Insérer le nouvel utilisateur
                    $sql = "INSERT INTO acheteurs_vendeurs (Nom, Prenom, DateNaissance, Email, Telephone, CodePostal, Adresse, Pseudo, MotDePasse, Photo, DateInscription, Solde, TypeCarte, NumeroCarte) VALUES ('$nom', '$prenom', '$date_naissance', '$email', '$telephone', '$code_postal', '$adresse','$pseudo', '$motdepasse', '$photo', CURDATE(), '$solde', '$type_carte', '$num_carte'
                    )";
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js">
    </script>
    <script>
    $(document).ready(function() {
        setTimeout(function() {
            $(".message").fadeOut("slow");
        }, 2000); //2 secondes
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
        <a href="notifications.html"><button type="button" class="nav_button" id="notifs">Notifications<img src="images/notification.png" class="nav_icone"></button></a>
        <a href="panier.html"><button type="button" class="nav_button" id="panier">Panier<img src="images/paniers.png" class="nav_icone"></button></a>
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
            <form action="mon_compte.php" method="post">
                <table class="table_inscription" border="1">
                    <tr>
                        <td>Email</td>
                        <td><input type="text" name="email1"></td>
                    </tr>
                    <tr>
                        <td>Mot de passe</td>
                        <td><input type="password" name="password1"></td>
                    </tr>
                </table>
            </form>
            <div class="buttons_bar">
                <button type="button" class="button_compte retour">Retour</button>
                <button type="submit" class="button_compte" id="connexion">Connexion</button>
            </div>
            <div class="container_blur" id="container_blur1"></div>
        </div>

     

        <div id="container_inscription"> 
            <form action="" method="post">
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
                        <td><input type="text" name="photo"></td>
                    </tr>
                    <tr>
                        <td>Mot de passe</td>
                        <td><input type="password" name="password2"></td>
                    </tr>
                    <tr>
                        <td>Confirmer Mot de passe</td>
                        <td><input type="password" name="password2confirm"></td>
                    </tr> <br>
                    <tr>
                        <td>Type de carte</td>
                        <td>
                            <select name="type_carte" required>
                                <option value="">-- Sélectionnez un type de carte --</option>
                                <option value="1">Visa</option>
                                <option value="2">MasterCard</option>
                                <option value="3">American Express</option>
                                <option value="4">PayPal</option>
                            </select>
                        </td>
                    </tr>
                     <tr>
                        <td>Numéro de carte</td>
                        <td><input type="password" name="num_carte"></td>
                    </tr>
                     <tr>
                        <td>Solde</td>
                        <td><input type="number" name="solde"></td>
                    </tr>
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