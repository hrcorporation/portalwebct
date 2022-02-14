-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-02-2022 a las 15:12:22
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
-- Estructura de tabla para la tabla `cuentas_por_cobrar_clientes`
--

CREATE TABLE `cuentas_por_cobrar_clientes` (
  `id` int(11) NOT NULL,
  `nit` int(20) DEFAULT NULL,
  `suc_pto` varchar(20) DEFAULT NULL,
  `codigo` int(20) DEFAULT NULL,
  `nombre` varchar(150) DEFAULT NULL,
  `nom_comerc` varchar(150) DEFAULT NULL,
  `telefono` int(20) DEFAULT NULL,
  `celular` int(20) DEFAULT NULL,
  `direccion` varchar(150) DEFAULT NULL,
  `fecha` varchar(150) DEFAULT NULL,
  `vence` varchar(150) DEFAULT NULL,
  `saldo` double(20,2) DEFAULT NULL,
  `sin_vencer` double(20,2) DEFAULT NULL,
  `periodo_1_30` double(20,2) DEFAULT NULL,
  `periodo_31_60` double(20,2) DEFAULT NULL,
  `periodo_61_90` double(20,2) DEFAULT NULL,
  `periodo_91_120` double(20,2) DEFAULT NULL,
  `periodo_121_360` double(20,2) DEFAULT NULL,
  `periodo_mas_361` double(20,2) DEFAULT NULL,
  `meses_vencidos` int(20) DEFAULT NULL,
  `plazo` int(20) DEFAULT NULL,
  `mora` int(20) DEFAULT NULL,
  `numero_externo` int(20) DEFAULT NULL,
  `zona` varchar(150) DEFAULT NULL,
  `fax` int(20) DEFAULT NULL,
  `anticipos` double(20,2) DEFAULT NULL,
  `cupo` double(20,2) DEFAULT NULL,
  `fecha_ultimo_pago` varchar(150) DEFAULT NULL,
  `observaciones` varchar(150) DEFAULT NULL,
  `fecha_corte` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cuentas_por_cobrar_clientes`
--
ALTER TABLE `cuentas_por_cobrar_clientes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cuentas_por_cobrar_clientes`
--
ALTER TABLE `cuentas_por_cobrar_clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
