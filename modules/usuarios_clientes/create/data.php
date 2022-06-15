<?php

session_start();
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

//se crea un objeto de la clase php_clases
$t1_terceros = new t1_terceros();

//con el objeto que se creo anteriormente usamos la funcion de select_user_cliente
$data = $t1_terceros->select_user_cliente();

//print json_encode($datos, JSON_FORCE_OBJECT);
print json_encode($data, JSON_UNESCAPED_UNICODE);


