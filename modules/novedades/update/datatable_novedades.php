<?php

session_start();
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';
//Se crea un objeto de la clase novedades_despacho
$cls_novedades = new novedades_despacho();
$data = false;
//Validar que el id de la novedad exista y no este vacio.
if(isset($_POST['id_novedad']) && !empty($_POST['id_novedad'] )){
    //Validar que el id de la remision exista y no este vacio.
    if(isset($_POST['id_remision']) && !empty($_POST['id_remision'] ) ){
        //Busca los datos de las novedades de las remisiones.
        $data = $cls_novedades->select_novedad_remisiones($_POST['id_remision']);
    }else{
        //De lo contrario busca las novedades generales.
        $data = $cls_novedades->select_novedad_generales($_POST['id_novedad']);
    }
}

//print json_encode($datos, JSON_FORCE_OBJECT);
print json_encode($data, JSON_UNESCAPED_UNICODE);