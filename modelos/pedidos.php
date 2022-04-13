<?php

class pedidos extends conexionPDO
{
    protected $con;

    // Iniciar Conexion
    public function __construct()
    {
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
    }

    public static function cargar_precio_servicios_for_id_pedido($con, $id_pedido)
    {
        //  sql de consulta para cargar precios porductos
        $sql = "SELECT * FROM ct65_pedido_has_precio_servicio WHERE id_pedido = :id_pedido";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id_pedido', $id_pedido, PDO::PARAM_INT);

        if ($stmt->execute()) {
            while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $datos['id'] = $fila['id'];
                $datos['id_tipo_servicio'] = $fila['id_tipo_servicio'];
                $datos['nombre_tipo_servicio'] = $fila['nombre_tipo_servicio'];
                $datos['precio'] = $fila['precio'];


                $datosf[] = $datos;
            }
            return $datosf;
        } else {
            return false;
        }
    }

    // Cargar Precios Bomba por id_pedido
    public static function cargar_precio_bomba_for_id_pedido($con, $id_pedido)
    {
        //  sql de consulta para cargar precios porductos
        $sql = "SELECT * FROM ct65_pedido_has_precio_bomba WHERE id_pedido = :id_pedido";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id_pedido', $id_pedido, PDO::PARAM_INT);

        if ($stmt->execute()) {
            while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $datos['id'] = $fila['id'];
                $datos['id_tipo_bomba'] = $fila['id_tipo_bomba'];
                $datos['nombre_tipo_bomba'] = $fila['nombre_tipo_bomba'];
                $datos['min_m3'] = $fila['min_m3'];
                $datos['max_m3'] = $fila['max_m3'];
                $datos['precio'] = $fila['precio'];

                $datosf[] = $datos;
            }
            return $datosf;
        } else {
            return false;
        }
    }


    // Cargar Precios Producto por id_pedido
    public static function cargar_precio_productos_for_id_pedido($con, $id_pedido)
    {
        //  sql de consulta para cargar precios porductos
        $sql = "SELECT * FROM ct65_pedidos_has_precio_productos WHERE id_pedido = :id_pedido";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id_pedido', $id_pedido, PDO::PARAM_INT);

        if ($stmt->execute()) {
            while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $datos['id'] = $fila['id'];
                $datos['id_pedido'] = $fila['id_pedido'];
                $datos['status'] = $fila['status'];
                $datos['id_producto'] = $fila['id_producto'];
                $datos['codigo_producto'] = $fila['codigo_producto'];
                $datos['nombre_producto'] = $fila['nombre_producto'];
                $datos['porcentaje_descuento'] = $fila['porcentaje_descuento'];
                $datos['id_precio_base'] = $fila['id_precio_base'];
                $datos['precio_base'] = $fila['precio_base'];
                $datos['precio_m3'] = $fila['precio_m3'];
                $datos['cantidad_m3'] = $fila['cantidad_m3'];
                $datos['precio_total_pedido'] = $fila['precio_total_pedido'];
                $datosf[] = $datos;
            }
            return $datosf;
        } else {
            return false;
        }
    }

    public function cargar_precios_pedidos($id_pedido, $id_pedido_load)
    {
    }

    public function select_cliente($id = null)
    {
        $option = "<option  selected='true' value='NULL' disabled='true'> Seleccione cliente</option>";

        $sql = "SELECT * FROM `ct3_clientes`";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        if ($stmt->execute()) {
            while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if ($id == $fila['ct3_id_cliente']) {
                    $selection = "selected='true'";
                } else {
                    $selection = " ";
                }
                $option .= '<option value="' . $fila['ct3_id_cliente'] . '" ' . $selection . ' >' . $fila['ct3_nombre_cliente'] . ' </option>';
            }
        }
        return $option;
    }

    public function select_productos($id = null)
    {
        $option = "<option  selected='true' value='NULL' disabled='true'> Seleccione producto</option>";

        $sql = "SELECT * FROM `ct4_productos`";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        if ($stmt->execute()) {
            while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if ($id == $fila['ct4_Id_productos']) {
                    $selection = "selected='true'";
                } else {
                    $selection = " ";
                }
                $option .= '<option value="' . $fila['ct4_Id_productos'] . '" ' . $selection . ' >' . $fila['ct4_Descripcion'] . ' </option>';
            }
        }
        return $option;
    }

    public function select_bomba($id = null)
    {
        $option = "<option  selected='true' value='NULL' disabled='true'> Seleccione la bomba</option>";

        $sql = "SELECT * FROM `ct65_tipo_bomba`";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        if ($stmt->execute()) {
            while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if ($id == $fila['id']) {
                    $selection = "selected='true'";
                } else {
                    $selection = " ";
                }
                $option .= '<option value="' . $fila['id'] . '" ' . $selection . ' >' . $fila['nombre'] . ' </option>';
            }
        }
        return $option;
    }

    public function select_servicio($id = null)
    {
        $option = "<option  selected='true' value='NULL' disabled='true'> Seleccione el servicio</option>";

        $sql = "SELECT * FROM `ct65_tipo_servicio`";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        if ($stmt->execute()) {
            while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if ($id == $fila['id']) {
                    $selection = "selected='true'";
                } else {
                    $selection = " ";
                }
                $option .= '<option value="' . $fila['id'] . '" ' . $selection . ' >' . $fila['nombre'] . ' </option>';
            }
        }
        return $option;
    }

    public function get_nombre_cliente($id)
    {
        $this->id = $id;
        $sql = "SELECT ct3_nombre_cliente FROM `ct3_clientes` WHERE `ct3_id_cliente` = :id";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['ct3_nombre_cliente'];
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
    }

    public function get_precio_producto($id)
    {
        $this->id = $id;
        $sql = "SELECT `precio` FROM `ct65_precio_base` WHERE `id_producto` = :id";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['precio'];
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
    }

    public function get_nombre_obra($id)
    {
        $this->id = $id;
        $sql = "SELECT ct5_NombreObra FROM `ct5_obras` WHERE `ct5_IdObras` = :id";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['ct5_NombreObra'];
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
    }

    public function get_nombre_asesora($id)
    {
        $this->id = $id;
        $sql = "SELECT ct1_RazonSocial FROM `ct1_terceros` WHERE `ct1_IdTerceros` = :id";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['ct1_RazonSocial'];
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
    }

    public function get_nombre_producto($id)
    {
        $this->id = $id;
        $sql = "SELECT `ct4_Id_productos`, `ct4_Descripcion` FROM `ct4_productos` WHERE `ct4_Id_productos` = :id";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['ct4_Descripcion'];
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
    }

    public function get_id_producto($codigo)
    {
        $this->id = $codigo;
        $sql = "SELECT `ct4_Id_productos`,`ct4_CodigoSyscafe` FROM `ct4_productos` WHERE `ct4_CodigoSyscafe` =  :codigo";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':codigo', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['ct4_Id_productos'];
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
    }

    public function get_nombre_producto_por_cod($codigo)
    {
        $this->codigo = $codigo;
        $sql = "SELECT `ct4_CodigoSyscafe`, `ct4_Descripcion` FROM `ct4_productos` WHERE `ct4_CodigoSyscafe` = :codigo";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':codigo', $this->codigo, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['ct4_Descripcion'];
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
    }

    public function get_codigo_producto($id)
    {
        $this->id = $id;
        $sql = "SELECT `ct4_Id_productos`,`ct4_CodigoSyscafe` FROM `ct4_productos` WHERE `ct4_Id_productos` = :id";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['ct4_CodigoSyscafe'];
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
    }

    public function get_id_precio_base($id)
    {
        $this->id = $id;
        $sql = "SELECT `id` FROM `ct65_precio_base` WHERE `id_producto` = :id";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['id'];
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
    }

    public function get_precio_base($id)
    {
        $this->id = $id;
        $sql = "SELECT `precio` FROM `ct65_precio_base` WHERE `id_producto` = :id";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['precio'];
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
    }

    public function get_nombre_bomba($id)
    {
        $this->id = $id;
        $sql = "SELECT `nombre` FROM `ct65_tipo_bomba` WHERE `id` = :id";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['nombre'];
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
    }

    public function get_nombre_servicio($id)
    {
        $this->id = $id;
        $sql = "SELECT `nombre` FROM `ct65_tipo_servicio` WHERE `id` = :id";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['nombre'];
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
    }


    public function crear_pedido($fecha, $id_cliente, $nombre_cliente, $id_obra, $nombre_obra, $id_asesora, $nombre_asesora)
    {
        $this->status = 1;
        $this->fecha = $fecha;
        $this->id_cliente = $id_cliente;
        $this->nombre_cliente = $nombre_cliente;
        $this->id_obra = $id_obra;
        $this->nombre_obra = $nombre_obra;
        $this->id_asesora = $id_asesora;
        $this->nombre_asesora = $nombre_asesora;

        $sql = "INSERT INTO `ct65_pedidos`(`fecha_vencimiento`, `status`, `id_cliente`, `nombre_cliente`, `id_obra`, `nombre_obra`, `id_comercial`, `nombre_asesora`) VALUES (:fecha_vencimiento, :status, :id_cliente, :nombre_cliente, :id_obra, :nombre_obra, :id_comercial, :nombre_asesora)";

        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':fecha_vencimiento', $this->fecha, PDO::PARAM_STR);
        $stmt->bindParam(':status', $this->status, PDO::PARAM_STR);
        $stmt->bindParam(':id_cliente', $this->id_cliente, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_cliente', $this->nombre_cliente, PDO::PARAM_STR);
        $stmt->bindParam(':id_obra', $this->id_obra, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_obra', $this->nombre_obra, PDO::PARAM_STR);
        $stmt->bindParam(':id_comercial', $this->id_asesora, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_asesora', $this->nombre_asesora, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return $this->con->lastInsertId();
        } else {
            return false;
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
    }

    public function crear_precio_producto($id_pedido, $id_producto, $cod_producto, $nombre_producto, $porcentaje, $id_precio_base, $precio_base, $precio_m3, $cantidad_m3, $precio_total_pedido)
    {
        $this->status = 1;
        $this->id_pedido = $id_pedido;
        $this->id_producto = $id_producto;
        $this->cod_producto = $cod_producto;
        $this->nombre_producto = $nombre_producto;
        $this->porcentaje = $porcentaje;
        $this->id_precio_base = $id_precio_base;
        $this->precio_base = $precio_base;
        $this->precio_m3 = $precio_m3;
        $this->cantidad_m3 = $cantidad_m3;
        $this->precio_total_pedido = $precio_total_pedido;

        $sql = "INSERT INTO `ct65_pedidos_has_precio_productos`(`id_pedido`, `status`, `id_producto`, `codigo_producto`, `nombre_producto`, `porcentaje_descuento`, `id_precio_base`, `precio_base`, `precio_m3`, `cantidad_m3`, `precio_total_pedido`) VALUES  (:id_pedido, :status, :id_producto, :codigo_producto, :nombre_producto, :porcentaje_descuento, :id_precio_base, :precio_base, :precio_m3, :cantidad_m3, :precio_total_pedido)";

        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_pedido', $this->id_pedido, PDO::PARAM_STR);
        $stmt->bindParam(':status', $this->status, PDO::PARAM_STR);
        $stmt->bindParam(':id_producto', $this->id_producto, PDO::PARAM_INT);
        $stmt->bindParam(':codigo_producto', $this->cod_producto, PDO::PARAM_STR);
        $stmt->bindParam(':nombre_producto', $this->nombre_producto, PDO::PARAM_STR);
        $stmt->bindParam(':porcentaje_descuento', $this->porcentaje, PDO::PARAM_STR);
        $stmt->bindParam(':id_precio_base', $this->id_precio_base, PDO::PARAM_INT);
        $stmt->bindParam(':precio_base', $this->precio_base, PDO::PARAM_STR);
        $stmt->bindParam(':precio_m3', $this->precio_m3, PDO::PARAM_STR);
        $stmt->bindParam(':cantidad_m3', $this->cantidad_m3, PDO::PARAM_STR);
        $stmt->bindParam(':precio_total_pedido', $this->precio_total_pedido, PDO::PARAM_STR);

        $result = $stmt->execute();
        //Cerrar Conexion
        $this->PDO->closePDO();

        return $result;
    }

    public function crear_precio_bomba($id_pedido, $id_tipo_bomba, $nombre_tipo_bomba, $min_m3, $max_m3, $precio)
    {
        $this->status = 1;
        $this->id_pedido = $id_pedido;
        $this->id_tipo_bomba = $id_tipo_bomba;
        $this->nombre_tipo_bomba = $nombre_tipo_bomba;
        $this->min_m3 = $min_m3;
        $this->max_m3 = $max_m3;
        $this->precio = $precio;

        $sql = "INSERT INTO `ct65_pedido_has_precio_bomba`(`id_pedido`, `status`, `id_tipo_bomba`, `nombre_tipo_bomba`, `min_m3`, `max_m3`, `precio`) VALUES (:id_pedido, :status, :id_tipo_bomba, :nombre_tipo_bomba, :min_m3, :max_m3, :precio)";

        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_pedido', $this->id_pedido, PDO::PARAM_STR);
        $stmt->bindParam(':status', $this->status, PDO::PARAM_STR);
        $stmt->bindParam(':id_tipo_bomba', $this->id_tipo_bomba, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_tipo_bomba', $this->nombre_tipo_bomba, PDO::PARAM_STR);
        $stmt->bindParam(':min_m3', $this->min_m3, PDO::PARAM_INT);
        $stmt->bindParam(':max_m3', $this->max_m3, PDO::PARAM_STR);
        $stmt->bindParam(':precio', $this->precio, PDO::PARAM_INT);

        $result = $stmt->execute();
        //Cerrar Conexion
        $this->PDO->closePDO();

        return $result;
    }

    public function crear_precio_servicio($id_pedido, $id_tipo_servicio, $nombre_tipo_servicio, $descuento)
    {
        $this->status = 1;
        $this->id_pedido = $id_pedido;
        $this->id_tipo_servicio = $id_tipo_servicio;
        $this->nombre_tipo_servicio = $nombre_tipo_servicio;
        $this->precio = $descuento;

        $sql = "INSERT INTO `ct65_pedido_has_precio_servicio`(`id_pedido`, `status`, `id_tipo_servicio`, `nombre_tipo_servicio`, `precio`) VALUES  (:id_pedido, :status, :id_tipo_servicio, :nombre_tipo_servicio, :precio)";

        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_pedido', $this->id_pedido, PDO::PARAM_STR);
        $stmt->bindParam(':status', $this->status, PDO::PARAM_STR);
        $stmt->bindParam(':id_tipo_servicio', $this->id_tipo_servicio, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_tipo_servicio', $this->nombre_tipo_servicio, PDO::PARAM_STR);
        $stmt->bindParam(':precio', $this->precio, PDO::PARAM_INT);

        $result = $stmt->execute();
        //Cerrar Conexion
        $this->PDO->closePDO();

        return $result;
    }

    public function get_pedidos()
    {
        $sql = "SELECT `id`, `fecha_vencimiento`,`nombre_cliente`,`nombre_obra`,`nombre_asesora` FROM `ct65_pedidos`";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Ejecutar 
        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id'] = $fila['id'];
                    $datos['fecha_vencimiento'] = $fila['fecha_vencimiento'];
                    $datos['nombre_cliente'] = $fila['nombre_cliente'];
                    $datos['nombre_obra'] = $fila['nombre_obra'];
                    $datos['nombre_asesora'] = $fila['nombre_asesora'];
                    $datosf[] = $datos;
                }
                return $datosf;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function get_productos_precio($id_pedido)
    {
        $sql = "SELECT `id`,`codigo_producto`, `porcentaje_descuento`, `cantidad_m3`, `precio_m3` FROM `ct65_pedidos_has_precio_productos` WHERE `id_pedido` =  :id_pedido";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_pedido', $id_pedido, PDO::PARAM_INT);

        // Ejecutar 
        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id'] = $fila['id'];
                    $datos['codigo_producto'] = $fila['codigo_producto'];
                    $datos['porcentaje_descuento'] = $fila['porcentaje_descuento'];
                    $datos['cantidad_m3'] = $fila['cantidad_m3'];
                    $datos['precio_m3'] = $fila['precio_m3'];
                    $datosf[] = $datos;
                }
                return $datosf;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function get_bomba_precio($id_pedido)
    {
        $sql = "SELECT `id`,`nombre_tipo_bomba`,`min_m3`,`max_m3`,`precio` FROM `ct65_pedido_has_precio_bomba` WHERE `id_pedido` =  :id_pedido ";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_pedido', $id_pedido, PDO::PARAM_INT);

        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id'] = $fila['id'];
                    $datos['nombre_tipo_bomba'] = $fila['nombre_tipo_bomba'];
                    $datos['min_m3'] = $fila['min_m3'];
                    $datos['max_m3'] = $fila['max_m3'];
                    $datos['precio'] = $fila['precio'];
                    $datosf[] = $datos;
                }
                return $datosf;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function get_servicios_precio($id_pedido)
    {
        $sql = "SELECT `id`, `nombre_tipo_servicio`, `precio` FROM `ct65_pedido_has_precio_servicio` WHERE `id_pedido` =  :id_pedido";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_pedido', $id_pedido, PDO::PARAM_INT);

        // Ejecutar 
        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id'] = $fila['id'];
                    $datos['nombre_tipo_servicio'] = $fila['nombre_tipo_servicio'];
                    $datos['precio'] = $fila['precio'];
                    $datosf[] = $datos;
                }
                return $datosf;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function validar_existencias_productos($id_producto)
    {
        $sql = "SELECT id FROM concr_bdportalconcretol.ct65_precio_base WHERE status = 1 AND id_producto = :id_producto";
        $stmt = $this->con->prepare($sql); // Preparar la conexion
        $stmt->bindParam(':id_producto', $id_producto, PDO::PARAM_STR);
        // Ejecutar 
        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }

    function insert_precio_productos($fecha_subida,$id_producto,$codigo_producto,$nombre_producto,$precio)
    {
                $status = 1;
                $sql =  "INSERT INTO `ct65_precio_base` (`status`, `fecha_subida`, `id_producto`, `codigo_producto`, `nombre_producto`, `precio`) VALUES   (:status, :fecha_subida, :id_producto, :codigo_producto, :nombre_producto, :precio)";
                $stmt = $this->con->prepare($sql); // Preparar la conexion
                $stmt->bindParam(':status', $status, PDO::PARAM_STR);
                $stmt->bindParam(':fecha_subida', $fecha_subida, PDO::PARAM_STR);
                $stmt->bindParam(':id_producto', $id_producto, PDO::PARAM_STR);
                $stmt->bindParam(':codigo_producto', $codigo_producto, PDO::PARAM_STR);
                $stmt->bindParam(':nombre_producto', $nombre_producto, PDO::PARAM_STR);
                $stmt->bindParam(':precio', $precio, PDO::PARAM_STR);

                if ($stmt->execute()) { // Ejecutar
                    $php_result = true;
                } else {
                    $php_result = true;
                }
            
            return $php_result;
        
    }
    function editar_status_productos()
    {
        $this->status = 2;
        $sql = "UPDATE `ct65_precio_base` SET `status`= :status";

        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':status', $this->status, PDO::PARAM_INT);

        // Ejecutar 
        $result = $stmt->execute();

        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        return $result;
    }
}
