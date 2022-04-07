<?php
class modelo_laboratorio extends conexionPDO
{
    protected $con;

    private $id;


    // Iniciar Conexion
    public function __construct()
    {
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
    }

    function buscar_muestras_existentes($id_remision){
        $sql = "SELECT `ct57_id_muestra` FROM `ct57_muestra` WHERE `ct57_id_remision` = :id_remision";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_remision', $id_remision, PDO::PARAM_INT);
        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return intval($fila['ct57_id_muestra']);
                }
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public static function eliminar_dias_cant_muestra($con, $id)
    {
        $sql = "DELETE FROM `ct59_dias_fallo_result` WHERE `ct59_dias_fallo_result`.`ct59_id` = :id";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        if ($result = $stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function cargar_data_dias($id_muestra, $codigo_muestra)
    {
        //=============================================================
        // obtener datos de la muestra por id
        // ============================================================
        

        // verifica si es array
        if (is_array($array_data_muestra = SELF::data_id_muestra($this->con, $id_muestra))) {
            // define variables del codigo del producto
            foreach ($array_data_muestra as $key_muestra) {
                $id_producto = $key_muestra['id_producto']; // id del producto
                $cod_producto = $key_muestra['cod_producto']; // codigo del producto
                $tipo_producto = substr($cod_producto, 0, -9); // Extraemos los digitos del tipo del producto
            }

            // obtenemos el id del producto 
            if ($id_tipo_producto = SELF::obtener_tipo_producto($this->con, $tipo_producto)) {
                // Hacemos una consulta en la tabla parara verificar si existe dias creados previamente para solo cargar los datos
                if (is_array($array_data_dias = SELF::get_dias_for_tipo_concreto($this->con, $id_tipo_producto))) {
                    // Recorremos la consulta con el foreach
                    foreach ($array_data_dias as $key_data) {

                        $dias = $key_data['dias_fallo'];
                        $cant = $key_data['cantidad'];
                        $fecha = $key_data['fecha'];
                        $result = SELF::insert_cant_dias_muestra($this->con, $id_muestra, $codigo_muestra, $cant, $dias, $fecha);
                    }
                    return $result;
                }else{
                    $msg = "No se encontro Registros de Dias de fallo";
                }
            }
        } else {
            $msg = "No se Encontro el id de la muestra"; // con el codigo del producto
            $estado = false;
        }

        //return $estado;
        return $msg;
    }

    public static function get_dias_for_tipo_concreto($con, $id_tipo_producto)
    {
        $sql = "SELECT `ct61_id`, `ct61_id_tipoconcreto`, `ct61_diasfallo`, `ct61_cant_muestra` FROM `ct61_dias_tipoconcreto` WHERE `ct61_id_tipoconcreto` = :id_tipo_concreto ";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id_tipo_concreto', $id_tipo_producto, PDO::PARAM_STR);
        if ($result = $stmt->execute()) {
            // Devolver el ultimo Registro insertado
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id'] = $fila['ct61_id'];
                    $datos['id_tipo_concreto'] = $fila['ct61_id_tipoconcreto'];
                    $datos['dias_fallo'] = $fila['ct61_diasfallo'];
                    $date_now = date('Y-m-d');
                    $dias_add = '+' . $fila['ct61_diasfallo'] . 'day';
                    $date_future = strtotime($dias_add, strtotime($date_now));
                    $date_future = date('Y-m-d', $date_future);
                    $datos['fecha'] = $date_future;
                    $datos['cantidad'] = $fila['ct61_cant_muestra'];
                    $array_data[] = $datos;
                }
                return $array_data;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function obtener_tipo_producto($con, $tipo_concreto)
    {

        $sql = "SELECT `ct21_IdTipoConcreto`, `ct21_CodTConcreto`, `ct21_DescripcionTC` FROM `ct21_tipoconcreto` WHERE `ct21_CodTConcreto` = :tipo_concreto";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':tipo_concreto', $tipo_concreto, PDO::PARAM_STR);
        if ($result = $stmt->execute()) {
            // Devolver el ultimo Registro insertado
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return  $fila['ct21_IdTipoConcreto'];
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function datatable_dias_muesta($id_muestra)
    {

        $sql = "SELECT `ct59_id`, `ct59_id_muestra`, `ct59_codigo_muestra`, `ct59_cantidad_muestra`, `ct59_dias`, `ct59_fecha_result` FROM `ct59_dias_fallo_result` WHERE `ct59_id_muestra` = :id_muestra";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_muestra', $id_muestra, PDO::PARAM_STR);
        if ($result = $stmt->execute()) {
            // Devolver el ultimo Registro insertado
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id'] = $fila['ct59_id'];
                    $datos['id_muestra'] = $fila['ct59_id_muestra'];
                    $datos['cod_muestra'] = $fila['ct59_codigo_muestra'];
                    $datos['cant_muestra'] = $fila['ct59_cantidad_muestra'];
                    $datos['dia'] = $fila['ct59_dias'];
                    $datos['fecha'] = $fila['ct59_fecha_result'];

                    $array_data[] = $datos;
                }
                return $array_data;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }


    public static function insert_cant_dias_muestra($con, $id_muestra, $codigo_muestra, $cant, $dias, $fecha)
    {
        $sql = "INSERT INTO `concr_bdportalconcretol`.`ct59_dias_fallo_result` (`ct59_id_muestra`, `ct59_codigo_muestra`, `ct59_cantidad_muestra`, `ct59_dias`, `ct59_fecha_result`) VALUES (:id_muestra, :codigo_muestra,:cant, :dia, :fecha);";


        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id_muestra', $id_muestra, PDO::PARAM_INT);
        $stmt->bindParam(':codigo_muestra', $codigo_muestra, PDO::PARAM_STR);
        $stmt->bindParam(':cant', $cant, PDO::PARAM_STR);
        $stmt->bindParam(':dia', $dias, PDO::PARAM_STR);
        $stmt->bindParam(':fecha', $fecha, PDO::PARAM_STR);
        if ($result = $stmt->execute()) {
            $id_insert = $con->lastInsertId();

            return $id_insert;
        } else {
            return false;
        }
    }

    public static function data_id_muestra($con, $id_muestra)
    {
        $sql = "SELECT `ct57_id_muestra`, ct4_productos.ct4_Nombre, ct4_productos.ct4_Descripcion ,`ct57_tipo_muestra`,ct62_tipomuestra.ct62_descripcion, `ct57_fecha`, `ct57_hora`, `ct57_cantidad`, `ct57_id_remision`, ct26_remisiones.ct26_codigo_remi ,`ct57_id_mixer`,ct10_vehiculo.ct10_Placa , `ct57_id_cliente`, ct1_terceros.ct1_RazonSocial , `ct57_id_obra`, ct5_obras.ct5_NombreObra, `ct57_codremision`, `ct57_id_producto`, `ct57_id_tipo_producto`, `ct57_m3_muestra`,ct57_cementante,ct57_m3_muestra, `ct57_asentamiento`, `ct57_temperatura`,ct57_aire,ct57_rend_volumetrico FROM `ct57_muestra` INNER JOIN ct62_tipomuestra ON ct57_muestra.ct57_tipo_muestra = ct62_tipomuestra.ct62_id INNER JOIN ct26_remisiones ON ct57_muestra.ct57_id_remision = ct26_remisiones.ct26_id_remision INNER JOIN ct10_vehiculo ON ct57_muestra.ct57_id_mixer = ct10_vehiculo.ct10_IdVehiculo INNER JOIN ct1_terceros ON ct57_muestra.ct57_id_cliente = ct1_terceros.ct1_IdTerceros INNER JOIN ct5_obras ON ct57_muestra.ct57_id_obra = ct5_obras.ct5_IdObras  INNER JOIN ct4_productos ON ct57_muestra.ct57_id_producto = ct4_productos.ct4_Id_productos WHERE ct57_id_muestra = :id_muestra ";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id_muestra', $id_muestra, PDO::PARAM_STR);
        if ($result = $stmt->execute()) {
            // Devolver el ultimo Registro insertado
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id_muestra'] = $fila['ct57_id_muestra'];
                    $datos['id_tipo_muestra'] = $fila['ct57_tipo_muestra'];
                    $datos['tipo_muestra'] = $fila['ct62_descripcion'];
                    $datos['fecha'] = $fila['ct57_fecha'];
                    $datos['hora'] = $fila['ct57_hora'];
                    $datos['cantidad'] = $fila['ct57_cantidad'];
                    $datos['id_remision'] = $fila['ct57_id_remision'];
                    $datos['cod_remision'] = $fila['ct26_codigo_remi'];
                    $datos['id_mixer'] = $fila['ct57_id_mixer'];
                    $datos['placa'] = $fila['ct10_Placa'];
                    $datos['id_cliente'] = $fila['ct57_id_cliente'];
                    $datos['nombre_cliente'] = $fila['ct1_RazonSocial'];
                    $datos['id_obra'] = $fila['ct57_id_obra'];
                    $datos['nombre_obra'] = $fila['ct5_NombreObra'];
                    $datos['id_producto'] = $fila['ct57_id_producto'];
                    $datos['cod_producto'] = $fila['ct4_Nombre'];
                    $datos['descripcion_producto'] = $fila['ct4_Descripcion'];
                    $datos['cementante'] = $fila['ct57_cementante'];
                    $datos['m3_muestra'] = $fila['ct57_m3_muestra'];
                    $datos['asentamieto'] = $fila['ct57_asentamiento'];
                    $datos['temperarura'] = $fila['ct57_temperatura'];
                    $datos['aire'] = $fila['ct57_aire'];
                    $datos['rend_volumetrico'] = $fila['ct57_rend_volumetrico'];




                    $array_data[] = $datos;
                }
                return $array_data;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function datatable_result_muestra($id_remision)
    {
        $sql = "SELECT ct58_id_resultado,`ct58_fecha`,`ct58_hora`, `ct58_resultado1`, `ct58_resultado2` FROM `ct58_resultado` WHERE `ct58_id_remision` = :id_remision";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_remision', $id_remision, PDO::PARAM_STR);
        if ($result = $stmt->execute()) {
            // Devolver el ultimo Registro insertado
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id_muestra'] = $fila['ct58_id_resultado'];
                    $datos['fecha'] = $fila['ct58_fecha'];
                    $datos['hora'] = $fila['ct58_hora'];
                    $datos['resultado1'] = $fila['ct58_resultado1'];
                    $datos['resultado2'] = $fila['ct58_resultado2'];
                    $array_data[] = $datos;
                }
                return $array_data;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function datatable_muestra()
    {
        $sql = "SELECT `ct57_id_muestra`, `ct57_tipo_muestra`,ct62_tipomuestra.ct62_descripcion, `ct57_fecha`, `ct57_hora`, `ct57_cantidad`, `ct57_id_remision`, ct26_remisiones.ct26_codigo_remi ,`ct57_id_mixer`,ct10_vehiculo.ct10_Placa , `ct57_id_cliente`, ct1_terceros.ct1_RazonSocial , `ct57_id_obra`, ct5_obras.ct5_NombreObra, `ct57_codremision`, `ct57_id_producto`, `ct57_id_tipo_producto`, `ct57_cantidad_muestra`, `ct57_asentamiento`, `ct57_temperatura` FROM `ct57_muestra` INNER JOIN ct62_tipomuestra ON ct57_muestra.ct57_tipo_muestra = ct62_tipomuestra.ct62_id INNER JOIN ct26_remisiones ON ct57_muestra.ct57_id_remision = ct26_remisiones.ct26_id_remision INNER JOIN ct10_vehiculo ON ct57_muestra.ct57_id_mixer = ct10_vehiculo.ct10_IdVehiculo INNER JOIN ct1_terceros ON ct57_muestra.ct57_id_cliente = ct1_terceros.ct1_IdTerceros INNER JOIN ct5_obras ON ct57_muestra.ct57_id_obra = ct5_obras.ct5_IdObras; ";
        $stmt = $this->con->prepare($sql);
        //$stmt->bindParam(':asentamiento', $asentamiento, PDO::PARAM_STR);
        if ($result = $stmt->execute()) {
            // Devolver el ultimo Registro insertado
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id_muestra'] = $fila['ct57_id_muestra'];
                    $datos['id_tipo_muestra'] = $fila['ct57_tipo_muestra'];
                    $datos['tipo_muestra'] = $fila['ct62_descripcion'];
                    $datos['fecha'] = $fila['ct57_fecha'];
                    $datos['hora'] = $fila['ct57_hora'];
                    $datos['cantidad'] = $fila['ct57_cantidad'];
                    $datos['id_remision'] = $fila['ct57_id_remision'];
                    $datos['cod_remision'] = $fila['ct26_codigo_remi'];
                    $datos['id_mixer'] = $fila['ct57_id_mixer'];
                    $datos['placa'] = $fila['ct57_id_mixer'];
                    $datos['id_cliente'] = $fila['ct57_id_cliente'];
                    $datos['nombre_cliente'] = $fila['ct1_RazonSocial'];
                    $datos['id_obra'] = $fila['ct57_id_obra'];
                    $datos['nombre_obra'] = $fila['ct5_NombreObra'];
                    $datos['id_producto'] = $fila['ct57_id_producto'];
                    $datos['cod_producto'] = $fila['ct57_id_producto'];
                    $datos['descripcion_producto'] = $fila['ct57_id_producto'];
                    $datos['asentamieto'] = $fila['ct57_asentamiento'];
                    $datos['temperarura'] = $fila['ct57_temperatura'];

                    $array_data[] = $datos;
                }
                return $array_data;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function select_muestra_for_id($id_muestra)
    {
        $sql = "SELECT `ct57_id_muestra`, `ct57_tipo_muestra`, `ct57_fecha`, `ct57_hora`, `ct57_cantidad`, `ct57_id_remision`, `ct57_id_mixer`, `ct57_id_cliente`, `ct57_id_obra`, `ct57_codremision`, `ct57_id_producto`, `ct57_id_tipo_producto`, `ct57_cantidad_muestra`, `ct57_asentamiento`, `ct57_temperatura` FROM `ct57_muestra` WHERE `ct57_id_muestra` = :id_muestra";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_muestra', $this->$id_muestra, PDO::PARAM_STR);
        if ($result = $stmt->execute()) {
            // Devolver el ultimo Registro insertado
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id_muestra'] = $fila['ct57_id_muestra'];
                    $datos['id_tipo_muestra'] = $fila['ct57_tipo_muestra'];
                    $datos['fecha'] = $fila['ct57_fecha'];
                    $datos['hora'] = $fila['ct57_hora'];
                    $datos['cantidad'] = $fila['ct57_cantidad'];
                    $datos['id_remision'] = $fila['ct57_id_remision'];
                    $datos['id_mixer'] = $fila['ct57_id_mixer'];
                    $datos['id_cliente'] = $fila['ct57_id_cliente'];
                    $datos['id_obra'] = $fila['ct57_id_obra'];
                    $datos['cod_remision'] = $fila['ct57_codremision'];
                    $datos['id_producto'] = $fila['ct57_id_producto'];
                    $datos['asentamieto'] = $fila['ct57_asentamiento'];
                    $datos['temperarura'] = $fila['ct57_temperatura'];

                    $array_data[] = $datos;
                }
                return $array_data;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function get_nombre_obra($con, $id)
    {
        $sql = "SELECT `ct5_NombreObra` FROM `ct5_obras` WHERE `ct5_IdObras` = :id_obra";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id_obra', $id, PDO::PARAM_STR);
        if ($result = $stmt->execute()) {
            // Devolver el ultimo Registro insertado
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['nombre_obra'] = $fila['ct5_NombreObra'];
                    $array_data[] = $datos;
                }
                return $array_data;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function get_nombre_cliente($con, $id)
    {
        $sql = "SELECT `ct1_RazonSocial`  FROM `ct1_terceros` WHERE `ct1_IdTerceros` = :id_cliente";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id_cliente', $id, PDO::PARAM_STR);
        if ($result = $stmt->execute()) {
            // Devolver el ultimo Registro insertado
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['nombre_cliente'] = $fila['ct1_RazonSocial'];
                    $array_data[] = $datos;
                }
                return $array_data;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function crear_muestras($id_remision, $fecha_remision, $codigo_remi, $id_cliente, $nombre_cliente, $id_obra, $nombre_obra, $id_mixer, $id_producto, $codproducto, $producto, $metros, $m3_muestra, $hora, $tipo_muesta)
    {
        $id_tipo_producto  = 1;
        $sql = "INSERT INTO `ct57_muestra`( `ct57_tipo_muestra`, `ct57_fecha`, `ct57_hora`, `ct57_cantidad`, ct57_m3_muestra, `ct57_id_remision`, `ct57_id_mixer`, `ct57_id_cliente`,ct57_nombre_cliente, `ct57_id_obra`, `ct57_nombre_obra`, `ct57_codremision`, `ct57_id_producto`, `ct57_cod_producto`, `ct57_nombre_producto`, `ct57_id_tipo_producto`) VALUES (:tipomuestra, :fecha, :hora, :cantidad, :m3_muestra, :id_remision, :id_mixer, :id_cliente, :nombre_cliente, :id_obra, :nombre_obra, :codigo_remision, :id_producto, :codproducto, :nombre_producto, :id_tipo_producto)";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':tipomuestra', $tipo_muesta, PDO::PARAM_STR);
        $stmt->bindParam(':fecha', $fecha_remision, PDO::PARAM_STR);
        $stmt->bindParam(':hora', $hora, PDO::PARAM_STR);
        $stmt->bindParam(':cantidad', $metros, PDO::PARAM_STR);
        $stmt->bindParam(':m3_muestra', $m3_muestra, PDO::PARAM_STR);
        $stmt->bindParam(':id_remision', $id_remision, PDO::PARAM_STR);
        $stmt->bindParam(':id_mixer', $id_mixer, PDO::PARAM_STR);
        $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_STR);
        $stmt->bindParam(':nombre_cliente', $nombre_cliente, PDO::PARAM_STR);
        $stmt->bindParam(':id_obra', $id_obra, PDO::PARAM_STR);
        $stmt->bindParam(':nombre_obra', $nombre_obra, PDO::PARAM_STR);
        $stmt->bindParam(':codigo_remision', $codigo_remi, PDO::PARAM_STR);
        $stmt->bindParam(':id_producto', $id_producto, PDO::PARAM_STR);
        $stmt->bindParam(':codproducto', $codproducto, PDO::PARAM_STR);
        $stmt->bindParam(':nombre_producto', $producto, PDO::PARAM_STR);
        $stmt->bindParam(':id_tipo_producto', $id_tipo_producto, PDO::PARAM_STR);
        if ($result = $stmt->execute()) {
            $id_insert = $this->con->lastInsertId();

            return $id_insert;
        } else {
            return false;
        }
    }
    public function actualizar_datos_muestra($id, $hora, $tipo_muestra)
    {
        $sql = "UPDATE `ct57_muestra` SET `ct57_tipo_muestra` = :tipo_muestra, `ct57_hora` = :hora WHERE `ct57_id_muestra` = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':hora', $hora, PDO::PARAM_STR);
        $stmt->bindParam(':tipo_muestra', $tipo_muestra, PDO::PARAM_INT);

        if ($result = $stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    function actualizar_data_muestra($id_muestra, $asentamiento, $temperatura, $m3, $cementante, $aire, $rendimiento_volumentrico)
    {
        $sql = "UPDATE `ct57_muestra` SET  `ct57_asentamiento`= :asentamiento,`ct57_temperatura`=:temperatura, ct57_cantidad_muestra = :m3,ct57_rend_volumetrico = :rendimiento_volumetrico, ct57_cementante = :cementante , ct57_aire = :aire WHERE `ct57_id_muestra` = :id_muestra";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':asentamiento', $asentamiento, PDO::PARAM_STR);
        $stmt->bindParam(':temperatura', $temperatura, PDO::PARAM_STR);
        $stmt->bindParam(':m3', $m3, PDO::PARAM_STR);
        $stmt->bindParam(':cementante', $cementante, PDO::PARAM_STR);
        $stmt->bindParam(':aire', $aire, PDO::PARAM_STR);
        $stmt->bindParam(':rendimiento_volumetrico', $rendimiento_volumentrico, PDO::PARAM_STR);

        $stmt->bindParam(':id_muestra', $id_muestra, PDO::PARAM_STR);

        if ($result = $stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public static function buscar_existencia_registro($con, $id_log)
    {
        $sql = "SELECT `ct58_id_resultado` FROM `ct58_resultado` WHERE ct58_id_log =:id_log";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id_log', $id_log, PDO::PARAM_STR);
        if ($result = $stmt->execute()) {
            // Devolver el ultimo Registro insertado
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 1) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function actualizar_log_resultado($con, $id_remision, $id_producto, $id_log)
    {
        $id_remision = intval($id_remision);
        $id_producto = intval($id_producto);
        $id_log = intval($id_log);
        $estado = 1;  // sincronizo bien
        $sql = "UPDATE `ct58_resultado` SET `ct58_id_remision`=:id_remi, `ct58_id_producto`=:id_produc, ct58_estado = :estado WHERE `ct58_id_resultado`= :id_resultado";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id_remi', $id_remision, PDO::PARAM_STR);
        $stmt->bindParam(':id_produc', $id_producto, PDO::PARAM_STR);
        $stmt->bindParam(':estado', $estado, PDO::PARAM_STR);
        $stmt->bindParam(':id_resultado', $id_log, PDO::PARAM_STR);
        if ($result = $stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public static function buscar_id_remi($con, $cod_remision)
    {
        $cod_remision = intval($cod_remision);
        $sql = "SELECT `ct26_id_producto`,`ct26_id_remision` FROM `ct26_remisiones` WHERE `ct26_codigo_remi`= :codigoremi ORDER BY ct26_id_remision DESC LIMIT 1";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':codigoremi', $cod_remision, PDO::PARAM_INT);
        if ($result = $stmt->execute()) {
            // Devolver el ultimo Registro insertado
            $num_reg =  $stmt->rowCount();
            if ($num_reg == 1) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id_remision'] = $fila['ct26_id_remision'];
                    $datos['id_producto'] = $fila['ct26_id_producto'];
                    $array_data[] = $datos;
                }
                return $array_data;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    function guardar_data_archivo_plano($id_log, $fecha, $hora, $cod_remision, $resultado1, $resultado2)
    {
        $this->id_log = $id_log;
        $fecha_create = "";
        $this->fecha_create = $fecha_create;
        $this->fecha = $fecha;
        $this->hora = $hora;
        $this->cod_remision = $cod_remision;
        $this->resultado1 = $resultado1;
        $this->resultado2 = $resultado2;
        $this->estado = 2; // subido Correctamente

        $resultado_existencia = SELF::buscar_existencia_registro($this->con, $this->id_log);

        if (!$resultado_existencia) {
            $sql = "INSERT INTO `ct58_resultado`(ct58_estado, `ct58_id_log`, `ct58_fecha_subida`, `ct58_fecha`, `ct58_hora`,  `ct58_codremision`,`ct58_resultado1`, `ct58_resultado2`) VALUES (:estado,:id_log,:fecha_subida,:fecha , :hora, :cod_remision , :resultado1, :resultado2 )";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':estado', $this->estado, PDO::PARAM_STR);
            $stmt->bindParam(':id_log', $this->id_log, PDO::PARAM_STR);
            $stmt->bindParam(':fecha_subida', $this->fecha_create, PDO::PARAM_STR);
            $stmt->bindParam(':fecha', $this->fecha, PDO::PARAM_STR);
            $stmt->bindParam(':hora', $this->hora, PDO::PARAM_STR);
            $stmt->bindParam(':cod_remision', $this->cod_remision, PDO::PARAM_STR);
            $stmt->bindParam(':resultado1', $this->resultado1, PDO::PARAM_STR);
            $stmt->bindParam(':resultado2', $this->resultado2, PDO::PARAM_STR);

            if ($result = $stmt->execute()) {
                // Devolver el ultimo Registro insertado
                $id_insert = $this->con->lastInsertId();
                $array_data = SELF::buscar_id_remi($this->con, $cod_remision);

                if (is_array($array_data)) {
                    // recorer el array
                    foreach ($array_data as $key) {
                        $id_remision = $key['id_remision'];
                        $id_producto = $key['id_producto'];
                    }
                    // se valida si
                    if ($id_insert) {
                        $result = SELF::actualizar_log_resultado($this->con, $id_remision, $id_producto, $id_insert);
                    }
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function subir_plano2($archivo, $ruta)
    {
        $php_fechatime = date("Y-m-d H:i:s");
        $date = "" . date('Y/m/d h:i:s', time());


        $php_fileexten = strrchr($this->img_remi, ".");
        $php_serial = strtoupper(substr(hash('sha1', $this->img_remi . $date), 0, 40)) . $php_fileexten;


        $carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/internal/images/remisiones/';
        $php_tempfoto = ('/internal/images/remisiones/' . $php_serial);

        $sql = "UPDATE `ct26_remisiones` SET `ct26_imagen_remi` = :img_remi , `ct26_estado`= 2 , ct26_fisica = 1 WHERE `ct26_id_remision` = :id_remision";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':img_remi', $php_tempfoto, PDO::PARAM_STR);
        $stmt->bindParam(':id_remision', $this->id_remision, PDO::PARAM_INT);
        // Ejecutar 
        if ($result = $stmt->execute()) {
            $php_movefile = move_uploaded_file($ruta, $carpeta_destino . $php_serial);
            return true;
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
        //resultado
        return $result;
    }
}
