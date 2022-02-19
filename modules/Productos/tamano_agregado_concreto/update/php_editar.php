<?php

session_start();
header('Content-Type: application/json');

require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php'; 

$t4_productos = new t4_productos();
$t21_tipoconcreto = new t21_tipoconcreto();
$t22_resistencia_concre = new t22_resistencia_concre();
$t23_tamano_agregado_concre = new t23_tamano_agregado();
$t24_caract_concre = new t24_caract_concre();
$t25_colorconcreto = new t25_colorconcreto();
$general_modelos = new general_modelos();

$php_estado = false;
$php_error[] = "";
$resultado = "";

if (isset($_POST['txt_CodTAC']) && !empty($_POST['txt_CodTAC']) && isset($_POST['txt_DescripcionTAC']) && !empty($_POST['txt_DescripcionTAC'])) {
    $CodTAC = $_POST['txt_CodTAC'];
    $DescripcionTAC = $_POST['txt_DescripcionTAC'];
    $id = $_POST['txt_id'];
    if ($t23_tamano_agregado_concre->modificar_tamano_agregado($id, $CodTAC, $DescripcionTAC)) {
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
