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

    function crear_tipo_concreto($ct21_CodTConcreto, $ct21_DescripcionTC)
    {
        $this->fecha_create = date("Y-m-d H:i:s");
        $this->estado =1;
        $this->ct21_CodTConcreto = $ct21_CodTConcreto;
        $this->ct21_DescripcionTC = $ct21_DescripcionTC;

        $sql = "INSERT INTO `ct21_tipoconcreto`(`ct21_FechaCreacion`, `ct21_estado`, `ct21_CodTConcreto`, `ct21_DescripcionTC`) VALUES (:ct21_FechaCreacion, :ct21_estado, :ct21_CodTConcreto, :ct21_DescripcionTC)";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':ct21_FechaCreacion' , $this->fecha_create, PDO::PARAM_STR);
        $stmt->bindParam(':ct21_estado' , $this->estado, PDO::PARAM_INT);
        $stmt->bindParam(':ct21_CodTConcreto' , $this->ct21_CodTConcreto, PDO::PARAM_STR);
        $stmt->bindParam(':ct21_DescripcionTC' , $this->ct21_DescripcionTC, PDO::PARAM_STR);

        $result = $stmt->execute();
        //Cerrar Conexion
        $this->PDO->closePDO();

        return $result;
    }

    function get_datatable_tipo_concreto()
    {
        $sql ="SELECT `ct21_IdTipoConcreto`, `ct21_FechaCreacion`, `ct21_estado`, `ct21_CodTConcreto`, `ct21_DescripcionTC` FROM `ct21_tipoconcreto`";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Ejecutar 
        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id'] = $fila['ct21_IdTipoConcreto'];
                    $datos['cod'] = $fila['ct21_CodTConcreto'];
                    $datos['descripcion'] = $fila['ct21_DescripcionTC'];
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
}
