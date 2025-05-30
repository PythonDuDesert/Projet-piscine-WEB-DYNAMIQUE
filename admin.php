<?php
    session_start();

    //Connexion à la base 
    $database = "agora francia";
    $db_handle = mysqli_connect('localhost', 'root', '');
    $db_found = mysqli_select_db($db_handle, $database);
    $admin = [];

    $message = "";

    if (!isset($_SESSION['admin_id'])) {
    // Si la session est vide, redirection
    header("Location: compte.php");
    exit;
    }

    if ($db_found) {
        $id = $_SESSION['admin_id'];
        $sql = "SELECT * FROM admin WHERE ID = $id";
        $resultat = mysqli_query($db_handle, $sql);

        if ($resultat && mysqli_num_rows($resultat) > 0) {
            $admin = mysqli_fetch_assoc($resultat);
        } else {
            // Si l'utilisateur n'existe plus en BDD
            session_unset();
            session_destroy();
            header("Location: compte.php");
            exit;
        }
    } else {
        $message = "Erreur de connexion à la base de données";
        exit;
    }

    
    //Déconnection 
    if (isset($_GET['action'])) {
        session_unset();
        session_destroy();
        header("Location: compte.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agora Francia - Compte</title>
    <link rel="shortcut icon" href="images/logo_no_bg.ico" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script>
     $(document).ready(function() {
        setTimeout(function() {
            $(".message").fadeOut("slow");
        }, 2000); //Fondu de 2 secondes
    });
    </script>
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
        <h1>Bienvenue, <?= ($admin['Prenom']) ?> !</h1>
    
       
        <div class="onglet">
            <button class="bouton" data-tab="infos">Vos informations personnelles</button>
            <button class="bouton" data-tab="clients"> Mettre à jour la fiche client </button>
            <button class="bouton" data-tab="articles">Mettre à jour les articles </button>
        </div>

        <div id="infos" class="contenu active">
            <h2>Informations personnelles</h2>
            <p><strong>Nom :</strong> <?= ($admin['Nom']) ?></p>
            <p><strong>Prénom :</strong> <?= ($admin['Prenom']) ?></p>
            <p><strong>Email :</strong> <?= ($admin['Email']) ?></p>
        </div>

        <div id="clients" class="contenu">
            <h2>Mettre à jour la fiche client </h2>
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
                    <button type="submit" class="button_compte" id="connexion" value="Ajouter"name ="Ajouter">Ajouter</button>
                    <button type="submit" class="button_compte" id="connexion" value="Supprimer"name ="Supprimer">Supprimer</button>
                </div>
            </form>
        </div>

        <div id="articles" class="contenu">
            <h2>Mettre à jour les articles </h2>
            <form action="" method="post" enctype="multipart/form-data">
                <table class="table_inscription" border="1">
                    <tr>
                        <td>Nom de l'article</td>
                        <td><input type="text" name="nom_article"></td>
                    </tr>
                    <tr>
                        <td>Catégorie</td>
                        <td> 
                            <select name="categorie">
                                <option value="">-- Sélectionnez la rareté de l'article --</option>
                                <option value="Commun">Commun</option>
                                <option value="Rare">Rare</option>
                                <option value="Premium">Premium</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Prix d'achat immédiat</td>
                        <td><input type="number" name="achat_immediat"></td>
                    </tr>
                    <tr>
                        <td>Prix d'enchère</td>
                        <td><input type="number" name="achat_enchere"></td>
                    </tr>
                    <tr>
                        <td>Prix de négociation</td>
                        <td><input type="number" name="achat_negociation"></td>
                    </tr>
                    <tr>
                        <td>Date de fin d'enchère</td>
                        <td><input type="datetime-local" name="fin_enchere"></td>
                    </tr>
                    <tr>
                        <td>Description</td>
                        <td><input type="text" name="description"></td>
                    </tr>
                    <tr>
                        <td>Quantité en Stock</td>
                        <td><input type="number" name="stock"></td>
                    </tr>
                    <tr>
                        <td>Photo</td>
                        <td><input type="FILE" name="photo"></td>
                    </tr>
                </table>
                <button type="submit" class="button_compte" id="connexion" value="Ajouter"name ="Ajouter">Ajouter</button>
                <button type="submit" class="button_compte" id="connexion" value="Supprimer"name ="Supprimer">Supprimer</button>
            </form>
        </div>

        <br>
        <form method="get" action="admin.php" style="display:inline;">
            <input type="hidden" name="action">
            <button type="submit" class="nav_button" style="background-color: red; color: white;">Se déconnecter</button>
        </form>

   
        <script>
            const boutons = document.querySelectorAll(".bouton");
            const contenus = document.querySelectorAll(".contenu");

            boutons.forEach(tab => {
                tab.addEventListener("click", () => {
                    contenus.forEach(c => c.classList.remove("active"));
                    document.getElementById(tab.dataset.tab).classList.add("active");
                });
            });
        </script>
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
