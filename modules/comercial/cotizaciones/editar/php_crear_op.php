<?php

header('Content-Type: application/json');

require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';


$php_estado = false;
$errores = "";
$resultado = "";

$op = new oportunidad_negocio;


if (isset($_POST['nit']) && !empty($_POST['nit']) &&
    isset($_POST['nombre_completo']) && !empty($_POST['nombre_completo'])
){
    $fecha = "" . date("Y-m-d H:i:s");
    $nit = $_POST['nit'];
    $nombres = $_POST['nombre_completo'];
    $apellidos = $_POST['ap_completo'];
    $status = 3;

    
    
    /**
     * STATUS
     * 1- Aprovado
     * 2- En Progreso
     * 10- Rechazhado 
     */
    
    if($id_lastinsert = $op->crear_oportunidad_negocio($fecha,$nit,$nombres, $apellidos,$status)){
        $boton  = "<a href='../editar/editar.php?id=".$id_lastinsert."' class='btn btn-block btn-warning'> Agregar Visitas</a>";
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
    'boton'=> $boton,
    'id_last' => $id_lastinsert,
    'post' => $_POST,
);


echo json_encode($datos, JSON_FORCE_OBJECT);
