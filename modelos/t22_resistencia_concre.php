<?php
class t22_resistencia_concre extends conexionPDO
{


    // Iniciar Conexion
    public function __construct()
    {
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
    }

    function get_resistencia_concre_id($id)
    {
        $this->id = $id;
        $sql = "SELECT `ct22_IdResistenciaConcreto`,`ct22_CodResistenciaConcreto`, `ct22_DescripcionRC` FROM `ct22_resistenciaconcreto`  WHERE `ct22_estado` = 1 AND  ct22_IdResistenciaConcreto = :id ORDER BY `ct22_IdResistenciaConcreto` DESC";
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

    function get_resistencia_concre()
    {
        $sql = "SELECT `ct22_IdResistenciaConcreto`,`ct22_CodResistenciaConcreto`, `ct22_DescripcionRC` FROM `ct22_resistenciaconcreto`  WHERE `ct22_estado` = 1 ORDER BY `ct22_IdResistenciaConcreto` DESC";
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
