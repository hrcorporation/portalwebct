<?php

session_start();
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';
//Se crea un objeto de la clase novedades_despacho
$cls_novedades = new novedades_despacho();
$data = false;
//Validar que todos los datos existan y no esten vacios
if(isset($_POST['id_novedad']) && !empty($_POST['id_novedad'] ) && isset($_POST['id_cliente']) && !empty($_POST['id_cliente'] ) &&  isset($_POST['id_obra']) && !empty($_POST['id_obra'] )  ){
    //se listan los datos de los clientes mediante los parametros anteriores.
    $data = $cls_novedades->select_novedades_cli_obra($_POST['id_novedad'],$_POST['id_cliente'],$_POST['id_obra']);
}

//print json_encode($datos, JSON_FORCE_OBJECT);
print json_encode($data, JSON_UNESCAPED_UNICODE);