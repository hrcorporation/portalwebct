<?php

header('Content-Type: application/json');

require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';


$php_estado = false;
$errores = "";
$resultado = "";




if (isset($_POST['numero_documento']) && !empty($_POST['numero_documento']) &&
    isset($_POST['nombre_completo']) && !empty($_POST['nombre_completo'])
){
    $fecha = "" . date("Y-m-d H:i:s");
    $nit = $_POST['numero_documento'];
    $nombres = $_POST['nombre_completo'];
 

    



} else {
    $errores = "faltan campos requeridos";
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $errores,
    'post' => $_POST,
);


echo json_encode($datos, JSON_FORCE_OBJECT);
