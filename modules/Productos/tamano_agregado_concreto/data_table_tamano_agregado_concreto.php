<?php

session_start();
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

$php_clases = new php_clases();
$t1_terceros = new t1_terceros();
$t23_tamano_agregado = new t23_tamano_agregado();

$data = $t23_tamano_agregado->get_datatable_tamano_agregado_concreto();

//print json_encode($datos, JSON_FORCE_OBJECT);
print json_encode($data, JSON_UNESCAPED_UNICODE);
