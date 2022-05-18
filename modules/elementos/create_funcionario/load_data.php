<?php

session_start();
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php'; 

//Se crea un objeto de la clase php_clases y t5_obras.
$php_clases = new php_clases();
$elementos = new elementos();

$php_estado = false;
$errores = "";
$resultado = "";
$select_cargo ="";

if ($_POST['task'] == 1){
    $area = $_POST['area'];
    //Buscar el id de la obra filtrandola con el id del cliente.
    $select_cargo = $elementos->option_cargos($area);
    $php_estado = true; 
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $errores,
    'result' => $resultado,
    'cargo' => $select_cargo,

);
echo json_encode($datos, JSON_FORCE_OBJECT);
