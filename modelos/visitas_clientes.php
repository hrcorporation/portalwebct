<?php
class visitas_clientes extends conexionPDO
{
    public $con; // variable de conexion a la base de datos

    // Conexcion y a la base de datos
    public function __construct()
    {
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
        date_default_timezone_set('America/Bogota');
    }

    public function eliminar_visita($id_visita)
    {
        $sql = "DELETE FROM `visitas_clientes` WHERE `id` = :id_visita";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':id_visita', $id_visita, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }


    public function crear_vista_cliente($fecha, $id_tipo_visita, $tipo_visita, $id_cliente, $nombre_cliente, $id_obra, $nombre_obra, $obs)
    {
        $sql = "INSERT INTO `visitas_clientes`( `fecha`, `id_tipo_visita`, `tipo_visita`, `id_cliente`, `nombre_cliente`, `id_obra`, `nombre_obra`, `observaciones`) VALUES (:fecha, :id_tipo_visita, :tipo_visita, :id_cliente, :nombre_cliente, :id_obra, :nombre_obra, :obs)";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':fecha', $fecha, PDO::PARAM_INT);
        $stmt->bindParam(':id_tipo_visita', $id_tipo_visita, PDO::PARAM_INT);
        $stmt->bindParam(':tipo_visita', $tipo_visita, PDO::PARAM_STR);
        $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_cliente', $nombre_cliente, PDO::PARAM_STR);
        $stmt->bindParam(':id_obra', $id_obra, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_obra', $nombre_obra, PDO::PARAM_STR);
        $stmt->bindParam(':obs', $obs, PDO::PARAM_STR);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function select_tipo_visita($id_tipo_visita =  null)
    {
        $selection = "";
        $option = "<option  selected='true' disabled='disabled'> Seleccione tipo visita</option>";
        $sql = "SELECT `id`, `descripcion` FROM `tipo_visitas_clientes` ";

        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        //$stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    if ($id_tipo_visita == $fila['id']) {
                        $selection = "selected='true'";
                    } else {
                        $selection  = "";
                    }
                    $option .= '<option value="' . $fila['id'] . '" ' . $selection . ' >' .  $fila['descripcion']  . ' </option>';
                }
            } else {
                $option .= "<option  selected='true' disabled='disabled'> No hay datos </option>";
            }
        } else {
            $option .= "<option  selected='true' disabled='disabled'> Error al cargar </option>";
        }
        //resultado
        return $option;
        //Cerrar Conexion
        $this->PDO->closePDO();
    }

    public function get_nombre_cliente($id)
    {
        $this->id = $id;
        $sql = "SELECT `ct1_IdTerceros`, `ct1_RazonSocial` FROM `ct1_terceros` WHERE `ct1_IdTerceros` = :id";
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
    public function get_nombre_tipo_visita($id)
    {
        $this->id = $id;
        $sql = "SELECT `id`, `descripcion` FROM `tipo_visitas_clientes` WHERE `id` = :id";
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

    public function visitas_x_clientes($id_cliente)
    {
        $this->id = $id_cliente;
        $sql = "SELECT id,`fecha`, `id_tipo_visita`, `tipo_visita`, `id_cliente`, `nombre_cliente`, `id_obra`, `nombre_obra`, `observaciones` FROM `visitas_clientes` WHERE `id_cliente` = :id";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos[] = $fila;
                }
                return $datos;
            } else {
                return false;
            }
        } else {
            return false;
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
    }
}
