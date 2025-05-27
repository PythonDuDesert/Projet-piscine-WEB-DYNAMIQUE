<?php
$database = "agora francia";
$db_handle = mysqli_connect('localhost', 'root', '' );
$db_found = mysqli_select_db($db_handle, $database);

$error = false;
$errorMessage = "";

if ($db_found) {  
	 $sql = "SELECT NomArticle, Image,  PrixAchatImmediat FROM articles ORDER BY DateAjout DESC LIMIT 10";
    $result = mysqli_query($db_handle, $sql);

    if ($result) {
        echo '<ul>';
		while ($data = mysqli_fetch_assoc($result)) {
		    echo '<li>';
		    echo '<img src="'.htmlspecialchars($data['Image']).'" alt="'.htmlspecialchars($data['NomArticle']).'" class="carrousel_img" data-titre="'.htmlspecialchars($data['NomArticle']).'"data-prix="' . htmlspecialchars($data['PrixAchatImmediat']) . ' €">'; //data-* : stocke une valeur ; htmlspecialchars() : évite les caratères spéciaux
		    echo '</li>';
		}
		echo '</ul>';
    } else {
        echo "<p>Erreur lors de l'exécution de la requête.</p>";
    }
} else {
    echo "<p>Erreur de connexion à la base de données</p>";
}
?>