<?php

header('Content-Type: application/json');
session_start();
require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

$php_estado = false;
$errores = "";
$resultado = "";

$cls_visitas_comerciales = new cls_visitas_comerciales();

$errores = "nada";

if (
    isset($_POST['txt_inicio']) && !empty($_POST['txt_inicio']) && isset($_POST['txt_fin']) && !empty($_POST['txt_inicio'])
) {

    $objetivo_visita = $_POST['objetivo_visita'];
    $txt_cliente = $_POST['txt_cliente'];
    //$txt_obra = $_POST['txt_obra'];
    if(empty($_POST['txt_obra'])){
        $txt_obra = NULL;
    }else{
        $txt_obra = $_POST['txt_obra'];
    }
    
    $obs_visit = $_POST['obs_visit'];
    $txt_inicio = $_POST['txt_inicio'];
    $txt_fin = $_POST['txt_fin'];

    $asesora_comercial = $_POST['txt_asesora_comercial'];

    if($cls_visitas_comerciales->crear_visitas_comerciales($asesora_comercial,$objetivo_visita,$txt_cliente, $txt_obra,$obs_visit, $txt_inicio, $txt_fin)){
        $php_estado = true;
    }else{
        $php_estado = false;

    }



} else {
    $errores = "faltan campos requeridos";
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $errores,
    'post' => $_POST,
);

echo json_encode($datos, JSON_FORCE_OBJECT);

