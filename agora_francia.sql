-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 31 mai 2025 à 09:49
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
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

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
(10, 'Re', 'SoleilEternel', '0275-12-25', 're@agorafrancia.fr', '0699998888', 33000, '68 Bateau Solaire', 'reflexion400', 'SuperSoleil', 'images/Re.png', '0400-05-27', 4785, 3, '6789 0123 4567 8901'),
(13, 'Erikson', 'Leif', '0970-08-13', 'leif.erikson@gmail.com', '0722345487', 36110, '1 Rue de l\'expedition', 'Lexplorateur', 'Islande12', 'images/leif.jpg', '1002-04-27', 3254, 2, '4322 3245 4356 1254'),
(14, 'Lucius Artorius Castus ', 'Askeladd', '0969-10-30', 'askeladd@agorafrancia.fr', '4567984190', 9988, '4 Rue du Jutland du Nord', 'Askeladd', 'Pirate3', 'images/askeladd.png', '1001-07-21', 12000, 3, '9171 9452 6821 1780 '),
(15, 'Jarl', 'Ulf', '0976-03-05', 'ulf.leouf@gmail.com', '4587432192', 9990, '343 Rue du Vinland', 'LeNavigateur', 'ulfff', 'images/ulf.png', '1021-09-19', 8467, 1, '6305 1571 8000 5331'),
(16, 'Knut', 'Knutsson', '0985-12-01', 'knut.legrand@agorafrancia.fr', '0612566360 ', 29000, '45 Avenue du Jelling ', 'KnutLeGrand', 'TheGreat', 'images/knut.jpg', '1017-09-23', 6000, 2, '5279 9917 4335 2424'),
(17, 'Einsteinus', 'Albertus', '0341-03-10', 'albertus.einsteinus@agorafrancia.gr', '07 64 43 19 22', 35000, '12 Rue des inventions', 'Albertus', 'emc2', '/images/albertus_einsteinus.jpg', '0382-06-01', 650, 2, '4109 3489 1007 9848'),
(18, 'Stote', 'Harry', '0380-07-31', 'harry.stote@agorafrancia.gr', '06 12 34 56 78', 33000, '9 Rue de la Magie Antique', 'SavantUltime', 'SavantUltime123', '/images/aristote.jpg', '0401-11-01', 1500, 3, '3115 1234 3231 6458'),
(19, 'Couchoud', 'Nicolas', '0372-05-15', 'nicolas.couchoud@agorafrancia.gr', '07 89 65 43 21', 78100, '21 Rue des Parchemins', 'MrCouchoud', 'Electromag123', '/images/nicolas_Couchoud.png', '0400-09-15', 720, 2, '1462 7548 3265 8958'),
(20, 'Hugo', 'Victorius', '0320-02-26', 'victorius.hugo@agorafrancia.gr', '06 01 23 45 67', 75000, '5 Impasse des Ecrivains', 'HugoAstuces', 'miserables123', '/images/victorius_hugo.jpg', '0350-12-25', 800, 1, '1643 4976 1872 2983'),
(21, 'boob', 'bobo', '2000-06-15', 'bo@gmail.com', '0677777777', 60100, '4 Rue du Bo', 'bobobo', 'bobobo', 'images/', '2025-05-31', 0, 0, '');

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
-- Structure de la table `alertes_utilisateur`
--

DROP TABLE IF EXISTS `alertes_utilisateur`;
CREATE TABLE IF NOT EXISTS `alertes_utilisateur` (
  `id_utilisateur` int NOT NULL,
  `categorie` enum('Commun','Rare','Premium') NOT NULL,
  `prix` enum('0 à 50','50 à 100','100 à 500','500 et plus') NOT NULL,
  `fin_encheres` date NOT NULL,
  `quantite` enum('0 à 5','6 à 10','11 à 20','20 et plus') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `alertes_utilisateur`
--

INSERT INTO `alertes_utilisateur` (`id_utilisateur`, `categorie`, `prix`, `fin_encheres`, `quantite`) VALUES
(0, 'Premium', '500 et plus', '2025-05-28', '');

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
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

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
(25, 'Cube ancien mystique Allspark', 'Premium', '0390-08-15', 4000, 3100, 3630, '2025-06-07 13:15:00', 'Cube ancien mystique d\'origine inconnue. Certains l\'appellent le Allspark...', 1, 0, 'images/articles/allspark.jpg', 10),
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
(37, 'Parfum \"Essence de conquête\"', 'Rare', '1021-07-17', 180, 150, 120, '2025-05-31 09:01:07', 'Une mixture à base de pin nordique, de sueur de berserker et d’ambre. \"Pour imposer le respect sans lever la hache\"', 6, 1, 'images/articles/parfum.jpg', 13),
(38, 'Pigeon Voyageur', 'Rare', '0401-01-06', 1000, 620, 870, '2025-06-02 20:30:00', 'Véritable pigeon voyageur\r\nDebit: jusqu\'à 2 enveloppes par jour\r\nPortée: environ 200km\r\nAutonomie: 10 ans environ\r\nGraines non fournies', 30, 14, 'images/articles/pigeon.jpg', 17),
(39, 'Mirroir 8K 240fps latence 0ms', 'Rare', '0410-12-08', 120, 50, 100, '2025-06-05 14:00:00', 'Magnifique mirroir, écran 27 pouces. Existe aussi en version incurvée', 20, 3, 'images/articles/miroir.png', 14),
(40, 'Comment apprendre à lire', 'Commun', '0360-04-26', 40, 15, 35, '2025-06-07 10:00:00', 'Les livres tuto de Hugo sont ravis de vous présenter cet ouvrage de 250 pages dans lequel vous allez apprendre à lire. Niveau Ultra débutant', 10, 0, 'images/articles/livre.jpg', 13),
(41, '5 Tips pour sortir d\'un labyrinthe', 'Commun', '0361-02-27', 85, 30, 55, '2025-06-03 18:00:00', 'Apprenez à vous echapper des griffes du Minautaur. Cela peut toujours servir. Conseils testés par Thésée.', 40, 12, 'images/articles/livre_labyrinthe.png', 13),
(42, 'Tablette en pierre', 'Commun', '0407-11-01', 450, 300, 390, '2025-06-10 16:30:00', ' édition limitée. Autonomie infinie. Nécessite un burin (non inclus).', 20, 5, 'images/articles/tablette.png', 12),
(43, 'Wi-Fi 0.1', 'Rare', '0421-06-14', 300, 150, 260, '2025-06-04 12:45:00', 'Portée 5m. Transmission par signaux de fumée. Ne fonctionne pas les jours de pluie.', 25, 3, 'images/articles/wifi.jpg', 14),
(44, 'RAM 64Ko – Rouleau à Manuscrit', 'Commun', '0403-01-31', 60, 25, 50, '2025-05-31 09:00:00', 'Gardez en mémoire vos données. Capacité: 64000 caractères (si vous écrivez petit).', 35, 7, 'images/articles/RAM_parchemin.png', 12),
(45, 'Torche LED (Lumière Ephémère Douce)', 'Commun', '0409-03-09', 25, 10, 15, '2025-06-08 21:00:00', 'Luminosité: 0.05 Lumen. Pour ambiances tamisées ou grottes. Silex non inclus', 60, 28, 'images/articles/torche.jpg', 13),
(46, 'LEGO – 3000 cailloux empilables', 'Rare', '0401-09-20', 150, 60, 110, '2025-06-13 19:00:00', 'Lot de 3000 cailloux empilables pour des construction. Stimule la créativité. Stimule aussi la douleur si on marche dessus.', 30, 5, 'images/articles/lego.png', 14),
(47, 'Meuble IKEA en pierre', 'Premium', '0407-05-18', 780, 400, 670, '2025-06-12 13:30:00', 'Institut des Konstructeurs de l\'Egypte Antique (IKEA) vous présente son dernier modèle. À monter soi-même. Manuel en Grec ou en Latin. Garantie 600 ans.', 10, 2, 'images/articles/meuble_pierre.png', 12),
(48, 'Epée du Jugement', 'Premium', '0500-05-30', 3850, 3400, 3599, '2025-06-09 15:00:00', 'Epée du Jugement légendaire en titane très tranchant.', 1, 0, 'images/articles/Transformers_Last_Knight_Sword.jpg', 5);

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

DROP TABLE IF EXISTS `commandes`;
CREATE TABLE IF NOT EXISTS `commandes` (
  `ID_commande` int NOT NULL AUTO_INCREMENT,
  `ID_article` int NOT NULL COMMENT 'Clé étrangère',
  `DateAchat` datetime NOT NULL,
  `PrixAchat` decimal(10,0) UNSIGNED NOT NULL,
  `MoyenPayement` varchar(255) NOT NULL,
  `ID_acheteur` int NOT NULL,
  `Type_achat` varchar(255) NOT NULL,
  `Payement_effectue` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID_commande`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
