-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-02-2022 a las 17:52:17
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
-- Estructura de tabla para la tabla `anexos`
--

CREATE TABLE `anexos` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `id_obra` int(11) DEFAULT NULL,
  `nombre_doc` varchar(255) DEFAULT NULL,
  `archivo_doc` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `anexos`
--

INSERT INTO `anexos` (`id`, `id_cliente`, `id_obra`, `nombre_doc`, `archivo_doc`) VALUES
(3, 2, 194, 'nombre', '/internal/images/anexos/BFBF7F9B69828E8C75C7BDF423A23ECDAC566274.pdf'),
(4, 2, 194, 'nombre', '/internal/images/anexos/68E31018D8A8E4C96DE68B7722F4D598938C9BE5.pdf'),
(5, 2, 174, 'nombre', '/internal/images/anexos/FE0F316303B50FAD53D8B7708A2F7A6856769F91.pdf'),
(6, 2, 174, 'nombre', '/internal/images/anexos/2849B4F9C1A8138482FD82D9040FEAAE604902F9.pdf'),
(7, 2, 174, 'nombre', '/internal/images/anexos/A75404B91B98B13FB7C2407478E6B49E3D7E1091.pdf'),
(8, 2, 194, 'nombre prueba 2', '/internal/images/anexos/FF328D2041F88EC4CB318A6B180913F1AF1CCD3B.pdf');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `anexos`
--
ALTER TABLE `anexos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `anexos`
--
ALTER TABLE `anexos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
