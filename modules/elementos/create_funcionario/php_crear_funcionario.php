<?php

session_start();
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

//Se crea un objeto de la clase php_clases
$php_clases = new php_clases();

$elemento = new elementos();

$log = false;
$php_estado = false;
$php_error[] = "";
$resultado = "";

if (isset($_POST['identificacion']) && !empty($_POST['identificacion'])) {

    $identificacion = $_POST['identificacion'];
    $nombre_funcionario = strtoupper($_POST['nombre_funcionario']);
    $area = $_POST['area'];
    $cargo = $_POST['cargo'];

    if ($elemento->crear_funcionario($identificacion, $nombre_funcionario, $area, $cargo)) {
        $php_estado = true;
    } else {
        $log = 'No Guardo Correctamente';
    }
}
$datos = array(
    'estado' => $php_estado,
    'errores' => $php_error,
    'result' => $resultado,
);

echo json_encode($datos, JSON_FORCE_OBJECT);
