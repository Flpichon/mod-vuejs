-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 02 juil. 2019 à 21:55
-- Version du serveur :  5.7.21
-- Version de PHP :  7.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `bdd_mod_eleve`
--

-- --------------------------------------------------------

--
-- Structure de la table `classe`
--

DROP TABLE IF EXISTS `classe`;
CREATE TABLE IF NOT EXISTS `classe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) NOT NULL,
  `numero` int(11) NOT NULL,
  `suppr` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `classe`
--

INSERT INTO `classe` (`id`, `libelle`, `numero`, `suppr`) VALUES
(9, 'terminale', 8, 0),
(11, 'seconde', 98, 0);

-- --------------------------------------------------------

--
-- Structure de la table `classe_matiere`
--

DROP TABLE IF EXISTS `classe_matiere`;
CREATE TABLE IF NOT EXISTS `classe_matiere` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_matiere` int(11) NOT NULL,
  `id_classe` int(11) NOT NULL,
  `suppr` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `classe_matiere_classe0_FK` (`id_classe`),
  KEY `id_matiere` (`id_matiere`,`id_classe`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `classe_matiere`
--

INSERT INTO `classe_matiere` (`id`, `id_matiere`, `id_classe`, `suppr`) VALUES
(5, 2, 9, 0),
(6, 1, 9, 0),
(9, 3, 9, 1),
(10, 1, 11, 0),
(11, 4, 9, 0),
(12, 5, 9, 0),
(13, 4, 11, 0),
(14, 5, 11, 0),
(15, 3, 11, 0);

-- --------------------------------------------------------

--
-- Structure de la table `eleve`
--

DROP TABLE IF EXISTS `eleve`;
CREATE TABLE IF NOT EXISTS `eleve` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `date_naissance` datetime NOT NULL,
  `id_classe` int(11) NOT NULL,
  `suppr` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `eleve_classe_FK` (`id_classe`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `eleve`
--

INSERT INTO `eleve` (`id`, `nom`, `prenom`, `date_naissance`, `id_classe`, `suppr`) VALUES
(2, 'Le Pichon', 'Frédéric', '1996-06-27 00:00:00', 9, 0),
(3, 'toto', 'Eleve', '2020-01-14 00:00:00', 9, 0),
(4, 'supertoto', 'Eleve', '1991-05-06 00:00:00', 9, 1),
(5, 'test', 'Franck', '1993-12-13 00:00:00', 9, 1),
(7, 'yoo', 'swag', '2019-06-21 00:00:00', 7, 0),
(9, 'Nouvel', 'Eleve', '2019-06-23 00:00:00', 11, 0),
(10, 'Nouvel', 'Eleve', '2019-06-23 00:00:00', 11, 0),
(11, 'Nouvel', 'Eleve', '2019-07-02 00:00:00', 9, 0),
(12, 'Nouvel', 'Eleve', '2019-07-02 00:00:00', 9, 0),
(13, 'Nouvel', 'Eleve', '2019-07-02 00:00:00', 9, 0),
(14, 'Nouvel', 'Eleve', '2019-07-02 00:00:00', 9, 1);

-- --------------------------------------------------------

--
-- Structure de la table `matiere`
--

DROP TABLE IF EXISTS `matiere`;
CREATE TABLE IF NOT EXISTS `matiere` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `intitule` varchar(50) NOT NULL,
  `suppr` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `matiere`
--

INSERT INTO `matiere` (`id`, `intitule`, `suppr`) VALUES
(1, 'français', 0),
(2, 'Maths', 0),
(3, 'SVT', 0),
(4, 'Physique', 0),
(5, 'Philosophie', 0);

-- --------------------------------------------------------

--
-- Structure de la table `note`
--

DROP TABLE IF EXISTS `note`;
CREATE TABLE IF NOT EXISTS `note` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `valeur` float NOT NULL,
  `description` varchar(100) NOT NULL,
  `id_eleve` int(11) NOT NULL,
  `id_matiere` int(11) NOT NULL,
  `suppr` int(11) NOT NULL DEFAULT '0',
  `coefficient` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `note_eleve_FK` (`id_eleve`),
  KEY `note_matiere0_FK` (`id_matiere`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `note`
--

INSERT INTO `note` (`id`, `valeur`, `description`, `id_eleve`, `id_matiere`, `suppr`, `coefficient`) VALUES
(1, 15, 'DM', 2, 1, 0, 1),
(2, 20, 'DST', 2, 2, 0, 2),
(3, 12, 'DST', 2, 1, 0, 2);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `classe_matiere`
--
ALTER TABLE `classe_matiere`
  ADD CONSTRAINT `classe_matiere_classe0_FK` FOREIGN KEY (`id_classe`) REFERENCES `classe` (`id`),
  ADD CONSTRAINT `classe_matiere_matiere_FK` FOREIGN KEY (`id_matiere`) REFERENCES `matiere` (`id`);

--
-- Contraintes pour la table `note`
--
ALTER TABLE `note`
  ADD CONSTRAINT `note_eleve_FK` FOREIGN KEY (`id_eleve`) REFERENCES `eleve` (`id`),
  ADD CONSTRAINT `note_matiere0_FK` FOREIGN KEY (`id_matiere`) REFERENCES `matiere` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
