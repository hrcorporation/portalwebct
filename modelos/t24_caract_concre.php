<?php
class t24_caract_concre extends conexionPDO
{
    // Iniciar Conexion
    public function __construct()
    {
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
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