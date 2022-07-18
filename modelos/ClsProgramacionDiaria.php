<?php

class ClsProgramacionDiaria extends conexionPDO
{
    protected $con;
    // CONEXION
    public function __construct()
    {
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////SELECT - OBTENER PROGRAMACIONES///////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////
    // Obtener todas las programaciones (FUNCIONARIOS).
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
    // Obtener todas las programaciones (CLIENTES).
    public function fntGetProgDiariaClienteObj($id_usuario)
    {
        $this->id = $id_usuario;
        $sql = "SELECT `id`, `status`, `id_cliente`, `nombre_cliente`, `id_obra`, `nombre_obra`, `id_pedido`, `id_producto`, `nombre_producto`, `cantidad`, `fecha_ini`, `fecha_fin`,`id_usuario` 
        FROM `ct66_programacion_diaria` 
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
                            'title' => $fila['nombre_cliente'] . " - " . $fila['nombre_obra'] . ' ' . '/-/' . ' ' . $fila['nombre_producto'] . " - " . $fila['cantidad'] . ' M3',
                            'descrition' => $fila['nombre_producto'] . " - " . $fila['cantidad'] . ' M3 ',
                            'start' => $fila['fecha_ini'],
                            'end' => $fila['fecha_fin'],
                            'color' => 'gray',
                            'textcolor' => 'black'
                        ];
                    } else if ($fila['status'] == 2) {
                        $events[] = [
                            "id" => $fila['id'],
                            'title' => $fila['nombre_cliente'] . " - " . $fila['nombre_obra'] . ' ' . '/-/' . ' ' . $fila['nombre_producto'] . " - " . $fila['cantidad'] . ' M3',
                            'descrition' => $fila['nombre_producto'] . " - " . $fila['cantidad'] . ' M3 ',
                            'start' => $fila['fecha_ini'],
                            'end' => $fila['fecha_fin'],
                            'color' => 'orange',
                            'textcolor' => 'black'
                        ];
                    } else if ($fila['status'] == 3) {
                        $events[] = [
                            "id" => $fila['id'],
                            'title' => $fila['nombre_cliente'] . " - " . $fila['nombre_obra'] . ' ' . '/-/' . ' ' . $fila['nombre_producto'] . " - " . $fila['cantidad'] . ' M3',
                            'descrition' => $fila['nombre_producto'] . " - " . $fila['cantidad'] . ' M3 ',
                            'start' => $fila['fecha_ini'],
                            'end' => $fila['fecha_fin'],
                            'color' => 'Light Blue',
                            'textcolor' => 'black'
                        ];
                    } else if ($fila['status'] == 4) {
                        $events[] = [
                            "id" => $fila['id'],
                            'title' => $fila['nombre_cliente'] . " - " . $fila['nombre_obra'] . ' ' . '/-/' . ' ' . $fila['nombre_producto'] . " - " . $fila['cantidad'] . ' M3',
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
    // Obtener todos los estados de las programaciones (CLIENTE).
    public function fntGetEstadosProgramacionCliente2Obj($id_programacion)
    {
        $this->id = $id_programacion;
        $sql = "SELECT `status` 
        FROM `ct66_programacion_diaria`
        WHERE `id` = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['status'];
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
    //////////////////////////////////SELECT - CARGAR PROGRAMACIONES/////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////
    // Cargar datos de la programacion mediante el id de la programacion.
    public function fntCargarDataProgramacionDiariaObj($id_programacion)
    {
        $sql = "SELECT * FROM `ct66_programacion_diaria` 
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
                    $datos['nombre_cliente'] = $fila['nombre_cliente'];
                    $datos['obra'] = $fila['id_obra'];
                    $datos['nombre_obra'] = $fila['nombre_obra'];
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
    /////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////SELECT - LISTAR DATOS REQUERIDOS PARA CREAR PROGRAMACION///////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////
    // Listado de los clientes.
    public function fntOptionClienteEditObj($id_cliente = null)
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
    //Listado de los clientes (Terceros) - (CLIENTE).
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
    // Listado de las obras.
    public function fntOptionObraEditObj($id_cliente, $id_obra = null)
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
    //Listado de las obras (CLIENTE).
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
    // // Listado del tipo de pedidos (CLIENTE).
    public function fntOptionListaPedidosClienteObj($id_cliente, $id_obra, $id_pedido = null)
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
                    if ($id_pedido == $fila['id']) {
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
    // Listado de los productos.
    public function fntOptionProductoClienteObj($id_pedido, $id_producto = null)
    {
        $this->id = $id_producto;
        $option = "<option  selected='true' disabled='disabled'> Seleccione una Producto</option>";
        $sql = "SELECT `id`, `codigo_producto`, `nombre_producto` 
        FROM `ct65_pedidos_has_precio_productos` 
        WHERE `id_pedido` = :id AND `status` = 1";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id', $id_pedido, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    if ($this->id == $fila['id']) {
                        $selection = "selected='true'";
                    } else {
                        $selection = "";
                    }
                    $option .= '<option value="' . $fila['id'] . '" ' . $selection . ' >' . $fila['codigo_producto']  . ' - ' . $fila['nombre_producto']  . ' </option>';
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
    // Listado de los productos (FUNCIONARIOS).
    public function fntOptionProductoFuncionarioObj($id_pedido, $id_producto = null)
    {
        $option = "<option  selected='true' disabled='disabled'> Seleccione un Producto</option>";
        $sql = "SELECT `id`, `codigo_producto`, `nombre_producto` 
        FROM `ct65_pedidos_has_precio_productos` 
        WHERE `id_pedido` = :id AND `status` = 1";
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
    // Listado del tipo de descargue (CONCRE TOLIMA).
    public function fntOptionTipoDescargueConcretolObj($id_tipo_descargue = null)
    {
        $option = "<option  selected='true' disabled='disabled'> Seleccione tipo de descargue</option>";
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
            if ($id_tipo_descargue == $fila['id']) {
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
    // Listado del tipo de descargue (TODOS).
    public function fntOptionTipoDescargueObj($id_tipo_descargue = null)
    {
        $option = "<option  selected='true' disabled='disabled'> Seleccione tipo de descargue</option>";
        $sql = "SELECT `id`, `descripcion` 
        FROM `ct66_tipo_descargue`";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        // Asignando Datos ARRAY => SQL
        //$stmt->bindParam(':id_tercero', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        $stmt->execute();
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($id_tipo_descargue == $fila['id']) {
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
    // Listado de los vehiculos (MIXER).
    public function fntOptionVehiculoObj($id_vehiculo = null)
    {
        $option = "<option> Seleccione un Vehiculo</option>";
        $sql = "SELECT * FROM `ct10_vehiculo` 
        WHERE `ct10_Estado` = 1";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        //$stmt->bindParam(':id_tercero', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        $stmt->execute();

        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($id_vehiculo == $fila['ct10_IdVehiculo']) {
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
    // Listado de los conductores.
    public function fntOptionConductorObj($id_conductor = null)
    {
        $this->id = $id_conductor;
        $option = "<option> Seleccione un Conductor</option>";
        $sql = "SELECT * FROM ct1_terceros 
        WHERE ct1_TipoTercero = 10 AND  `ct1_rol` IN (25,29) AND ct1_Estado = 1";
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
    // Listado de los tipos de bomba.
    public function fntOptionTipoBombaObj($id_tipo_bomba = null)
    {
        $this->id = $id_tipo_bomba;
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
    // Listado de las lineas de despacho.
    public function fntOptionLineaDespachoObj($id_linea_despacho = null)
    {
        $this->id = $id_linea_despacho;
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
    //Contar los datos de las programaciones diarias con estado de Sin confirmar (FUNCIONARIO)
    public function fntContarProgramacionesSinConfirmarFuncionarioObj()
    {
        $sql = "SELECT COUNT(id) as cantidad
        FROM `ct66_programacion_diaria`
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
    //Contar los datos de las programaciones diarias con estado de Sin confirmar (CLIENTE)
    public function fntContarProgramacionesSinConfirmarClienteObj($id_usuario)
    {
        $this->id = $id_usuario;
        $sql = "SELECT COUNT(id) as cantidad 
        FROM `ct66_programacion_diaria` 
        WHERE `status` = 1 AND `id_usuario` = :id_usuario";
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
    /////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////CREATE - CREAR PROGRAMACION////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////
    // Crear programacion diaria (FUNCIONARIO)
    public function fntCrearProgDiariaFuncionarioBool($intEstado, $intIdCliente, $StrNombreCliente, $intIdObra, $StrNombreObra,  $intPedido, $intIdProducto, $StrNombreProducto, $intIdLineaDespacho, $StrNombreLineaDespacho, $dtmHoraCargue, $dtmHoraMixerObra, $intIdMixer, $StrPlacaMixer, $intIdConductor, $StrNombreConductor, $decCantidad, $bolRequiereBomba, $intTipoDescargue, $StrNombreTipoDescargue, $intTipoBomba, $StrNombreTipoBomba, $dtmFechaInicio, $dtmFechaFin, $StrObservaciones, $intIdUsuario, $StrNombreUsuario)
    {

        $sql = "INSERT INTO `ct66_programacion_diaria`(`status`, `id_cliente`, `nombre_cliente`, `id_obra`, `nombre_obra`, `id_pedido`, `id_producto`, `nombre_producto`, `cantidad`, `id_linea_produccion`, `nombre_linea_produccion`, `hora_cargue`, `hora_mixer_obra`, `id_mixer`, `mixer`, `id_conductor`, `nombre_conductor`, `requiere_bomba`, `id_tipo_descargue`, `nombre_tipo_descargue`, `id_tipo_bomba`, `tipo_bomba`,`fecha_ini`, `fecha_fin`, `observaciones`, `id_usuario`, `nombre_usuario`) 
        VALUES (:status, :id_cliente, :nombre_cliente, :id_obra, :nombre_obra, :id_pedido, :id_producto, :nombre_producto, :cantidad, :id_linea_produccion, :nombre_linea_produccion, :hora_cargue, :hora_mixer_obra, :id_mixer, :mixer, :id_conductor, :nombre_conductor, :requiere_bomba, :id_tipo_descargue, :nombre_tipo_descargue, :id_tipo_bomba, :tipo_bomba, :fecha_ini, :fecha_fin, :observaciones, :id_usuario, :nombre_usuario)";

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
    // Crear programacion diaria (CLIENTE)
    public function fntCrearProgDiariaClienteBool($intEstado, $intIdCliente, $StrNombreCliente, $intIdObra, $StrNombreObra,  $intPedido, $intIdProducto, $StrNombreProducto, $intIdLineaDespacho, $StrNombreLineaDespacho, $dtmHoraCargue, $dtmHoraMixerObra, $intIdMixer, $StrPlacaMixer, $intIdConductor, $StrNombreConductor, $decCantidad, $bolRequiereBomba, $intTipoDescargue, $StrNombreTipoDescargue, $intTipoBomba, $StrNombreTipoBomba, $dtmFechaInicio, $dtmFechaFin, $StrObservaciones, $intIdUsuario, $StrNombreUsuario)
    {
        $sql = "INSERT INTO `ct66_programacion_diaria`(`status`, `id_cliente`, `nombre_cliente`, `id_obra`, `nombre_obra`, `id_pedido`, `id_producto`, `nombre_producto`, `cantidad`, `id_linea_produccion`, `nombre_linea_produccion`, `hora_cargue`, `hora_mixer_obra`, `id_mixer`, `mixer`, `id_conductor`, `nombre_conductor`, `requiere_bomba`, `id_tipo_descargue`, `nombre_tipo_descargue`, `id_tipo_bomba`, `tipo_bomba`,`fecha_ini`, `fecha_fin`, `observaciones`, `id_usuario`, `nombre_usuario`) 
        VALUES (:status, :id_cliente, :nombre_cliente, :id_obra, :nombre_obra, :id_pedido, :id_producto, :nombre_producto, :cantidad, :id_linea_produccion, :nombre_linea_produccion, :hora_cargue, :hora_mixer_obra, :id_mixer, :mixer, :id_conductor, :nombre_conductor, :requiere_bomba, :id_tipo_descargue, :nombre_tipo_descargue, :id_tipo_bomba, :tipo_bomba, :fecha_ini, :fecha_fin, :observaciones, :id_usuario, :nombre_usuario)";

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
    /////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////UPDATE - EDITAR PROGRAMACION///////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////
    //Editar las fechas de la programacion diaria
    public function fntEditarProgramacionTodoFuncionarioBool($intId, $intIdCliente, $strNombreCliente, $intIdObra, $StrNombreObra, $intIdPedido, $intIdProducto, $strNombreProducto, $intIdLineaDespacho, $StrNombreLineaDespacho, $dtmHoraCargue, $dtmHoraMixerObra, $intIdMixer, $StrPlacaMixer, $intIdConductor, $StrNombreConductor, $decCantidad, $bolRequiereBomba, $intTipoDescargue, $StrNombreTipoDescargue, $intTipoBomba, $StrNombreTipoBomba, $StrObservaciones, $dtmFechaInicio, $dtmFechaFin, $dtmHoy, $intIdUsuario, $StrNombreUsuario)
    {
        $sql = "UPDATE `ct66_programacion_diaria` SET `id_pedido`= :id_pedido, `id_cliente`= :id_cliente, `nombre_cliente`= :nombre_cliente, `id_obra`= :id_obra, `nombre_obra`= :nombre_obra, `id_producto`= :id_producto, `nombre_producto`= :nombre_producto, `cantidad`= :cantidad, `id_linea_produccion`= :id_linea_produccion, `nombre_linea_produccion`= :nombre_linea_produccion, `hora_cargue`= :hora_cargue, `hora_mixer_obra`= :hora_mixer_obra, `id_mixer`= :id_mixer, `mixer`= :mixer, `id_conductor`= :id_conductor, `nombre_conductor`= :nombre_conductor, `requiere_bomba`= :requiere_bomba, `id_tipo_descargue`= :id_tipo_descargue, `nombre_tipo_descargue`= :nombre_tipo_descargue, `id_tipo_bomba`= :id_tipo_bomba,`tipo_bomba`= :tipo_bomba, `fecha_ini`= :fecha_ini, `fecha_fin`= :fecha_fin,`observaciones`= :observaciones, `id_usuario_edit`= :id_usuario, `nombre_usuario_edit`= :nombre_usuario, `fecha_modificacion`= :fecha_modificacion WHERE `id` = :id_programacion";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':id_pedido', $intIdPedido, PDO::PARAM_STR);
        $stmt->bindParam(':id_cliente', $intIdCliente, PDO::PARAM_STR);
        $stmt->bindParam(':nombre_cliente', $strNombreCliente, PDO::PARAM_STR);
        $stmt->bindParam(':id_obra', $intIdObra, PDO::PARAM_STR);
        $stmt->bindParam(':nombre_obra', $StrNombreObra, PDO::PARAM_STR);
        $stmt->bindParam(':id_producto', $intIdProducto, PDO::PARAM_STR);
        $stmt->bindParam(':nombre_producto', $strNombreProducto, PDO::PARAM_STR);
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
        $stmt->bindParam(':observaciones', $StrObservaciones, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_ini', $dtmFechaInicio, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_fin', $dtmFechaFin, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_modificacion', $dtmHoy, PDO::PARAM_STR);
        $stmt->bindParam(':id_programacion', $intId, PDO::PARAM_STR);
        $stmt->bindParam(':id_usuario', $intIdUsuario, PDO::PARAM_STR);
        $stmt->bindParam(':nombre_usuario', $StrNombreUsuario, PDO::PARAM_STR);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    //Editar las fechas de la programacion diaria
    public function fntEditarProgramacionTodoClienteBool($intId, $intIdPedido, $intIdProducto, $strNombreProducto, $intIdLineaDespacho, $StrNombreLineaDespacho, $dtmHoraCargue, $dtmHoraMixerObra, $intIdMixer, $StrPlacaMixer, $intIdConductor, $StrNombreConductor, $decCantidad, $bolRequiereBomba, $intTipoDescargue, $StrNombreTipoDescargue, $intTipoBomba, $StrNombreTipoBomba, $StrObservaciones, $dtmFechaInicio, $dtmFechaFin, $dtmHoy, $intIdUsuario, $StrNombreUsuario)
    {
        $sql = "UPDATE `ct66_programacion_diaria` SET `id_pedido`= :id_pedido, `id_producto`= :id_producto, `nombre_producto`= :nombre_producto, `cantidad`= :cantidad, `id_linea_produccion`= :id_linea_produccion, `nombre_linea_produccion`= :nombre_linea_produccion, `hora_cargue`= :hora_cargue, `hora_mixer_obra`= :hora_mixer_obra, `id_mixer`= :id_mixer, `mixer`= :mixer, `id_conductor`= :id_conductor, `nombre_conductor`= :nombre_conductor, `requiere_bomba`= :requiere_bomba, `id_tipo_descargue`= :id_tipo_descargue, `nombre_tipo_descargue`= :nombre_tipo_descargue, `id_tipo_bomba`= :id_tipo_bomba,`tipo_bomba`= :tipo_bomba, `fecha_ini`= :fecha_ini, `fecha_fin`= :fecha_fin,`observaciones`= :observaciones, `id_usuario_edit`= :id_usuario, `nombre_usuario_edit`= :nombre_usuario, `fecha_modificacion`= :fecha_modificacion WHERE `id` = :id_programacion";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':id_pedido', $intIdPedido, PDO::PARAM_STR);
        $stmt->bindParam(':id_producto', $intIdProducto, PDO::PARAM_STR);
        $stmt->bindParam(':nombre_producto', $strNombreProducto, PDO::PARAM_STR);
        $stmt->bindParam(':cantidad', $decCantidad, PDO::PARAM_INT);
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
        $stmt->bindParam(':observaciones', $StrObservaciones, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_ini', $dtmFechaInicio, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_fin', $dtmFechaFin, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_modificacion', $dtmHoy, PDO::PARAM_STR);
        $stmt->bindParam(':id_programacion', $intId, PDO::PARAM_STR);
        $stmt->bindParam(':id_usuario', $intIdUsuario, PDO::PARAM_STR);
        $stmt->bindParam(':nombre_usuario', $StrNombreUsuario, PDO::PARAM_STR);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    //Editar las fechas de la programacion diaria
    public function fntEditarProgramacionBool($id_programacion, $start, $end, $fecha_modificacion, $id_usuario, $nombre_usuario)
    {
        $sql = "UPDATE `ct66_programacion_diaria` 
         SET `fecha_ini`= :inicio ,`fecha_fin`= :fin, `fecha_modificacion` = :fecha_modificacion, `id_usuario_edit` = :id_usuario, `nombre_usuario_edit` = :nombre_usuario 
         WHERE `id` = :id_programacion";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        // Asignando Datos ARRAY => SQL
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
    /////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////SELECT - OBTENER NOMBRES///////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////
    // Traer el nombre del estado
    public function fntGetNombreEstadoObj($id_estado)
    {
        $this->id = $id_estado;
        // sentencia SQL
        $sql = "SELECT * FROM `ct66_estado_programacion` WHERE `id` =  :id_estado";
        // Preparar Conexion
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_estado', $this->id, PDO::PARAM_INT);
        // ejecuta la sentencia SQL
        if ($stmt->execute()) {
            $num_reg = $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    return $fila['descripcion'];
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    // Traer el nombre del estado
    public function fntGetFechaVencimientoPedidoObj($id_pedido)
    {
        $this->id = $id_pedido;
        // sentencia SQL
        $sql = "SELECT `fecha_vencimiento` FROM `ct65_pedidos` WHERE `id` = :id_pedido";
        // Preparar Conexion
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_pedido', $this->id, PDO::PARAM_INT);
        // ejecuta la sentencia SQL
        if ($stmt->execute()) {
            $num_reg = $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    return $fila['fecha_vencimiento'];
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
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
    // Traer el nombre del obra.
    public function fntGetNombreObraObj($id_obra)
    {
        $this->id = $id_obra;
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
    // Traer el nombre del producto.
    public function fntGetNombreProductoObj($id_producto)
    {
        $this->id = $id_producto;
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
    public function fntGetNombreTipoDescargueObj($id_tipo_descargue)
    {
        $this->id = $id_tipo_descargue;
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
    // Traer el nombre del tipo de descargue.
    public function fntGetNombreLineaDespachoObj($id_tipo_despacho)
    {
        $this->id = $id_tipo_despacho;
        $sql = "SELECT `id`, `descripcion` 
        FROM `ct66_linea_despacho` 
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
    // Traer el nombre del tipo de descargue.
    public function fntGetPlacaMixerObj($id_mixer)
    {
        $this->id = $id_mixer;
        $sql = "SELECT `ct10_Placa` 
        FROM `ct10_vehiculo` 
        WHERE `ct10_IdVehiculo` =  :id";
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
    // Traer el nombre del tipo de bomba.
    public function fntGetNombreTipoBombaObj($id_tipo_bomba)
    {
        $this->id = $id_tipo_bomba;
        $sql = "SELECT `ct50_id_tipo_bomba`,`ct50_nombre_tipo_bomba` 
        FROM `ct50_tipo_bomba` 
        WHERE `ct50_id_tipo_bomba` =  :id";
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
    /////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////DELETE - ELIMINAR PROGRAMACION/////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////
    //Eliminar una programacion.
    function fntEliminarProgramacionDiariaObj($id_programacion)
    {
        $sql = "DELETE FROM `ct66_programacion_diaria` WHERE `id` = :id_programacion";
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
    /////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////SELECT - INFORME EXCEL/////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////
    // Obtener todas las programaciones (FUNCIONARIO).
    public function fntGetProgDiariaInformeObj($fecha_ini, $fecha_fin)
    {
        $this->fecha_ini = $fecha_ini;
        $this->fecha_fin = $fecha_fin;

        $sql = "SELECT * FROM `ct66_programacion_diaria` WHERE `fecha_ini` BETWEEN :fecha_ini AND :fecha_fin";
        // Preparar Conexion.
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':fecha_ini', $this->fecha_ini, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_fin', $this->fecha_fin, PDO::PARAM_STR);
        // Asignando Datos ARRAY => SQL.
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    // Obtener los datos de los valores.
                    $datos['id'] = $fila['id'];
                    $datos['status'] = SELF::fntGetNombreEstadoObj($fila['status']);
                    $datos['nombre_cliente'] = $fila['nombre_cliente'];
                    $datos['nombre_obra'] = $fila['nombre_obra'];
                    $datos['fecha_pedido'] = SELF::fntGetFechaVencimientoPedidoObj($fila['id_pedido']);
                    $datos['nombre_producto'] = $fila['nombre_producto'];
                    $datos['cantidad'] = $fila['cantidad'];
                    $datos['valor_programacion'] = $fila['valor_programacion'];
                    $datos['nombre_linea_produccion'] = $fila['nombre_linea_produccion'];
                    $datos['hora_cargue'] = $fila['hora_cargue'];
                    $datos['hora_mixer_obra'] = $fila['hora_mixer_obra'];
                    $datos['mixer'] = $fila['mixer'];
                    $datos['nombre_conductor'] = $fila['nombre_conductor'];
                    if ($fila['requiere_bomba']) {
                        $datos['requiere_bomba'] = "Si requiere";
                    } else {
                        $datos['requiere_bomba'] = "No requiere";
                    }
                    $datos['id_tipo_descargue'] = $fila['id_tipo_descargue'];
                    $datos['nombre_tipo_descargue'] = $fila['nombre_tipo_descargue'];
                    $datos['tipo_bomba'] = $fila['tipo_bomba'];
                    $datos['metros_tuberia'] = $fila['metros_tuberia'];
                    $datos['fecha_ini'] = $fila['fecha_ini'];
                    $datos['fecha_fin'] = $fila['fecha_fin'];
                    $datos['elementos_fundir'] = $fila['elementos_fundir'];
                    $datos['observaciones'] = $fila['observaciones'];
                    $datos['id_usuario'] = $fila['id_usuario'];
                    $datos['nombre_usuario'] = $fila['nombre_usuario'];
                    $datos['fecha_creacion'] = $fila['fecha_creacion'];
                    $datosf[] = $datos;
                }
                return $datosf;
            }
        }
        return false;
    }
}
