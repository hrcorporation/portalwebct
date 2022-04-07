<?php

session_start();
header('Content-Type: application/json');

require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';

$php_clases = new php_clases();
$modelo_remisiones = new modelo_remisiones();

$PDO = new conexionPDO();
$con = $PDO->connect();




$data = $modelo_remisiones::data_table_remision($con);




//print json_encode($datos, JSON_FORCE_OBJECT);
print json_encode($data, JSON_UNESCAPED_UNICODE);
