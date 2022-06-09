<?php
session_start();
header('Content-Type: application/json');

require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';
//inicializacion de algunas variables que se requieren
$log = false;
$php_estado = false;
$php_error[] = "";
$resultado = "";
//Se crea un objeto de la clase Programacion
$programacion = new programacion();
//id del usuario que esta en sesion
$id_usuario = $_SESSION['id_usuario'];
//id del rol que esta en sesion
$id_rol = $_SESSION['rol'];
//Validar que la consulta salga exitosamente
if ($data = $programacion->get_prog_semanal_por_usuario($id_usuario)) {
    $php_estado = true;
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $php_error,
    'result' => $resultado,
);

//print json_encode($datos, JSON_FORCE_OBJECT);
print json_encode($data, JSON_UNESCAPED_UNICODE);
