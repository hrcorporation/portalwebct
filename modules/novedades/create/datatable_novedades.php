<?php

session_start();
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';
//Se crea un objeto de la clase novedades_despacho
$cls_novedades = new novedades_despacho();
//Validar que la variable fecha novedad exista y no este vacia
if(isset($_POST['fecha_novedad']) && !empty($_POST['fecha_novedad'])){
    //lista todas las novedades por la fecha del parametro.
    $data = $cls_novedades->select_novedad_despacho($_POST['fecha_novedad']);
}

//print json_encode($datos, JSON_FORCE_OBJECT);
print json_encode($data, JSON_UNESCAPED_UNICODE);