<?php
session_start();
header('Content-Type: application/json');

require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';

$log = false;
$php_estado = false;
$php_error[] = "";
$resultado = "";
//Se crea un objeto de la clase programacion
$ClsProgramacionDiaria = new ClsProgramacionDiaria();
//id del usuario en sesion
$intIdUsuario = $_SESSION['id_usuario'];
//Nombre del usuario en sesion mediante el parametro del id del usuario
$StrNombreUsuario = $ClsProgramacionDiaria->fntGetNombreClienteObj($intIdUsuario);
//Se crea un objeto de la clase Datetime
$dtmFechaActual = new DateTime();
//Se obtiene la fecha actual con el formato completo
$dtmHoy = $dtmFechaActual->format("Y-m-d H:i:s");
if (isset($_POST['task'])) {
    //validar que la variable task tenga el valor de 1
    if ($_POST['task'] == 1) {
        //id de la programacion
        $intId = $_POST['id'];
        //estado de la programacion
        $intEstado = $ClsProgramacionDiaria->fntGetEstadosProgramacionCliente2Obj($intId);
        //Fecha inicio de la programacion
        $dtmFechaInicio = $_POST['txtInicio'];
        //Fecha final de la programacion
        $dtmFechaFin = $_POST['txtFin'];
        //Validar que modifique correctamente la programacion (Fechas)
        if ($intEstado != 1) {
            if ($ClsProgramacionDiaria->fntEditarProgramacionBool($intId, $dtmFechaInicio, $dtmFechaFin, $dtmHoy, $intIdUsuario, $StrNombreUsuario)) {
                $php_estado = true;
            } else {
                $php_error = 'ERROR';
            }
        } else {
            $php_error = 'La programacion ya fue enviada al area de logistica y no se puede hacer modificaciones';
        }
    } elseif ($_POST['task'] == 3) {
        //id de la programacion
        $intId = $_POST['id'];
        $intEstado = $ClsProgramacionDiaria->fntGetEstadosProgramacionCliente2Obj($intId);
        //validar que la programacion se elimine correctamente mediante el parametro de el id de la programacion
        if ($intEstado == 1) {
            if ($ClsProgramacionDiaria->fntEliminarProgramacionDiariaObj($intId)) {
                $php_estado = true;
            } else {
                $php_error = 'ERROR';
            }
        } else {
            $php_error = 'La programacion ya fue enviada al area de logistica y no se puede eliminar';
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
