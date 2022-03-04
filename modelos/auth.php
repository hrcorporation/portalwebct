<?php
class auth extends conexionPDO
{

    public $con;

    // Iniciar Conexion
    public function __construct()
    {
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
    }

    function actualizar_contrasenia($id_usuario, $contrasenia)
    {
        $this->id_usuario = $id_usuario;
        $this->contrasenia = $contrasenia;
        $sql = "UPDATE ct1_terceros SET ct1_pass = :contrasenia WHERE ct1_idTerceros = :id_usuario";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id_usuario', $this->id_usuario, PDO::PARAM_INT);
        $stmt->bindParam(':contrasenia', $this->contrasenia, PDO::PARAM_STR);

        $result = $stmt->execute();
        $this->PDO->closePDO();
        return $result;
    }


    function autenticacion_usuario($usuario, $pass)
    {
        $sql = "SELECT `ct1_IdTerceros`,ct1_Estado,ct1_rol,ct1_RazonSocial, ct1_NumeroIdentificacion,ct1_id_cliente1, ct1_obra_id FROM `ct1_terceros` WHERE `ct1_NumeroIdentificacion` = :numero_identificacion  AND `ct1_pass` = :pass";
        $stmt = $this->con->prepare($sql); // Preparar la conexion
        $stmt->bindParam(':numero_identificacion', $usuario, PDO::PARAM_STR);
        $stmt->bindParam(':pass', $pass, PDO::PARAM_STR);

        if ($result = $stmt->execute()) { // Ejecutar
            $num_reg =  $stmt->rowCount(); // Get Numero de Registros
            if ($num_reg == 1) { // Validar el numero de Registros
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $data_array['id_usuario'] = $fila['ct1_IdTerceros'];
                    $data_array['estado'] = $fila['ct1_Estado'];
                    $data_array['id_rol'] = $fila['ct1_rol'];
                    $data_array['nombre_cliente'] = $fila['ct1_RazonSocial'];
                    $data_array['numero_identificacion'] = $fila['ct1_NumeroIdentificacion'];
                    $data_array['id_cliente1'] = $fila['ct1_id_cliente1'];
                    $data_array['id_obra1'] = $fila['ct1_obra_id'];
                    $data_arrayf[] = $data_array;
                }
                return $data_arrayf;
            } else {
                return false;
            }
        } else {
            return false;
        }
        $this->PDO->closePDO(); // Cerrar Conexion  
    }
}
