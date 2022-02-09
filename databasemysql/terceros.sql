-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-02-2022 a las 21:54:24
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
-- Estructura de tabla para la tabla `terceros`
--

CREATE TABLE `terceros` (
  `id` int(11) NOT NULL,
  `nit` int(20) DEFAULT NULL,
  `digver` int(2) DEFAULT NULL,
  `claseid` varchar(5) DEFAULT NULL,
  `codigo` int(10) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `nombrec` varchar(100) DEFAULT NULL,
  `nombre1` varchar(100) DEFAULT NULL,
  `nombre2` varchar(100) DEFAULT NULL,
  `apellido1` varchar(10) DEFAULT NULL,
  `apellido2` varchar(10) DEFAULT NULL,
  `perjuridic` tinyint(1) DEFAULT NULL,
  `inactivo` tinyint(1) DEFAULT NULL,
  `dir` varchar(100) DEFAULT NULL,
  `dir2` varchar(100) DEFAULT NULL,
  `tel` int(20) DEFAULT NULL,
  `telmovil` int(10) DEFAULT NULL,
  `fax` int(20) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `email2` varchar(30) DEFAULT NULL,
  `ciudad` int(10) DEFAULT NULL,
  `pais` int(10) DEFAULT NULL,
  `barrio` int(10) DEFAULT NULL,
  `escliente` tinyint(1) DEFAULT NULL,
  `especliente` tinyint(1) DEFAULT NULL,
  `esproveedor` tinyint(1) DEFAULT NULL,
  `esvendedor` tinyint(1) DEFAULT NULL,
  `esasociado` tinyint(1) DEFAULT NULL,
  `exasociado` tinyint(1) DEFAULT NULL,
  `esempleado` tinyint(1) DEFAULT NULL,
  `escobrador` tinyint(1) DEFAULT NULL,
  `escomision` tinyint(1) DEFAULT NULL,
  `escodeudor` tinyint(1) DEFAULT NULL,
  `estranspor` tinyint(1) DEFAULT NULL,
  `esingotter` tinyint(1) DEFAULT NULL,
  `esvehiculo` tinyint(1) DEFAULT NULL,
  `esbanco` tinyint(1) DEFAULT NULL,
  `esoficial` tinyint(1) DEFAULT NULL,
  `esuniofi` tinyint(1) DEFAULT NULL,
  `espatronal` tinyint(1) DEFAULT NULL,
  `esssalud` tinyint(1) DEFAULT NULL,
  `esriesgo` tinyint(1) DEFAULT NULL,
  `escaja` tinyint(1) DEFAULT NULL,
  `espension` tinyint(1) DEFAULT NULL,
  `escesantia` tinyint(1) DEFAULT NULL,
  `esbenefi` tinyint(1) DEFAULT NULL,
  `esasegura` tinyint(1) DEFAULT NULL,
  `vendedor` varchar(100) DEFAULT NULL,
  `cobrador` varchar(100) DEFAULT NULL,
  `propieta` varchar(100) DEFAULT NULL,
  `agnete` tinyint(1) DEFAULT NULL,
  `banco` int(20) DEFAULT NULL,
  `grupo` int(10) DEFAULT NULL,
  `subgrupo` varchar(10) DEFAULT NULL,
  `claseter` varchar(100) DEFAULT NULL,
  `codpostal` varchar(100) DEFAULT NULL,
  `zona` varchar(100) DEFAULT NULL,
  `cupo` int(30) DEFAULT NULL,
  `cupo2` int(30) DEFAULT NULL,
  `califica` varchar(100) DEFAULT NULL,
  `regimen` varchar(100) DEFAULT NULL,
  `regiment` varchar(100) DEFAULT NULL,
  `retefte` tinyint(1) DEFAULT NULL,
  `rettodo` tinyint(1) DEFAULT NULL,
  `noretecre` tinyint(1) DEFAULT NULL,
  `granconte` tinyint(1) DEFAULT NULL,
  `autorete` tinyint(1) DEFAULT NULL,
  `reteica` tinyint(1) DEFAULT NULL,
  `tarica` varchar(100) DEFAULT NULL,
  `noiva` tinyint(1) DEFAULT NULL,
  `actiecon` int(10) DEFAULT NULL,
  `conpub` varchar(100) DEFAULT NULL,
  `encargado` varchar(100) DEFAULT NULL,
  `replegar` varchar(100) DEFAULT NULL,
  `nacio` varchar(100) DEFAULT NULL,
  `precio` int(10) DEFAULT NULL,
  `fpago` varchar(100) DEFAULT NULL,
  `condpago` varchar(100) DEFAULT NULL,
  `nodatacred` tinyint(1) DEFAULT NULL,
  `passcli` varchar(100) DEFAULT NULL,
  `plazomax` int(10) DEFAULT NULL,
  `plazo` int(10) DEFAULT NULL,
  `plazo2` int(10) DEFAULT NULL,
  `plazo3` int(10) DEFAULT NULL,
  `pdtocli` int(10) DEFAULT NULL,
  `pdtocli2` int(10) DEFAULT NULL,
  `pdtocli3` int(10) DEFAULT NULL,
  `tdtocli` varchar(100) DEFAULT NULL,
  `tdtocli2` varchar(100) DEFAULT NULL,
  `tdtocli3` varchar(100) DEFAULT NULL,
  `pdtocond` int(10) DEFAULT NULL,
  `pdtocond2` int(10) DEFAULT NULL,
  `pdtocond3` int(10) DEFAULT NULL,
  `usuario1` varchar(20) DEFAULT NULL,
  `fechar` varchar(100) DEFAULT NULL,
  `fupdateu` varchar(100) DEFAULT NULL,
  `fupdate` varchar(100) DEFAULT NULL,
  `cuentab` int(20) DEFAULT NULL,
  `cuentabac` varchar(100) DEFAULT NULL,
  `codsocial` varchar(100) DEFAULT NULL,
  `codseps` varchar(100) DEFAULT NULL,
  `codafp` varchar(100) DEFAULT NULL,
  `codarp` varchar(100) DEFAULT NULL,
  `codccf` varchar(100) DEFAULT NULL,
  `trecipro` tinyint(1) DEFAULT NULL,
  `latitud` varchar(100) DEFAULT NULL,
  `longitud` varchar(100) DEFAULT NULL,
  `usuario2` varchar(100) DEFAULT NULL,
  `diaconv` varchar(100) DEFAULT NULL,
  `conveniop` tinyint(1) DEFAULT NULL,
  `porcaiua` varchar(100) DEFAULT NULL,
  `porcaiui` varchar(100) DEFAULT NULL,
  `porcariuu` varchar(100) DEFAULT NULL,
  `nodesctos` tinyint(1) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `ultventa` varchar(100) DEFAULT NULL,
  `pfinancia` varchar(100) DEFAULT NULL,
  `declara` varchar(100) DEFAULT NULL,
  `codpub2` varchar(100) DEFAULT NULL,
  `prvtas` tinyint(1) DEFAULT NULL,
  `transporte` varchar(100) DEFAULT NULL,
  `nit2` varchar(100) DEFAULT NULL,
  `ccostos` varchar(100) DEFAULT NULL,
  `scostos` varchar(100) DEFAULT NULL,
  `lugarnac` varchar(100) DEFAULT NULL,
  `difcobro` tinyint(1) DEFAULT NULL,
  `reteiva` tinyint(1) DEFAULT NULL,
  `valdiasm` int(10) DEFAULT NULL,
  `nobomberil` tinyint(1) DEFAULT NULL,
  `bodega` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `terceros`
--
ALTER TABLE `terceros`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `terceros`
--
ALTER TABLE `terceros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
