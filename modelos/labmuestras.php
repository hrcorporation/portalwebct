<?php

/**
 * Se crea la clase labmuestras con extendida con conexionPDO a la conexion a la base de datos
 */
class labmuestras extends conexionPDO
{
    protected $con;


    public function __construct()
    {
        //Conectar a la base de datos
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
    }

    public static function get_cantidad_resultados_muestras($con, $id_remision)
    {
        $sql = "SELECT COUNT(`ct58_id_resultado`) as cantidad_hechas FROM `ct58_resultado` WHERE `ct58_id_remision` = :id_remision ";
        //Preparar Conexion
        $stmt = $con->prepare($sql);

        $stmt->bindParam(':id_remision', $id_remision, PDO::PARAM_INT);

        if ($stmt->execute()) { // Ejecutar
            $num_reg =  $stmt->rowCount(); // Get Numero de Registros
            if ($num_reg > 0) { // Validar el numero de Registros
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $row['cantidad_hechas'];
                }
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }


    public static function getcantidad_muestras($con, $id_muestra)
    {
        $sql = "SELECT COUNT(`ct59_id`) as cantidad_muestras FROM `ct59_dias_fallo_result` WHERE `ct59_id_muestra` = :id_muestra  ";
        //Preparar Conexion
        $stmt = $con->prepare($sql);

        $stmt->bindParam(':id_muestra', $id_muestra, PDO::PARAM_INT);

        if ($stmt->execute()) { // Ejecutar
            $num_reg =  $stmt->rowCount(); // Get Numero de Registros
            if ($num_reg) { // Validar el numero de Registros
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $row['cantidad_muestras'];
                }
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    

    public function datatable_muestras_buscador($fecha, $cod_remi, $cod_muestra, $id_producto, $id_cliente, $id_obra, $status)
    {

        $sql = "SELECT `ct57_id_muestra`, `ct57_tipo_muestra`, `ct57_fecha`, `ct57_hora`, `ct57_cantidad`, `ct57_id_remision`, `ct57_id_mixer`, ct26_remisiones.ct26_vehiculo as placa, `ct57_id_cliente`, ct26_remisiones.ct26_razon_social as nombre_cliente, `ct57_id_obra`, ct26_remisiones.ct26_nombre_obra as nombre_obra, `ct57_codremision`, `ct57_id_producto`,ct4_productos.ct4_Nombre as cod_producto, ct4_productos.ct4_Descripcion as descripcion_producto, `ct57_id_tipo_producto`, `ct57_cantidad_muestra`, `ct57_m3_muestra`, `ct57_asentamiento`, `ct57_temperatura`, `ct57_cementante`, `ct57_aire`, `ct57_rend_volumetrico` FROM `ct57_muestra` INNER JOIN ct26_remisiones ON ct57_id_remision = ct26_remisiones.ct26_id_remision INNER JOIN ct4_productos ON ct57_muestra.ct57_id_producto = ct4_productos.ct4_Id_productos WHERE `ct57_fecha` LIKE '%$fecha%'  AND `ct57_codremision` LIKE '%$cod_remi%'  AND `ct57_id_muestra` LIKE '%$cod_muestra%'  AND `ct57_id_producto` LIKE '%$id_producto%' AND `ct57_id_cliente` LIKE '%$id_cliente%'  AND `ct57_id_obra` LIKE '%$id_obra%' ";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);



        if ($stmt->execute()) { // Ejecutar
            $num_reg =  $stmt->rowCount(); // Get Numero de Registros
            if ($num_reg > 0) { // Validar el numero de Registros
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $new_row['id'] = $row['ct57_id_muestra'];
                    $new_row['cant_muestras_total'] = SELF::getcantidad_muestras($this->con, $row['ct57_id_muestra']);
                    $cantidad_muestras = intval(SELF::getcantidad_muestras($this->con, $row['ct57_id_muestra']));
                    $muestras_hechas = intval(SELF::get_cantidad_resultados_muestras($this->con, $row['ct57_id_remision']));

                    $new_row['cant_pendientes'] = $cantidad_muestras - $muestras_hechas;
                    $new_row['cant_hechas'] = intval(SELF::get_cantidad_resultados_muestras($this->con, $row['ct57_id_remision']));

                    $new_row['tipo_muestra'] = $row['ct57_tipo_muestra'];
                    $new_row['fecha'] = $row['ct57_fecha'];
                    $new_row['hora'] = $row['ct57_hora'];
                    $new_row['cantidad'] = $row['ct57_cantidad'];
                    $new_row['id_remision'] = $row['ct57_id_remision'];
                    $new_row['id_mixer'] = $row['ct57_id_mixer'];
                    $new_row['id_cliente'] = $row['ct57_id_cliente'];
                    $new_row['nombre_cliente'] = $row['nombre_cliente'];
                    $new_row['id_obra'] = $row['ct57_id_obra'];
                    $new_row['nombre_obra'] = $row['nombre_obra'];
                    $new_row['codremision'] = $row['ct57_codremision'];
                    $new_row['id_producto'] = $row['ct57_id_producto'];
                    $new_row['cod_producto'] = $row['cod_producto'];
                    $new_row['desp_producto'] = $row['descripcion_producto'];
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

    public function datatable_muestras()
    {

        $sql = "SELECT `ct57_id_muestra`, `ct57_tipo_muestra`, `ct57_fecha`, `ct57_hora`, `ct57_cantidad`, `ct57_id_remision`, `ct57_id_mixer`, ct26_remisiones.ct26_vehiculo as placa, `ct57_id_cliente`, ct26_remisiones.ct26_razon_social as nombre_cliente, `ct57_id_obra`, ct26_remisiones.ct26_nombre_obra as nombre_obra, `ct57_codremision`, `ct57_id_producto`,ct4_productos.ct4_Nombre as cod_producto, ct4_productos.ct4_Descripcion as descripcion_producto, `ct57_id_tipo_producto`, `ct57_cantidad_muestra`, `ct57_m3_muestra`, `ct57_asentamiento`, `ct57_temperatura`, `ct57_cementante`, `ct57_aire`, `ct57_rend_volumetrico` FROM `ct57_muestra` INNER JOIN ct26_remisiones ON ct57_id_remision = ct26_remisiones.ct26_id_remision INNER JOIN ct4_productos ON ct57_muestra.ct57_id_producto = ct4_productos.ct4_Id_productos  ";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);



        if ($stmt->execute()) { // Ejecutar
            $num_reg =  $stmt->rowCount(); // Get Numero de Registros
            if ($num_reg > 0) { // Validar el numero de Registros
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $new_row['id'] = $row['ct57_id_muestra'];
                    $new_row['cant_muestras_total'] = SELF::getcantidad_muestras($this->con, $row['ct57_id_muestra']);
                    $cantidad_muestras = intval(SELF::getcantidad_muestras($this->con, $row['ct57_id_muestra']));
                    $muestras_hechas = intval(SELF::get_cantidad_resultados_muestras($this->con, $row['ct57_id_remision']));

                    $new_row['cant_pendientes'] = $cantidad_muestras - $muestras_hechas;
                    $new_row['cant_hechas'] = intval(SELF::get_cantidad_resultados_muestras($this->con, $row['ct57_id_remision']));

                    $new_row['tipo_muestra'] = $row['ct57_tipo_muestra'];
                    $new_row['fecha'] = $row['ct57_fecha'];
                    $new_row['hora'] = $row['ct57_hora'];
                    $new_row['cantidad'] = $row['ct57_cantidad'];
                    $new_row['id_remision'] = $row['ct57_id_remision'];
                    $new_row['id_mixer'] = $row['ct57_id_mixer'];
                    $new_row['id_cliente'] = $row['ct57_id_cliente'];
                    $new_row['nombre_cliente'] = $row['nombre_cliente'];
                    $new_row['id_obra'] = $row['ct57_id_obra'];
                    $new_row['nombre_obra'] = $row['nombre_obra'];
                    $new_row['codremision'] = $row['ct57_codremision'];
                    $new_row['id_producto'] = $row['ct57_id_producto'];
                    $new_row['cod_producto'] = $row['cod_producto'];
                    $new_row['desp_producto'] = $row['descripcion_producto'];
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

    function get_datos_lab_id($id)
    {
        $this->id = $id;
        $sql = "SELECT `ct57_id_muestra`, `ct57_tipo_muestra`, `ct57_fecha`, `ct57_hora`, `ct57_cantidad`, `ct57_id_remision`, `ct57_id_mixer`, `ct57_id_cliente`, `ct57_id_obra`, `ct57_codremision`, `ct57_id_producto`, `ct57_id_tipo_producto`, `ct57_cantidad_muestra`, `ct57_m3_muestra`, `ct57_asentamiento`, `ct57_temperatura`, `ct57_cementante`, `ct57_aire`, `ct57_rend_volumetrico` FROM `ct57_muestra`  WHERE `ct57_id_muestra` = :id";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

        // Ejecutar 
        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos[] = $fila;
                }
                return $datos;
            } else {
                return false;
            }
        } else {
            return false;
        }

        //Cerrar Conexion
        $this->PDO->closePDO();
    }
}
