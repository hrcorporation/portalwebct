<?php

session_start();
header('Content-Type: application/json');

require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';

//Se crea un objeto de la clase php_clases
$php_clases = new php_clases();

$pedidos = new pedidos();

$log = false;
$php_estado = false;
$php_error[] = "";
$resultado = "";

if (isset($_POST['id']) && !empty($_POST['id'])) {
    $id_pedido = $_POST['id'];
    $id_tipo_servicio = $_POST['id_tipo_servicio'];
    $nombre_tipo_servicio = $pedidos->get_nombre_servicio($id_tipo_servicio);
    $precio = $_POST['precio'];
    if ($pedidos->crear_precio_servicio($id_pedido, $id_tipo_servicio, $nombre_tipo_servicio, $precio)) {
        $php_estado = true;
    } else {
        $log = 'No Guardo Correctamente';
    }
}
$datos = array(
    'estado' => $php_estado,
    'errores' => $php_error,
    'result' => $resultado,
);

echo json_encode($datos, JSON_FORCE_OBJECT);
