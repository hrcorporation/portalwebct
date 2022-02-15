-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-02-2022 a las 17:51:42
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
-- Estructura de tabla para la tabla `balance_corporativo`
--

CREATE TABLE `balance_corporativo` (
  `id` int(11) NOT NULL,
  `puc` int(11) DEFAULT NULL,
  `terceros` varchar(50) DEFAULT NULL,
  `cco` varchar(20) DEFAULT NULL,
  `scc` varchar(50) DEFAULT NULL,
  `nombre` varchar(20) DEFAULT NULL,
  `saldo_anterior` double(15,2) DEFAULT NULL,
  `movimiento_debito` double(15,2) DEFAULT NULL,
  `movimiento_credito` double(15,2) DEFAULT NULL,
  `nuevo_saldo` double(15,2) DEFAULT NULL,
  `fecha_corte` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `balance_corporativo`
--

INSERT INTO `balance_corporativo` (`id`, `puc`, `terceros`, `cco`, `scc`, `nombre`, `saldo_anterior`, `movimiento_debito`, `movimiento_credito`, `nuevo_saldo`, `fecha_corte`) VALUES
(1, 1, '                ', '      ', '      ', 'ACTIVO              ', 9544770615.00, 6087304084.00, 5749755618.00, 9882319081.00, '2019-01-31'),
(2, 11, '                ', '      ', '      ', 'Efectivo y Equivalen', 1308217828.00, 1633673984.00, 2263792399.00, 678099412.00, '2019-01-31'),
(3, 1105, '                ', '      ', '      ', 'CAJA                ', 1000600.00, 16479216.00, 15933016.00, 1546800.00, '2019-01-31'),
(4, 110505, '                ', '      ', '      ', 'Caja general        ', 600.00, 15979216.00, 15933016.00, 46800.00, '2019-01-31'),
(5, 110512, '                ', '      ', '      ', 'Caja Menor Compras &', 1000000.00, 500000.00, 0.00, 1500000.00, '2019-01-31'),
(6, 1110, '                ', '      ', '      ', 'BANCOS              ', 1304655213.00, 1297135976.00, 2147859383.00, 453931805.00, '2019-01-31'),
(7, 111005, '                ', '      ', '      ', 'Moneda nacional     ', 1304655213.00, 1297135976.00, 2147859383.00, 453931805.00, '2019-01-31');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `balance_corporativo`
--
ALTER TABLE `balance_corporativo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `balance_corporativo`
--
ALTER TABLE `balance_corporativo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
