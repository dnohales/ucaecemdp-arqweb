-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 21, 2012 at 03:51 PM
-- Server version: 5.5.24
-- PHP Version: 5.3.10-1ubuntu3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `segdmin`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` char(32) NOT NULL,
  `name` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` char(32) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `liability` int(11) NOT NULL COMMENT 'Responsabilidad civil',
  `tax_end` int(11) NOT NULL COMMENT 'Impuesto para consumidor final',
  `tax_mono` int(11) NOT NULL COMMENT 'Impuesto para monotributista',
  `tax_resp` int(11) NOT NULL COMMENT 'Impuesto para responsable inscripto',
  `comission` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `coverage`
--

CREATE TABLE IF NOT EXISTS `coverage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_company` int(11) NOT NULL,
  `description` text NOT NULL,
  `rate` int(11) NOT NULL COMMENT '% taza',
  PRIMARY KEY (`id`),
  KEY `id_company` (`id_company`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `producer`
--

CREATE TABLE IF NOT EXISTS `producer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` char(32) NOT NULL,
  `name` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `dni` int(11) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phones` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE IF NOT EXISTS `request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_taker` int(11) NOT NULL,
  `id_coverage` int(11) NOT NULL,
  `accepted` tinyint(1) DEFAULT NULL COMMENT 'Flag: NULL=>no evaluada / 0=>rechazada / 1=>aceptada',
  `data` text NOT NULL COMMENT 'Datos del vehículo',
  `model` varchar(100) NOT NULL,
  `insured` int(11) NOT NULL COMMENT 'Suma asegurada',
  `comission` int(11) NOT NULL,
  `comment` text NOT NULL COMMENT 'Comentario que la compañía agrega cuando evalúa la solicitud',
  PRIMARY KEY (`id`),
  KEY `id_coverage` (`id_coverage`),
  KEY `id_taker` (`id_taker`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `taker`
--

CREATE TABLE IF NOT EXISTS `taker` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_producer` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `dni` int(11) NOT NULL,
  `cuit` char(13) NOT NULL,
  `birth` date NOT NULL,
  `phones` varchar(100) NOT NULL,
  `condition` tinyint(4) NOT NULL COMMENT 'Flag: 0=>cons.final / 1=>mono. / 2=>resp.inscr.',
  PRIMARY KEY (`id`),
  KEY `id_producer` (`id_producer`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `coverage`
--
ALTER TABLE `coverage`
  ADD CONSTRAINT `coverage_ibfk_1` FOREIGN KEY (`id_company`) REFERENCES `company` (`id`);

--
-- Constraints for table `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `request_ibfk_2` FOREIGN KEY (`id_coverage`) REFERENCES `coverage` (`id`),
  ADD CONSTRAINT `request_ibfk_1` FOREIGN KEY (`id_taker`) REFERENCES `taker` (`id`);

--
-- Constraints for table `taker`
--
ALTER TABLE `taker`
  ADD CONSTRAINT `taker_ibfk_1` FOREIGN KEY (`id_producer`) REFERENCES `producer` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
