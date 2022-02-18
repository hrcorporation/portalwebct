<?php

session_start();
header('Content-Type: application/json');


require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';

$php_clases = new php_clases();
$t25_colorconcreto = new t25_colorconcreto();
$php_estado = false;
$log = false;


$php_estado = false;
$php_error[] = "";
$resultado = "";

if (isset($_POST['txt_CodConcreto']) && !empty($_POST['txt_CodConcreto']) && isset($_POST['txt_DescripcionCC']) && !empty($_POST['txt_DescripcionCC'])) {
    $codCC = $_POST['txt_CodConcreto'];
    $descripcionCC = $_POST['txt_DescripcionCC'];
    if ($t25_colorconcreto->crear_color_concreto($codCC, $descripcionCC)) {
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
