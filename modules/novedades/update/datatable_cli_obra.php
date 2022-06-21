<?php

session_start();
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

//Se crea un objeto de la clase novedades_despacho
$novedades_despacho = new novedades_despacho();
//validar si el id de la novedad existe
if(isset($_POST['id_novedad']) && !empty($_POST['id_novedad'])){
    //listar los datos de los clientes de las novedades.
    $data = $novedades_despacho->select_datos_cliente($_POST['id_novedad']);
}

//print json_encode($datos, JSON_FORCE_OBJECT);
print json_encode($data, JSON_UNESCAPED_UNICODE);