-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 08-12-2012 a las 16:51:47
-- Versión del servidor: 5.5.16
-- Versión de PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `pokemon`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrenadores`
--

CREATE TABLE IF NOT EXISTS `entrenadores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `passwd` varchar(150) NOT NULL,
  `iniciado` smallint(1) NOT NULL DEFAULT '0',
  `en_secuencia` tinyint(1) NOT NULL DEFAULT '1',
  `map` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `entrenadores`
--

INSERT INTO `entrenadores` (`id`, `nombre`, `email`, `passwd`, `iniciado`, `en_secuencia`, `map`) VALUES
(1, 'Agustín Houlgrave', 'a.houlgrave@gmail.com', 'b23cf2d0fb74b0ffa0cf4c70e6e04926', 1, 0, 2),
(2, 'Fede', 'fede_945@hotmail.com', 'b23cf2d0fb74b0ffa0cf4c70e6e04926', 1, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrenadores_llaves`
--

CREATE TABLE IF NOT EXISTS `entrenadores_llaves` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entrenador` int(11) NOT NULL,
  `llave` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `entrenador` (`entrenador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrenadores_opciones`
--

CREATE TABLE IF NOT EXISTS `entrenadores_opciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entrenador` int(11) NOT NULL,
  `opcion` varchar(100) NOT NULL,
  `valor` varchar(100) NOT NULL,
  PRIMARY KEY (`id`,`entrenador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrenadores_pokemons`
--

CREATE TABLE IF NOT EXISTS `entrenadores_pokemons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entrenador` int(11) NOT NULL,
  `pokemon` int(11) NOT NULL,
  `nivel` int(11) NOT NULL DEFAULT '1',
  `experiencia` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `entrenador` (`entrenador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrenadores_secuencias`
--

CREATE TABLE IF NOT EXISTS `entrenadores_secuencias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entrenador` int(11) NOT NULL,
  `secuencia` int(11) NOT NULL,
  `escena` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `entrenador` (`entrenador`,`secuencia`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `entrenadores_secuencias`
--

INSERT INTO `entrenadores_secuencias` (`id`, `entrenador`, `secuencia`, `escena`, `fecha`) VALUES
(4, 1, 1, 5, '2012-11-29 18:00:53'),
(5, 2, 1, 5, '2012-11-29 18:49:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mapas`
--

CREATE TABLE IF NOT EXISTS `mapas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(150) DEFAULT NULL,
  `script` text,
  `imagen` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mapas_mundo`
--

CREATE TABLE IF NOT EXISTS `mapas_mundo` (
  `x` int(11) NOT NULL,
  `y` int(11) NOT NULL,
  `map` int(11) DEFAULT NULL,
  PRIMARY KEY (`x`,`y`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mapas_zonas`
--

CREATE TABLE IF NOT EXISTS `mapas_zonas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mapa` int(11) NOT NULL,
  `pos_x` int(11) NOT NULL,
  `pos_y` int(11) NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `titulo` varchar(150) DEFAULT NULL,
  `secuencia` int(11) DEFAULT NULL,
  `a_mapa` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pokemons`
--

CREATE TABLE IF NOT EXISTS `pokemons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `imagen` varchar(150) DEFAULT NULL,
  `icono` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pokemons_evoluciones`
--

CREATE TABLE IF NOT EXISTS `pokemons_evoluciones` (
  `de` int(11) NOT NULL,
  `a` int(11) NOT NULL,
  `nivel` int(11) DEFAULT NULL,
  `item` int(11) DEFAULT NULL,
  PRIMARY KEY (`de`,`a`),
  KEY `a` (`a`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `secuencias`
--

CREATE TABLE IF NOT EXISTS `secuencias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `secuencias`
--

INSERT INTO `secuencias` (`id`, `nombre`) VALUES
(1, 'Inicio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `secuencias_escenas`
--

CREATE TABLE IF NOT EXISTS `secuencias_escenas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `secuencia` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `imagen` varchar(150) DEFAULT NULL,
  `texto` text,
  `script` text,
  `orden` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `secuencia` (`secuencia`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `secuencias_escenas`
--

INSERT INTO `secuencias_escenas` (`id`, `secuencia`, `nombre`, `imagen`, `texto`, `script`, `orden`) VALUES
(1, 1, 'Inicio 1', 'oak.png', '¡Hola a todos! ¡Bienvenidos al mundo de POKÉMON! ¡Me llamo OAK! ¡Pero la gente me llama el PROFESOR POKÉMON!', '[{"action":"additem","params":{"item":"2"}}]', 0),
(2, 1, 'Oak 2', 'oak(1).png', '¡Este mundo está habitado por unas criaturas llamadas POKÉMON! Para algunos, los POKÉMON son mascotas. Pero otros los usan para pelear.', NULL, 1),
(3, 1, 'Oak 3', 'oak(2).png', 'En cuanto a mí... Estudio a los POKÉMON como profesión. Pero primero dime como te llamas.', NULL, 3),
(4, 1, 'Oak 4', 'oak(3).png', '¡Bien! ¡Tu nombre es _NOMBRE_! Este es mi nieto. Él ha sido tu rival desde que eras un niño. ...Mmm, ¿Podrías decirme cómo se llama?', '[\r\n{"action":"input_text",\r\n"params":{\r\n"opcion":"NOMBRE_RIVAL"\r\n}}\r\n]', 4),
(5, 1, 'Oak malo', 'oak(4).png', 'Deberás elegir', '[{"action":"choices","params":{"opciones":[{"escena":6,"titulo":"Si"},{"escena":7,"titulo":"No"}]}}]', 5),
(6, 1, 'Elegiste bien', 'oak(5).png', 'Elegiste bien _NOMBRE_!!', NULL, 6),
(7, 1, 'Elegiste mal', 'oak(6).png', 'Elegiste muy mal pibe', NULL, 7);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `entrenadores_pokemons`
--
ALTER TABLE `entrenadores_pokemons`
  ADD CONSTRAINT `entrenadores_pokemons_ibfk_1` FOREIGN KEY (`entrenador`) REFERENCES `entrenadores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pokemons_evoluciones`
--
ALTER TABLE `pokemons_evoluciones`
  ADD CONSTRAINT `pokemons_evoluciones_ibfk_1` FOREIGN KEY (`de`) REFERENCES `pokemons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pokemons_evoluciones_ibfk_2` FOREIGN KEY (`a`) REFERENCES `pokemons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
