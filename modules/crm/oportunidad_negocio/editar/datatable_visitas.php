<?php

session_start();
header('Content-Type: application/json');

require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';

$php_clases = new php_clases();
$op = new oportunidad_negocio();

$id_oportunidad = $_POST['id_oportunidad'];

$data = $op->datatable_visita($id_oportunidad);

    


//print json_encode($datos, JSON_FORCE_OBJECT);
print json_encode($data, JSON_UNESCAPED_UNICODE);