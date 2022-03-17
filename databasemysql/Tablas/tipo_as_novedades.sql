-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-03-2022 a las 21:15:18
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
-- Estructura de tabla para la tabla `tipo_as_novedades`
--

CREATE TABLE `tipo_as_novedades` (
  `id` int(11) NOT NULL,
  `id_tipo_novedad` int(11) DEFAULT NULL,
  `id_list_novedad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tipo_as_novedades`
--
ALTER TABLE `tipo_as_novedades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tipo_novedad` (`id_tipo_novedad`),
  ADD KEY `id_list_novedad` (`id_list_novedad`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tipo_as_novedades`
--
ALTER TABLE `tipo_as_novedades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tipo_as_novedades`
--
ALTER TABLE `tipo_as_novedades`
  ADD CONSTRAINT `tipo_as_novedades_ibfk_1` FOREIGN KEY (`id_tipo_novedad`) REFERENCES `tipo_novedad` (`id`),
  ADD CONSTRAINT `tipo_as_novedades_ibfk_2` FOREIGN KEY (`id_list_novedad`) REFERENCES `listado_novedades` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
