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
//Se hace la validacion para verificar que el id exista o no sea nulo.
if (isset($_POST['id']) && !empty($_POST['id'])) {
    //id del usuario cliente
    $id = htmlspecialchars($_POST['id']);
    //Del objeto creado anteriormente se usa la funcion eliminar_usuario para hacer la eliminacion del usuario mediante el parametro del id.
    $rest =  $t1_terceros->eliminar_usuario($id);
    $php_estado = true;
} else {
    $php_estado = false;
}
$msg =  $rest;

$datos = array(
    'estado' => $php_estado,
    'msg' => $msg,
);

echo json_encode($datos, JSON_FORCE_OBJECT);
