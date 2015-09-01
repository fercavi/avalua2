-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 01-09-2015 a las 13:07:53
-- Versión del servidor: 5.5.44-0ubuntu0.14.04.1
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
  `taulaorige` varchar(32) NOT NULL,
  `camporige` varchar(32) NOT NULL,
  `idioma` varchar(16) NOT NULL,
  `text` varchar(1024) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Volcado de datos para la tabla `cadenes`
--

INSERT INTO `cadenes` (`id`, `idorige`, `taulaorige`, `camporige`, `idioma`, `text`) VALUES
(1, 0, 'questionaris', 'nom', '0', 'Questionari 1'),
(2, 1, 'questionaris', 'nom', '0', 'Questionari 2'),
(3, 0, 'items', 'enunciat', '0', '<p>Pregunta 0</p>'),
(4, 1, 'items', 'enunciat', '0', '<p><strong>Pregunta</strong> 1</p>'),
(5, 2, 'items', 'enunciat', '0', 'Pregunta 2'),
(6, 3, 'items', 'enunciat', '0', 'Pregunta 3'),
(7, 4, 'items', 'enunciat', '0', 'Pregunta 4'),
(8, 5, 'items', 'enunciat', '0', 'Pregunta 5'),
(9, 1, 'opcions', 'valor', '0', 'Opció 1'),
(10, 2, 'opcions', 'valor', '0', 'Opció 2'),
(11, 3, 'opcions', 'valor', '0', 'Opció 3'),
(12, 4, 'opcions', 'valor', '0', 'Opció 4'),
(13, 5, 'opcions', 'valor', '0', 'Opció 1'),
(14, 6, 'opcions', 'valor', '0', 'Opció 2'),
(15, 7, 'opcions', 'valor', '0', 'Opció 3'),
(16, 8, 'opcions', 'valor', '0', 'Opció 4'),
(17, 9, 'opcions', 'valor', '0', 'Opció 1'),
(18, 10, 'opcions', 'valor', '0', 'Opció 2'),
(19, 11, 'opcions', 'valor', '0', 'Opció 3'),
(20, 12, 'opcions', 'valor', '0', 'Opció 4'),
(21, 0, 'estimuls', 'titol', '0', '<p>Estímul 1</p>'),
(22, 0, 'estimuls', 'enunciat', '0', '<p>enunciat de l&apos;estímul 1</p>'),
(23, 1, 'estimuls', 'titol', '0', '<p>Estímul 2</p>'),
(24, 1, 'estimuls', 'enunciat', '0', '<p><strong>enunciat</strong> de l&apos;estímul 2</p>'),
(25, 2, 'estimuls', 'titol', '0', '<p>Estímul 3</p>'),
(26, 2, 'estimuls', 'enunciat', '0', '<p><strong>enunciat</strong> de l&#8217;estímul&nbsp; 3</p>');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estimuls`
--

CREATE TABLE IF NOT EXISTS `estimuls` (
  `id` int(11) NOT NULL,
  `descripcio` varchar(128) NOT NULL,
  `estat` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`,`descripcio`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estimuls`
--

INSERT INTO `estimuls` (`id`, `descripcio`, `estat`) VALUES
(0, 'Estímul 1', 0),
(1, 'Estímul 2', 0),
(2, 'Estímul 3', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estimul_instancia`
--

CREATE TABLE IF NOT EXISTS `estimul_instancia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idestimul` int(11) NOT NULL,
  `idquestionari` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `estimul_instancia`
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
-- Estructura de tabla para la tabla `idioma`
--

CREATE TABLE IF NOT EXISTS `idioma` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcio` varchar(128) NOT NULL,
  `flag` varchar(256) NOT NULL,
  `codi` varchar(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `idioma`
--

INSERT INTO `idioma` (`id`, `descripcio`, `flag`, `codi`) VALUES
(1, 'valencià', 'img/valencia.png', 'val');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcio` varchar(128) NOT NULL,
  `estat` int(11) NOT NULL DEFAULT '0',
  `tipus` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `items`
--

INSERT INTO `items` (`id`, `descripcio`, `estat`, `tipus`) VALUES
(0, 'Ítem 1', 0, 1),
(1, 'Ítem 2', 0, 1),
(2, 'Ítem 3', 0, 1),
(3, 'Ítem 4', 0, 1),
(4, 'Ítem 5', 0, 1),
(5, 'Ítem 6', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `item_instancia`
--

CREATE TABLE IF NOT EXISTS `item_instancia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idestimul_instancia` int(11) NOT NULL,
  `iditem` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `item_instancia`
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Volcado de datos para la tabla `permisos`
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
-- Estructura de tabla para la tabla `plantilles_rol`
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
-- Volcado de datos para la tabla `plantilles_rol`
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
-- Estructura de tabla para la tabla `questionaris`
--

CREATE TABLE IF NOT EXISTS `questionaris` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcio` varchar(128) NOT NULL,
  `estat` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `questionaris`
--

INSERT INTO `questionaris` (`id`, `descripcio`, `estat`) VALUES
(0, 'Questionari 1', 0),
(1, 'Questionari 2', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respostes`
--

CREATE TABLE IF NOT EXISTS `respostes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iditem_instancia` int(11) NOT NULL,
  `resposta` varchar(1024) NOT NULL,
  `idusuari` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Volcado de datos para la tabla `respostes`
--

INSERT INTO `respostes` (`id`, `iditem_instancia`, `resposta`, `idusuari`) VALUES
(13, 0, '1', 0),
(14, 1, '0', 0),
(15, 2, '1', 0),
(16, 3, '0', 0),
(17, 4, '1', 0),
(18, 5, '0', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rols`
--

CREATE TABLE IF NOT EXISTS `rols` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcio` varchar(128) NOT NULL,
  `estat` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `rols`
--

INSERT INTO `rols` (`id`, `descripcio`, `estat`) VALUES
(0, 'Administrador', 0),
(2, 'Usuari', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipus_item`
--

CREATE TABLE IF NOT EXISTS `tipus_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcio` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `tipus_item`
--

INSERT INTO `tipus_item` (`id`, `descripcio`) VALUES
(0, 'genèric (item buit)'),
(1, 'radiobutton');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuaris`
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
-- Volcado de datos para la tabla `usuaris`
--

INSERT INTO `usuaris` (`id`, `login`, `nom`, `password`, `estat`) VALUES
(0, 'vicent', 'Vicent Fernàndez i Capilla', '123', 0),
(1, 'pepet', 'pepet el de NÃƒÂ quera', '666', 0),
(2, 'asdasd', 'asdasd', '123', 0),
(3, 'asd', 'asd', '666', 0),
(4, 'a', 'a', '666', 0),
(5, 'b', 'b', '777', -1),
(6, 'pepet2', 'Pepet', '202cb962ac59075b964b07152d234b70', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
