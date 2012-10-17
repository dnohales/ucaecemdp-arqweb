-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 17, 2012 at 11:22 AM
-- Server version: 5.5.24
-- PHP Version: 5.3.10-1ubuntu3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_seguros`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrador`
--

CREATE TABLE IF NOT EXISTS `administrador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `correo` varchar(100) NOT NULL,
  `contrasenia` char(32) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cobertura`
--

CREATE TABLE IF NOT EXISTS `cobertura` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_compania` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `tasa` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_compania` (`id_compania`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `compania`
--

CREATE TABLE IF NOT EXISTS `compania` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `correo` varchar(100) NOT NULL,
  `contrasenia` char(32) NOT NULL,
  `nombre` varchar(100) NOT NULL COMMENT 'razon social',
  `direccion` varchar(100) NOT NULL,
  `responsabilidad` int(11) NOT NULL COMMENT 'responsabilidad civil',
  `imp_final` int(11) NOT NULL COMMENT 'impuesto para consumidor final',
  `imp_mono` int(11) NOT NULL COMMENT 'impuesto para monotributista',
  `imp_inscr` int(11) NOT NULL COMMENT 'impuesto para responsable inscripto',
  `comision_productor` int(11) NOT NULL,
  `descuento` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `productor`
--

CREATE TABLE IF NOT EXISTS `productor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `correo` varchar(100) NOT NULL,
  `contrasenia` char(32) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `dni` int(11) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `telefono` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `solicitud`
--

CREATE TABLE IF NOT EXISTS `solicitud` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_tomador` int(11) NOT NULL,
  `id_cobertura` int(11) NOT NULL,
  `aceptada` tinyint(1) DEFAULT NULL COMMENT 'duda: ver si esta bien el tipo boolean+NULL',
  `datos` text NOT NULL,
  `modelo` int(11) NOT NULL,
  `asegurado` int(11) NOT NULL COMMENT 'suma asegurada',
  `comision` int(11) NOT NULL COMMENT 'comision que toma el productor',
  PRIMARY KEY (`id`),
  KEY `id_tomador` (`id_tomador`),
  KEY `id_cobertura` (`id_cobertura`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tomador`
--

CREATE TABLE IF NOT EXISTS `tomador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_productor` int(11) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `dni` int(11) NOT NULL,
  `cuit` int(11) NOT NULL,
  `f_nac` date NOT NULL COMMENT 'fecha de nacimiento',
  `telefono` varchar(100) NOT NULL,
  `condicion` int(11) NOT NULL COMMENT 'condicion impositiva',
  PRIMARY KEY (`id`),
  KEY `id_productor` (`id_productor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cobertura`
--
ALTER TABLE `cobertura`
  ADD CONSTRAINT `cobertura_ibfk_1` FOREIGN KEY (`id_compania`) REFERENCES `compania` (`id`);

--
-- Constraints for table `solicitud`
--
ALTER TABLE `solicitud`
  ADD CONSTRAINT `solicitud_ibfk_1` FOREIGN KEY (`id_tomador`) REFERENCES `tomador` (`id`),
  ADD CONSTRAINT `solicitud_ibfk_2` FOREIGN KEY (`id_cobertura`) REFERENCES `cobertura` (`id`);

--
-- Constraints for table `tomador`
--
ALTER TABLE `tomador`
  ADD CONSTRAINT `tomador_ibfk_1` FOREIGN KEY (`id_productor`) REFERENCES `productor` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
