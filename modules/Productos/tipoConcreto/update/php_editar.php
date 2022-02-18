<?php

session_start();
header('Content-Type: application/json');

require '../../../includes/conexionPDO.php';
require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php'; 

$t4_productos = new t4_productos();
$t21_tipoconcreto = new t21_tipoconcreto();
$t22_resistencia_concre = new t22_resistencia_concre();
$t23_tamano_agregado_concre = new t23_tamano_agregado();
$t24_caract_concre = new t24_caract_concre();
$t25_colorconcreto = new t25_colorconcreto();
$general_modelos = new general_modelos();

$php_estado = false;
$errores[] = "";
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
