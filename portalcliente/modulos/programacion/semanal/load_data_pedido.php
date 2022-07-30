<?php
session_start();
header('Content-Type: application/json');
require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';

//Se crea un objeto de la clase programacionSemanal
$clsProgramacionSemanal = new clsProgramacionSemanal();
$php_estado = false;
$errores = "";
$resultado = "";

if ($_POST['task'] == 1){
    $intIdPedido = $_POST['id_pedido'];
    //Buscar el id de la obra filtrandola con el id del cliente.
    $objSelectProductos = $clsProgramacionSemanal->fntOptionProductoClienteObj($intIdPedido);
    $php_estado = true; 
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $errores,
    'result' => $resultado,
    'select_producto' => $objSelectProductos
);

echo json_encode($datos, JSON_FORCE_OBJECT);