-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Temps de generació: 12-08-2015 a les 14:01:22
-- Versió del servidor: 5.5.44-0ubuntu0.14.04.1
-- Versió de PHP: 5.5.9-1ubuntu4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de dades: `avalua3`
--

-- --------------------------------------------------------

--
-- Estructura de la taula `cadenes`
--

CREATE TABLE IF NOT EXISTS `cadenes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idorige` int(32) NOT NULL,
  `taulaorige` varchar(32) NOT NULL,
  `camporige` varchar(32) NOT NULL,
  `idioma` varchar(16) NOT NULL,
  `text` varchar(1024) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

-- --------------------------------------------------------

--
-- Estructura de la taula `estimuls`
--

CREATE TABLE IF NOT EXISTS `estimuls` (
  `id` int(11) NOT NULL,
  `descripcio` varchar(128) NOT NULL,
  PRIMARY KEY (`id`,`descripcio`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de la taula `estimul_instancia`
--

CREATE TABLE IF NOT EXISTS `estimul_instancia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idestimul` int(11) NOT NULL,
  `idquestionari` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Estructura de la taula `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcio` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de la taula `item_instancia`
--

CREATE TABLE IF NOT EXISTS `item_instancia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idestimul_instancia` int(11) NOT NULL,
  `iditem` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Estructura de la taula `opcions`
--

CREATE TABLE IF NOT EXISTS `opcions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iditem` int(11) NOT NULL,
  `descripcio` varchar(128) NOT NULL,
  `ordre` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Estructura de la taula `permisos`
--

CREATE TABLE IF NOT EXISTS `permisos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idusuari` int(11) NOT NULL,
  `camp` varchar(128) NOT NULL,
  `lectura` int(11) NOT NULL,
  `escriptura` int(11) NOT NULL,
  `idorige` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Estructura de la taula `plantilles_rol`
--

CREATE TABLE IF NOT EXISTS `plantilles_rol` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idrol` int(11) NOT NULL,
  `lectura` int(11) NOT NULL,
  `escriptura` int(11) NOT NULL,
  `camp` varchar(128) NOT NULL,
  `idorige` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Estructura de la taula `questionaris`
--

CREATE TABLE IF NOT EXISTS `questionaris` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcio` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estructura de la taula `respostes`
--

CREATE TABLE IF NOT EXISTS `respostes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iditem_instancia` int(11) NOT NULL,
  `resposta` varchar(1024) NOT NULL,
  `idusuari` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Estructura de la taula `rols`
--

CREATE TABLE IF NOT EXISTS `rols` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcio` varchar(128) NOT NULL,
  `estat` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Estructura de la taula `usuaris`
--

CREATE TABLE IF NOT EXISTS `usuaris` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(128) NOT NULL,
  `nom` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `estat` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
