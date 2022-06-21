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
//se crea un objeto de la clase programacion.
$programacion = new ClsProgramacion();
//Se listan todas las programaciones.
$data = $programacion->get_prog_semanal();
$php_estado = true;
//Datos de los arreglos.
$datos = array(
    'estado' => $php_estado,
    'errores' => $php_error,
    'result' => $resultado,
);
//print json_encode($datos, JSON_FORCE_OBJECT);
print json_encode($data, JSON_UNESCAPED_UNICODE);
