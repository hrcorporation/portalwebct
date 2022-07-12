<?php

session_start();
header('Content-Type: application/json');

require '../../librerias/autoload.php';
require '../../modelos/autoload.php';
require '../../vendor/autoload.php';
//SE CREA UN OBJETO DE LA CLASE PEDIDOS
$ClsConsignacion = new ClsConsignacion();
//LISTA TODOS LOS PEDIDOS REALIZADOS
$data = $ClsConsignacion->fntGetConsignacionesObj();
//print json_encode($datos, JSON_FORCE_OBJECT);
print json_encode($data, JSON_UNESCAPED_UNICODE);
