<?php

session_start();
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php'; 
//Se crea un objeto de la clase php_clases
$php_clases = new php_clases();
//Se crea un objeto de la clase t1_terceros
$t1_terceros = new t1_terceros();

$php_estado = false;
//Se hace la validacion para verificar que el id del usuario exista y que no este vacio.
if(isset($_POST['id']) && !empty($_POST['id'])){
    //id del usuario
    $id = htmlspecialchars($_POST['id']);
    //mediante el objeto que se creo anteriormente se usa la funcion de restablecer_pass mediante el parametro de el id.
   $rest =  $t1_terceros->restablecer_pass($id);
    $php_estado = true;
}else {
    $php_estado = false;
}
$msg =  $rest;

$datos = array(
    'estado' => $php_estado,
    'msg' => $msg,
);

echo json_encode($datos, JSON_FORCE_OBJECT);
