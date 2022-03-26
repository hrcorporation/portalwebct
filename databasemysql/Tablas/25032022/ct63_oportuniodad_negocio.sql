-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-03-2022 a las 17:13:33
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
-- Estructura de tabla para la tabla `ct63_oportuniodad_negocio`
--

CREATE TABLE `ct63_oportuniodad_negocio` (
  `id` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `id_sede` int(11) DEFAULT NULL,
  `nombre_sede` varchar(255) DEFAULT NULL,
  `asesora_comercial` int(11) DEFAULT NULL,
  `fecha_contacto` date DEFAULT NULL,
  `tipo_cliente` int(11) DEFAULT NULL,
  `tipo_plan_maestro` int(11) DEFAULT NULL,
  `departamento` int(11) DEFAULT NULL,
  `municipio` int(11) DEFAULT NULL,
  `comuna` varchar(70) DEFAULT NULL,
  `barrio` varchar(70) DEFAULT NULL,
  `nidentificacion` varchar(80) DEFAULT NULL,
  `razon_social` varchar(255) DEFAULT NULL,
  `nombrescompletos` varchar(80) DEFAULT NULL,
  `apellidoscompletos` varchar(80) DEFAULT NULL,
  `nombre_obra` varchar(100) DEFAULT NULL,
  `direccion_obra` varchar(100) DEFAULT NULL,
  `telefono_cliente` varchar(100) DEFAULT NULL,
  `nombre_maestro` varchar(100) DEFAULT NULL,
  `celular_maestro` varchar(100) DEFAULT NULL,
  `m3_potenciales` double(70,5) DEFAULT NULL,
  `fecha_posible_fundida` date DEFAULT NULL,
  `resultado` int(11) DEFAULT 3,
  `contacto_cliente` int(11) DEFAULT NULL,
  `observacion` varchar(255) DEFAULT NULL,
  `status_op` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ct63_oportuniodad_negocio`
--
ALTER TABLE `ct63_oportuniodad_negocio`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ct63_oportuniodad_negocio`
--
ALTER TABLE `ct63_oportuniodad_negocio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
