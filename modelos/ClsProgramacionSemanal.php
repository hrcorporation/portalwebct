<?php

class ClsProgramacionSemanal extends conexionPDO
{
    protected $con;
    // CONEXION
    public function __construct()
    {
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////SELECT - CARGAR PROGRAMACIONES/////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////
    // Cargar datos de la programacion (FUNCIONARIO)
    public function fntCargarDataProgramacionFuncionarioObj($id_programacion)
    {
        $sql = "SELECT * FROM `ct66_programacion_semanal` 
        WHERE `id` = :id_programacion ";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        // Asignando Datos ARRAY => SQ
        $stmt->bindParam(':id_programacion', $id_programacion, PDO::PARAM_INT);
        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id'] = $fila['id'];
                    $datos['estado'] = $fila['status'];
                    $datos['cliente'] = $fila['id_cliente'];
                    $datos['obra'] = $fila['id_obra'];
                    $datos['id_pedido'] = $fila['id_pedido'];
                    $datos['id_tipo_descargue'] = $fila['id_tipo_descargue'];
                    $datos['producto'] = $fila['id_producto'];
                    $datos['cantidad'] = $fila['cantidad'];
                    $datos['inicio'] = $fila['fecha_ini'];
                    $datos['fin'] = $fila['fecha_fin'];
                    $datos['frecuencia'] = $fila['frecuencia'];
                    $datos['elementos'] = $fila['elementos_fundir'];
                    $datos['observaciones'] = $fila['observaciones'];
                    $datos['metros'] = $fila['metros_tuberia'];
                    $datos['requiere_bomba'] = $fila['requiere_bomba'];
                    $datos['color'] = 'orange';
                    $datos['textcolor'] = 'black';
                    $datosf[] = $datos;
                }
                return $datosf;
            }
        }
        return false;
    }
    // Cargar datos de la programacion (CLIENTE)
    public function fntCargarDataProgramacionClienteObj($id_programacion)
    {
        $sql = "SELECT * FROM `ct66_programacion_semanal` 
        WHERE `id` = :id_programacion ";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        // Asignando Datos ARRAY => SQ
        $stmt->bindParam(':id_programacion', $id_programacion, PDO::PARAM_INT);
        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id'] = $fila['id'];
                    $datos['estado'] = $fila['status'];
                    $datos['cliente'] = $fila['id_cliente'];
                    $datos['obra'] = $fila['id_obra'];
                    $datos['id_pedido'] = $fila['id_pedido'];
                    $datos['id_tipo_descargue'] = $fila['id_tipo_descargue'];
                    $datos['producto'] = $fila['id_producto'];
                    $datos['cantidad'] = $fila['cantidad'];
                    $datos['inicio'] = $fila['fecha_ini'];
                    $datos['fin'] = $fila['fecha_fin'];
                    $datos['frecuencia'] = $fila['frecuencia'];
                    $datos['elementos'] = $fila['elementos_fundir'];
                    $datos['observaciones'] = $fila['observaciones'];
                    $datos['metros'] = $fila['metros_tuberia'];
                    $datos['requiere_bomba'] = $fila['requiere_bomba'];
                    $datos['color'] = 'orange';
                    $datos['textcolor'] = 'black';
                    $datosf[] = $datos;
                }
                return $datosf;
            }
        }
        return false;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////SELECT - LISTAR DATOS REQUERIDOS PARA CREAR PROGRAMACION///////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////
    // Listado de los clientes(Terceros) para los (FUNCIONARIOS).
    public function fntOptionClienteEditFuncionarioObj($id_cliente = null)
    {
        $option = "<option  selected='true' disabled='disabled'> Seleccione un Cliente</option>";
        $sql = "SELECT ct1_IdTerceros , ct1_NumeroIdentificacion , ct1_RazonSocial 
        FROM ct1_terceros 
        WHERE ct1_TipoTercero = 1 AND ct1_Estado = 1";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        //$stmt->bindParam(':id_tercero', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        $stmt->execute();

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
    // Listado de los clientes(Terceros) para los (CLIENTE).
    public function fntOptionClienteEditClienteObj($id_usuario, $id_cliente = null)
    {
        $this->id = $id_usuario;
        $option = "<option  selected='true'> Seleccione un Cliente</option>";
        $sql = "SELECT ct1_terceros.ct1_IdTerceros, ct1_terceros.ct1_NumeroIdentificacion, ct1_terceros.ct1_RazonSocial 
        FROM ct1_gestion_acceso 
        INNER JOIN ct1_terceros ON ct1_gestion_acceso.id_cliente = ct1_terceros.ct1_IdTerceros 
        WHERE id_residente = :id_usuario";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_usuario', $this->id, PDO::PARAM_INT);
        // Asignando Datos ARRAY => SQL
        //$stmt->bindParam(':id_tercero', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        $stmt->execute();
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
    // Listado de las obras para los (FUNCIONARIOS).
    public function fntOptionObraEditFuncionarioObj($id_cliente, $id_obra = null)
    {
        $this->id = $id_cliente;
        $option = "<option  selected='true' disabled='disabled'> Seleccione una Obra</option>";
        $sql = "SELECT * FROM `ct5_obras` 
        WHERE `ct5_IdTerceros` = :id_cliente";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':id_cliente', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        $result = $stmt->execute();
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($id_obra == $fila['ct5_IdObras']) {
                $selection = "selected='true'";
            } else {
                $selection = "";
            }
            $option .= '<option value="' . $fila['ct5_IdObras'] . '" ' . $selection . ' >' . $fila['ct5_NombreObra']  . ' </option>';
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
        //resultado
        return $option;
    }
    // Listado de las obras para los (CLIENTE).
    public function fntOptionObraEditClienteObj($id_cliente, $id_usuario, $id_obra = null)
    {
        $this->id_cliente = $id_cliente;
        $this->id_usuario = $id_usuario;
        $option = "<option  selected='true' disabled='disabled'> Seleccione una Obra</option>";
        $sql = "SELECT ct5_obras.ct5_IdObras, ct5_obras.ct5_NombreObra 
        FROM ct1_gestion_acceso 
        INNER JOIN ct5_obras ON ct1_gestion_acceso.id_obra = ct5_obras.ct5_IdObras 
        WHERE ct5_obras.ct5_IdTerceros = :id_cliente AND ct1_gestion_acceso.id_residente = :id_usuario";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':id_cliente', $this->id_cliente, PDO::PARAM_INT);
        $stmt->bindParam(':id_usuario', $this->id_usuario, PDO::PARAM_INT);
        // Ejecutar 
        $result = $stmt->execute();
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($id_obra == $fila['ct5_IdObras']) {
                $selection = "selected='true'";
            } else {
                $selection = "";
            }
            $option .= '<option value="' . $fila['ct5_IdObras'] . '" ' . $selection . ' >' . $fila['ct5_NombreObra']  . ' </option>';
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
        //resultado
        return $option;
    }
    // Listado de las frecuencias.
    public function fntOptionFrecuenciaEditObj($hora = null)
    {
        $option = "<option  selected='true' disabled='disabled'> Seleccione la frecuencia </option>";
        $sql = "SELECT `id`,`hora`,`descripcion` 
        FROM `ct66_frecuencia`";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        //$stmt->bindParam(':id_tercero', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        $result = $stmt->execute();

        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($hora == $fila['hora']) {
                $selection = " selected='true' ";
            } else {
                $selection = "";
            }
            $option .= '<option value="' . $fila['hora'] . '" ' . $selection . ' >' . $fila['descripcion'] . ' </option>';
        }

        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        return $option;
    }
    // Listado de los pedidos.
    public function fntOptionListaPedidosObj($id_cliente, $id_obra, $id = null)
    {
        $option = "<option  selected='true' disabled='disabled'> Seleccione el pedido</option>";
        $sql = "SELECT `id`, `fecha_vencimiento`, `nombre_cliente`, `nombre_obra` 
        FROM `ct65_pedidos` 
        WHERE `status` = 1 AND `id_cliente` = :id_cliente AND `id_obra` = :id_obra";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
        $stmt->bindParam(':id_obra', $id_obra, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    if ($id == $fila['id']) {
                        $selection = " selected='true' ";
                    } else {
                        $selection = "";
                    }
                    $option .= '<option value="' . $fila['id'] . '" ' . $selection . ' >' . $fila['id'] . ' - ' . " PEDIDO " . "(" . $fila['fecha_vencimiento'] . ")" . ' </option>';
                }
            } else {
                $option = "<option  selected='true' disabled='disabled'> No hay pedidos asociados con el cliente </option>";
            }
        } else {
            $option = "<option  selected='true' disabled='disabled'> Error al cargar los datos :(</option>";
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
        //resultado
        return $option;
    }
    // Listado del tipo de pedidos.
    public function fntOptionListaPedidosClienteObj($id_cliente, $id_obra, $id = null)
    {
        $option = "<option  selected='true' disabled='disabled'> Seleccione el pedido</option>";
        $sql = "SELECT `id`, `fecha_vencimiento`, `nombre_cliente`, `nombre_obra` 
        FROM `ct65_pedidos` 
        WHERE `status` = 1 AND `id_cliente` = :id_cliente AND `id_obra` = :id_obra";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
        $stmt->bindParam(':id_obra', $id_obra, PDO::PARAM_INT);
        // Ejecutar
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    if ($id == $fila['id']) {
                        $selection = " selected='true' ";
                    } else {
                        $selection = "";
                    }
                    $option .= '<option value="' . $fila['id'] . '" ' . $selection . ' >' . $fila['id'] . ' - ' . " PEDIDO " . "(" . $fila['fecha_vencimiento'] . ")" . ' </option>';
                }
            } else {
                $option = "<option  selected='true' disabled='disabled'> No hay pedidos asociados con el cliente </option>";
            }
        } else {
            $option = "<option  selected='true' disabled='disabled'> Error al cargar los datos :(</option>";
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
        //resultado
        return $option;
    }
    // Listar mediante un select los productos
    public function fntOptionProductoEditObj($id_producto = null)
    {
        $this->id = $id_producto;
        $option = "<option  selected='true' disabled='disabled'> Seleccione una Producto</option>";
        $sql = "SELECT ct4_Id_productos , ct4_CodigoSyscafe , ct4_Descripcion 
          FROM `ct4_productos`";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    if ($id_producto == $fila['ct4_Id_productos']) {
                        $selection = "selected='true'";
                    } else {
                        $selection = "";
                    }
                    $option .= '<option value="' . $fila['ct4_Id_productos'] . '" ' . $selection . ' >' . $fila['ct4_CodigoSyscafe']  . ' - ' . $fila['ct4_Descripcion']  . ' </option>';
                }
            } else {
                $option = "<option  selected='true' disabled='disabled'> Error al cargar Productos H2" . $num_reg . "</option>";
            }
        } else {
            $option = "<option  selected='true' disabled='disabled'> Error al cargar Productos H1</option>";
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
        //resultado
        return $option;
    }
    // Listado de los productos para los FUNCIONARIOS.
    public function fntOptionProductoFuncionarioObj($id_pedido, $id_producto = null)
    {
        $option = "<option  selected='true' disabled='disabled'> Seleccione un Producto</option>";
        $sql = "SELECT ct65_pedidos_has_precio_productos.id, `codigo_producto`, `nombre_producto` 
        FROM `ct65_pedidos_has_precio_productos`
        INNER JOIN ct65_pedidos ON ct65_pedidos_has_precio_productos.id_pedido = ct65_pedidos.id 
        WHERE `id_pedido` = :id  AND ct65_pedidos_has_precio_productos.status = 1";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id', $id_pedido, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    if ($id_producto == $fila['id']) {
                        $selection = "selected='true'";
                    } else {
                        $selection = "";
                    }
                    $option .= '<option value="' . $fila['id'] . '" ' . $selection . ' >' . $fila['codigo_producto']  . ' - ' . $fila['nombre_producto']  . ' </option>';
                }
            } else {
                $option = "<option  selected='true' disabled='disabled'> No hay productos asociados al pedido </option>";
            }
        } else {
            $option = "<option  selected='true' disabled='disabled'> Error al cargar Productos H1</option>";
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
        //resultado
        return $option;
    }
    // Listado de los productos para los FUNCIONARIOS.
    public function fntOptionProductoClienteObj($id_pedido, $id_cliente, $id_obra, $id_producto = null)
    {
        $option = "<option  selected='true' disabled='disabled'> Seleccione un Producto</option>";
        $sql = "SELECT ct65_pedidos_has_precio_productos.id, `codigo_producto`, `nombre_producto` 
        FROM `ct65_pedidos_has_precio_productos`
        INNER JOIN ct65_pedidos ON ct65_pedidos_has_precio_productos.id_pedido = ct65_pedidos.id 
        WHERE `id_pedido` = :id AND ct65_pedidos.id_cliente = :id_cliente AND ct65_pedidos.id_obra = :id_obra AND ct65_pedidos_has_precio_productos.status = 1";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id', $id_pedido, PDO::PARAM_INT);
        $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
        $stmt->bindParam(':id_obra', $id_obra, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    if ($id_producto == $fila['id']) {
                        $selection = "selected='true'";
                    } else {
                        $selection = "";
                    }
                    $option .= '<option value="' . $fila['id'] . '" ' . $selection . ' >' . $fila['codigo_producto']  . ' - ' . $fila['nombre_producto']  . ' </option>';
                }
            } else {
                $option = "<option  selected='true' disabled='disabled'> No hay productos asociados al pedido </option>";
            }
        } else {
            $option = "<option  selected='true' disabled='disabled'> Error al cargar Productos H1</option>";
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
        //resultado
        return $option;
    }
    // Listado de los tipos de descargue (CONCRE TOLIMA)
    public function fntOptionTipoDescargueConcretolObj($id = null)
    {
        $option = "<option  selected='true' disabled='disabled'> Seleccione tipo de descargue </option>";
        $sql = "SELECT `id`, `descripcion` 
        FROM `ct66_tipo_descargue`
        WHERE `id` = 3 OR `id` = 4";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        // Asignando Datos ARRAY => SQL
        //$stmt->bindParam(':id_tercero', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        $stmt->execute();
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($id == $fila['id']) {
                $selection = " selected='true' ";
            } else {
                $selection = "";
            }
            $option .= '<option value="' . $fila['id'] . '" ' . $selection . ' >' . $fila['descripcion'] . ' </option>';
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
        //resultado
        return $option;
    }
    // Listado de los tipos de descargue (TODOS)
    public function fntOptionTipoDescargueObj($id = null)
    {
        $option = "<option  selected='true' disabled='disabled'> Seleccione tipo de descargue </option>";
        $sql = "SELECT `id`, `descripcion` 
         FROM `ct66_tipo_descargue`";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        // Asignando Datos ARRAY => SQL
        //$stmt->bindParam(':id_tercero', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        $stmt->execute();
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($id == $fila['id']) {
                $selection = " selected='true' ";
            } else {
                $selection = "";
            }
            $option .= '<option value="' . $fila['id'] . '" ' . $selection . ' >' . $fila['descripcion'] . ' </option>';
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
        //resultado
        return $option;
    }
    // Listado de las lineas de despacho.
    public function fntOptionLineaDespachoObj($id = null)
    {
        $this->id = $id;
        $option = "<option> Seleccione la linea de despacho </option>";
        $sql = "SELECT * FROM `ct66_linea_despacho` ";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    if ($this->id == $fila['id']) {
                        $selection = "selected='true'";
                    } else {
                        $selection = "";
                    }
                    $option .= '<option value="' . $fila['id'] . '"   ' . $selection . ' >' . $fila['descripcion'] . ' </option>';
                }
            } else {
                $option = "<option  selected='true' disabled='disabled'> Error al cargar datos</option>";
            }
        } else {
            $option = "<option  selected='true' disabled='disabled'> Error al cargar datos</option>";
        }

        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        return $option;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////SELECT - CONTAR PROGRAMACIONES CON X ESTADO////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////
    // Contar los datos de las programaciones semanales con estado de Sin confirmar
    public function fntContarProgramacionesSinConfirmarObj()
    {
        $sql = "SELECT COUNT(id) as cantidad 
        FROM `ct66_programacion_semanal` 
        WHERE `status` = 1";
        $stmt = $this->con->prepare($sql);
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['cantidad'];
                }
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }
    // Contar los datos de las programaciones semanales con estado de Por cargar
    public function fntContarProgramacionesPorCargarObj()
    {
        $sql = "SELECT COUNT(id) as cantidad 
        FROM `ct66_programacion_semanal` 
        WHERE `status` = 2";
        $stmt = $this->con->prepare($sql);
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['cantidad'];
                }
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }
    // Contar los datos de las programaciones semanales con estado de Confirmada
    public function fntContarProgramacionesConfirmadasObj()
    {
        $sql = "SELECT COUNT(id) as cantidad 
        FROM `ct66_programacion_semanal` 
        WHERE `status` = 3";
        $stmt = $this->con->prepare($sql);
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['cantidad'];
                }
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }
    // Contar los datos de las programaciones semanales con estado de Por cargar
    public function fntContarProgramacionesEjecutadasObj()
    {
        $sql = "SELECT COUNT(id) as cantidad 
        FROM `ct66_programacion_semanal` 
        WHERE `status` = 4";
        $stmt = $this->con->prepare($sql);
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['cantidad'];
                }
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////INSERT - CREAR PROGRAMACION////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////
    // Crear programacion semanal.
    public function fntCrearProgSemanalBool($status, $id_cliente, $nombre_cliente, $id_obra, $nombre_obra,  $id_pedido, $id_producto, $nombre_producto, $cantidad, $frecuencia, $requiere_bomba, $id_tipo_descargue, $nombre_tipo_descargue, $metros_tuberia, $fecha_ini, $fecha_fin, $elementos_fundir, $observaciones, $id_usuario, $nombre_usuario)
    {
        $sql = "INSERT INTO `ct66_programacion_semanal`(`status`, `id_cliente`, `nombre_cliente`, `id_obra`, `nombre_obra`, `id_pedido`, `id_producto`, `nombre_producto`, `cantidad`, `frecuencia`, `requiere_bomba`, `id_tipo_descargue`, `nombre_tipo_descargue`, `metros_tuberia`, `fecha_ini`, `fecha_fin`, `elementos_fundir`, `observaciones`, `id_usuario`, `nombre_usuario`) 
        VALUES (:status, :id_cliente, :nombre_cliente, :id_obra, :nombre_obra, :id_pedido, :id_producto, :nombre_producto, :cantidad, :frecuencia, :requiere_bomba, :id_tipo_descargue, :nombre_tipo_descargue, :metros_tuberia, :fecha_ini, :fecha_fin, :elementos_fundir, :observaciones, :id_usuario, :nombre_usuario)";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':status', $status, PDO::PARAM_INT);
        $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_cliente', $nombre_cliente, PDO::PARAM_STR);
        $stmt->bindParam(':id_obra', $id_obra, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_obra', $nombre_obra, PDO::PARAM_STR);
        $stmt->bindParam(':id_pedido', $id_pedido, PDO::PARAM_INT);
        $stmt->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_producto', $nombre_producto, PDO::PARAM_STR);
        $stmt->bindParam(':cantidad', $cantidad, PDO::PARAM_STR);
        $stmt->bindParam(':frecuencia', $frecuencia, PDO::PARAM_STR);
        $stmt->bindParam(':requiere_bomba', $requiere_bomba, PDO::PARAM_STR);
        $stmt->bindParam(':id_tipo_descargue', $id_tipo_descargue, PDO::PARAM_STR);
        $stmt->bindParam(':nombre_tipo_descargue', $nombre_tipo_descargue, PDO::PARAM_STR);
        $stmt->bindParam(':metros_tuberia', $metros_tuberia, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_ini', $fecha_ini, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_fin', $fecha_fin, PDO::PARAM_STR);
        $stmt->bindParam(':elementos_fundir', $elementos_fundir, PDO::PARAM_STR);
        $stmt->bindParam(':observaciones', $observaciones, PDO::PARAM_STR);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_STR);
        $stmt->bindParam(':nombre_usuario', $nombre_usuario, PDO::PARAM_STR);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////UPDATE - EDITAR PROGRAMACION///////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////
    // Editar las fechas de la programacion semanal
    public function fntEditarProgramacionBool($id_programacion, $start, $end, $fecha_modificacion, $id_usuario, $nombre_usuario)
    {
        $sql = "UPDATE `ct66_programacion_semanal` 
        SET `fecha_ini`= :inicio ,`fecha_fin`= :fin, `fecha_modificacion` = :fecha_modificacion, `id_usuario_edit` = :id_usuario, `nombre_usuario_edit` = :nombre_usuario 
        WHERE `id` = :id_programacion";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        // Asignando Datos ARRAY => SQ
        $stmt->bindParam(':inicio', $start, PDO::PARAM_STR);
        $stmt->bindParam(':fin', $end, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_modificacion', $fecha_modificacion, PDO::PARAM_STR);
        $stmt->bindParam(':id_programacion', $id_programacion, PDO::PARAM_INT);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_STR);
        $stmt->bindParam(':nombre_usuario', $nombre_usuario, PDO::PARAM_STR);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    // Cambiar estado de la programacion semanales (CLIENTE)
    public function fntCambiarEstadoProgramacionSemanal($id_usuario)
    {
        $estado = 2;
        $sql = "UPDATE `ct66_programacion_semanal`
        SET `status` = :estado 
        WHERE `id_usuario` = :id_usuario";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':estado', $estado, PDO::PARAM_INT);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_STR);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    // Cambiar estado de la programacion semanales (FUNCIONARIO)
    public function fntCambiarEstadoProgramacionSemanalFuncionario()
    {
        $estado = 3;
        $sql = "UPDATE `ct66_programacion_semanal`
        SET `status` = :estado";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':estado', $estado, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////SELECT - OBTENER NOMBRES///////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////
    // Traer el nombre del cliente.
    public function fntGetNombreClienteObj($id_cliente)
    {
        $this->id = $id_cliente;
        // sentencia SQL
        $sql = "SELECT ct1_RazonSocial 
        FROM ct1_terceros 
        WHERE ct1_IdTerceros = :id_cliente";
        // Preparar Conexion
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_cliente', $this->id, PDO::PARAM_INT);
        // ejecuta la sentencia SQL
        if ($stmt->execute()) {
            $num_reg = $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    return $fila['ct1_RazonSocial'];
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    // Traer el id del cliente mediante el nombre
    function fntGetIdClienteObj($nombre_cliente)
    {
        $this->id = $nombre_cliente;
        // sentencia SQL
        $sql = "SELECT `ct1_IdTerceros` 
        FROM `ct1_terceros` 
        WHERE `ct1_RazonSocial` =  :nombre";
        // Preparar Conexion
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':nombre', $this->id, PDO::PARAM_STR);
        // ejecuta la sentencia SQL
        if ($stmt->execute()) {
            $num_reg = $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    return $fila['ct1_IdTerceros'];
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    // Traer el nombre del obra.
    public function fntGetNombreObra($id)
    {
        $this->id = $id;
        $sql = "SELECT ct5_NombreObra 
        FROM `ct5_obras` 
        WHERE `ct5_IdObras` = :id";
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
    // Traer el id del cliente mediante el nombre
    function fntGetIdObraObj($nombre_obra)
    {
        $this->id = $nombre_obra;
        // sentencia SQL
        $sql = "SELECT `ct5_IdObras` 
        FROM `ct5_obras` 
        WHERE `ct5_NombreObra` =  :nombre";
        // Preparar Conexion
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':nombre', $this->id, PDO::PARAM_STR);
        // ejecuta la sentencia SQL
        if ($stmt->execute()) {
            $num_reg = $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    return $fila['ct5_IdObras'];
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    // Traer el nombre del producto.
    public function fntGetNombreProducto($id)
    {
        $this->id = $id;
        $sql = "SELECT `ct4_Id_productos`, `ct4_Descripcion` 
        FROM `ct4_productos` 
        WHERE `ct4_Id_productos` = :id";
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
    // Traer el nombre del tipo de descargue.
    public function fntGetNombreTipoDescargue($id)
    {
        $this->id = $id;
        $sql = "SELECT `descripcion` 
        FROM `ct66_tipo_descargue` 
        WHERE `id` = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['descripcion'];
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
    /////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////GET - OBTENER PROGRAMACIONES///////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////
    // Obtener todas las programaciones (FUNCIONARIO)
    public function fntGetProgSemanalFuncionarioObj()
    {
        $sql = "SELECT * FROM `ct66_programacion_semanal`";
        // Preparar Conexion.
        $stmt = $this->con->prepare($sql);
        // Asignando Datos ARRAY => SQL.
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { 
                    // Obtener los datos de los valores.
                    if ($fila['status'] == 1) {
                        $events[] = [
                            "id" => $fila['id'],
                            'title' => $fila['nombre_cliente'] . " - " . $fila['nombre_obra'] . '//' . $fila['nombre_producto'] . " - " . $fila['cantidad'] . ' M3',
                            'descrition' => $fila['nombre_producto'] . " - " . $fila['cantidad'] . ' M3 ',
                            'start' => $fila['fecha_ini'],
                            'end' => $fila['fecha_fin'],
                            'color' => 'gray',
                            'textcolor' => 'black'
                        ];
                    } else if ($fila['status'] == 2) {
                        $events[] = [
                            "id" => $fila['id'],
                            'title' => $fila['nombre_cliente'] . " - " . $fila['nombre_obra'] . '//' . $fila['nombre_producto'] . " - " . $fila['cantidad'] . ' M3',
                            'descrition' => $fila['nombre_producto'] . " - " . $fila['cantidad'] . ' M3 ',
                            'start' => $fila['fecha_ini'],
                            'end' => $fila['fecha_fin'],
                            'color' => 'orange',
                            'textcolor' => 'black'
                        ];
                    } else if ($fila['status'] == 3) {
                        $events[] = [
                            "id" => $fila['id'],
                            'title' => $fila['nombre_cliente'] . " - " . $fila['nombre_obra'] . '//' . $fila['nombre_producto'] . " - " . $fila['cantidad'] . ' M3',
                            'descrition' => $fila['nombre_producto'] . " - " . $fila['cantidad'] . ' M3 ',
                            'start' => $fila['fecha_ini'],
                            'end' => $fila['fecha_fin'],
                            'color' => 'Light Blue',
                            'textcolor' => 'black'
                        ];
                    } else if ($fila['status'] == 4) {
                        $events[] = [
                            "id" => $fila['id'],
                            'title' => $fila['nombre_cliente'] . " - " . $fila['nombre_obra'] . '//' . $fila['nombre_producto'] . " - " . $fila['cantidad'] . ' M3',
                            'descrition' => $fila['nombre_producto'] . " - " . $fila['cantidad'] . ' M3 ',
                            'start' => $fila['fecha_ini'],
                            'end' => $fila['fecha_fin'],
                            'color' => 'green',
                            'textcolor' => 'black'
                        ];
                    }
                }
                return $events;
            }
        }
        return false;
    }
    // Obtener todas las programaciones (CLIENTE)
    public function fntGetProgSemanalClienteObj($id_usuario)
    {
        $this->id = $id_usuario;
        $sql = "SELECT `id`, `status`, `id_cliente`, `nombre_cliente`, `id_obra`, `nombre_obra`, `id_pedido`, `id_producto`, `nombre_producto`, `cantidad`, `fecha_ini`, `fecha_fin`,`id_usuario` 
            FROM `ct66_programacion_semanal` 
            WHERE `id_usuario` = :id_usuario";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_usuario', $this->id, PDO::PARAM_INT);
        // Asignando Datos ARRAY => SQL
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    if ($fila['status'] == 1) {
                        $events[] = [
                            "id" => $fila['id'],
                            'title' => $fila['nombre_cliente'] . " - " . $fila['nombre_obra'] . '//' . $fila['nombre_producto'] . " - " . $fila['cantidad'] . ' M3',
                            'descrition' => $fila['nombre_producto'] . " - " . $fila['cantidad'] . ' M3 ',
                            'start' => $fila['fecha_ini'],
                            'end' => $fila['fecha_fin'],
                            'color' => 'gray',
                            'textcolor' => 'black'
                        ];
                    } else if ($fila['status'] == 2) {
                        $events[] = [
                            "id" => $fila['id'],
                            'title' => $fila['nombre_cliente'] . " - " . $fila['nombre_obra'] . '//' . $fila['nombre_producto'] . " - " . $fila['cantidad'] . ' M3',
                            'descrition' => $fila['nombre_producto'] . " - " . $fila['cantidad'] . ' M3 ',
                            'start' => $fila['fecha_ini'],
                            'end' => $fila['fecha_fin'],
                            'color' => 'orange',
                            'textcolor' => 'black'
                        ];
                    } else if ($fila['status'] == 3) {
                        $events[] = [
                            "id" => $fila['id'],
                            'title' => $fila['nombre_cliente'] . " - " . $fila['nombre_obra'] . '//' . $fila['nombre_producto'] . " - " . $fila['cantidad'] . ' M3',
                            'descrition' => $fila['nombre_producto'] . " - " . $fila['cantidad'] . ' M3 ',
                            'start' => $fila['fecha_ini'],
                            'end' => $fila['fecha_fin'],
                            'color' => 'Light Blue',
                            'textcolor' => 'black'
                        ];
                    } else if ($fila['status'] == 4) {
                        $events[] = [
                            "id" => $fila['id'],
                            'title' => $fila['nombre_cliente'] . " - " . $fila['nombre_obra'] . '//' . $fila['nombre_producto'] . " - " . $fila['cantidad'] . ' M3',
                            'descrition' => $fila['nombre_producto'] . " - " . $fila['cantidad'] . ' M3 ',
                            'start' => $fila['fecha_ini'],
                            'end' => $fila['fecha_fin'],
                            'color' => 'green',
                            'textcolor' => 'black'
                        ];
                    }
                }
                return $events;
            }
        }
        return false;
    }
    // Obtener todos los estados de las programaciones (CLIENTE)
    public function fntGetEstadosProgramacionClienteObj($id_usuario)
    {
        $sql = "SELECT `status` 
            FROM `ct66_programacion_semanal` 
            WHERE `id_usuario` = :id_usuario";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        // Asignando Datos ARRAY => SQ
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['status'] = $fila['status'];
                    $datosf[] = $datos;
                }
                return $datosf;
            }
        }
        return false;
    }
    // Obtener todos los estados de las programaciones (FUNCIONARIO)
    public function fntGetEstadosProgramacionFuncionarioObj()
    {
        $sql = "SELECT `status` 
            FROM `ct66_programacion_semanal` ";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['status'] = $fila['status'];
                    $datosf[] = $datos;
                }
                return $datosf;
            }
        }
        return false;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////DELETE - ELIMINAR PROGRAMACION/////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////
    // Eliminar una programacion. eliminar_programacion_semanal
    function fntEliminarProgramacionSemanalObj($id_programacion)
    {
        $sql = "DELETE FROM `ct66_programacion_semanal` WHERE `id` = :id_programacion";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        // Asignando Datos ARRAY => SQ
        $stmt->bindParam(':id_programacion', $id_programacion, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
