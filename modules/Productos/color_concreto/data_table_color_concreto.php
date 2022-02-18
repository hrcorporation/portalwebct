<?php

session_start();
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

$php_clases = new php_clases();
$t1_terceros = new t1_terceros();
$t25_colorconcreto = new t25_colorconcreto();

$data = $t25_colorconcreto->get_datatable_color_concreto();

//print json_encode($datos, JSON_FORCE_OBJECT);
print json_encode($data, JSON_UNESCAPED_UNICODE);
