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
    //Listar con un arreglo los valores de metros cubicos minimos.
    public function array_list_min_max($minimo, $maximo)
    {
        $array_list = array();
        //$diferencia = $maximo - $minimo;
        //$minimo_m3 = $minimo - 1;
        $minimo = intval($minimo);
        $maximo = intval($maximo);

        for ($new_min = $minimo; $new_min <= $maximo; $new_min++) {
            array_push($array_list, $new_min);
        }
        return $array_list;
    }
    //Listar los precios de los servicios mediante el id del pedido.
    public static function cargar_precio_servicios_for_id_pedido($con, $id_pedido)
    {
        //  sql de consulta para cargar precios porductos
        $sql = "SELECT * FROM ct65_pedido_has_precio_servicio WHERE id_pedido = :id_pedido AND `status` = 1";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id_pedido', $id_pedido, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount(); // Cuenta los numero de registros de sql
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $datos['id'] = $fila['id'];
                    $datos['id_tipo_servicio'] = $fila['id_tipo_servicio'];
                    $datos['nombre_tipo_servicio'] = $fila['nombre_tipo_servicio'];
                    $datos['precio'] = $fila['precio'];
                    $datos['observaciones'] = $fila['observaciones'];
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
    // Cargar Precios Bomba por id_pedido
    public static function cargar_precio_bomba_for_id_pedido($con, $id_pedido)
    {
        //  sql de consulta para cargar precios porductos
        $sql = "SELECT * FROM ct65_pedido_has_precio_bomba WHERE id_pedido = :id_pedido AND `status` = 1";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id_pedido', $id_pedido, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount(); // Cuenta los numero de registros de sql
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $datos['id'] = $fila['id'];
                    $datos['id_tipo_bomba'] = $fila['id_tipo_bomba'];
                    $datos['nombre_tipo_bomba'] = $fila['nombre_tipo_bomba'];
                    $datos['min_m3'] = $fila['min_m3'];
                    $datos['max_m3'] = $fila['max_m3'];
                    $datos['precio'] = $fila['precio'];
                    $datos['observaciones'] = $fila['observaciones'];
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
    // Cargar Precios Producto por id_pedido
    public static function cargar_precio_productos_for_id_pedido($con, $id_pedido)
    {
        //  sql de consulta para cargar precios porductos
        $sql = "SELECT * FROM ct65_pedidos_has_precio_productos WHERE id_pedido = :id_pedido AND `status` = 1";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id_pedido', $id_pedido, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount(); // Cuenta los numero de registros de sql
            if ($num_reg > 0) {
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
                    $datos['saldo_m3'] = $fila['saldo_m3'];
                    $datos['precio_total_pedido'] = $fila['precio_total_pedido'];
                    $datos['observaciones'] = $fila['observaciones'];

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
    //Select de los clientes
    public function select_cliente($id = null)
    {
        $option = "<option  selected = 'true' value='NULL' disabled='true'> Seleccione cliente </option>";

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
    //Select de los clientes
    function option_cliente_edit($id_cliente = null)
    {
        $option = "<option  selected='true'> Seleccione un Cliente</option>";
        $sql = "SELECT ct1_IdTerceros , ct1_NumeroIdentificacion , ct1_RazonSocial FROM ct1_terceros WHERE ct1_TipoTercero = 1 AND ct1_Estado = 1";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        //$stmt->bindParam(':id_tercero', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        $result = $stmt->execute();


        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($id_cliente == $fila['ct1_IdTerceros']) {
                $selection = " selected='true' ";
            } else {
                $selection = "";
            }
            $option .= '<option value="' . $fila['ct1_IdTerceros'] . '" ' . $selection . ' >' . $fila['ct1_NumeroIdentificacion'] . ' - ' . $fila['ct1_RazonSocial'] . ' </option>';
        }

        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        return $option;
    }
    //Select de los productos
    public function select_productos($id = null)
    {
        $option = "<option  selected='true' value='NULL' disabled='true'> Seleccione el producto</option>";

        $sql = "SELECT `ct4_Id_productos`,`ct4_Nombre`,`ct4_Descripcion` FROM `ct4_productos` INNER JOIN `ct65_precio_base` ON `ct4_productos`.`ct4_Id_productos` = `ct65_precio_base`.`id_producto`;";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    if ($id == $fila['ct4_Id_productos']) {
                        $selection = " selected='true' ";
                    } else {
                        $selection = "";
                    }
                    $option .= '<option value="' . $fila['ct4_Id_productos'] . '" ' . $selection . ' >' . $fila['ct4_Nombre'] . " - " . $fila['ct4_Descripcion'] . ' </option>';
                }
            } else {
                $option = "<option  selected='true' disabled='disabled'> No hay productos cargados </option>";
            }
        } else {
            $option = "<option  selected='true' disabled='disabled'> Error al cargar los datos :(</option>";
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
        //resultado
        return $option;
    }
    //Select de las bombas
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
    //Select de los servicios
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
    //Select de los pedidos
    public function select_pedidos_id($id = null)
    {
        $option = "<option  selected='true'> Seleccione el codigo del pedido </option>";

        $sql = "SELECT * FROM `ct65_pedidos` WHERE `status` = 1";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        if ($stmt->execute()) {
            while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if ($id == $fila['id']) {
                    $selection = "selected='true'";
                } else {
                    $selection = " ";
                }
                $option .= '<option value="' . $fila['id'] . '" ' . $selection . ' >' . $fila['id'] . ' - ' . $fila['nombre_cliente'] . ' - ' . $fila['nombre_obra'] . ' FV: '. $fila['fecha_vencimiento'].' </option>';
            }
        }
        return $option;
    }
    //Obtener el nombre del cliente mediante el id
    public function get_nombre_cliente($id)
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
    //Obtener el cliente mediante el id
    public function get_cliente($id)
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
    //Obtener el precio del producto mediante el id
    public function get_precio_producto($id)
    {
        $this->id = $id;
        $sql = "SELECT `precio` FROM `ct65_precio_base` WHERE `id_producto` = :id AND `status` = 1";
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
    //Obtener el nombre de la obra mediante el id
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
    //Obtener el nombre de la asesora mediante el id
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
    //Obtener el nombre del producto mediante el id
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
    //Obtener el id del producto mediante el codigo del producto.
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
    //Obtener el nombre del producto por el codigo.
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
    //Obtener el codigo del producto mediante el id.
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
    //Obtener el id del precio base mediante id del producto.
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
    //Obtener el precio base del producto mediante el id del producto.
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
    //Obtener el nombre de la bomba mediante el id.
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
    //Obtener el nombre del servicio mediante el id.
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
    //Crear el pedido
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

        $sql = "INSERT INTO `ct65_pedidos`(`fecha_vencimiento`, `status`, `id_cliente`, `nombre_cliente`, `id_obra`, `nombre_obra`, `id_comercial`, `nombre_asesora`) VALUES  (:fecha_vencimiento, :status, :id_cliente, :nombre_cliente, :id_obra, :nombre_obra, :id_comercial, :nombre_asesora)";

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
    //Registrar el producto a un pedido.
    public function crear_precio_producto($id_pedido, $id_producto, $cod_producto, $nombre_producto, $porcentaje, $id_precio_base, $precio_base, $precio_m3, $cantidad_m3, $saldo_m3, $precio_total_pedido, $observaciones)
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
        $this->saldo_m3 = $saldo_m3;
        $this->precio_total_pedido = $precio_total_pedido;
        $this->observaciones = $observaciones;

        $sql = "INSERT INTO `ct65_pedidos_has_precio_productos`(`id_pedido`, `status`, `id_producto`, `codigo_producto`, `nombre_producto`, `porcentaje_descuento`, `id_precio_base`, `precio_base`, `precio_m3`, `cantidad_m3`, `saldo_m3`, `precio_total_pedido`, `observaciones`) VALUES  (:id_pedido, :status, :id_producto, :codigo_producto, :nombre_producto, :porcentaje_descuento, :id_precio_base, :precio_base, :precio_m3, :cantidad_m3, :saldo_m3, :precio_total_pedido, :observaciones)";

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
        $stmt->bindParam(':saldo_m3', $this->saldo_m3, PDO::PARAM_STR);
        $stmt->bindParam(':precio_total_pedido', $this->precio_total_pedido, PDO::PARAM_STR);
        $stmt->bindParam(':observaciones', $this->observaciones, PDO::PARAM_STR);


        $result = $stmt->execute();
        //Cerrar Conexion
        $this->PDO->closePDO();

        return $result;
    }
    //Registrar la bomba a un pedido.
    public function crear_precio_bomba($id_pedido, $id_tipo_bomba, $nombre_tipo_bomba, $min_m3, $max_m3, $precio, $observaciones)
    {
        $this->status = 1;
        $this->id_pedido = $id_pedido;
        $this->id_tipo_bomba = $id_tipo_bomba;
        $this->nombre_tipo_bomba = $nombre_tipo_bomba;
        $this->min_m3 = $min_m3;
        $this->max_m3 = $max_m3;
        $this->precio = $precio;
        $this->observaciones = $observaciones;

        $sql = "INSERT INTO `ct65_pedido_has_precio_bomba`(`id_pedido`, `status`, `id_tipo_bomba`, `nombre_tipo_bomba`, `min_m3`, `max_m3`, `precio`, `observaciones`) VALUES (:id_pedido, :status, :id_tipo_bomba, :nombre_tipo_bomba, :min_m3, :max_m3, :precio, :observaciones)";

        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_pedido', $this->id_pedido, PDO::PARAM_STR);
        $stmt->bindParam(':status', $this->status, PDO::PARAM_STR);
        $stmt->bindParam(':id_tipo_bomba', $this->id_tipo_bomba, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_tipo_bomba', $this->nombre_tipo_bomba, PDO::PARAM_STR);
        $stmt->bindParam(':min_m3', $this->min_m3, PDO::PARAM_STR);
        $stmt->bindParam(':max_m3', $this->max_m3, PDO::PARAM_STR);
        $stmt->bindParam(':precio', $this->precio, PDO::PARAM_STR);
        $stmt->bindParam(':observaciones', $this->observaciones, PDO::PARAM_STR);

        $result = $stmt->execute();
        //Cerrar Conexion
        $this->PDO->closePDO();

        return $result;
    }
    //Registrar el servicio a un pedido.
    public function crear_precio_servicio($id_pedido, $id_tipo_servicio, $nombre_tipo_servicio, $precio, $observaciones)
    {
        $this->status = 1;
        $this->id_pedido = $id_pedido;
        $this->id_tipo_servicio = $id_tipo_servicio;
        $this->nombre_tipo_servicio = $nombre_tipo_servicio;
        $this->precio = $precio;
        $this->observaciones = $observaciones;


        $sql = "INSERT INTO `ct65_pedido_has_precio_servicio`(`id_pedido`, `status`, `id_tipo_servicio`, `nombre_tipo_servicio`, `precio`, `observaciones`) VALUES  (:id_pedido, :status, :id_tipo_servicio, :nombre_tipo_servicio, :precio, :observaciones)";

        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_pedido', $this->id_pedido, PDO::PARAM_STR);
        $stmt->bindParam(':status', $this->status, PDO::PARAM_STR);
        $stmt->bindParam(':id_tipo_servicio', $this->id_tipo_servicio, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_tipo_servicio', $this->nombre_tipo_servicio, PDO::PARAM_STR);
        $stmt->bindParam(':precio', $this->precio, PDO::PARAM_INT);
        $stmt->bindParam(':observaciones', $this->observaciones, PDO::PARAM_STR);

        $result = $stmt->execute();
        //Cerrar Conexion
        $this->PDO->closePDO();

        return $result;
    }
    //Listar todos los pedidos.
    public function get_pedidos()
    {
        $sql = "SELECT `id`, `status`, `fecha_vencimiento`,`nombre_cliente`,`nombre_obra`,`nombre_asesora` FROM `ct65_pedidos`";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Ejecutar 
        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id'] = $fila['id'];
                    switch ($fila['status']) {
                        case 1:
                            $datos['status'] = " <span class='badge  badge-success > float-right'> Activo </span> ";
                            break;
                        case 2:
                            $datos['status'] = " <span class='badge  badge-warning > float-right'> Deshabilitado </span> ";
                            break;
                        default:
                            $datos['status'] = " <span class='badge  badge-info > float-right'>  </span> ";
                            break;
                    }
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
    //Obtener los precios de los productos mediante el id del pedido.
    public function get_productos_precio($id_pedido)
    {
        $sql = "SELECT `id`, `status`, `codigo_producto`, `porcentaje_descuento`, `cantidad_m3`, `precio_m3`, `observaciones` FROM `ct65_pedidos_has_precio_productos` WHERE `id_pedido` =  :id_pedido AND `status` = 1";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_pedido', $id_pedido, PDO::PARAM_INT);
        // Ejecutar 
        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id'] = $fila['id'];
                    switch ($fila['status']) {
                        case 1:
                            $datos['status'] = " <span class='badge  badge-success > float-right'> Activo </span> ";
                            break;
                        case 2:
                            $datos['status'] = " <span class='badge  badge-warning > float-right'> Deshabilitado </span> ";
                            break;
                        default:
                            $datos['status'] = " <span class='badge  badge-info > float-right'>  </span> ";
                            break;
                    }
                    $datos['codigo_producto'] = $fila['codigo_producto'];
                    if (is_null($fila['porcentaje_descuento'])) {
                        $numero = 0;
                        $datos['porcentaje_descuento'] = number_format($numero, 2);
                    } else {
                        $datos['porcentaje_descuento'] = number_format($fila['porcentaje_descuento'], 2);
                    }
                    $datos['cantidad_m3'] = number_format($fila['cantidad_m3'], 2);
                    $datos['precio_m3'] = " $ " . number_format($fila['precio_m3'], 2);
                    $datos['observaciones'] = $fila['observaciones'];
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
    //Obtener los precios de la bomba mediante el id del pedido.
    public function get_bomba_precio($id_pedido)
    {
        $sql = "SELECT `id`,`status`,`nombre_tipo_bomba`,`min_m3`,`max_m3`,`precio`, `observaciones` FROM `ct65_pedido_has_precio_bomba` WHERE `id_pedido` =  :id_pedido AND `status` = 1";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_pedido', $id_pedido, PDO::PARAM_INT);

        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id'] = $fila['id'];
                    switch ($fila['status']) {
                        case 1:
                            $datos['status'] = " <span class='badge  badge-success > float-right'> Activo </span> ";
                            break;
                        case 2:
                            $datos['status'] = " <span class='badge  badge-warning > float-right'> Deshabilitado </span> ";
                            break;
                        default:
                            $datos['status'] = " <span class='badge  badge-info > float-right'>  </span> ";
                            break;
                    }

                    $datos['nombre_tipo_bomba'] = $fila['nombre_tipo_bomba'];
                    $datos['min_m3'] = number_format($fila['min_m3'], 2);
                    $datos['max_m3'] = number_format($fila['max_m3'], 2);
                    $datos['precio'] = " $ " . number_format($fila['precio'], 2);
                    $datos['observaciones'] = $fila['observaciones'];
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
    //Obtener el precio de la bomba mediante el id del pedido y el id del tipo de bomba
    public function bomba_precio($id_pedido, $id_tipo_bomba)
    {
        $sql = "SELECT `id_tipo_bomba`, `min_m3`,`max_m3` FROM `ct65_pedido_has_precio_bomba` WHERE `id_pedido` =  :id_pedido AND `id_tipo_bomba` = :id_tipo_bomba AND `status` = 1";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_pedido', $id_pedido, PDO::PARAM_INT);
        $stmt->bindParam(':id_tipo_bomba', $id_tipo_bomba, PDO::PARAM_INT);

        // Ejecutar
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['min_m3'] = number_format($fila['min_m3'], 2);
                    $datos['max_m3'] = number_format($fila['max_m3'], 2);
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
    //Obtener el precio del servicio mediante el id del pedido.
    public function get_servicios_precio($id_pedido)
    {
        $sql = "SELECT `id`,`status`, `nombre_tipo_servicio`, `precio`, `observaciones` FROM `ct65_pedido_has_precio_servicio` WHERE `id_pedido` =  :id_pedido AND `status` = 1";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_pedido', $id_pedido, PDO::PARAM_INT);

        // Ejecutar 
        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id'] = $fila['id'];
                    switch ($fila['status']) {
                        case 1:
                            $datos['status'] = " <span class='badge  badge-success > float-right'> Activo </span> ";
                            break;
                        case 2:
                            $datos['status'] = " <span class='badge  badge-warning > float-right'> Deshabilitado </span> ";
                            break;
                        default:
                            $datos['status'] = " <span class='badge  badge-info > float-right'>  </span> ";
                            break;
                    }
                    $datos['nombre_tipo_servicio'] = $fila['nombre_tipo_servicio'];
                    $datos['precio'] = " $ " . number_format($fila['precio'], 2);
                    $datos['observaciones'] = $fila['observaciones'];
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
    //Validar la existencia de algun pédido mediante el cliente y la obra.
    public function validar_existencias_pedido($cliente, $obra)
    {
        $sql = "SELECT id FROM ct65_pedidos WHERE status = 1 AND `id_cliente` = :cliente AND `id_obra` = :obra";
        $stmt = $this->con->prepare($sql); // Preparar la conexion
        $stmt->bindParam(':cliente', $cliente, PDO::PARAM_STR);
        $stmt->bindParam(':obra', $obra, PDO::PARAM_STR);

        // Ejecutar 
        if ($stmt->execute()) {
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
    //Validar la existencia de algun pédido mediante el codigo.
    public function validar_existencias_pedido_id($codigo)
    {
        $sql = "SELECT id FROM ct65_pedidos WHERE status = 1 AND id = :id";
        $stmt = $this->con->prepare($sql); // Preparar la conexion
        $stmt->bindParam(':id', $codigo, PDO::PARAM_STR);

        // Ejecutar 
        if ($stmt->execute()) {
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
    //Validar la existencia de algun producto mediante el id del producto.
    public function validar_existencias_productos($id_producto)
    {
        $sql = "SELECT id FROM concr_bdportalconcretol.ct65_precio_base WHERE status = 1 AND id_producto = :id_producto";
        $stmt = $this->con->prepare($sql); // Preparar la conexion
        $stmt->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
        // Ejecutar
        if ($stmt->execute()) {
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
    //Validar la existencia de algun producto mediante el cliente y la obra.
    public function validar_existencias_producto_principal($codigo)
    {
        $sql = "SELECT `ct4_CodigoSyscafe` FROM `ct4_productos` WHERE `ct4_CodigoSyscafe` = :codigo";
        $stmt = $this->con->prepare($sql); // Preparar la conexion
        $stmt->bindParam(':codigo', $codigo, PDO::PARAM_STR);
        // Ejecutar
        if ($stmt->execute()) {
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
    //Validar la existencia de algun producto mediante el id del producto y el id del pedido.
    public function validar_existencias_precio_producto($id_producto, $id_pedido)
    {
        $sql = "SELECT id FROM ct65_pedidos_has_precio_productos WHERE status = 1 AND id_producto = :id_producto AND `id_pedido` = :id_pedido";
        $stmt = $this->con->prepare($sql); // Preparar la conexion
        $stmt->bindParam(':id_producto', $id_producto, PDO::PARAM_STR);
        $stmt->bindParam(':id_pedido', $id_pedido, PDO::PARAM_STR);
        // Ejecutar 
        if ($stmt->execute()) {
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
    //Validar la existencia de algun precio del producto mediante el codigo.
    public function validar_producto($codigo)
    {
        $sql = "SELECT `id` FROM `ct65_precio_base` WHERE `codigo_producto` = :codigo_producto";
        $stmt = $this->con->prepare($sql); // Preparar la conexion
        $stmt->bindParam(':codigo_producto', $codigo, PDO::PARAM_STR);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    //Validar la existencia de algun precio del producto mediante el codigo.
    public function validar_producto_por_id($id)
    {
        $sql = "SELECT `id` FROM `ct65_precio_base` WHERE `id_producto` = :id";
        $stmt = $this->con->prepare($sql); // Preparar la conexion
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    //Validar la existencia de alguna bomba mediante la cantidad maxima, cantidad minima y el id del pedido.
    public function validar_bomba($cant_min, $cant_max, $id_pedido)
    {
        $sql = "SELECT id FROM ct65_pedido_has_precio_bomba WHERE status = 1 AND `min_m3` = :min_m3 AND `max_m3` = :max_m3 AND `id_pedido` = :id_pedido";
        $stmt = $this->con->prepare($sql); // Preparar la conexion
        $stmt->bindParam(':min_m3', $cant_min, PDO::PARAM_STR);
        $stmt->bindParam(':max_m3', $cant_max, PDO::PARAM_STR);
        $stmt->bindParam(':id_pedido', $id_pedido, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
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
    //Validar la existencia de algun servicio del producto mediante el id del tipo de servicio y el id del pedido.
    public function validar_existencias_precio_servicio($id_tipo_servicio, $id_pedido)
    {
        $sql = "SELECT id FROM ct65_pedido_has_precio_servicio WHERE 'status' = 1 AND id_tipo_servicio = :id_tipo_servicio AND `id_pedido` = :id_pedido";
        $stmt = $this->con->prepare($sql); // Preparar la conexion
        $stmt->bindParam(':id_tipo_servicio', $id_tipo_servicio, PDO::PARAM_STR);
        $stmt->bindParam(':id_pedido', $id_pedido, PDO::PARAM_STR);
        // Ejecutar 
        if ($stmt->execute()) {
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
    //Crear el precio del producto.
    function insert_precio_productos($fecha_subida, $id_producto, $codigo_producto, $nombre_producto, $precio)
    {
        $status = 1;
        $sql =  "INSERT INTO `ct65_precio_base` (`status`, `fecha_subida`, `id_producto`, `codigo_producto`, `nombre_producto`, `precio`) VALUES (:status, :fecha_subida, :id_producto, :codigo_producto, :nombre_producto, :precio)";
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
    //Registrar el producto al pedido.
    function insert_precio_base_productos($id_pedido, $id_producto, $codigo_producto, $nombre_producto, $precio, $cantidad, $saldo)
    {
        $status = 1;
        $sql =  "INSERT INTO `ct65_pedidos_has_precio_productos`(`id_pedido`, `status`, `id_producto`, `codigo_producto`, `nombre_producto`, `precio_m3`, `cantidad_m3`, `saldo_m3`) VALUES (:id_pedido, :status, :id_producto, :codigo_producto, :nombre_producto, :precio_m3, :cantidad_m3, :saldo)";
        $stmt = $this->con->prepare($sql); // Preparar la conexion
        $stmt->bindParam(':id_pedido', $id_pedido, PDO::PARAM_STR);
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        $stmt->bindParam(':id_producto', $id_producto, PDO::PARAM_STR);
        $stmt->bindParam(':codigo_producto', $codigo_producto, PDO::PARAM_STR);
        $stmt->bindParam(':nombre_producto', $nombre_producto, PDO::PARAM_STR);
        $stmt->bindParam(':precio_m3', $precio, PDO::PARAM_STR);
        $stmt->bindParam(':cantidad_m3', $cantidad, PDO::PARAM_STR);
        $stmt->bindParam(':saldo', $saldo, PDO::PARAM_STR);

        if ($stmt->execute()) { // Ejecutar
            $php_result = true;
        } else {
            $php_result = true;
        }
        return $php_result;
    }
    //Cambiar el status del precio base del producto.
    function editar_status_precio_base_productos()
    {
        $this->status = 2;
        $sql = "UPDATE `ct65_pedidos_has_precio_productos` SET `status`= :status";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':status', $this->status, PDO::PARAM_INT);
        // Ejecutar 
        $result = $stmt->execute();
        //Cerrar Conexion
        $this->PDO->closePDO();
        //resultado
        return $result;
    }
    //Cambiar el status del pedido.
    function cambiar_status_pedido($fecha)
    {
        $this->fecha = $fecha;
        $this->status = 2;
        $sql = "UPDATE `ct65_pedidos` SET `status`= :status WHERE  `fecha_vencimiento` < :fecha";

        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':status', $this->status, PDO::PARAM_INT);
        $stmt->bindParam(':fecha', $this->fecha, PDO::PARAM_STR);

        // Ejecutar 
        $result = $stmt->execute();

        //Cerrar Conexion
        $this->PDO->closePDO();

        //Resultado
        return $result;
    }
    //Cambiar el status del pedido.
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
    //Cambiar el status del producto.
    function cambiar_status_producto($id)
    {
        $this->id = $id;
        $this->status = 2;
        $sql = "UPDATE `ct65_pedidos_has_precio_productos` SET `status`= :status WHERE `id` = :id";

        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        $stmt->bindParam(':status', $this->status, PDO::PARAM_INT);

        // Ejecutar 
        $result = $stmt->execute();

        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        return $result;
    }
    //Cambiar el status de la bomba.
    function cambiar_status_bomba($id)
    {
        $this->id = $id;
        $this->status = 2;
        $sql = "UPDATE `ct65_pedido_has_precio_bomba` SET `status`= :status  WHERE `id` = :id";

        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        $stmt->bindParam(':status', $this->status, PDO::PARAM_INT);

        // Ejecutar 
        $result = $stmt->execute();

        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        return $result;
    }
    //Cambiar el status del servicio.
    function cambiar_status_servicio($id)
    {
        $this->id = $id;
        $this->status = 2;
        $sql = "UPDATE `ct65_pedido_has_precio_servicio` SET `status`= :status WHERE `id` = :id";

        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        $stmt->bindParam(':status', $this->status, PDO::PARAM_INT);

        // Ejecutar 
        $result = $stmt->execute();

        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        return $result;
    }
    //  EXCEL INICIO
    //  Excel Pedidos codigo
    public function excel_pedidos_codigo($codigo)
    {
        $sql = "SELECT `id`, `fecha_creacion`, `fecha_vencimiento`, `nombre_cliente`, `nombre_obra`, `nombre_asesora` FROM `ct65_pedidos` WHERE `id` = :codigo AND ct65_pedidos.status = 1";

        // Preparar la conexion del sentencia SQL
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':codigo', $codigo, PDO::PARAM_INT);
        // Ejecuta SQL
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount(); // Cuenta los numero de registros de sql
            // Valida si hay registros
            if ($num_reg > 0) {
                // Recorrer limpieza de datos obtenidos en la consulta
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $data_array['id'] = $fila['id'];
                    $data_array['fecha_creacion'] = $fila['fecha_creacion'];
                    $data_array['fecha_vencimiento'] = $fila['fecha_vencimiento'];
                    $data_array['nombre_cliente'] = $fila['nombre_cliente'];
                    $data_array['nombre_obra'] = $fila['nombre_obra'];
                    $data_array['nombre_asesora'] = $fila['nombre_asesora'];
                    $datosf[] = $data_array;
                }
                return $datosf; // Retorna el resultado
            } else {
                return false; // El resultado de la sentencia SQL es igual a 0
            }
        } else {
            return false; // Error en la sentencia sql
        }
    }
    //  Excel Productos codigo
    public function excel_productos_codigo($codigo)
    {
        $sql = "SELECT `id_pedido`, ct65_pedidos.fecha_vencimiento, ct65_pedidos.nombre_cliente, ct65_pedidos.nombre_obra, `codigo_producto`, `nombre_producto`, `precio_m3`, `cantidad_m3`, `nombre_asesora` FROM `ct65_pedidos_has_precio_productos` INNER JOIN ct65_pedidos ON ct65_pedidos_has_precio_productos.id_pedido = ct65_pedidos.id WHERE `id_pedido` = :codigo AND ct65_pedidos_has_precio_productos.status = 1 AND ct65_pedidos.status = 1";

        // Preparar la conexion del sentencia SQL
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':codigo', $codigo, PDO::PARAM_INT);
        //$stmt->bindParam(':var', $var, PDO::PARAM_STR);
        // Ejecuta SQL
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount(); // Cuenta los numero de registros de sql
            // Valida si hay registros
            if ($num_reg > 0) {
                // Recorrer limpieza de datos obtenidos en la consulta
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $data_array['id_pedido'] = $fila['id_pedido'];
                    $data_array['nombre_cliente'] = $fila['nombre_cliente'];
                    $data_array['nombre_obra'] = $fila['nombre_obra'];
                    $data_array['codigo_producto'] = $fila['codigo_producto'];
                    $data_array['nombre_producto'] = $fila['nombre_producto'];
                    $data_array['precio_m3'] = $fila['precio_m3'];
                    $data_array['cantidad_m3'] = $fila['cantidad_m3'];
                    $data_array['nombre_asesora'] = $fila['nombre_asesora'];
                    $datosf[] = $data_array;
                }
                return $datosf; // Retorna el resultado
            } else {
                return false; // El resultado de la sentencia SQL es igual a 0
            }
        } else {
            return false; // Error en la sentencia sql
        }
    }
    //  Excel Bombas codigo
    public function excel_bomba_codigo($codigo)
    {
        $sql = "SELECT `id_pedido`, ct65_pedidos.nombre_cliente, ct65_pedidos.nombre_obra, `nombre_tipo_bomba`, `min_m3`,`max_m3`,`precio` FROM `ct65_pedido_has_precio_bomba` INNER JOIN ct65_pedidos ON ct65_pedido_has_precio_bomba.id_pedido = ct65_pedidos.id WHERE `id_pedido` = :codigo AND ct65_pedido_has_precio_bomba.status = 1 AND ct65_pedidos.status = 1";

        // Preparar la conexion del sentencia SQL
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':codigo', $codigo, PDO::PARAM_INT);

        //$stmt->bindParam(':var', $var, PDO::PARAM_STR);
        // Ejecuta SQL
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount(); // Cuenta los numero de registros de sql
            // Valida si hay registros
            if ($num_reg > 0) {
                // Recorrer limpieza de datos obtenidos en la consulta
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $data_array['id_pedido'] = $fila['id_pedido'];
                    $data_array['nombre_cliente'] = $fila['nombre_cliente'];
                    $data_array['nombre_obra'] = $fila['nombre_obra'];
                    $data_array['nombre_tipo_bomba'] = $fila['nombre_tipo_bomba'];
                    $data_array['min_m3'] = $fila['min_m3'];
                    $data_array['max_m3'] = $fila['max_m3'];
                    $data_array['precio'] = $fila['precio'];
                    $datosf[] = $data_array;
                }
                return $datosf; // Retorna el resultado
            } else {
                return false; // El resultado de la sentencia SQL es igual a 0
            }
        } else {
            return false; // Error en la sentencia sql
        }
    }
    //  Excel Servicios codigo
    public function excel_servicio_codigo($codigo)
    {
        $sql = "SELECT `id_pedido`, ct65_pedidos.nombre_cliente, ct65_pedidos.nombre_obra, `nombre_tipo_servicio`,`precio` FROM `ct65_pedido_has_precio_servicio` INNER JOIN ct65_pedidos ON ct65_pedido_has_precio_servicio.id_pedido = ct65_pedidos.id WHERE `id_pedido` = :codigo AND ct65_pedido_has_precio_servicio.status = 1 AND ct65_pedidos.status = 1";

        // Preparar la conexion del sentencia SQL.
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':codigo', $codigo, PDO::PARAM_INT);

        //$stmt->bindParam(':var', $var, PDO::PARAM_STR);
        // Ejecuta SQL
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount(); // Cuenta los numero de registros de sql
            // Valida si hay registros
            if ($num_reg > 0) {
                // Recorrer limpieza de datos obtenidos en la consulta
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $data_array['id_pedido'] = $fila['id_pedido'];
                    $data_array['nombre_cliente'] = $fila['nombre_cliente'];
                    $data_array['nombre_obra'] = $fila['nombre_obra'];
                    $data_array['nombre_tipo_servicio'] = $fila['nombre_tipo_servicio'];
                    $data_array['precio'] = $fila['precio'];
                    $datosf[] = $data_array;
                }
                return $datosf; // Retorna el resultado.
            } else {
                return false; // El resultado de la sentencia SQL es igual a 0.
            }
        } else {
            return false; // Error en la sentencia sql.
        }
    }
    //  Excel Pedidos cliente obra
    public function excel_pedidos_cliente_obra($cliente, $obra)
    {
        $this->cliente = $cliente;
        $this->obra = $obra;

        $sql = "SELECT `id`, `fecha_creacion`, `fecha_vencimiento`,`nombre_cliente`,`nombre_obra`,`nombre_asesora` FROM `ct65_pedidos` WHERE `nombre_cliente` = :cliente AND `nombre_obra` = :obra AND ct65_pedidos.status = 1";

        // Preparar la conexion del sentencia SQL
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':cliente', $this->cliente, PDO::PARAM_STR);
        $stmt->bindParam(':obra', $this->obra, PDO::PARAM_STR);

        //$stmt->bindParam(':var', $var, PDO::PARAM_STR);
        // Ejecuta SQL
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount(); // Cuenta los numero de registros de sql
            // Valida si hay registros
            if ($num_reg > 0) {
                // Recorrer limpieza de datos obtenidos en la consulta
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $data_array['id'] = $fila['id'];
                    $data_array['fecha_creacion'] = $fila['fecha_creacion'];
                    $data_array['fecha_vencimiento'] = $fila['fecha_vencimiento'];
                    $data_array['nombre_cliente'] = $fila['nombre_cliente'];
                    $data_array['nombre_obra'] = $fila['nombre_obra'];
                    $data_array['nombre_asesora'] = $fila['nombre_asesora'];
                    $datosf[] = $data_array;
                }
                return $datosf; // Retorna el resultado
            } else {
                return false; // El resultado de la sentencia SQL es igual a 0
            }
        } else {
            return false; // Error en la sentencia sql
        }
    }
    //  Excel Productos cliente obra
    public function excel_productos_cliente_obra($cliente, $obra)
    {
        $this->cliente = $cliente;
        $this->obra = $obra;

        $sql = "SELECT ct65_pedidos.fecha_vencimiento, ct65_pedidos.nombre_cliente, ct65_pedidos.nombre_obra,`codigo_producto`, `nombre_producto`, `precio_m3`, `cantidad_m3`, `nombre_asesora` FROM `ct65_pedidos_has_precio_productos` INNER JOIN ct65_pedidos ON ct65_pedidos_has_precio_productos.id_pedido = ct65_pedidos.id WHERE ct65_pedidos.nombre_cliente = :cliente AND ct65_pedidos.nombre_obra = :obra AND ct65_pedidos_has_precio_productos.status = 1 AND ct65_pedidos.status = 1";

        // Preparar la conexion del sentencia SQL
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':cliente', $this->cliente, PDO::PARAM_STR);
        $stmt->bindParam(':obra', $this->obra, PDO::PARAM_STR);

        //$stmt->bindParam(':var', $var, PDO::PARAM_STR);
        // Ejecuta SQL
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount(); // Cuenta los numero de registros de sql
            // Valida si hay registros
            if ($num_reg > 0) {
                // Recorrer limpieza de datos obtenidos en la consulta
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $data_array['nombre_cliente'] = $fila['nombre_cliente'];
                    $data_array['nombre_obra'] = $fila['nombre_obra'];
                    $data_array['codigo_producto'] = $fila['codigo_producto'];
                    $data_array['nombre_producto'] = $fila['nombre_producto'];
                    $data_array['precio_m3'] = $fila['precio_m3'];
                    $data_array['cantidad_m3'] = $fila['cantidad_m3'];
                    $data_array['nombre_asesora'] = $fila['nombre_asesora'];
                    $datosf[] = $data_array;
                }
                return $datosf; // Retorna el resultado
            } else {
                return false; // El resultado de la sentencia SQL es igual a 0
            }
        } else {
            return false; // Error en la sentencia sql
        }
    }
    //  Excel Bombas cliente y obra
    public function excel_bomba_cliente_obra($cliente, $obra)
    {
        $this->cliente = $cliente;
        $this->obra = $obra;

        $sql = "SELECT ct65_pedidos.nombre_cliente, ct65_pedidos.nombre_obra, `nombre_tipo_bomba`, `min_m3`,`max_m3`,`precio` FROM `ct65_pedido_has_precio_bomba` INNER JOIN ct65_pedidos ON ct65_pedido_has_precio_bomba.id_pedido = ct65_pedidos.id WHERE ct65_pedidos.nombre_cliente = :cliente AND ct65_pedidos.nombre_obra = :obra AND ct65_pedido_has_precio_bomba.status = 1 AND ct65_pedidos.status = 1";

        // Preparar la conexion del sentencia SQL
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':cliente', $this->cliente, PDO::PARAM_STR);
        $stmt->bindParam(':obra', $this->obra, PDO::PARAM_STR);

        //$stmt->bindParam(':var', $var, PDO::PARAM_STR);
        // Ejecuta SQL
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount(); // Cuenta los numero de registros de sql
            // Valida si hay registros
            if ($num_reg > 0) {
                // Recorrer limpieza de datos obtenidos en la consulta
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $data_array['nombre_cliente'] = $fila['nombre_cliente'];
                    $data_array['nombre_obra'] = $fila['nombre_obra'];
                    $data_array['nombre_tipo_bomba'] = $fila['nombre_tipo_bomba'];
                    $data_array['min_m3'] = $fila['min_m3'];
                    $data_array['max_m3'] = $fila['max_m3'];
                    $data_array['precio'] = $fila['precio'];
                    $datosf[] = $data_array;
                }
                return $datosf; // Retorna el resultado
            } else {
                return false; // El resultado de la sentencia SQL es igual a 0
            }
        } else {
            return false; // Error en la sentencia sql
        }
    }
    //  Excel Servicios cliente y obra
    public function excel_servicio_cliente_obra($cliente, $obra)
    {
        $this->cliente = $cliente;
        $this->obra = $obra;

        $sql = "SELECT ct65_pedidos.nombre_cliente, ct65_pedidos.nombre_obra, `nombre_tipo_servicio`,`precio` FROM `ct65_pedido_has_precio_servicio` INNER JOIN ct65_pedidos ON ct65_pedido_has_precio_servicio.id_pedido = ct65_pedidos.id WHERE ct65_pedidos.nombre_cliente = :cliente AND ct65_pedidos.nombre_obra = :obra AND ct65_pedido_has_precio_servicio.status = 1 AND ct65_pedidos.status = 1";

        // Preparar la conexion del sentencia SQL
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':cliente', $this->cliente, PDO::PARAM_STR);
        $stmt->bindParam(':obra', $this->obra, PDO::PARAM_STR);

        //$stmt->bindParam(':var', $var, PDO::PARAM_STR);
        // Ejecuta SQL
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount(); // Cuenta los numero de registros de sql
            // Valida si hay registros
            if ($num_reg > 0) {
                // Recorrer limpieza de datos obtenidos en la consulta
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $data_array['nombre_cliente'] = $fila['nombre_cliente'];
                    $data_array['nombre_obra'] = $fila['nombre_obra'];
                    $data_array['nombre_tipo_servicio'] = $fila['nombre_tipo_servicio'];
                    $data_array['precio'] = $fila['precio'];
                    $datosf[] = $data_array;
                }
                return $datosf; // Retorna el resultado
            } else {
                return false; // El resultado de la sentencia SQL es igual a 0
            }
        } else {
            return false; // Error en la sentencia sql
        }
    }
    //  Excel Pedidos fecha
    public function excel_pedidos_fecha($fecha_ini, $fecha_fin)
    {
        $this->fecha_ini = $fecha_ini;
        $this->fecha_fin = $fecha_fin;

        $sql = "SELECT `id`, `fecha_creacion`, `fecha_vencimiento`,`nombre_cliente`,`nombre_obra`,`nombre_asesora` FROM `ct65_pedidos` WHERE `fecha_creacion` BETWEEN :fecha_ini AND :fecha_fin AND ct65_pedidos.status = 1";

        // Preparar la conexion del sentencia SQL
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':fecha_ini', $this->fecha_ini, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_fin', $this->fecha_fin, PDO::PARAM_STR);

        //$stmt->bindParam(':var', $var, PDO::PARAM_STR);
        // Ejecuta SQL
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount(); // Cuenta los numero de registros de sql
            // Valida si hay registros
            if ($num_reg > 0) {
                // Recorrer limpieza de datos obtenidos en la consulta
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $data_array['id'] = $fila['id'];
                    $data_array['fecha_creacion'] = $fila['fecha_creacion'];
                    $data_array['fecha_vencimiento'] = $fila['fecha_vencimiento'];
                    $data_array['nombre_cliente'] = $fila['nombre_cliente'];
                    $data_array['nombre_obra'] = $fila['nombre_obra'];
                    $data_array['nombre_asesora'] = $fila['nombre_asesora'];
                    $datosf[] = $data_array;
                }
                return $datosf; // Retorna el resultado
            } else {
                return false; // El resultado de la sentencia SQL es igual a 0
            }
        } else {
            return false; // Error en la sentencia sql
        }
    }
    //  Excel Productos fecha
    public function excel_productos_fecha($fecha_ini, $fecha_fin)
    {
        $this->fecha_ini = $fecha_ini;
        $this->fecha_fin = $fecha_fin;

        $sql = "SELECT ct65_pedidos.fecha_vencimiento, ct65_pedidos.nombre_cliente, ct65_pedidos.nombre_obra,`codigo_producto`, `nombre_producto`, `precio_m3`, `cantidad_m3`, `nombre_asesora` FROM `ct65_pedidos_has_precio_productos` INNER JOIN ct65_pedidos ON ct65_pedidos_has_precio_productos.id_pedido = ct65_pedidos.id WHERE ct65_pedidos.fecha_creacion BETWEEN :fecha_ini AND :fecha_fin AND ct65_pedidos_has_precio_productos.status = 1 AND ct65_pedidos.status = 1";

        // Preparar la conexion del sentencia SQL
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':fecha_ini', $this->fecha_ini, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_fin', $this->fecha_fin, PDO::PARAM_STR);

        //$stmt->bindParam(':var', $var, PDO::PARAM_STR);
        // Ejecuta SQL
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount(); // Cuenta los numero de registros de sql
            // Valida si hay registros
            if ($num_reg > 0) {
                // Recorrer limpieza de datos obtenidos en la consulta
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $data_array['nombre_cliente'] = $fila['nombre_cliente'];
                    $data_array['nombre_obra'] = $fila['nombre_obra'];
                    $data_array['codigo_producto'] = $fila['codigo_producto'];
                    $data_array['nombre_producto'] = $fila['nombre_producto'];
                    $data_array['precio_m3'] = $fila['precio_m3'];
                    $data_array['cantidad_m3'] = $fila['cantidad_m3'];
                    $data_array['nombre_asesora'] = $fila['nombre_asesora'];
                    $datosf[] = $data_array;
                }
                return $datosf; // Retorna el resultado
            } else {
                return false; // El resultado de la sentencia SQL es igual a 0
            }
        } else {
            return false; // Error en la sentencia sql
        }
    }
    //  Excel Bombas fecha
    public function excel_bomba_fecha($fecha_ini, $fecha_fin)
    {
        $this->fecha_ini = $fecha_ini;
        $this->fecha_fin = $fecha_fin;

        $sql = "SELECT ct65_pedidos.nombre_cliente, ct65_pedidos.nombre_obra, `nombre_tipo_bomba`, `min_m3`,`max_m3`,`precio` FROM `ct65_pedido_has_precio_bomba` INNER JOIN ct65_pedidos ON ct65_pedido_has_precio_bomba.id_pedido = ct65_pedidos.id WHERE `fecha_creacion` BETWEEN :fecha_ini AND :fecha_fin AND ct65_pedido_has_precio_bomba.status = 1 AND ct65_pedidos.status = 1";

        // Preparar la conexion del sentencia SQL
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':fecha_ini', $this->fecha_ini, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_fin', $this->fecha_fin, PDO::PARAM_STR);

        //$stmt->bindParam(':var', $var, PDO::PARAM_STR);
        // Ejecuta SQL
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount(); // Cuenta los numero de registros de sql
            // Valida si hay registros
            if ($num_reg > 0) {
                // Recorrer limpieza de datos obtenidos en la consulta
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $data_array['nombre_cliente'] = $fila['nombre_cliente'];
                    $data_array['nombre_obra'] = $fila['nombre_obra'];
                    $data_array['nombre_tipo_bomba'] = $fila['nombre_tipo_bomba'];
                    $data_array['min_m3'] = $fila['min_m3'];
                    $data_array['max_m3'] = $fila['max_m3'];
                    $data_array['precio'] = $fila['precio'];
                    $datosf[] = $data_array;
                }
                return $datosf; // Retorna el resultado
            } else {
                return false; // El resultado de la sentencia SQL es igual a 0
            }
        } else {
            return false; // Error en la sentencia sql
        }
    }
    //  Excel Servicios fecha
    public function excel_servicio_fecha($fecha_ini, $fecha_fin)
    {
        $this->fecha_ini = $fecha_ini;
        $this->fecha_fin = $fecha_fin;

        $sql = "SELECT ct65_pedidos.nombre_cliente, ct65_pedidos.nombre_obra, `nombre_tipo_servicio`,`precio` FROM `ct65_pedido_has_precio_servicio` INNER JOIN ct65_pedidos ON ct65_pedido_has_precio_servicio.id_pedido = ct65_pedidos.id WHERE `fecha_creacion` BETWEEN :fecha_ini AND :fecha_fin AND ct65_pedido_has_precio_servicio.status = 1 AND ct65_pedidos.status = 1";

        // Preparar la conexion del sentencia SQL
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':fecha_ini', $this->fecha_ini, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_fin', $this->fecha_fin, PDO::PARAM_STR);

        //$stmt->bindParam(':var', $var, PDO::PARAM_STR);
        // Ejecuta SQL
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount(); // Cuenta los numero de registros de sql
            // Valida si hay registros
            if ($num_reg > 0) {
                // Recorrer limpieza de datos obtenidos en la consulta
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $data_array['nombre_cliente'] = $fila['nombre_cliente'];
                    $data_array['nombre_obra'] = $fila['nombre_obra'];
                    $data_array['nombre_tipo_servicio'] = $fila['nombre_tipo_servicio'];
                    $data_array['precio'] = $fila['precio'];
                    $datosf[] = $data_array;
                }
                return $datosf; // Retorna el resultado
            } else {
                return false; // El resultado de la sentencia SQL es igual a 0
            }
        } else {
            return false; // Error en la sentencia sql
        }
    }
    //EXCEL FIN
    //Obtener el nombre del cliente y obra mediante el id del pedido.
    function get_nombre_cliente_obra($id)
    {
        $this->id = $id;

        $sql = "SELECT `id_cliente`, `nombre_cliente`, `id_obra`, `nombre_obra` FROM `ct65_pedidos` WHERE `id` = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount(); // Cuenta los numero de registros de sql
            // Valida si hay registros
            if ($num_reg > 0) {
                // Recorrer limpieza de datos obtenidos en la consulta
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $data_array['id_cliente'] = $fila['id_cliente'];
                    $data_array['nombre_cliente'] = $fila['nombre_cliente'];
                    $data_array['id_obra'] = $fila['id_obra'];
                    $data_array['nombre_obra'] = $fila['nombre_obra'];
                    $datosf[] = $data_array;
                }
                return $datosf; // Retorna el resultado
            } else {
                return false; // El resultado de la sentencia SQL es igual a 0
            }
        } else {
            return false; // Error en la sentencia sql
        }
    }
    //Funcion para sacar el descuento se requiere como parametro el precio base y el porcentaje
    public function calcularDescuento($precio_base, $porcentaje)
    {
        $resultado = ($precio_base * (1 - ($porcentaje / 100)));

        return $resultado;
    }
}
