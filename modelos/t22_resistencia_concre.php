<?php
class t22_resistencia_concre extends conexionPDO
{

    protected $con;

    // Iniciar Conexion
    public function __construct()
    {
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
    }


    function crear_resistencia_concreto($cod, $descripcion){
        $this->fecha_create = date("Y-m-d H:i:s");
        $this->estado =1;
        $this->cod = $cod;
        $this->descripcion = $descripcion;
        $sql = "INSERT INTO `ct22_resistenciaconcreto`( `ct22_FechaCreacion`, `ct22_estado`, `ct22_CodResistenciaConcreto`, `ct22_DescripcionRC`) VALUES (:fecha_create, :estado, :cod , :descripcion)";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':fecha_create', $this->fecha_create, PDO::PARAM_STR);
        $stmt->bindParam(':estado', $this->estado, PDO::PARAM_INT);
        $stmt->bindParam(':cod', $this->cod, PDO::PARAM_STR);
        $stmt->bindParam(':descripcion', $this->descripcion, PDO::PARAM_STR);
         // Ejecutar 
         if ($result = $stmt->execute()) {
            return true;
         }else{
             return false;
         }
    }

    function get_datatable_resistencia_concreto()
    {
        $sql ="SELECT `ct22_IdResistenciaConcreto`, `ct22_FechaCreacion`, `ct22_estado`, `ct22_CodResistenciaConcreto`, `ct22_DescripcionRC` FROM `ct22_resistenciaconcreto`";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Ejecutar 
        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id'] = $fila['ct22_IdResistenciaConcreto'];
                    $datos['cod'] = $fila['ct22_CodResistenciaConcreto'];
                    $datos['descripcion'] = $fila['ct22_DescripcionRC'];
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
