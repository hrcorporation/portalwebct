<?php

class ClsProgramacion extends conexionPDO
{
    protected $con;
    // Iniciar Conexion
    public function __construct()
    {
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
    }
    //////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////
    // Traer el nombre del cliente.
    public function get_nombre_cliente($id_usuario)
    {
        $this->id = $id_usuario;
        // sentencia SQL
        $sql = "SELECT ct1_terceros.ct1_RazonSocial FROM ct1_gestion_acceso INNER JOIN ct1_terceros ON ct1_gestion_acceso.id_cliente = ct1_terceros.ct1_IdTerceros WHERE `id_residente` = :id_usuario";
        // Preparar Conexion
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_usuario', $this->id, PDO::PARAM_INT);
        // ejecuta la sentencia SQL
        if ($stmt->execute()) {
            $num_reg = $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    return $fila['ct1_RazonSocial'];
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    /**** OPTION SELECT  CLIENTE********/
    //Select de los clientes
    public function option_cliente_edit_cliente($id_usuario, $id_cliente = null)
    {
        $this->id = $id_usuario;
        $sql = "SELECT DISTINCT ct1_terceros.ct1_IdTerceros, ct1_terceros.ct1_NumeroIdentificacion, ct1_terceros.ct1_RazonSocial 
        FROM ct1_gestion_acceso 
        INNER JOIN ct1_terceros ON ct1_gestion_acceso.id_cliente = ct1_terceros.ct1_IdTerceros 
        WHERE id_residente = :id_usuario";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_usuario', $this->id, PDO::PARAM_INT);
        // Asignando Datos ARRAY => SQL
        // Ejecutar 
        if ($stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg == 1) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    return '<h5>' . $fila['ct1_RazonSocial'] . '</h5>';
                }
            } elseif ($num_reg > 1) {
                $option = '<select name="txtCliente" id="txtCliente" class="form-control select2" style="width: 100%;">';
                $option .= "<option  selected = 'true'> Seleccione un Cliente </option>";
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    if ($id_cliente == $fila['ct1_IdTerceros']) {
                        $selection = " selected='true' ";
                    } else {
                        $selection = "";
                    }
                    $option .= '<option value="' . $fila['ct1_IdTerceros'] . '" ' . $selection . ' >' . $fila['ct1_NumeroIdentificacion'] . ' - ' . $fila['ct1_RazonSocial'] . ' </option>';
                }
                $option .= '</select>';
                return $option;
            } elseif ($num_reg == 0) {
                return '<h5> No hay clientes asignados </h5>';
            }
        } else {
            return false;
        }

        //Cerrar Conexion
        $this->PDO->closePDO();

        //resultado
    }
    /**** OPTION SELECT OBRA ********/
    function option_obra_edit($id_usuario, $nombre, $id_cliente = null)
    {
        $option = '<label for="txtObra" class="col-sm-2 form-label h4">Obra</label>';
        $option .= "<br>";
        $this->id_usuario = $id_usuario;
        $this->id_cliente = $id_cliente;
        $sql = "SELECT ct1_gestion_acceso.id_obra, ct5_obras.ct5_NombreObra
         FROM ct1_gestion_acceso 
         INNER JOIN ct5_obras ON ct1_gestion_acceso.id_obra = ct5_obras.ct5_IdObras 
         WHERE id_residente = :id_usuario AND ct1_gestion_acceso.id_cliente = :id_cliente";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':id_usuario', $this->id_usuario, PDO::PARAM_INT);
        $stmt->bindParam(':id_cliente', $this->id_cliente, PDO::PARAM_INT);
        // Ejecutar 
        $stmt->execute();
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $url = $nombre . "/index.php?id_cliente=" . $id_cliente . "&id_obra=" . $fila['id_obra'];
            $option .= '<a  class = "btn btn-primary" href="' . $url . '">' . $fila["ct5_NombreObra"] . '</a>';
            $option .= " ";
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
        //resultado
        return $option;
    }
    /**** OPTION SELECT OBRA ********/
    function option_obra_edit_uno($id_usuario, $id)
    {
        $nombre = "";
        if ($id == 1) {
            $nombre = "semanal";
        } else {
            $nombre = "diaria";
        }
        $option = '<label for="txtObra" class="col-sm-2 form-label h4">Obra</label>';
        $option .= "<br>";
        $this->id_usuario = $id_usuario;
        $sql = "SELECT ct1_gestion_acceso.id_cliente, ct1_gestion_acceso.id_obra, ct5_obras.ct5_NombreObra
          FROM ct1_gestion_acceso 
          INNER JOIN ct5_obras ON ct1_gestion_acceso.id_obra = ct5_obras.ct5_IdObras 
          WHERE id_residente = :id_usuario";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':id_usuario', $this->id_usuario, PDO::PARAM_INT);
        // Ejecutar 
        $stmt->execute();
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $url = $nombre . "/index.php?id_cliente=" . $fila['id_cliente'] . "&id_obra=" . $fila['id_obra'];
            $option .= '<a  class = "btn btn-primary" href="' . $url . '">' . $fila["ct5_NombreObra"] . '</a>';
            $option .= " ";
        }
        //Cerrar Conexion
        $this->PDO->closePDO();
        //resultado
        return $option;
    }

    //Sumar horas
    function sumar($hora1, $hora2)
    {
        list($h, $m, $s) = explode(':', $hora2); //Separo los elementos de la segunda hora.
        $a = new DateTime($hora1); //Creo un DateTime.
        $b = new DateInterval(sprintf('PT%sH%sM%sS', $h, $m, $s)); //Creo un DateInterval.
        $a->add($b); //SUMO las horas.
        return $a->format('Y-m-d H:i:s'); //Retorno la Suma.
    }

    function multiplicar_horas($hora1, $hora2)
    {
        $hora2 = explode(":", $hora2);
        $temp = 0;
        //sumo segundos
        $segundos = (int)$hora1 * (int)$hora2[2];
        while ($segundos >= 60) {
            $segundos = $segundos - 60;
            $temp++;
        }
        //sumo minutos
        $minutos = (int)$hora1 * (int)$hora2[1] + $temp;
        $temp = 0;
        while ($minutos >= 60) {
            $minutos = $minutos - 60;
            $temp++;
        }
        //sumo horas
        $horas = (int)$hora1 * (int)$hora2[0] + $temp;
        if ($horas < 10)
            $horas = '0' . $horas;
        if ($minutos < 10)
            $minutos = '0' . $minutos;
        if ($segundos < 10)
            $segundos = '0' . $segundos;
        $sum_hrs = $horas . ':' . $minutos . ':' . $segundos;
        return ($sum_hrs);
    }
}
