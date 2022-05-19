<?php


header('Content-Type: application/json');

require '../../../../librerias/autoload.php';
require '../../../../delos/autoload.php';
require '../../../../vendor/autoload.php';


$eventos = new eventos();
if(isset($_POST['id'])){
    $data = $eventos->cargar_data_event($_POST['id']);
}else{
    $data = false;
}

//print json_encode($datos, JSON_FORCE_OBJECT);
print json_encode($data, JSON_UNESCAPED_UNICODE);