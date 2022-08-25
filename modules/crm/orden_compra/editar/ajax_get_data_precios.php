<?php
session_start();
header('Content-Type: application/json');
require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';
//Se crea un objeto de la clase pedidos
$pedidos = new pedidos();
$log = false;
$php_estado = false;
$php_error[] = "";
$resultado = "";
$precio_subtotal = 0;
if (isset($_POST['task']) && !empty($_POST['task'])) {
    $id_producto = $_POST['id_producto'];
    $id_lista_precios = $_POST['id_lista_precios'];
    $precio_producto = doubleval($pedidos->get_precio_producto($id_producto, $id_lista_precios));
    $php_msg = "bien";
    $php_estado = true;
} else {
    $php_msg = "falta datos requeridos";
    $php_estado = false;
}
$datos = array(
    'estado' => $php_estado,
    'msg' => $php_msg,
    'subtotal' => $precio_producto,
);

echo json_encode($datos, JSON_FORCE_OBJECT);
