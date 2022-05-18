<?php

class programacion extends conexionPDO
{
    protected $con;
    // Iniciar Conexion
    public function __construct()
    {
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
    }
    public function crear_toda_prog_semanal($titulo, $id_cliente, $id_obra,  $id_pedido, $id_producto,  $cantidad, $fecha_ini, $fecha_fin)
    {
        $estado = 1;
        $nombrecliente = SELF::get_nombre_cliente($this->con, $id_cliente);
        $nombre_obra = SELF::get_nombre_obra($this->con, $id_obra);
        $nombre_producto = SELF::get_nombre_producto($this->con, $id_producto);
        $sql = "INSERT INTO `ct66_prog_semanal`(`titulo`, `status`, `id_cliente`, `nombre_cliente`, `id_obra`, `nombre_obra`, `id_pedido`, `id_producto`, `nombre_producto`, `cantidad`, `fecha_ini`, `fecha_fin`) VALUES (:titulo, :estado, :id_cliente, :nombrecliente, :id_obra, :nombre_obra, :id_pedido, :id_producto, :nombre_producto :cantidad, :fecha_ini, fecha_fin)";

        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':titulo', $titulo, PDO::PARAM_STR);
        $stmt->bindParam(':estado', $estado, PDO::PARAM_INT);
        $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
        $stmt->bindParam(':nombrecliente', $nombrecliente, PDO::PARAM_STR);
        $stmt->bindParam(':id_obra', $id_obra, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_obra', $nombre_obra, PDO::PARAM_STR);
        $stmt->bindParam(':id_pedido', $id_pedido, PDO::PARAM_INT);
        $stmt->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_producto', $nombre_producto, PDO::PARAM_STR);
        $stmt->bindParam(':cantidad', $cantidad, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_ini', $fecha_ini, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_fin', $fecha_fin, PDO::PARAM_STR);
        if ($result = $stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * Trae la programacion semanal
     */
    public function get_prog_semanal()
    {
        $sql = "SELECT `id`, `status`, `id_cliente`, `nombre_cliente`, `id_obra`, `nombre_obra`, `id_pedido`, `id_producto`, `nombre_producto`, `cantidad`, `fecha_ini`, `fecha_fin` FROM `ct66_prog_semanal`";
        //$sql="SELECT `id`, `titulo`, `inicio`, `fin` FROM `eventos`";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        // Asignando Datos ARRAY => SQ
        //$stmt->bindParam(':id_remision', $this->id_remision, PDO::PARAM_INT);
        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $events[] = [
                        "id" => $fila['id'],
                        'title' => $fila['nombre_cliente'] . " - " . $fila['nombre_obra'] . ' || ',
                        'descrition' => $fila['nombre_producto'] . " - " . $fila['cantidad'] . ' M3 ',
                        'start' => $fila['fecha_ini'],
                        'end' => $fila['fecha_fin'],
                        'color' => 'orange',
                        'textcolor' => 'black'
                    ];
                }
                return $events;
            }
        }
        return false;
    }
    /****
     * OTROS
     */
    /**** OPTION SELECT PRODUCTO ********/
    function option_producto_edit($id_producto = null)
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

    /**** OPTION SELECT OBRA ********/
    function option_obra_edit($id_cliente, $id_obra = null)
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

    /**** OPTION SELECT  CLIENTE********/
    function option_cliente_edit($id_cliente = null)
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
    // Traer el nombre del producto
    public static function  get_nombre_producto($con, $id_producto)
    {
        $sql = "SELECT ct4_Nombre,ct4_Descripcion  FROM ct4_productos WHERE ct4_Id_productos = :id_producto";
        $stmt = $con->prepare($sql);
        $stmt->bindPararm(':id_producto', $id_producto, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $num_reg = $stmt->rowCount(); // Calcula la cantidad de registros de la consulta sql
            while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                return $fila['ct4_Nombre'];
            }
        } else {
            return false;
        }
    }
    // Traer el nombre del obra
    public static function  get_nombre_obra($con, $id_obra)
    {
        $sql = "SELECT ct5_NombreObra FROM ct5_obras WHERE ct5_IdObras = :id_obra";
        $stmt = $con->prepare($sql);
        $stmt->bindPararm(':id_obra', $id_obra, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $num_reg = $stmt->rowCount(); // Calcula la cantidad de registros de la consulta sql
            while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                return $fila['ct5_NombreObra'];
            }
        } else {
            return false;
        }
    }
    // Traer el nombre del cliente 
    public static function get_nombre_cliente($con, $id_cliente)
    {
        // sentencia SQL
        $sql = "SELECT ct1_RazonSocial FROM ct1_terceros WHERE ct1_IdTerceros = :id_cliente";
        // Preparar Conexion
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
        // ejecuta la sentencia SQL
        if ($result = $stmt->execute()) {
            $num_reg = $stmt->rowCount();
            while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                return $fila['ct1_RazonSocial'];
            }
        } else {
            return false;
        }
    }
    function crear_programacion($titulo, $id_cliente, $nombre_cliente, $id_obra, $nombre_obra, $id_producto, $nombre_producto, $cantidad, $inicio, $fin)
    {
        $sql = "INSERT INTO `ct66_prog_semanal`(`titulo`, `id_cliente`, `nombre_cliente`, `id_obra`, `nombre_obra`, `id_producto`, `nombre_producto`, `cantidad`, `fecha_ini`, `fecha_fin`) VALUES (:titulo, :id_cliente, :nombre_cliente, :id_obra, :nombre_obra, :id_producto, :nombre_producto, :cantidad, :fecha_ini, :fecha_fin)";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        // Asignando Datos ARRAY => SQ
        $stmt->bindParam(':titulo', $titulo, PDO::PARAM_STR);
        $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_STR);
        $stmt->bindParam(':nombre_cliente', $nombre_cliente, PDO::PARAM_STR);
        $stmt->bindParam(':id_obra', $id_obra, PDO::PARAM_STR);
        $stmt->bindParam(':nombre_obra', $nombre_obra, PDO::PARAM_STR);
        $stmt->bindParam(':id_producto', $id_producto, PDO::PARAM_STR);
        $stmt->bindParam(':nombre_producto', $nombre_producto, PDO::PARAM_STR);
        $stmt->bindParam(':cantidad', $cantidad, PDO::PARAM_STR);
        $stmt->bindParam(':inicio', $inicio, PDO::PARAM_STR);
        $stmt->bindParam(':fin', $fin, PDO::PARAM_STR);
        if ($result = $stmt->execute()) {
            return true;
        }
        return false;
    }
}
