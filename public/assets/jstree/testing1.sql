-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 25, 2018 at 02:15 PM
-- Server version: 5.7.21
-- PHP Version: 7.0.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testing1`
--

-- --------------------------------------------------------

--
-- Table structure for table `organogram`
--

DROP TABLE IF EXISTS `organogram`;
CREATE TABLE IF NOT EXISTS `organogram` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `is_manager` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `organogram`
--

INSERT INTO `organogram` (`id`, `name`, `parent_id`, `ordering`, `is_manager`) VALUES
(1, 'Πρόεδρος & Διοικητικό Συμβούλιο', 0, -1, 0),
(2, 'Διοικητική Υπηρεσία', 1, 3, 0),
(3, 'Επιστημονική Υπηρεσία', 1, 2, 0),
(4, 'Διευθυντής Διοικητικής Υπηρεσίας | Κωσταντίνος Καλπάκας', 2, 400, 0),
(5, 'Τμήμα Προσωπικού και Γραμματειακής Υποστήριξης | Κώστας', 4, 500, 1),
(6, 'Τμήμα Διοικητικής Μέριμνας και Τεχνικής Υποστήριξης', 4, 600, 0),
(7, 'Υποδιεύθυνση Οικονομικής Υπηρεσιάς', 4, 700, 0),
(8, 'Τμήμα Οικονομικής Υποστήριξης', 7, 800, 0),
(9, 'Τμήμα Προμηθειών και Συμβάσεων', 7, 900, 0),
(28, 'Γραφεία και τμήματα Προέδρου', 1, 1, 0),
(29, 'Παναγιώτης Γιαννίτσαρος', 6, 2900, 0),
(30, 'Ιωάννης', 6, 3000, 0),
(31, 'Εποπτεία Επιστημονικής Υπηρεσίας', 3, 3100, 0),
(32, 'Γραφείο Επιστημονικών Μονάδων Α΄ Κύκλου', 31, 3200, 0),
(33, 'Γραφείο Επιστημονικών Μονάδων Β΄ Κύκλου', 31, 3300, 0),
(34, 'Γραφείο Επιστημονικών Μονάδων Γ΄ Κύκλου', 31, 3400, 0),
(35, 'Γραμματεία', 28, 3500, 0),
(36, 'Γραφείο Στρατηγικής και Πολιτικού Σχεδιασμού', 28, 3600, 0);

-- --------------------------------------------------------

--
-- Table structure for table `organogram2`
--

DROP TABLE IF EXISTS `organogram2`;
CREATE TABLE IF NOT EXISTS `organogram2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `is_manager` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `organogram2`
--

INSERT INTO `organogram2` (`id`, `name`, `parent_id`, `ordering`, `is_manager`) VALUES
(1, 'Proedros & Dioikitiko Symboulio', 0, -1, 0),
(2, 'Dioikitiki Ypiresia', 1, 3, 0),
(3, 'Epistimoniki Ypiresia', 1, 2, 0),
(4, 'Dieythyntis Dioikitikis Ypiresias | Kostantinos Kalpakas', 2, 400, 0),
(5, 'Tmima Prosopikou kai Grammateiakis Ypostirixis | Kostas', 4, 500, 1),
(6, 'Tmima Dioikitikis Merimnas kai Texnikis Ypostirixis', 4, 600, 0),
(7, 'Ypodieythynsi Oikonomikis Ypiresias', 4, 700, 0),
(8, 'Tmima Oikonomikis Ypostirixis', 7, 800, 0),
(9, 'Tmima Promitheion kai Symbaseon', 7, 900, 0),
(28, 'Grafeia kai tmimata Proedrou', 1, 1, 0),
(29, 'Panagiotis Giannitsaros', 6, 2900, 0),
(30, 'Ioannis', 6, 3000, 0),
(31, 'Epopteia Epistimonikis Ypiresias', 3, 3100, 0),
(32, 'Grafeio Epistimonikon Monadon A΄ Kyklou', 31, 3200, 0),
(33, 'Grafeio Epistimonikon Monadon B΄ Kyklou', 31, 3300, 0),
(34, 'Grafeio Epistimonikon Monadon G΄ Kyklou', 31, 3400, 0),
(35, 'Grammateia', 28, 3500, 0),
(36, 'Grafeio Stratigikis kai Politikou Sxediasmou', 28, 3600, 0);

-- --------------------------------------------------------

--
-- Table structure for table `organogram3`
--

DROP TABLE IF EXISTS `organogram3`;
CREATE TABLE IF NOT EXISTS `organogram3` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `is_manager` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `organogram3`
--

INSERT INTO `organogram3` (`id`, `name`, `parent_id`, `ordering`, `is_manager`) VALUES
(1, 'Proedros & Dioikitiko Symboulio', 0, -1, 0),
(2, 'Dioikitiki Ypiresia', 1, 3, 0),
(3, 'Epistimoniki Ypiresia', 1, 2, 0),
(4, 'Dieythyntis Dioikitikis Ypiresias | Kostantinos Kalpakas', 2, 400, 0),
(5, 'Tmima Prosopikou kai Grammateiakis Ypostirixis | Kostas', 4, 500, 1),
(6, 'Tmima Dioikitikis Merimnas kai Texnikis Ypostirixis', 4, 600, 0),
(7, 'Ypodieythynsi Oikonomikis Ypiresias', 4, 700, 0),
(8, 'Tmima Oikonomikis Ypostirixis', 7, 800, 0),
(9, 'Tmima Promitheion kai Symbaseon', 7, 900, 0),
(28, 'Grafeia kai tmimata Proedrou', 1, 1, 0),
(29, 'Panagiotis Giannitsaros', 6, 2900, 0),
(30, 'Ioannis', 6, 3000, 0),
(31, 'Epopteia Epistimonikis Ypiresias', 3, 3100, 0),
(32, 'Grafeio Epistimonikon Monadon A΄ Kyklou', 31, 3200, 0),
(33, 'Grafeio Epistimonikon Monadon B΄ Kyklou', 31, 3300, 0),
(34, 'Grafeio Epistimonikon Monadon G΄ Kyklou', 31, 3400, 0),
(35, 'Grammateia', 28, 3500, 0),
(36, 'Grafeio Stratigikis kai Politikou Sxediasmou', 28, 3600, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
