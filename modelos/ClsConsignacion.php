<?php

class clsConsignacion extends conexionPDO
{
    protected $con;
    // Iniciar Conexion
    public function __construct()
    {
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////SELECT - OBTENER NOMBRES////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////
    // Traer el nombre del estado de la consignacion mediante el "id" de la consignacion.
    function fntGetEstadoObj($id_estado)
    {
        $this->id = $id_estado;
        // sentencia SQL
        $sql = "SELECT `id`,`descripcion` 
        FROM `ct66_estado_consignacion` 
        WHERE `id` = :id";
        // Preparar Conexion
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
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
    // Traer el nombre del cliente mediante el "ct1_IdTerceros" del Cliente(Tercero).
    function fntGetNombreClienteObj($id_cliente)
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
        $stmt->bindParam(':nombre', $this->id, PDO::PARAM_INT);
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
    // Traer el nombre del banco.
    function fntGetBancoObj($id_banco)
    {
        $this->id = $id_banco;
        // sentencia SQL
        $sql = "SELECT `id`,`descripcion` 
        FROM `ct66_bancos` 
        WHERE `id` = :id";
        // Preparar Conexion
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
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
    //Traer el id del banco
    function fntGetIdBancoObj($nombre_banco)
    {
        $this->id = $nombre_banco;
        // sentencia SQL
        $sql = "SELECT `id`
        FROM `ct66_bancos` 
        WHERE `descripcion`  = :nombre";
        // Preparar Conexion
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':nombre', $this->id, PDO::PARAM_STR);
        // ejecuta la sentencia SQL
        if ($stmt->execute()) {
            $num_reg = $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    return $fila['id'];
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////SELECT - LISTAR DATOS REQUERIDOS PARA CREAR UNA CONSIGNACION///////
    /////////////////////////////////////////////////////////////////////////////////////////////////////
    // Listar mediante un select los clientes(Terceros).
    function fntOptionClienteEditObj($id_cliente = null)
    {
        $option = "<option  selected='true' disabled='disabled'> Seleccione un Cliente</option>";
        //Consulta SQL
        $sql = "SELECT ct1_IdTerceros , ct1_NumeroIdentificacion , ct1_RazonSocial 
        FROM ct1_terceros 
        WHERE ct1_TipoTercero = 1 AND ct1_Estado = 1";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        // Asignando Datos ARRAY => SQL
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
    // Listar mediante un select los bancos.
    function fntOptionBancosObj($id_banco = null)
    {
        $this->id = $id_banco;
        $option = "<option> Seleccione el banco </option>";
        //Consulta SQL
        $sql = "SELECT * FROM `ct66_bancos`";
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
                $option = "<option  selected='true' disabled='disabled'> Error al cargar los bancos </option>";
            }
        } else {
            $option = "<option  selected='true' disabled='disabled'> Error al cargar datos </option>";
        }

        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        return $option;
    }
    // Listar mediante un select los estados.
    function fntOptionEstadosObj($id_estado = null)
    {
        $this->id = $id_estado;
        $option = "<option> Seleccione el estado</option>";
        $sql = "SELECT * FROM `ct66_estado_consignacion`";
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
    //////////////////////////////////SELECT - OBTENER CONSIGNACIONES////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////
    // Listar todas las consignaciones.
    public function fntGetConsignacionesObj()
    {
        //Consulta SQL
        $sql = "SELECT `id`, `estado`, `fecha_consignacion`, `id_banco`, `nombre_banco`, `valor`, `id_cliente`, `nombre_cliente`, `observaciones` 
        FROM `ct66_consignacion`";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                // Obtener los datos de los valores
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $datos['id'] = $fila['id'];
                    switch ($fila['estado']) {
                        case 1:
                            $datos['estado'] = " <span class='badge  badge-warning > float-right'> SIN CONFIRMAR </span> ";
                            break;
                        case 2:
                            $datos['estado'] = " <span class='badge  badge-success > float-right'> CONFIRMADO </span> ";
                            break;
                        default:
                            $datos['estado'] = " <span class='badge  badge-info > float-right'>  </span> ";
                            break;
                    }
                    $datos['fecha_consignacion'] = $fila['fecha_consignacion'];
                    $datos['nombre_banco'] = $fila['nombre_banco'];
                    $datos['valor'] = number_format($fila['valor'], 2);
                    $datos['nombre_cliente'] = $fila['nombre_cliente'];
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
    // Listar todos los datos de la consignacion mediante el id
    public function fntGetConsignacionesPorid($id_consignacion)
    {
        $sql = "SELECT * FROM `ct66_consignacion` WHERE `id` = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id', $id_consignacion, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                // Obtener los datos de los valores
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $datos['id'] = $fila['id'];
                    $datos['estado'] = $fila['estado'];
                    $datos['fecha_consignacion'] = $fila['fecha_consignacion'];
                    $datos['id_banco'] = $fila['id_banco'];
                    $datos['valor'] = $fila['valor'];
                    $datos['id_cliente'] = $fila['id_cliente'];
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
    /////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////CREATE - CREAR CONSIGNACION////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////
    // Crear una consignacion.
    public function fntCrearConsignacionObj($dtmFechaConsignacion, $intIdBanco, $StrBanco, $dblValorConsignacion, $intIdEstado,  $intIdCliente, $StrNombreCliente, $StrObservaciones, $intIdUsuario, $StrNombreUsuario)
    {
        $sql = "INSERT INTO `ct66_consignacion`(`estado`, `fecha_consignacion`, `id_banco`, `nombre_banco`, `valor`, `id_cliente`, `nombre_cliente`, `observaciones`, `id_usuario`, `nombre_usuario`) 
        VALUES (:estado, :fecha_consignacion, :id_banco, :nombre_banco, :valor, :id_cliente, :nombre_cliente, :observaciones, :id_usuario, :nombre_usuario)";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':fecha_consignacion', $dtmFechaConsignacion, PDO::PARAM_STR);
        $stmt->bindParam(':id_banco', $intIdBanco, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_banco', $StrBanco, PDO::PARAM_STR);
        $stmt->bindParam(':valor', $dblValorConsignacion, PDO::PARAM_STR);
        $stmt->bindParam(':estado', $intIdEstado, PDO::PARAM_INT);
        $stmt->bindParam(':id_cliente', $intIdCliente, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_cliente', $StrNombreCliente, PDO::PARAM_STR);
        $stmt->bindParam(':observaciones', $StrObservaciones, PDO::PARAM_STR);
        $stmt->bindParam(':id_usuario', $intIdUsuario, PDO::PARAM_STR);
        $stmt->bindParam(':nombre_usuario', $StrNombreUsuario, PDO::PARAM_STR);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    // Crear una consignacion.
    public function fntCrearConsignacionPorImportarObj($intIdEstado, $dtmFechaConsignacion, $intIdBanco, $StrBanco, $dblValorConsignacion, $intIdCliente, $StrNombreCliente, $StrObservaciones, $intIdUsuario, $StrNombreUsuario)
    {
        $sql = "INSERT INTO `ct66_consignacion`(`estado`, `fecha_consignacion`,  `id_banco`, `nombre_banco`, `valor`, `id_cliente`, `nombre_cliente`, `observaciones`, `id_usuario`, `nombre_usuario`) 
        VALUES (:estado, :fecha_consignacion, :id_banco, :nombre_banco, :valor, :id_cliente, :nombre_cliente, :observaciones, :id_usuario, :nombre_usuario)";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':fecha_consignacion', $dtmFechaConsignacion, PDO::PARAM_STR);
        $stmt->bindParam(':id_banco', $intIdBanco, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_banco', $StrBanco, PDO::PARAM_STR);
        $stmt->bindParam(':valor', $dblValorConsignacion, PDO::PARAM_STR);
        $stmt->bindParam(':estado', $intIdEstado, PDO::PARAM_INT);
        $stmt->bindParam(':id_cliente', $intIdCliente, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_cliente', $StrNombreCliente, PDO::PARAM_STR);
        $stmt->bindParam(':observaciones', $StrObservaciones, PDO::PARAM_STR);
        $stmt->bindParam(':id_usuario', $intIdUsuario, PDO::PARAM_STR);
        $stmt->bindParam(':nombre_usuario', $StrNombreUsuario, PDO::PARAM_STR);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    } /////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////UPDATE - EDITAR CONSIGNACION/////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////
    public function fntEditarConsignacionObj($intId, $intIdEstado, $dtmFechaConsignacion, $intIdBanco, $StrBanco, $dblValorConsignacion, $intIdCliente, $StrNombreCliente, $StrObservaciones, $intIdUsuario, $StrNombreUsuario, $dtmFecha)
    {
        $sql = "UPDATE `ct66_consignacion` SET `estado`= :estado, `fecha_consignacion`= :fecha_consignacion, `id_banco`= :id_banco, `nombre_banco`= :nombre_banco, `valor`= :valor, `id_cliente`= :id_cliente, `nombre_cliente`= :nombre_cliente, `observaciones`= :observaciones, `id_usuario_edit`= :id_usuario, `nombre_usuario_edit`= :nombre_usuario,`fecha_modificacion`= :fecha_modificacion WHERE `id` = :id";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id', $intId, PDO::PARAM_INT);
        $stmt->bindParam(':estado', $intIdEstado, PDO::PARAM_INT);
        $stmt->bindParam(':fecha_consignacion', $dtmFechaConsignacion, PDO::PARAM_STR);
        $stmt->bindParam(':id_banco', $intIdBanco, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_banco', $StrBanco, PDO::PARAM_STR);
        $stmt->bindParam(':valor', $dblValorConsignacion, PDO::PARAM_STR);
        $stmt->bindParam(':id_cliente', $intIdCliente, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_cliente', $StrNombreCliente, PDO::PARAM_STR);
        $stmt->bindParam(':observaciones', $StrObservaciones, PDO::PARAM_STR);
        $stmt->bindParam(':id_usuario', $intIdUsuario, PDO::PARAM_STR);
        $stmt->bindParam(':nombre_usuario', $StrNombreUsuario, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_modificacion', $dtmFecha, PDO::PARAM_STR);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////DELETE - ELIMINAR CONSIGNACION/////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////
    // Eliminar una programacion. eliminar_programacion_semanal
    public function fntEliminarConsignacionObj($id_consignacion)
    {
        $sql = "DELETE FROM `ct66_consignacion` WHERE `id` = :id_consignacion";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':id_consignacion', $id_consignacion, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
