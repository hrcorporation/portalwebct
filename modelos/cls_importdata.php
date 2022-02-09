<?php
class cls_importdata extends conexionPDO {

    public $con;

    // Iniciar Conexion
    public function __construct() {
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
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

    function insert_movimiento_diario(array $array_datos)
    {
        if(is_array($array_datos))
        {
            foreach ($array_datos as $row) {
                
                $sql="INSERT INTO `movimiento_diario`(`tipo`, `numero`, `numero_cheque`, `Num_extension`, `anio`, `mes`, `dia`, `cuenta`, `nit`, `terceros`, `suc_pto`, `drocela`, `c_costo`, `sc_costo`, `detalles`, `debito`, `credito`, `elaborado`) VALUES(:tipo, :numero, :numero_cheque, :num_extension, :anio, :mes, :dia, :cuenta, :nit, :terceros, :suc_pto, :drocela, :c_costo, :sc_costo, :detalles, :debito, :credito, :elaborado)";
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