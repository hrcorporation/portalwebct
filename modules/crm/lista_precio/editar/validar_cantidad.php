<?php
session_start();
header('Content-Type: application/json');
require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';
//Se crea un objeto de la clase programacion semanal
$clsProgramacionSemanal = new clsProgramacionSemanal();
$clslistaprecio = new clslistaprecio();
$boolPhpEstado = false;
$errores = "";
$resultado = "";

$intidpedido = intval($_POST['pedido']);
$intidproducto = intval($_POST['producto']);
$cantidad_solicitada = doubleval($_POST['cantidad']);

if ($cantidad = $clsProgramacionSemanal->cargar_cantidad_metros($intidpedido, $intidproducto)) {
    $nueva_cantidad = doubleval($cantidad) + doubleval($cantidad_solicitada);
} else {
    $nueva_cantidad = doubleval($cantidad_solicitada);
}

if ($cantidad_pedido = $clslistaprecio->cargar_cantidad_metros_pedido($intidpedido, $intidproducto)) {
    $cantidad_final = doubleval($cantidad_pedido) - doubleval($nueva_cantidad);
    if ($cantidad_final >= 0) {
        $boolPhpEstado = true;
    } else {
        $boolPhpEstado = false;
    }
} else {
    $boolPhpEstado = false;
}


$datos = array(
    'estado' => $boolPhpEstado,

);

echo json_encode($datos , JSON_FORCE_OBJECT);
