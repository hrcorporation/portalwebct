-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-03-2022 a las 21:13:42
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
-- Estructura de tabla para la tabla `novedades_generales`
--

CREATE TABLE `novedades_generales` (
  `id` int(11) NOT NULL,
  `id_novedad` int(11) DEFAULT NULL,
  `id_tipo_novedad` int(11) DEFAULT NULL,
  `tipo_novedad` varchar(255) DEFAULT NULL,
  `id_area_afectada` int(11) DEFAULT NULL,
  `area_afectada` varchar(255) DEFAULT NULL,
  `id_listado_novedad` int(11) DEFAULT NULL,
  `novedad` varchar(255) DEFAULT NULL,
  `observacion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `novedades_generales`
--
ALTER TABLE `novedades_generales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_novedad` (`id_novedad`),
  ADD KEY `id_tipo_novedad` (`id_tipo_novedad`),
  ADD KEY `id_area_afectada` (`id_area_afectada`),
  ADD KEY `id_listado_novedad` (`id_listado_novedad`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `novedades_generales`
--
ALTER TABLE `novedades_generales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `novedades_generales`
--
ALTER TABLE `novedades_generales`
  ADD CONSTRAINT `novedades_generales_ibfk_1` FOREIGN KEY (`id_novedad`) REFERENCES `novedades_despacho` (`id`),
  ADD CONSTRAINT `novedades_generales_ibfk_2` FOREIGN KEY (`id_tipo_novedad`) REFERENCES `tipo_novedad` (`id`),
  ADD CONSTRAINT `novedades_generales_ibfk_3` FOREIGN KEY (`id_area_afectada`) REFERENCES `areas_afectadas_novedades` (`id`),
  ADD CONSTRAINT `novedades_generales_ibfk_4` FOREIGN KEY (`id_listado_novedad`) REFERENCES `listado_novedades` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
