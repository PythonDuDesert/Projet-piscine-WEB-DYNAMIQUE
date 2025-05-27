-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 27 mai 2025 à 00:10
-- Version du serveur : 9.1.0
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `agora francia`
--

-- --------------------------------------------------------

--
-- Structure de la table `acheteurs_vendeurs`
--

DROP TABLE IF EXISTS `acheteurs_vendeurs`;
CREATE TABLE IF NOT EXISTS `acheteurs_vendeurs` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Nom` varchar(255) NOT NULL,
  `Prenom` varchar(255) NOT NULL,
  `DateNaissance` date NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Telephone` varchar(255) NOT NULL,
  `CodePostal` int UNSIGNED NOT NULL,
  `Adresse` varchar(255) NOT NULL,
  `Pseudo` varchar(255) NOT NULL,
  `MotDePasse` varchar(255) NOT NULL,
  `Photo` varchar(255) NOT NULL,
  `DateInscription` date NOT NULL,
  `Solde` decimal(10,0) UNSIGNED NOT NULL COMMENT 'euros',
  `TypeCarte` tinyint NOT NULL,
  `NumeroCarte` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `acheteurs_vendeurs`
--

INSERT INTO `acheteurs_vendeurs` (`ID`, `Nom`, `Prenom`, `DateNaissance`, `Email`, `Telephone`, `CodePostal`, `Adresse`, `Pseudo`, `MotDePasse`, `Photo`, `DateInscription`, `Solde`, `TypeCarte`, `NumeroCarte`) VALUES
(1, 'Liquidation ', 'Poséidon ', '0355-05-03', 'poseidon.liquidation@gmail.com', '06 12 34 56 78', 75013, ' 7 Rue des Vagues', 'RoiDesOceans', 'Trident', 'images/Poseidon.jpg', '0400-07-18', 8000, 1, '4539 7582 1234 5678'),
(2, 'Destock', 'Hercule ', '0365-05-03', 'hercule.destock@agorafrancia.gr', '06 12 34 56 78', 75012, '12 Rue des Travaux', 'HerculeLeCostaud', '12Travaux', 'images/Hercule', '0386-12-05', 7563, 3, '5578 1234 5987 8765'),
(3, 'TroisPourLePrixDeDeux', 'Cerbère ', '0347-01-25', 'cerbere.soldes@agorafrancia.gr', '06 33 66 99 00', 69003, '3 Rue des Trois Têtes', 'CerbèreLeChien', 'AboiePas', 'images/Cerbere', '0396-04-19', 3333, 3, '3782 8224 3333 1005'),
(4, 'Dépôt-vente', 'Hadès ', '0299-06-24', 'hades.depot@agorafrancia.gr', '06 98 76 54 32', 13001, '666 Avenue des Ombres', 'RoiDesEnfers', 'Enfer', 'images/Hades', '0336-06-06', 6666, 2, '3782 8224 6666 1005'),
(5, 'Anubis', 'FilsDeChacal', '0300-01-01', 'anubis@agorafrancia.fr', '0601020304', 75001, '11 Nécropole du Nil', 'anubis400', 'DitLesTermesChacal', '', '0400-05-27', 3221, 1, '1234 5678 9012 3456'),
(6, 'Osiris', 'SouverainDesMorts', '0290-03-15', 'osiris@agorafrancia.fr', '0612345678', 13001, '29 Temple du Delta', 'osiris400', 'EpouxDeIsis', '', '0400-05-27', 4870, 2, '2345 6789 0123 4567'),
(7, 'Isis', 'GrandeMagicienne', '0295-07-21', 'isis@agorafrancia.fr', '0654321987', 69000, '31 Palais de l’Est', 'isisis400', 'EpouseDeOsiris', '', '0400-05-27', 2510, 3, '3456 7890 1234 5678'),
(8, 'Horus', 'FauconCeleste', '0305-11-11', 'horus@agorafrancia.fr', '0678901234', 31000, '40 Ciel d’Héliopolis', 'horusse400', 'FanDeFaucon', '', '0400-05-27', 4000, 1, '4567 8901 2345 6789'),
(9, 'Seth', 'SeigneurDuDesert', '0280-09-09', 'seth@agorafrancia.fr', '0611122233', 6000, '55 Désert Rouge', 'sept400', 'sept777', '', '0400-05-27', 515, 2, '5678 9012 3456 7890'),
(10, 'Re', 'SoleilEternel', '0275-12-25', 're@agorafrancia.fr', '0699998888', 33000, '68 Bateau Solaire', 'reflexion400', 'SuperSoleil', '', '0400-05-27', 4785, 3, '6789 0123 4567 8901');

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Prenom` varchar(255) NOT NULL,
  `Nom` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `MotDePasse` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`ID`, `Prenom`, `Nom`, `Email`, `MotDePasse`) VALUES
(1, 'Olivier', 'YAMMINE', 'olivier.yammine@edu.ece.fr', 'olivier1234'),
(2, 'Leonard', 'FORESTIER', 'leonard.forestier@edu.ece.fr', 'leonard1234'),
(3, 'Julien', 'MENET', 'julien.menet2@edu.ece.fr', 'julien1234'),
(4, 'Mike', 'LIN', 'mike.lin@edu.ece.fr', 'mike1234');

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `NomArticle` varchar(255) NOT NULL,
  `Categorie` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL COMMENT 'Commun, rare,  premium',
  `DateAjout` date NOT NULL,
  `PrixAchatImmediat` decimal(10,0) UNSIGNED NOT NULL,
  `PrixEnchere` decimal(10,0) UNSIGNED NOT NULL,
  `PrixNegociation` decimal(10,0) UNSIGNED NOT NULL,
  `DateFinEnchere` datetime NOT NULL,
  `Description` varchar(255) NOT NULL,
  `QuantiteStock` mediumint UNSIGNED NOT NULL,
  `QuantiteVendue` mediumint UNSIGNED NOT NULL,
  `Image` varchar(255) NOT NULL,
  `IDAcheteurVendeur` int NOT NULL COMMENT 'Clé étrangère',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`ID`, `NomArticle`, `Categorie`, `DateAjout`, `PrixAchatImmediat`, `PrixEnchere`, `PrixNegociation`, `DateFinEnchere`, `Description`, `QuantiteStock`, `QuantiteVendue`, `Image`, `IDAcheteurVendeur`) VALUES
(1, 'Trident ', 'premium', '0400-07-28', 5000, 2500, 4500, '2025-06-04 20:38:24', 'Authentique Trident de Poséidon ! Parfait pour décorer votre salon, impressionner vos invités ou même diriger des océans. Matière : Résine métallisée. Hauteur : 1,20 m. Poids : 2,5 kg.\"', 1, 0, 'images/articles/Trident.png', 1),
(2, 'Tentacule de Kraken', 'Rare', '0400-06-12', 249, 149, 199, '2025-06-04 18:30:58', 'Kraken pêcher ce matin, tentacule toujours très fraîche. \r\nLongueur : 3 mètres.', 8, 2, 'images/articles/Kraken.jpg', 1),
(3, 'Le Coffre aux Trésors de Sirène', 'Rare', '0400-06-25', 179, 99, 139, '2025-06-02 21:10:05', 'Coffre en bois vieilli avec incrustations de coquillages et pierres semi-précieuses. Contient :\r\n10 pièces d’or répliques (taille réelle)\r\n1 collier de perles faux\r\n1 flacon de \"poussière de sirène\" (paillettes biodégradables)\r\nDimensions : 40 x 30 x 25 c', 10, 4, 'images/articles/Coffre.jpg', 1),
(4, 'La Perle Géante Lumineuse', 'Commun', '0400-06-24', 69, 39, 59, '2025-06-04 21:13:54', 'Perle en résine de 20 cm de diamètre, avec effet nacré et lumière. Autonomie : 10h. Poids : 1,2 kg.', 20, 12, 'images/articles/Perle.jpg', 1),
(5, 'Le Kraken en Peluche (Format Géant)', 'Commun', '0400-06-05', 19, 10, 15, '2025-05-26 19:20:39', 'Peluche tentaculaire géante (1,20 m)\r\nCâliner vos peurs marines\r\nMatière : Polyester ultra-doux. Lavable en machine. Yeux lumineux.', 6, 1, 'images/articles/Peluche.jpg', 1),
(6, 'Le Manteau d’Écume (Dégradé Bleu)', 'Commun', '0400-06-01', 49, 29, 39, '2025-06-12 21:24:10', 'Manteau longueur royale avec effet « vague qui brille ».\r\n\r\nMatière : Polyester résistant (imitation écume)\r\n\r\nCapuche intégrée en forme de vague\r\n\r\nPoche secrète pour cacher des coquillages (ou vos clés)\r\n\r\nTaille unique (adaptable de 1,60 m à 1,90 m)', 8, 3, 'images/articles/Manteau.jpg', 1),
(7, 'Peau du Lion de Némée', 'premium ', '0386-12-22', 1289, 975, 1049, '2025-06-03 21:31:53', 'Peau du Lion de Némée, vaincu par Hercule lors de son premier travail.', 1, 0, 'images/articles/Nemee.jpg', 2),
(8, 'Massue \"Travail n°9\"', 'Rare', '0386-12-29', 59, 45, 29, '2025-05-26 19:35:19', 'Massue utilisée contre l\'Hydre de Lerne', 1, 0, 'images/articles/Massue.jpg', 2),
(9, 'Flèches empoisonnées ', 'Commun', '0386-12-18', 34, 29, 19, '2025-05-26 19:38:28', 'Pack de 6 flèches pour recréer le combat contre les oiseaux du lac Stymphale.', 20, 12, 'images/articles/Fleches.jpg', 2),
(10, 'Collier à Trois Têtes \"Gardien des Enfers\"', 'Commun', '0396-05-14', 39, 25, 30, '2025-06-04 21:42:39', 'Collier ajustable pour chien (ou humain audacieux)\r\nMatériaux : Nylon résistant + détails glow-in-the-dark\r\nTaille : Adaptable (40-60 cm)', 15, 4, 'images/articles/Collier.jpg', 3),
(11, 'Os à Mâcher', 'Commun', '0396-05-05', 12, 8, 10, '2025-05-26 19:45:36', 'Os en caoutchouc ultra-résistant, infusé au \"jus du fleuve Styx\" (arôme faux bacon)\r\nAvantages :\r\nDurée de vie : \"Éternelle\" (en théorie)\r\nNettoie les dents et distrait votre molosse pendant des heures\r\nFlotte dans l’eau (testé dans le Styx, résultats var', 30, 18, 'images/articles/Os.jpg', 3),
(12, 'La Toison d\'Or', 'premium', '0396-05-18', 2499, 1999, 2100, '2025-06-10 21:47:53', 'Légendaire Toison d\'Or, symbole de pouvoir et de prospérité.', 1, 0, 'images/articles/Toison.jpg', 3),
(13, 'Le Trône d\'Hadès', 'premium', '0336-06-06', 14, 9, 14, '2025-06-03 21:55:53', '\"Le véritable trône du Dieu des Enfers, récupéré après négociation avec Perséphone.\r\n\r\nMatière : Obsidienne pure incrustée d\'os de Titans\r\n\r\nDimensions : 2,5m de haut x 1,8m de large (poids : 888 kg)\r\n\r\nFonctionnalités :\r\n\r\nSiège chauffant à lave (réglabl', 1, 0, 'images/articles/Trone.jpeg', 4);

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

DROP TABLE IF EXISTS `commandes`;
CREATE TABLE IF NOT EXISTS `commandes` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `ID_article` int NOT NULL COMMENT 'Clé étrangère',
  `DateAchat` datetime NOT NULL,
  `PrixAchat` decimal(10,0) UNSIGNED NOT NULL,
  `MoyenPayement` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
