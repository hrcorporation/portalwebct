<?php

header('Content-Type: application/json');

require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';

$firephp = FirePHP::getInstance(true);
//Se crea un objeto de la clase php_clases
$php_clases = new php_clases();

$pedidos = new pedidos();

$log = false;
$php_estado = false;
$php_error[] = "";
$resultado = "";
$PDO = new conexionPDO();
$con = $PDO->connect();

fb("HR", FirePHP::LOG);

if (isset($_POST['txt_cod_load']) && !empty($_POST['txt_cod_load'])) {
    $id_pedido_load = intval($_POST['txt_cod_load']);
    $id_pedido = intval($_POST['id_pedido_cargar']);

    // Guarda producto
    if ($precio_poductos = $pedidos::cargar_precio_productos_for_id_pedido($con, $id_pedido_load)) {
        foreach ($precio_poductos as $key) {
            if ($pedidos->validar_existencias_precio_producto($key['id_producto'], $id_pedido)) {
                if ($pedidos->validar_producto($key['id_producto'])) {
                    $pedidos->crear_precio_producto($id_pedido, $key['id_producto'], $key['codigo_producto'], $key['nombre_producto'], $key['porcentaje_descuento'], $key['id_precio_base'], $key['precio_base'], $key['precio_m3'], $key['cantidad_m3'], $key['precio_total_pedido'], $key['observaciones']);
                    $php_estado = true;
                } else {
                    $php_error = "Producto no existente en la base de datos";
                }
            } else {
                $php_error = "Producto ya agregado";
            }
        }
    } else {
        $php_error = "Pedido no existe o no hay productos";
    }

    // Guarda bomba
    if ($precio_bomba = $pedidos::cargar_precio_bomba_for_id_pedido($con, $id_pedido_load)) {
        foreach ($precio_bomba as $key) {
            if ($pedidos->validar_bomba($key['min_m3'], $key['max_m3'], $id_pedido)) {
                $pedidos->crear_precio_bomba($id_pedido, $key['id_tipo_bomba'], $key['nombre_tipo_bomba'], $key['min_m3'], $key['max_m3'], $key['precio'], $key['observaciones']);
                $php_estado = true;
            } else {
                $php_error = "Bomba ya agregada";
            }
        }
    } else {
        $php_error = "Pedido no existe o no hay bombas";
    }

    // Guarda servicio
    if ($precio_servicios = $pedidos::cargar_precio_servicios_for_id_pedido($con, $id_pedido_load)) {
        foreach ($precio_servicios as $key) {
            if ($pedidos->validar_existencias_precio_servicio($key['id_tipo_servicio'], $id_pedido)) {
                $pedidos->crear_precio_servicio($id_pedido, $key['id_tipo_servicio'], $key['nombre_tipo_servicio'], $key['precio'], $key['observaciones']);
                $php_estado = true;
            } else {
                $php_error = "Servicio ya agregado";
            }
        }
    } else {
        $php_error = "Pedido no existe o no hay servicios";
    }
} else {
    $php_error = "Error inesperado";
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $php_error,
    'result' => $resultado,
);

echo json_encode($datos, JSON_FORCE_OBJECT);
