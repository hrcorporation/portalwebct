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
                
    barrio int(10) null,
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

                $sql = " INSERT INTO `centrocostos`( `codigo`, `nombre`, `codigocompleto`) VALUES (:codigo,:nombre,:codigocompleto)";
                $stmt = $this->con->prepare($sql); // Preparar la conexion
                $stmt->bindParam(':codigo', $row['codigo'], PDO::PARAM_STR);
                $stmt->bindParam(':nombre', $row['nombre'], PDO::PARAM_STR);
                $stmt->bindParam(':codigocompleto', $row['nombre_completo'], PDO::PARAM_STR);

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
}
