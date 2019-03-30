-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  sam. 30 mars 2019 à 10:37
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `bd_m314`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`, `slug`) VALUES
(5, 'Smartphones', 'smartphones'),
(6, 'Mobiles', 'mobiles'),
(7, 'Iphones', 'iphones');

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `price` text NOT NULL,
  `category` varchar(255) NOT NULL,
  `weight` varchar(255) NOT NULL,
  `shipping` varchar(255) NOT NULL,
  `tva` varchar(255) NOT NULL,
  `final_price` varchar(255) NOT NULL,
  `stock` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`ID`, `title`, `slug`, `description`, `price`, `category`, `weight`, `shipping`, `tva`, `final_price`, `stock`) VALUES
(43, 'Samsung Galaxy S7 Edge Blanc', 'samsung-galaxy-s7-edge-blanc', 'Taille d\'écran : 5.5\"\r\n2.3 GHz - 8 coeurs\r\n4G\r\nRésolution du capteur : 12 mégapixels\r\nCapacité de la mémoire interne : 32 Go\r\nSystème d\'exploitation : Android 6.0 (Marshmallow)\r\nComposants intégrés : Caméra arrière, caméra avant, lecteur audio, enregistreur vocal, capteur de fréquence cardiaque, navigation\r\nCartes mémoire flash prises en charge : microSDXC - jusqu\'à 200 Go', '679.99', 'Smartphones', '0', '5', '20', '821.988', '55'),
(44, 'Sony Xperia E5 Noir', 'sony-xperia-e5-noir', 'Taille d\'écran : 5\"\r\nType : MediaTek MTK6735\r\n1.3 GHz - Quadruple coeur\r\n4G\r\nRésolution du capteur : 13 mégapixels\r\nCapacité de la mémoire interne : 16 Go\r\nSystème d\'exploitation : Android 6.0 (Marshmallow)\r\nComposants intégrés : Caméra arrière, caméra avant, radio FM, lecteur audio, enregistreur vocal, navigation', '178.99', 'Smartphones', '0', '5', '20', '220.788', '50'),
(45, 'Samsung Galaxy S7 Edge Noir', 'samsung-galaxy-s7-edge-noir', 'Taille d\'écran : 5.5\"\r\n2.3 GHz - 8 coeurs\r\n4G\r\nRésolution du capteur : 12 mégapixels\r\nCapacité de la mémoire interne : 32 Go\r\nSystème d\'exploitation : Android 6.0 (Marshmallow)\r\nComposants intégrés : Caméra arrière, caméra avant, lecteur audio, enregistreur vocal, capteur de fréquence cardiaque, navigation\r\nCartes mémoire flash prises en charge : microSDXC - jusqu\'à 200 Go', '745.29', 'Smartphones', '0', '5', '20', '900.348', '50'),
(46, ' Wiko Pulp 4G Noir', 'wiko-pulp-4g-noir', 'Taille d\'écran : 5\"\r\nType : QUALCOMM Snapdragon 410\r\n1.2 GHz - Quadruple coeur\r\n4G\r\nRésolution du capteur : 13 mégapixels\r\nCapacité de la mémoire interne : 16 Go\r\nSystème d\'exploitation : Android 5.1 (Lollipop)\r\nComposants intégrés : Caméra arrière, caméra avant, radio FM, lecteur audio, enregistreur vocal, navigation', '129.99', 'Smartphones', '0', '5', '20', '161.988', '50'),
(47, ' ASUS ZenFone 2 Laser Argent 16Go 4G', 'asus-zenfone-2-laser-argent-16go-4g', 'Taille d\'écran : 5\"\r\nType : QUALCOMM Snapdragon 410\r\n1.2 GHz - Quadruple coeur\r\n4G\r\nRésolution du capteur : 13 mégapixels\r\nCapacité de la mémoire interne : 16 Go\r\nSystème d\'exploitation : Android 5.0 (Lollipop)\r\nComposants intégrés : Caméra arrière, caméra avant, lecteur audio, enregistreur vocal, navigation', '129.00', 'Smartphones', '0', '5', '20', '160.8', '50'),
(48, 'Gooweel M3', 'gooweel-m3', '6.0 pouce IPS écran MTK6580 quad core Mobile téléphone 8MP+5MP GPS 1GB RAM 8GB ROM 3G smartphone Or', '89.99', 'Mobiles', '0', '5', '20', '113.988', '50'),
(52, 'Archos F28 Noir', 'archos-f28-noir', 'Taille d\'écran : 2.8\"\r\nRésolution du capteur : 0,3 mégapixels\r\nComposants intégrés : Caméra arrière, radio FM, enregistreur vocal\r\nCartes mémoire flash prises en charge : microSD - jusqu\'à 32 Go\r\nFonctions du téléphone : Téléphone à haut parleur, compteur d\'appels, téléconférence, vibreur', '24.99', 'Mobiles', '0', '5', '20', '35.988', '50'),
(53, ' Crosscall Spider- X1 Noir Anti-Choc', 'crosscall-spider-x1-noir-anti-choc', 'Taille d\'écran : 1.77\"\r\nRésolution du capteur : 0,3 mégapixels\r\nComposants intégrés : Caméra arrière, radio FM\r\nCartes mémoire flash prises en charge : microSDHC - jusqu\'à 16 Go\r\nFonctions du téléphone : Téléphone à haut parleur, compteur d\'appels, vibreur\r\nCouleur du boitier : Noir', '54.93', 'Mobiles', '0', '5', '20', '71.916', '50'),
(54, ' WIKO DEA Blanc', 'wiko-dea-blanc', 'Taille d\'écran : 2.8\"\r\nRésolution du capteur : 3.2 mégapixel\r\nComposants intégrés : Caméra arrière, radio FM, enregistreur vocal\r\nCartes mémoire flash prises en charge : microSDHC - jusqu\'à 16 Go\r\nFonctions du téléphone : Téléphone à haut parleur, compteur d\'appels, téléconférence, vibreur\r\nCouleur du boitier : Blanc', '39.99', 'Mobiles', '0', '5', '20', '53.988', '50'),
(55, 'VKworld Pierre', 'vkworld-pierre', 'Téléphone IP67 étanche antipoussière 2,4 pouces', '35.00', 'Mobiles', '0', '5', '20', '48', '50'),
(56, 'iPhone 5S 16 Go Argent', 'apple-iphone-5s-16-go-argent-4g', 'Taille d\'écran : 4.7 Type : Apple A10 Fusion Quadruple coeur 4G Résolution du capteur 12 mégapixels Capacité de la mémoire interne : 32 Go Système d\'exploitation : iOS 10 Composants intégrés : Caméra arrière, caméra avant, lecteur audio, enregistreur vocal, haut-parleurs stéréo, navigation', '329.00', 'Iphones', '0', '5', '20', '400.8', '50'),
(57, 'iPhone 7 32 Go Argent', 'apple-iphone-7-32-go-argent', 'Taille d\'écran : 4.7 Type : Apple A10 Fusion Quadruple coeur 4G Résolution du capteur 12 mégapixels Capacité de la mémoire interne : 32 Go Système d\'exploitation : iOS 10 Composants intégrés : Caméra arrière, caméra avant, lecteur audio, enregistreur vocal, haut-parleurs stéréo, navigation', '739.00', 'Iphones', '0', '5', '20', '892.8', '45'),
(59, 'iPhone 5S 32 Go Or 4G', 'apple-iphone-5s-32-go-or-4g', 'Taille d\'écran : 4.7 Type : Apple A10 Fusion Quadruple coeur 4G Résolution du capteur 12 mégapixels Capacité de la mémoire interne : 32 Go Système d\'exploitation : iOS 10 Composants intégrés : Caméra arrière, caméra avant, lecteur audio, enregistreur vocal, haut-parleurs stéréo, navigation', '255.67', 'Iphones', '0', '5', '20', '312.804', '50'),
(61, 'Huawei Ascend P8', 'huawei-ascend-p8', 'Équipé d\'une puce octocœur de fabrication maison Kiron 930, aidé par une puce graphique Mali T628 et 3 Go de mémoire vive. Le P8 est pourvu d\'une batterie de 2 600 mAh non amovible et c\'est Android dans sa version 5.0 qui anime le tout.', '389.97', 'Smartphones', '100', '10', '20', '479.964', '24'),
(62, 'Generic Nokia 3310', 'generic-nokia-3310', 'Un classique moderne complétement réinventé. Le nouveau Nokia 3310 emprunte la silhouette emblématique de l’original et la réinvente pour 2017. L\'interface utilisateur conçue sur mesure renouvelle totalement ce grand classique. Son écran polarisé et incurvé de 2,4 pouces facilite la lecture en plein soleil.', '60', 'Mobiles', '300', '15', '20', '90', '116');

-- --------------------------------------------------------

--
-- Structure de la table `products_transactions`
--

DROP TABLE IF EXISTS `products_transactions`;
CREATE TABLE IF NOT EXISTS `products_transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` varchar(3) NOT NULL,
  `date` datetime NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  `shipping` int(11) NOT NULL,
  `currency_code` varchar(3) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `tva`
--

DROP TABLE IF EXISTS `tva`;
CREATE TABLE IF NOT EXISTS `tva` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `montant` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `tva`
--

INSERT INTO `tva` (`id`, `montant`) VALUES
(1, 20);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(2, 'LearnPHPaz', 'learnphpaz@gmail.com', '1212'),
(3, 'toto', 'toto@example.com', 'toto'),
(4, 'Oswild', 'demission@live.fr', 'code51');

-- --------------------------------------------------------

--
-- Structure de la table `weights`
--

DROP TABLE IF EXISTS `weights`;
CREATE TABLE IF NOT EXISTS `weights` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `weights`
--

INSERT INTO `weights` (`id`, `name`, `price`) VALUES
(1, 0, 5),
(2, 100, 10),
(3, 300, 15),
(4, 500, 20),
(5, 1000, 40);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
