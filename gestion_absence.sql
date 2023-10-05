-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Client: 127.0.0.1
-- Généré le: Jeu 20 Juillet 2023 à 17:04
-- Version du serveur: 5.5.27-log
-- Version de PHP: 5.4.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `gestion_absence`
--

-- --------------------------------------------------------

--
-- Structure de la table `absence`
--

CREATE TABLE IF NOT EXISTS `absence` (
  `id_absence` int(11) NOT NULL AUTO_INCREMENT,
  `date_abs` int(11) NOT NULL,
  `heure_debut_abs` varchar(255) NOT NULL,
  `heure_fin_abs` varchar(255) NOT NULL,
  `total_heure_abs` int(11) NOT NULL,
  `id_stag` int(11) NOT NULL,
  `id_cours` int(11) NOT NULL,
  `id_annee_formation` int(11) NOT NULL,
  `justif` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_absence`),
  KEY `id_stag` (`id_stag`),
  KEY `id_cours` (`id_cours`),
  KEY `id_annee_formation` (`id_annee_formation`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `annee_formation`
--

CREATE TABLE IF NOT EXISTS `annee_formation` (
  `id_annee_formation` int(11) NOT NULL AUTO_INCREMENT,
  `annee_formation` varchar(255) NOT NULL,
  PRIMARY KEY (`id_annee_formation`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

CREATE TABLE IF NOT EXISTS `cours` (
  `id_cours` int(11) NOT NULL AUTO_INCREMENT,
  `des_cours` varchar(255) NOT NULL,
  `id_formateur` int(11) NOT NULL,
  PRIMARY KEY (`id_cours`),
  KEY `id_formateur` (`id_formateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `filiere`
--

CREATE TABLE IF NOT EXISTS `filiere` (
  `id_filiere` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_filiere` varchar(255) NOT NULL,
  `id_niveau` int(11) NOT NULL,
  PRIMARY KEY (`id_filiere`),
  KEY `id_niveau` (`id_niveau`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `formateur`
--

CREATE TABLE IF NOT EXISTS `formateur` (
  `id_formateur` int(11) NOT NULL AUTO_INCREMENT,
  `nom_formateur` varchar(255) NOT NULL,
  PRIMARY KEY (`id_formateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

CREATE TABLE IF NOT EXISTS `groupe` (
  `id_groupe` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_groupe` varchar(255) NOT NULL,
  `id_filiere` int(11) NOT NULL,
  PRIMARY KEY (`id_groupe`),
  KEY `id_filiere` (`id_filiere`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `justif`
--

CREATE TABLE IF NOT EXISTS `justif` (
  `id_justif` int(11) NOT NULL AUTO_INCREMENT,
  `id_type_justif` int(11) NOT NULL,
  `com_justif` text NOT NULL,
  `id_absence` int(11) NOT NULL,
  `date_debut_justif` int(11) NOT NULL,
  `date_fin_justif` int(11) NOT NULL,
  `nb_heure_justifie` int(11) NOT NULL,
  PRIMARY KEY (`id_justif`),
  KEY `id_absence` (`id_absence`),
  KEY `id_type_justif` (`id_type_justif`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `niveau`
--

CREATE TABLE IF NOT EXISTS `niveau` (
  `id_niveau` int(11) NOT NULL AUTO_INCREMENT,
  `intitule_niveau` int(11) NOT NULL,
  PRIMARY KEY (`id_niveau`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `stagiaire`
--

CREATE TABLE IF NOT EXISTS `stagiaire` (
  `id_stag` int(11) NOT NULL AUTO_INCREMENT,
  `matricule_stag` varchar(255) NOT NULL,
  `nom_stag` varchar(255) NOT NULL,
  `prenom_stag` varchar(255) NOT NULL,
  `civilite_stag` varchar(10) NOT NULL,
  `cin_stag` varchar(100) NOT NULL,
  `date_naissance_stag` int(11) NOT NULL,
  `tel_stag` varchar(255) NOT NULL,
  `id_groupe` int(11) NOT NULL,
  `id_statut_stagiaire` int(11) NOT NULL,
  `com_stag` text NOT NULL,
  PRIMARY KEY (`id_stag`),
  KEY `id_statut_stagiaire` (`id_statut_stagiaire`),
  KEY `id_groupe` (`id_groupe`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `statut_stagiaire`
--

CREATE TABLE IF NOT EXISTS `statut_stagiaire` (
  `id_statut_stagiaire` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_stat` varchar(255) NOT NULL,
  PRIMARY KEY (`id_statut_stagiaire`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `type_justif`
--

CREATE TABLE IF NOT EXISTS `type_justif` (
  `id_type_justif` int(11) NOT NULL AUTO_INCREMENT,
  `des_type_justif` varchar(255) NOT NULL,
  PRIMARY KEY (`id_type_justif`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `absence`
--
ALTER TABLE `absence`
  ADD CONSTRAINT `absence_ibfk_1` FOREIGN KEY (`id_stag`) REFERENCES `stagiaire` (`id_stag`),
  ADD CONSTRAINT `absence_ibfk_2` FOREIGN KEY (`id_cours`) REFERENCES `cours` (`id_cours`),
  ADD CONSTRAINT `absence_ibfk_3` FOREIGN KEY (`id_annee_formation`) REFERENCES `annee_formation` (`id_annee_formation`);

--
-- Contraintes pour la table `cours`
--
ALTER TABLE `cours`
  ADD CONSTRAINT `cours_ibfk_1` FOREIGN KEY (`id_formateur`) REFERENCES `formateur` (`id_formateur`);

--
-- Contraintes pour la table `filiere`
--
ALTER TABLE `filiere`
  ADD CONSTRAINT `filiere_ibfk_1` FOREIGN KEY (`id_niveau`) REFERENCES `niveau` (`id_niveau`);

--
-- Contraintes pour la table `groupe`
--
ALTER TABLE `groupe`
  ADD CONSTRAINT `groupe_ibfk_1` FOREIGN KEY (`id_filiere`) REFERENCES `filiere` (`id_filiere`);

--
-- Contraintes pour la table `justif`
--
ALTER TABLE `justif`
  ADD CONSTRAINT `justif_ibfk_1` FOREIGN KEY (`id_absence`) REFERENCES `absence` (`id_absence`),
  ADD CONSTRAINT `justif_ibfk_2` FOREIGN KEY (`id_type_justif`) REFERENCES `type_justif` (`id_type_justif`);

--
-- Contraintes pour la table `stagiaire`
--
ALTER TABLE `stagiaire`
  ADD CONSTRAINT `stagiaire_ibfk_1` FOREIGN KEY (`id_statut_stagiaire`) REFERENCES `statut_stagiaire` (`id_statut_stagiaire`),
  ADD CONSTRAINT `stagiaire_ibfk_2` FOREIGN KEY (`id_groupe`) REFERENCES `groupe` (`id_groupe`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
