<?php

session_start();
header('Content-Type: application/json');

require '../../librerias/autoload.php';
require '../../modelos/autoload.php';
require '../../vendor/autoload.php';
//Se crea un objeto de la clase novedades_despacho
$cls_novedades = new novedades_despacho();
//Mediante el objeto de la clase novedades_despacho se usa la funcion de select_novedad_despacho_index
$data = $cls_novedades->select_novedad_despacho_index();
//print json_encode($datos, JSON_FORCE_OBJECT);
print json_encode($data, JSON_UNESCAPED_UNICODE);