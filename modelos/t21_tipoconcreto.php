<?php
class t21_tipoconcreto extends conexionPDO
{


    // Iniciar Conexion
    public function __construct()
    {
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
    }

    function get_tipoconcreto_id($id)
    {
        $this->id = $id;
        $sql = "SELECT  `ct21_IdTipoConcreto`,`ct21_CodTConcreto`, `ct21_DescripcionTC` FROM `ct21_tipoconcreto` WHERE ct21_estado = 1 AND `ct21_IdTipoConcreto` = :id ORDER BY `ct21_IdTipoConcreto` DESC";
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

    function get_tipoconcreto()
    {
        $sql = "SELECT  `ct21_IdTipoConcreto`,`ct21_CodTConcreto`, `ct21_DescripcionTC` FROM `ct21_tipoconcreto` WHERE ct21_estado = 1 ORDER BY `ct21_IdTipoConcreto` DESC";
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

    function crear_tipo_concreto($ct21_FechaCreacion, $ct21_estado, $ct21_CodTConcreto, $ct21_DescripcionTC)
    {
        $this->ct21_FechaCreacion = $ct21_FechaCreacion;
        $this->ct21_estado = $ct21_estado;
        $this->ct21_CodTConcreto = $ct21_CodTConcreto;
        $this->ct21_DescripcionTC = $ct21_DescripcionTC;

        $sql = "INSERT INTO `ct21_tipoconcreto`(`ct21_FechaCreacion`, `ct21_estado`, `ct21_CodTConcreto`, `ct21_DescripcionTC`) VALUES (:ct21_FechaCreacion, :ct21_estado, :ct21_CodTConcreto, :ct21_DescripcionTC)";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':ct21_FechaCreacion' , $this->ct21_FechaCreacion, PDO::PARAM_STR);
        $stmt->bindParam(':ct21_estado' , $this->ct21_estado, PDO::PARAM_INT);
        $stmt->bindParam(':ct21_CodTConcreto' , $this->ct21_CodTConcreto, PDO::PARAM_STR);
        $stmt->bindParam(':ct21_DescripcionTC' , $this->ct21_DescripcionTC, PDO::PARAM_STR);

        if ($stmt->execute()) { // Ejecutar
            $id_insert = $this->con->lastInsertId();
            
            return $id_insert;
        }else{
            return false;
        }
    }
}
