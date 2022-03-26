-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-03-2022 a las 20:32:45
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
-- Estructura de tabla para la tabla `gps`
--

CREATE TABLE `gps` (
  `id` int(11) NOT NULL,
  `GroupName` varchar(255) DEFAULT NULL,
  `UnitID` varchar(255) DEFAULT NULL,
  `id_vehiculo` int(11) DEFAULT NULL,
  `UnitName1` varchar(255) DEFAULT NULL,
  `MaxSpeed` varchar(255) DEFAULT NULL,
  `MilesDriven` varchar(255) DEFAULT NULL,
  `TravelTimeSecs` varchar(255) DEFAULT NULL,
  `Textbox3` varchar(255) DEFAULT NULL,
  `IdleTimeSecs` varchar(255) DEFAULT NULL,
  `Textbox6` varchar(255) DEFAULT NULL,
  `IdleTimeSecs2` varchar(255) DEFAULT NULL,
  `Textbox11` varchar(255) DEFAULT NULL,
  `Textbox20` varchar(255) DEFAULT NULL,
  `Textbox21` varchar(255) DEFAULT NULL,
  `Textbox24` varchar(255) DEFAULT NULL,
  `Textbox25` varchar(255) DEFAULT NULL,
  `Textbox26` varchar(255) DEFAULT NULL,
  `Textbox27` varchar(255) DEFAULT NULL,
  `Textbox28` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `gps`
--
ALTER TABLE `gps`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `gps`
--
ALTER TABLE `gps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
