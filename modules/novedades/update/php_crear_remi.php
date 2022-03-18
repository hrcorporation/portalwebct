<?php

header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

$novedades_despacho = new novedades_despacho();
$php_estado = false;
$php_msg = "";

if (isset($_POST['check_id_remi']) && !empty($_POST['check_id_remi'])) {
    
} else {
    $php_msg = "Falta datos requeridos para crear la novedad remisiones";
}

$datos = array(
    'estado' => $php_estado,
    'msg' => $php_msg,
    'post' => $_POST,
);

echo json_encode($datos, JSON_FORCE_OBJECT);
