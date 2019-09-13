-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 11, 2017 at 06:39 PM
-- Server version: 5.5.50-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `aplatun`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL,
  `email_address` varchar(99) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(99) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(99) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `last_modifier` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_id` (`admin_id`),
  UNIQUE KEY `email_address` (`email_address`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `admin_id`, `email_address`, `password`, `name`, `status`, `created_at`, `updated_at`, `last_modifier`) VALUES
(1, 103000001, 'admin@aplatun.com', 'e36f253e12f3af40653cbd2cfebebf1b', 'Md Fahim Uddin', 'active', '2016-07-25 00:00:00', '2016-07-25 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `admin_acl`
--

CREATE TABLE IF NOT EXISTS `admin_acl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL,
  `policy` longtext COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `last_modifier` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `admin_id` (`admin_id`),
  KEY `last_modifier` (`last_modifier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `id_generator`
--

CREATE TABLE IF NOT EXISTS `id_generator` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reference` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `php_sess_id` varchar(99) COLLATE utf8_unicode_ci NOT NULL,
  `route_name` varchar(99) COLLATE utf8_unicode_ci NOT NULL,
  `remote_addr` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `details` longtext COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `php_sess_id` varchar(99) COLLATE utf8_unicode_ci NOT NULL,
  `session_name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `session_data` longtext COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `php_sess_id` (`php_sess_id`),
  KEY `session_name` (`session_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `php_sess_id`, `session_name`, `session_data`, `status`, `created_at`, `updated_at`) VALUES
(4, 'gipksiv0m772s5ih6aeadgn9t6', 'admin_login', '{"adminId":103000001,"emailAddress":"admin@hadihata.zit","password":"e36f253e12f3af40653cbd2cfebebf1b","name":"Md Fahim Uddin"}', 'deleted', '2016-07-26 01:04:14', '2016-07-28 19:51:00'),
(5, 'gjelcctf30vafqsmpaapcblnp1', 'admin_login', '{"adminId":103000001,"emailAddress":"admin@aplatun.com","password":"e36f253e12f3af40653cbd2cfebebf1b","name":"Md Fahim Uddin"}', 'deleted', '2016-07-29 20:04:42', '2016-07-29 19:49:51'),
(6, 'gjelcctf30vafqsmpaapcblnp1', 'admin_login', '{"adminId":103000001,"emailAddress":"admin@aplatun.com","password":"e36f253e12f3af40653cbd2cfebebf1b","name":"Md Fahim Uddin"}', 'deleted', '2016-07-29 21:08:23', '2016-07-29 22:00:07'),
(7, 'gjmnjuc84v3j25u2lh0t209h05', 'admin_login', '{"adminId":103000001,"emailAddress":"admin@aplatun.com","password":"e36f253e12f3af40653cbd2cfebebf1b","name":"Md Fahim Uddin"}', 'deleted', '2016-08-01 19:13:20', '2016-08-01 21:40:01'),
(8, 'gjmnjuc84v3j25u2lh0t209h05', 'admin_login', '{"adminId":103000001,"emailAddress":"admin@aplatun.com","password":"e36f253e12f3af40653cbd2cfebebf1b","name":"Md Fahim Uddin"}', 'deleted', '2016-08-01 23:17:30', '2016-08-02 00:15:31'),
(10, 'jsl1vnj8let3b1mia66mfd3t35', 'admin_login', '{"adminId":103000001,"emailAddress":"admin@aplatun.com","password":"e36f253e12f3af40653cbd2cfebebf1b","name":"Md Fahim Uddin"}', 'active', '2016-08-02 06:44:33', '2016-08-02 07:15:22');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
