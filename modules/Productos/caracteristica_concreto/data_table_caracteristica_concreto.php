<?php

session_start();
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

$php_clases = new php_clases();
$t1_terceros = new t1_terceros();
$t24_caract_concre = new t24_caract_concre();

$data = $t24_caract_concre->get_datatable_caracteristica_concreto();

//print json_encode($datos, JSON_FORCE_OBJECT);
print json_encode($data, JSON_UNESCAPED_UNICODE);
