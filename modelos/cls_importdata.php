<?php
class cls_importdata extends conexionPDO {

    public $con;

    // Iniciar Conexion
    public function __construct() {
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
        if(is_array($array_datos))
        {
            foreach ($array_datos as $row) {
                
                $sql=" INSERT INTO `centrocostos`( `codigo`, `nombre`, `codigocompleto`) VALUES (:codigo,:nombre,:codigocompleto)";
                $stmt = $this->con->prepare($sql); // Preparar la conexion
                $stmt->bindParam(':codigo', $row['codigo'], PDO::PARAM_STR);
                $stmt->bindParam(':nombre', $row['nombre'], PDO::PARAM_STR);
                $stmt->bindParam(':codigocompleto', $row['nombre_completo'], PDO::PARAM_STR);

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

    function insert_alance_comprobacion(array $array_datos)
    {
        if(is_array($array_datos))
        {
            foreach ($array_datos as $row) {
                
                $sql=" INSERT INTO `balance_corporativo`( `puc`, `terceros`, `cco`, `scc`, `nombre`, `saldo_anterior`, `movimiento_debito`, `movimiento_credito`, `nuevo_saldo`, `fecha_corte`) VALUES  (:puc, :terceros, :cco, :scc, :nombre, :saldo_anterior, :movimiento_debito, :movimiento_credito, :nuevo_saldo , :fecha_corte)";
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
                }else{
                    $result = "Error";

                }

            }
            return $result;
        }else{
            return false;
        }
        
    }



}