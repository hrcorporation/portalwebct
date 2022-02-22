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
$php_error = "";
$resultado = "";

if (isset($_POST['Txb_Descripcion']) && !empty($_POST['Txb_Descripcion']) && isset($_POST['Txb_Nombre']) && !empty($_POST['Txb_Nombre'])) {
    
} else {
    
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $php_error,
    'result' => $resultado,
);

echo json_encode($datos, JSON_FORCE_OBJECT);
