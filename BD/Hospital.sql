-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-02-2019 a las 09:18:24
-- Versión del servidor: 10.1.35-MariaDB
-- Versión de PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `hospital`
--
DROP DATABASE IF EXISTS `hospital`;
CREATE DATABASE IF NOT EXISTS `hospital` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish2_ci;
USE `hospital`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctores`
--

CREATE TABLE `doctores` (
  `DNI` varchar(9) COLLATE utf8_spanish2_ci NOT NULL,
  `PASSWORD` varchar(80) COLLATE utf8_spanish2_ci NOT NULL,
  `NOMBRE` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `APELLIDOS` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `CORREO` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `DIRECCION` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `CPOSTAL` varchar(5) COLLATE utf8_spanish2_ci NOT NULL,
  `CIUDAD` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `PROVINCIA` varchar(20) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `doctores`
--

INSERT INTO `doctores` (`DNI`, `PASSWORD`, `NOMBRE`, `APELLIDOS`, `CORREO`, `DIRECCION`, `CPOSTAL`, `CIUDAD`, `PROVINCIA`) VALUES
('17026613N', 'c2fc2f64438b1eb36b7e244bdb7bd535', 'Miguel', 'Merino Pola', 'miguelbobo@hotm', 'c/Hernando Acuña', '47014', 'Valladolid', 'Valladolid'),
('71164469P', '21232f297a57a5a743894a0e4a801fc3', 'Jesus', 'Gonzalez Gonzalez', 'jesusgg@tonto.e', 'c/Hernando Acuña', '47014', 'Valladolid', 'Valladolid');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `DNI` varchar(9) COLLATE utf8_spanish2_ci NOT NULL,
  `NOMBRE` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `APELLIDOS` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `CORREO` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `DIRECCION` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `CPOSTAL` varchar(5) COLLATE utf8_spanish2_ci NOT NULL,
  `CIUDAD` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `PROVINCIA` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `EXPEDIENTE` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `SEVERIDAD` enum('Alta','Media','Baja') COLLATE utf8_spanish2_ci NOT NULL,
  `DNI_DOCTOR` varchar(9) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`DNI`, `NOMBRE`, `APELLIDOS`, `CORREO`, `DIRECCION`, `CPOSTAL`, `CIUDAD`, `PROVINCIA`, `EXPEDIENTE`, `SEVERIDAD`, `DNI_DOCTOR`) VALUES
('28687120W', 'Miguel', 'Pola', 'miguelbobo@hotmail.es', 'c/Hernando Acuña', '47014', 'Valladolid', 'Valladolid', 'gfhgfhgfhf', 'Alta', '71164469P'),
('29115331E', 'dsfdsfdsf', 'Gonzalezretretre', 'jesusgg@ygjyuiyewrwrqewew.es', 'c/Hernando Acuña', '47014', 'Valladolid', 'Valladolid', 'gfhgfhgfhgf', 'Alta', '71164469P'),
('41321025F', 'oygougo', 'ogoygogo', 'oiyguo@oiygoi.es', 'ohugouyg', 'ugoug', 'ougugu', 'ugugoyu', 'dfsggfdgdf', 'Alta', '71164469P'),
('42190074R', 'rfghtghr', 'fgrfgfgfg', 'gdsgdfsg@rfeg.es', 'fgrgrgg', '47014', 'Valladolid', 'Valladolid', 'dsfgdfhgfhgf', 'Media', '71164469P'),
('63742859S', 'oigigoigo', 'gougougoug', 'uyg@iufouf.es', 'hjguygoug', 'ufuyf', 'uyfoufou', 'fuyfoufu', 'fdsfdsfs', 'Alta', '71164469P'),
('72504911X', 'sdfdsfdsfds', 'ogoygogo', 'sdfdsfdsoiyguo@dsfdsdfgdfg.es', 'ohugouyg', 'ugoug', 'ougugu', 'ugugoyu', 'ghghj', 'Alta', '71164469P'),
('76769456X', 'ththhdfghgfh', 'thththfghgfhgf', 'htehth@qwewrqteygfhgfh.es', 'dgregreg', 'egfrf', 'regrgr', 'rgrgr', 'gfhgfhgfhgf', 'Alta', '71164469P'),
('80146776X', 'ththh', 'thhth ththth', 'htehth@dsgrwg.es', 'dgregreg', 'egfrf', 'regrgr', 'rgrgr', 'bhkghkjghj', 'Alta', '71164469P'),
('86183374M', 'jghjghjghjg', 'tyryrty', 'dsfdsfrewew@aweawsad.es', 'c/Hernando Acuña', '47014', 'Valladolid', 'Valladolid', 'ghjuhg', 'Alta', '71164469P'),
('94772655M', 'Jesus', 'Gonzalez', 'jesusgg@tonto.es', 'c/Hernando Acuña', '47014', 'Valladolid', 'Valladolid', 'cvghgfh', 'Alta', '71164469P');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `doctores`
--
ALTER TABLE `doctores`
  ADD PRIMARY KEY (`DNI`),
  ADD UNIQUE KEY `CORREO` (`CORREO`),
  ADD UNIQUE KEY `PASSWORD` (`PASSWORD`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`DNI`),
  ADD UNIQUE KEY `CORREO` (`CORREO`),
  ADD KEY `DNI_DOCTOR` (`DNI_DOCTOR`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD CONSTRAINT `pacientes_ibfk_1` FOREIGN KEY (`DNI_DOCTOR`) REFERENCES `doctores` (`DNI`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
