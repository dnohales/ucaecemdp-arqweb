-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 29-10-2012 a las 13:17:26
-- Versión del servidor: 5.5.24
-- Versión de PHP: 5.3.10-1ubuntu3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de datos: `segdmin`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `liability` int(11) NOT NULL COMMENT 'Responsabilidad civil',
  `taxEnd` int(11) NOT NULL COMMENT 'Impuesto para consumidor final',
  `taxMono` int(11) NOT NULL COMMENT 'Impuesto para monotributista',
  `taxResp` int(11) NOT NULL COMMENT 'Impuesto para responsable inscripto',
  `comission` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `coverage`
--

CREATE TABLE IF NOT EXISTS `coverage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `companyId` int(11) NOT NULL,
  `description` text NOT NULL,
  `rate` double NOT NULL COMMENT '% taza',
  PRIMARY KEY (`id`),
  KEY `companyId` (`companyId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producer`
--

CREATE TABLE IF NOT EXISTS `producer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `dni` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phones` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `request`
--

CREATE TABLE IF NOT EXISTS `request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `takerId` int(11) NOT NULL,
  `coverageId` int(11) NOT NULL,
  `accepted` tinyint(1) DEFAULT NULL COMMENT 'Flag: NULL=>no evaluada / 0=>rechazada / 1=>aceptada',
  `data` text NOT NULL COMMENT 'Datos del vehículo',
  `model` varchar(100) NOT NULL,
  `insured` int(11) NOT NULL COMMENT 'Suma asegurada',
  `comission` int(11) NOT NULL,
  `comment` text NOT NULL COMMENT 'Comentario que la compañía agrega cuando evalúa la solicitud',
  PRIMARY KEY (`id`),
  KEY `coverageId` (`coverageId`),
  KEY `takerId` (`takerId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `taker`
--

CREATE TABLE IF NOT EXISTS `taker` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producerId` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `dni` varchar(20) NOT NULL,
  `cuit` varchar(20) NOT NULL,
  `birth` date NOT NULL,
  `phones` varchar(100) NOT NULL,
  `condition` tinyint(4) NOT NULL COMMENT 'Flag: 0=>cons.final / 1=>mono. / 2=>resp.inscr.',
  PRIMARY KEY (`id`),
  KEY `producerId` (`producerId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` char(32) COLLATE utf8_unicode_ci NOT NULL,
  `salt` char(32) COLLATE utf8_unicode_ci NOT NULL,
  `adminId` int(11) DEFAULT NULL,
  `companyId` int(11) DEFAULT NULL,
  `producerId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `adminId` (`adminId`),
  KEY `companyId` (`companyId`),
  KEY `producerId` (`producerId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `salt`, `adminId`, `companyId`, `producerId`) VALUES
(1, 'admin@segdmin', 'eadf08d1b33b562617a0db6528c67136', 'a49145c46e79a7c0906517248a4e21ff', NULL, NULL, NULL);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `coverage`
--
ALTER TABLE `coverage`
  ADD CONSTRAINT `coverage_ibfk_1` FOREIGN KEY (`companyId`) REFERENCES `company` (`id`);

--
-- Filtros para la tabla `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `request_ibfk_2` FOREIGN KEY (`coverageId`) REFERENCES `coverage` (`id`),
  ADD CONSTRAINT `request_ibfk_1` FOREIGN KEY (`takerId`) REFERENCES `taker` (`id`);

--
-- Filtros para la tabla `taker`
--
ALTER TABLE `taker`
  ADD CONSTRAINT `taker_ibfk_1` FOREIGN KEY (`producerId`) REFERENCES `producer` (`id`);

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`adminId`) REFERENCES `admin` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`companyId`) REFERENCES `company` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `user_ibfk_3` FOREIGN KEY (`producerId`) REFERENCES `producer` (`id`) ON DELETE SET NULL;
