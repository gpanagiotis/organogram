-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 21, 2019 at 10:34 PM
-- Server version: 8.0.13
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `organogram`
--

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
CREATE TABLE IF NOT EXISTS `departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`) VALUES
(1, 'dep1');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE IF NOT EXISTS `employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `last_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `last_name`, `first_name`) VALUES
(1, '1', 'Employee'),
(2, '2', 'Employee');

-- --------------------------------------------------------

--
-- Table structure for table `organogram`
--

DROP TABLE IF EXISTS `organogram`;
CREATE TABLE IF NOT EXISTS `organogram` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `version_id` tinyint(4) NOT NULL DEFAULT '0',
  `name` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=person 1=department',
  `z__department_type_ids` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '0=administration...',
  `entity_id` int(11) NOT NULL DEFAULT '0' COMMENT 'emp_id or dep_id according to type',
  `z__lib_working_position_ids` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'working position 0=administration..',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `entity_id` (`entity_id`)
) ENGINE=InnoDB AUTO_INCREMENT=576 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `organogram`
--

INSERT INTO `organogram` (`id`, `version_id`, `name`, `parent_id`, `ordering`, `type`, `z__department_type_ids`, `entity_id`, `z__lib_working_position_ids`) VALUES
(1, 0, 'root', 0, -1, 1, '|1|', 1, NULL),
(573, 0, '1 Employee', 1, 0, 0, '1', 1, '|5|'),
(574, 0, '2 Employee', 1, 0, 0, '1', 2, '|1|'),
(575, 0, 'dep1', 1, 0, 1, '|1|', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `z__lib_department_types`
--

DROP TABLE IF EXISTS `z__lib_department_types`;
CREATE TABLE IF NOT EXISTS `z__lib_department_types` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ordering` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `z__lib_department_types`
--

INSERT INTO `z__lib_department_types` (`id`, `title`, `ordering`) VALUES
(1, 'Adminisrtation', NULL),
(2, 'Operation', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `z__lib_working_positions`
--

DROP TABLE IF EXISTS `z__lib_working_positions`;
CREATE TABLE IF NOT EXISTS `z__lib_working_positions` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ordering` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `z__lib_working_positions`
--

INSERT INTO `z__lib_working_positions` (`id`, `title`, `ordering`) VALUES
(1, 'Member', NULL),
(2, 'Manager', NULL),
(4, 'Secretary', NULL),
(5, 'Director', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `z__rel_is_manager`
--

DROP TABLE IF EXISTS `z__rel_is_manager`;
CREATE TABLE IF NOT EXISTS `z__rel_is_manager` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `table1_id` int(11) NOT NULL DEFAULT '0',
  `table2_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `z__rel_is_manager`
--

INSERT INTO `z__rel_is_manager` (`id`, `table1_id`, `table2_id`) VALUES
(1, 1, 2),
(3, 1, 5);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
