<?php

session_start();
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';
//SE CREA UN OBJETO DE LA CLASE PEDIDOS
$clsProgramacionDiaria = new clsProgramacionDiaria();
//LISTA TODOS LOS PEDIDOS REALIZADOS
$id_programacion = $_POST['id_programacion'];
$data = $clsProgramacionDiaria->get_datos_remision($id_programacion);
//print json_encode($datos, JSON_FORCE_OBJECT);
print json_encode($data, JSON_UNESCAPED_UNICODE);
