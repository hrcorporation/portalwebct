<?php

session_start();
header('Content-Type: application/json');


require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';

$php_clases = new php_clases();
$t24_caract_concre = new t24_caract_concre();
$php_estado = false;
$log = false;


$php_estado = false;
$php_error[] = "";
$resultado = "";

if (isset($_POST['txt_CodCC']) && !empty($_POST['txt_CodCC']) && isset($_POST['txt_DescripcionCC']) && !empty($_POST['txt_DescripcionCC'])) {
    $codCC = $_POST['txt_CodCC'];
    $descripcionCC = $_POST['txt_DescripcionCC'];
    if ($t24_caract_concre->crear_caracteristica_concreto($codCC, $descripcionCC)) {
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
