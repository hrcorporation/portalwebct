<?php

session_start();
header('Content-Type: application/json');

require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';

$eventos = new eventos();
$programacion = new programacion();

$log = false;
$php_estado = false;
$php_error[] = "";
$resultado = "";

$hora_actual = new DateTime();
$hoy = $hora_actual->format("H:i:s");
if ($hoy < "16:00:00") {
    if (isset($_POST['txt_cliente']) && !empty($_POST['txt_cliente'])) {
        $estado = 1;
        $id_cliente = $_POST['txt_cliente'];
        $nombre_cliente = $programacion->get_nombre_cliente($id_cliente);
        $id_obra = $_POST['txt_obra'];
        $nombre_obra = $programacion->get_nombre_obra($id_obra);
        $id_pedido = 5;
        $id_producto = $_POST['txt_producto'];
        $nombre_producto = $programacion->get_nombre_producto($id_producto);
        $cantidad = $_POST['txt_cant'];
        $inicio = $_POST['start'];
        $fin = $_POST['end'];
        if ($programacion->crear_prog_semanal($estado, $id_cliente, $nombre_cliente, $id_obra, $nombre_obra, $id_pedido, $id_producto, $nombre_producto, $cantidad, $inicio, $fin)) {
            $php_estado = true;
        } else {
            $php_error = 'No Guardo Correctamente';
        }
    } else {
        $php_error = 'Se requieren los datos';
    }
} else {
    $php_error = 'Fuera de la hora';
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $php_error,
    'result' => $resultado,
);

echo json_encode($datos, JSON_FORCE_OBJECT);
