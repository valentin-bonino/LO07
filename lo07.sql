-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 10 Juin 2014 à 12:36
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
(3, 'isi', 'isi', 'resp_programme', 1),
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
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `bureau` varchar(4) NOT NULL,
  `id_pole` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Contenu de la table `ec`
--

INSERT INTO `ec` (`id`, `nom`, `prenom`, `bureau`, `id_pole`) VALUES
(24, 'Lemercier', 'Marc', 'T122', 14),
(25, 'Corpel', 'Alain', 'T111', 14),
(26, 'Benel', 'Aurelien', 'T107', 14),
(27, 'Birregah', 'Babiga', 'H107', 15);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12655 ;

--
-- Contenu de la table `etudiant`
--

INSERT INTO `etudiant` (`id`, `nom`, `prenom`, `id_programme`, `semestre`) VALUES
(12345, 'Duchemin', 'Aurelien', 1, 3),
(12354, 'Skywalker', 'Luke', 1, 2),
(12654, 'Skywalker', 'Anakin', 2, 4);

-- --------------------------------------------------------

--
-- Structure de la table `habilite`
--

CREATE TABLE IF NOT EXISTS `habilite` (
  `id_ec` int(11) NOT NULL,
  `id_programme` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `habilite`
--

INSERT INTO `habilite` (`id_ec`, `id_programme`) VALUES
(24, 4),
(25, 4),
(26, 4),
(27, 4),
(24, 1);

-- --------------------------------------------------------

--
-- Structure de la table `pole`
--

CREATE TABLE IF NOT EXISTS `pole` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Contenu de la table `pole`
--

INSERT INTO `pole` (`id`, `nom`) VALUES
(14, 'HETIC'),
(15, 'ROSAS');

-- --------------------------------------------------------

--
-- Structure de la table `programme`
--

CREATE TABLE IF NOT EXISTS `programme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `programme`
--

INSERT INTO `programme` (`id`, `nom`) VALUES
(1, 'ISI'),
(2, 'SRT'),
(3, 'SM'),
(4, 'TC');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
