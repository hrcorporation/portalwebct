<?php


class modelo_remisiones extends conexionPDO
{
    protected $con;

    private $id;


    // Iniciar Conexion
    public function __construct()
    {
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
    }

    public function data_remision_id($cod_remision,$id_remision){
        $this->id_remision = intval($id_remision);
        $sql="";
        

    }

    function data_remision_for_id($id_remision)
    {
        
        $this->id_remision = intval($id_remision);
        $sql = "SELECT ct26_id_remision, ct26_imagen_remi, ct26_codigo_remi,ct26_idcliente, ct26_razon_social , ct26_idObra,ct26_nombre_obra ,ct26_id_vehiculo, ct26_vehiculo, ct26_fecha_remi,ct26_id_producto,ct26_descripcion_producto,ct26_codigo_producto, ct26_metros FROM `ct26_remisiones` WHERE `ct26_id_remision` = :id_remision ORDER BY `ct26_id_remision` DESC";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        // Asignando Datos ARRAY => SQL
       
        $stmt->bindParam(':id_remision', $this->id_remision, PDO::PARAM_INT);
        // Ejecutar 
        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id_remision'] = $fila['ct26_id_remision']; // id Remision
                    $datos['fecha_remi'] = $fila['ct26_fecha_remi'];
                    $datos['codigo_remi'] = $fila['ct26_codigo_remi'];
                    $datos['id_cliente'] = $fila['ct26_idcliente'];// Id cliente
                    $datos['nombre_cliente'] = $fila['ct26_razon_social'];
                    $datos['id_obra'] = $fila['ct26_idObra'];
                    $datos['nombre_obra'] = $fila['ct26_nombre_obra'];
                    $datos['img'] = $fila['ct26_imagen_remi'];
                    $datos['id_mixer'] = $fila['ct26_id_vehiculo']; // id_vehiculo
                    $datos['placa'] = $fila['ct26_vehiculo'];
                    $datos['id_producto'] = $fila['ct26_id_producto']; // id Producto
                    $datos['codproducto'] = $fila['ct26_codigo_producto'];
                    $datos['producto'] = $fila['ct26_descripcion_producto'];
                    $datos['metros'] = $fila['ct26_metros']; // metros

                    $array_data[] = $datos;
                }
                return $array_data;
            } else {
                return false;
            }
        } else {
            return false;
        }

        //Cerrar Conexion
        $this->PDO->closePDO();
    }

    

    public static function data_table_remision($con)
    {
        $year = date('Y');
        $mes = date('m');
        $dia = date('d');

        $fecha = $year . '-' . --$mes . '-' . $dia;
       
        $sql = "SELECT ct26_id_remision, ct26_imagen_remi, ct26_codigo_remi,ct26_idcliente, ct26_razon_social , ct26_idObra,ct26_nombre_obra ,ct26_id_vehiculo, ct26_vehiculo, ct26_fecha_remi,ct26_id_producto,ct26_descripcion_producto,ct26_codigo_producto, ct26_metros FROM `ct26_remisiones` WHERE `ct26_fecha_remi` >= :fecha_remi ORDER BY `ct26_id_remision` DESC";
        //Preparar Conexion
        $stmt = $con->prepare($sql);
        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':fecha_remi', $fecha, PDO::PARAM_STR);
        //$stmt->bindParam(':id_remision', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id_remision'] = $fila['ct26_id_remision']; // id Remision
                    $datos['fecha_remi'] = $fila['ct26_fecha_remi'];
                    $datos['codigo_remi'] = $fila['ct26_codigo_remi'];
                    $datos['id_cliente'] = $fila['ct26_idcliente'];// Id cliente
                    $datos['nombre_cliente'] = $fila['ct26_razon_social'];
                    $datos['id_obra'] = $fila['ct26_idObra'];
                    $datos['nombre_obra'] = $fila['ct26_nombre_obra'];
                    $datos['img'] = $fila['ct26_imagen_remi'];
                    $datos['id_mixer'] = $fila['ct26_id_vehiculo']; // id_vehiculo
                    $datos['placa'] = $fila['ct26_vehiculo'];
                    $datos['id_producto'] = $fila['ct26_id_producto']; // id Producto
                    $datos['codproducto'] = $fila['ct26_codigo_producto'];
                    $datos['producto'] = $fila['ct26_descripcion_producto'];
                    $datos['metros'] = $fila['ct26_metros']; // metros

                    $array_data[] = $datos;
                }
                return $array_data;
            } else {
                return false;
            }
        } else {
            return false;
        }

        //Cerrar Conexion
        
    }


    public static function actualizar_estado_remi()
    {
        $sql = "SELECT * FROM `ct26_remisiones`  ";
    }

    public static function actualizar_estado_remi_id()
    {
        $sql = "SELECT * FROM `ct26_remisiones` ";
    }


    public static function get_name_tercero($con, $id_tercero)
    {

        $sql = "SELECT ct1_terceros.ct1_RazonSocial FROM ct1_terceros WHERE ct1_terceros.ct1_IdTerceros = :id_tercero";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id_tercero', $id_tercero, PDO::PARAM_INT);
        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $nombre_tercero = $fila['ct1_RazonSocial'];
                }
                return $nombre_tercero;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function get_name_bomba($con, $id_bomba)
    {
        $sql = "SELECT `ct53_nombre_bomba` FROM `ct53_bomba` WHERE `ct53_id_bomba` = :id_bomba";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id_bomba', $id_bomba, PDO::PARAM_INT);
        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $nombre_bomba = $fila['ct53_nombre_bomba'];
                }
                return $nombre_bomba;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function update_bombeo($id_remi, $id_bomba, $id_op_bomba, $id_aux_bomba)
    {
        $this->id_remi = intval($id_remi);
        $this->id_bomba = intval($id_bomba);
        if ($this->id_bomba <= 1) {
            $this->nombre_bomba = NULL;
            $this->nombre_op_bomba = NULL;
            $this->nombre_aux_bomba = NULL;
        } else {
            $this->nombre_bomba = SELF::get_name_bomba($this->con, $this->id_bomba);
            $this->id_op_bomba = intval($id_op_bomba);
            $this->nombre_op_bomba = SELF::get_name_tercero($this->con, $this->id_op_bomba);
            $this->id_aux_bomba = intval($id_aux_bomba);
            $this->nombre_aux_bomba = SELF::get_name_tercero($this->con, $this->id_aux_bomba);
        }

        $sql = "UPDATE `ct26_remisiones` SET `ct26_bomba` = :bomba,`ct26_id_op_bomba`= :id_op_bomba,`ct26_op_bomba`= :nombre_op_bomba,`ct26_id_aux_bomba`= :id_aux_bomba,`ct26_aux_bomba`= :nombre_aux_bomba WHERE `ct26_id_remision` = :id_remision";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':bomba', $this->nombre_bomba, PDO::PARAM_STR);
        $stmt->bindParam(':id_op_bomba', $this->id_op_bomba, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_op_bomba', $this->nombre_op_bomba, PDO::PARAM_STR);
        $stmt->bindParam(':id_aux_bomba', $this->id_aux_bomba, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_aux_bomba', $this->nombre_aux_bomba, PDO::PARAM_STR);
        $stmt->bindParam(':id_remision', $this->id_remi, PDO::PARAM_INT);

        if ($result = $stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function data_remisiones_cli($id_obra)
    {

        $this->id_obra = intval($id_obra);
        $sql_obra = "SELECT `ct26_id_remision`, `ct26_codigo_remi`, `ct26_imagen_remi`, `ct26_idcliente`,`ct26_razon_social`,`ct26_idObra`,`ct26_nombre_obra`, `ct26_fecha_remi`, `ct26_estado`, `ct26_hora_salida_planta`, `ct26_hora_llegada_obra`, `ct26_hora_inicio_descargue`, `ct26_hora_terminada_descargue` FROM `ct26_remisiones` WHERE `ct26_idObra` = :id_obra ORDER BY  `ct26_remisiones`.`ct26_fecha_remi` DESC "; //Select Cliente
        $stmt_obra = $this->con->prepare($sql_obra);
        $stmt_obra->bindParam(':id_obra', $this->id_obra, PDO::PARAM_INT);
        if ($stmt_obra->execute()) {
            $num_reg =  $stmt_obra->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt_obra->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos[] = $fila;
                }
                return $datos;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function datatable_factura_remi_cli($id_factura)
    {
        $sql = "SELECT ct26_remisiones.ct26_id_remision, ct26_remisiones.ct26_codigo_remi, ct26_remisiones.ct26_imagen_remi FROM `ct28_factura_remi` INNER JOIN ct26_remisiones ON ct28_factura_remi.ct28_id_remision = ct26_remisiones.ct26_id_remision WHERE `ct28_id_fact` = :id_factura";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_factura', $id_factura, PDO::PARAM_INT);
        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos_array['id_remision'] = $fila['ct26_id_remision'];
                    $datos_array['codigo_remi'] = $fila['ct26_codigo_remi'];
                    $datos_array['img_remi'] = $fila['ct26_imagen_remi'];
                    $datos[] = $datos_array;
                }
                return $datos;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function datatable_remisiones($id_usuario)
    {
        $this->id_usuario = intval($id_usuario);
        $array_permisios = SELF::get_cli_obra_for_usuario($this->con, $this->id_usuario);

        foreach ($array_permisios as $key) {
            $array_remisiones = SELF::datatable_remi_cli($this->con, $key['id_obra']);

            foreach ($array_remisiones as $key['']) {
                # code...
            }
        }
    }

    public static function get_cli_obra_for_usuario($con, $id_usuario)
    {
        $sql = "SELECT `id_user_roles`, `id_user`, `id_roles`, `id_cliente`, `id_obra` FROM `usuarios_roles` WHERE `id_user` = :id_usuario";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos_array['id_rol'] = $fila['id_roles'];
                    $datos_array['id_cliente'] = $fila['id_cliente'];
                    $datos_array['id_obra'] = $fila['id_obra'];
                    $datos[] = $datos_array;
                }
                return $datos;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function datatable_remi_cli($con, $id_obra)
    {
        $sql = "SELECT `ct26_id_remision`,`ct26_estado`,`ct26_fecha_remi`,`ct26_idcliente`,`ct26_nitcliente`,`ct26_razon_social`,`ct26_idObra`,`ct26_nombre_obra` FROM `ct26_remisiones` WHERE `ct26_idObra` = :id_obra";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id_obra', $id_obra, PDO::PARAM_INT);
        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos_array['id_remision'] = $fila['ct26_id_remision'];
                    $datos_array['estado'] = $fila['ct26_estado'];
                    $datos_array['fecha_remi'] = $fila['ct26_fecha_remi'];
                    $datos_array['id_cliente'] = $fila['ct26_idcliente'];
                    $datos_array['num_identificacion'] = $fila['ct26_nitcliente'];
                    $datos_array['nombre_cliente'] = $fila['ct26_razon_social'];
                    $datos_array['id_obra'] = $fila['ct26_idObra'];
                    $datos_array['nombre_obra'] = $fila['ct26_nombre_obra'];
                    $datos[] = $datos_array;
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
