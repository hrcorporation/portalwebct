
<?php

require '../../librerias/autoload.php';
include '../../modelos/autoload.php';
include '../../vendor/autoload.php';

class remi_testing extends conexionPDO
{
    protected $con;

    private $id;


    // Iniciar Conexion
    public function __construct()
    {
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
    }

    function ejecutar()
    {
        $array_remi = self::select_remi($this->con);

        foreach ($array_remi as $key) {
            $id_remision = $key['id_remision'];
            $estado = $key['estado'];
            $imagen_remi = $key['imagen_remi'];
            $firma = $key['firma'];


            ///////////////////////////////////////////////////////////
            /**
             * Estados
             * 1 = Facturado
             * 2 = Pendiente Facturacion
             * 3 = Falta firma Cliente
             * 4 = Error de Sincronizacion
             * 5 = Consumo Interno
             * 10 = Anulada
             */

            switch ($estado) {
                case 1: // Facturado
                case 5:    // Consumo interno
                case 10:    // Anulado

                    break;

                default:                    // valida si tiene firma 
                    if (!empty($firma) || !is_null($firma)) {
                        $estado = 2;
                    }

                    // valida remision Fisica
                    if (!empty($imagen_remi) || !is_null($imagen_remi)) {
                        $estado = 2;
                    }

                    if (SELF::buscar_factura($this->con, $id_remision)) {
                        $estado = 1;
                    }
                    SELF::update_status_remi($this->con, $id_remision, $estado);
                    break;
            }


            // 

        }
        /*
        1 -> Facturada 
        2 -> Pendiente de Facturacion
        3 -> Falta Firma Cliente
        */
    }

    public static function buscar_factura($con, $id_remi)
    {
        $sql = "SELECT * FROM `ct28_factura_remi` WHERE `ct28_id_remision` = :id_remi";
        //Preparar Conexion
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id_remi', $id_remi, PDO::PARAM_INT);

        // Ejecutar 
        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function update_status_remi($con, $id_remi, $status)
    {
        $sql = "UPDATE `ct26_remisiones` SET `ct26_estado`= :estado WHERE `ct26_id_remision` =  :id_remi";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':estado', $status, PDO::PARAM_INT);
        $stmt->bindParam(':id_remi', $id_remi, PDO::PARAM_INT);
        if ($result = $stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }


    public static function select_remi($con)
    {
        $sql = "SELECT `ct26_id_remision`, `ct26_estado`, `ct26_imagen_remi`, `ct26_recibido` FROM `ct26_remisiones` ORDER BY `ct26_id_remision` DESC  LIMIT 5000";
        //Preparar Conexion
        $stmt = $con->prepare($sql);
        // Ejecutar 
        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $array_remi['id_remision'] = $fila['ct26_id_remision'];
                    $array_remi['estado'] = $fila['ct26_estado'];
                    $array_remi['imagen_remi'] = $fila['ct26_imagen_remi'];
                    $array_remi['firma'] = $fila['ct26_recibido'];
                    $datos[] = $array_remi;
                }
                return $datos;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}


$remi_testing = new remi_testing();
$remi_testing->ejecutar();

header('Location: index.php');
exit;
