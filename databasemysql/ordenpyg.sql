-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-02-2022 a las 22:06:55
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
-- Estructura de tabla para la tabla `ordenpyg`
--

CREATE TABLE `ordenpyg` (
  `id` int(11) NOT NULL,
  `puc` int(10) DEFAULT NULL,
  `cuenta` varchar(50) DEFAULT NULL,
  `niv1pyg` varchar(50) DEFAULT NULL,
  `niv2pyg` varchar(50) DEFAULT NULL,
  `niv3pyg` varchar(50) DEFAULT NULL,
  `niv4pyg` varchar(50) DEFAULT NULL,
  `idniv4` int(10) DEFAULT NULL,
  `idniv3` varchar(50) DEFAULT NULL,
  `idniv2` int(10) DEFAULT NULL,
  `idniv1` int(10) DEFAULT NULL,
  `nomniv1` varchar(30) DEFAULT NULL,
  `nomniv2` varchar(10) DEFAULT NULL,
  `nomniv3` varchar(30) DEFAULT NULL,
  `nomniv4` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ordenpyg`
--
ALTER TABLE `ordenpyg`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ordenpyg`
--
ALTER TABLE `ordenpyg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
