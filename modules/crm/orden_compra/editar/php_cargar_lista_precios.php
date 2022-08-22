<?php

header('Content-Type: application/json');

require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';

//Se crea un objeto de la clase php_clases y pedidos
$php_clases = new php_clases();
$pedidos = new pedidos();

$resultado = "";
$log = false;
$php_estado = false;
$php_error[] = "";

$id_lista_precios = $_POST['lista_precios'];
$id_pedido = $_POST['id_pedido'];

if ($id_lista_precios != 0) {
    $lista_precios = $pedidos->obtener_productos($id_lista_precios);
    if (is_array($lista_precios)) {
        foreach ($lista_precios as $key) {
            if ($pedidos->validar_existencias_precio_producto($key['id_producto'], $id_pedido)) {
                //Validar que el producto exista en la base de datos
                if ($pedidos->crear_precio_producto($id_pedido, $key['id_producto'], $key['codigo_producto'], $key['nombre_producto'], $key['porcentaje_descuento'], $key['id_precio_base'], $key['precio_base'], $key['precio_m3'], $key['cantidad_m3'], $key['saldo_m3'], $key['precio_total_pedido'], $key['observaciones'])) {
                    $php_estado = true;
                } else {
                    $php_error = "ERROR INESPERADO";
                }
            } else {
                $php_error = "Producto o productos ya agregados a la orden de compra";
            }
        }
    }else{
        $php_error = "La lista de precios no tiene productos";
    }
} else {
    $php_error = "No tiene una lista de precios registrada";
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $php_error,
    'result' => $resultado,
    'lista' => $id_lista_precios
);

echo json_encode($datos, JSON_FORCE_OBJECT);
