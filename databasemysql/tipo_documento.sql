-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-02-2022 a las 22:03:42
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
-- Base de datos: `concr_dbportalconcretol`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documento`
--

CREATE TABLE `tipo_documento` (
  `id` int(11) NOT NULL,
  `codigo` varchar(4) DEFAULT NULL,
  `clase_doc` varchar(5) DEFAULT NULL,
  `grupo_td` varchar(100) DEFAULT NULL,
  `libro` varchar(100) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `consec` int(7) DEFAULT NULL,
  `consec_manu` tinyint(1) DEFAULT NULL,
  `conse_nume` tinyint(1) DEFAULT NULL,
  `cero_sconse` int(4) DEFAULT NULL,
  `cambiar` tinyint(1) DEFAULT NULL,
  `inactivo` tinyint(1) DEFAULT NULL,
  `imppos` tinyint(1) DEFAULT NULL,
  `imppos_alt` tinyint(1) DEFAULT NULL,
  `impsermov` tinyint(1) DEFAULT NULL,
  `impper` tinyint(1) DEFAULT NULL,
  `impperx` tinyint(1) DEFAULT NULL,
  `noimp` tinyint(1) DEFAULT NULL,
  `modalidad` varchar(100) DEFAULT NULL,
  `prfrel` varchar(100) DEFAULT NULL,
  `prefijo` varchar(100) DEFAULT NULL,
  `fech_resol` varchar(40) DEFAULT NULL,
  `resol_dian` varchar(100) DEFAULT NULL,
  `desde` varchar(100) DEFAULT NULL,
  `hasta` varchar(100) DEFAULT NULL,
  `eanref_pago` varchar(100) DEFAULT NULL,
  `vres_vence` varchar(50) DEFAULT NULL,
  `vrescon` int(5) DEFAULT NULL,
  `noiva` tinyint(1) DEFAULT NULL,
  `encabe1` varchar(100) DEFAULT NULL,
  `encabe2` varchar(100) DEFAULT NULL,
  `encabe3` varchar(100) DEFAULT NULL,
  `encabe4` varchar(100) DEFAULT NULL,
  `encabe5` varchar(100) DEFAULT NULL,
  `det_pie1` varchar(100) DEFAULT NULL,
  `det_pie2` varchar(100) DEFAULT NULL,
  `det_pie3` varchar(100) DEFAULT NULL,
  `det_pie4` varchar(100) DEFAULT NULL,
  `det_pie5` varchar(100) DEFAULT NULL,
  `fpago` varchar(100) DEFAULT NULL,
  `impnom` tinyint(1) DEFAULT NULL,
  `impdivs` tinyint(1) DEFAULT NULL,
  `precio` double(11,2) DEFAULT NULL,
  `pre_coniva` tinyint(1) DEFAULT NULL,
  `no_desctos` tinyint(1) DEFAULT NULL,
  `iva_consu` tinyint(1) DEFAULT NULL,
  `maxitems` int(5) DEFAULT NULL,
  `maxitemsx` tinyint(1) DEFAULT NULL,
  `c_costo` double(11,2) DEFAULT NULL,
  `su_costo` double(11,2) DEFAULT NULL,
  `c_coxitem` tinyint(1) DEFAULT NULL,
  `impuespec` int(3) DEFAULT NULL,
  `bodega` varchar(100) DEFAULT NULL,
  `bodega2` varchar(100) DEFAULT NULL,
  `forbodega` tinyint(1) DEFAULT NULL,
  `conseevent` int(3) DEFAULT NULL,
  `dataevent` varchar(100) DEFAULT NULL,
  `idsred` varchar(100) DEFAULT NULL,
  `usuper` varchar(100) DEFAULT NULL,
  `usuper2` varchar(100) DEFAULT NULL,
  `usuper3` varchar(100) DEFAULT NULL,
  `usuper4` varchar(100) DEFAULT NULL,
  `maneserv` tinyint(1) DEFAULT NULL,
  `ctarete` varchar(100) DEFAULT NULL,
  `open_cajon` tinyint(1) DEFAULT NULL,
  `utiref1` tinyint(1) DEFAULT NULL,
  `utiref2` tinyint(1) DEFAULT NULL,
  `utiref3` tinyint(1) DEFAULT NULL,
  `utiref4` tinyint(1) DEFAULT NULL,
  `nom_ref1` varchar(100) DEFAULT NULL,
  `nom_ref2` varchar(100) DEFAULT NULL,
  `nom_ref3` varchar(100) DEFAULT NULL,
  `nom_ref4` varchar(100) DEFAULT NULL,
  `cta1` varchar(100) DEFAULT NULL,
  `cta2` varchar(100) DEFAULT NULL,
  `cta3` varchar(100) DEFAULT NULL,
  `cta4` varchar(100) DEFAULT NULL,
  `cta5` varchar(100) DEFAULT NULL,
  `cta6` varchar(100) DEFAULT NULL,
  `cta7` varchar(100) DEFAULT NULL,
  `cta8` varchar(100) DEFAULT NULL,
  `cta9` varchar(100) DEFAULT NULL,
  `cta10` varchar(100) DEFAULT NULL,
  `ncta1` varchar(100) DEFAULT NULL,
  `ncta2` varchar(100) DEFAULT NULL,
  `ncta3` varchar(100) DEFAULT NULL,
  `ncta4` varchar(100) DEFAULT NULL,
  `ncta5` varchar(100) DEFAULT NULL,
  `ncta6` varchar(100) DEFAULT NULL,
  `ncta7` varchar(100) DEFAULT NULL,
  `ncta8` varchar(100) DEFAULT NULL,
  `ncta9` varchar(100) DEFAULT NULL,
  `ncta10` varchar(100) DEFAULT NULL,
  `externo` tinyint(1) DEFAULT NULL,
  `lprefij` tinyint(1) DEFAULT NULL,
  `modo` varchar(100) DEFAULT NULL,
  `noimpnit` tinyint(1) DEFAULT NULL,
  `impposval` tinyint(1) DEFAULT NULL,
  `impitagru` tinyint(1) DEFAULT NULL,
  `impitagrux` tinyint(1) DEFAULT NULL,
  `impobli` int(2) DEFAULT NULL,
  `inveperio` tinyint(1) DEFAULT NULL,
  `porfpago` tinyint(1) DEFAULT NULL,
  `bodega_item` tinyint(1) DEFAULT NULL,
  `recostea` tinyint(1) DEFAULT NULL,
  `vendedor` varchar(100) DEFAULT NULL,
  `ctaretev` varchar(100) DEFAULT NULL,
  `ctaretem` varchar(100) DEFAULT NULL,
  `ctaretes` varchar(100) DEFAULT NULL,
  `ctaretec` varchar(100) DEFAULT NULL,
  `retiva` tinyint(1) DEFAULT NULL,
  `noitdocu` tinyint(1) DEFAULT NULL,
  `contabtr` tinyint(1) DEFAULT NULL,
  `pda` varchar(100) DEFAULT NULL,
  `aiu` tinyint(1) DEFAULT NULL,
  `esentrada` tinyint(1) DEFAULT NULL,
  `esbaja` tinyint(1) DEFAULT NULL,
  `estransfer` tinyint(1) DEFAULT NULL,
  `esresponsa` tinyint(1) DEFAULT NULL,
  `contaimport` tinyint(1) DEFAULT NULL,
  `dias_plazo` int(3) DEFAULT NULL,
  `ver_colter` tinyint(1) DEFAULT NULL,
  `ver_colref` tinyint(1) DEFAULT NULL,
  `nsalconsec` tinyint(1) DEFAULT NULL,
  `imp_copias` int(4) DEFAULT NULL,
  `for_vende` tinyint(1) DEFAULT NULL,
  `lretfte` tinyint(1) DEFAULT NULL,
  `lretcre` tinyint(1) DEFAULT NULL,
  `lretiva` tinyint(1) DEFAULT NULL,
  `lretica` tinyint(1) DEFAULT NULL,
  `solo_fechoy` tinyint(1) DEFAULT NULL,
  `depend` varchar(100) DEFAULT NULL,
  `momod_costo` tinyint(1) DEFAULT NULL,
  `trasla` tinyint(1) DEFAULT NULL,
  `traslasuc` tinyint(1) DEFAULT NULL,
  `vrletras` tinyint(1) DEFAULT NULL,
  `sermov` tinyint(1) DEFAULT NULL,
  `smconsecl` tinyint(1) DEFAULT NULL,
  `olectura` tinyint(1) DEFAULT NULL,
  `noconsolid` tinyint(1) DEFAULT NULL,
  `notainv` varchar(100) DEFAULT NULL,
  `creeuti` tinyint(1) DEFAULT NULL,
  `columniif` tinyint(1) DEFAULT NULL,
  `ctareteiva` varchar(100) DEFAULT NULL,
  `imprimeniif` tinyint(1) DEFAULT NULL,
  `espcdesc` tinyint(1) DEFAULT NULL,
  `meses_hab` varchar(100) DEFAULT NULL,
  `anexo_obli` tinyint(1) DEFAULT NULL,
  `cambios` tinyint(1) DEFAULT NULL,
  `anop` varchar(100) DEFAULT NULL,
  `impitdagr` tinyint(1) DEFAULT NULL,
  `fe_nomline` tinyint(1) DEFAULT NULL,
  `fe_nnotify` tinyint(1) DEFAULT NULL,
  `fe_csfe` tinyint(1) DEFAULT NULL,
  `fe_version` varchar(100) DEFAULT NULL,
  `fe_exporta` tinyint(1) DEFAULT NULL,
  `fe_xmldtos` tinyint(1) DEFAULT NULL,
  `fe_salud` tinyint(1) DEFAULT NULL,
  `fe_saludti` varchar(100) DEFAULT NULL,
  `causadev` varchar(100) DEFAULT NULL,
  `refinven` tinyint(1) DEFAULT NULL,
  `nodtos` tinyint(1) DEFAULT NULL,
  `ver_refpro` tinyint(1) DEFAULT NULL,
  `tpexclrede` tinyint(1) DEFAULT NULL,
  `sermovfe` tinyint(1) DEFAULT NULL,
  `grupoper` varchar(100) DEFAULT NULL,
  `refcompon` tinyint(1) DEFAULT NULL,
  `autoica` tinyint(1) DEFAULT NULL,
  `ver_periodo` tinyint(1) DEFAULT NULL,
  `valnega` tinyint(1) DEFAULT NULL,
  `no_importa` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
