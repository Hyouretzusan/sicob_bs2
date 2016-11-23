-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 04-10-2013 a las 20:53:42
-- Versión del servidor: 5.1.41
-- Versión de PHP: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES latin1 */;

--
-- Base de datos: `sicob`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autoridades`
--

CREATE TABLE IF NOT EXISTS `autoridades` (
  `autoridad` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `id_autoridades` int(11) NOT NULL,
  `nombre_autoridades` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `cedula_trab` int(11) NOT NULL,
  PRIMARY KEY (`autoridad`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcar la base de datos para la tabla `autoridades`
--

INSERT INTO `autoridades` (`autoridad`, `id_autoridades`, `nombre_autoridades`, `cedula_trab`) VALUES
('Autoridad Unica de Salud', 1, 'Dr. Baldo Espinoza', 0),
('Jefe de Personal', 2, 'Lic. Fransiczoraid R', 0),
('Administrador', 3, 'Lic. Simon Guzman', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `becas`
--

CREATE TABLE IF NOT EXISTS `becas` (
  `codigo_beca` int(11) NOT NULL,
  `monto_beca` float NOT NULL,
  `fecha_beca` date NOT NULL,
  `cedula_trab` int(11) NOT NULL,
  `cedula_fam` int(11) NOT NULL,
  PRIMARY KEY (`codigo_beca`),
  KEY `cedula_trab` (`cedula_trab`,`cedula_fam`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcar la base de datos para la tabla `becas`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beneficios`
--

CREATE TABLE IF NOT EXISTS `beneficios` (
  `id` int(11) NOT NULL,
  `beneficio` varchar(20) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `monto` float NOT NULL,
  `cedula_trab` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `beneficio` (`beneficio`),
  KEY `cedula_trab` (`cedula_trab`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `beneficios`
--

INSERT INTO `beneficios` (`id`, `beneficio`, `monto`, `cedula_trab`) VALUES
(1, 'Medico/Odontologico', 5000, 0),
(2, 'Lentes', 80, 0),
(3, 'Protesis', 10000, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventuales`
--

CREATE TABLE IF NOT EXISTS `eventuales` (
  `codigo_even` varchar(12) COLLATE latin1_spanish_ci NOT NULL,
  `tipo_even` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `monto_even` float NOT NULL,
  `fecha_even` date NOT NULL,
  `cedula_trab` int(11) NOT NULL,
  `cedula_fam` int(11) NOT NULL,
  PRIMARY KEY (`codigo_even`),
  KEY `codigo_trab` (`cedula_trab`,`cedula_fam`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcar la base de datos para la tabla `eventuales`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_fam`
--

CREATE TABLE IF NOT EXISTS `factura_fam` (
  `codigo_facf` int(11) NOT NULL,
  `nombre_facf` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `apellido_facf` varchar(15) COLLATE latin1_spanish_ci NOT NULL,
  `cedula_facf` int(11) NOT NULL,
  `observacion_facf` varchar(200) COLLATE latin1_spanish_ci NOT NULL,
  `fecha_facf` date NOT NULL,
  `monto_facf` float NOT NULL,
  `tipogasto_facf` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `cedula_fam` int(11) NOT NULL,
  PRIMARY KEY (`codigo_facf`),
  KEY `cedula_fam` (`cedula_fam`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcar la base de datos para la tabla `factura_fam`
--

INSERT INTO `factura_fam` (`codigo_facf`, `nombre_facf`, `apellido_facf`, `cedula_facf`, `observacion_facf`, `fecha_facf`, `monto_facf`, `tipogasto_facf`, `cedula_fam`) VALUES
(2, 'Dr. Embuste', '', 0, 'Turururururu', '2013-07-03', 200, '1', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_trab`
--

CREATE TABLE IF NOT EXISTS `factura_trab` (
  `codigo_fact` varchar(12) COLLATE latin1_spanish_ci NOT NULL,
  `nombre_fact` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `apellido_fact` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `cedula_fact` int(11) NOT NULL,
  `observacion_fact` varchar(200) COLLATE latin1_spanish_ci NOT NULL,
  `fecha_fact` date NOT NULL,
  `monto_fact` float NOT NULL,
  `tipogasto_fact` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `cedula_trab` int(11) NOT NULL,
  `identificador` varchar(15) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`codigo_fact`),
  KEY `codigo_trab` (`cedula_trab`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcar la base de datos para la tabla `factura_trab`
--

INSERT INTO `factura_trab` (`codigo_fact`, `nombre_fact`, `apellido_fact`, `cedula_fact`, `observacion_fact`, `fecha_fact`, `monto_fact`, `tipogasto_fact`, `cedula_trab`, `identificador`) VALUES
('1820', 'Dr. Mentira', '', 0, 'Lalalalalalala', '0000-00-00', 200, '', 0, 'Trabajador'),
('1', 'yo', '', 0, '21jlndsnf', '0000-00-00', 300, '', 87654321, ''),
('123', 'lalala', '', 0, 'Probando Fact_fam fact', '0000-00-00', 0, 'Medicinas/Odontologia', 0, ''),
('321', '123', '', 0, 'buscando', '0000-00-00', 0, '', 0, 'Trabajador'),
('9171', 'tururu', '', 0, 'prueba medico/odontologico 5000 - 300 = 4700', '2013-09-13', 300, '', 0, 'Trabajador'),
('23451', 'meh', '', 0, 'meh', '2013-09-13', 300, '', 0, 'Trabajador'),
('44335', 'sera', '', 0, 'sera que al fin 5000 - 300 = 4700', '2013-09-13', 300, '', 0, 'Trabajador'),
('182030', 'meh', '', 0, '5000 - 300 = 4700', '2013-09-13', 300, '', 0, 'Trabajador'),
('90210', 'ni', '', 0, 'prueba 5000 - 300 = 4700', '2013-09-13', 300, '', 0, 'Trabajador'),
('121212', 'wiiiii', '', 0, '80 - 15 = 65', '2013-09-13', 15, '', 0, 'Trabajador'),
('242424', 'WIIIIIIIIIIIIIIIIIIIII', '', 0, '10000 - 5000 = 5000', '2013-09-13', 5000, '', 0, 'Trabajador'),
('323232', 'prueba', '', 0, 'maximo saldo protesis', '2013-09-13', 5001, '', 0, 'Trabajador'),
('233241', 'WIWIWIWIWIWI', '', 0, 'si se puede!!!', '2013-09-13', 350, '', 0, 'Trabajador'),
('293949', 'siiiiiiiii!!!', '', 0, 'prueba final!!!', '2013-09-13', 5001, '', 0, 'Trabajador'),
('9991', 'yuju!!!', '', 0, '5000 - 500 = 4500', '2013-09-13', 500, '', 0, 'Familiar'),
('9999', 'tururu', '', 0, 'limite saldo', '2013-09-16', 4400, '', 0, 'Trabajador'),
('999', '1212', '', 0, 're', '2013-09-16', 70, '', 0, 'Trabajador'),
('222', '222', '', 0, '222', '2013-11-15', 2.22222e+007, '', 0, 'Trabajador'),
('77712', 'asdsfdsg', '', 0, 'asdasdas', '2013-09-16', 4400, '', 0, 'Trabajador'),
('pruebaguarda', '1212121', '', 0, '11111', '2013-09-16', 4400, 'Medicinas/Odontologia', 18928948, 'Trabajador'),
('correctofact', 'tururu', '', 0, 'guarda el monto?', '2013-09-16', 300, 'Medicinas/Odontologia', 18928948, 'Trabajador'),
('113', 'Prueba Exitosa', '', 0, '4750', '2013-09-19', 250, 'Medicinas/Odontologia', 19928948, 'Trabajador'),
('111', 'Y', '', 0, '...', '2013-09-20', 250, 'Medicinas/Odontologia', 19928948, 'Trabajador'),
('3939', '12312', '', 0, '1', '2013-09-20', 300, 'Medicinas/Odontologia', 21000000, 'Familiar'),
('777777777777', '321', '', 0, '1', '2013-09-20', 500, 'Protesis', 21000000, 'Familiar'),
('232309111', '1', '', 0, '121dsf', '2013-09-20', 700, 'Protesis', 21000000, 'Familiar'),
('908070', '1', '', 0, 'prueba', '2013-09-20', 200, 'Protesis', 21000000, 'Familiar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `familiar`
--

CREATE TABLE IF NOT EXISTS `familiar` (
  `cedula_trab` int(11) NOT NULL,
  `cedula_fam` int(11) NOT NULL,
  `apellido_fam` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `nombre_fam` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `sexo_fam` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `parentesco_fam` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `fecnac_fam` date NOT NULL,
  `patologia_fam` varchar(2) COLLATE latin1_spanish_ci NOT NULL,
  `discapacidad_fam` varchar(2) COLLATE latin1_spanish_ci NOT NULL,
  `salmedod_fam` float NOT NULL,
  `sallen_fam` float NOT NULL,
  `salprot_fam` float NOT NULL,
  `codigo_fam` varchar(12) COLLATE latin1_spanish_ci NOT NULL,
  `identificador_fam` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`cedula_fam`),
  UNIQUE KEY `codigo_fam` (`codigo_fam`),
  UNIQUE KEY `codigo_fam_2` (`codigo_fam`),
  UNIQUE KEY `codigo_fam_3` (`codigo_fam`),
  UNIQUE KEY `codigo_fam_4` (`codigo_fam`),
  KEY `codigo_trab` (`cedula_trab`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcar la base de datos para la tabla `familiar`
--

INSERT INTO `familiar` (`cedula_trab`, `cedula_fam`, `apellido_fam`, `nombre_fam`, `sexo_fam`, `parentesco_fam`, `fecnac_fam`, `patologia_fam`, `discapacidad_fam`, `salmedod_fam`, `sallen_fam`, `salprot_fam`, `codigo_fam`, `identificador_fam`) VALUES
(0, 23456789, 'Prueba1', 'Familiar', '1', '1', '0000-00-00', '0', '0', 0, 0, 0, '345678', ''),
(0, 1232434, 'Fam', 'Trabajador', '1', '1', '0000-00-00', '0', '0', 0, 0, 0, '0', ''),
(0, 4444444, '555', '777', 'Masculino', 'Padre', '1998-04-20', 'Si', 'Si', 5000, 0, 0, '9', ''),
(0, 1777777, 'pruebasaldo', 'funciona', 'Femenino', 'Madre', '1996-12-29', 'No', 'No', 5000, 80, 10000, '2123', ''),
(0, 111222333, 'nuevomonto', 'pruebatabla', 'Femenino', 'Hijo/a', '2013-09-10', 'No', 'No', 5000, 0, 0, '9999', ''),
(0, 333222111, 'prueba2', 'montonuevo', 'Masculino', 'Hijo/a', '2013-09-10', 'No', 'No', 5000, 80, 0, '7', ''),
(0, 222111333, 'prueba3', 'montonuevo', 'Femenino', 'Hijo/a', '2013-09-10', 'No', 'No', 5000, 80, 0, '909090', ''),
(0, 333111222, 'prueba4', 'nuevomonto', 'Masculino', 'Hijo/a', '2013-09-10', 'No', 'No', 5000, 80, 10000, '7117', ''),
(18928948, 5393092, 'Martinez', 'Zaida', 'Femenino', 'Madre', '1967-08-20', 'No', 'No', 4500, 80, 10000, '1001', ''),
(18928948, 30000000, 'Guion', 'Artemisa', 'Femenino', 'Hijo/a', '2015-08-30', 'No', 'No', 5000, 80, 10000, '91919191', 'Familiar'),
(6211295, 21000000, 'Suarez', 'Thamauri', 'Femenino', 'Hijo/a', '1988-09-25', 'No', 'No', 4700, 80, 8600, '0000091', 'Familiar'),
(18928948, 1191111, 'Guion', 'Abele', 'Masculino', 'Padre', '1969-04-25', 'No', 'No', 5000, 80, 10000, '9199199', 'Familiar'),
(18928948, 117117117, 'Guion', 'Giunone', 'Femenino', 'Hijo/a', '2015-08-30', 'No', 'No', 5000, 80, 10000, '900811', 'Familiar'),
(18928948, 9870123, 'Guion', 'Franca', 'Femenino', 'Hijo/a', '2016-09-25', 'No', 'No', 5000, 80, 10000, '2989123', 'Familiar'),
(18928948, 443214, 'Guion', 'Geraint', 'Masculino', 'Hijo/a', '2016-09-25', 'No', 'No', 5000, 80, 10000, '32234534', 'Familiar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro`
--

CREATE TABLE IF NOT EXISTS `registro` (
  `nick_usuario` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `ip_registro` varchar(40) COLLATE latin1_spanish_ci NOT NULL,
  `limite_registro` int(11) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_registro` int(11) NOT NULL,
  PRIMARY KEY (`id_registro`),
  KEY `nick_usuario` (`nick_usuario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcar la base de datos para la tabla `registro`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respaldo_fam`
--

CREATE TABLE IF NOT EXISTS `respaldo_fam` (
  `cedula_trab` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `cedula_fam` float NOT NULL,
  `apellido_famr` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `nombre_famr` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `sexo_famr` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `parentesco_famr` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `fecnac_famr` date NOT NULL,
  `patologia_famr` date NOT NULL,
  `discapacidad_famr` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `salmedod_famr` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `sallen_famr` float NOT NULL,
  `salprot_famr` float NOT NULL,
  `codigo_famr` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `identificador_famr` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `anio_famr` year(4) NOT NULL,
  KEY `cedula_trab` (`cedula_trab`),
  KEY `cedula_fam` (`cedula_fam`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcar la base de datos para la tabla `respaldo_fam`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respaldo_trab`
--

CREATE TABLE IF NOT EXISTS `respaldo_trab` (
  `nombre_trabr` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `apellido_trabr` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `cedula_trab` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `codigo_trabr` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `fenac_trabr` date NOT NULL,
  `fecing_trabr` date NOT NULL,
  `salmedod_trabr` float NOT NULL,
  `sallen_trabr` float NOT NULL,
  `salprot_trab` float NOT NULL,
  `sexo_trabr` float NOT NULL,
  `dependencia_trabr` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `cargo_trabr` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `identificador_trabr` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `nick_usuario_trabr` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `anio_trabr` year(4) NOT NULL,
  PRIMARY KEY (`cedula_trab`),
  KEY `cedula_trab` (`cedula_trab`),
  KEY `cedula_trab_2` (`cedula_trab`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcar la base de datos para la tabla `respaldo_trab`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajador`
--

CREATE TABLE IF NOT EXISTS `trabajador` (
  `cedula_trab` int(11) NOT NULL,
  `apellido_trab` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `nombre_trab` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `sexo_trab` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `fecing_trab` date NOT NULL,
  `cargo_trab` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `dependencia_trab` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `codigo_trab` varchar(12) COLLATE latin1_spanish_ci NOT NULL,
  `fecnac_trab` date NOT NULL,
  `salmedod_trab` float NOT NULL,
  `sallen_trab` float NOT NULL,
  `salprot_trab` float NOT NULL,
  `identificador_trab` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `nick_usuario` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`cedula_trab`),
  UNIQUE KEY `cedula_trab` (`cedula_trab`),
  UNIQUE KEY `codigo_trab` (`codigo_trab`),
  UNIQUE KEY `cedula_trab_2` (`cedula_trab`),
  UNIQUE KEY `codigo_trab_2` (`codigo_trab`),
  KEY `nick_trabajador` (`nick_usuario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcar la base de datos para la tabla `trabajador`
--

INSERT INTO `trabajador` (`cedula_trab`, `apellido_trab`, `nombre_trab`, `sexo_trab`, `fecing_trab`, `cargo_trab`, `dependencia_trab`, `codigo_trab`, `fecnac_trab`, `salmedod_trab`, `sallen_trab`, `salprot_trab`, `identificador_trab`, `nick_usuario`) VALUES
(12345678, 'Prueba1', 'Trabajador', 'M', '0000-00-00', 'Prueba', '2', '1.92838e+006', '0000-00-00', 0, 0, 0, '', ''),
(7777, 'Modificar2', 'Trabajadormod', 'Masculino', '2013-09-06', 'probador', 'Obrero', '9999', '1989-09-01', 0, 0, 0, '', ''),
(18928948, 'Guion', 'Claudio', 'Masculino', '2013-04-01', 'Programador', 'Obrero', '7171', '1987-08-10', 4050, 65, 5000, 'Trabajador', ''),
(123223, 'asd', 'dsda', 'Femenino', '0000-00-00', '123213', 'Obrero', '123123', '1969-07-10', 0, 0, 0, '', ''),
(91193211, 'prueba2', 'nuevomontotrab', 'Masculino', '2001-11-20', 'prueba2', 'Obrero', '9.19101e+006', '1978-04-07', 5000, 80, 10000, '', ''),
(19928948, 'Guion', 'Prueba', 'Femenino', '2013-09-19', 'Probador', 'Centralizado', '99', '1987-08-10', 4500, 80, 10000, '', ''),
(6211295, 'Leal', 'Thais', 'Femenino', '2007-03-03', 'Jefa', 'Especifico', '2003', '1967-06-09', 5000, 80, 10000, 'Trabajador', ''),
(20111111, 'Prueba', 'Casi', 'Femenino', '1998-05-21', 'asfg', 'Obrero', '0991', '1977-04-21', 5000, 80, 10000, 'Trabajador', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `nombre_usuario` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `apellido_usuario` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `nick_usuario` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `clave_usuario` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `tipo_usuario` varchar(13) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`nick_usuario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcar la base de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`nombre_usuario`, `apellido_usuario`, `nick_usuario`, `clave_usuario`, `tipo_usuario`) VALUES
('Claudio', 'Guion', 'claudioguion', '1580', 'administrador');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
