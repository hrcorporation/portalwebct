<?php

session_start();
header('Content-Type: application/json');

require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php'; 

$php_clases = new php_clases();
$t5_obras = new t5_obras();

$php_estado = false;
$errores = "";
$resultado = "";
$select_obras ="";

if ($_POST['task'] == 1){
    $id_cliente = $_POST['id_cliente'];
    $select_obras = $t5_obras->option_obra($id_cliente);
    $php_estado = true; 
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $errores,
    'result' => $resultado,
    'obras' => $select_obras,

);

echo json_encode($datos, JSON_FORCE_OBJECT);
