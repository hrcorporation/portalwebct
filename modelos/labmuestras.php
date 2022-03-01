<?php
/**
 * Se crea la clase labmuestras con extendida con conexionPDO a la conexion a la base de datos
 */
class labmuestras extends conexionPDO
{
    protected $con ;
    
    
    public function __construct()
    {       
        //Conectar a la base de datos
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
    }

    public function datatable_muestras(){
       
        $sql = "SELECT `ct57_id_muestra`, `ct57_tipo_muestra`, `ct57_fecha`, `ct57_hora`, `ct57_cantidad`, `ct57_id_remision`, `ct57_id_mixer`, `ct57_id_cliente`, `ct57_id_obra`, `ct57_codremision`, `ct57_id_producto`, `ct57_id_tipo_producto`, `ct57_cantidad_muestra`, `ct57_m3_muestra`, `ct57_asentamiento`, `ct57_temperatura`, `ct57_cementante`, `ct57_aire`, `ct57_rend_volumetrico` FROM `ct57_muestra` ";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        


        if ($stmt->execute()) { // Ejecutar
            $num_reg =  $stmt->rowCount(); // Get Numero de Registros
            if ($num_reg > 0) { // Validar el numero de Registros
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $new_row['id'] = $row['ct57_id_muestra'];
                    $new_row['tipo_muestra'] = $row['ct57_tipo_muestra'];
                    $new_row['fecha'] = $row['ct57_fecha'];
                    $new_row['hora'] = $row['ct57_hora'];
                    $new_row['cantidad'] = $row['ct57_cantidad'];
                    $new_row['id_remision'] = $row['ct57_id_remision'];
                    $new_row['id_mixer'] = $row['ct57_id_mixer'];
                    $new_row['id_cliente'] = $row['ct57_id_cliente'];
                    $new_row['id_obra'] = $row['ct57_id_obra'];
                    $new_row['codremision'] = $row['ct57_codremision'];
                    $new_row['id_producto'] = $row['ct57_id_producto'];
                    $new_row['id_tipo_producto'] = $row['ct57_id_tipo_producto'];
                    $new_row['cantidad_muestra'] = $row['ct57_cantidad_muestra'];
                    $new_row['m3_muestra'] = $row['ct57_m3_muestra'];
                    $new_row['asentamiento'] = $row['ct57_asentamiento'];
                    $new_row['temperatura'] = $row['ct57_temperatura'];
                    $new_row['cementante'] = $row['ct57_cementante'];
                    $new_row['aire'] = $row['ct57_aire'];
                    $new_row['rendimientovolumetrico'] = $row['ct57_rend_volumetrico'];

                    $datos[] = $new_row;
                }

                return $datos;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

}