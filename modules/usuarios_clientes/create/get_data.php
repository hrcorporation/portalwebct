<?php

session_start();
header('Content-Type: application/json');



require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php'; 

//se crea un objeto de la clase t5_obras
$t5_obras = new t5_obras();


$php_estado = false;
$errores = "";
$resultado = "";
$select_obras ="";
//se valida que la variable task es igual a 1
if ($_POST['task'] == 1){
    //si pasa por la validacion retorna el select de las obras con el parametro de idCliente
    $select_obras = $t5_obras->option_obra($_POST['idCliente']);
    //$select_obras = $get_datos->Select_Obra($conexion_bd, $_POST['idCliente']);
    $php_estado = true;    
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $errores,
    'result' => $resultado,
    'obras' => $select_obras,

);


echo json_encode($datos, JSON_FORCE_OBJECT);
