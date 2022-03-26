-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-03-2022 a las 21:13:21
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
-- Estructura de tabla para la tabla `novedades_has_clientes`
--

CREATE TABLE `novedades_has_clientes` (
  `id` int(11) NOT NULL,
  `id_novedad` int(11) DEFAULT NULL,
  `id_cliente` bigint(11) DEFAULT NULL,
  `nombre_cliente` varchar(50) DEFAULT NULL,
  `id_obra` bigint(11) DEFAULT NULL,
  `nombre_obra` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `novedades_has_clientes`
--
ALTER TABLE `novedades_has_clientes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_obra` (`id_obra`),
  ADD KEY `id_novedad` (`id_novedad`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `novedades_has_clientes`
--
ALTER TABLE `novedades_has_clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `novedades_has_clientes`
--
ALTER TABLE `novedades_has_clientes`
  ADD CONSTRAINT `novedades_has_clientes_ibfk_1` FOREIGN KEY (`id_novedad`) REFERENCES `novedades_despacho` (`id`),
  ADD CONSTRAINT `novedades_has_clientes_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `ct1_terceros` (`ct1_IdTerceros`),
  ADD CONSTRAINT `novedades_has_clientes_ibfk_3` FOREIGN KEY (`id_obra`) REFERENCES `ct5_obras` (`ct5_IdObras`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
