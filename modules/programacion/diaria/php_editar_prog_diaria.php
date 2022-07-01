<?php
session_start();
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

$log = false;
$php_estado = false;
$php_error[] = "";
$resultado = "";
//Se crea un objeto de la clase programacion
$ClsProgramacionDiaria = new ClsProgramacionDiaria();
//id del usuario en sesion
$id_usuario = $_SESSION['id_usuario'];
//Nombre del usuario en sesion mediante el parametro del id del usuario
$nombre_usuario = $ClsProgramacionDiaria->fntGetNombreClienteObj($id_usuario);
//Se crea un objeto de la clase Datetime
$fecha_actual = new DateTime();
//Se obtiene la fecha actual con el formato completo
$hoy = $fecha_actual->format("Y-m-d H:i:s");
if (isset($_POST['task'])) {
    //validar que la variable task tenga el valor de 1
    if ($_POST['task'] == 1) {
        //id de la programacion
        $id = $_POST['id'];
        //Fecha inicio de la programacion
        $inicio = $_POST['txtInicio'];
        //Fecha final de la programacion
        $fin = $_POST['txtFin'];
        //Validar que modifique correctamente la programacion (fechas)
        if ($ClsProgramacionDiaria->fntEditarProgramacionBool($id, $inicio, $fin, $hoy, $id_usuario, $nombre_usuario)) {
            $php_estado = true;
        }
    }elseif ($_POST['task'] == 3) {
        //Validacion de roles 
        //id de la programacion
        $id = $_POST['id'];
        //validar que la programacion se elimine correctamente mediante el parametro de el id de la programacion
        if ($ClsProgramacionDiaria->fntEliminarProgramacionDiariaObj($id)) {
            $php_estado = true;
        }
    }
}
$datos = array(
    'POST' => $_POST,
    'estado' => $php_estado,
    'errores' => $php_error,
    'result' => $resultado,
    'task' => $_POST['task']
);

echo json_encode($datos, JSON_FORCE_OBJECT);
