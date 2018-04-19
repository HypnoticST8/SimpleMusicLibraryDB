-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 19, 2018 at 08:04 PM
-- Server version: 5.5.50-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `vinyl_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `artists`
--

CREATE TABLE IF NOT EXISTS `artists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `artists`
--

INSERT INTO `artists` (`id`, `value`) VALUES
(1, 'Led Zeppelin'),
(2, 'Queen');

-- --------------------------------------------------------

--
-- Table structure for table `media_states`
--

CREATE TABLE IF NOT EXISTS `media_states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `media_states`
--

INSERT INTO `media_states` (`id`, `value`) VALUES
(1, 'Mint (M)'),
(2, 'Near Mint (NM)'),
(3, 'Excellent (E)'),
(4, 'Very Good Plus (VG+)'),
(5, 'Very Good (VG)'),
(6, 'Good (G)'),
(7, 'Poor (P)');

-- --------------------------------------------------------

--
-- Table structure for table `media_types`
--

CREATE TABLE IF NOT EXISTS `media_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `media_types`
--

INSERT INTO `media_types` (`id`, `value`) VALUES
(1, 'CD'),
(2, 'LP'),
(3, 'MC');

-- --------------------------------------------------------

--
-- Table structure for table `publishers`
--

CREATE TABLE IF NOT EXISTS `publishers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(64) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `publishers`
--

INSERT INTO `publishers` (`id`, `value`) VALUES
(1, 'Music for Nations'),
(2, 'Under One Flag');

-- --------------------------------------------------------

--
-- Table structure for table `sleeve_states`
--

CREATE TABLE IF NOT EXISTS `sleeve_states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `sleeve_states`
--

INSERT INTO `sleeve_states` (`id`, `value`) VALUES
(1, 'Mint (M)'),
(2, 'Near Mint (NM)'),
(3, 'Excellent (E)'),
(4, 'Very Good Plus (VG+)'),
(5, 'Very Good (VG)'),
(6, 'Good (G)'),
(7, 'Poor (P)');

-- --------------------------------------------------------

--
-- Table structure for table `vinyls`
--

CREATE TABLE IF NOT EXISTS `vinyls` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `artist_id` int(11) NOT NULL,
  `publisher_id` int(11) NOT NULL,
  `format_id` int(11) NOT NULL,
  `media_id` int(11) NOT NULL,
  `sleeve_id` int(11) NOT NULL,
  `album` varchar(256) NOT NULL,
  `year` int(11) NOT NULL,
  `catalogue` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=204 ;

--
-- Dumping data for table `vinyls`
--

INSERT INTO `vinyls` (`id`, `artist_id`, `publisher_id`, `format_id`, `media_id`, `sleeve_id`, `album`, `year`, `catalogue`) VALUES
(202, 2, 1, 1, 7, 4, 'Flash Gordon', 1958, '12345'),
(203, 1, 2, 3, 3, 1, 'Physical Graffiti', 1951, '5234');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
