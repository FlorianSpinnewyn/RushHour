-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  lun. 25 mai 2020 à 08:19
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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
