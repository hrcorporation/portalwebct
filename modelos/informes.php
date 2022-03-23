<?php

class informes extends conexionPDO

{

    public $con;

    private $table_remisiones = 'ct26_remisiones';





    public function __construct()

    {

        $this->PDO = new conexionPDO();

        $this->con = $this->PDO->connect();

        date_default_timezone_set('America/Bogota');
    }



    function informe_segmentacionDane2($fecha_ini, $fecha_fin)
    {

        $this->fecha_ini = $fecha_ini;

        $this->fecha_fin = $fecha_fin;



        $sql = "SELECT sum(ct26_metros) as metros, ct5_obras.ct5_segmento as idsegmento FROM `ct26_remisiones` INNER JOIN ct5_obras on ct26_remisiones.ct26_idObra = ct5_obras.ct5_IdObras WHERE `ct26_date_create` BETWEEN :fecha_ini AND :fecha_fin  GROUP BY ct5_obras.ct5_segmento ORDER BY `ct26_id_remision` DESC";

        $stmt = $this->con->prepare($sql);



        $stmt->bindParam(':fecha_ini', $this->fecha_ini, PDO::PARAM_STR);

        $stmt->bindParam(':fecha_fin', $this->fecha_fin, PDO::PARAM_STR);





        if ($result = $stmt->execute()) { // Ejecutar

            $num_reg =  $stmt->rowCount(); // Get Numero de Registros



            if ($num_reg > 1) { // Validar el numero de Registros

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



        $this->PDO->closePDO(); // Cerrar Conexion  

    }



    function segmentacion_info($id_segmentacion)

    {

        $sql = "SELECT descripcion FROM `segmento` WHERE `id_segmento` = :id_segmentacion";

        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id_segmentacion', $id_segmentacion, PDO::PARAM_INT);



        if ($result = $stmt->execute()) { // Ejecutar

            $num_reg =  $stmt->rowCount(); // Get Numero de Registros

            if ($num_reg == 1) { // Validar el numero de Registros

                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores

                    $descripcion = $fila['descripcion'];
                }

                return $descripcion;
            } else {

                return null;
            }
        } else {

            return false;
        }
    }

    function novedades_remi($id_remision)
    {
        $this->id_remision = (int)$id_remision;
        $sql = "SELECT `ct44_novedades` FROM `ct44_novedades_remi` WHERE `ct44_id_remi` = :id_remision";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_remision', $this->id_remision, PDO::PARAM_INT);
        if ($stmt->execute()) { // Ejecutar
            $num_reg =  $stmt->rowCount(); // Get Numero de Registros
            if ($num_reg >= 1) { // Validar el numero de Registros
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
    }

    function novedades_dasa($id)
    {
        $this->id = (int)$id;
        $sql = "SELECT `ct44_novedades` FROM `ct44_novedades_remi` WHERE `ct44_id_remi` = :id_remision";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_remision', $this->id_remision, PDO::PARAM_INT);
        if ($stmt->execute()) { // Ejecutar
            $num_reg =  $stmt->rowCount(); // Get Numero de Registros
            if ($num_reg >= 1) { // Validar el numero de Registros
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
    }
    function informe_fact($fecha_ini, $fecha_fin)
    {



        $this->fecha_ini = $fecha_ini . " 00:00:00.000000";

        $this->fecha_fin = $fecha_fin . ' 23:59:59.000000';



        $sql = "SELECT ct27_facturae.ct27_fecha_subda, ct27_facturae.ct27_nombre_factura, ct26_remisiones.ct26_codigo_remi FROM `ct28_factura_remi` INNER JOIN ct27_facturae ON ct28_factura_remi.ct28_id_fact = ct27_facturae.ct27_id_factura  INNER JOIN ct26_remisiones ON ct28_factura_remi.ct28_id_remision = ct26_remisiones.ct26_id_remision WHERE `ct27_fecha_subda`  BETWEEN :fecha_ini AND :fecha_fin";



        $stmt = $this->con->prepare($sql);



        //Formato fecha  AAAA-MM-DD



        $stmt->bindParam(':fecha_ini', $this->fecha_ini, PDO::PARAM_STR);

        $stmt->bindParam(':fecha_fin', $this->fecha_fin, PDO::PARAM_STR);



        if ($result = $stmt->execute()) { // Ejecutar

            $num_reg =  $stmt->rowCount(); // Get Numero de Registros



            if ($num_reg > 1) { // Validar el numero de Registros

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



        $this->PDO->closePDO(); // Cerrar Conexion  

    }



    function informe_segmentacionDane($fecha_ini, $fecha_fin)
    {

        $this->fecha_ini = $fecha_ini;

        $this->fecha_fin = $fecha_fin;



        $sql = "SELECT ct26_idObra as id_obra , ct5_obras.ct5_NombreObra as nombre_obra, sum(ct26_metros) as metros, ct5_obras.ct5_segmento as segmento FROM `ct26_remisiones` INNER JOIN ct5_obras on ct26_remisiones.ct26_idObra = ct5_obras.ct5_IdObras WHERE `ct26_date_create` BETWEEN :fecha_ini AND :fecha_fin GROUP BY ct26_idcliente, ct26_idObra ORDER BY `ct26_id_remision` DESC";

        $stmt = $this->con->prepare($sql);



        $stmt->bindParam(':fecha_ini', $this->fecha_ini, PDO::PARAM_STR);

        $stmt->bindParam(':fecha_fin', $this->fecha_fin, PDO::PARAM_STR);





        if ($result = $stmt->execute()) { // Ejecutar

            $num_reg =  $stmt->rowCount(); // Get Numero de Registros



            if ($num_reg > 1) { // Validar el numero de Registros

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



        $this->PDO->closePDO(); // Cerrar Conexion  

    }



    public static function select_nombre_conductor($con, $numero_identificacion)

    {

        $numero_identificacion = intval($numero_identificacion);

        $sql = "SELECT `ct1_RazonSocial` FROM `ct1_terceros` WHERE `ct1_NumeroIdentificacion` = :num_identificacion";

        $stmt = $con->prepare($sql);

        $stmt->bindParam(':num_identificacion', $numero_identificacion, PDO::PARAM_INT);

        if ($result = $stmt->execute()) { // Ejecutar

            $num_reg =  $stmt->rowCount(); // Get Numero de Registros



            if ($num_reg >= 1) { // Validar el numero de Registros

                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores

                    return $fila['ct1_RazonSocial'];
                }
            } else {

                return false;
            }
        } else {

            return false;
        }
    }



    function informe_remi($fecha_ini, $fecha_fin)
    {
        $this->fecha_ini = $fecha_ini;
        $this->fecha_fin = $fecha_fin;
        $sql = "SELECT * FROM `ct26_remisiones` WHERE `ct26_fecha_remi` BETWEEN :fecha_ini AND :fecha_fin ORDER BY `ct26_remisiones`.`ct26_id_remision` DESC";
        $stmt = $this->con->prepare($sql);
        //Formato fecha  AAAA-MM-DD
        $stmt->bindParam(':fecha_ini', $this->fecha_ini, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_fin', $this->fecha_fin, PDO::PARAM_STR);
        if ($stmt->execute()) { // Ejecutar
            $num_reg =  $stmt->rowCount(); // Get Numero de Registros
            if ($num_reg > 1) { // Validar el numero de Registros
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $fila['nombre_conductor'] = SELF::select_nombre_conductor($this->con, $fila['ct26_identificacion_conductor']);
                    if (SELF::select_nombre_conductor($this->con, $fila['ct26_nitcliente'])) {
                        $fila['nombre_cliente'] = SELF::select_nombre_conductor($this->con, $fila['ct26_nitcliente']);
                    } else {
                        $fila['nombre_cliente'] = $fila['ct26_razon_social'];
                    }
                    if (SELF::select_nombre_conductor($this->con, $fila['ct26_identificacion_conductor'])) {
                        $fila['nombre_conductor'] = SELF::select_nombre_conductor($this->con, $fila['ct26_identificacion_conductor']);
                    } else {
                        $fila['nombre_conductor'] = $fila['ct26_nombre_conductor'];
                    }
                    $datos[] = $fila;
                }
                return $datos;
            } else {
                return false;
            }
        } else {
            return false;
        }
        $this->PDO->closePDO(); // Cerrar Conexion  
    }

    function informe_dasa($fecha_ini, $fecha_fin)
    {
        $this->fecha_ini = $fecha_ini;
        $this->fecha_fin = $fecha_fin;
        $sql = "SELECT * FROM `dasa` WHERE `fecha` BETWEEN :fecha_ini AND :fecha_fin";
        $stmt = $this->con->prepare($sql);
        //Formato fecha  AAAA-MM-DD
        $stmt->bindParam(':fecha_ini', $this->fecha_ini, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_fin', $this->fecha_fin, PDO::PARAM_STR);
        if ($stmt->execute()) { // Ejecutar
            $num_reg =  $stmt->rowCount(); // Get Numero de Registros
            if ($num_reg > 1) { // Validar el numero de Registros
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $data_array['documento'] = $fila['documento'];
                    $data_array['fecha'] = $fila['fecha'];
                    $data_array['cliente'] = $fila['cliente'];
                    $data_array['dependencia'] = $fila['dependencia'];
                    $datosf[] = $data_array;
                }
                return $datosf;
            } else {
                return false;
            }
        } else {
            return false;
        }
        $this->PDO->closePDO(); // Cerrar Conexion  
    }
}
