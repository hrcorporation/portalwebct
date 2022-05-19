<?php
class eventos extends conexionPDO
{
    protected $con;

    // Iniciar Conexion
    public function __construct()
    {
        $this->PDO = new conexionPDO();
        $this->con = $this->PDO->connect();
    }

    function eliminar_event($id_evento)
    {
        $sql = "DELETE FROM `eventos` WHERE `eventos`.`id` = :id_evento";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        // Asignando Datos ARRAY => SQ
        $stmt->bindParam(':id_evento', $id_evento, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    function editar_event($id_evento, $start, $end)
    {
        $sql = "UPDATE `eventos` SET `inicio`= :inicio, `fin`= :fin WHERE `id` = :id_evento";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        // Asignando Datos ARRAY => SQ
        $stmt->bindParam(':inicio', $start, PDO::PARAM_STR);
        $stmt->bindParam(':fin', $end, PDO::PARAM_STR);
        $stmt->bindParam(':id_evento', $id_evento, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    function editar_todo_event($id_evento, $titulo, $start, $end)
    {
        $sql = "UPDATE `eventos` SET `titulo`= :titulo, `inicio`= :inicio, `fin`= :fin WHERE `id` = :id_evento";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        // Asignando Datos ARRAY => SQL
        $stmt->bindParam(':titulo', $titulo, PDO::PARAM_STR);
        $stmt->bindParam(':inicio', $start, PDO::PARAM_STR);
        $stmt->bindParam(':fin', $end, PDO::PARAM_STR);
        $stmt->bindParam(':id_evento', $id_evento, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    function cargar_data_event($id_evento)
    {
        $sql = "SELECT `id`, `titulo`, `inicio`, `fin` FROM `eventos` WHERE id = :id_evento ";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        // Asignando Datos ARRAY => SQ
        $stmt->bindParam(':id_evento', $id_evento, PDO::PARAM_INT);
        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $datos['id'] = $fila['id'];
                    $datos['title'] = $fila['titulo'];
                    $datos['start'] = $fila['inicio'];
                    $datos['end'] = $fila['fin'];
                    $datos['color'] = 'orange';
                    $datos['textcolor'] = 'black';
                }
                return $datos;
            }
        }
        return false;
    }

    function crear_eventos($titulo, $inicio, $fin)
    {
        $sql = "INSERT INTO `eventos` (`titulo`, `inicio`, `fin`) VALUES (:titulo, :inicio, :fin)";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        // Asignando Datos ARRAY => SQ
        $stmt->bindParam(':titulo', $titulo, PDO::PARAM_STR);
        $stmt->bindParam(':inicio', $inicio, PDO::PARAM_STR);
        $stmt->bindParam(':fin', $fin, PDO::PARAM_STR);
        if ($result = $stmt->execute()) {
            return true;
        }
        return false;
    }

    function cargar_eventos()
    {
        $sql = "SELECT `id`, `titulo`, `inicio`, `fin` FROM `eventos`";
        //Preparar Conexion
        $stmt = $this->con->prepare($sql);
        // Asignando Datos ARRAY => SQ
        //$stmt->bindParam(':id_remision', $this->id_remision, PDO::PARAM_INT);
        if ($result = $stmt->execute()) {
            $num_reg =  $stmt->rowCount();
            if ($num_reg > 0) {
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                    $events[] = [
                        "id" => $fila['id'],
                        'title' => $fila['titulo'],
                        'start' => $fila['inicio'],
                        'end' => $fila['fin'],
                        'color' => 'orange',
                        'textcolor' => 'black'
                    ];
                }
                return $events;
            }
        }
        return false;
    }
}
