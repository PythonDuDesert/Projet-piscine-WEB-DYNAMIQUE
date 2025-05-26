-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 26 mai 2025 à 18:30
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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `acheteurs_vendeurs`
--

INSERT INTO `acheteurs_vendeurs` (`ID`, `Nom`, `Prenom`, `DateNaissance`, `Email`, `Telephone`, `CodePostal`, `Adresse`, `Pseudo`, `MotDePasse`, `Photo`, `DateInscription`, `Solde`, `TypeCarte`, `NumeroCarte`) VALUES
(1, 'Liquidation ', 'Poséidon ', '0355-05-03', 'poseidon.liquidation@gmail.com', '06 12 34 56 78', 75013, ' 7 Rue des Vagues, 75013 Paris', 'RoiDesOceans', 'Trident', '/Projet-piscine-WEB-DYNAMIQUE/images/Poseidon.jpg', '0400-07-18', 8000, 1, '4539 7582 1234 5678'),
(2, 'Destock', 'Hercule ', '0365-05-03', 'hercule.destock@agorafrancia.gr', '06 12 34 56 78', 75012, '12 Rue des Travaux, 75012 Paris', 'HerculeLeCostaud', '12Travaux', '/Projet-piscine-WEB-DYNAMIQUE/images/Hercule', '0386-12-05', 7563, 3, '5578 1234 5987 8765'),
(3, 'TroisPourLePrixDeDeux', 'Cerbère ', '0347-01-25', 'cerbere.soldes@agorafrancia.gr', '06 33 66 99 00', 69003, '3 Rue des Trois Têtes, 69003 Lyon', 'CerbèreLeChien', 'AboiePas', '/Projet-piscine-WEB-DYNAMIQUE/images/Cerbere', '0396-04-19', 3333, 3, '3782 8224 3333 1005'),
(4, 'Dépôt-vente', 'Hadès ', '0299-06-24', 'hades.depot@agorafrancia.gr', '06 98 76 54 32', 13001, '666 Avenue des Ombres, 13001 Marseille', 'RoiDesEnfers', 'Enfer', '/Projet-piscine-WEB-DYNAMIQUE/images/Hades', '0336-06-06', 6666, 2, '3782 8224 6666 1005');

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
  `Catégorie` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL COMMENT 'Commun, rare,  prenium',
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
