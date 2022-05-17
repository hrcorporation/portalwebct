<?php

header('Content-Type: application/json');

//require '../../../include/conexionPDO.php';
require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

$eventos = new eventos();
$programacion = new programacion();
$php_estado = false;
$php_error[] = "";

if (isset($_POST['titulo'])) {
    $titulo = $_POST['titulo'];
    // $id_cliente = $_POST['txt_cliente'];
    // $id_obra = $_POST['txt_obra'];
    // $id_pedido = 5;
    // $cantidad = $_POST['txt_cant'];
    // $id_producto = $_POST['txt_producto'];
    $inicio = $_POST['start'];
    $fin = $_POST['end'];
    $result = $eventos->crear_eventos($titulo, $inicio, $fin);
    //$programacion->crear_toda_prog_semanal($titulo, $id_cliente, $id_obra,  $id_pedido, $id_producto,  $cantidad, $inicio, $fin);
} else {
    $php_error = 'No Guardo Correctamente';
}



$datos = array(
    'estado' => $php_estado,
    'errores' => $php_error,
);


echo json_encode($datos, JSON_FORCE_OBJECT);
