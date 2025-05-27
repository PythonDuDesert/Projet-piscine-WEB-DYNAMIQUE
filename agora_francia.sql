-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 27 mai 2025 à 15:17
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
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `acheteurs_vendeurs`
--

INSERT INTO `acheteurs_vendeurs` (`ID`, `Nom`, `Prenom`, `DateNaissance`, `Email`, `Telephone`, `CodePostal`, `Adresse`, `Pseudo`, `MotDePasse`, `Photo`, `DateInscription`, `Solde`, `TypeCarte`, `NumeroCarte`) VALUES
(1, 'Liquidation ', 'Poséidon ', '0355-05-03', 'poseidon.liquidation@gmail.com', '0612345678', 75013, ' 7 Rue des Vagues', 'RoiDesOceans', 'Trident', 'images/Poseidon.jpg', '0400-07-18', 8000, 1, '4539 7582 1234 5678'),
(2, 'Destock', 'Hercule ', '0365-05-03', 'hercule.destock@agorafrancia.fr', '0612345678', 75012, '12 Rue des Travaux', 'HerculeLeCostaud', '12Travaux', 'images/Hercule.jpg', '0386-12-05', 7563, 3, '5578 1234 5987 8765'),
(3, 'TroisPourLePrixDeDeux', 'Cerbère ', '0347-01-25', 'cerbere.soldes@agorafrancia.fr', '0633669900', 69003, '3 Rue des Trois Têtes', 'CerbèreLeChien', 'AboiePas', 'images/Cerbere.jpg', '0396-04-19', 3333, 3, '3782 8224 3333 1005'),
(4, 'Dépôt-vente', 'Hadès ', '0299-06-24', 'hades.depot@agorafrancia.fr', '0698765432', 13001, '666 Avenue des Ombres', 'RoiDesEnfers', 'Enfer', 'images/Hades.jpg', '0336-06-06', 6666, 2, '3782 8224 6666 1005'),
(5, 'Anubis', 'FilsDeChacal', '0300-01-01', 'anubis@agorafrancia.fr', '0601020304', 75001, '11 Nécropole du Nil', 'anubis400', 'DitLesTermesChacal', 'images/Anubis.png', '0400-05-27', 3221, 1, '1234 5678 9012 3456'),
(6, 'Osiris', 'SouverainDesMorts', '0290-03-15', 'osiris@agorafrancia.fr', '0612345678', 13001, '29 Temple du Delta', 'osiris400', 'EpouxDeIsis', 'images/Osiris.png', '0400-05-27', 4870, 2, '2345 6789 0123 4567'),
(7, 'Isis', 'GrandeMagicienne', '0295-07-21', 'isis@agorafrancia.fr', '0654321987', 69000, '31 Palais de l’Est', 'isisis400', 'EpouseDeOsiris', 'images/Isis.png', '0400-05-27', 2510, 3, '3456 7890 1234 5678'),
(8, 'Horus', 'FauconCeleste', '0305-11-11', 'horus@agorafrancia.fr', '0678901234', 31000, '40 Ciel d’Héliopolis', 'horusse400', 'FanDeFaucon', 'images/Horus.png', '0400-05-27', 4000, 1, '4567 8901 2345 6789'),
(9, 'Seth', 'SeigneurDuDesert', '0280-09-09', 'seth@agorafrancia.fr', '0611122233', 60000, '55 Désert Rouge', 'sept400', 'sept777', 'images/Seth.png', '0400-05-27', 515, 2, '5678 9012 3456 7890'),
(10, 'Re', 'SoleilEternel', '0275-12-25', 're@agorafrancia.fr', '0699998888', 33000, '68 Bateau Solaire', 'reflexion400', 'SuperSoleil', 'images/Re.png', '0400-05-27', 4785, 3, '6789 0123 4567 8901');

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
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`ID`, `NomArticle`, `Categorie`, `DateAjout`, `PrixAchatImmediat`, `PrixEnchere`, `PrixNegociation`, `DateFinEnchere`, `Description`, `QuantiteStock`, `QuantiteVendue`, `Image`, `IDAcheteurVendeur`) VALUES
(1, 'Trident ', 'Premium', '0400-07-28', 5000, 2500, 4500, '2025-06-04 20:38:24', 'Authentique Trident de Poséidon ! Parfait pour décorer votre salon, impressionner vos invités ou même diriger des océans. Matière : Résine métallisée. Hauteur : 1,20 m. Poids : 2,5 kg.\"', 1, 0, 'images/articles/Trident.png', 1),
(2, 'Tentacule de Kraken', 'Rare', '0400-06-12', 249, 149, 199, '2025-06-04 18:30:58', 'Kraken pêcher ce matin, tentacule toujours très fraîche. \r\nLongueur : 3 mètres.', 8, 2, 'images/articles/Kraken.jpg', 1),
(3, 'Le Coffre aux Trésors de Sirène', 'Rare', '0400-06-25', 179, 99, 139, '2025-06-02 21:10:05', 'Coffre en bois vieilli avec incrustations de coquillages et pierres semi-précieuses. Contient :\r\n10 pièces d’or répliques (taille réelle)\r\n1 collier de perles faux\r\n1 flacon de \"poussière de sirène\" (paillettes biodégradables)\r\nDimensions : 40 x 30 x 25 c', 10, 4, 'images/articles/Coffre.jpg', 1),
(4, 'La Perle Géante Lumineuse', 'Commun', '0400-06-24', 69, 39, 59, '2025-06-04 21:13:54', 'Perle en résine de 20 cm de diamètre, avec effet nacré et lumière. Autonomie : 10h. Poids : 1,2 kg.', 20, 12, 'images/articles/Perle.jpg', 1),
(5, 'Le Kraken en Peluche (Format Géant)', 'Commun', '0400-06-05', 19, 10, 15, '2025-05-26 19:20:39', 'Peluche tentaculaire géante (1,20 m)\r\nCâliner vos peurs marines\r\nMatière : Polyester ultra-doux. Lavable en machine. Yeux lumineux.', 6, 1, 'images/articles/Peluche.jpg', 1),
(6, 'Le Manteau d’Écume (Dégradé Bleu)', 'Commun', '0400-06-01', 49, 29, 39, '2025-06-12 21:24:10', 'Manteau longueur royale avec effet « vague qui brille ».\r\n\r\nMatière : Polyester résistant (imitation écume)\r\n\r\nCapuche intégrée en forme de vague\r\n\r\nPoche secrète pour cacher des coquillages (ou vos clés)\r\n\r\nTaille unique (adaptable de 1,60 m à 1,90 m)', 8, 3, 'images/articles/Manteau.jpg', 1),
(7, 'Peau du Lion de Némée', 'Premium ', '0386-12-22', 1289, 975, 1049, '2025-06-03 21:31:53', 'Peau du Lion de Némée, vaincu par Hercule lors de son premier travail.', 1, 0, 'images/articles/Nemee.jpg', 2),
(8, 'Massue \"Travail n°9\"', 'Rare', '0386-12-29', 59, 45, 29, '2025-05-26 19:35:19', 'Massue utilisée contre l\'Hydre de Lerne', 1, 0, 'images/articles/Massue.jpg', 2),
(9, 'Flèches empoisonnées ', 'Commun', '0386-12-18', 34, 29, 19, '2025-05-26 19:38:28', 'Pack de 6 flèches pour recréer le combat contre les oiseaux du lac Stymphale.', 20, 12, 'images/articles/Fleches.jpg', 2),
(10, 'Collier à Trois Têtes \"Gardien des Enfers\"', 'Commun', '0396-05-14', 39, 25, 30, '2025-06-04 21:42:39', 'Collier ajustable pour chien (ou humain audacieux)\r\nMatériaux : Nylon résistant + détails glow-in-the-dark\r\nTaille : Adaptable (40-60 cm)', 15, 4, 'images/articles/Collier.jpg', 3),
(11, 'Os à Mâcher', 'Commun', '0396-05-05', 12, 8, 10, '2025-05-26 19:45:36', 'Os en caoutchouc ultra-résistant, infusé au \"jus du fleuve Styx\" (arôme faux bacon)\r\nAvantages :\r\nDurée de vie : \"Éternelle\" (en théorie)\r\nNettoie les dents et distrait votre molosse pendant des heures\r\nFlotte dans l’eau (testé dans le Styx, résultats var', 30, 18, 'images/articles/Os.jpg', 3),
(12, 'La Toison d\'Or', 'Premium', '0396-05-18', 2499, 1999, 2100, '2025-06-10 21:47:53', 'Légendaire Toison d\'Or, symbole de pouvoir et de prospérité.', 1, 0, 'images/articles/Toison.jpg', 3),
(13, 'Le Trône d\'Hadès', 'Premium', '0336-06-06', 14, 9, 14, '2025-06-03 21:55:53', '\"Le véritable trône du Dieu des Enfers, récupéré après négociation avec Perséphone.\r\n\r\nMatière : Obsidienne pure incrustée d\'os de Titans\r\n\r\nDimensions : 2,5m de haut x 1,8m de large (poids : 888 kg)\r\n\r\nFonctionnalités :\r\n\r\nSiège chauffant à lave (réglabl', 1, 0, 'images/articles/Trone.jpeg', 4),
(14, 'Cruche', 'Commun', '0379-03-29', 40, 25, 30, '2025-06-04 16:15:00', 'Cruche en terre cuite de Haute Egypte.', 18, 14, 'images/articles/cruche.jpg', 10),
(15, 'Lampe à huile', 'Commun', '0379-08-15', 20, 12, 15, '2025-06-05 12:10:00', 'Lampe à huile en terre cuite Egyptienne. Légèrement usée, bon état.', 10, 6, 'images/articles/lampe_huile.jpg', 6),
(16, 'Livre ancien Oui Ou Nan?', 'Premium', '0380-09-02', 1120, 1049, 1089, '2025-06-12 17:15:00', 'Livre ancien authentique du Oui Ou Nan? par Anis CHAARI.', 1, 0, 'images/articles/livre_OuiOuNan.png', 7),
(17, 'Livre sur l\'art d\'aller aux toilettes avant les cours.', 'Premium', '0382-01-21', 899, 820, 869, '2025-06-05 08:30:00', 'Livre mythique sur l\'art d\'aller aux toilettes avant les cours. Par Nicolas COUCHOUD.', 1, 0, 'images/articles/livre_Precautions.png', 7),
(18, 'Livre/Guide pour ne pas utiliser son téléphone en cours.', 'Premium', '0382-02-05', 910, 835, 869, '2025-06-05 10:45:00', 'Livre/Guide légendaire pour ne pas utiliser son téléphone en cours. Par Noreddine EUTAMENE.', 1, 0, 'images/articles/livre_telephone.png', 7),
(19, 'Statue d\'Anubis', 'Rare', '0380-12-01', 359, 305, 330, '2025-06-01 21:00:00', 'Statue authentique du dieu Anubis.', 6, 10, 'images/articles/Statue_Anubis.jpg', 5),
(20, 'Statuette de chat noir egyptien', 'Rare', '0389-03-29', 310, 255, 289, '2025-06-06 16:15:00', 'Statuette de chat noir egyptien avec dorures.', 5, 8, 'images/articles/statuette_chat.png', 5),
(21, 'Stele de Re', 'Premium', '0390-03-29', 899, 800, 849, '2025-06-14 15:30:00', 'Stele authentique du dieu Re.', 1, 1, 'images/articles/Stele_Ra.jpg', 10),
(22, 'Vase egyptien en terre cuite avec ances', 'Commun', '0390-05-06', 45, 60, 39, '2025-06-07 18:30:00', 'Vase egyptien en terre cuite clair avec ances pour le tenir.', 12, 11, 'images/articles/vase1.jpg', 8),
(23, 'Vase egyptien en terre cuite avec ances et motifs', 'Commun', '0390-08-02', 45, 29, 40, '2025-06-07 19:00:00', 'Vase egyptien en terre cuite sombre avec ances et motifs egyptien gravés dessus.', 10, 12, 'images/articles/vase2.jpg', 9),
(24, 'Vase egyptien avec  motifs peints', 'Commun', '0390-11-30', 40, 25, 30, '2025-06-07 12:30:00', 'Vase egyptien avec  motifs peints.', 17, 21, 'images/articles/vase3.jpg', 6),
(25, 'Cube ancien mystique', 'Premium', '0390-08-15', 1500, 1300, 1430, '2025-06-07 13:10:00', 'Cube ancien mystique d\'origine inconnue.', 1, 0, 'images/articles/allspark.jpg', 10),
(26, 'Agenda Runique', 'Rare', '1002-07-28', 100, 80, 75, '2025-06-01 08:20:27', 'Organiseur en cuir gravé de runes. Livré avec un caillou pour graver les tâches.', 4, 1, 'images/articles/agendarunique.jpg', 12),
(27, 'Bouclier mural', 'Commun', '1021-09-21', 80, 68, 65, '2025-05-27 08:27:51', 'Bouclier mural décoratif datant des véritables Vikings. \r\nParfait en cas de manifestation.', 10, 3, 'images/articles/boucliermural.jpg', 13),
(28, 'Carte marine du Vinland', 'Commun', '1002-08-23', 30, 27, 25, '2025-05-31 08:31:53', 'Reproduction (plus ou moins fidèle) d’une carte utilisée pour atteindre les terres inconnues de l’ouest. Légende incluse : \"Attention aux serpents de mer\".', 15, 6, 'images/articles/cartemarine.jpg', 11),
(29, 'Casque Viking', 'Commun', '1018-01-03', 20, 18, 16, '2025-06-14 08:34:25', 'Casque Viking à cornes. Parfait en temps de guerre ou pour l\'anniversaire de Titouan.', 30, 5, 'images/articles/casque-viking.jpg', 14),
(30, 'Habits de Viking', 'Premium', '1002-05-01', 340, 290, 200, '2025-02-20 08:37:17', 'Vêtements de viking originel. D\'après la légende, le roi Sven l\'aurait porté.', 1, 0, 'images/articles/deguisementviking.jpg', 11),
(31, 'Drakkar Miniature', 'Rare', '1021-10-07', 90, 85, 80, '2025-05-07 08:40:01', 'Representation fidele et miniature du bateau des vikings.\r\nDimension 37.7cm x 12.1cm', 14, 2, 'images/articles/drakkar.jpg', 13),
(32, 'Drakkar Geant', 'Premium', '1017-11-30', 2500, 2250, 2200, '2025-05-27 08:42:36', 'Véritable drakkar de l\'époque des vikings restauré à neuf.\r\nParfait pour partir en vacances en famille ou bien aller faire la guerre.\r\nDimension : 30m x 13m  ', 1, 0, 'images/articles/drakkarGeant.jpg', 14),
(33, 'Duo déguisement vikings', 'Commun', '1001-12-05', 70, 64, 60, '2025-06-24 08:45:12', 'Duo de déguisement vikings (1 homme, 1 femme)\r\nD\'après la légende vous seriez ridicule peu importe votre charisme en portant ces déguisements.\r\nLes haches, le bouclier, les casques sont bien entendu pas livrés avec le déguisement.', 4, 1, 'images/articles/duo-deguisement-viking.jpg', 12),
(34, 'Epée d\'Askeladd', 'Premium', '1010-10-13', 400, 350, 330, '2025-05-27 08:50:05', 'Forgée dans les forges brumeuses des côtes galloises et trempée dans les mensonges d’un roi.\r\nCette arme aurait été utilisée dans plus de 36 duels malheureusement aucun témoin n\'a survécu.', 1, 0, 'images/articles/epee.askeladd.jpg', 12),
(35, 'Haches miniatures de décoration', 'Commun', '1002-07-12', 53, 46, 40, '2025-06-10 08:54:25', 'Petites haches en bois gravées, à accrocher dans la maison ou à offrir pour prouver son courage.', 12, 3, 'images/articles/hachesmini.jpg', 11),
(36, 'Les 10 grands secrets d\'un manipulateur', 'Commun', '1003-03-02', 24, 22, 17, '2025-06-02 08:57:10', 'Dans ce livre, Askeladd retrace les 10 plus grands secrets qui lui ont permis de conquérir le monde.\r\nEdition - Hachette ', 21, 8, 'images/articles/livre.askeladd.jpg', 11),
(37, 'Parfum \"Essence de conquête\"', 'Rare', '1021-07-17', 180, 150, 120, '2025-05-31 09:01:07', 'Une mixture à base de pin nordique, de sueur de berserker et d’ambre. \"Pour imposer le respect sans lever la hache\"', 6, 1, 'images/articles/parfum.jpg', 13);

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
