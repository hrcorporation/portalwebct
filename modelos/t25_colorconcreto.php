<?php
class t25_colorconcreto extends conexionPDO
{
    // Iniciar Conexion
    public function __construct()
    {
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
    }


    function crear_color_concreto($ct25_CodConcreto, $ct25_DescripcionCC)
    {
        $this->fecha_create = date("Y-m-d H:i:s");
        $this->estado = 1;
        $this->ct25_CodConcreto = $ct25_CodConcreto;
        $this->ct25_DescripcionCC = $ct25_DescripcionCC;

        $sql = "INSERT INTO `ct25_colorconcreto`(`ct25_FechaCreacion`, `ct25_Estado`, `ct25_CodConcreto`, `ct25_DescripcionCC`) VALUES  (:ct25_FechaCreacion, :ct25_Estado, :ct25_CodConcreto, :ct25_DescripcionCC)";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':ct25_FechaCreacion', $this->fecha_create, PDO::PARAM_STR);
        $stmt->bindParam(':ct25_Estado', $this->estado, PDO::PARAM_INT);
        $stmt->bindParam(':ct25_CodConcreto', $this->ct25_CodConcreto, PDO::PARAM_STR);
        $stmt->bindParam(':ct25_DescripcionCC', $this->ct25_DescripcionCC, PDO::PARAM_STR);

        $result = $stmt->execute();
        //Cerrar Conexion
        $this->PDO->closePDO();

        return $result;
    }
    function modificar_color_concreto($id, $ct25_CodConcreto, $ct25_DescripcionCC)
    {
        $this->ct25_CodConcreto = $ct25_CodConcreto;
        $this->ct25_DescripcionCC = $ct25_DescripcionCC;
        $this->id = $id;

        $sql = "UPDATE `ct25_colorconcreto` SET `ct25_CodConcreto`= :ct25_CodConcreto,`ct25_DescripcionCC`= :ct25_DescripcionCC WHERE `ct25_IdColorC` = :id";

        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':ct25_CodConcreto', $this->ct25_CodConcreto, PDO::PARAM_STR);
        $stmt->bindParam(':ct25_DescripcionCC', $this->ct25_DescripcionCC, PDO::PARAM_STR);
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
    function eliminar_color_concreto($id)
    {
        $this->id = $id;
        $sql = "DELETE FROM `ct25_colorconcreto` WHERE `ct25_IdColorC` = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }

        // Devolver el ultimo Registro insertado
        //$id_insert = $this->con->lastInsertId();
        //Cerrar Conexion
        $this->PDO->closePDO();
    }
    function get_datatable_color_concreto()
    {
        $sql = "SELECT `ct25_IdColorC`, `ct25_FechaCreacion`, `ct25_Estado`, `ct25_CodConcreto`, `ct25_DescripcionCC` FROM `ct25_colorconcreto`";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Ejecutar 
        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id'] = $fila['ct25_IdColorC'];
                    $datos['cod'] = $fila['ct25_CodConcreto'];
                    $datos['descripcion'] = $fila['ct25_DescripcionCC'];
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
    function get_colorconcreto_id($id)
    {
        $this->id = $id;
        $sql = "SELECT `ct25_IdColorC`, `ct25_CodConcreto`, `ct25_DescripcionCC` FROM `ct25_colorconcreto` WHERE `ct25_Estado` = 1 AND `ct25_IdColorC` = :id ORDER BY `ct25_IdColorC` DESC";
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




    function get_colorconcreto()
    {
        $sql = "SELECT `ct25_IdColorC`, `ct25_CodConcreto`, `ct25_DescripcionCC` FROM `ct25_colorconcreto` WHERE `ct25_Estado` = 1 ORDER BY `ct25_IdColorC` DESC";
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
