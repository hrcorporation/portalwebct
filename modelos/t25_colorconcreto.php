<?php
class t25_colorconcreto extends conexionPDO
{
    // Iniciar Conexion
    public function __construct()
    {
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
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