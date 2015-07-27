-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 22-07-2015 a las 13:52:55
-- Versión del servidor: 5.6.19-0ubuntu0.14.04.1
-- Versión de PHP: 5.5.9-1ubuntu4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `avalua3`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cadenes`
--

CREATE TABLE IF NOT EXISTS `cadenes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idorige` int(32) NOT NULL,
  `taulaorigen` varchar(32) NOT NULL,
  `camporige` varchar(32) NOT NULL,
  `idioma` varchar(16) NOT NULL,
  `text` varchar(1024) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Volcado de datos para la tabla `cadenes`
--

INSERT INTO `cadenes` (`id`, `idorige`, `taulaorigen`, `camporige`, `idioma`, `text`) VALUES
(1, 0, 'questionaris', 'nom', 'val', 'Questionari 1'),
(2, 1, 'questionaris', 'nom', 'val', 'Questionari 2'),
(3, 0, 'Items', 'enunciat', 'val', 'Pregunta 0'),
(4, 1, 'Items', 'enunciat', 'val', 'Pregunta 1'),
(5, 2, 'Items', 'enunciat', 'val', 'Pregunta 2'),
(6, 3, 'Items', 'enunciat', 'val', 'Pregunta 3'),
(7, 4, 'Items', 'enunciat', 'val', 'Pregunta 4'),
(8, 5, 'Items', 'enunciat', 'val', 'Pregunta 5'),
(9, 1, 'opcions', 'valor', 'val', 'Opció 1'),
(10, 2, 'opcions', 'valor', 'val', 'Opció 2'),
(11, 3, 'opcions', 'valor', 'val', 'Opció 3'),
(12, 4, 'opcions', 'valor', 'val', 'Opció 4'),
(13, 5, 'opcions', 'valor', 'val', 'Opció 1'),
(14, 6, 'opcions', 'valor', 'val', 'Opció 2'),
(15, 7, 'opcions', 'valor', 'val', 'Opció 3'),
(16, 8, 'opcions', 'valor', 'val', 'Opció 4'),
(17, 9, 'opcions', 'valor', 'val', 'Opció 1'),
(18, 10, 'opcions', 'valor', 'val', 'Opció 2'),
(19, 11, 'opcions', 'valor', 'val', 'Opció 3'),
(20, 12, 'opcions', 'valor', 'val', 'Opció 4');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estimuls`
--

CREATE TABLE IF NOT EXISTS `estimuls` (
  `id` int(11) NOT NULL,
  `descripcio` varchar(128) NOT NULL,
  PRIMARY KEY (`id`,`descripcio`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estimul_questionari`
--

CREATE TABLE IF NOT EXISTS `estimul_questionari` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idestimul` int(11) NOT NULL,
  `idquestionari` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `estimul_questionari`
--

INSERT INTO `estimul_questionari` (`id`, `idestimul`, `idquestionari`) VALUES
(1, 0, 0),
(2, 1, 0),
(3, 2, 0),
(4, 0, 1),
(5, 1, 1),
(6, 0, 1),
(7, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcio` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items_estimul`
--

CREATE TABLE IF NOT EXISTS `items_estimul` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idestimul` int(11) NOT NULL,
  `iditem` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `items_estimul`
--

INSERT INTO `items_estimul` (`id`, `idestimul`, `iditem`) VALUES
(0, 0, 0),
(1, 0, 1),
(2, 1, 2),
(3, 1, 3),
(4, 2, 4),
(5, 2, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `opcions`
--

CREATE TABLE IF NOT EXISTS `opcions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iditem` int(11) NOT NULL,
  `descripcio` varchar(128) NOT NULL,
  `ordre` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `opcions`
--

INSERT INTO `opcions` (`id`, `iditem`, `descripcio`, `ordre`) VALUES
(1, 0, 'Opció 1', 0),
(2, 0, 'Opció 2', 1),
(3, 1, 'Opció 3', 0),
(4, 1, 'Opció 4', 1),
(5, 2, 'Opció 1', 0),
(6, 2, 'Opció 2', 1),
(7, 3, 'Opció 3', 0),
(8, 3, 'Opció 4', 1),
(9, 4, 'Opció 1', 0),
(10, 4, 'Opció 2', 1),
(11, 5, 'Opció 3', 0),
(12, 5, 'Opció 4', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE IF NOT EXISTS `permisos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idusuari` int(11) NOT NULL,
  `camp` varchar(128) NOT NULL,
  `lectura` int(11) NOT NULL,
  `escriptura` int(11) NOT NULL,
  `idorige` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id`, `idusuari`, `camp`, `lectura`, `escriptura`, `idorige`) VALUES
(1, 0, 'questionaris', 1, 0, 0),
(2, 0, 'questionaris', 1, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `questionaris`
--

CREATE TABLE IF NOT EXISTS `questionaris` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcio` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `questionaris`
--

INSERT INTO `questionaris` (`id`, `descripcio`) VALUES
(0, 'Questionari 1'),
(1, 'Questionari 2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respostes`
--

CREATE TABLE IF NOT EXISTS `respostes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iditem` int(11) NOT NULL,
  `resposta` varchar(1024) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuaris`
--

CREATE TABLE IF NOT EXISTS `usuaris` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(128) NOT NULL,
  `nom` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `usuaris`
--

INSERT INTO `usuaris` (`id`, `login`, `nom`, `password`) VALUES
(0, 'vicent', 'Vicent Fernàndez i Capilla', '123');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
