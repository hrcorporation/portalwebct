-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-02-2022 a las 22:00:04
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
-- Base de datos: `concr_dbportalconcretol`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kardex`
--

CREATE TABLE `kardex` (
  `id` int(11) NOT NULL,
  `l` varchar(50) DEFAULT NULL,
  `fecha` varchar(30) DEFAULT NULL,
  `comprobante` varchar(40) DEFAULT NULL,
  `entradas` double(5,2) DEFAULT NULL,
  `salidas` double(5,2) DEFAULT NULL,
  `saldo` double(11,2) DEFAULT NULL,
  `costo_aplicacion` double(11,2) DEFAULT NULL,
  `costo_promedio` double(11,2) DEFAULT NULL,
  `costo_total_saldo` double(11,2) DEFAULT NULL,
  `detalle1` varchar(40) DEFAULT NULL,
  `numero_ext` int(11) DEFAULT NULL,
  `bodega` varchar(20) DEFAULT NULL,
  `tercero` varchar(20) DEFAULT NULL,
  `nit` int(11) DEFAULT NULL,
  `elaborado` varchar(30) DEFAULT NULL,
  `referencia` int(11) DEFAULT NULL,
  `detalle2` varchar(50) DEFAULT NULL,
  `periodo` varchar(50) DEFAULT NULL,
  `cuenta` int(20) DEFAULT NULL,
  `unidad_medida` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `kardex`
--
ALTER TABLE `kardex`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `kardex`
--
ALTER TABLE `kardex`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
