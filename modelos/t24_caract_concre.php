<?php
class t24_caract_concre extends conexionPDO
{
    // Iniciar Conexion
    public function __construct()
    {
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
    }

    function get_datatable_caracteristica_concreto(){
        $sql = "SELECT `ct24_IdCC`, `ct24_FechaCreacion`, `ct24_estado`, `ct24_CodCC`, `ct24_DescripcionCC` FROM `ct24_caracteristicaconcreto`";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Ejecutar 
        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id'] = $fila['ct24_IdCC'];
                    $datos['cod'] = $fila['ct24_CodCC'];
                    $datos['descripcion'] = $fila['ct24_DescripcionCC'];
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
    function crear_caracteristica_concreto($ct24_CodCC, $ct24_DescripcionCC){
        $this->fecha_create = date("Y-m-d H:i:s");
        $this->estado = 1;
        $this->ct24_CodCC = $ct24_CodCC;
        $this->ct24_DescripcionCC = $ct24_DescripcionCC;

        $sql = "INSERT INTO `ct24_caracteristicaconcreto`(`ct24_FechaCreacion`, `ct24_estado`, `ct24_CodCC`, `ct24_DescripcionCC`) VALUES  (:ct24_FechaCreacion, :ct24_estado, :ct24_CodCC, :ct24_DescripcionCC)";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':ct24_FechaCreacion', $this->fecha_create, PDO::PARAM_STR);
        $stmt->bindParam(':ct24_estado', $this->estado, PDO::PARAM_INT);
        $stmt->bindParam(':ct24_CodCC', $this->ct24_CodCC, PDO::PARAM_STR);
        $stmt->bindParam(':ct24_DescripcionCC', $this->ct24_DescripcionCC, PDO::PARAM_STR);

        $result = $stmt->execute();
        //Cerrar Conexion
        $this->PDO->closePDO();

        return $result;
    }
    function modificar_caracteristica_concreto($id, $ct24_CodCC, $ct24_DescripcionCC)
    {
        $this->ct24_CodCC = $ct24_CodCC;
        $this->ct24_DescripcionCC = $ct24_DescripcionCC;
        $this->id = $id;

        $sql = "UPDATE `ct24_caracteristicaconcreto` SET `ct24_CodCC`= :ct24_CodCC,`ct24_DescripcionCC`= :ct24_DescripcionCC WHERE `ct24_IdCC` = :id";

        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':ct24_CodCC', $this->ct24_CodCC, PDO::PARAM_STR);
        $stmt->bindParam(':ct24_DescripcionCC', $this->ct24_DescripcionCC, PDO::PARAM_STR);
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
    function get_caract_concre_id($id)
    {
        $this->id = $id;
        $sql = "SELECT `ct24_IdCC`,`ct24_CodCC`, `ct24_DescripcionCC` FROM `ct24_caracteristicaconcreto` WHERE `ct24_estado`  = 1  AND `ct24_IdCC` = :id ORDER BY `ct24_IdCC` DESC";
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


    function get_caract_concre()
    {
        $sql = "SELECT `ct24_IdCC`,`ct24_CodCC`, `ct24_DescripcionCC` FROM `ct24_caracteristicaconcreto` WHERE `ct24_estado`  = 1 ORDER BY `ct24_IdCC` DESC";
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