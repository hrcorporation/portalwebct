-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-02-2022 a las 21:58:12
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
-- Estructura de tabla para la tabla `movimiento_diario`
--

CREATE TABLE `movimiento_diario` (
  `id` int(11) NOT NULL,
  `tipo` varchar(5) DEFAULT NULL,
  `numero` int(10) DEFAULT NULL,
  `numero_cheque` int(10) DEFAULT NULL,
  `Num_extension` int(11) DEFAULT NULL,
  `anio` int(4) DEFAULT NULL,
  `mes` int(2) DEFAULT NULL,
  `dia` int(2) DEFAULT NULL,
  `cuenta` int(11) DEFAULT NULL,
  `nit` int(11) DEFAULT NULL,
  `terceros` varchar(50) DEFAULT NULL,
  `suc_pto` varchar(50) DEFAULT NULL,
  `drocela` varchar(20) DEFAULT NULL,
  `c_costo` double(11,2) DEFAULT NULL,
  `sc_costo` double(11,2) DEFAULT NULL,
  `detalles` varchar(40) DEFAULT NULL,
  `debito` double(11,2) DEFAULT NULL,
  `credito` double(11,2) DEFAULT NULL,
  `elaborado` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `movimiento_diario`
--
ALTER TABLE `movimiento_diario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `movimiento_diario`
--
ALTER TABLE `movimiento_diario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
