-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mer. 27 mai 2020 à 22:47
-- Version du serveur :  5.7.17
-- Version de PHP :  5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projet`
--

-- --------------------------------------------------------

--
-- Structure de la table `avatars`
--

CREATE TABLE `avatars` (
  `id` varchar(20) NOT NULL,
  `avatars` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `avatars`
--

INSERT INTO `avatars` (`id`, `avatars`) VALUES
('2', 'alex'),
('1', 'billy_ray'),
('8', 'breana'),
('3', 'daya'),
('7', 'horloge'),
('6', 'stig'),
('4', 'truck'),
('5', 'car');

-- --------------------------------------------------------

--
-- Structure de la table `classement`
--

CREATE TABLE `classement` (
  `idNiveau` int(11) NOT NULL,
  `placeJoueur` int(11) NOT NULL,
  `nomJoueur` varchar(30) NOT NULL,
  `nbreCoup` int(11) NOT NULL,
  `nbreEtoile` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `classement`
--

INSERT INTO `classement` (`idNiveau`, `placeJoueur`, `nomJoueur`, `nbreCoup`, `nbreEtoile`) VALUES
(1, 1, 'Player1', 20, 3),
(1, 2, 'Player2', 30, 2),
(1, 3, 'Player3', 40, 1),
(2, 1, 'Player1', 20, 3),
(2, 2, 'Player2', 30, 2),
(3, 1, 'Player1', 22, 3),
(3, 2, 'Player2', 32, 2),
(3, 3, 'Player3', 42, 1),
(4, 1, 'Player1', 28, 3),
(4, 2, 'Player2', 38, 2),
(4, 3, 'Player3', 48, 1),
(5, 1, 'Player1', 25, 3),
(5, 2, 'Player2', 35, 2),
(5, 3, 'Player3', 45, 1),
(6, 1, 'Player1', 23, 3),
(6, 2, 'Player2', 33, 2),
(6, 3, 'Player3', 43, 1),
(7, 1, 'Player1', 45, 3),
(7, 2, 'Player2', 55, 2),
(7, 3, 'Player3', 65, 1),
(8, 1, 'Player1', 25, 3),
(8, 2, 'Player2', 35, 2),
(8, 3, 'Player3', 45, 1),
(9, 1, 'Player1', 27, 3),
(9, 2, 'Player2', 37, 2),
(9, 3, 'Player3', 47, 1),
(10, 1, 'Player1', 27, 3),
(10, 2, 'Player2', 37, 2),
(10, 3, 'Player3', 47, 1),
(11, 1, 'Player1', 25, 3),
(11, 2, 'Player2', 35, 2),
(11, 3, 'Player3', 45, 1),
(12, 1, 'Player1', 22, 3),
(12, 2, 'Player2', 32, 2),
(12, 3, 'Player3', 42, 1),
(13, 1, 'Player1', 33, 3),
(14, 1, 'Player1', 27, 3),
(14, 2, 'Player2', 37, 2),
(14, 3, 'Player3', 47, 1),
(15, 1, 'Player1', 25, 3),
(15, 2, 'Player2', 35, 2),
(15, 3, 'Player3', 45, 1),
(16, 1, 'Player1', 31, 3),
(16, 2, 'Player2', 41, 2),
(16, 3, 'Player3', 51, 1),
(17, 1, 'Player1', 31, 3),
(17, 2, 'Player2', 41, 2),
(17, 3, 'Player3', 51, 1),
(18, 1, 'Player1', 35, 3),
(18, 2, 'Player2', 45, 2),
(18, 3, 'Player3', 55, 1),
(19, 1, 'Player1', 32, 3),
(19, 2, 'Player2', 42, 2),
(19, 3, 'Player3', 52, 1),
(10, 1, 'Player1', 24, 3),
(20, 2, 'Player2', 34, 2),
(20, 3, 'Player3', 44, 1),
(21, 1, 'Player1', 42, 3),
(21, 2, 'Player2', 52, 2),
(21, 3, 'Player3', 62, 1),
(22, 1, 'Player1', 46, 3),
(22, 2, 'Player2', 56, 2),
(22, 3, 'Player3', 66, 1),
(23, 1, 'Player1', 41, 3),
(23, 2, 'Player2', 51, 2),
(23, 3, 'Player3', 61, 1),
(24, 1, 'Player1', 28, 3),
(24, 2, 'Player2', 38, 2),
(24, 3, 'Player3', 48, 1),
(25, 1, 'Player1', 48, 3),
(25, 2, 'Player2', 58, 2),
(25, 3, 'Player3', 68, 1),
(26, 1, 'Player1', 37, 3),
(26, 2, 'Player2', 47, 2),
(26, 3, 'Player3', 57, 1),
(27, 1, 'Player1', 37, 3),
(27, 2, 'Player2', 47, 2),
(27, 3, 'Player3', 57, 1),
(28, 1, 'Player1', 46, 3),
(28, 2, 'Player2', 56, 2),
(28, 3, 'Player3', 66, 1),
(29, 1, 'Player1', 42, 3),
(29, 2, 'Player2', 52, 2),
(29, 3, 'Player3', 62, 1),
(30, 1, 'Player1', 39, 3),
(30, 2, 'Player2', 49, 2),
(30, 3, 'Player3', 59, 1),
(31, 1, 'Player1', 61, 3),
(31, 2, 'Player2', 71, 2),
(31, 3, 'Player3', 81, 1),
(32, 1, 'Player1', 52, 3),
(32, 2, 'Player2', 62, 2),
(32, 3, 'Player3', 72, 1),
(33, 1, 'Player1', 58, 3),
(33, 2, 'Player2', 68, 2),
(33, 3, 'Player3', 78, 1),
(34, 1, 'Player1', 69, 3),
(34, 2, 'Player2', 79, 2),
(34, 3, 'Player3', 89, 1),
(35, 1, 'Player1', 37, 3),
(35, 2, 'Player2', 47, 2),
(35, 3, 'Player3', 57, 1),
(36, 1, 'Player1', 49, 3),
(36, 2, 'Player2', 59, 2),
(36, 3, 'Player3', 69, 1),
(37, 1, 'Player1', 55, 3),
(37, 2, 'Player2', 65, 2),
(37, 3, 'Player3', 75, 1),
(38, 1, 'Player1', 56, 3),
(38, 2, 'Player2', 66, 2),
(38, 3, 'Player3', 76, 1),
(39, 1, 'Player1', 67, 3),
(39, 2, 'Player2', 77, 2),
(39, 3, 'Player3', 87, 1),
(40, 1, 'Player1', 62, 3),
(40, 2, 'Player2', 72, 2),
(40, 3, 'Player3', 82, 1),
(13, 3, 'Player3', 53, 1),
(13, 2, 'Player2', 43, 2),
(2, 3, 'Player3', 40, 1);

-- --------------------------------------------------------

--
-- Structure de la table `jeu`
--

CREATE TABLE `jeu` (
  `ref` int(11) NOT NULL,
  `NiveauJeu` varchar(100) NOT NULL,
  `Minimum` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `jeu`
--

INSERT INTO `jeu` (`ref`, `NiveauJeu`, `Minimum`) VALUES
(1, 'beginner', 11),
(2, 'beginner', 11),
(3, 'beginner', 13),
(4, 'beginner', 19),
(5, 'beginner', 16),
(6, 'beginner', 14),
(7, 'beginner', 36),
(8, 'beginner', 16),
(9, 'beginner', 18),
(10, 'beginner', 18),
(11, 'intermediate', 15),
(12, 'intermediate', 13),
(13, 'intermediate', 24),
(14, 'intermediate', 18),
(15, 'intermediate', 16),
(16, 'intermediate', 22),
(17, 'intermediate', 22),
(18, 'intermediate', 26),
(19, 'intermediate', 23),
(20, 'intermediate', 15),
(21, 'advanced', 33),
(22, 'advanced', 37),
(23, 'advanced', 32),
(24, 'advanced', 19),
(25, 'advanced', 39),
(26, 'advanced', 28),
(27, 'advanced', 28),
(28, 'advanced', 37),
(29, 'advanced', 33),
(30, 'advanced', 30),
(31, 'expert', 52),
(32, 'expert', 43),
(33, 'expert', 49),
(34, 'expert', 60),
(35, 'expert', 28),
(36, 'expert', 40),
(37, 'expert', 46),
(38, 'expert', 47),
(39, 'expert', 58),
(40, 'expert', 53);

-- --------------------------------------------------------

--
-- Structure de la table `joueurs`
--

CREATE TABLE `joueurs` (
  `pseudo` varchar(20) NOT NULL,
  `mdp` varchar(50) NOT NULL,
  `avatar` varchar(20) NOT NULL,
  `voitureRouge` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `niveau_cree`
--

CREATE TABLE `niveau_cree` (
  `idNiveau` int(11) NOT NULL,
  `nomNiveau` varchar(30) NOT NULL,
  `difficulté` varchar(20) NOT NULL,
  `nomJoueur` varchar(30) NOT NULL,
  `lettre_vehicule` varchar(1) NOT NULL,
  `taille_vehicule` int(11) NOT NULL,
  `coord_ligne` int(11) NOT NULL,
  `coord_colonne` int(11) NOT NULL,
  `orientation` char(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `niveau_en_cours`
--

CREATE TABLE `niveau_en_cours` (
  `idNiveau` int(11) NOT NULL,
  `difficulté` varchar(20) NOT NULL,
  `lettre_vehicule` varchar(1) NOT NULL,
  `taille_vehicule` int(11) NOT NULL,
  `coord_ligne` int(11) NOT NULL,
  `coord_colonne` int(11) NOT NULL,
  `orientation` char(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `niveau_predefini_difficile`
--

CREATE TABLE `niveau_predefini_difficile` (
  `idNiveau` int(11) NOT NULL,
  `difficulté` varchar(20) NOT NULL,
  `lettre_vehicule` varchar(1) NOT NULL,
  `taille_vehicule` int(11) NOT NULL,
  `coord_ligne` int(11) NOT NULL,
  `coord_colonne` int(11) NOT NULL,
  `orientation` char(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `niveau_predefini_difficile`
--

INSERT INTO `niveau_predefini_difficile` (`idNiveau`, `difficulté`, `lettre_vehicule`, `taille_vehicule`, `coord_ligne`, `coord_colonne`, `orientation`) VALUES
(21, 'difficile', 'A', 2, 2, 2, 'D'),
(21, 'difficile', 'D', 2, 3, 4, 'L'),
(21, 'difficile', 'G', 2, 5, 3, 'U'),
(21, 'difficile', 'O', 3, 0, 4, 'D'),
(21, 'difficile', 'P', 3, 1, 1, 'R'),
(21, 'difficile', 'Q', 3, 4, 0, 'R'),
(21, 'difficile', 'X', 2, 2, 1, 'L'),
(22, 'difficile', 'A', 2, 0, 3, 'R'),
(22, 'difficile', 'C', 2, 2, 2, 'D'),
(22, 'difficile', 'G', 2, 2, 4, 'U'),
(22, 'difficile', 'J', 2, 3, 4, 'R'),
(22, 'difficile', 'O', 3, 2, 5, 'U'),
(22, 'difficile', 'P', 3, 1, 1, 'R'),
(22, 'difficile', 'Q', 3, 2, 3, 'D'),
(22, 'difficile', 'R', 3, 4, 2, 'L'),
(22, 'difficile', 'X', 2, 2, 1, 'L'),
(25, 'difficile', 'X', 2, 2, 4, 'L'),
(23, 'difficile', 'A', 2, 3, 0, 'R'),
(23, 'difficile', 'B', 2, 3, 4, 'L'),
(23, 'difficile', 'C', 2, 4, 3, 'D'),
(23, 'difficile', 'D', 2, 4, 4, 'D'),
(23, 'difficile', 'O', 3, 4, 2, 'U'),
(23, 'difficile', 'P', 3, 3, 5, 'D'),
(23, 'difficile', 'Q', 3, 5, 2, 'L'),
(23, 'difficile', 'X', 2, 2, 1, 'L'),
(24, 'difficile', 'A', 2, 0, 0, 'D'),
(24, 'difficile', 'D', 2, 3, 2, 'U'),
(24, 'difficile', 'E', 2, 3, 4, 'L'),
(24, 'difficile', 'F', 2, 4, 5, 'U'),
(24, 'difficile', 'G', 2, 5, 2, 'U'),
(24, 'difficile', 'H', 2, 4, 1, 'D'),
(24, 'difficile', 'I', 2, 5, 4, 'R'),
(24, 'difficile', 'J', 2, 1, 1, 'R'),
(24, 'difficile', 'O', 3, 0, 3, 'D'),
(24, 'difficile', 'X', 2, 2, 1, 'L'),
(24, 'difficile', 'C', 2, 2, 5, 'U'),
(25, 'difficile', 'A', 2, 1, 1, 'L'),
(25, 'difficile', 'C', 2, 4, 4, 'R'),
(25, 'difficile', 'D', 2, 4, 3, 'U'),
(25, 'difficile', 'O', 3, 0, 2, 'D'),
(25, 'difficile', 'P', 3, 3, 5, 'U'),
(25, 'difficile', 'Q', 3, 3, 0, 'R'),
(26, 'difficile', 'A', 2, 3, 4, 'L'),
(26, 'difficile', 'B', 2, 0, 2, 'D'),
(26, 'difficile', 'C', 2, 2, 3, 'U'),
(26, 'difficile', 'D', 2, 2, 4, 'U'),
(26, 'difficile', 'E', 2, 3, 2, 'L'),
(26, 'difficile', 'K', 2, 1, 1, 'U'),
(26, 'difficile', 'O', 3, 2, 0, 'U'),
(26, 'difficile', 'P', 3, 0, 5, 'L'),
(26, 'difficile', 'Q', 3, 1, 5, 'D'),
(26, 'difficile', 'X', 2, 2, 2, 'L'),
(27, 'difficile', 'A', 2, 0, 3, 'D'),
(27, 'difficile', 'H', 2, 2, 2, 'U'),
(27, 'difficile', 'I', 2, 2, 3, 'D'),
(27, 'difficile', 'J', 2, 3, 1, 'R'),
(27, 'difficile', 'O', 3, 0, 0, 'R'),
(27, 'difficile', 'P', 3, 5, 0, 'U'),
(27, 'difficile', 'Q', 3, 5, 3, 'L'),
(27, 'difficile', 'X', 2, 2, 1, 'L'),
(28, 'difficile', 'A', 2, 0, 2, 'D'),
(28, 'difficile', 'C', 2, 1, 1, 'L'),
(28, 'difficile', 'D', 2, 4, 1, 'R'),
(28, 'difficile', 'E', 2, 4, 4, 'D'),
(28, 'difficile', 'G', 2, 0, 5, 'L'),
(28, 'difficile', 'H', 2, 5, 5, 'U'),
(28, 'difficile', 'O', 3, 2, 3, 'U'),
(28, 'difficile', 'P', 3, 2, 0, 'D'),
(28, 'difficile', 'Q', 3, 3, 3, 'R'),
(28, 'difficile', 'X', 2, 2, 2, 'L'),
(29, 'difficile', 'A', 2, 4, 4, 'D'),
(29, 'difficile', 'B', 2, 1, 0, 'U'),
(29, 'difficile', 'C', 2, 0, 4, 'R'),
(29, 'difficile', 'D', 2, 1, 1, 'R'),
(29, 'difficile', 'E', 2, 3, 4, 'L'),
(29, 'difficile', 'G', 2, 0, 3, 'D'),
(29, 'difficile', 'O', 3, 1, 5, 'D'),
(29, 'difficile', 'P', 3, 4, 2, 'U'),
(29, 'difficile', 'Q', 3, 5, 1, 'R'),
(29, 'difficile', 'X', 2, 2, 1, 'L'),
(30, 'difficile', 'A', 2, 1, 1, 'U'),
(30, 'difficile', 'B', 2, 0, 2, 'R'),
(30, 'difficile', 'C', 2, 1, 2, 'D'),
(30, 'difficile', 'D', 2, 2, 3, 'U'),
(30, 'difficile', 'F', 2, 3, 2, 'D'),
(30, 'difficile', 'G', 2, 3, 4, 'L'),
(30, 'difficile', 'H', 2, 5, 3, 'U'),
(30, 'difficile', 'I', 2, 5, 1, 'R'),
(30, 'difficile', 'J', 2, 4, 1, 'U'),
(30, 'difficile', 'O', 3, 2, 4, 'U'),
(30, 'difficile', 'P', 3, 3, 0, 'D'),
(30, 'difficile', 'X', 2, 2, 1, 'L');

-- --------------------------------------------------------

--
-- Structure de la table `niveau_predefini_expert`
--

CREATE TABLE `niveau_predefini_expert` (
  `idNiveau` int(11) NOT NULL,
  `difficulté` varchar(20) NOT NULL,
  `lettre_vehicule` varchar(1) NOT NULL,
  `taille_vehicule` int(11) NOT NULL,
  `coord_ligne` int(11) NOT NULL,
  `coord_colonne` int(11) NOT NULL,
  `orientation` char(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `niveau_predefini_expert`
--

INSERT INTO `niveau_predefini_expert` (`idNiveau`, `difficulté`, `lettre_vehicule`, `taille_vehicule`, `coord_ligne`, `coord_colonne`, `orientation`) VALUES
(31, 'expert', 'D', 2, 0, 0, 'R'),
(31, 'expert', 'G', 2, 1, 2, 'U'),
(31, 'expert', 'O', 3, 2, 3, 'U'),
(31, 'expert', 'P', 3, 3, 0, 'U'),
(31, 'expert', 'Q', 3, 3, 1, 'R'),
(31, 'expert', 'R', 3, 5, 0, 'R'),
(31, 'expert', 'X', 2, 2, 2, 'L'),
(39, 'expert', 'X', 2, 2, 1, 'L'),
(39, 'expert', 'Q', 3, 3, 5, 'D'),
(39, 'expert', 'P', 3, 3, 0, 'D'),
(39, 'expert', 'O', 3, 2, 3, 'U'),
(32, 'expert', 'X', 2, 2, 4, 'L'),
(32, 'expert', 'Q', 3, 3, 5, 'L'),
(32, 'expert', 'P', 3, 2, 5, 'U'),
(32, 'expert', 'O', 3, 0, 2, 'D'),
(32, 'expert', 'G', 2, 5, 4, 'R'),
(32, 'expert', 'F', 2, 5, 1, 'R'),
(32, 'expert', 'E', 2, 4, 4, 'R'),
(32, 'expert', 'D', 2, 4, 3, 'D'),
(34, 'expert', 'X', 2, 2, 4, 'L'),
(34, 'expert', 'Q', 3, 3, 3, 'D'),
(34, 'expert', 'P', 3, 2, 5, 'D'),
(34, 'expert', 'O', 3, 2, 2, 'U'),
(34, 'expert', 'J', 2, 4, 1, 'D'),
(34, 'expert', 'C', 2, 5, 4, 'R'),
(34, 'expert', 'A', 2, 3, 2, 'L'),
(33, 'expert', 'A', 2, 2, 3, 'U'),
(33, 'expert', 'H', 2, 1, 4, 'R'),
(33, 'expert', 'O', 3, 0, 2, 'D'),
(33, 'expert', 'P', 3, 4, 5, 'U'),
(33, 'expert', 'Q', 3, 3, 2, 'R'),
(33, 'expert', 'R', 3, 5, 3, 'R'),
(33, 'expert', 'X', 2, 2, 1, 'L'),
(35, 'expert', 'A', 2, 1, 2, 'U'),
(35, 'expert', 'B', 2, 1, 0, 'D'),
(35, 'expert', 'C', 2, 2, 1, 'U'),
(35, 'expert', 'D', 2, 2, 4, 'U'),
(35, 'expert', 'E', 2, 1, 5, 'D'),
(35, 'expert', 'G', 2, 3, 2, 'L'),
(35, 'expert', 'H', 2, 3, 4, 'L'),
(35, 'expert', 'I', 2, 5, 0, 'R'),
(35, 'expert', 'K', 2, 3, 0, 'D'),
(35, 'expert', 'O', 3, 0, 5, 'L'),
(35, 'expert', 'Q', 3, 5, 2, 'R'),
(35, 'expert', 'P', 3, 3, 5, 'D'),
(35, 'expert', 'X', 2, 2, 3, 'L'),
(36, 'expert', 'A', 2, 1, 0, 'D'),
(36, 'expert', 'C', 2, 3, 0, 'R'),
(36, 'expert', 'D', 2, 4, 4, 'R'),
(36, 'expert', 'I', 2, 3, 2, 'U'),
(36, 'expert', 'O', 3, 1, 4, 'L'),
(36, 'expert', 'P', 3, 3, 5, 'U'),
(36, 'expert', 'Q', 3, 3, 3, 'D'),
(36, 'expert', 'R', 3, 5, 0, 'R'),
(36, 'expert', 'X', 2, 2, 4, 'L'),
(37, 'expert', 'A', 2, 0, 5, 'L'),
(37, 'expert', 'B', 2, 2, 4, 'U'),
(37, 'expert', 'C', 2, 2, 5, 'U'),
(37, 'expert', 'D', 2, 2, 2, 'D'),
(37, 'expert', 'E', 2, 3, 3, 'R'),
(37, 'expert', 'F', 2, 4, 5, 'U'),
(37, 'expert', 'O', 3, 2, 3, 'U'),
(37, 'expert', 'P', 3, 1, 0, 'R'),
(37, 'expert', 'Q', 3, 4, 4, 'L'),
(37, 'expert', 'X', 2, 2, 1, 'L'),
(32, 'expert', 'C', 2, 4, 1, 'R'),
(38, 'expert', 'C', 2, 2, 0, 'U'),
(38, 'expert', 'D', 2, 2, 3, 'U'),
(38, 'expert', 'E', 2, 4, 0, 'U'),
(38, 'expert', 'F', 2, 5, 2, 'U'),
(38, 'expert', 'G', 2, 4, 5, 'D'),
(38, 'expert', 'H', 2, 5, 4, 'L'),
(38, 'expert', 'K', 2, 1, 5, 'U'),
(38, 'expert', 'O', 3, 0, 2, 'R'),
(38, 'expert', 'P', 3, 2, 4, 'D'),
(38, 'expert', 'Q', 3, 3, 3, 'L'),
(38, 'expert', 'X', 2, 2, 2, 'L'),
(39, 'expert', 'A', 2, 1, 4, 'D'),
(39, 'expert', 'B', 2, 4, 1, 'U'),
(39, 'expert', 'C', 2, 3, 2, 'R'),
(39, 'expert', 'D', 2, 4, 4, 'U'),
(39, 'expert', 'E', 2, 5, 2, 'U'),
(39, 'expert', 'G', 2, 5, 3, 'R'),
(32, 'expert', 'B', 2, 1, 4, 'L'),
(32, 'expert', 'A', 2, 0, 4, 'L'),
(38, 'expert', 'A', 2, 0, 1, 'D'),
(40, 'expert', 'A', 2, 3, 2, 'U'),
(40, 'expert', 'B', 2, 3, 3, 'D'),
(40, 'expert', 'C', 2, 3, 4, 'R'),
(40, 'expert', 'D', 2, 4, 0, 'D'),
(40, 'expert', 'E', 2, 5, 2, 'U'),
(40, 'expert', 'F', 2, 4, 5, 'L'),
(40, 'expert', 'O', 3, 0, 0, 'R'),
(40, 'expert', 'P', 3, 2, 5, 'U'),
(40, 'expert', 'Q', 3, 5, 5, 'L'),
(40, 'expert', 'X', 2, 2, 4, 'L');

-- --------------------------------------------------------

--
-- Structure de la table `niveau_predefini_facile`
--

CREATE TABLE `niveau_predefini_facile` (
  `idNiveau` int(11) NOT NULL,
  `difficulté` varchar(20) NOT NULL,
  `lettre_vehicule` varchar(1) NOT NULL,
  `taille_vehicule` int(11) NOT NULL,
  `coord_ligne` int(11) NOT NULL,
  `coord_colonne` int(11) NOT NULL,
  `orientation` char(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `niveau_predefini_facile`
--

INSERT INTO `niveau_predefini_facile` (`idNiveau`, `difficulté`, `lettre_vehicule`, `taille_vehicule`, `coord_ligne`, `coord_colonne`, `orientation`) VALUES
(1, 'facile', 'Q', 3, 3, 1, 'R'),
(1, 'facile', 'P', 3, 5, 0, 'U'),
(1, 'facile', 'O', 3, 0, 3, 'D'),
(1, 'facile', 'X', 2, 2, 1, 'L'),
(2, 'facile', 'A', 2, 0, 0, 'D'),
(2, 'facile', 'B', 2, 0, 1, 'R'),
(2, 'facile', 'C', 2, 2, 2, 'U'),
(2, 'facile', 'O', 3, 2, 3, 'U'),
(2, 'facile', 'P', 3, 3, 3, 'L'),
(2, 'facile', 'X', 2, 2, 1, 'L'),
(3, 'facile', 'A', 2, 3, 2, 'U'),
(3, 'facile', 'B', 2, 2, 3, 'D'),
(3, 'facile', 'C', 2, 3, 4, 'R'),
(3, 'facile', 'O', 3, 0, 2, 'R'),
(3, 'facile', 'P', 3, 2, 5, 'U'),
(3, 'facile', 'Q', 3, 3, 0, 'D'),
(3, 'facile', 'R', 3, 5, 1, 'R'),
(3, 'facile', 'X', 2, 2, 1, 'L'),
(4, 'facile', 'D', 2, 0, 3, 'R'),
(4, 'facile', 'G', 2, 3, 5, 'L'),
(4, 'facile', 'O', 3, 2, 5, 'U'),
(4, 'facile', 'P', 3, 3, 3, 'D'),
(4, 'facile', 'X', 2, 2, 4, 'L'),
(5, 'facile', 'A', 2, 0, 3, 'L'),
(5, 'facile', 'B', 2, 0, 4, 'R'),
(5, 'facile', 'C', 2, 2, 2, 'U'),
(5, 'facile', 'D', 2, 1, 3, 'D'),
(5, 'facile', 'E', 2, 2, 4, 'U'),
(5, 'facile', 'F', 2, 1, 5, 'D'),
(5, 'facile', 'G', 2, 3, 3, 'L'),
(5, 'facile', 'H', 2, 3, 4, 'R'),
(5, 'facile', 'X', 2, 2, 1, 'L'),
(6, 'facile', 'O', 3, 2, 2, 'U'),
(6, 'facile', 'P', 3, 3, 5, 'D'),
(6, 'facile', 'Q', 3, 5, 2, 'L'),
(6, 'facile', 'X', 2, 2, 1, 'L'),
(7, 'facile', 'A', 2, 3, 5, 'L'),
(7, 'facile', 'C', 2, 5, 5, 'L'),
(7, 'facile', 'D', 2, 4, 4, 'R'),
(7, 'facile', 'O', 3, 2, 4, 'U'),
(7, 'facile', 'P', 3, 0, 5, 'D'),
(7, 'facile', 'Q', 3, 3, 2, 'D'),
(7, 'facile', 'R', 3, 5, 3, 'U'),
(7, 'facile', 'X', 2, 2, 3, 'L'),
(8, 'facile', 'O', 3, 0, 2, 'L'),
(8, 'facile', 'P', 3, 1, 2, 'D'),
(8, 'facile', 'Q', 3, 3, 5, 'D'),
(8, 'facile', 'R', 3, 4, 2, 'L'),
(8, 'facile', 'X', 2, 2, 1, 'L'),
(9, 'facile', 'A', 2, 3, 2, 'U'),
(9, 'facile', 'C', 2, 3, 4, 'R'),
(9, 'facile', 'D', 2, 4, 2, 'D'),
(9, 'facile', 'J', 2, 3, 3, 'D'),
(9, 'facile', 'O', 3, 0, 0, 'R'),
(9, 'facile', 'P', 3, 2, 5, 'U'),
(9, 'facile', 'Q', 3, 5, 5, 'L'),
(9, 'facile', 'X', 2, 2, 1, 'L'),
(10, 'facile', 'A', 2, 2, 2, 'U'),
(10, 'facile', 'C', 2, 4, 4, 'L'),
(10, 'facile', 'D', 2, 5, 5, 'U'),
(10, 'facile', 'G', 2, 4, 2, 'L'),
(10, 'facile', 'O', 3, 0, 0, 'R'),
(10, 'facile', 'P', 3, 0, 3, 'D'),
(10, 'facile', 'Q', 3, 3, 0, 'D'),
(10, 'facile', 'X', 2, 2, 1, 'L');

-- --------------------------------------------------------

--
-- Structure de la table `niveau_predefini_intermediaire`
--

CREATE TABLE `niveau_predefini_intermediaire` (
  `idNiveau` int(11) NOT NULL,
  `difficulté` varchar(20) NOT NULL,
  `lettre_vehicule` varchar(1) NOT NULL,
  `taille_vehicule` int(11) NOT NULL,
  `coord_ligne` int(11) NOT NULL,
  `coord_colonne` int(11) NOT NULL,
  `orientation` char(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `niveau_predefini_intermediaire`
--

INSERT INTO `niveau_predefini_intermediaire` (`idNiveau`, `difficulté`, `lettre_vehicule`, `taille_vehicule`, `coord_ligne`, `coord_colonne`, `orientation`) VALUES
(11, 'intermediaire', 'X', 2, 2, 1, 'L'),
(11, 'intermediaire', 'A', 2, 0, 3, 'D'),
(11, 'intermediaire', 'C', 2, 3, 0, 'D'),
(11, 'intermediaire', 'D', 2, 3, 3, 'R'),
(11, 'intermediaire', 'E', 2, 4, 5, 'U'),
(11, 'intermediaire', 'F', 2, 4, 2, 'L'),
(11, 'intermediaire', 'G', 2, 4, 3, 'D'),
(11, 'intermediaire', 'I', 2, 5, 4, 'R'),
(11, 'intermediaire', 'K', 2, 2, 2, 'D'),
(11, 'intermediaire', 'O', 3, 1, 0, 'R'),
(13, 'intermediaire', 'Q', 3, 5, 5, 'U'),
(13, 'intermediaire', 'P', 3, 3, 0, 'R'),
(13, 'intermediaire', 'O', 3, 0, 2, 'D'),
(12, 'intermediaire', 'X', 2, 2, 1, 'L'),
(12, 'intermediaire', 'R', 3, 5, 3, 'R'),
(12, 'intermediaire', 'Q', 3, 5, 2, 'U'),
(12, 'intermediaire', 'P', 3, 3, 5, 'U'),
(12, 'intermediaire', 'O', 3, 0, 3, 'R'),
(12, 'intermediaire', 'D', 2, 4, 3, 'R'),
(12, 'intermediaire', 'C', 2, 3, 4, 'L'),
(12, 'intermediaire', 'B', 2, 2, 4, 'U'),
(12, 'intermediaire', 'A', 2, 1, 3, 'D'),
(13, 'intermediaire', 'R', 3, 4, 2, 'L'),
(13, 'intermediaire', 'X', 2, 2, 1, 'L'),
(14, 'intermediaire', 'A', 2, 0, 3, 'R'),
(14, 'intermediaire', 'G', 2, 5, 2, 'L'),
(14, 'intermediaire', 'H', 2, 1, 3, 'D'),
(14, 'intermediaire', 'O', 3, 0, 5, 'D'),
(14, 'intermediaire', 'P', 3, 2, 2, 'D'),
(14, 'intermediaire', 'Q', 3, 5, 0, 'U'),
(14, 'intermediaire', 'R', 3, 3, 3, 'R'),
(14, 'intermediaire', 'X', 2, 2, 1, 'L'),
(15, 'intermediaire', 'A', 2, 0, 3, 'D'),
(15, 'intermediaire', 'B', 2, 0, 4, 'R'),
(15, 'intermediaire', 'C', 2, 2, 5, 'U'),
(15, 'intermediaire', 'D', 2, 3, 5, 'D'),
(15, 'intermediaire', 'O', 3, 2, 2, 'U'),
(15, 'intermediaire', 'P', 3, 3, 4, 'L'),
(15, 'intermediaire', 'X', 2, 2, 4, 'L'),
(16, 'intermediaire', 'G', 2, 0, 3, 'D'),
(16, 'intermediaire', 'J', 2, 0, 4, 'R'),
(16, 'intermediaire', 'O', 3, 0, 2, 'D'),
(16, 'intermediaire', 'P', 3, 1, 5, 'D'),
(16, 'intermediaire', 'Q', 3, 3, 2, 'R'),
(16, 'intermediaire', 'X', 2, 2, 1, 'L'),
(17, 'intermediaire', 'A', 2, 0, 0, 'D'),
(17, 'intermediaire', 'D', 2, 4, 5, 'D'),
(17, 'intermediaire', 'I', 2, 1, 3, 'U'),
(17, 'intermediaire', 'K', 2, 0, 1, 'R'),
(17, 'intermediaire', 'O', 3, 4, 2, 'U'),
(17, 'intermediaire', 'P', 3, 3, 5, 'L'),
(17, 'intermediaire', 'Q', 3, 5, 4, 'L'),
(17, 'intermediaire', 'X', 2, 2, 1, 'L'),
(18, 'intermediaire', 'A', 2, 5, 2, 'U'),
(18, 'intermediaire', 'H', 2, 4, 3, 'R'),
(18, 'intermediaire', 'O', 3, 0, 1, 'D'),
(18, 'intermediaire', 'P', 3, 3, 4, 'U'),
(18, 'intermediaire', 'Q', 3, 3, 0, 'R'),
(18, 'intermediaire', 'X', 2, 2, 3, 'L'),
(20, 'intermediaire', 'Q', 3, 5, 5, 'U'),
(20, 'intermediaire', 'P', 3, 0, 3, 'R'),
(20, 'intermediaire', 'O', 3, 0, 2, 'D'),
(20, 'intermediaire', 'C', 2, 3, 1, 'R'),
(20, 'intermediaire', 'A', 2, 2, 5, 'U'),
(19, 'intermediaire', 'X', 2, 2, 1, 'L'),
(19, 'intermediaire', 'P', 3, 0, 5, 'D'),
(19, 'intermediaire', 'O', 3, 2, 2, 'U'),
(19, 'intermediaire', 'I', 2, 5, 4, 'R'),
(19, 'intermediaire', 'H', 2, 5, 2, 'R'),
(19, 'intermediaire', 'G', 2, 4, 5, 'L'),
(19, 'intermediaire', 'F', 2, 4, 3, 'L'),
(19, 'intermediaire', 'E', 2, 3, 5, 'L'),
(19, 'intermediaire', 'D', 2, 3, 3, 'L'),
(19, 'intermediaire', 'C', 2, 2, 4, 'U'),
(19, 'intermediaire', 'B', 2, 1, 3, 'D'),
(19, 'intermediaire', 'A', 2, 0, 3, 'R'),
(20, 'intermediaire', 'R', 3, 5, 4, 'L'),
(20, 'intermediaire', 'X', 2, 2, 1, 'L');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `avatars`
--
ALTER TABLE `avatars`
  ADD UNIQUE KEY `id` (`id`);

--
-- Index pour la table `jeu`
--
ALTER TABLE `jeu`
  ADD PRIMARY KEY (`ref`),
  ADD UNIQUE KEY `ref` (`ref`);

--
-- Index pour la table `joueurs`
--
ALTER TABLE `joueurs`
  ADD PRIMARY KEY (`pseudo`),
  ADD UNIQUE KEY `pseudo` (`pseudo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
