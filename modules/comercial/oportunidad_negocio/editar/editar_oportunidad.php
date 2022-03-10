<?php

header('Content-Type: application/json');

require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';


$php_estado = false;
$errores = "";
$resultado = "";

$op = new oportunidad_negocio;


if (isset($_POST['id_oportunidad_negocio']) && !empty($_POST['id_oportunidad_negocio']) &&
    isset($_POST['nit']) && !empty($_POST['nit'])
){
    $id = $_POST['id_oportunidad_negocio'];
    $nombre_completo = $_POST['nombre_completo'];
    $apellido_completo = $_POST['ap_completo'];
    $numero_identificacion = $_POST['nit'];
    $resultado = $_POST['resultado'];
    $status = $_POST['result_visit'];
   
    
    /**
     * STATUS
     * 1- Aprovado
     * 2- En Progreso
     * 10- Rechazhado 
     */
    
    if($id_lastinsert = $op->editar_oportunidad($id,$numero_identificacion,$nombre_completo, $apellido_completo, $resultado, $status)){
        $op->actualizar_resultado_op($id,$resultado);
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
