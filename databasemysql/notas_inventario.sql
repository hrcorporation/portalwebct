-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-02-2022 a las 21:59:18
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
-- Estructura de tabla para la tabla `notas_inventario`
--

CREATE TABLE `notas_inventario` (
  `id` int(11) NOT NULL,
  `referencia` int(6) DEFAULT NULL,
  `servicio` varchar(30) DEFAULT NULL,
  `detalle` varchar(40) DEFAULT NULL,
  `cantidad` double(11,2) DEFAULT NULL,
  `precio` double(11,2) DEFAULT NULL,
  `valor_unidad` double(11,2) DEFAULT NULL,
  `valor_iva` double(10,2) DEFAULT NULL,
  `total_mas_valor_iva` double(11,2) DEFAULT NULL,
  `iva` double(5,2) DEFAULT NULL,
  `base_iva` double(10,2) DEFAULT NULL,
  `t_iva` double(11,2) DEFAULT NULL,
  `ico` double(7,2) DEFAULT NULL,
  `referencia1` varchar(50) DEFAULT NULL,
  `referencia2` varchar(50) DEFAULT NULL,
  `referencia3` varchar(50) DEFAULT NULL,
  `referencia4` varchar(50) DEFAULT NULL,
  `unidad` varchar(50) DEFAULT NULL,
  `referencia_proveedor` varchar(50) DEFAULT NULL,
  `tercero` varchar(50) DEFAULT NULL,
  `descripcion_adicional` varchar(50) DEFAULT NULL,
  `fecha_mes` date DEFAULT NULL,
  `planta` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `notas_inventario`
--
ALTER TABLE `notas_inventario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `notas_inventario`
--
ALTER TABLE `notas_inventario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
