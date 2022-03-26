<?php

session_start();
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

$cls_novedades = new novedades_despacho();
$data = false;

if(isset($_POST['id_novedad']) && !empty($_POST['id_novedad'] &&  isset($_POST['fecha_novedad']) && !empty($_POST['fecha_novedad'] ))){
    
    if(is_array($data_cli_obra = $cls_novedades->select_datos_cliente($_POST['id_novedad']))){
        foreach ($data_cli_obra as $key) { 
                $id_clientes[] = $key['id_cliente'];
                $id_obras[] = $key['id_obra'];
        }
        $clientes = implode(",",$id_clientes);
        $obras = implode(",",$id_obras);
        $data = $cls_novedades->select_datos_remisiones($_POST['fecha_novedad'],$clientes,$obras);
    }
}

//print json_encode($datos, JSON_FORCE_OBJECT);
print json_encode($data, JSON_UNESCAPED_UNICODE);