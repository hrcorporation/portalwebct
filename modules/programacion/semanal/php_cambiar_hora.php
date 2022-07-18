<?php
session_start();
header('Content-Type: application/json');
require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';
$clsProgramacionSemanal = new ClsProgramacionSemanal();
$log = false;
$php_estado = false;
$php_error[] = "";
$resultado = "";

if (empty($_POST['dtmHora'])) {
    $hora = "06:00:00";
} else {
    $hora = $_POST['dtmHora'];
}

if (isset($_POST['cbxUsuario'])) {
    $id_usuario = $_POST['cbxUsuario'];
} else {
    $id_usuario = 0;
}

if ($clsProgramacionSemanal->fntCambiarHoraObj($hora, $id_usuario)) {
    //Si pasa la validacion se retorna verdadero(true)
    $php_estado = true;
} else {
    //De lo contrario mostrara un mensaje mostrando que no se guardo
    $php_error = 'No Guardo Correctamente';
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $php_error,
    'result' => $resultado,
);
echo json_encode($datos, JSON_FORCE_OBJECT);
