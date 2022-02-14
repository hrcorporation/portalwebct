-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-02-2022 a las 15:52:23
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
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `id` int(11) NOT NULL,
  `venta_devolucion` varchar(100) DEFAULT NULL,
  `tipo_comprobante` varchar(100) DEFAULT NULL,
  `numero` varchar(50) DEFAULT NULL,
  `numero_externo` int(20) DEFAULT NULL,
  `anio` int(20) DEFAULT NULL,
  `mes` int(20) DEFAULT NULL,
  `dia` int(20) DEFAULT NULL,
  `fecha` varchar(100) DEFAULT NULL,
  `cliente` varchar(100) DEFAULT NULL,
  `razon_social` varchar(100) DEFAULT NULL,
  `persona_juridica` varchar(50) DEFAULT NULL,
  `nombre_comercial` varchar(100) DEFAULT NULL,
  `cod_tercero` varchar(50) DEFAULT NULL,
  `suc_pto` varchar(50) DEFAULT NULL,
  `grupo_cliente` varchar(100) DEFAULT NULL,
  `subgrupo_cliente` varchar(100) DEFAULT NULL,
  `codigo_vendedor` varchar(100) DEFAULT NULL,
  `identificador_vendedor` varchar(50) DEFAULT NULL,
  `vendedor` varchar(100) DEFAULT NULL,
  `anexo_1` varchar(100) DEFAULT NULL,
  `anexo_2` varchar(100) DEFAULT NULL,
  `anexo_3` varchar(100) DEFAULT NULL,
  `referencia` varchar(50) DEFAULT NULL,
  `referencia2` varchar(100) DEFAULT NULL,
  `servicio` varchar(50) DEFAULT NULL,
  `codigo_barras` varchar(100) DEFAULT NULL,
  `referencia_proveedor` varchar(100) DEFAULT NULL,
  `detalle_comprobante` varchar(100) DEFAULT NULL,
  `detalle_item` varchar(100) DEFAULT NULL,
  `informacion_adicional_item` varchar(100) DEFAULT NULL,
  `unidad` varchar(100) DEFAULT NULL,
  `linea` varchar(100) DEFAULT NULL,
  `marca` varchar(100) DEFAULT NULL,
  `grupo` varchar(100) DEFAULT NULL,
  `subgrupo` varchar(100) DEFAULT NULL,
  `grupo_produccion` varchar(100) DEFAULT NULL,
  `grupo_servicio` varchar(100) DEFAULT NULL,
  `serial` varchar(100) DEFAULT NULL,
  `cantidad_venta` int(20) DEFAULT NULL,
  `cantidad_factor_1` int(20) DEFAULT NULL,
  `cantidad_factor_2` int(20) DEFAULT NULL,
  `unidad_ensamble` int(20) DEFAULT NULL,
  `cajas` double(5,2) DEFAULT NULL,
  `cantidad_devolucion` int(20) DEFAULT NULL,
  `peso` double(5,2) DEFAULT NULL,
  `valor_unidad_venta` double(11,2) DEFAULT NULL,
  `valor_total_venta` double(11,2) DEFAULT NULL,
  `precio_sugerido` double(11,2) DEFAULT NULL,
  `porcentaje_iva` int(20) DEFAULT NULL,
  `valor_iva` double(6,2) DEFAULT NULL,
  `valor_impoconsumo` double(6,2) DEFAULT NULL,
  `costo_unitario` double(11,2) DEFAULT NULL,
  `costo_total` double(11,2) DEFAULT NULL,
  `utilidad` double(11,2) DEFAULT NULL,
  `porcentaje_utilidad` double(2,2) DEFAULT NULL,
  `porcentaje_rentabilidad` double(2,2) DEFAULT NULL,
  `valor_fletes` double(6,2) DEFAULT NULL,
  `valor_fletes_catalogo_articulo` double(11,2) DEFAULT NULL,
  `valor_descuento_comercial` double(5,2) DEFAULT NULL,
  `porcentaje_descuento_comercial` int(20) DEFAULT NULL,
  `porcentaje_descuento_especial` int(20) DEFAULT NULL,
  `valor_descuento_financiero` double(5,2) DEFAULT NULL,
  `porcentaje_descuento_financiero` int(20) DEFAULT NULL,
  `ciudad` varchar(100) DEFAULT NULL,
  `departamento` varchar(100) DEFAULT NULL,
  `zona` varchar(100) DEFAULT NULL,
  `dia_vencimiento` int(20) DEFAULT NULL,
  `mes_vencimiento` int(20) DEFAULT NULL,
  `anio_vencimiento` int(20) DEFAULT NULL,
  `codigo_linea_credito` varchar(100) DEFAULT NULL,
  `linea_credito` varchar(100) DEFAULT NULL,
  `dias_plazo` int(20) DEFAULT NULL,
  `dia_pago` int(20) DEFAULT NULL,
  `mes_pago` int(20) DEFAULT NULL,
  `anio_pago` int(20) DEFAULT NULL,
  `dias_pago` int(20) DEFAULT NULL,
  `forma_pago` varchar(100) DEFAULT NULL,
  `precio` double(11,2) DEFAULT NULL,
  `referencia_pago_1` varchar(100) DEFAULT NULL,
  `referencia_pago_2` varchar(100) DEFAULT NULL,
  `referencia_pago_3` varchar(100) DEFAULT NULL,
  `referencia_pago_4` varchar(100) DEFAULT NULL,
  `descripcion_item` varchar(100) DEFAULT NULL,
  `numero_lote` varchar(100) DEFAULT NULL,
  `talla_identificador` varchar(100) DEFAULT NULL,
  `talla` varchar(100) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `telefono` int(20) DEFAULT NULL,
  `bodega` varchar(100) DEFAULT NULL,
  `bodega_item` varchar(100) DEFAULT NULL,
  `proyecto` varchar(100) DEFAULT NULL,
  `centro_costos` varchar(100) DEFAULT NULL,
  `nit` int(20) DEFAULT NULL,
  `dig_verificacion` int(20) DEFAULT NULL,
  `tipo_id` int(20) DEFAULT NULL,
  `cod_suc` tinyint(1) DEFAULT NULL,
  `semana_anio` int(20) DEFAULT NULL,
  `semana_mes` int(20) DEFAULT NULL,
  `codigo_departamento` int(20) DEFAULT NULL,
  `codigo_ciudad` int(20) DEFAULT NULL,
  `primer_nombre` varchar(100) DEFAULT NULL,
  `segundo_nombre` varchar(100) DEFAULT NULL,
  `primer_apellido` varchar(100) DEFAULT NULL,
  `segundo_apellido` varchar(100) DEFAULT NULL,
  `telefonos` int(20) DEFAULT NULL,
  `telefono_movil` int(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `cliente_inactivo` varchar(2) DEFAULT NULL,
  `dia_semana` varchar(100) DEFAULT NULL,
  `barrio` varchar(100) DEFAULT NULL,
  `usuario_elaboro` varchar(100) DEFAULT NULL,
  `agente_comercial` varchar(100) DEFAULT NULL,
  `regimen_ventas` varchar(100) DEFAULT NULL,
  `declaracion_renta` tinyint(1) DEFAULT NULL,
  `agente_retenedor` tinyint(1) DEFAULT NULL,
  `auto_retenedor` tinyint(1) DEFAULT NULL,
  `no_aplica_impuesto_cree` tinyint(1) DEFAULT NULL,
  `agente_retenedor_ica` tinyint(1) DEFAULT NULL,
  `causas_devolucion` varchar(100) DEFAULT NULL,
  `base_calculo_interes_fac_lote` int(20) DEFAULT NULL,
  `porcentaje_interes_fact_lote` int(20) DEFAULT NULL,
  `hora_elaboracion_factura` int(20) DEFAULT NULL,
  `fecha_ingreso` varchar(100) DEFAULT NULL,
  `estado_subtercero` varchar(100) DEFAULT NULL,
  `ficha_catastral` varchar(100) DEFAULT NULL,
  `num_medidor` varchar(100) DEFAULT NULL,
  `centro_costos_item` varchar(100) DEFAULT NULL,
  `subcentro_costos_item` varchar(100) DEFAULT NULL,
  `tercero_item` varchar(100) DEFAULT NULL,
  `tarifa_iva_catalogo_servicio_articulo` int(20) DEFAULT NULL,
  `porcentaje_iva_catalogo_servicio_articulo` int(20) DEFAULT NULL,
  `nombre_tarifa_iva_aplicada` varchar(100) DEFAULT NULL,
  `direccion_area` varchar(100) DEFAULT NULL,
  `telefono_area` int(20) DEFAULT NULL,
  `fax_area` varchar(100) DEFAULT NULL,
  `ciudad_area` varchar(100) DEFAULT NULL,
  `email_area` varchar(100) DEFAULT NULL,
  `email_fe_area` varchar(100) DEFAULT NULL,
  `barrio_area` varchar(100) DEFAULT NULL,
  `afecta` varchar(100) DEFAULT NULL,
  `cantidad_parcial_entregada` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
