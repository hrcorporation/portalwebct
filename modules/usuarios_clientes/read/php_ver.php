<?php

session_start();
header('Content-Type: application/json');

require '../../../includes/conexionPDO.php';
require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php'; 
//Se crea un objeto de la clase conexionPDO
$con = new conexionPDO();
//Se crea un objeto de la clase php_clases
$php_clases = new php_clases();

$php_estado = false;
$errores[] = "";
$resultado = "";


if (isset($_POST['campo']) && !empty($_POST['campo'])){
     
    
} else {
    
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $php_error,
    'result' => $resultado,
);


echo json_encode($datos, JSON_FORCE_OBJECT);
