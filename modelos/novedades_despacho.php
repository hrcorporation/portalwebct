<?php

class novedades_despacho extends conexionPDO
{
    protected $con;

    // Iniciar Conexion
    public function __construct()
    {
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
    }


    function select_novedades_cli_obra($id_novedad,$id_cliente,$id_obra){
        $sql = "SELECT novedades_por_remision.id, novedades_por_remision.id_novedad,novedades_por_remision.id_remision, novedades_por_remision.cod_remision,  novedades_por_remision.id_tipo_novedad,novedades_por_remision.tipo_novedad, novedades_por_remision.area_afectada, novedades_por_remision.novedad,novedades_por_remision.observacion FROM `novedades_por_remision` INNER JOIN ct26_remisiones ON novedades_por_remision.id_remision = ct26_remisiones.ct26_id_remision WHERE novedades_por_remision.id_novedad  = :id_novedad AND ct26_remisiones.ct26_idcliente = :id_cliente AND ct26_remisiones.ct26_idObra = :id_obra ";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_novedad', $id_novedad, PDO::PARAM_INT);
        $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
        $stmt->bindParam(':id_obra', $id_obra, PDO::PARAM_INT);

        // Ejecutar 
         if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id'] = $fila['id'];
                    $datos['id_novedad'] = $fila['id_novedad'];
                    $datos['id_remision'] = $fila['id_remision'];
                    $datos['cod_remision'] = $fila['cod_remision'];
                    $datos['tipo_novedad'] = $fila['tipo_novedad'];
                    $datos['novedad'] = $fila['novedad'];
                    $datos['area_afectada'] = $fila['area_afectada'];
                    $datos['observacion'] = $fila['observacion'];
                   
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


    function select_novedad_remisiones($id_remisiones){
        $sql = "SELECT `id`, `id_novedad`, `id_remision`, `cod_remision`, `id_tipo_novedad`, `tipo_novedad`, `id_area_afectada`, `area_afectada`, `id_listado_novedad`, `novedad`, `observacion` FROM `novedades_por_remision` WHERE `id_remision` = :id  ";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id', $id_remisiones, PDO::PARAM_STR);

        // Ejecutar 
         if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id'] = $fila['id'];
                    $datos['id_novedad'] = $fila['id_novedad'];
                    $datos['id_tipo_novedad'] = $fila['id_tipo_novedad'];
                    $datos['tipo_novedad'] = $fila['tipo_novedad'];
                    $datos['id_area_afectada'] = $fila['id_area_afectada'];
                    $datos['area_afectada'] = $fila['area_afectada'];
                    $datos['id_listado_novedad'] = $fila['id_listado_novedad'];
                    $datos['novedad'] = $fila['novedad'];
                    $datos['observacion'] = $fila['observacion'];
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

    function insert_novedad_remisiones($id_novedad,$id_remision,$cod_remision,$id_tipo_novedad, $tipo_novedad, $id_area_afectada,$area_afectada, $id_listado_novedad, $novedad, $observacion){
        $this->id_novedad = $id_novedad;
        $this->id_remision = $id_remision;
        $this->cod_remision = $cod_remision;
        $this->id_tipo_novedad = $id_tipo_novedad;
        $this->tipo_novedad = $tipo_novedad;
        $this->id_area_afectada = $id_area_afectada;
        $this->area_afectada = $area_afectada;
        $this->id_listado_novedad = $id_listado_novedad;
        $this->novedad = $novedad;
        $this->observacion = $observacion;
        $sql = "INSERT INTO `novedades_por_remision`( `id_novedad`, `id_remision`, `cod_remision`, `id_tipo_novedad`, `tipo_novedad`, `id_area_afectada`, `area_afectada`, `id_listado_novedad`, `novedad`, `observacion`) VALUES (:id_novedad,:id_remision,:cod_remision,:id_tipo_novedad,:tipo_novedad,:id_area_afectada,:area_afectada, :id_listado_novedad, :novedad, :observacion )  ";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id_novedad', $this->id_novedad, PDO::PARAM_INT);
        $stmt->bindParam(':id_remision', $this->id_remision, PDO::PARAM_INT);
        $stmt->bindParam(':cod_remision', $this->cod_remision, PDO::PARAM_INT);
        $stmt->bindParam(':id_tipo_novedad', $this->id_tipo_novedad, PDO::PARAM_INT);
        $stmt->bindParam(':tipo_novedad', $this->tipo_novedad, PDO::PARAM_STR);
        $stmt->bindParam(':id_area_afectada', $this->id_area_afectada, PDO::PARAM_INT);
        $stmt->bindParam(':area_afectada', $this->area_afectada, PDO::PARAM_STR);
        $stmt->bindParam(':id_listado_novedad', $this->id_listado_novedad, PDO::PARAM_INT);
        $stmt->bindParam(':novedad', $this->novedad, PDO::PARAM_STR);
        $stmt->bindParam(':observacion', $this->observacion, PDO::PARAM_STR);
        // Ejecutar 
         if ($result = $stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function select_novedad_generales($id_novedad){
        $sql = "SELECT `id`, `id_novedad`, `id_tipo_novedad`, `tipo_novedad`, `id_area_afectada`, `area_afectada`, `id_listado_novedad`, `novedad`, `observacion` FROM `novedades_generales` WHERE `id_novedad` = :id  ";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id', $id_novedad, PDO::PARAM_STR);

        // Ejecutar 
         if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id'] = $fila['id'];
                    $datos['id_novedad'] = $fila['id_novedad'];
                    $datos['id_tipo_novedad'] = $fila['id_tipo_novedad'];
                    $datos['tipo_novedad'] = $fila['tipo_novedad'];
                    $datos['id_area_afectada'] = $fila['id_area_afectada'];
                    $datos['area_afectada'] = $fila['area_afectada'];
                    $datos['id_listado_novedad'] = $fila['id_listado_novedad'];
                    $datos['novedad'] = $fila['novedad'];
                    $datos['observacion'] = $fila['observacion'];
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



    public function guardar_novedades_generales($id_novedad,$id_tipo_novedad, $tipo_novedad, $id_area_afectada,$area_afectada, $id_listado_novedad, $novedad, $observacion)
    {
        $this->id_novedad = $id_novedad;
        $this->id_tipo_novedad = $id_tipo_novedad;
        $this->tipo_novedad = $tipo_novedad;
        $this->id_area_afectada = $id_area_afectada;
        $this->area_afectada = $area_afectada;
        $this->id_listado_novedad = $id_listado_novedad;
        $this->novedad = $novedad;
        $this->observacion = $observacion;


        $sql = "INSERT INTO `novedades_generales`( `id_novedad`, `id_tipo_novedad`, `tipo_novedad`, `id_area_afectada`, `area_afectada`, `id_listado_novedad`, `novedad`, `observacion`) VALUES (:id_novedad,:id_tipo_novedad,:tipo_novedad,:id_area_afectada,:area_afectada, :id_listado_novedad, :novedad, :observacion )";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_novedad', $this->id_novedad, PDO::PARAM_INT);
        $stmt->bindParam(':id_tipo_novedad', $this->id_tipo_novedad, PDO::PARAM_INT);
        $stmt->bindParam(':tipo_novedad', $this->tipo_novedad, PDO::PARAM_STR);
        $stmt->bindParam(':id_area_afectada', $this->id_area_afectada, PDO::PARAM_INT);
        $stmt->bindParam(':area_afectada', $this->area_afectada, PDO::PARAM_STR);
        $stmt->bindParam(':id_listado_novedad', $this->id_listado_novedad, PDO::PARAM_INT);
        $stmt->bindParam(':novedad', $this->novedad, PDO::PARAM_STR);
        $stmt->bindParam(':observacion', $this->observacion, PDO::PARAM_STR);
        if ($stmt->execute()) {
            return true;
            
        } else {
            return false;
        }

    }


    public function get_novedad($id)
    {
        $this->id = $id;
        $sql = "SELECT `id`, `descripcion` FROM `listado_novedades`  WHERE `id` = :id";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
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
        $this->PDO->closePDO();
    }

    public function get_area_novedad($id)
    {
        $this->id = $id;
        $sql = "SELECT `id`, `descripcion` FROM `areas_afectadas_novedades`  WHERE `id` = :id";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
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
        $this->PDO->closePDO();
    }

    public function get_cod_remision($id)
    {
        $this->id = $id;
        $sql = "SELECT `ct26_codigo_remi` FROM `ct26_remisiones` WHERE `ct26_id_remision` = :id";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    return $fila['ct26_codigo_remi'];
                }
                
            } else {
                return false;
            }
        } else {
            return false;
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
    }

    public function get_tipo_novedad($id)
    {
        $this->id = $id;
        $sql = "SELECT `id`, `descripcion` FROM `tipo_novedad`  WHERE `id` = :id";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
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
        $this->PDO->closePDO();
    }


    function option_novedades($tipo_novedad,$subtipo_novedad,$id_novedades = null)
    {
        $option = "<option  selected='true' value='0'> Seleccione un tipo Novedades</option>";
        $sql = "SELECT `id`, `descripcion` FROM `listado_novedades` WHERE id_tipo_novedad = :id_tipo_novedad AND id_subtipo_novedad  = :id_subtipo_novedad ";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':id_tipo_novedad', $tipo_novedad, PDO::PARAM_INT);
        $stmt->bindParam(':id_subtipo_novedad', $subtipo_novedad, PDO::PARAM_INT);
        // Ejecutar 
        if($result = $stmt->execute())
        {
            while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if ($id_novedades == $fila['id']) {
                    $selection = "selected='true'";
                } else {
                    $selection = "";
                }
                $option .= '<option value="' . $fila['id'] . '" '  . ' >' . $fila['descripcion'] . ' </option>';
            }
        }
        
        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        return $option;
    }

    function option_tipo_novedades($id_tipo_novedades = null)
    {
        $option = "<option  selected='true' value='0'> Seleccione un tipo Novedades</option>";
        $sql = "SELECT `id`, `descripcion` FROM `tipo_novedad`";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        //$stmt->bindParam(':id_tercero', $this->id, PDO::PARAM_INT);
        // Ejecutar 
        if($result = $stmt->execute())
        {
            while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if ($id_tipo_novedades == $fila['id']) {
                    $selection = "selected='true'";
                } else {
                    $selection = "";
                }
                $option .= '<option value="' . $fila['id'] . '" '  . ' >' . $fila['descripcion'] . ' </option>';
            }
        }
        
        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        return $option;
    }

    function option_areas_novedades($id_tipo_novedad, $id_subtipo_novedades = null)
    {
        $option = "<option  selected='true' value='0'> Seleccione un tipo Novedades</option>";
        $sql = "SELECT `id`, `descripcion` FROM `areas_afectadas_novedades` WHERE id_tipo_novedad = :id_tipo_novedad";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);

        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':id_tipo_novedad', $id_tipo_novedad, PDO::PARAM_INT);
        // Ejecutar 
        if($result = $stmt->execute())
        {
            while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if ($id_subtipo_novedades == $fila['id']) {
                    $selection = "selected='true'";
                } else {
                    $selection = "";
                }
                $option .= '<option value="' . $fila['id'] . '" '  . ' >' . $fila['descripcion'] . ' </option>';
            }
        }
        
        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
        return $option;
    }


    public function get_nombre_cliente($id)
    {
        $this->id = $id;
        $sql = "SELECT `ct1_IdTerceros`, `ct1_RazonSocial` FROM `ct1_terceros` WHERE `ct1_IdTerceros` = :id";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
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
        $this->PDO->closePDO();
    }


    public function get_nombre_obra($id)
    {
        $this->id = $id;
        $sql = "SELECT `ct5_IdObras`, `ct5_NombreObra` FROM `ct5_obras` WHERE `ct5_IdObras` = :id";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
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
        $this->PDO->closePDO();
    }

    function insertar_novedad_despacho($fecha)
    {
        $this->fecha = $fecha;
        $sql = "INSERT INTO `novedades_despacho`(`fecha_novedad`) VALUES (:fecha_novedad)";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':fecha_novedad', $this->fecha, PDO::PARAM_STR);
        if($result = $stmt->execute()){
            return $id_insert = $this->con->lastInsertId();
        }else{
            return false;
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
        
    }
    function select_novedad_despacho_for_id($id){
        $sql = "SELECT `id`, `fecha_novedad`, `estatus`, `observaciones` FROM `novedades_despacho` WHERE id = :id  ";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);

        // Ejecutar 
         if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id'] = $fila['id'];
                    $datos['fecha'] = $fila['fecha_novedad'];
                    $datos['estatus'] = $fila['estatus'];
                    $datos['observacion'] = $fila['observaciones'];
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


    function select_novedad_despacho_index(){
        $sql = "SELECT `id`, `fecha_novedad`, `estatus`, `observaciones` FROM `novedades_despacho`  ";
        $stmt = $this->con->prepare($sql);

        // Ejecutar 
         if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id'] = $fila['id'];
                    $datos['fecha'] = $fila['fecha_novedad'];
                    $datos['estatus'] = $fila['estatus'];
                    $datos['observacion'] = $fila['observaciones'];
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

    function select_novedad_despacho($fecha){
        $sql = "SELECT `id`, `fecha_novedad`, `estatus`, `observaciones` FROM `novedades_despacho` WHERE fecha_novedad = :fecha_novedad  ";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':fecha_novedad', $fecha, PDO::PARAM_STR);

        // Ejecutar 
         if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id'] = $fila['id'];
                    $datos['fecha'] = $fila['fecha_novedad'];
                    $datos['estatus'] = $fila['estatus'];
                    $datos['observacion'] = $fila['observaciones'];
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

    function insert_datos_cliente($id_novedad, $id_cliente, $nombre_cliente, $id_obra, $nombre_obra){
        $this->id_novedad = $id_novedad;
        $this->id_cliente = $id_cliente;
        $this->nombre_cliente = $nombre_cliente;
        $this->id_obra = $id_obra;
        $this->nombre_obra = $nombre_obra;
        $sql = "INSERT INTO `novedades_has_clientes`(`id_novedad`, `id_cliente`, `nombre_cliente`, `id_obra`, `nombre_obra`) VALUES (:id_novedad, :id_cliente, :nombre_cliente, :id_obra, :nombre_obra)";
        $stmt = $this->con->prepare($sql);

        $stmt->bindParam(':id_novedad', $this->id_novedad, PDO::PARAM_STR);
        $stmt->bindParam(':id_cliente', $this->id_cliente, PDO::PARAM_STR);
        $stmt->bindParam(':nombre_cliente', $this->nombre_cliente, PDO::PARAM_STR);
        $stmt->bindParam(':id_obra', $this->id_obra, PDO::PARAM_STR);
        $stmt->bindParam(':nombre_obra', $this->nombre_obra, PDO::PARAM_STR);

        $result = $stmt->execute();
        //Cerrar Conexion
        $this->PDO->closePDO();

        return $result;
    }

    function select_datos_cliente($id_novedad){
        $this->id_novedad = $id_novedad;
        $sql = "SELECT `id`, `id_novedad`, `id_cliente`, `nombre_cliente`, `id_obra`, `nombre_obra` FROM `novedades_has_clientes` WHERE id_novedad = :id_novedad";

        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_novedad', $this->id_novedad, PDO::PARAM_STR);
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id'] = $fila['id'];
                    $datos['cant_novedades'] = SELF::contar_novedades_despacho_for_cli_obra($this->con,$id_novedad ,$fila['id_cliente'],$fila['id_obra']);
                    $datos['id_novedad'] = $fila['id_novedad'];
                    $datos['id_cliente'] = $fila['id_cliente'];
                    $datos['nombre_cliente'] = $fila['nombre_cliente'];
                    $datos['id_obra'] = $fila['id_obra'];
                    $datos['nombre_obra'] = $fila['nombre_obra'];
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


    function delete_novedades_remi($id){
        $this->id = $id;
        $sql = "DELETE FROM `novedades_por_remision` WHERE `id` = :id";

        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
    }

    function delete_novedades_generales($id){
        $this->id = $id;
        $sql = "DELETE FROM `novedades_generales` WHERE `id` = :id";

        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
    }

    function delete_datos_clientes($id){
        $this->id = $id;
        $sql = "DELETE FROM `novedades_has_clientes` WHERE `id` = :id";

        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
    }


    public static function contar_novedades_despacho_for_cli_obra($con, $id_novedad, $id_cliente,$id_obra)
    {
        $sql = "SELECT  count(novedades_por_remision.id) as cantidad_novedades FROM `novedades_por_remision` INNER JOIN ct26_remisiones ON novedades_por_remision.id_remision = ct26_remisiones.ct26_id_remision WHERE novedades_por_remision.id_novedad  = :id_novedad AND ct26_remisiones.ct26_idcliente = :id_cliente AND ct26_remisiones.ct26_idObra = :id_obra ";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id_novedad', $id_novedad, PDO::PARAM_INT);
        $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
        $stmt->bindParam(':id_obra', $id_obra, PDO::PARAM_INT);

        // Ejecutar 
         if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
               
                    return $fila['cantidad_novedades'];
                   
                }
                
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    public static functdion contar_novedades_despacho_for_remi($con, $id_remision)
    {
        $sql = "SELECT COUNT(id) as numero_novedades FROM `novedades_por_remision` WHERE id_remision = :id_remision ";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id_remision', $id_remision, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                   return $fila['numero_novedades'];    
                }
            }else{
                return 0;
            }
        }else{
            return 0;
        }
    }
    


    function select_datos_remisiones($fecha_remi, $id_clientes,$id_obras){
        $sql = "SELECT ct26_id_remision, `ct26_codigo_remi`, `ct26_razon_social`, `ct26_nombre_obra`,  `ct26_vehiculo`, `ct26_hora_remi` ,ct26_codigo_producto, ct26_descripcion_producto FROM `ct26_remisiones`  WHERE  `ct26_fecha_remi` = :fecha_remi AND `ct26_idcliente` IN ($id_clientes)  AND `ct26_idObra` IN ($id_obras) ORDER BY `ct26_id_remision` DESC ";
     

        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':fecha_remi', $fecha_remi, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id'] = $fila['ct26_id_remision']; 
                    $datos['num_novedades'] = SELF::contar_novedades_despacho_for_remi($this->con, $fila['ct26_id_remision']);
                    $datos['ckeck'] = "<input type='checkbox' value='".$fila['ct26_id_remision']."' name='check_id_remi[]'  >";  
                    $datos['codigo_remi'] = $fila['ct26_codigo_remi'];
                    $datos['razon_social'] = $fila['ct26_razon_social'];
                    $datos['nombre_obra'] = $fila['ct26_nombre_obra'];
                    $datos['vehiculo'] = $fila['ct26_vehiculo'];
                    $datos['hora_remi'] = $fila['ct26_hora_remi'];
                    $datos['cod_producto'] = $fila['ct26_codigo_producto'];
                    $datos['nombre_producto'] = $fila['ct26_descripcion_producto'];
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
