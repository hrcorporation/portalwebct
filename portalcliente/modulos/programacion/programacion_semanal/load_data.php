<?php

session_start();
header('Content-Type: application/json');

require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php'; 

//Se crea un objeto de la clase php_clases y programacion
$php_clases = new php_clases();
$programacion = new t8_programacion();

$php_estado = false;
$errores = "";
$resultado = "";
$select_obras ="";

if ($_POST['task'] == 1){
    $id_cliente = $_POST['txt_cliente'];
    //Buscar el id de la obra filtrandola con el id del cliente.
    $select_obras = $programacion->option_obra($id_cliente);
    $php_estado = true; 
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $errores,
    'result' => $resultado,
    'obras' => $select_obras,

);
echo json_encode($datos, JSON_FORCE_OBJECT);
