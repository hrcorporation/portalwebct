<?php
session_start();
header('Content-Type: application/json');
require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';
$clsProgramacionSemanal = new clsProgramacionSemanal();
$log = false;
$php_estado = false;
$php_error[] = "";
$resultado = "";
// Si el campo de la hora esta vacio por defecto se guarda a las 06:00 A.M
if (empty($_POST['dtmHora'])) {
    $hora = "06:00:00";
} else {
    //De lo contrario se guarda la hora ingresada
    $hora = $_POST['dtmHora'];
}
//Si el campo del usuario no esta vacio se guarda el que esta ingresado
if (isset($_POST['cbxUsuario'])) {
    $id_usuario = $_POST['cbxUsuario'];
} else {
    //De lo contrario se guarda con 0
    $id_usuario = 0;
}
//Validar que se actualice correctamente la hora
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
