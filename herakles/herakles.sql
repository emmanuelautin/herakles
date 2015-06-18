-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 11 Juin 2015 à 17:28
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `herakles`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_category` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- Contenu de la table `category`
--

INSERT INTO `category` (`id`, `name_category`) VALUES
(2, 'compléments alimentaires'),
(4, 'vitamines'),
(7, 'boissons énérgetiques'),
(10, 'Soins articulaires'),
(11, 'En-cas hyperprotéinés'),
(12, 'Brûleurs de graisse '),
(13, ' Draineurs - Diurétiques '),
(14, 'antioxydants-omega3'),
(15, 'Soins et blessures'),
(16, 'Barres énérgétiques');

-- --------------------------------------------------------

--
-- Structure de la table `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `manager` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `raison_sociale` varchar(255) NOT NULL,
  `rue` varchar(255) NOT NULL,
  `code_postale` mediumint(9) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `contact_tel` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `customer`
--

INSERT INTO `customer` (`id`, `raison_sociale`, `rue`, `code_postale`, `ville`, `contact`, `contact_tel`) VALUES
(1, 'Autin Emmanuel', '2 avenue de stalingrad', 91120, 'Palaiseau', 'emmanuel.autin@gmail.com', '0603482846'),
(2, 'Letort Erwan', '11 rue de la rapée', 75013, 'Paris', 'erwan.letort@ip-formation.com', '0245854575'),
(3, 'Patcik Goldino', '54 rue Alphonse Daudet', 77000, 'Fontainebleau', 'Goldino@glodino.fr', '0245854575'),
(5, 'Mme Martine Autin', '4 rue de la Bretonnerie', 35000, 'Saint Malo', 'martine.autin@hotmail.fr', '0603482846'),
(7, 'Mr Robert NewMan', '2 rue de paris', 91300, 'Massy Palaiseau', 'robet.newman@esport.fr', '0245854575'),
(8, 'Elmut Ramoucho', '2 rue de la tourmente', 43000, 'Les Estables', 'e.ramoucho@contactis.fr', '0245854575'),
(9, 'Albert Enstein', '5 rue de la paroisse', 91120, 'Palaiseau', 'Albert@enstein.fr', '0452454778'),
(10, 'Remi Sanchezi', '2 avenue de la reine', 35200, 'Gamarec', 'sanchez@paramount.fr', '0245854575');

-- --------------------------------------------------------

--
-- Structure de la table `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_customer` int(255) NOT NULL,
  `date_add` datetime NOT NULL,
  `date_edit` datetime NOT NULL,
  `id_status` int(255) NOT NULL,
  `version` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=40 ;

--
-- Contenu de la table `order`
--

INSERT INTO `order` (`id`, `id_customer`, `date_add`, `date_edit`, `id_status`, `version`) VALUES
(36, 3, '2015-06-10 09:39:20', '2015-06-10 09:41:44', 5, 3),
(37, 8, '2015-06-10 10:13:24', '2015-06-10 10:13:24', 1, 0),
(38, 8, '2015-06-10 10:21:46', '2015-06-10 10:21:46', 1, 0),
(39, 5, '2015-06-11 12:48:19', '2015-06-11 12:48:19', 1, 0);

--
-- Déclencheurs `order`
--
DROP TRIGGER IF EXISTS `before_update_order`;
DELIMITER //
CREATE TRIGGER `before_update_order` BEFORE UPDATE ON `order`
 FOR EACH ROW BEGIN
    SET NEW.version = OLD.version + 1;
    INSERT INTO `order_histo`
      (id_order_original, id_customer, date_add, date_edit, id_status, action, date_action, version)
    VALUES
      (OLD.id, OLD.id_customer, OLD.date_add, OLD.date_edit, OLD.id_status,'update', NOW(), OLD.version);
  END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `order_histo`
--

CREATE TABLE IF NOT EXISTS `order_histo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_order_original` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `date_add` datetime NOT NULL,
  `date_edit` datetime NOT NULL,
  `id_status` int(11) NOT NULL,
  `action` enum('update','delete','create','') DEFAULT NULL,
  `date_action` datetime DEFAULT NULL,
  `version` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Contenu de la table `order_histo`
--

INSERT INTO `order_histo` (`id`, `id_order_original`, `id_customer`, `date_add`, `date_edit`, `id_status`, `action`, `date_action`, `version`) VALUES
(34, 36, 3, '2015-06-10 09:39:20', '2015-06-10 09:39:20', 1, 'update', '2015-06-10 09:39:38', 0),
(35, 36, 3, '2015-06-10 09:39:20', '2015-06-10 09:39:38', 1, 'update', '2015-06-10 09:39:59', 1),
(36, 36, 3, '2015-06-10 09:39:20', '2015-06-10 09:39:59', 1, 'update', '2015-06-10 09:41:44', 2);

-- --------------------------------------------------------

--
-- Structure de la table `order_product`
--

CREATE TABLE IF NOT EXISTS `order_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_order` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `version` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_order` (`id_order`,`id_product`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=172 ;

--
-- Contenu de la table `order_product`
--

INSERT INTO `order_product` (`id`, `id_order`, `id_product`, `quantity`, `version`) VALUES
(162, 36, 1, 5, 3),
(163, 36, 10, 20, 3),
(164, 36, 12, 12, 3),
(165, 36, 8, 120, 2),
(166, 37, 7, 10, 0),
(167, 37, 11, 12, 0),
(168, 38, 7, 5, 0),
(169, 38, 12, 30, 0),
(170, 39, 7, 5, 0),
(171, 39, 12, 10, 0);

--
-- Déclencheurs `order_product`
--
DROP TRIGGER IF EXISTS `before_update_order_product`;
DELIMITER //
CREATE TRIGGER `before_update_order_product` BEFORE UPDATE ON `order_product`
 FOR EACH ROW BEGIN
    SET NEW.version = OLD.version + 1;
     INSERT INTO `order_product_histo`
    (id_order,id_product,quantity,version)
    VALUES
    (OLD.id_order, OLD.id_product, OLD.quantity,OLD.version);
 	END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `order_product_histo`
--

CREATE TABLE IF NOT EXISTS `order_product_histo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_order` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `version` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=81 ;

--
-- Contenu de la table `order_product_histo`
--

INSERT INTO `order_product_histo` (`id`, `id_order`, `id_product`, `quantity`, `version`) VALUES
(70, 36, 1, 5, 0),
(71, 36, 10, 20, 0),
(72, 36, 12, 12, 0),
(73, 36, 1, 5, 1),
(74, 36, 8, 12, 0),
(75, 36, 10, 20, 1),
(76, 36, 12, 12, 1),
(77, 36, 1, 5, 2),
(78, 36, 8, 120, 1),
(79, 36, 10, 20, 2),
(80, 36, 12, 12, 2);

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_product` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `description` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `id_type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Contenu de la table `product`
--

INSERT INTO `product` (`id`, `name_product`, `price`, `stock`, `description`, `id_type`) VALUES
(1, 'magnesium', 50, 10000, 'Complément alimentaire magnésium', 10),
(4, 'Energistar', 35, 100, 'Boisson energisante', 7),
(7, 'Maltodextrine Bio ', 14, 50, 'Produit issu de l’agriculture biologique Augmente vos réserves énergétiques  Améliore votre endurance', 7),
(8, 'Mega Glucosamine ', 9, 120, 'Préserve vos articulations Formule très concentrée', 10),
(9, 'Ceinture Lombaire', 40, 10, ' Synthétique avec ceinture d’appoint', 15),
(10, 'Barre Natural Energy [PowerBar]', 6, 1000, 'Barre énergétique à base d’ingrédients naturels, riche en céréales et flocons d’avoine', 16),
(11, 'Barre chocolat vivastar', 5, 500, 'Produit énergétique', 16),
(12, 'pilule power nutriment', 2, 1000, 'apporte magnésium et phosphore.', 2);

-- --------------------------------------------------------

--
-- Structure de la table `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Contenu de la table `status`
--

INSERT INTO `status` (`id`, `name`) VALUES
(1, 'en cours'),
(2, 'devis'),
(3, 'facture'),
(4, 'en attente'),
(5, 'facture non réglée'),
(6, 'facture réglée');

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

CREATE TABLE IF NOT EXISTS `type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Contenu de la table `type`
--

INSERT INTO `type` (`id`, `name`) VALUES
(1, 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `login` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `id_type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `login`, `password`, `email`, `id_type`) VALUES
(1, 'admin', 'admin', 'emmanuel.autin@gmail.com', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
