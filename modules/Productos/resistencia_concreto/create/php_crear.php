<?php

session_start();
header('Content-Type: application/json');

require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';

$php_clases = new php_clases();
$t22_resistencia_concre = new t22_resistencia_concre();
$php_estado = false;
$log = false;


if(isset($_POST['txt_cod']) && !empty($_POST['txt_cod']) && isset($_POST['txt_descripcion']) && !empty($_POST['txt_descripcion']) )
{
    $cod = $_POST['txt_cod'];
    $descripcion = $_POST['txt_descripcion'];
    if($t22_resistencia_concre->crear_resistencia_concreto($cod, $descripcion)){
        $php_estado = true;
    }else{
        $log = 'No Guardo Correctamente';
    }


}



    

$datos = array(
    'estado' => $php_estado,
    'log' => $log,
    'post' =>$_POST
);


echo json_encode($datos, JSON_FORCE_OBJECT);

//print json_encode($datos, JSON_FORCE_OBJECT);
//print json_encode($data, JSON_UNESCAPED_UNICODE);