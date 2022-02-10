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
                $stmt->bindParam(':nit', $row['nit'], PDO::PARAM_INT);
                $stmt->bindParam(':digver', $row['digver'], PDO::PARAM_INT);
                $stmt->bindParam(':claseid', $row['claseid'], PDO::PARAM_STR);
                $stmt->bindParam(':codigo', $row['codigo'], PDO::PARAM_INT);
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
                $stmt->bindParam(':tel', $row['tel'], PDO::PARAM_INT);
                $stmt->bindParam(':telmovil', $row['telmovil'], PDO::PARAM_INT);
                $stmt->bindParam(':fax', $row['fax'], PDO::PARAM_INT);
                $stmt->bindParam(':email', $row['email'], PDO::PARAM_STR);
                $stmt->bindParam(':email2', $row['email2'], PDO::PARAM_STR);
                $stmt->bindParam(':ciudad', $row['ciudad'], PDO::PARAM_INT);
                $stmt->bindParam(':pais', $row['pais'], PDO::PARAM_INT);
                $stmt->bindParam(':barrio', $row['barrio'], PDO::PARAM_INT);
                $stmt->bindParam(':escliente', $row['escliente'], PDO::PARAM_STR);
                $stmt->bindParam(':especliente', $row['especliente'], PDO::PARAM_STR);
                $stmt->bindParam(':esproveedor', $row['esproveedor'], PDO::PARAM_STR);
                $stmt->bindParam(':esvendedor', $row['esvendedor'], PDO::PARAM_STR);
                $stmt->bindParam(':esasociado', $row['esasociado'], PDO::PARAM_STR);
                $stmt->bindParam(':exasociado', $row['exasociado'], PDO::PARAM_STR);
                $stmt->bindParam(':esempleado', $row['esempleado'], PDO::PARAM_STR);
                $stmt->bindParam(':escobrador', $row['escobrador'], PDO::PARAM_STR);
                $stmt->bindParam(':escomision', $row['escomision'], PDO::PARAM_STR);
                $stmt->bindParam(':escodeudor', $row['escodeudor'], PDO::PARAM_STR);
                $stmt->bindParam(':estranspor', $row['estranspor'], PDO::PARAM_STR);
                $stmt->bindParam(':esingotter', $row['esingotter'], PDO::PARAM_STR);
                $stmt->bindParam(':esvehiculo', $row['esvehiculo'], PDO::PARAM_STR);
                $stmt->bindParam(':esbanco', $row['esbanco'], PDO::PARAM_STR);
                $stmt->bindParam(':esoficial', $row['esoficial'], PDO::PARAM_STR);
                $stmt->bindParam(':esuniofi', $row['esuniofi'], PDO::PARAM_STR);
                $stmt->bindParam(':espatronal', $row['espatronal'], PDO::PARAM_STR);
                $stmt->bindParam(':esssalud', $row['esssalud'], PDO::PARAM_STR);
                $stmt->bindParam(':esriesgo', $row['esriesgo'], PDO::PARAM_STR);
                $stmt->bindParam(':escaja', $row['escaja'], PDO::PARAM_STR);
                $stmt->bindParam(':espension', $row['espension'], PDO::PARAM_STR);
                $stmt->bindParam(':escesantia', $row['escesantia'], PDO::PARAM_STR);
                $stmt->bindParam(':esbenefi', $row['esbenefi'], PDO::PARAM_STR);
                $stmt->bindParam(':esasegura', $row['esasegura'], PDO::PARAM_STR);
                $stmt->bindParam(':vendedor', $row['vendedor'], PDO::PARAM_STR);
                $stmt->bindParam(':cobrador', $row['cobrador'], PDO::PARAM_STR);
                $stmt->bindParam(':propieta', $row['propieta'], PDO::PARAM_STR);
                $stmt->bindParam(':agnete', $row['agnete'], PDO::PARAM_STR);
                $stmt->bindParam(':banco', $row['banco'], PDO::PARAM_INT);
                $stmt->bindParam(':grupo', $row['grupo'], PDO::PARAM_INT);
                $stmt->bindParam(':subgrupo', $row['subgrupo'], PDO::PARAM_STR);
                $stmt->bindParam(':claseter', $row['claseter'], PDO::PARAM_STR);
                $stmt->bindParam(':codpostal', $row['codpostal'], PDO::PARAM_STR);
                $stmt->bindParam(':zona', $row['zona'], PDO::PARAM_STR);
                $stmt->bindParam(':cupo', $row['cupo'], PDO::PARAM_INT);
                $stmt->bindParam(':cupo2', $row['cupo2'], PDO::PARAM_INT);
                $stmt->bindParam(':califica', $row['califica'], PDO::PARAM_STR);
                $stmt->bindParam(':regimen', $row['regimen'], PDO::PARAM_STR);
                $stmt->bindParam(':regiment', $row['regiment'], PDO::PARAM_STR);
                $stmt->bindParam(':retefte', $row['retefte'], PDO::PARAM_STR);
                $stmt->bindParam(':rettodo', $row['rettodo'], PDO::PARAM_STR);
                $stmt->bindParam(':noretecre', $row['noretecre'], PDO::PARAM_STR);
                $stmt->bindParam(':granconte', $row['granconte'], PDO::PARAM_STR);
                $stmt->bindParam(':autorete', $row['autorete'], PDO::PARAM_STR);
                $stmt->bindParam(':reteica', $row['reteica'], PDO::PARAM_STR);
                $stmt->bindParam(':tarica', $row['tarica'], PDO::PARAM_STR);
                $stmt->bindParam(':noiva', $row['noiva'], PDO::PARAM_STR);
                $stmt->bindParam(':actiecon', $row['actiecon'], PDO::PARAM_INT);
                $stmt->bindParam(':conpub', $row['conpub'], PDO::PARAM_STR);
                $stmt->bindParam(':encargado', $row['encargado'], PDO::PARAM_STR);
                $stmt->bindParam(':replegar', $row['replegar'], PDO::PARAM_STR);
                $stmt->bindParam(':nacio', $row['nacio'], PDO::PARAM_STR);
                $stmt->bindParam(':precio', $row['precio'], PDO::PARAM_INT);
                $stmt->bindParam(':fpago', $row['fpago'], PDO::PARAM_STR);
                $stmt->bindParam(':condpago', $row['condpago'], PDO::PARAM_STR);
                $stmt->bindParam(':nodatacred', $row['nodatacred'], PDO::PARAM_STR);
                $stmt->bindParam(':passcli', $row['passcli'], PDO::PARAM_STR);
                $stmt->bindParam(':plazomax', $row['plazomax'], PDO::PARAM_INT);
                $stmt->bindParam(':plazo', $row['plazo'], PDO::PARAM_INT);
                $stmt->bindParam(':plazo2', $row['plazo2'], PDO::PARAM_INT);
                $stmt->bindParam(':plazo3', $row['plazo3'], PDO::PARAM_INT);
                $stmt->bindParam(':pdtocli', $row['pdtocli'], PDO::PARAM_INT);
                $stmt->bindParam(':pdtocli2', $row['pdtocli2'], PDO::PARAM_INT);
                $stmt->bindParam(':pdtocli3', $row['pdtocli3'], PDO::PARAM_INT);
                $stmt->bindParam(':tdtocli', $row['tdtocli'], PDO::PARAM_STR);
                $stmt->bindParam(':tdtocli2', $row['tdtocli2'], PDO::PARAM_STR);
                $stmt->bindParam(':tdtocli3', $row['tdtocli3'], PDO::PARAM_STR);
                $stmt->bindParam(':pdtocond', $row['pdtocond'], PDO::PARAM_INT);
                $stmt->bindParam(':pdtocond2', $row['pdtocond2'], PDO::PARAM_INT);
                $stmt->bindParam(':pdtocond3', $row['pdtocond3'], PDO::PARAM_INT);
                $stmt->bindParam(':usuario1', $row['usuario1'], PDO::PARAM_STR);
                $stmt->bindParam(':fechar', $row['fechar'], PDO::PARAM_STR);
                $stmt->bindParam(':fupdateu', $row['fupdateu'], PDO::PARAM_STR);
                $stmt->bindParam(':fupdate', $row['fupdate'], PDO::PARAM_STR);
                $stmt->bindParam(':cuentab', $row['cuentab'], PDO::PARAM_INT);
                $stmt->bindParam(':cuentabac', $row['cuentabac'], PDO::PARAM_STR);
                $stmt->bindParam(':codsocial', $row['codsocial'], PDO::PARAM_STR);
                $stmt->bindParam(':codseps', $row['codseps'], PDO::PARAM_STR);
                $stmt->bindParam(':codafp', $row['codafp'], PDO::PARAM_STR);
                $stmt->bindParam(':codarp', $row['codarp'], PDO::PARAM_STR);
                $stmt->bindParam(':codccf', $row['codccf'], PDO::PARAM_STR);
                $stmt->bindParam(':trecipro', $row['trecipro'], PDO::PARAM_STR);
                $stmt->bindParam(':latitud', $row['latitud'], PDO::PARAM_STR);
                $stmt->bindParam(':longitud', $row['longitud'], PDO::PARAM_STR);
                $stmt->bindParam(':usuario2', $row['usuario2'], PDO::PARAM_STR);
                $stmt->bindParam(':diaconv', $row['diaconv'], PDO::PARAM_STR);
                $stmt->bindParam(':conveniop', $row['conveniop'], PDO::PARAM_STR);
                $stmt->bindParam(':porcaiua', $row['porcaiua'], PDO::PARAM_STR);
                $stmt->bindParam(':porcaiui', $row['porcaiui'], PDO::PARAM_STR);
                $stmt->bindParam(':porcariuu', $row['porcariuu'], PDO::PARAM_STR);
                $stmt->bindParam(':nodesctos', $row['nodesctos'], PDO::PARAM_STR);
                $stmt->bindParam(':foto', $row['foto'], PDO::PARAM_STR);
                $stmt->bindParam(':ultventa', $row['ultventa'], PDO::PARAM_STR);
                $stmt->bindParam(':pfinancia', $row['pfinancia'], PDO::PARAM_STR);
                $stmt->bindParam(':declara', $row['declara'], PDO::PARAM_STR);
                $stmt->bindParam(':codpub2', $row['codpub2'], PDO::PARAM_STR);
                $stmt->bindParam(':prvtas', $row['prvtas'], PDO::PARAM_STR);
                $stmt->bindParam(':transporte', $row['transporte'], PDO::PARAM_STR);
                $stmt->bindParam(':nit2', $row['nit2'], PDO::PARAM_STR);
                $stmt->bindParam(':ccostos', $row['ccostos'], PDO::PARAM_STR);
                $stmt->bindParam(':scostos', $row['scostos'], PDO::PARAM_STR);
                $stmt->bindParam(':lugarnac', $row['lugarnac'], PDO::PARAM_STR);
                $stmt->bindParam(':difcobro', $row['difcobro'], PDO::PARAM_STR);
                $stmt->bindParam(':reteiva', $row['reteiva'], PDO::PARAM_STR);
                $stmt->bindParam(':valdiasm', $row['valdiasm'], PDO::PARAM_INT);
                $stmt->bindParam(':nobomberil', $row['nobomberil'], PDO::PARAM_STR);
                $stmt->bindParam(':bodega', $row['bodega'], PDO::PARAM_STR); 





















                





























                










































































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