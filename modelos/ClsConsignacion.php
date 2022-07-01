<?php

class ClsConsignacion extends conexionPDO
{
    protected $con;
    // Iniciar Conexion
    public function __construct()
    {
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////SELECT - OBTENER NOMBRE////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////
    // Traer el nombre del estado de la consignacion mediante el "id" de la consignacion.
    function fntGetEstadoObj($id)
    {
        $this->id = $id;
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
    // Traer el nombre del banco.
    function fntGetBancoObj($id)
    {
        $this->id = $id;
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
    function fntOptionBancosObj($id = null)
    {
        $this->id = $id;
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
    // Listar mediante un select los estados.
    function fntOptionEstadosObj($id = null)
    {
        $this->id = $id;
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
                    $datos['estado'] = SELF::fntGetEstadoObj($fila['estado']);
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
    /////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////CREATE - CREAR CONSIGNACION////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////
    // Crear una consignacion.
    function fntCrearConsignacionObj($dtmFechaConsignacion, $intIdBanco, $StrBanco, $dblValorConsignacion, $intIdEstado,  $intIdCliente, $StrNombreCliente, $StrObservaciones, $intIdUsuario, $StrNombreUsuario)
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
}
