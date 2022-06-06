<?php

session_start();
header('Content-Type: application/json');

require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';

$eventos = new eventos();
$programacion = new programacion();
$php_clases = new php_clases();

$log = false;
$php_estado = false;
$php_error[] = "";
$resultado = "";
if (isset($_SESSION['id_usuario']) && isset($_SESSION['rol_funcionario'])) {
    $id_usuario = $_SESSION['id_usuario'];
    $id_rol = $_SESSION['rol_funcionario'];
    $nombre_usuario = $programacion->get_nombre_cliente($id_usuario);
} else {
    $id_usuario = $_SESSION['id_usuario'];
    $id_rol = $_SESSION['rol'];
    $nombre_usuario = $programacion->get_nombre_cliente($id_usuario);
}
date_default_timezone_set('America/Bogota');
setlocale(LC_ALL, 'es_ES');
setlocale(LC_TIME, 'es_ES');
$hora_actual = new DateTime();
$hora_hoy = $hora_actual->format("H:i:s");
if ($hora_hoy < "16:00:00") {
    if (isset($_POST['txt_cliente']) && !empty($_POST['txt_cliente'])) {
        $estado = 2;
        $id_cliente = $_POST['txt_cliente'];
        $nombre_cliente = $programacion->get_nombre_cliente($id_cliente);
        $id_obra = $_POST['txt_obra'];
        $nombre_obra = $programacion->get_nombre_obra($id_obra);
        $id_pedido = $_POST['txt_pedidos'];
        $id_producto = $_POST['txt_producto'];
        $nombre_producto = $programacion->get_nombre_producto($id_producto);
        $cantidad = $_POST['txt_cant'];
        if (isset($_POST['txt_hora'])) {
            $hora = $_POST['txt_hora'];
        } else {
            $hora = "00";
        }
        $minutos = $_POST['txt_min'];
        $frecuencia = $hora . ":" . $minutos;
        if (isset($_POST['requiere_bomba'])) {
            $requiere_bomba = true;
        } else {
            $requiere_bomba = false;
        }
        $tipo_descargue = $_POST['txt_tipo_descargue'];
        $inicio = $_POST['start'];
        $fin = $_POST['end'];
        $elementos = $_POST['txt_elementos'];
        $observaciones = $_POST['txt_observaciones'];
        if ($programacion->crear_prog_semanal_v2($estado, $id_cliente, $nombre_cliente, $id_obra, $nombre_obra,  $id_pedido, $id_producto, $nombre_producto, $cantidad, $frecuencia, $requiere_bomba, $inicio, $fin, $elementos, $observaciones, $id_usuario, $nombre_usuario)) {
            $php_estado = true;
        } else {
            $php_error = 'No Guardo Correctamente';
        }
    } else {
        $php_error = 'Se requieren los datos';
    }
} else {
    $php_error = 'Fuera de la hora establecida';
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $php_error,
    'result' => $resultado,
);

echo json_encode($datos, JSON_FORCE_OBJECT);
