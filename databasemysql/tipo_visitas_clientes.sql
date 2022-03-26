-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-03-2022 a las 20:22:08
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
-- Estructura de tabla para la tabla `tipo_visitas_clientes`
--

CREATE TABLE `tipo_visitas_clientes` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo_visitas_clientes`
--

INSERT INTO `tipo_visitas_clientes` (`id`, `descripcion`) VALUES
(1, 'ATENCION PQRS'),
(2, 'GESTION DE CARTERA'),
(3, 'SOLICITUD CLIENTE'),
(4, 'GESTION ORDEN DE COMPRA'),
(5, 'ENTRADA DE ALMACEN'),
(6, 'COMITE DE SEGUIMIENTO'),
(7, 'COMITE INICIO DE OBRA'),
(8, 'NEGOCIACION PRECIO'),
(9, 'PRODUCTOS'),
(10, 'ACOMPAÑAMIENTO AL AREA DE CALIDAD'),
(11, 'ACOMPAÑAMIENTO AL AREA DE SST'),
(12, 'ACOMPAÑAMIENTO DE PRODUCCION LOGISTICA'),
(13, 'VERIFICACION FUNDIDA');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tipo_visitas_clientes`
--
ALTER TABLE `tipo_visitas_clientes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tipo_visitas_clientes`
--
ALTER TABLE `tipo_visitas_clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
