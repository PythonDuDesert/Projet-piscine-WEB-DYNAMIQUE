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

if ($db_found) {
    if ($action == "Inscription") {
        if ($motdepasse != $confirmemdp) {
            echo "<p>Les mots de passe ne correspondent pas.</p>";
        } else {
            // Vérifier si l'utilisateur existe déjà
            $sql = "SELECT * FROM acheteurs_vendeurs WHERE Email = '$email' OR Pseudo = '$pseudo'";
            $resultat = mysqli_query($db_handle, $sql);

            if (mysqli_num_rows($resultat) > 0) {
                echo "<p>Un utilisateur avec cet email ou ce pseudo existe déjà.</p>";
            } else {
                // Insérer le nouvel utilisateur
                $sql = "INSERT INTO acheteurs_vendeurs (
                    Nom, Prenom, DateNaissance, Email, Telephone, CodePostal, Adresse,
                    Pseudo, MotDePasse, Photo, DateInscription, Solde, TypeCarte, NumeroCarte
                ) VALUES (
                    '$nom', '$prenom', '$date_naissance', '$email', '$telephone', '$code_postal', '$adresse',
                    '$pseudo', '$motdepasse', '$photo', CURDATE(), '$solde', '$type_carte', '$num_carte'
                )";

                if (mysqli_query($db_handle, $sql)) {
                    echo "<p>Inscription réussie ! Bienvenue $pseudo ! </p>";
                } else {
                    echo "<p>L'inscription a échoué</p>";
                }
            }
        }
    }
} else {
    echo "<p>Erreur de connexion à la base de données</p>";
}
mysqli_close($db_handle);
?>
