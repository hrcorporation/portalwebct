<?php

class parametrizar extends conexionPDO
{
    protected $con;
    // Iniciar Conexion
    public function __construct()
    {
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
    }

    public function buscar_rol(){
        $sql = "SELECT `ct1_IdTerceros`, `ct1_id_cliente1`,`ct1_obra_id` FROM `ct1_terceros` WHERE `ct1_rol` BETWEEN 102 AND 103";
        $stmt = $this->con->prepare($sql);

        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['ct1_IdTerceros'] = $fila['ct1_IdTerceros'];
                    $datos['ct1_id_cliente1'] = $fila['ct1_id_cliente1'];
                    $datos['ct1_obra_id'] = $fila['ct1_obra_id'];
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

    public function insert_gestion_acceso($id_tercero, $id_cliente, $id_obra){
        $sql =_ "";
    }
    
}
