<?php

session_start();
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

$elementos = new elementos();

$php_estado = false;
$php_error[] = "";
$resultado = "";
//Se hace un condicional que valida si la variable de los datos de la tabla color del concreto existe y tambien valida si ese dato esta vacio.
if (isset($_POST['identificacion']) && !empty($_POST['identificacion'])) {
    $id = $_POST['id'];
    $identificacion = $_POST['identificacion'];
    $nombre_funcionario = $_POST['nombre_funcionario'];
    $area = $_POST['area'];
    $cargo = $_POST['cargo'];
    if ($elementos->editar_funcionario($id, $identificacion, $nombre_funcionario, $cargo, $area)) {
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
