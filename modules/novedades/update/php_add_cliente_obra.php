<?php

header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';


$php_estado = false;
$php_msg = "";



if (isset($_POST['txt_cliente']) && !empty($_POST['txt_cliente'])  && isset($_POST['txt_obra']) && !empty($_POST['txt_obra']) 
){
    
}else{
    $php_msg = "Falta datos requeridos para crear la novedad";
}

$datos = array(
    'estado' => $php_estado,
    'msg' => $php_msg,
    'post' => $_POST,
);


echo json_encode($datos, JSON_FORCE_OBJECT);