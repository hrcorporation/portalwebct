<?php

session_start();
header('Content-Type: application/json');


require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php'; 

$php_clases = new php_clases();
$t1_terceros = new t1_terceros();

$php_estado = false;
$php_error[] = "";
$resultado = "";


if(isset($_POST['C_NumeroID'])&&isset($_POST['C_nombres']) &&isset($_POST['C_Apellidos']) ){
    
    
    $id = htmlspecialchars($_POST['id']);
    $C_NumeroID = htmlspecialchars($_POST['C_NumeroID']);
    $C_nombres = htmlspecialchars($_POST['C_nombres']);
    $C_Apellidos = htmlspecialchars($_POST['C_Apellidos']);
    $C_Usuario = $C_NumeroID;
    $id_cliente1 = htmlspecialchars($_POST['C_IdTerceros']);
    $id_obra = htmlspecialchars($_POST['C_Obras']);
    $C_Pass = md5($C_NumeroID);
    $razonSocial = $C_nombres ." ".$C_Apellidos;
    $estado = 1;
    $rol = 102;
    $TipoTercero = 3;
    
    $result = $t1_terceros->editar_user_cliente($C_NumeroID, $C_nombres, $C_Apellidos, $id_cliente1,$id_obra, $id);
    
    
    if($result){
         $php_estado = true;
    } else {
          $php_error = "error al guardar";
    }
    
    
}else{
    $php_estado = false;
    $php_error = "faltan campos requeridos";
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $php_error,
    'result' => $resultado,
);


echo json_encode($datos, JSON_FORCE_OBJECT);
