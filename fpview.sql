-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 17 avr. 2023 à 07:41
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `fpview`
--

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

DROP TABLE IF EXISTS `image`;
CREATE TABLE IF NOT EXISTS `image` (
  `id` int DEFAULT NULL,
  `map_id` int DEFAULT NULL,
  `path` varchar(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `image`
--

INSERT INTO `image` (`id`, `map_id`, `path`) VALUES
(3, 1, '01-0.jpg'),
(4, 2, '01-90.jpg'),
(5, 3, '01-180.jpg'),
(6, 4, '01-270.jpg'),
(7, 5, '11-0.jpg'),
(8, 6, '11-90.jpg'),
(9, 7, '11-180.jpg'),
(10, 8, '11-270.jpg'),
(11, 9, '10-0.jpg'),
(12, 10, '10-90.jpg'),
(13, 11, '10-180.jpg'),
(14, 12, '10-270.jpg'),
(15, 13, '12-0.jpg'),
(16, 14, '12-90.jpg'),
(17, 15, '12-180.jpg'),
(18, 16, '12-270.jpg'),
(19, 14, '12-90-1.jpg'),
(20, 3, '01-180.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `map`
--

DROP TABLE IF EXISTS `map`;
CREATE TABLE IF NOT EXISTS `map` (
  `id` int DEFAULT NULL,
  `coordx` int DEFAULT NULL,
  `coordy` int DEFAULT NULL,
  `direction` int DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `map`
--

INSERT INTO `map` (`id`, `coordx`, `coordy`, `direction`) VALUES
(1, 0, 1, 0),
(2, 0, 1, 90),
(3, 0, 1, 180),
(4, 0, 1, 270),
(5, 1, 1, 0),
(6, 1, 1, 90),
(7, 1, 1, 180),
(8, 1, 1, 270),
(9, 1, 0, 0),
(10, 1, 0, 90),
(11, 1, 0, 180),
(12, 1, 0, 270),
(13, 1, 2, 0),
(14, 1, 2, 90),
(15, 1, 2, 180),
(16, 1, 2, 270);

-- --------------------------------------------------------

--
-- Structure de la table `text`
--

DROP TABLE IF EXISTS `text`;
CREATE TABLE IF NOT EXISTS `text` (
  `id` int DEFAULT NULL,
  `map_id` int DEFAULT NULL,
  `text` varchar(96) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `text`
--

INSERT INTO `text` (`id`, `map_id`, `text`) VALUES
(1, 1, 'Je dois trouver une clé pour sortir d\'ici...'),
(2, 2, 'Un mur m\'empêche de passer...'),
(3, 3, 'Je dois trouver une clé pour sortir d\'ici...'),
(7, 9, 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium'),
(6, 4, 'Rien par ici'),
(11, 14, 'Voici un bien joli vase !'),
(8, 10, 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium'),
(9, 11, 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium'),
(10, 12, 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
