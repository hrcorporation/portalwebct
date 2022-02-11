<?php
class cls_importdata extends conexionPDO
{

    public $con;

    // Iniciar Conexion
    public function __construct()
    {
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
    }


    function insert_terceros(array $array_datos)
    {
        if(is_array($array_datos))
        {
            foreach ($array_datos as $row) {
                
  
    $sql=" INSERT INTO `terceros`( `nit`, `digver`, `claseid`, `codigo`, `nombre`, `nombrec`, `nombre1`, `nombre2`, `apellido1`, `apellido2`, `perjuridic`, `inactivo`, `dir`, `dir2`, `tel`, `telmovil`, `fax`, `email`, `email2`, `ciudad`, `pais`, `barrio`, `escliente`, `especliente`, `esproveedor`, `esvendedor`, `esasociado`, `exasociado`, `esempleado`, `escobrador`, `escomision`, `escodeudor`, `estranspor`, `esingotter`, `esvehiculo`, `esbanco`, `esoficial`, `esuniofi`, `espatronal`, `esssalud`, `esriesgo`, `escaja`, `espension`, `escesantia`, `esbenefi`, `esasegura`, `vendedor`, `cobrador`, `propieta`, `agnete`, `banco`, `grupo`, `subgrupo`, `claseter`, `codpostal`, `zona`, `cupo`, `cupo2`, `califica`, `regimen`, `regiment`, `retefte`, `rettodo`, `noretecre`, `granconte`, `autorete`, `reteica`, `tarica`, `noiva`, `actiecon`, `conpub`, `encargado`, `replegar`, `nacio`, `precio`, `fpago`, `condpago`, `nodatacred`, `passcli`, `plazomax`, `plazo`, `plazo2`, `plazo3`, `pdtocli`, `pdtocli2`, `pdtocli3`, `tdtocli`, `tdtocli2`, `tdtocli3`, `pdtocond`, `pdtocond2`, `pdtocond3`, `usuario1`, `fechar`, `fupdateu`, `fupdate`, `cuentab`, `cuentabac`, `codsocial`, `codseps`, `codafp`, `codarp`, `codccf`, `trecipro`, `latitud`, `longitud`, `usuario2`, `diaconv`, `conveniop`, `porcaiua`, `porcaiui`, `porcariuu`, `nodesctos`, `foto`, `ultventa`, `pfinancia`, `declara`, `codpub2`, `prvtas`, `transporte`, `nit2`, `ccostos`, `scostos`, `lugarnac`, `difcobro`, `reteiva`, `valdiasm`, `nobomberil`, `bodega`) VALUES (:nit,:digver,:claseid,:codigo,:nombre,:nombrec,:nombre1,:nombre2,:apellido1,:apellido2,:perjuridic,:inactivo,:dir,:dir2,:tel,:telmovil,:fax,:email,:email2,:ciudad,:pais,:escliente,:especliente,:esproveedor,:esvendedor,:esasociado,:exasociado,:esempleado,:escobrador,:escomision,:escodeudor,:estranspor,:esingotter,:esvehiculo,:esbanco,:esoficial,:esuniofi,:espatronal,:esssalud,:esriesgo,:escaja,:espension,:escesantia,:esbenefi,:esasegura,:vendedor,:cobrador,:propieta,:agnete,:banco,:grupo,:subgrupo,:claseter,:codpostal,:zona,:cupo,:cupo2,:califica,:regimen,:regiment,:retefte,:rettodo,:noretecre,:granconte,:autorete,:reteica,:tarica,:noiva,:actiecon,:conpub,:encargado,:replegar,:nacio,:precio,:fpago,:condpago,:nodatacred,:passcli,:plazomax,:plazo,:plazo2,:plazo3,:pdtocli,:pdtocli2,:pdtocli3,:tdtocli,:tdtocli2,:tdtocli3,:pdtocond,:pdtocond2,:pdtocond3,:usuario1,:fechar,:fupdateu,:fupdate,:cuentab,:cuentabac,:codsocial,:codseps,:codafp,:codarp,:codccf,:trecipro,:latitud,:longitud,:usuario2,:diaconv,:conveniop,:porcaiua,:porcaiui,:porcariuu,:nodesctos,:foto,:ultventa,:pfinancia,:declara,:codpub2,:prvtas,:transporte,:nit2,:ccostos,:scostos,:lugarnac,:difcobro,:reteiva,:valdiasm,:nobomberil,:bodega)";
                $stmt = $this->con->prepare($sql); // Preparar la conexion
                $stmt->bindParam(':nit', $row['nit'], PDO::PARAM_STR);
                $stmt->bindParam(':digver', $row['digver'], PDO::PARAM_STR);
                $stmt->bindParam(':claseid', $row['claseid'], PDO::PARAM_STR);
                $stmt->bindParam(':codigo', $row['codigo'], PDO::PARAM_STR);
                $stmt->bindParam(':nombre', $row['nombre'], PDO::PARAM_STR);
                $stmt->bindParam(':nombrec', $row['nombrec'], PDO::PARAM_STR);
                $stmt->bindParam(':nombre1', $row['nombre1'], PDO::PARAM_STR);
                $stmt->bindParam(':nombre2', $row['nombre2'], PDO::PARAM_STR);
                $stmt->bindParam(':apellido1', $row['apellido1'], PDO::PARAM_STR);
                $stmt->bindParam(':apellido2', $row['apellido2'], PDO::PARAM_STR);
                $stmt->bindParam(':perjuridic', $row['perjuridic'], PDO::PARAM_STR);
                $stmt->bindParam(':inactivo', $row['inactivo'], PDO::PARAM_STR);
                $stmt->bindParam(':dir', $row['dir'], PDO::PARAM_STR);
                $stmt->bindParam(':dir2', $row['dir2'], PDO::PARAM_STR);
                $stmt->bindParam(':dir2', $row['dir2'], PDO::PARAM_STR);

                if ($stmt->execute()) { // Ejecutar
                    $result = " Exitosso";
                }else{
                    $result = "Error";

                }

            }
            return $result;
        }else{
            return false;
        }
        
    }

    function insert_centro_costo(array $array_datos)
    {
        if (is_array($array_datos)) {
            foreach ($array_datos as $row) {

                $sql = " INSERT INTO `centrocostos`( `codigo`, `nombre`, `codigocompleto`) VALUES (:codigo, :nombre,:codigocompleto)";
                $stmt = $this->con->prepare($sql); // Preparar la conexion
                $stmt->bindParam(':codigo', $row['codigo'], PDO::PARAM_STR);
                $stmt->bindParam(':nombre', $row['nombre'], PDO::PARAM_STR);
                $stmt->bindParam(':codigocompleto', $row['nombre_completo'], PDO::PARAM_STR);

                if ($stmt->execute()) { // Ejecutar
                    $php_result = true;
                } else {
                    $php_result = true;
                        }   
                    }
                    return $php_result;
        } else {
            return false;
        }
    }

    function insert_alance_comprobacion(array $array_datos)
    {
        if (is_array($array_datos)) {
            foreach ($array_datos as $row) {

                $sql = " INSERT INTO `balance_corporativo`( `puc`, `terceros`, `cco`, `scc`, `nombre`, `saldo_anterior`, `movimiento_debito`, `movimiento_credito`, `nuevo_saldo`, `fecha_corte`) VALUES  (:puc, :terceros, :cco, :scc, :nombre, :saldo_anterior, :movimiento_debito, :movimiento_credito, :nuevo_saldo , :fecha_corte)";
                $stmt = $this->con->prepare($sql); // Preparar la conexion
                $stmt->bindParam(':puc', $row['puc'], PDO::PARAM_STR);
                $stmt->bindParam(':terceros', $row['tercero'], PDO::PARAM_STR);
                $stmt->bindParam(':cco', $row['cco'], PDO::PARAM_STR);
                $stmt->bindParam(':scc', $row['scc'], PDO::PARAM_STR);
                $stmt->bindParam(':nombre', $row['nombre'], PDO::PARAM_STR);
                $stmt->bindParam(':saldo_anterior', $row['saldo_anterior'], PDO::PARAM_STR);
                $stmt->bindParam(':movimiento_debito', $row['mov_debito'], PDO::PARAM_STR);
                $stmt->bindParam(':movimiento_credito', $row['mov_credito'], PDO::PARAM_STR);
                $stmt->bindParam(':nuevo_saldo', $row['nuevo_saldo'], PDO::PARAM_STR);
                $stmt->bindParam(':fecha_corte', $row['fecha_corte'], PDO::PARAM_STR);
                if ($stmt->execute()) { // Ejecutar
                    $result = " Exitosso";
                } else {
                    $result = "Error";
                }
            }
            return $result;
        } else {
            return false;
        }
    }

    function insert_movimiento_diario(array $array_datos)
    {
        if (is_array($array_datos)) {
            foreach ($array_datos as $row) {

                $sql = "INSERT INTO `movimiento_diario`(`tipo`, `numero`, `numero_cheque`, `Num_extension`, `anio`, `mes`, `dia`, `cuenta`, `nit`, `terceros`, `suc_pto`, `drocela`, `c_costo`, `sc_costo`, `detalles`, `debito`, `credito`, `elaborado`) VALUES(:tipo, :numero, :numero_cheque, :num_extension, :anio, :mes, :dia, :cuenta, :nit, :terceros, :suc_pto, :drocela, :c_costo, :sc_costo, :detalles, :debito, :credito, :elaborado)";
                $stmt = $this->con->prepare($sql); // Preparar la conexion
                $stmt->bindParam(':tipo', $row['tipo'], PDO::PARAM_STR);
                $stmt->bindParam(':numero', $row['numero'], PDO::PARAM_INT);
                $stmt->bindParam(':numero_cheque', $row['numero_cheque'], PDO::PARAM_INT);
                $stmt->bindParam(':num_extension', $row['num_extension'], PDO::PARAM_INT);
                $stmt->bindParam(':anio', $row['anio'], PDO::PARAM_INT);
                $stmt->bindParam(':mes', $row['mes'], PDO::PARAM_INT);
                $stmt->bindParam(':dia', $row['dia'], PDO::PARAM_INT);
                $stmt->bindParam(':cuenta', $row['cuenta'], PDO::PARAM_INT);
                $stmt->bindParam(':nit', $row['nit'], PDO::PARAM_INT);
                $stmt->bindParam(':terceros', $row['terceros'], PDO::PARAM_STR);
                $stmt->bindParam(':suc_pto', $row['suc_pto'], PDO::PARAM_STR);
                $stmt->bindParam(':drocela', $row['drocela'], PDO::PARAM_STR);
                $stmt->bindParam(':c_costo', $row['c_costo'], PDO::PARAM_STR);
                $stmt->bindParam(':sc_costo', $row['sc_costo'], PDO::PARAM_STR);
                $stmt->bindParam(':detalles', $row['detalles'], PDO::PARAM_STR);
                $stmt->bindParam(':debito', $row['debito'], PDO::PARAM_STR);
                $stmt->bindParam(':credito', $row['credito'], PDO::PARAM_STR);
                $stmt->bindParam(':elaborado', $row['elaborado'], PDO::PARAM_STR);
                if ($stmt->execute()) { // Ejecutar
                    $result = " Exitosso";
                } else {
                    $result = "Error";
                }
            }
            return $result;
        } else {
            return false;
        }
    }

    function insert_notas_inventario(array $array_datos)
    {
        if (is_array($array_datos)) {
            foreach ($array_datos as $row) {
                $sql = "INSERT INTO `notas_inventario`(`referencia`, `servicio`, `detalle`, `cantidad`, `precio`, `valor_unidad`, `valor_iva`, `total_mas_valor_iva`, `iva`, `base_iva`, `t_iva`, `ico`, `referencia1`, `referencia2`, `referencia3`, `referencia4`, `unidad`, `referencia_proveedor`, `tercero`, `descripcion_adicional`, `fecha_mes`, `planta`) VALUES (:referencia, :servicio, :detalle, :cantidad, :precio, :valor_unidad, :valor_iva, :total_mas_valor_iva, :iva, :base_iva, :t_iva, :ico, :referencia1, :referencia2, :referencia3, :referencia4, :unidad, :referencia_proveedor, :tercero, :descripcion_adicional, :fecha_mes, :planta)";
                $stmt = $this->con->prepare($sql); // Preparar la conexion
                $stmt->bindParam(':referencia', $row['referencia'], PDO::PARAM_INT);
                $stmt->bindParam(':servicio', $row['servicio'], PDO::PARAM_STR);
                $stmt->bindParam(':detalle', $row['detalle'], PDO::PARAM_STR);
                $stmt->bindParam(':cantidad', $row['cantidad'], PDO::PARAM_STR);
                $stmt->bindParam(':precio', $row['precio'], PDO::PARAM_STR);
                $stmt->bindParam(':valor_unidad', $row['valor_unidad'], PDO::PARAM_STR);
                $stmt->bindParam(':valor_iva', $row['valor_iva'], PDO::PARAM_STR);
                $stmt->bindParam(':total_mas_valor_iva', $row['total_mas_valor_iva'], PDO::PARAM_STR);
                $stmt->bindParam(':iva', $row['iva'], PDO::PARAM_STR);
                $stmt->bindParam(':base_iva', $row['base_iva'], PDO::PARAM_STR);
                $stmt->bindParam(':t_iva', $row['t_iva'], PDO::PARAM_STR);
                $stmt->bindParam(':ico', $row['ico'], PDO::PARAM_STR);
                $stmt->bindParam(':referencia1', $row['referencia1'], PDO::PARAM_STR);
                $stmt->bindParam(':referencia2', $row['referencia2'], PDO::PARAM_STR);
                $stmt->bindParam(':referencia3', $row['referencia3'], PDO::PARAM_STR);
                $stmt->bindParam(':referencia4', $row['referencia4'], PDO::PARAM_STR);
                $stmt->bindParam(':unidad', $row['unidad'], PDO::PARAM_STR);
                $stmt->bindParam(':referencia_proveedor', $row['referencia_proveedor'], PDO::PARAM_STR);
                $stmt->bindParam(':tercero', $row['tercero'], PDO::PARAM_STR);
                $stmt->bindParam(':descripcion_adicional', $row['descripcion_adicional'], PDO::PARAM_STR);
                $stmt->bindParam(':fecha_mes', $row['fecha_mes'], PDO::PARAM_STR);
                $stmt->bindParam(':planta', $row['planta'], PDO::PARAM_STR);
                if ($stmt->execute()) { // Ejecutar
                    $result = " Exitosso";
                } else {
                    $result = "Error";
                }
            }
            return $result;
        } else {
            return false;
        }
    }

    function insert_kardex(array $array_datos)
    {
        if (is_array($array_datos)) {
            foreach ($array_datos as $row) {
                $sql = "INSERT INTO `kardex`(`l`, `fecha`, `comprobante`, `entradas`, `salidas`, `saldo`, `costo_aplicacion`, `costo_promedio`, `costo_total_saldo`, `detalle1`, `numero_ext`, `bodega`, `tercero`, `nit`, `elaborado`, `referencia`, `detalle2`, `periodo`, `cuenta`, `unidad_medida`) VALUES (:l, :fecha, :comprobante, :entradas, :salidas, :saldo, :costo_aplicacion, :costo_promedio, :costo_total_saldo, :detalle1, :numero_ext, :bodega, :tercero, :nit, :elaborado, :referencia, :detalle2, :periodo, :cuenta, :unidad_medida)";
                $stmt = $this->con->prepare($sql); // Preparar la conexion
                $stmt->bindParam(':l', $row['l'], PDO::PARAM_INT);
                $stmt->bindParam(':fecha', $row['fecha'], PDO::PARAM_STR);
                $stmt->bindParam(':comprobante', $row['comprobante'], PDO::PARAM_STR);
                $stmt->bindParam(':entradas', $row['entradas'], PDO::PARAM_STR);
                $stmt->bindParam(':salidas', $row['salidas'], PDO::PARAM_STR);
                $stmt->bindParam(':saldo', $row['saldo'], PDO::PARAM_STR);
                $stmt->bindParam(':costo_aplicacion', $row['costo_aplicacion'], PDO::PARAM_STR);
                $stmt->bindParam(':costo_promedio', $row['costo_promedio'], PDO::PARAM_STR);
                $stmt->bindParam(':costo_total_saldo', $row['costo_total_saldo'], PDO::PARAM_STR);
                $stmt->bindParam(':detalle1', $row['detalle1'], PDO::PARAM_STR);
                $stmt->bindParam(':numero_ext', $row['numero_ext'], PDO::PARAM_INT);
                $stmt->bindParam(':bodega', $row['bodega'], PDO::PARAM_STR);
                $stmt->bindParam(':tercero', $row['tercero'], PDO::PARAM_STR);
                $stmt->bindParam(':nit', $row['nit'], PDO::PARAM_INT);
                $stmt->bindParam(':elaborado', $row['elaborado'], PDO::PARAM_STR);
                $stmt->bindParam(':referencia', $row['referencia'], PDO::PARAM_INT);
                $stmt->bindParam(':detalle2', $row['detalle2'], PDO::PARAM_STR);
                $stmt->bindParam(':periodo', $row['periodo'], PDO::PARAM_STR);
                $stmt->bindParam(':cuenta', $row['cuenta'], PDO::PARAM_INT);
                $stmt->bindParam(':unidad_medida', $row['unidad_medida'], PDO::PARAM_STR);
                if ($stmt->execute()) { // Ejecutar
                    $result = " Exitosso";
                } else {
                    $result = "Error";
                }
            }
            return $result;
        } else {
            return false;
        }
    }

    function insert_cuentas_por_cobrar_clientes(array $array_datos)
    {
        if (is_array($array_datos)) {
            foreach ($array_datos as $row) {
                $sql = "INSERT INTO `cuentas_por_cobrar_clientes`(`nit`, `suc_pto`, `codigo`, `nombre`, `nom_comerc`, `telefono`, `celular`, `direccion`, `fecha`, `vence`, `saldo`, `sin_vencer`, `periodo_1_30`, `periodo_31_60`, `periodo_61_90`, `periodo_91_120`, `periodo_121_360`, `periodo_mas_361`, `meses_vencidos`, `plazo`, `mora`, `numero_externo`, `zona`, `fax`, `anticipos`, `cupo`, `fecha_ultimo_pago`, `observaciones`, `fecha_corte`) 
                VALUES (:nit, :suc_pto, :codigo, :nombre, :nom_comerc, :telefono, :celular, :direccion, :fecha, :vence, :saldo, :sin_vencer, :periodo_1_30, :periodo_31_60, periodo_61_90, :periodo_91_120, :periodo_121_360, :periodo_mas_361, :meses_vencidos, :plazo, :mora, :numero_externo, :zona, :fax, :anticipos, :cupo, :fecha_ultimo_pago, :observaciones, :fecha_corte)";
                $stmt = $this->con->prepare($sql); // Preparar la conexion
                $stmt->bindParam(':nit', $row['nit'], PDO::PARAM_INT);
                $stmt->bindParam(':suc_pto', $row['suc_pto'], PDO::PARAM_INT);
                $stmt->bindParam(':codigo', $row['codigo'], PDO::PARAM_INT);
                $stmt->bindParam(':nombre', $row['nombre'], PDO::PARAM_STR);
                $stmt->bindParam(':nom_comerc', $row['nom_comerc'], PDO::PARAM_STR);
                $stmt->bindParam(':telefono', $row['telefono'], PDO::PARAM_INT);
                $stmt->bindParam(':celular', $row['celular'], PDO::PARAM_INT);
                $stmt->bindParam(':direccion', $row['direccion'], PDO::PARAM_STR);
                $stmt->bindParam(':fecha', $row['fecha'], PDO::PARAM_STR);
                $stmt->bindParam(':vence', $row['vence'], PDO::PARAM_STR);
                $stmt->bindParam(':saldo', $row['saldo'], PDO::PARAM_STR);
                $stmt->bindParam(':sin_vencer', $row['sin_vencer'], PDO::PARAM_STR);
                $stmt->bindParam(':periodo_1_30', $row['periodo_1_30'], PDO::PARAM_STR);
                $stmt->bindParam(':periodo_31_60', $row['periodo_31_60'], PDO::PARAM_INT);
                $stmt->bindParam(':periodo_61_90', $row['periodo_61_90'], PDO::PARAM_STR);
                $stmt->bindParam(':periodo_91_120', $row['periodo_91_120'], PDO::PARAM_INT);
                $stmt->bindParam(':periodo_121_360', $row['periodo_121_360'], PDO::PARAM_STR);
                $stmt->bindParam(':periodo_mas_361', $row['periodo_mas_361'], PDO::PARAM_STR);
                $stmt->bindParam(':meses_vencidos', $row['meses_vencidos'], PDO::PARAM_INT);
                $stmt->bindParam(':plazo', $row['plazo'], PDO::PARAM_INT);
                $stmt->bindParam(':mora', $row['mora'], PDO::PARAM_INT);
                $stmt->bindParam(':numero_externo', $row['numero_externo'], PDO::PARAM_INT);
                $stmt->bindParam(':zona', $row['zona'], PDO::PARAM_STR);
                $stmt->bindParam(':fax', $row['fax'], PDO::PARAM_INT);
                $stmt->bindParam(':anticipos', $row['anticipos'], PDO::PARAM_STR);
                $stmt->bindParam(':cupo', $row['cupo'], PDO::PARAM_STR);
                $stmt->bindParam(':fecha_ultimo_pago', $row['fecha_ultimo_pago'], PDO::PARAM_STR);
                $stmt->bindParam(':observaciones', $row['observaciones'], PDO::PARAM_STR);
                $stmt->bindParam(':fecha_corte', $row['fecha_corte'], PDO::PARAM_STR);
                if ($stmt->execute()) { // Ejecutar
                    $result = " Exitosso";
                } else {
                    $result = "Error";
                }
            }
            return $result;
        } else {
            return false;
        }
    }

    function insert_plan_unico_cuentas(array $array_datos)
    {
        if (is_array($array_datos)) {
            foreach ($array_datos as $row) {
                $sql = "INSERT INTO `plan_unico_cuentas`(`codigo_puc`, `nombre`, `nat`, `terc`, `c_cost`, `doc`, `art`, `deprecia`) 
                VALUES (:codigo_puc, :nombre, :nat, :terc, :c_cost, :doc, :art, :deprecia)";
                $stmt = $this->con->prepare($sql); // Preparar la conexion
                $stmt->bindParam(':codigo_puc', $row['codigo_puc'], PDO::PARAM_INT);
                $stmt->bindParam(':nombre', $row['nombre'], PDO::PARAM_STR);
                $stmt->bindParam(':nat', $row['nat'], PDO::PARAM_STR);
                $stmt->bindParam(':terc', $row['terc'], PDO::PARAM_STR);
                $stmt->bindParam(':c_cost', $row['c_cost'], PDO::PARAM_STR);
                $stmt->bindParam(':doc', $row['doc'], PDO::PARAM_STR);
                $stmt->bindParam(':art', $row['art'], PDO::PARAM_STR);
                $stmt->bindParam(':deprecia', $row['deprecia'], PDO::PARAM_STR);
                if ($stmt->execute()) { // Ejecutar
                    $result = " Exitosso";
                } else {
                    $result = "Error";
                }
            }
            return $result;
        } else {
            return false;
        }
    }

    function insert_venta(array $array_datos)
    {
        if (is_array($array_datos)) {
            foreach ($array_datos as $row) {
                $sql = "INSERT INTO `venta`(`venta_devolucion`, `tipo_comprobante`, `numero`, `numero_externo`, `anio`, `mes`, `dia`, `fecha`, `cliente`, `razon_social`, `persona_juridica`, `nombre_comercial`, `cod_tercero`, `suc_pto`, `grupo_cliente`, `subgrupo_cliente`, `codigo_vendedor`, `identificador_vendedor`, `vendedor`, `anexo_1`, `anexo_2`, `anexo_3`, `referencia`, `referencia2`, `servicio`, `codigo_barras`, `referencia_proveedor`, `detalle_comprobante`, `detalle_item`, `informacion_adicional_item`, `unidad`, `linea`, `marca`, `grupo`, `subgrupo`, `grupo_produccion`, `grupo_servicio`, `serial`, `cantidad_venta`, `cantidad_factor_1`, `cantidad_factor_2`, `unidad_ensamble`, `cajas`, `cantidad_devolucion`, `peso`, `valor_unidad_venta`, `valor_total_venta`, `precio_sugerido`, `porcentaje_iva`, `valor_iva`, `valor_impoconsumo`, `costo_unitario`, `costo_total`, `utilidad`, `porcentaje_utilidad`, `porcentaje_rentabilidad`, `valor_fletes`, `valor_fletes_catalogo_articulo`, `valor_descuento_comercial`, `porcentaje_descuento_comercial`, `porcentaje_descuento_especial`, `valor_descuento_financiero`, `porcentaje_descuento_financiero`, `ciudad`, `departamento`, `zona`, `dia_vencimiento`, `mes_vencimiento`, `anio_vencimiento`, `codigo_linea_credito`, `linea_credito`, `dias_plazo`, `dia_pago`, `mes_pago`, `anio_pago`, `dias_pago`, `forma_pago`, `precio`, `referencia_pago_1`, `referencia_pago_2`, `referencia_pago_3`, `referencia_pago_4`, `descripcion_item`, `numero_lote`, `talla_identificador`, `talla`, `direccion`, `telefono`, `bodega`, `bodega_item`, `proyecto`, `centro_costos`, `nit`, `dig_verificacion`, `tipo_id`, `cod_suc`, `semana_anio`, `semana_mes`, `codigo_departamento`, `codigo_ciudad`, `primer_nombre`, `segundo_nombre`, `primer_apellido`, `segundo_apellido`, `telefonos`, `telefono_movil`, `email`, `cliente_inactivo`, `dia_semana`, `barrio`, `usuario_elaboro`, `agente_comercial`, `regimen_ventas`, `declaracion_renta`, `agente_retenedor`, `auto_retenedor`, `no_aplica_impuesto_cree`, `agente_retenedor_ica`, `causas_devolucion`, `base_calculo_interes_fac_lote`, `porcentaje_interes_fact_lote`, `hora_elaboracion_factura`, `fecha_ingreso`, `estado_subtercero`, `ficha_catastral`, `num_medidor`, `centro_costos_item`, `tercero_item`, `tarifa_iva_catalogo_servicio_articulo`, `porcentaje_iva_catalogo_servicio_articulo`, `nombre_tarifa_iva_aplicada`, `direccion_area`, `telefono_area`, `fax_area`, `ciudad_area`, `email_area`, `email_fe_area`, `barrio_area`, `afecta`, `cantidad_parcial_entregada`) VALUES (:venta_devolucion, :tipo_comprobante, :numero, :numero_externo, :anio, :mes, :dia, :fecha, :cliente, :razon_social, :persona_juridica, :nombre_comercial, :cod_tercero, :suc_pto, :grupo_cliente, :subgrupo_cliente, :codigo_vendedor, :identificador_vendedor, :vendedor, :anexo_1, :anexo_2, :anexo_3, :referencia, :referencia2, :servicio, :codigo_barras, :referencia_proveedor, :detalle_comprobante, :detalle_item, :informacion_adicional_item, :unidad, :linea, :marca, :grupo, :subgrupo, :grupo_produccion, :grupo_servicio, :serial, :cantidad_venta, :cantidad_factor_1, :cantidad_factor_2, :unidad_ensamble, :cajas, :cantidad_devolucion, :peso, :valor_unidad_venta, :valor_total_venta, :precio_sugerido, :porcentaje_iva, :valor_iva, :valor_impoconsumo, :costo_unitario, :costo_total, :utilidad, :porcentaje_utilidad, :porcentaje_rentabilidad, :valor_fletes, :valor_fletes_catalogo_articulo, :valor_descuento_comercial, :porcentaje_descuento_comercial, :porcentaje_descuento_especial, :valor_descuento_financiero, :porcentaje_descuento_financiero, :ciudad, :departamento, :zona, :dia_vencimiento, :mes_vencimiento,:anio_vencimiento, :codigo_linea_credito, :linea_credito, :dias_plazo, :dia_pago, :mes_pago, :anio_pago, :dias_pago, :forma_pago, :precio, :referencia_pago_1, :referencia_pago_2, :referencia_pago_3, :referencia_pago_4, :descripcion_item, :numero_lote, :talla_identificador, :talla, :direccion, :telefono, :bodega, :bodega_item, :proyecto, :centro_costos, :nit, :dig_verificacion, :tipo_id, :cod_suc, :semana_anio, :semana_mes, :codigo_departamento, :codigo_ciudad, :primer_nombre, :segundo_nombre, :primer_apellido, :segundo_apellido, :telefonos, :telefono_movil, :email, :cliente_inactivo, :dia_semana, :barrio, :usuario_elaboro, :agente_comercial, :regimen_ventas, :declaracion_renta, :agente_retenedor, :auto_retenedor, :no_aplica_impuesto_cree, :agente_retenedor_ica, :causas_devolucion, :base_calculo_interes_fac_lote, :porcentaje_interes_fact_lote, :hora_elaboracion_factura, :fecha_ingreso, :estado_subtercero, :ficha_catastral, :num_medidor, :centro_costos_item, :tercero_item, :tarifa_iva_catalogo_servicio_articulo, :porcentaje_iva_catalogo_servicio_articulo, :nombre_tarifa_iva_aplicada, :direccion_area, :telefono_area, :fax_area, :ciudad_area, :email_area, :email_fe_area, :barrio_area, :afecta, :cantidad_parcial_entregada)";
                $stmt = $this->con->prepare($sql); // Preparar la conexion
                $stmt->bindParam(':venta_devolucion', $row['venta_devolucion'], PDO::PARAM_STR);
                $stmt->bindParam(':tipo_comprobante', $row['tipo_comprobante'], PDO::PARAM_STR);
                $stmt->bindParam(':numero', $row['numero'], PDO::PARAM_INT);
                $stmt->bindParam(':numero_externo', $row['numero_externo'], PDO::PARAM_INT);
                $stmt->bindParam(':anio', $row['anio'], PDO::PARAM_INT);
                $stmt->bindParam(':mes', $row['mes'], PDO::PARAM_INT);
                $stmt->bindParam(':dia', $row['dia'], PDO::PARAM_INT);
                $stmt->bindParam(':fecha', $row['fecha'], PDO::PARAM_STR);
                $stmt->bindParam(':cliente', $row['cliente'], PDO::PARAM_STR);
                $stmt->bindParam(':razon_social', $row['razon_social'], PDO::PARAM_STR);
                $stmt->bindParam(':persona_juridica', $row['persona_juridica'], PDO::PARAM_STR);
                $stmt->bindParam(':nombre_comercial', $row['nombre_comercial'], PDO::PARAM_STR);
                $stmt->bindParam(':cod_tercero', $row['cod_tercero'], PDO::PARAM_STR);
                $stmt->bindParam(':suc_pto', $row['suc_pto'], PDO::PARAM_STR);
                $stmt->bindParam(':grupo_cliente', $row['grupo_cliente'], PDO::PARAM_STR);
                $stmt->bindParam(':subgrupo_cliente', $row['subgrupo_cliente'], PDO::PARAM_STR);
                $stmt->bindParam(':codigo_vendedor', $row['codigo_vendedor'], PDO::PARAM_STR);
                $stmt->bindParam(':identificador_vendedor', $row['identificador_vendedor'], PDO::PARAM_STR);
                $stmt->bindParam(':vendedor', $row['vendedor'], PDO::PARAM_STR);
                $stmt->bindParam(':anexo_1', $row['anexo_1'], PDO::PARAM_STR);
                $stmt->bindParam(':anexo_2', $row['anexo_2'], PDO::PARAM_STR);
                $stmt->bindParam(':anexo_3', $row['anexo_3'], PDO::PARAM_STR);
                $stmt->bindParam(':referencia', $row['referencia'], PDO::PARAM_INT);
                $stmt->bindParam(':referencia2', $row['referencia2'], PDO::PARAM_STR);
                $stmt->bindParam(':servicio', $row['servicio'], PDO::PARAM_STR);
                $stmt->bindParam(':codigo_barras', $row['codigo_barras'], PDO::PARAM_STR);
                $stmt->bindParam(':referencia_proveedor', $row['referencia_proveedor'], PDO::PARAM_STR);
                $stmt->bindParam(':detalle_comprobante', $row['detalle_comprobante'], PDO::PARAM_STR);
                $stmt->bindParam(':detalle_item', $row['detalle_item'], PDO::PARAM_STR);
                $stmt->bindParam(':informacion_adicional_item', $row['informacion_adicional_item'], PDO::PARAM_STR);
                $stmt->bindParam(':unidad', $row['unidad'], PDO::PARAM_STR);
                $stmt->bindParam(':linea', $row['linea'], PDO::PARAM_STR);
                $stmt->bindParam(':marca', $row['marca'], PDO::PARAM_STR);
                $stmt->bindParam(':grupo', $row['grupo'], PDO::PARAM_STR);
                $stmt->bindParam(':subgrupo', $row['subgrupo'], PDO::PARAM_STR);
                $stmt->bindParam(':grupo_produccion', $row['grupo_produccion'], PDO::PARAM_STR);
                $stmt->bindParam(':grupo_servicio', $row['grupo_servicio'], PDO::PARAM_STR);
                $stmt->bindParam(':serial', $row['serial'], PDO::PARAM_STR);
                $stmt->bindParam(':cantidad_venta', $row['cantidad_venta'], PDO::PARAM_INT);
                $stmt->bindParam(':cantidad_factor_1', $row['cantidad_factor_1'], PDO::PARAM_INT);
                $stmt->bindParam(':cantidad_factor_2', $row['cantidad_factor_2'], PDO::PARAM_INT);
                $stmt->bindParam(':unidad_ensamble', $row['unidad_ensamble'], PDO::PARAM_INT);
                $stmt->bindParam(':cajas', $row['cajas'], PDO::PARAM_INT);
                $stmt->bindParam(':cantidad_devolucion', $row['cantidad_devolucion'], PDO::PARAM_INT);
                $stmt->bindParam(':peso', $row['peso'], PDO::PARAM_STR);
                $stmt->bindParam(':valor_unidad_venta', $row['valor_unidad_venta'], PDO::PARAM_STR);
                $stmt->bindParam(':valor_total_venta', $row['valor_total_venta'], PDO::PARAM_STR);
                $stmt->bindParam(':precio_sugerido', $row['precio_sugerido'], PDO::PARAM_STR);
                $stmt->bindParam(':porcentaje_iva', $row['porcentaje_iva'], PDO::PARAM_INT);
                $stmt->bindParam(':valor_iva', $row['valor_iva'], PDO::PARAM_STR);
                $stmt->bindParam(':valor_impoconsumo', $row['valor_impoconsumo'], PDO::PARAM_STR);
                $stmt->bindParam(':costo_unitario', $row['costo_unitario'], PDO::PARAM_STR);
                $stmt->bindParam(':costo_total', $row['costo_total'], PDO::PARAM_STR);
                $stmt->bindParam(':utilidad', $row['utilidad'], PDO::PARAM_STR);
                $stmt->bindParam(':porcentaje_utilidad', $row['porcentaje_utilidad'], PDO::PARAM_STR);
                $stmt->bindParam(':porcentaje_rentabilidad', $row['porcentaje_rentabilidad'], PDO::PARAM_STR);
                $stmt->bindParam(':valor_fletes', $row['valor_fletes'], PDO::PARAM_STR);
                $stmt->bindParam(':valor_fletes_catalogo_articulo', $row['valor_fletes_catalogo_articulo'], PDO::PARAM_STR);
                $stmt->bindParam(':valor_descuento_comercial', $row['valor_descuento_comercial'], PDO::PARAM_STR);
                $stmt->bindParam(':porcentaje_descuento_comercial', $row['porcentaje_descuento_comercial'], PDO::PARAM_INT);
                $stmt->bindParam(':porcentaje_descuento_especial', $row['porcentaje_descuento_especial'], PDO::PARAM_INT);
                $stmt->bindParam(':valor_descuento_financiero', $row['valor_descuento_financiero'], PDO::PARAM_STR);
                $stmt->bindParam(':porcentaje_descuento_financiero', $row['porcentaje_descuento_financiero'], PDO::PARAM_INT);
                $stmt->bindParam(':ciudad', $row['ciudad'], PDO::PARAM_STR);
                $stmt->bindParam(':departamento', $row['departamento'], PDO::PARAM_STR);
                $stmt->bindParam(':dia_vencimiento', $row['dia_vencimiento'], PDO::PARAM_INT);
                $stmt->bindParam(':mes_vencimiento', $row['mes_vencimiento'], PDO::PARAM_INT);
                $stmt->bindParam(':anio_vencimiento', $row['anio_vencimiento'], PDO::PARAM_INT);
                $stmt->bindParam(':codigo_linea_credito', $row['codigo_linea_credito'], PDO::PARAM_STR);
                $stmt->bindParam(':linea_credito', $row['linea_credito'], PDO::PARAM_STR);
                $stmt->bindParam(':dias_plazo', $row['dias_plazo'], PDO::PARAM_INT);
                $stmt->bindParam(':dia_pago', $row['dia_pago'], PDO::PARAM_INT);
                $stmt->bindParam(':mes_pago', $row['mes_pago'], PDO::PARAM_INT);
                $stmt->bindParam(':anio_pago', $row['anio_pago'], PDO::PARAM_INT);
                $stmt->bindParam(':dias_pago', $row['dias_pago'], PDO::PARAM_INT);
                $stmt->bindParam(':forma_pago', $row['forma_pago'], PDO::PARAM_STR);
                $stmt->bindParam(':precio', $row['precio'], PDO::PARAM_STR);
                $stmt->bindParam(':referencia_pago_1', $row['referencia_pago_1'], PDO::PARAM_STR);
                $stmt->bindParam(':referencia_pago_2', $row['referencia_pago_2'], PDO::PARAM_STR);
                $stmt->bindParam(':referencia_pago_3', $row['referencia_pago_3'], PDO::PARAM_STR);
                $stmt->bindParam(':referencia_pago_4', $row['referencia_pago_4'], PDO::PARAM_STR);
                $stmt->bindParam(':descripcion_item', $row['descripcion_item'], PDO::PARAM_STR);
                $stmt->bindParam(':numero_lote', $row['numero_lote'], PDO::PARAM_STR);
                $stmt->bindParam(':talla_identificador', $row['talla_identificador'], PDO::PARAM_STR);
                $stmt->bindParam(':talla', $row['talla'], PDO::PARAM_STR);
                $stmt->bindParam(':direccion', $row['direccion'], PDO::PARAM_STR);
                $stmt->bindParam(':telefono', $row['telefono'], PDO::PARAM_INT);
                $stmt->bindParam(':bodega', $row['bodega'], PDO::PARAM_STR);
                $stmt->bindParam(':bodega_item', $row['bodega_item'], PDO::PARAM_STR);
                $stmt->bindParam(':proyecto', $row['proyecto'], PDO::PARAM_STR);
                $stmt->bindParam(':centro_costos', $row['centro_costos'], PDO::PARAM_STR);
                $stmt->bindParam(':nit', $row['nit'], PDO::PARAM_INT);
                $stmt->bindParam(':dig_verificacion', $row['dig_verificacion'], PDO::PARAM_INT);
                $stmt->bindParam(':tipo_id', $row['tipo_id'], PDO::PARAM_INT);
                $stmt->bindParam(':cod_suc', $row['cod_suc'], PDO::PARAM_STR);
                $stmt->bindParam(':semana_anio', $row['semana_anio'], PDO::PARAM_INT);
                $stmt->bindParam(':semana_mes', $row['semana_mes'], PDO::PARAM_INT);
                $stmt->bindParam(':codigo_departamento', $row['codigo_departamento'], PDO::PARAM_INT);
                $stmt->bindParam(':codigo_ciudad', $row['codigo_ciudad'], PDO::PARAM_INT);
                $stmt->bindParam(':primer_nombre', $row['primer_nombre'], PDO::PARAM_STR);
                $stmt->bindParam(':segundo_nombre', $row['segundo_nombre'], PDO::PARAM_STR);
                $stmt->bindParam(':primer_apellido', $row['primer_apellido'], PDO::PARAM_STR);
                $stmt->bindParam(':segundo_apellido', $row['segundo_apellido'], PDO::PARAM_STR);
                $stmt->bindParam(':telefonos', $row['telefonos'], PDO::PARAM_INT);
                $stmt->bindParam(':telefono_movil', $row['telefono_movil'], PDO::PARAM_INT);
                $stmt->bindParam(':cliente_inactivo', $row['cliente_inactivo'], PDO::PARAM_STR);
                $stmt->bindParam(':dia_semana', $row['dia_semana'], PDO::PARAM_STR);
                $stmt->bindParam(':barrio', $row['barrio'], PDO::PARAM_STR);
                $stmt->bindParam(':usuario_elaboro', $row['usuario_elaboro'], PDO::PARAM_STR);
                $stmt->bindParam(':agente_comercial', $row['agente_comercial'], PDO::PARAM_STR);
                $stmt->bindParam(':regimen_ventas', $row['regimen_ventas'], PDO::PARAM_STR);
                $stmt->bindParam(':declaracion_renta', $row['declaracion_renta'], PDO::PARAM_STR);
                $stmt->bindParam(':agente_retenedor', $row['agente_retenedor'], PDO::PARAM_STR);
                $stmt->bindParam(':auto_retenedor', $row['auto_retenedor'], PDO::PARAM_STR);
                $stmt->bindParam(':no_aplica_impuesto_cree', $row['no_aplica_impuesto_cree'], PDO::PARAM_STR);
                $stmt->bindParam(':agente_retenedor_ica', $row['agente_retenedor_ica'], PDO::PARAM_STR);
                $stmt->bindParam(':causas_devolucion', $row['causas_devolucion'], PDO::PARAM_STR);
                $stmt->bindParam(':base_calculo_interes_fac_lote', $row['base_calculo_interes_fac_lote'], PDO::PARAM_INT);
                $stmt->bindParam(':porcentaje_interes_fact_lote', $row['porcentaje_interes_fact_lote'], PDO::PARAM_INT);
                $stmt->bindParam(':hora_elaboracion_factura', $row['hora_elaboracion_factura'], PDO::PARAM_INT);
                $stmt->bindParam(':fecha_ingreso', $row['fecha_ingreso'], PDO::PARAM_STR);
                $stmt->bindParam(':estado_subtercero', $row['estado_subtercero'], PDO::PARAM_STR);
                $stmt->bindParam(':ficha_catastral', $row['ficha_catastral'], PDO::PARAM_STR);
                $stmt->bindParam(':num_medidor', $row['num_medidor'], PDO::PARAM_STR);
                $stmt->bindParam(':centro_costos_item', $row['centro_costos_item'], PDO::PARAM_STR);
                $stmt->bindParam(':tercero_item', $row['tercero_item'], PDO::PARAM_STR);
                $stmt->bindParam(':tarifa_iva_catalogo_servicio_articulo', $row['tarifa_iva_catalogo_servicio_articulo'], PDO::PARAM_INT);
                $stmt->bindParam(':porcentaje_iva_catalogo_servicio_articulo', $row['porcentaje_iva_catalogo_servicio_articulo'], PDO::PARAM_INT);
                $stmt->bindParam(':nombre_tarifa_iva_aplicada', $row['nombre_tarifa_iva_aplicada'], PDO::PARAM_STR);
                $stmt->bindParam(':direccion_area', $row['direccion_area'], PDO::PARAM_STR);
                $stmt->bindParam(':telefono_area', $row['telefono_area'], PDO::PARAM_INT);
                $stmt->bindParam(':fax_area', $row['fax_area'], PDO::PARAM_STR);
                $stmt->bindParam(':ciudad_area', $row['ciudad_area'], PDO::PARAM_STR);
                $stmt->bindParam(':email_area', $row['email_area'], PDO::PARAM_STR);
                $stmt->bindParam(':email_fe_area', $row['email_fe_area'], PDO::PARAM_STR);
                $stmt->bindParam(':barrio_area', $row['barrio_area'], PDO::PARAM_STR);
                $stmt->bindParam(':afecta', $row['afecta'], PDO::PARAM_STR);
                $stmt->bindParam(':cantidad_parcial_entregada', $row['cantidad_parcial_entregada'], PDO::PARAM_INT);
                if ($stmt->execute()) { // Ejecutar
                    $result = " Exitosso";
                } else {
                    $result = "Error";
                }
            }
            return $result;
        } else {
            return false;
        }
    }
}