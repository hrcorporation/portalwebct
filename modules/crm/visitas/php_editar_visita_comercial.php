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
    isset($_POST['txt_inicio_edit']) && !empty($_POST['txt_inicio_edit']) && isset($_POST['txt_fin_edit']) && !empty($_POST['txt_fin_edit'])
) {

    $id = $_POST['txt_id'];

    $id_tipo_visita = $_POST['objetivo_visita_edit'];
    $txt_cliente = $_POST['txt_cliente_edit'];
    //$txt_obra = $_POST['txt_obra'];
    if(empty($_POST['txt_obra_edit'])){
        $txt_obra = NULL;
    }else{
        $txt_obra = $_POST['txt_obra_edit'];
    }
    
    $obs_visit = $_POST['obs_visit_edit'];
    $txt_inicio = $_POST['txt_inicio_edit'];
    $txt_fin = $_POST['txt_fin_edit'];
    $id_asesora_comercial = $_POST['asesora_comercial_edit'];


$status = $_POST['txt_estado'];

    if($cls_visitas_comerciales->editar_visitas_comercialestodo($id,$id_tipo_visita,$status, $txt_cliente, $txt_obra,  $obs_visit, $id_asesora_comercial,$txt_inicio, $txt_fin)){
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

