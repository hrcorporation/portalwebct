<?php
class t23_tamano_agregado extends conexionPDO
{


    // Iniciar Conexion
    public function __construct()
    {
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
    }

    function crear_tamano_agregado_concreto($ct23_CodTAC, $ct23_DescripcionTAC)
    {
        $this->fecha_create = date("Y-m-d H:i:s");
        $this->estado = 1;
        $this->ct23_CodTAC = $ct23_CodTAC;
        $this->ct23_DescripcionTAC = $ct23_DescripcionTAC;

        $sql = "INSERT INTO `ct23_tamanoagregadoconcreto`(`ct23_FechaCreacion`, `ct23_estado`, `ct23_CodTAC`, `ct23_DescripcionTAC`) VALUES (:ct23_FechaCreacion, :ct23_estado, :ct23_CodTAC, :ct23_DescripcionTAC)";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':ct23_FechaCreacion', $this->fecha_create, PDO::PARAM_STR);
        $stmt->bindParam(':ct23_estado', $this->estado, PDO::PARAM_INT);
        $stmt->bindParam(':ct23_CodTAC', $this->ct23_CodTAC, PDO::PARAM_STR);
        $stmt->bindParam(':ct23_DescripcionTAC', $this->ct23_DescripcionTAC, PDO::PARAM_STR);

        $result = $stmt->execute();
        //Cerrar Conexion
        $this->PDO->closePDO();

        return $result;
    }
    function modificar_tamano_agregado($id, $ct23_CodTAC, $ct23_DescripcionTAC)
    {
        $this->ct23_CodTAC = $ct23_CodTAC;
        $this->ct23_DescripcionTAC = $ct23_DescripcionTAC;
        $this->id = $id;

        $sql = "UPDATE `ct23_tamanoagregadoconcreto` SET `ct23_CodTAC`= :ct23_CodTAC,`ct23_DescripcionTAC`= :ct23_DescripcionTAC WHERE `ct23_IdTAC` = :id";

        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':ct23_CodTAC', $this->ct23_CodTAC, PDO::PARAM_STR);
        $stmt->bindParam(':ct23_DescripcionTAC', $this->ct23_DescripcionTAC, PDO::PARAM_STR);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

        // Ejecutar 
        $result = $stmt->execute();

        // Devolver el ultimo Registro insertado
        //$id_insert = $this->con->lastInsertId();
        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        return $result;
    }

    function get_datatable_tamano_agregado_concreto()
    {
        $sql = "SELECT `ct23_IdTAC`, `ct23_FechaCreacion`, `ct23_estado`, `ct23_CodTAC`, `ct23_DescripcionTAC` FROM `ct23_tamanoagregadoconcreto`";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Ejecutar 
        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id'] = $fila['ct23_IdTAC'];
                    $datos['cod'] = $fila['ct23_CodTAC'];
                    $datos['descripcion'] = $fila['ct23_DescripcionTAC'];
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
    function get_tamano_agregado_concre_id($id)
    {
        $this->id = $id;
        $sql = "SELECT `ct23_IdTAC`, `ct23_CodTAC`, `ct23_DescripcionTAC` FROM `ct23_tamanoagregadoconcreto` WHERE `ct23_estado` = 1 AND ct23_IdTAC = :id ORDER BY `ct23_IdTAC` DESC";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

        // Ejecutar 
        if ($result = $stmt->execute()) {
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


    function get_tamano_agregado_concre()
    {
        $sql = "SELECT `ct23_IdTAC`, `ct23_CodTAC`, `ct23_DescripcionTAC` FROM `ct23_tamanoagregadoconcreto` WHERE `ct23_estado` = 1 ORDER BY `ct23_IdTAC` DESC";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        //$stmt->bindParam(':id_obra', $this->id, PDO::PARAM_INT);

        // Ejecutar 
        if ($result = $stmt->execute()) {
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
