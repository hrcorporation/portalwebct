<?php

session_start();
header('Content-Type: application/json');


require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';

$php_clases = new php_clases();
$t23_tamano_agregado = new t23_tamano_agregado();
$php_estado = false;
$log = false;


$php_estado = false;
$php_error[] = "";
$resultado = "";

if (isset($_POST['txt_CodTCA']) && !empty($_POST['txt_CodTCA']) && isset($_POST['txt_DescripcionTCA']) && !empty($_POST['txt_DescripcionTCA'])) {
    $codTCA = $_POST['txt_CodTCA'];
    $descripcionTCA = $_POST['txt_DescripcionTCA'];
    if ($t23_tamano_agregado->crear_tamano_agregado_concreto($codTCA, $descripcionTCA)) {
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
