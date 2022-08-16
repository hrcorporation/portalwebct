<?php

session_start();
header('Content-Type: application/json');

require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';

//Se crea un objeto de la clase php_clases y clslistaprecio
$php_clases = new php_clases();
$clslistaprecio = new clslistaprecio();

$log = false;
$php_estado = false;
$php_error[] = "";
$resultado = "";
$id = 0;
//VALIDAR QUE EL CLIENTE ESTE SELECCIONADO...
if (isset($_POST['id_cliente']) && !empty($_POST['id_cliente'])) {
    $id_cliente = $_POST['id_cliente'];
    $nombre_cliente = $clslistaprecio->get_nombre_cliente($id_cliente);
    $id_obra = $_POST['id_obra'];
    $nombre_obra = $clslistaprecio->get_nombre_obra($id_obra);
    $fecha_vencimiento = $_POST['fecha_vencimiento'];
    $id_asesora = $_POST['asesora_comercial'];
    $nombre_asesora = $clslistaprecio->get_nombre_asesora($id_asesora);
    //VALIDAR QUE SE GUARDE CORRECTAMENTE EL PEDIDO...
    if ($id = $clslistaprecio->crear_pedido($fecha_vencimiento, $id_cliente, $nombre_cliente, $id_obra, $nombre_obra, $id_asesora, $nombre_asesora)) {
        $php_estado = true;
    } else {
        $php_error = 'No Guardo Correctamente';
    }
}
//SI YA HAY UN PEDIDO ACTIVO CON EL MISMO CLIENTE Y OBRA SE IMPRIME EL SIGUIENTE MENSAJE "Ya existe un pedido activo con ese cliente y obra"...

$datos = array(
    'estado' => $php_estado,
    'errores' => $php_error,
    'id' => $id,
    'result' => $resultado,
);

echo json_encode($datos, JSON_FORCE_OBJECT);
