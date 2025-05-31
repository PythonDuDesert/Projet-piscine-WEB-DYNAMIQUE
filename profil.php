<?php
    session_start();

    //Connexion à la base 
    $database = "agora francia";
    $db_handle = mysqli_connect('localhost', 'root', '');
    $db_found = mysqli_select_db($db_handle, $database);
    $user = [];

    $message = "";

    if (!isset($_SESSION['user_id'])) {
    // Si la session est vide, redirection
    header("Location: compte.php");
    exit;
    }

    if ($db_found) {
        $id = $_SESSION['user_id'];
        $sql = "SELECT * FROM acheteurs_vendeurs WHERE ID = $id";
        $resultat = mysqli_query($db_handle, $sql);

        if ($resultat && mysqli_num_rows($resultat) > 0) {
            $user = mysqli_fetch_assoc($resultat);
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

    if ($db_found){
        $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : '';
        $nom = isset($_POST['nom']) ? $_POST['nom'] : '';
        $telephone = isset($_POST['telephone']) ? $_POST['telephone'] : '';
        $date_naissance = isset($_POST['date_naissance']) ? $_POST['date_naissance'] : '';
        $code_postal = isset($_POST['code_postal']) ? $_POST['code_postal'] : '';
        $adresse = isset($_POST['adresse']) ? $_POST['adresse'] : '';
        $motdepasse = isset($_POST['password']) ? $_POST['password'] : '';
        $user_id = $_SESSION['user_id'];

        if (isset($_POST['ModifierInfos'])) {
            if ($prenom && $nom && $telephone && $adresse && $code_postal && $date_naissance&& $motdepasse ) {
                $sql_update = "UPDATE acheteurs_vendeurs SET 
                    Nom = '$nom',
                    Prenom = '$prenom',
                    MotDePasse = '$motdepasse',
                    Telephone = '$telephone',
                    Adresse = '$adresse',
                    CodePostal = '$code_postal',
                    DateNaissance = '$date_naissance'
                    WHERE ID = $user_id";
            
                if (mysqli_query($db_handle, $sql_update)) {
                    $message = "Vos informations ont été mises à jour.";
                    $sql = "SELECT * FROM acheteurs_vendeurs WHERE ID = $user_id";
                    $resultat = mysqli_query($db_handle, $sql);
                    if ($resultat && mysqli_num_rows($resultat) > 0) {
                        $user = mysqli_fetch_assoc($resultat);
                    }
                    // Redirection pour éviter la resoumission
                    header("Location: profil.php");
                    exit;
                } else {
                    $message = "Erreur lors de la mise à jour.";
                }
            }else {
                $message = "Tous les champs doivent être remplis.";
            }
    }
}

    if (isset($_POST['SupprimerArticle']) && isset($_POST['id_article_supprimer'])) {
        $id_article = intval($_POST['id_article_supprimer']);
        $sql_del = "DELETE FROM articles WHERE ID = $id_article AND IDAcheteurVendeur = $user_id";
        if (mysqli_query($db_handle, $sql_del)) {
            $message = "Article supprimé avec succès.";
            $_POST['AfficherArticles'] = true; // Pour forcer l'affichage de la liste
        } else {
            $message = "Erreur lors de la suppression.";
        }
    }

     /** ------------------------------ AJOUT CARTE ------------------------------- **/
    if ($db_found) {
    $user_id = $_SESSION['user_id'];
    $solde = isset($_POST['solde']) ? $_POST['solde'] : 0;
    $type_carte = isset($_POST['type_carte']) ? $_POST['type_carte'] : '';
    $num_carte = isset($_POST['num_carte']) ? $_POST['num_carte'] : '';
    $message = '';

    if (isset($_POST['Enregistrer'])) {
        if (empty($solde) || empty($type_carte) || empty($num_carte)) {
            $message = "Veuillez remplir tous les champs obligatoires";
        } else {
            // Vérifie si l'utilisateur existe
            $sql = "SELECT * FROM acheteurs_vendeurs WHERE ID = $user_id";
            $resultat = mysqli_query($db_handle, $sql);

            if ($resultat && mysqli_num_rows($resultat) > 0) {
                // Mise à jour des infos bancaires
                $sql_update = "UPDATE acheteurs_vendeurs SET Solde = '$solde', TypeCarte = '$type_carte', NumeroCarte = '$num_carte' WHERE ID = $user_id";

                if (mysqli_query($db_handle, $sql_update)) {
                    $message = "Vos informations bancaires ont bien été enregistrées !";
                } else {
                    $message = "Erreur lors de l'enregistrement";
                }
            } else {
                $message = "Utilisateur introuvable";
            }
        }
    }
    } else {
        $message = "Erreur de connexion à la base de données";
    }


    /** ------------------------------ AJOUT ARTICLE ------------------------------- **/
    if ($db_found && isset($_POST['Vendre'])) {
        $nom_article = isset($_POST['nom_article']) ? $_POST['nom_article'] : '';
        $categorie = isset($_POST['categorie']) ? $_POST['categorie'] : '';
        $achat_immediat = isset($_POST['achat_immediat']) ? $_POST['achat_immediat'] : '';
        $achat_enchere = isset($_POST['achat_enchere']) ? $_POST['achat_enchere'] : '';
        $achat_negociation = isset($_POST['achat_negociation']) ? $_POST['achat_negociation'] : '';
        $fin_enchere = isset($_POST['fin_enchere']) ? $_POST['fin_enchere'] : '';
        $description = isset($_POST['description']) ? $_POST['description'] : '';
        $stock = isset($_POST['stock']) ? $_POST['stock'] : '';

       
        $photo = $_FILES['photo']['name'] ?? '';
        $photo_temp = $_FILES['photo']['tmp_name'] ?? '';
        $destination = "images/articles/" . basename($photo);

        if (
            empty($nom_article) || empty($categorie) || empty($description) ||
            ($achat_immediat == 0 && $achat_enchere == 0 && $achat_negociation == 0 &&$stock == 0)
        ) {
            $message = "Veuillez remplir tous les champs";
        } else {
            move_uploaded_file($photo_temp,"./images/articles/$photo");
            $sql_article = "INSERT INTO articles (
                NomArticle, Categorie, DateAjout, PrixAchatImmediat, PrixEnchere, PrixNegociation,
                DateFinEnchere, Description, QuantiteStock, Image, IDAcheteurVendeur
            ) VALUES (
                '$nom_article', '$categorie', CURDATE(), '$achat_immediat', '$achat_enchere', '$achat_negociation',
                '$fin_enchere', '$description', '$stock', '$destination', '$user_id'
            )";

            if (mysqli_query($db_handle, $sql_article)) {
                $message = "Article ajouté avec succès !";
            } else {
                $message = "Erreur lors de l'ajout de l'article.";
            }
        }
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
        <h1>Bienvenue, <?= ($user['Prenom']) ?> !</h1>
         <p>
                <?php if ($user['Photo']): ?>
                    <img src="<?= htmlspecialchars($user['Photo']) ?>" alt="Photo de profil" width="150">
                <?php endif; ?>
        </p>
       
        <div class="onglet">
            <button class="bouton" data-tab="infos">Vos informations personnelles</button>
            <button class="bouton" data-tab="banque">Informations bancaires</button>
            <button class="bouton" data-tab="articles">Mettre en vente des articles</button>
            <button class="bouton" data-tab="messages">Messages</button>
        </div>

      <div id="infos" class="contenu active">
        <h2>Informations personnelles</h2>

            <?php if (!isset($_GET['edit'])): ?>
                <p><strong>Nom :</strong> <?= htmlspecialchars($user['Nom']) ?></p>
                <p><strong>Prénom :</strong> <?= htmlspecialchars($user['Prenom']) ?></p>
                <p><strong>Email :</strong> <?= htmlspecialchars($user['Email']) ?></p>
                <p><strong>Pseudo :</strong> <?= htmlspecialchars($user['Pseudo']) ?></p>
                <p><strong>Date de naissance :</strong> <?= htmlspecialchars($user['DateNaissance']) ?></p>
                <p><strong>Téléphone :</strong> <?= htmlspecialchars($user['Telephone']) ?></p>
                <p><strong>Adresse :</strong> <?= htmlspecialchars($user['Adresse']) ?></p>
                <p><strong>Code postal :</strong> <?= htmlspecialchars($user['CodePostal']) ?></p>
                <p><strong>Solde :</strong> <?= htmlspecialchars($user['Solde']) ?> €</p>

                <form method="get" action="">
                    <input type="hidden" name="edit" value="1">
                    <button type="submit" class="button_compte">Modifier mes informations</button>
                </form>

            <?php else: ?>
                <form method="post">
                    <table class="table_inscription" border="1">
                        <tr><td>Nom</td><td><input type="text" name="nom" value="<?= htmlspecialchars($user['Nom']) ?>"></td></tr>
                        <tr><td>Prénom</td><td><input type="text" name="prenom" value="<?= htmlspecialchars($user['Prenom']) ?>"></td></tr>
                        <tr><td>Téléphone</td><td><input type="tel" name="telephone" value="<?= htmlspecialchars($user['Telephone']) ?>"></td></tr>
                        <tr><td>Adresse</td><td><input type="text" name="adresse" value="<?= htmlspecialchars($user['Adresse']) ?>"></td></tr>
                        <tr><td>Code postal</td><td><input type="text" name="code_postal" value="<?= htmlspecialchars($user['CodePostal']) ?>"></td></tr>
                        <tr><td>Mot de passe</td><td><input type="text" name="password" value="<?= htmlspecialchars($user['MotDePasse']) ?>"></td></tr>
                        <tr><td>Date de naissance</td><td><input type="date" name="date_naissance" value="<?= htmlspecialchars($user['DateNaissance']) ?>"></td></tr>
                    </table>
                    <button type="submit" class="button_compte" name="ModifierInfos">Enregistrer</button>
                     <a href="profil.php"><button type="button" class="button_compte" style="background-color: grey;">Retour</button></a>
                </form>
            <?php endif; ?>
        </div>


        <div id="banque" class="contenu">
              <h2>Modifier vos informations bancaires</h2>
              <form action="" method="post">
                <table class="table_articles" border="1">
                     <tr>
                        <td>Type de carte</td>
                        <td>
                            <select name="type_carte">
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
                        <td><input type="number" name="num_carte"></td>
                    </tr>
                    <tr>
                        <td>Solde</td>
                        <td><input type="number" name="solde"></td>
                    </tr>
                </table>
                <button type="submit" class="button_compte" id="connexion" name ="Enregistrer">Mettre à jour</button>
            </form>
        </div>

        <div id="articles" class="contenu">
            <h2>Vendre des articles</h2>
            <div id="form_vente">
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
                <button type="submit" class="button_compte" id="connexion" value="Vendre"name ="Vendre">Vendre</button>
            </form>
              <button type="button" class="button_compte" id="btn_afficher_articles" style="margin-top: 10px;">
            Afficher mes articles
            </button>
            </div>
            
            <div id="mes_articles" style="display: none;">
           
            <?php
            // Affichage des articles (sans besoin de bouton intermédiaire)
            $sql_articles = "SELECT * FROM articles WHERE IDAcheteurVendeur = $user_id";
            $res_articles = mysqli_query($db_handle, $sql_articles);

            if ($res_articles && mysqli_num_rows($res_articles) > 0) {
                echo "<table class='table_inscription' border='1'>";
                echo "<tr><th>Nom</th><th>Catégorie</th><th>Prix immédiat</th><th>Stock</th><th>Action</th></tr>";

                while ($art = mysqli_fetch_assoc($res_articles)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($art['NomArticle']) . "</td>";
                    echo "<td>" . htmlspecialchars($art['Categorie']) . "</td>";
                    echo "<td>" . htmlspecialchars($art['PrixAchatImmediat']) . " €</td>";
                    echo "<td>" . htmlspecialchars($art['QuantiteStock']) . "</td>";
                    echo "<td>
                            <form method='post' style='display:inline'>
                                <input type='hidden' name='id_article_supprimer' value='" . $art['ID'] . "'>
                                <button type='submit' name='SupprimerArticle' style='background-color:red; color:white;'>Supprimer</button>
                            </form>
                          </td>";
                    echo "</tr>";
                }

                echo "</table>";
            } else {
                echo "<p>Aucun article trouvé.</p>";
            }
            ?>
             <button class="button_compte" id="btn_retour_vente" style="background-color: gray;">Retour</button>
            </div>
        </div>

        <div id="messages" class="contenu">
            <h2>Vos messages</h2>
        </div>

        <br>
        <form method="get" action="profil.php" style="display:inline;">
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
       <script>
        const formVente = document.getElementById("form_vente");
        const mesArticles = document.getElementById("mes_articles");
        const btnAfficher = document.getElementById("btn_afficher_articles");
        const btnRetour = document.getElementById("btn_retour_vente");

        btnAfficher.addEventListener("click", () => {
            formVente.style.display = "none";
            mesArticles.style.display = "block";
        });

        btnRetour.addEventListener("click", () => {
            mesArticles.style.display = "none";
            formVente.style.display = "block";
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
