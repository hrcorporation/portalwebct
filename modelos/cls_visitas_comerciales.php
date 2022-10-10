<?php
class cls_visitas_comerciales extends conexionPDO
{
    public $con; // variable de conexion a la base de datos

    // Conexcion y a la base de datos
    public function __construct()
    {
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
        date_default_timezone_set('America/Bogota');
    }


    

    public function informe_excel_visitas_clientes($fecha_ini, $fecha_fin)
    {
        $this->fecha_ini = $fecha_ini;
        $this->fecha_fin = $fecha_fin;
        $sql = "SELECT `id`,id_comercial,fecha_cumplimiento,id_cliente, `fecha`, `tipo_visita`, `nombre_cliente`, `nombre_obra`, `observaciones`, `start` FROM `visitas_clientes` WHERE `start` BETWEEN :fecha_ini AND :fecha_fin ORDER BY `fecha` DESC;";

        // Preparar la conexion del sentencia SQL
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':fecha_ini', $this->fecha_ini, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_fin', $this->fecha_fin, PDO::PARAM_STR);

        //$stmt->bindParam(':var', $var, PDO::PARAM_STR);
        // Ejecuta SQL
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount(); // Cuenta los numero de registros de sql
            // Valida si hay registros
            if ($num_reg > 0) {
                // Recorrer limpieza de datos obtenidos en la consulta
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $data_array['id'] = $fila['id'];
                    $data_array['id_comercial'] = $fila['id_comercial'];
                    $data_array['fecha_cumplimiento'] = $fila['fecha_cumplimiento'];
                    $data_array['fecha'] = $fila['start'];
                    $data_array['tipo_visita'] = $fila['tipo_visita'];
                    $data_array['id_cliente'] = $fila['id_cliente'];
                    $data_array['nombre_cliente'] = $fila['nombre_cliente'];
                    $data_array['nombre_obra'] = $fila['nombre_obra'];
                    $data_array['observaciones'] = $fila['observaciones'];
                    $datosf[] = $data_array;
                }
                return $datosf; // Retorna el resultado
            } else {
                return false; // El resultado de la sentencia SQL es igual a 0
            }
        } else {
            return false; // Error en la sentencia sql
        }
    }


    function eliminar_anexo($id){
        $sql = "DELETE FROM `visitas_anexos` WHERE `id` = :id ";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            
            return true;
        }else{
            return false;
        }


    }

    function data_table_oanexos($id_visita)
    {
     
        $sql = "SELECT `id`, `id_visita`, `nombre`, `file_anexo` FROM `visitas_anexos` WHERE `id_visita` = :id_visita ";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_visita', $id_visita, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $datos_obra['id'] = $fila['id'];
                    $datos_obra['id_visita'] =  $fila['id_visita'];
                    $datos_obra['nombre_anexo'] =  $fila['nombre'];
                    $datos_obra['archivo'] =  '<a href="'.$fila['file_anexo'].'"  target="_blank" > <i class="fas fa-file-pdf"></i> Archivo </a>';
                    $datos_obra['botones'] =  '';
                    $datos[] = $datos_obra;
                }
                return $datos;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }


    public static function validar_anexos($con,$id_visita){
        $sql="SELECT * FROM `visitas_anexos` WHERE `id_visita` = :id_visita";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id_visita', $id_visita, PDO::PARAM_INT);
        // Ejecuta SQL
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if($num_reg == 0){
                return true;
            }else{
                return false;
            } // Cuenta los numero de registros de sql
            
        }


    }

    public static function actualizar_estadovisita($con,$id_visita, $status){
       $date = "" . date('Y/m/d h:i:s', time());

        $sql="UPDATE `visitas_clientes` SET `status`= :estado, fecha_cumplimiento = :fecha_cumplimiento WHERE `id` = :id";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':estado', $status, PDO::PARAM_INT);
        $stmt->bindParam(':fecha_cumplimiento', $date, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id_visita, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return true;
        }else{
            return false;
        }
    }


    function subir_anexo($nombre_anexo,$file_anexo, $ruta, $id_visita)
    {
      $php_fechatime = date("Y-m-d H:i:s");
      $date = "" . date('Y/m/d h:i:s', time());
        if(SELF::validar_anexos($this->con, $id_visita)){
            SELF::actualizar_estadovisita($this->con,$id_visita, 1);
        }else{
            SELF::actualizar_estadovisita($this->con,$id_visita, 2);
        }

      $this->file_anexo = $file_anexo;
      $php_fileexten = strrchr($this->file_anexo, ".");
      $php_serial = strtoupper(substr(hash('sha1', $this->file_anexo . $date), 0, 40)) . $php_fileexten;
  
  
      $carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/internal/anexos_visitas/';
      $php_tempfoto = ('/internal/anexos_visitas/' . $php_serial);
  
      $sql = "INSERT INTO `visitas_anexos`( `id_visita`, `nombre`, `file_anexo`,fecha_subida) VALUES (:id_visita, :nombre, :file_anexo, :fecha_subida);";
      $stmt = $this->con->prepare($sql);
      $stmt->bindParam(':id_visita', $id_visita, PDO::PARAM_INT);
      $stmt->bindParam(':nombre', $nombre_anexo, PDO::PARAM_STR);
      $stmt->bindParam(':file_anexo', $php_tempfoto, PDO::PARAM_STR);
      $stmt->bindParam(':fecha_subida', $date, PDO::PARAM_STR);
      // Ejecutar 
      if ($result = $stmt->execute()) {
        $php_movefile = move_uploaded_file($ruta, $carpeta_destino . $php_serial);
        
        return true;
      }
      //Cerrar Conexion
      $this->PDO->closePDO();
      //resultado
      return $result;
    }


    public function get_comercial_tercero($id_cliente)
    {
        $sql = "SELECT `ct1_id_asesora` FROM `ct1_terceros` WHERE `ct1_IdTerceros` = :id";
        // Preparar Conexion.
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id', $id_cliente, PDO::PARAM_INT);
        // Asignando Datos ARRAY => SQL.
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    return $fila['ct1_id_asesora'];
                }
                
            }
        }
        return false;
    }
    

    public function get_visitas_comerciales_id($id)
    {
        $sql = "SELECT * FROM visitas_clientes WHERE id = :id";
        // Preparar Conexion.
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        // Asignando Datos ARRAY => SQL.
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $datos[] = $fila;
                }
                return $datos;
            }
        }
        return false;
    }


    public function editar_visitas_comerciales($inicio, $fin, $id){
        $sql = "UPDATE `visitas_clientes` SET  `start`=:inicio,`end`=:fin WHERE `id` = :id";
        // Preparar Conexion.
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':inicio', $inicio, PDO::PARAM_STR);
        $stmt->bindParam(':fin', $fin, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            // Asignando Datos ARRAY => SQL.
            if ($stmt->execute()) {
                return true;
            }else{
                return false;
            }
    }


    public function editar_visitas_comercialestodo($id,$id_tipo_visita,$status, $id_cliente, $id_obra,  $obs_visit, $id_asesora_comercial,  $inicio, $fin){
        $sql = "UPDATE `visitas_clientes` SET id_comercial = :id_comercial,  `status`= :status , `id_tipo_visita`= :id_tipo_visita,`tipo_visita`= :tipo_visita,`id_cliente`= :id_cliente,`nombre_cliente`=:nombre_cliente,`id_obra`=:id_obra,`nombre_obra`= :nombre_obra,`observaciones`= :obs,`start`= :inicio,`end`= :fin WHERE `id` = :id;";

        // Preparar Conexion.
        $stmt = $this->con->prepare($sql);
        $nombre_tipo_visita = SELF::get_nombre_tipo_visita($this->con,$id_tipo_visita);
        $nombre_cliente = SELF::get_nombre_cliente($this->con,$id_cliente);
        $nombre_obra = SELF::get_nombre_tipo_visita($this->con,$id_obra);
        
        $stmt->bindParam(':id_comercial', $id_asesora_comercial, PDO::PARAM_INT);
        $stmt->bindParam(':status', $status, PDO::PARAM_INT);
        $stmt->bindParam(':id_tipo_visita', $id_tipo_visita, PDO::PARAM_INT);
        $stmt->bindParam(':tipo_visita', $nombre_tipo_visita, PDO::PARAM_STR);
        $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_cliente', $nombre_cliente, PDO::PARAM_STR);
        $stmt->bindParam(':id_obra', $id_obra, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_obra', $nombre_obra, PDO::PARAM_STR);
        $stmt->bindParam(':obs', $obs_visit, PDO::PARAM_STR);
        $stmt->bindParam(':inicio', $inicio, PDO::PARAM_STR);
        $stmt->bindParam(':fin', $fin, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            // Asignando Datos ARRAY => SQL.
            if ($stmt->execute()) {
                return true;
            }else{
                return false;
            }
 

    }

    public function crear_visitas_comerciales($asesora_comercial, $id_objetivo_visita,$id_cliente, $id_obra,$obs_visit, $inicio, $fin){
        
        $sql = "INSERT INTO `visitas_clientes`( id_comercial, `id_tipo_visita`,`status` ,  `tipo_visita`, `id_cliente`, `nombre_cliente`, `id_obra`, `nombre_obra`, `observaciones`,`start`, `end`, fecha) VALUES (:comercial, :id_tipo_visita, :status ,:tipo_visita, :id_cliente, :nombre_cliente, :id_obra, :nombre_obra, :obs, :inicio, :fin, :fecha)";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        $nombre_tipo_visita = SELF::get_nombre_tipo_visita($this->con,$id_objetivo_visita);
        $nombre_cliente = SELF::get_nombre_cliente($this->con,$id_cliente);
        $nombre_obra = SELF::get_nombre_tipo_visita($this->con,$id_obra);
        $status = 2;
        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':comercial', $asesora_comercial, PDO::PARAM_INT);
        $stmt->bindParam(':id_tipo_visita', $id_objetivo_visita, PDO::PARAM_INT);
        $stmt->bindParam(':status', $status, PDO::PARAM_INT);
        $stmt->bindParam(':tipo_visita', $nombre_tipo_visita, PDO::PARAM_STR);
        $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_cliente', $nombre_cliente, PDO::PARAM_STR);
        $stmt->bindParam(':id_obra', $id_obra, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_obra', $nombre_obra, PDO::PARAM_STR);
        $stmt->bindParam(':obs', $obs_visit, PDO::PARAM_STR);
        $stmt->bindParam(':fecha', $inicio, PDO::PARAM_STR);
        $stmt->bindParam(':inicio', $inicio, PDO::PARAM_STR);
        $stmt->bindParam(':fin', $fin, PDO::PARAM_STR);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }

    }

    public static function get_nombre_tipo_visita($con, $id)
    {
        $id = $id;
        $sql = "SELECT `id`, `descripcion` FROM `tipo_visitas_clientes` WHERE `id` = :id";
        $stmt = $con->prepare($sql);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['descripcion'];
                }
                
            } else {
                return false;
            }
        } else {
            return false;
        }
        //Cerrar Conexion
    
    }
    

    

    public static function get_nombre_cliente($con, $id)
    {
        $id = $id;
        $sql = "SELECT `ct1_IdTerceros`, `ct1_RazonSocial` FROM `ct1_terceros` WHERE `ct1_IdTerceros` = :id";
        $stmt = $con->prepare($sql);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['ct1_RazonSocial'];
                }
                
            } else {
                return false;
            }
        } else {
            return false;
        }
        //Cerrar Conexion
        
    }


    public  static function get_nombre_obra($con, $id)
    {
        $id = $id;
        $sql = "SELECT `ct5_IdObras`, `ct5_NombreObra` FROM `ct5_obras` WHERE `ct5_IdObras` = :id";
        $stmt = $con->prepare($sql);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['ct5_NombreObra'];
                }
                
            } else {
                return false;
            }
        } else {
            return false;
        }
        //Cerrar Conexion
        
    }



/**
 * CARGAR VISITAS COMERCIALES 
 */
public function get_visitas_comerciales()
    {
        $sql = "SELECT * FROM visitas_clientes";
        // Preparar Conexion.
        $stmt = $this->con->prepare($sql);
        // Asignando Datos ARRAY => SQL.
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    // Obtener los datos de los valores.

                    switch (intval($fila['status'])){

                        case 1:
                            $color = 'green';
                        break;

                        case 2:
                            $color = 'orange';
                        break;
                        case 3:
                            $color = 'red';
                        break;
                        case 4:
                            $color = 'Purple';
                        break;
                        case 5:
                            $color = 'Olive';
                        break;
                        case 6:
                            $color = 'Teal';
                        break;
                        case 7:
                            $color = 'Lightblue';
                        break;

                        default:
                        # code...
                        break;
                    }

                   

                    if (true) {
                        $events[] = [
                            "id" => $fila['id'],
                            'title' => $fila['nombre_cliente'],
                            'descrition' => $fila['tipo_visita'],
                            'start' => $fila['start'],
                            'end' => $fila['end'],
                            'color' => $color,
                            'tex tcolor' => 'black'
                        ];
                    }else{
                        $events[] = [
                            "id" => $fila['id'],
                            'title' => $fila['title'],
                            'descrition' => $fila['descrition'],
                            'start' => $fila['start'],
                            'end' => $fila['end'],
                            'color' => 'gray',
                            'tex tcolor' => 'black'
                        ];
                    } 
                }
                return $events;
            }
        }
        return false;
    }



    public function get_visitas_comerciales_for_comercial($id_comercial)
    {
        $sql = "SELECT * FROM `visitas_clientes` WHERE `id_comercial` = :id_comercial";
        
        // Preparar Conexion.
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_comercial', $id_comercial, PDO::PARAM_INT);

        // Asignando Datos ARRAY => SQL.
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    // Obtener los datos de los valores.

                    switch (intval($fila['status'])){

                        case 1:
                            $color = 'green';
                        break;

                        case 2:
                            $color = 'orange';
                        break;
                        case 3:
                            $color = 'red';
                        break;
                        case 4:
                            $color = 'Purple';
                        break;
                        case 5:
                            $color = 'Olive';
                        break;
                        case 6:
                            $color = 'Teal';
                        break;
                        case 7:
                            $color = 'Lightblue';
                        break;

                        default:
                        # code...
                        break;
                    }

                   

                    if (true) {
                        $events[] = [
                            "id" => $fila['id'],
                            'title' => $fila['nombre_cliente'],
                            'descrition' => $fila['tipo_visita'],
                            'start' => $fila['start'],
                            'end' => $fila['end'],
                            'color' => $color,
                            'tex tcolor' => 'black'
                        ];
                    }else{
                        $events[] = [
                            "id" => $fila['id'],
                            'title' => $fila['title'],
                            'descrition' => $fila['descrition'],
                            'start' => $fila['start'],
                            'end' => $fila['end'],
                            'color' => 'gray',
                            'tex tcolor' => 'black'
                        ];
                    } 
                }
                return $events;
            }
        }
        return false;
    }

    public function get_nombre_asesora_comercial_cliente($id_cliente)
    {
        $id = $id_cliente;
        $sql = "SELECT `ct1_id_asesora` FROM `ct1_terceros` WHERE `ct1_IdTerceros` = :id";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return SELF::get_nombre_asesora_comercial($this->con, $fila['ct1_id_asesora']);
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
        //Cerrar Conexion
        
    }

    public  function get_nombre_asesora_comercial2( $id_asesora_comercial)
    {
        
        $sql = "SELECT  `ct1_RazonSocial` FROM `ct1_terceros` WHERE `ct1_IdTerceros` = :id";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id', $id_asesora_comercial, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['ct1_RazonSocial'];
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
        //Cerrar Conexion
        
    }

    public static function get_nombre_asesora_comercial($con, $id_asesora_comercial)
    {
        
        $sql = "SELECT  `ct1_RazonSocial` FROM `ct1_terceros` WHERE `ct1_IdTerceros` = :id";
        $stmt = $con->prepare($sql);

        $stmt->bindParam(':id', $id_asesora_comercial, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['ct1_RazonSocial'];
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
        //Cerrar Conexion
        
    }


    public function get_visitas_comerciales_for_comercial2($id_comercial)
    {
        $sql = "SELECT `id`, `status`, `fecha`, `id_comercial`, `id_tipo_visita`, `tipo_visita`, `id_cliente`, `nombre_cliente`, `id_obra`, `nombre_obra`, `observaciones`, `start`, `end` FROM `visitas_clientes`  INNER JOIN ct1_terceros ON visitas_clientes.`id_cliente` = ct1_terceros.ct1_IdTerceros WHERE ct1_terceros.ct1_id_asesora =  :id_comercial";
        // Preparar Conexion.
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_comercial', $id_comercial, PDO::PARAM_INT);

        // Asignando Datos ARRAY => SQL.
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    // Obtener los datos de los valores.

                    switch (intval($fila['status'])){

                        case 1:
                            $color = 'green';
                        break;

                        case 2:
                            $color = 'orange';
                        break;
                        case 3:
                            $color = 'red';
                        break;
                        case 4:
                            $color = 'Purple';
                        break;
                        case 5:
                            $color = 'Olive';
                        break;
                        case 6:
                            $color = 'Teal';
                        break;
                        case 7:
                            $color = 'Lightblue';
                        break;

                        default:
                        # code...
                        break;
                    }

                   

                    if (true) {
                        $events[] = [
                            "id" => $fila['id'],
                            'title' => $fila['nombre_cliente'],
                            'descrition' => $fila['tipo_visita'],
                            'start' => $fila['start'],
                            'end' => $fila['end'],
                            'color' => $color,
                            'tex tcolor' => 'black'
                        ];
                    }else{
                        $events[] = [
                            "id" => $fila['id'],
                            'title' => $fila['title'],
                            'descrition' => $fila['descrition'],
                            'start' => $fila['start'],
                            'end' => $fila['end'],
                            'color' => 'gray',
                            'tex tcolor' => 'black'
                        ];
                    } 
                }
                return $events;
            }
        }
        return false;
    }

} // fin de la clase





?>