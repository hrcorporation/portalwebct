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
$id = 0;
$pedido = true;
// if ($pedidos->validar_existencias_pedido($_POST['id_cliente'], $_POST['id_obra'])) {
if ($pedido) {
    if (isset($_POST['id_cliente']) && !empty($_POST['id_cliente'])) {
        $id_cliente = $_POST['id_cliente'];
        $nombre_cliente = $pedidos->get_cliente($id_cliente);
        $id_obra = $_POST['id_obra'];
        $nombre_obra = $pedidos->get_nombre_obra($id_obra);
        $id_asesora = $_POST['asesora_comercial'];
        $nombre_asesora = $pedidos->get_nombre_asesora($id_asesora);
        $nombre_orden_compra = $_POST['orden_compra'];
        $tipo_cliente = $_POST['plan_maestro'];
        if($tipo_cliente == "PLAN MAESTRO"){
            $plan_maestro = true;
        }else{
            $plan_maestro = false;
        }
        if ($id = $pedidos->crear_pedido_obra($id_cliente, $nombre_cliente, $id_obra, $nombre_obra, $id_asesora, $nombre_asesora, $nombre_orden_compra, $plan_maestro)) {
            $php_estado = true;
        } else {
            $php_error = 'No Guardo Correctamente';
        }
    }
}else{
    $php_error = "Ya existe un pedido activo con ese cliente y obra";
}
$datos = array(
    'estado' => $php_estado,
    'errores' => $php_error,
    'id' => $id,
    'result' => $resultado,
);

echo json_encode($datos, JSON_FORCE_OBJECT);
