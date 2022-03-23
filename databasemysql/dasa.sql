-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-03-2022 a las 20:32:31
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `concr_bdportalconcretol`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dasa`
--

CREATE TABLE `dasa` (
  `id` int(11) NOT NULL,
  `documento` varchar(45) DEFAULT NULL,
  `fecha_hora` datetime DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `cliente` varchar(45) DEFAULT NULL,
  `dependencia` varchar(45) DEFAULT NULL,
  `validador` varchar(45) DEFAULT NULL,
  `id_vehiculo` int(11) DEFAULT NULL,
  `placa` varchar(45) DEFAULT NULL,
  `klm` double(11,2) DEFAULT NULL,
  `distancia_recorrida` double(11,2) DEFAULT NULL,
  `producto` varchar(45) DEFAULT NULL,
  `cantidad` double(11,2) DEFAULT NULL,
  `ppu` varchar(45) DEFAULT NULL,
  `iva` varchar(45) DEFAULT NULL,
  `total_producto` varchar(255) DEFAULT NULL,
  `total_documento` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `dasa`
--
ALTER TABLE `dasa`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `dasa`
--
ALTER TABLE `dasa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
