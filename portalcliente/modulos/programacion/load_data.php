<?php

session_start();
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php'; 
$intIdUsuario = $_SESSION['id_usuario'];
//Se crea un objeto de la clase clsProgramacion
$clsProgramacion = new clsProgramacion();

$php_estado = false;
$errores = "";
$resultado = "";
$select_obras ="";

$programacion = $_POST['nombre'];
if($programacion == 1){
    $nombre = "semanal";
}elseif($programacion == 2){
    $nombre = "diaria";
}

if ($_POST['task'] == 1){
    $id_cliente = $_POST['id_cliente'];
    //Buscar el id de la obra filtrandola con el id del cliente.
    $select_obras = $clsProgramacion->option_obra_edit($intIdUsuario, $nombre, $id_cliente);
    $php_estado = true; 
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $errores,
    'result' => $resultado,
    'obras' => $select_obras,

);
echo json_encode($datos, JSON_FORCE_OBJECT);
