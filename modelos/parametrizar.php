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


    public static function select_remi(){
        $sql="";
        $stmt = $con->prepare($sql);

        if($stmt->excecute()){
            
        }
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


    //Guardar los clientes y obras
    public function insert_gestion_acceso($id_tercero, $id_cliente, $id_obra)
    {
        $sql = "INSERT INTO `ct1_gestion_acceso`(`id_residente`, `id_cliente`, `id_obra`) VALUES (:id_residente, :id_cliente, :id_obra)";
        $stmt = $this->con->prepare($sql); // Preparar la conexion
        $stmt->bindParam(':id_residente', $id_tercero, PDO::PARAM_INT);
        $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
        $stmt->bindParam(':id_obra', $id_obra, PDO::PARAM_INT);

        if ($stmt->execute()) { // Ejecutar
            $php_result = true;
        } else {
            $php_result = false;
        }
        return $php_result;
    }
}
