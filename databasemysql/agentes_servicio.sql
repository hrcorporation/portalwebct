-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-03-2022 a las 17:16:25
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
-- Estructura de tabla para la tabla `agentes_servicio`
--

CREATE TABLE `agentes_servicio` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `id_empleado` int(20) DEFAULT NULL,
  `id_rol` int(20) DEFAULT NULL,
  `numero_nomina` int(20) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `entrada_1` time DEFAULT NULL,
  `salida_1` time DEFAULT NULL,
  `entrada_2` time DEFAULT NULL,
  `salida_2` time DEFAULT NULL,
  `entrada_3` time DEFAULT NULL,
  `salida_3` time DEFAULT NULL,
  `h_normales` time DEFAULT NULL,
  `h_ausencias` time DEFAULT NULL,
  `h_extra` time DEFAULT NULL,
  `noc` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `agentes_servicio`
--
ALTER TABLE `agentes_servicio`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `agentes_servicio`
--
ALTER TABLE `agentes_servicio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
