<?php

class modelo_t26 extends conexionPDO {

    protected $con;
    private $id;
    private $notificacion;
    private $hora_salida_planta;
    private $hora;
    private $observaciones;

    // Iniciar Conexion
    public function __construct() {
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
    }

    //        $sql = "UPDATE `ct26_remisiones` SET `ct26_notificacion`= :notificacion,`ct26_hora_terminada_descargue`=[value-13] WHERE `ct26_id_remision` = :id_remision"
    
    
    
    
    function servicio_bomba($id_remision, $option, $cantidad,$tipo_bomba) {
        $this->search_id = $id_remision;
        $this->servicio_bomba = $option;
        $this->cant = $cantidad;
        $this->tipo_bomba = $tipo_bomba;
        
        $sql = "UPDATE `ct26_remisiones` SET `ct26_servicio_bomba`= :servicio_bomba,`ct26_cant_bomba` = :cant_bomba, `ct26_tipo_bomba` = :tipo_bomba WHERE `ct26_id_remision` = :id_remision";
        $stmt = $this->con->prepare($sql);
        
         $stmt->bindParam(':servicio_bomba', $this->servicio_bomba, PDO::PARAM_BOOL);
         $stmt->bindParam(':cant_bomba', $this->cant, PDO::PARAM_STR);
          $stmt->bindParam(':id_remision', $this->search_id, PDO::PARAM_INT);
          $stmt->bindParam(':tipo_bomba', $this->tipo_bomba, PDO::PARAM_INT);
          
         $result = $stmt->execute();
    }

    function RecibidoFinal($id_remision, $persona) {
        $this->search_id = $id_remision;
        $this->notificacion = 10;
        $this->persona = $persona;
        
        $date = "".date('Y/m/d h:i:s', time());


        $sql = "UPDATE `ct26_remisiones` SET `ct26_notificacion`= :notificacion,`ct26_recibido`= :persona, ct26_fechaRecibido = :fecha  WHERE `ct26_id_remision` = :id_remision";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':notificacion', $this->notificacion, PDO::PARAM_INT);
        $stmt->bindParam(':persona', $this->persona, PDO::PARAM_STR);
        $stmt->bindParam(':fecha', $date, PDO::PARAM_STR);
        $stmt->bindParam(':id_remision', $this->search_id, PDO::PARAM_INT);
        // Ejecutar 
        $result = $stmt->execute();
    }
    
    function observaciones($id_remision, $obs) {
        $this->search_id = $id_remision;
        $this->notificacion = 7;
        $this->observaciones = $obs;

        $sql = "UPDATE `ct26_remisiones` SET `ct26_notificacion`= :notificacion,`ct26_observaciones`= :observaciones WHERE `ct26_id_remision` = :id_remision";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':notificacion', $this->notificacion, PDO::PARAM_INT);
        $stmt->bindParam(':observaciones', $this->observaciones, PDO::PARAM_STR);
        $stmt->bindParam(':id_remision', $this->search_id, PDO::PARAM_INT);
        // Ejecutar 
        $result = $stmt->execute();
    }

    public static function  get_fecha_remision($con, $id_remision){
        $sql = "SELECT `ct26_fecha_remi` FROM `ct26_remisiones` WHERE `ct26_id_remision` = :id_remi";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id_remi', $id_remision);
        if ($stmt->execute()) { // Ejecutar
            $num_reg =  $stmt->rowCount(); // Get Numero de Registros
            if ($num_reg > 0) { // Validar el numero de Registros
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['ct26_fecha_remi'];
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    
    function unir_fecha_hora($id_remision, $hora)
    {
        $this->id_remision = $id_remision;
        $this->fecha_remi = SELF::get_fecha_remision($this->con,$this->id_remision);
        $this->hora = $hora;
        $tiempo = $this->fecha.' '.$this->hora;
        $this->tiempof = new Datetime($tiempo);
        // f_hora_remi
    }

    function guardar_fecha_remi($id_remision,$tiempof)
    {
        $sql="UPDATE `ct26_remisiones` SET `f_hora_remi` = :fecha_remi WHERE `ct26_id_remision` = :id_remi";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':fecha_remi',$tiempof, PDO::PARAM_STR);
        $stmt->bindParam(':id_remi',$id_remision, PDO::PARAM_INT);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    function hora_terminacion_descargue($id_remision, $hora_terminacion_descargue) {
        $this->search_id = $id_remision;
        $this->notificacion = 7;
        $this->hora = $hora_terminacion_descargue;

        $sql = "UPDATE `ct26_remisiones` SET `ct26_notificacion`= :notificacion,`ct26_hora_terminada_descargue`= :hora WHERE `ct26_id_remision` = :id_remision";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':notificacion', $this->notificacion, PDO::PARAM_INT);
        $stmt->bindParam(':hora', $this->hora, PDO::PARAM_STR);
        $stmt->bindParam(':id_remision', $this->search_id, PDO::PARAM_INT);
        // Ejecutar 
        $result = $stmt->execute();
    }
    
    function hora_inicio_descargue($id_remision, $hora_inicio_descargue) {
        $this->search_id = $id_remision;
        $this->notificacion = 6;
        $this->hora = $hora_inicio_descargue;

        $sql = "UPDATE `ct26_remisiones` SET `ct26_notificacion`= :notificacion,`ct26_hora_inicio_descargue`= :hora WHERE `ct26_id_remision` = :id_remision";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':notificacion', $this->notificacion, PDO::PARAM_INT);
        $stmt->bindParam(':hora', $this->hora, PDO::PARAM_STR);
        $stmt->bindParam(':id_remision', $this->search_id, PDO::PARAM_INT);
        // Ejecutar 
        $result = $stmt->execute();
    }
    
    function hora_llegadaObra($id_remision, $hora_llegada_obra) {
        $this->search_id = $id_remision;
        $this->notificacion = 5;
        $this->hora = $hora_llegada_obra;

        $sql = "UPDATE `ct26_remisiones` SET `ct26_notificacion`= :notificacion,`ct26_hora_llegada_obra`= :hora WHERE `ct26_id_remision` = :id_remision";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':notificacion', $this->notificacion, PDO::PARAM_INT);
        $stmt->bindParam(':hora', $this->hora, PDO::PARAM_STR);
        $stmt->bindParam(':id_remision', $this->search_id, PDO::PARAM_INT);
        // Ejecutar 
        $result = $stmt->execute();
    }

    function hora_salidaObra($id_remision, $hora_salida_planta) {
        $this->search_id = $id_remision;
        $this->notificacion = 4;
        $this->hora_salida_planta = $hora_salida_planta;

        $sql = "UPDATE `ct26_remisiones` SET `ct26_notificacion`= :notificacion,`ct26_hora_salida_planta`= :hora_salida_planta WHERE `ct26_id_remision` = :id_remision";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':notificacion', $this->notificacion, PDO::PARAM_INT);
        $stmt->bindParam(':hora_salida_planta', $this->hora_salida_planta, PDO::PARAM_STR);
        $stmt->bindParam(':id_remision', $this->search_id, PDO::PARAM_INT);
        // Ejecutar 
        $result = $stmt->execute();
    }

    //////////////////////////////////////////////////////////////////////

    function hora_llegada_planta($id_remision, $hora_llegada_planta) {
        $this->search_id = $id_remision;
        $this->notificacion = 10;
        $this->hora_llegada_planta = $hora_llegada_planta;

        $sql = "UPDATE `ct26_remisiones` SET `ct26_notificacion`= :notificacion,`ct26_hora_llegada_planta`= :hora_llegada_planta WHERE `ct26_id_remision` = :id_remision";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':notificacion', $this->notificacion, PDO::PARAM_INT);
        $stmt->bindParam(':hora_llegada_planta', $this->hora_llegada_planta, PDO::PARAM_STR);
        $stmt->bindParam(':id_remision', $this->search_id, PDO::PARAM_INT);
        // Ejecutar 
        $result = $stmt->execute();
    }

    function buscar_vehiculo($search) {

        $this->search_id = $search;
        //SQL
        $sql = "SELECT `ct10_Placa` FROM `ct10_vehiculo` WHERE `ct10_IdVehiculo` = :search_id ";

        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':search_id', $this->search_id, PDO::PARAM_INT);

        // Ejecutar 
        $result = $stmt->execute();


        $numRow = $stmt->rowCount();
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $razon_social = $fila['ct10_Placa'];
        }

        return $razon_social;
    }

    function buscar_conductor($search) {

        $this->search_id = $search;
        //SQL
        //$sql = "SELECT * FROM productos ";
        $sql = "SELECT  `ct1_RazonSocial` FROM `ct1_terceros` WHERE `ct1_IdTerceros` = :search_id ";

        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        //$stmt->bindParam(':search_id', $this->search_id, PDO::PARAM_INT);

        $stmt->bindParam(':search_id', $this->search_id, PDO::PARAM_INT);

        // Ejecutar 
        $result = $stmt->execute();


        $numRow = $stmt->rowCount();
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $razon_social = $fila['ct1_RazonSocial'];
        }

        return $razon_social;
    }


    public function obtenerFechaIdRemision($id_remision)
    {
        $this->id = $id_remision;
        // sentencia SQL
        $sql = "SELECT `ct26_fecha_remi` FROM `ct26_remisiones` WHERE `ct26_id_remision` =   :id_remision";
        // Preparar Conexion
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_remision', $this->id, PDO::PARAM_INT);
        // ejecuta la sentencia SQL
        if ($stmt->execute()) {
            $num_reg = $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    return $fila['ct26_fecha_remi'];
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function actualizarFecha($hora_salida, $fecha, $hora){
        $sql = "UPDATE `ct26_remisiones` SET `ct26_hora_salida_planta` = :hora_salida_planta WHERE `ct26_fecha_remi` = :fecha AND `ct26_hora_salida_planta` = :hora";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':hora_salida_planta', $hora_salida, PDO::PARAM_STR);
        $stmt->bindParam(':fecha', $fecha, PDO::PARAM_STR);
        $stmt->bindParam(':hora', $hora, PDO::PARAM_STR);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function getFechaHora(){
        $sql = "SELECT `ct26_fecha_remi`, `ct26_hora_salida_planta` FROM `ct26_remisiones`";
        $stmt = $this->con->prepare($sql);
        // Asignando Datos ARRAY => SQL
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['ct26_fecha_remi'] = $fila['ct26_fecha_remi'];
                    $datos['ct26_hora_salida_planta'] = $fila['ct26_hora_salida_planta'];
                    $datosf[] = $datos;
                }
                return $datosf;
            }
        }
        return false;
    }

}
