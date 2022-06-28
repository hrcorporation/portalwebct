<?php

class ClsProgramacionSemanal extends conexionPDO
{

    protected $con;
    // Iniciar Conexion
    public function __construct()
    {
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
    }
    // Obtener todas las programaciones
    public function fntGetProgSemanalObj()
    {
        $sql = "SELECT * FROM `ct66_programacion_semanal`";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
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
    // Traer el nombre del cliente.
    public function fntGetNombreClienteObj($id_cliente)
    {
        $this->id = $id_cliente;
        // sentencia SQL
        $sql = "SELECT ct1_RazonSocial FROM ct1_terceros WHERE ct1_IdTerceros = :id_cliente";
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
    // Traer el nombre del obra.
    public function fntGetNombreObra($id)
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
    // Traer el nombre del producto.
    public function fntGetNombreProducto($id)
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
    // Traer el nombre del tipo de descargue.
    public function fntGetNombreTipoDescargue($id)
    {
        $this->id = $id;
        $sql = "SELECT `descripcion` FROM `ct66_tipo_descargue` WHERE `id` = :id";
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
    // Select de los clientes
    function fntOptionFrecuenciaEditObj($hora = null)
    {
        $option = "<option  selected='true' disabled='disabled'> Seleccione la frecuencia </option>";
        $sql = "SELECT `id`,`hora`,`descripcion` FROM `ct66_frecuencia`";
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
    // Listar el tipo de pedidos
    function fntOptionListaPedidosObj($id = null)
    {
        $option = "<option  selected='true' disabled='disabled'> Seleccione el pedido</option>";
        $sql = "SELECT `id`, `fecha_vencimiento`, `nombre_cliente`, `nombre_obra` FROM `ct65_pedidos` WHERE `status` = 1";
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
            $option .= '<option value="' . $fila['id'] . '" ' . $selection . ' >' . $fila['id'] . ' - ' . " PEDIDO " . "(" . $fila['fecha_vencimiento'] . ")" . ' </option>';
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
        //resultado
        return $option;
    }
    // Obtener todas las programaciones desde el usuario de un cliente. Cambiar a cargar
    function fntGetProgSemanalUsuarioObj($id_usuario)
    {
        $this->id = $id_usuario;
        $sql = "SELECT `id`, `status`, `id_cliente`, `nombre_cliente`, `id_obra`, `nombre_obra`, `id_pedido`, `id_producto`, `nombre_producto`, `cantidad`, `fecha_ini`, `fecha_fin`,`id_usuario` FROM `ct66_programacion_semanal` WHERE `id_usuario` = :id_usuario";
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
                    }
                    else if ($fila['status'] == 4) {
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
    // Listar el tipo de descargue
    function fntOptionTipoDescargueObj($id = null)
    {
        $option = "<option  selected='true' disabled='disabled'> Seleccione tipo de descargue</option>";
        $sql = "SELECT `id`, `descripcion` FROM `ct66_tipo_descargue`";
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
    /**** OPTION SELECT PRODUCTO ********/
    function fntOptionProductoEditObj($id_producto = null)
    {
        $this->id = $id_producto;
        $option = "<option  selected='true' disabled='disabled'> Seleccione una Producto</option>";
        $sql = "SELECT ct4_Id_productos , ct4_CodigoSyscafe , ct4_Descripcion FROM `ct4_productos`";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        // Ejecutar 
        if ($result = $stmt->execute()) {
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
    // Crear programacion semanal.
    public function fntCrearProgSemanalBool($status, $id_cliente, $nombre_cliente, $id_obra, $nombre_obra,  $id_pedido, $id_producto, $nombre_producto, $cantidad, $frecuencia, $requiere_bomba, $id_tipo_descargue, $nombre_tipo_descargue, $metros_tuberia, $fecha_ini, $fecha_fin, $elementos_fundir, $observaciones, $id_usuario, $nombre_usuario)
    {
        $sql = "INSERT INTO `ct66_programacion_semanal`(`status`, `id_cliente`, `nombre_cliente`, `id_obra`, `nombre_obra`, `id_pedido`, `id_producto`, `nombre_producto`, `cantidad`, `frecuencia`, `requiere_bomba`, `id_tipo_descargue`, `nombre_tipo_descargue`, `metros_tuberia`, `fecha_ini`, `fecha_fin`, `elementos_fundir`, `observaciones`, `id_usuario`, `nombre_usuario`) VALUES (:status, :id_cliente, :nombre_cliente, :id_obra, :nombre_obra, :id_pedido, :id_producto, :nombre_producto, :cantidad, :frecuencia, :requiere_bomba, :id_tipo_descargue, :nombre_tipo_descargue, :metros_tuberia, :fecha_ini, :fecha_fin, :elementos_fundir, :observaciones, :id_usuario, :nombre_usuario)";
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
    //Editar las fechas de la programacion semanal
    function fntEditarProgramacionBool($id_programacion, $start, $end, $fecha_modificacion, $id_usuario, $nombre_usuario)
    {
        $sql = "UPDATE `ct66_programacion_semanal` SET `fecha_ini`= :inicio ,`fecha_fin`= :fin, `fecha_modificacion` = :fecha_modificacion, `id_usuario_edit` = :id_usuario, `nombre_usuario_edit` = :nombre_usuario WHERE `id` = :id_programacion";
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
    // Select de los clientes
    function fntOptionClienteEditObj($id_cliente = null)
    {
        $option = "<option  selected='true' disabled='disabled'> Seleccione un Cliente</option>";
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
    //Select de los clientes
    function fntOptionClienteEditClienteObj($id_usuario, $id_cliente = null)
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
    //Select de las Obras
    /**** OPTION SELECT OBRA ********/
    function fntOptionObraEditClienteObj($id_cliente, $id_usuario, $id_obra = null)
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
    // Select de las obras
    function fntOptionObraEditObj($id_cliente, $id_obra = null)
    {
        $this->id = $id_cliente;
        $option = "<option  selected='true' disabled='disabled'> Seleccione una Obra</option>";
        $sql = "SELECT * FROM `ct5_obras` WHERE `ct5_IdTerceros` = :id_cliente";
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
    // Cargar datos de la programacion mediante el id de la programacion.
    function fntCargarDataProgramacionObj($id_programacion)
    {
        $sql = "SELECT * FROM `ct66_programacion_semanal` WHERE `id` = :id_programacion ";
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
    //Contar los datos de las programaciones semanales con estado de Sin confirmar
    function fntContarProgramacionesSinConfirmarObj()
    {
        $sql = "SELECT COUNT(id) as cantidad FROM `ct66_programacion_semanal` WHERE `status` = 1";
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
    //Contar los datos de las programaciones semanales con estado de Por cargar
    function fntContarProgramacionesPorCargarObj()
    {
        $sql = "SELECT COUNT(id) as cantidad FROM `ct66_programacion_semanal` WHERE `status` = 2";
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
    //Contar los datos de las programaciones semanales con estado de Confirmada
    function fntContarProgramacionesConfirmadasObj()
    {
        $sql = "SELECT COUNT(id) as cantidad FROM `ct66_programacion_semanal` WHERE `status` = 3";
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
    //Contar los datos de las programaciones semanales con estado de Por cargar
    function fntContarProgramacionesEjecutadasObj()
    {
        $sql = "SELECT COUNT(id) as cantidad FROM `ct66_programacion_semanal` WHERE `status` = 4";
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
}
