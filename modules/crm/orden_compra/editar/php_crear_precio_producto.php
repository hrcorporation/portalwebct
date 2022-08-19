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

if ($pedidos->validar_existencias_precio_producto($_POST['id_producto'], $_POST['id'])) {
    $id_pedido = $_POST['id'];
    $id_producto = $_POST['id_producto'];
    $cod_producto = $pedidos->get_codigo_producto($id_producto);
    $nombre_producto = $pedidos->get_nombre_producto($id_producto);
    $porcentaje = 0;
    $id_precio_base = $pedidos->get_id_precio_base($id_producto);
    $precio_base = $pedidos->get_precio_producto($id_producto);
    if (!is_null($_POST['cantidad'])) {
        $cantidad_m3 = $_POST['cantidad'];
    } else {
        $cantidad_m3 = 0;
    }
    $saldo_m3 = $cantidad_m3;
    $subtotal = $precio_base;
    $precio_total_pedido = $subtotal * (doubleval($cantidad_m3));
    $precio_m3 = $subtotal; // Subtotal.
    $observaciones = $_POST['observaciones'];
    if ($pedidos->validar_producto_por_id($_POST['id_producto'])) {
        if ($pedidos->crear_precio_producto($id_pedido, $id_producto, $cod_producto, $nombre_producto, $porcentaje, $id_precio_base, $precio_base, $precio_m3, $cantidad_m3, $saldo_m3, $precio_total_pedido, $observaciones)) {
            $php_estado = true;
        } else {
            $php_error = 'Error inesperado';
        }
    }else{
        $php_error = 'Producto no existente en la base de datos';
    }
} else {
    $php_error = "El producto ya se encuentra guardado con este pedido";
}
$datos = array(
    'estado' => $php_estado,
    'errores' => $php_error,
    'result' => $resultado,
);

echo json_encode($datos, JSON_FORCE_OBJECT);
