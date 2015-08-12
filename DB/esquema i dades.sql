-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Temps de generació: 12-08-2015 a les 14:00:53
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

--
-- Bolcant dades de la taula `cadenes`
--

INSERT INTO `cadenes` (`id`, `idorige`, `taulaorige`, `camporige`, `idioma`, `text`) VALUES
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
(20, 12, 'opcions', 'valor', 'val', 'Opció 4'),
(21, 0, 'estimuls', 'titol', 'val', 'Estímul 1'),
(22, 0, 'estimuls', 'enunciat', 'val', 'enunciat de l''estímul 1'),
(23, 1, 'estimuls', 'titol', 'val', 'Estímul 2'),
(24, 1, 'estimuls', 'enunciat', 'val', 'enunciat de l''estímul 2'),
(25, 2, 'estimuls', 'titol', 'val', 'Estímul 3'),
(26, 2, 'estimuls', 'enunciat', 'val', 'enunciat de l''estímul 3');

-- --------------------------------------------------------

--
-- Estructura de la taula `estimuls`
--

CREATE TABLE IF NOT EXISTS `estimuls` (
  `id` int(11) NOT NULL,
  `descripcio` varchar(128) NOT NULL,
  PRIMARY KEY (`id`,`descripcio`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Bolcant dades de la taula `estimuls`
--

INSERT INTO `estimuls` (`id`, `descripcio`) VALUES
(0, 'Estímul 1'),
(1, 'Estímul 2'),
(2, 'Estímul 3');

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

--
-- Bolcant dades de la taula `estimul_instancia`
--

INSERT INTO `estimul_instancia` (`id`, `idestimul`, `idquestionari`) VALUES
(1, 0, 0),
(2, 1, 0),
(3, 2, 0),
(4, 0, 1),
(5, 1, 1),
(6, 2, 1);

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

--
-- Bolcant dades de la taula `item_instancia`
--

INSERT INTO `item_instancia` (`id`, `idestimul_instancia`, `iditem`) VALUES
(0, 1, 0),
(1, 1, 1),
(2, 2, 2),
(3, 2, 3),
(4, 3, 4),
(5, 3, 5);

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

--
-- Bolcant dades de la taula `opcions`
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

--
-- Bolcant dades de la taula `permisos`
--

INSERT INTO `permisos` (`id`, `idusuari`, `camp`, `lectura`, `escriptura`, `idorige`) VALUES
(1, 0, 'questionaris', 1, 0, 0),
(2, 0, 'questionaris', 1, 0, 1),
(3, 0, 'estimuls', 1, 0, 1),
(4, 0, 'estimuls', 1, 0, 2),
(5, 0, 'estimuls', 1, 0, 3),
(6, 0, 'items', 1, 1, 0),
(7, 0, 'items', 1, 1, 1),
(8, 0, 'items', 1, 1, 2),
(9, 0, 'items', 1, 1, 3),
(10, 0, 'items', 1, 1, 4),
(11, 0, 'items', 1, 1, 5),
(12, 0, 'estimuls', 1, 0, 4),
(13, 0, 'estimuls', 1, 0, 5),
(14, 0, 'estimuls', 1, 0, 6),
(15, 0, 'Administrador', 1, 1, 0);

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

--
-- Bolcant dades de la taula `plantilles_rol`
--

INSERT INTO `plantilles_rol` (`id`, `idrol`, `lectura`, `escriptura`, `camp`, `idorige`) VALUES
(1, 0, 1, 0, 'questionaris', 0),
(2, 0, 1, 0, 'questionaris', 1),
(3, 0, 1, 0, 'estimuls', 1),
(4, 0, 1, 0, 'estimuls', 2),
(5, 0, 1, 0, 'estimuls', 3),
(6, 0, 1, 1, 'items', 0),
(7, 0, 1, 1, 'items', 1),
(8, 0, 1, 1, 'items', 2),
(9, 0, 1, 1, 'items', 3),
(10, 0, 1, 1, 'items', 4),
(11, 0, 1, 1, 'items', 5),
(12, 0, 1, 0, 'estimuls', 4),
(13, 0, 1, 0, 'estimuls', 5),
(14, 0, 1, 0, 'estimuls', 6),
(15, 0, 1, 1, 'Administrador', 0);

-- --------------------------------------------------------

--
-- Estructura de la taula `questionaris`
--

CREATE TABLE IF NOT EXISTS `questionaris` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcio` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Bolcant dades de la taula `questionaris`
--

INSERT INTO `questionaris` (`id`, `descripcio`) VALUES
(0, 'Questionari 1'),
(1, 'Questionari 2');

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

--
-- Bolcant dades de la taula `respostes`
--

INSERT INTO `respostes` (`id`, `iditem_instancia`, `resposta`, `idusuari`) VALUES
(10, 0, '0', 0),
(11, 1, '0', 0),
(12, 5, '0', 0);

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

--
-- Bolcant dades de la taula `rols`
--

INSERT INTO `rols` (`id`, `descripcio`, `estat`) VALUES
(0, 'Administrador', 0),
(2, 'Usuari', -1);

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

--
-- Bolcant dades de la taula `usuaris`
--

INSERT INTO `usuaris` (`id`, `login`, `nom`, `password`, `estat`) VALUES
(0, 'vicent', 'Vicent Fernàndez i Capilla', '123', 0),
(1, 'pepet', 'pepet el de NÃƒÂ quera', '666', 0),
(2, 'asdasd', 'asdasd', '123', 0),
(3, 'asd', 'asd', '666', 0),
(4, 'a', 'a', '666', 0),
(5, 'b', 'b', '777', 0),
(6, 'pepet2', 'Pepet', '202cb962ac59075b964b07152d234b70', -1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
