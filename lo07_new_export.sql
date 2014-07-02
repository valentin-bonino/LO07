-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 17 Juin 2014 à 12:24
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `lo07`
--

-- --------------------------------------------------------

--
-- Structure de la table `compte`
--

CREATE TABLE IF NOT EXISTS `compte` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `type` varchar(20) NOT NULL,
  `id_programme` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `compte`
--

INSERT INTO `compte` (`id`, `login`, `password`, `type`, `id_programme`) VALUES
(1, 'drh', 'drh', 'drh', NULL),
(2, 'scolarite', 'scolarite', 'scolarite', NULL),
(3, 'isi', 'isi', 'resp_programme', 6),
(4, 'srt', 'srt', 'resp_programme', 2),
(5, 'sm', 'sm', 'resp_programme', 3);

-- --------------------------------------------------------

--
-- Structure de la table `conseille`
--

CREATE TABLE IF NOT EXISTS `conseille` (
  `id_ec` int(11) NOT NULL,
  `id_etudiant` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ec`
--

CREATE TABLE IF NOT EXISTS `ec` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `bureau` varchar(4) NOT NULL,
  `id_pole` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Contenu de la table `ec`
--

INSERT INTO `ec` (`id`, `nom`, `prenom`, `bureau`, `id_pole`) VALUES
(32, 'Lemercier', 'Marc', 'T122', 18),
(33, 'Corpel', 'Alain', 'T111', 18),
(34, 'Benel', 'Aurelien', 'T107', 18),
(35, 'Birregah', 'Babiga', 'H107', 19),
(36, 'Verchier', 'Yann', 'F207', 20),
(37, 'Panicaud', 'Benoît', 'E104', 20),
(38, 'Amodéo', 'Lionel', 'G205', 19),
(39, 'Retraint', 'Florent', 'H113', 19),
(40, 'Vial', 'Alexandre', 'F204', 20),
(41, 'Ploix', 'Alain', 'T128', 18),
(42, 'Sanchette', 'Frédéric', 'E005', 20);

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE IF NOT EXISTS `etudiant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `id_programme` int(11) NOT NULL,
  `semestre` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=78572 ;

--
-- Contenu de la table `etudiant`
--

INSERT INTO `etudiant` (`id`, `nom`, `prenom`, `id_programme`, `semestre`) VALUES
(12345, 'Duchemin', 'Aurelien', 6, 3),
(12354, 'Skywalker', 'Luke', 6, 2),
(12654, 'Skywalker', 'Anakin', 2, 4),
(78566, 'Pond', 'Amelia', 3, 4),
(78567, 'Holmes', 'Sherlock', 2, 3),
(78568, 'Stone', 'Emma', 5, 1),
(78569, 'Chabanon', 'Paul', 2, 6),
(78570, 'Léa', 'Devic', 4, 2),
(78571, 'Oswald', 'Clara', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `habilite`
--

CREATE TABLE IF NOT EXISTS `habilite` (
  `id_habilite` int(11) NOT NULL AUTO_INCREMENT,
  `id_ec` int(11) NOT NULL,
  `id_programme` int(11) NOT NULL,
  PRIMARY KEY (`id_habilite`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Contenu de la table `habilite`
--

INSERT INTO `habilite` (`id_habilite`, `id_ec`, `id_programme`) VALUES
(1, 32, 6),
(2, 33, 6),
(3, 34, 6),
(4, 35, 1),
(5, 32, 1),
(7, 36, 1),
(8, 36, 4),
(9, 37, 3),
(10, 38, 5),
(11, 38, 1),
(12, 37, 1),
(13, 39, 2),
(14, 40, 4),
(15, 41, 2),
(16, 42, 7),
(17, 32, 6),
(18, 33, 6),
(19, 34, 6),
(20, 41, 6);

-- --------------------------------------------------------

--
-- Structure de la table `pole`
--

CREATE TABLE IF NOT EXISTS `pole` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Contenu de la table `pole`
--

INSERT INTO `pole` (`id`, `nom`) VALUES
(18, 'HETIC'),
(19, 'ROSAS'),
(20, 'P2MN');

-- --------------------------------------------------------

--
-- Structure de la table `programme`
--

CREATE TABLE IF NOT EXISTS `programme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `programme`
--

INSERT INTO `programme` (`id`, `nom`) VALUES
(1, 'TC'),
(2, 'SRT'),
(3, 'SM'),
(4, 'MTE'),
(5, 'SI'),
(6, 'ISI'),
(7, 'PMOM');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
