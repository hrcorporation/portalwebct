<?php

session_start();
header('Content-Type: application/json');

require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';

//Se crea un objeto de la clase php_clases y t5_obras.
$php_clases = new php_clases();
$t5_obras = new t5_obras();
$pedidos = new pedidos();

$php_estado = false;
$errores = "";
$resultado = "";
$select_obras = "";

if ($_POST['task'] == 1) {
    $id_cliente = $_POST['id_cliente'];
    //Buscar el id de la obra filtrandola con el id del cliente.
    $select_obras = $t5_obras->option_obra($id_cliente);
    $php_estado = true;
    $datos = array(
        'estado' => $php_estado,
        'errores' => $errores,
        'result' => $resultado,
        'obras' => $select_obras,

    );
    echo json_encode($datos, JSON_FORCE_OBJECT);
} else if ($_POST['task'] == 2) {
    $id_cliente = $_POST['id_cliente'];
    $id_obra = $_POST['id_obra'];
    $asesora = $pedidos->select_comercial2($id_cliente, $id_obra);
    $datos = array(
        'estado' => $php_estado,
        'errores' => $errores,
        'result' => $resultado,
        'asesora' => $asesora,
    );
    echo json_encode($datos, JSON_FORCE_OBJECT);
}
