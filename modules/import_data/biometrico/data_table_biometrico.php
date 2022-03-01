<?php

session_start();
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

//Se crea un objeto de la clase php_clases
$php_clases = new php_clases();
//Se crea un objeto de la clase t1_terceros
$t1_terceros = new t1_terceros();
//Se crea un objeto de la clase t24_caract_concre
$cls_importdata = new cls_importdata();
//Se le asigna una variable al objeto t24_caract_concre y se llama una funcion llamada get_datatable_caracteristica_concreto
$data = $cls_importdata->get_datatable_biometrico();

//print json_encode($datos, JSON_FORCE_OBJECT);
print json_encode($data, JSON_UNESCAPED_UNICODE);
