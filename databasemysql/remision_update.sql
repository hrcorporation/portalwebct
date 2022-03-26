-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-03-2022 a las 14:11:26
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
-- Estructura de tabla para la tabla `remision_update`
--

CREATE TABLE `remision_update` (
  `id` int(11) NOT NULL,
  `hora` time DEFAULT NULL,
  `numero_remision` varchar(100) DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `id_obra` int(11) DEFAULT NULL,
  `doc_remi` varchar(255) DEFAULT NULL,
  `id_vehiculo` int(11) DEFAULT NULL,
  `id_conductor` int(11) DEFAULT NULL,
  `metros` double(50,2) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `asentamiento` varchar(100) DEFAULT NULL,
  `sello` varchar(100) DEFAULT NULL,
  `estado` int(10) DEFAULT NULL,
  `hora_salida_planta` time DEFAULT NULL,
  `hora_llegada_obra` time DEFAULT NULL,
  `hora_inicio_descargue` time DEFAULT NULL,
  `hora_terminada_descargue` time DEFAULT NULL,
  `hora_llegada_planta` time DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `nombre_usuario` varchar(50) DEFAULT NULL,
  `fecha_modificacion` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `remision_update`
--
ALTER TABLE `remision_update`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `remision_update`
--
ALTER TABLE `remision_update`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
