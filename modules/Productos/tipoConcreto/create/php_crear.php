<?php

session_start();
header('Content-Type: application/json');


require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';

$php_clases = new php_clases();
$t21_tipoconcreto = new t21_tipoconcreto();
$php_estado = false;
$log = false;


$php_estado = false;
$php_error[] = "";
$resultado = "";

if (isset($_POST['txt_CodTConcreto']) && !empty($_POST['txt_CodTConcreto']) && isset($_POST['txt_DescripcionTC']) && !empty($_POST['txt_DescripcionTC'])) {
    $codTC = $_POST['txt_CodTConcreto'];
    $descripcionTC = $_POST['txt_DescripcionTC'];
    if ($t21_tipoconcreto->crear_tipo_concreto($codTC, $descripcionTC)) {
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
