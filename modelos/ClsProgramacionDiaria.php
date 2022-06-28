<?php

class ClsProgramacionDiaria extends conexionPDO
{
    protected $con;
    // Iniciar Conexion
    public function __construct()
    {
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
    }
    //Contar los datos de las programaciones diarias con estado de Sin confirmar (FUNCIONARIO)
    function fntContarProgramacionesSinConfirmarFuncionarioObj()
    {
        $sql = "SELECT COUNT(id) as cantidad FROM `ct66_programacion_diaria` WHERE `status` = 1";
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
    //Contar los datos de las programaciones diarias con estado de Sin confirmar (CLIENTE)
    function fntContarProgramacionesSinConfirmarClienteObj($id_usuario)
    {
        $this->id = $id_usuario;
        $sql = "SELECT COUNT(id) as cantidad FROM `ct66_programacion_diaria` WHERE `status` = 1 AND `id_usuario` = :id_usuario";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_usuario', $this->id, PDO::PARAM_INT);
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
    // Obtener todas las programaciones
    public function fntGetProgDiariaFuncionarioObj()
    {
        $sql = "SELECT * FROM `ct66_programacion_diaria`";
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
    // Obtener todas las programaciones desde el usuario de un cliente. Cambiar a cargar
    function fntGetProgDiariaClienteObj($id_usuario)
    {
        $this->id = $id_usuario;
        $sql = "SELECT `id`, `status`, `id_cliente`, `nombre_cliente`, `id_obra`, `nombre_obra`, `id_pedido`, `id_producto`, `nombre_producto`, `cantidad`, `fecha_ini`, `fecha_fin`,`id_usuario` FROM `ct66_programacion_diaria` WHERE `id_usuario` = :id_usuario";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_usuario', $this->id, PDO::PARAM_INT);
        // Asignando Datos ARRAY => SQL
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    if ($fila['status'] == 1 && $fila['id_usuario'] == $id_usuario) {
                        $events[] = [
                            "id" => $fila['id'],
                            'title' => $fila['nombre_cliente'] . " - " . $fila['nombre_obra'] . '//' . $fila['nombre_producto'] . " - " . $fila['cantidad'] . ' M3',
                            'descrition' => $fila['nombre_producto'] . " - " . $fila['cantidad'] . ' M3 ',
                            'start' => $fila['fecha_ini'],
                            'end' => $fila['fecha_fin'],
                            'color' => 'green',
                            'textcolor' => 'black'
                        ];
                    } else if ($fila['status'] == 2 && $fila['id_usuario'] == $id_usuario) {
                        $events[] = [
                            "id" => $fila['id'],
                            'title' => $fila['nombre_cliente'] . " - " . $fila['nombre_obra'] . '//' . $fila['nombre_producto'] . " - " . $fila['cantidad'] . ' M3',
                            'descrition' => $fila['nombre_producto'] . " - " . $fila['cantidad'] . ' M3 ',
                            'start' => $fila['fecha_ini'],
                            'end' => $fila['fecha_fin'],
                            'color' => 'orange',
                            'textcolor' => 'black'
                        ];
                    } else if ($fila['status'] == 3 && $fila['id_usuario'] == $id_usuario) {
                        $events[] = [
                            "id" => $fila['id'],
                            'title' => $fila['nombre_cliente'] . " - " . $fila['nombre_obra'] . '//' . $fila['nombre_producto'] . " - " . $fila['cantidad'] . ' M3',
                            'descrition' => $fila['nombre_producto'] . " - " . $fila['cantidad'] . ' M3 ',
                            'start' => $fila['fecha_ini'],
                            'end' => $fila['fecha_fin'],
                            'color' => 'red',
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
    public function fntGetNombreObraObj($id)
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
    public function fntGetNombreProductoObj($id)
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
    public function fntGetNombreTipoDescargueObj($id)
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
    // Traer el nombre del tipo de descargue.
    public function fntGetNombreLineaDespachoObj($id)
    {
        $this->id = $id;
        $sql = "SELECT `id`, `descripcion` FROM `ct66_linea_despacho` WHERE `id` = :id";
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
    // Traer el nombre del tipo de descargue.
    public function fntGetPlacaMixerObj($id)
    {
        $this->id = $id;
        $sql = "SELECT `ct10_Placa` FROM `ct10_vehiculo` WHERE `ct10_IdVehiculo` =  :id";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['ct10_Placa'];
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
    // Traer el nombre del tipo de bomba
    public function fntGetNombreTipoBombaObj($id)
    {
        $this->id = $id;
        $sql = "SELECT `ct50_id_tipo_bomba`,`ct50_nombre_tipo_bomba` FROM `ct50_tipo_bomba` WHERE `ct50_id_tipo_bomba` =  :id";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['ct50_nombre_tipo_bomba'];
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
    // Listar los productos
    function fntOptionProductoEditObj($id = null)
    {
        $this->id = $id;
        $option = "<option  selected='true' disabled='disabled'> Seleccione una Producto</option>";
        $sql = "SELECT ct4_Id_productos , ct4_CodigoSyscafe , ct4_Descripcion FROM `ct4_productos`";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        // Ejecutar 
        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    if ($this->id == $fila['ct4_Id_productos']) {
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
    // Listar los vehiculos(mixer)
    function fntOptionVehiculoObj($id = null)
    {
        $option = "<option> Seleccione un Vehiculo</option>";
        $sql = "SELECT * FROM `ct10_vehiculo` WHERE `ct10_Estado` = 1";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        //$stmt->bindParam(':id_tercero', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        $stmt->execute();

        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($id == $fila['ct10_IdVehiculo']) {
                $selection = " selected='true' ";
            } else {
                $selection = "";
            }
            $option .= '<option value="' . $fila['ct10_IdVehiculo'] . '"   ' . $selection . ' >' . $fila['ct10_Placa'] . ' </option>';
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
        //resultado
        return $option;
    }
    // Listar los conductores
    function fntOptionConductorObj($id = null)
    {
        $this->id = $id;
        $option = "<option> Seleccione un Conductor</option>";
        $sql = "SELECT * FROM ct1_terceros WHERE ct1_TipoTercero = 10 AND  `ct1_rol` IN (25,29) AND ct1_Estado = 1";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {

                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    if ($this->id == $fila['ct1_IdTerceros']) {
                        $selection = "selected='true'";
                    } else {
                        $selection = "";
                    }
                    $option .= '<option value="' . $fila['ct1_IdTerceros'] . '"   ' . $selection . ' >' . $fila['ct1_NumeroIdentificacion'] . ' - ' . $fila['ct1_RazonSocial'] . ' </option>';
                }
            } else {
                $option = "<option  selected='true' disabled='disabled'> Error al cargar Conductor</option>";
            }
        } else {
            $option = "<option  selected='true' disabled='disabled'> Error al cargar Conductor</option>";
        }

        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        return $option;
    }
    // Listar los conductores
    function fntOptionTipoBombaObj($id = null)
    {
        $this->id = $id;
        $option = "<option> Seleccione el tipo de bomba</option>";
        $sql = "SELECT * FROM `ct50_tipo_bomba`";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {

                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    if ($this->id == $fila['ct50_id_tipo_bomba']) {
                        $selection = "selected='true'";
                    } else {
                        $selection = "";
                    }
                    $option .= '<option value="' . $fila['ct50_id_tipo_bomba'] . '"   ' . $selection . ' >' . $fila['ct50_nombre_tipo_bomba'] . ' </option>';
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
    // Listar los conductores
    function fntOptionLineaDespachoObj($id = null)
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
    // Listar los clientes
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
    // Listar las obras
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
    function fntCargarDataProgramacionDiariaObj($id_programacion)
    {
        $sql = "SELECT * FROM `ct66_programacion_diaria` WHERE `id` = :id_programacion ";
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
                    $datos['hora_cargue'] = $fila['hora_cargue'];
                    $datos['hora_mixer_obra'] = $fila['hora_mixer_obra'];
                    $datos['elementos'] = $fila['elementos_fundir'];
                    $datos['observaciones'] = $fila['observaciones'];
                    $datos['metros'] = $fila['metros_tuberia'];
                    $datos['requiere_bomba'] = $fila['requiere_bomba'];
                    $datos['id_linea_produccion'] = $fila['id_linea_produccion'];
                    $datos['id_mixer'] = $fila['id_mixer'];
                    $datos['id_conductor'] = $fila['id_conductor'];
                    $datos['id_tipo_bomba'] = $fila['id_tipo_bomba'];
                    $datos['color'] = 'orange';
                    $datos['textcolor'] = 'black';
                    $datosf[] = $datos;
                }
                return $datosf;
            }
        }
        return false;
    }
    // Crear programacion diaria
    function fntCrearProgDiariaBool($intEstado, $intIdCliente, $StrNombreCliente, $intIdObra, $StrNombreObra,  $intPedido, $intIdProducto, $StrNombreProducto, $intIdLineaDespacho, $StrNombreLineaDespacho, $dtmHoraCargue, $dtmHoraMixerObra, $intIdMixer, $StrPlacaMixer, $intIdConductor, $StrNombreConductor, $decCantidad, $bolRequiereBomba, $intTipoDescargue, $StrNombreTipoDescargue, $intTipoBomba, $StrNombreTipoBomba, $dtmFechaInicio, $dtmFechaFin, $StrObservaciones, $intIdUsuario, $StrNombreUsuario)
    {

        $sql = "INSERT INTO `ct66_programacion_diaria`(`status`, `id_cliente`, `nombre_cliente`, `id_obra`, `nombre_obra`, `id_pedido`, `id_producto`, `nombre_producto`, `cantidad`, `id_linea_produccion`, `nombre_linea_produccion`, `hora_cargue`, `hora_mixer_obra`, `id_mixer`, `mixer`, `id_conductor`, `nombre_conductor`, `requiere_bomba`, `id_tipo_descargue`, `nombre_tipo_descargue`, `id_tipo_bomba`, `tipo_bomba`,`fecha_ini`, `fecha_fin`, `observaciones`, `id_usuario`, `nombre_usuario`) VALUES (:status, :id_cliente, :nombre_cliente, :id_obra, :nombre_obra, :id_pedido, :id_producto, :nombre_producto, :cantidad, :id_linea_produccion, :nombre_linea_produccion, :hora_cargue, :hora_mixer_obra, :id_mixer, :mixer, :id_conductor, :nombre_conductor, :requiere_bomba, :id_tipo_descargue, :nombre_tipo_descargue, :id_tipo_bomba, :tipo_bomba, :fecha_ini, :fecha_fin, :observaciones, :id_usuario, :nombre_usuario)";

        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':status', $intEstado, PDO::PARAM_INT);
        $stmt->bindParam(':id_cliente', $intIdCliente, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_cliente', $StrNombreCliente, PDO::PARAM_STR);
        $stmt->bindParam(':id_obra', $intIdObra, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_obra', $StrNombreObra, PDO::PARAM_STR);
        $stmt->bindParam(':id_pedido', $intPedido, PDO::PARAM_INT);
        $stmt->bindParam(':id_producto', $intIdProducto, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_producto', $StrNombreProducto, PDO::PARAM_STR);
        $stmt->bindParam(':cantidad', $decCantidad, PDO::PARAM_STR);
        $stmt->bindParam(':id_linea_produccion', $intIdLineaDespacho, PDO::PARAM_STR);
        $stmt->bindParam(':nombre_linea_produccion', $StrNombreLineaDespacho, PDO::PARAM_STR);
        $stmt->bindParam(':hora_cargue', $dtmHoraCargue, PDO::PARAM_STR);
        $stmt->bindParam(':hora_mixer_obra', $dtmHoraMixerObra, PDO::PARAM_STR);
        $stmt->bindParam(':id_mixer', $intIdMixer, PDO::PARAM_STR);
        $stmt->bindParam(':mixer', $StrPlacaMixer, PDO::PARAM_STR);
        $stmt->bindParam(':id_conductor', $intIdConductor, PDO::PARAM_STR);
        $stmt->bindParam(':nombre_conductor', $StrNombreConductor, PDO::PARAM_STR);
        $stmt->bindParam(':requiere_bomba', $bolRequiereBomba, PDO::PARAM_STR);
        $stmt->bindParam(':id_tipo_descargue', $intTipoDescargue, PDO::PARAM_STR);
        $stmt->bindParam(':nombre_tipo_descargue', $StrNombreTipoDescargue, PDO::PARAM_STR);
        $stmt->bindParam(':id_tipo_bomba', $intTipoBomba, PDO::PARAM_STR);
        $stmt->bindParam(':tipo_bomba', $StrNombreTipoBomba, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_ini', $dtmFechaInicio, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_fin', $dtmFechaFin, PDO::PARAM_STR);
        $stmt->bindParam(':observaciones', $StrObservaciones, PDO::PARAM_STR);
        $stmt->bindParam(':id_usuario', $intIdUsuario, PDO::PARAM_STR);
        $stmt->bindParam(':nombre_usuario', $StrNombreUsuario, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    //Editar las fechas de la programacion diaria
    function fntEditarProgramacionBool($id_programacion, $start, $end, $fecha_modificacion, $id_usuario, $nombre_usuario)
    {
        $sql = "UPDATE `ct66_programacion_diaria` SET `fecha_ini`= :inicio ,`fecha_fin`= :fin, `fecha_modificacion` = :fecha_modificacion, `id_usuario_edit` = :id_usuario, `nombre_usuario_edit` = :nombre_usuario WHERE `id` = :id_programacion";
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
    
}
