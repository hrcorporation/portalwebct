<?php
session_start();
header('Content-Type: application/json');
require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';
//Se crea un objeto de la clase programacion semanal
$clsProgramacionSemanal = new clsProgramacionSemanal();
$clsSaldosClientes = new clsSaldosClientes();

$boolPhpEstado = false;
$errores = "";
$resultado = "";

$intidpedido = intval($_POST['pedido']);
$intidproducto = intval($_POST['producto']);
$intidcliente = intval($_POST['cliente']);
$cantidad_solicitada = doubleval($_POST['cantidad']);
$valor_producto = $clsSaldosClientes->get_valor_producto($intidproducto);

if ($cantidad = $clsProgramacionSemanal->cargar_cantidad_metros($intidpedido, $intidproducto)) {
    $nueva_cantidad = doubleval($cantidad) + doubleval($cantidad_solicitada);
} else {
    $nueva_cantidad = doubleval($cantidad_solicitada);
}

$valor_total_producto = ($valor_producto * $nueva_cantidad);
$saldo_cliente = $clsSaldosClientes->get_saldo_cliente($intidcliente);
$cupo_cliente = $clsSaldosClientes->get_cupo_cliente($intidcliente);


$valor_calculo = $cupo_cliente - ($saldo_cliente + $valor_producto);
$cantidad_pedido = $clsProgramacionSemanal->cargar_cantidad_metros_pedido($intidpedido, $intidproducto);

if ($cantidad_pedido > 0) {
    $cantidad_final = doubleval($cantidad_pedido) - doubleval($nueva_cantidad);
    if ($cantidad_final > 0) {
        $boolPhpEstado = true;
        $cantidad_imp = $cantidad_solicitada;
    } else if($cantidad_final == 0){
        $boolPhpEstado = true;
        $cantidad_imp = $cantidad_solicitada;
    }else {
        $boolPhpEstado = false;
        $cantidad_imp = $cantidad_pedido;
    }
}  else {
    $boolPhpEstado = false;
}


$datos = array(
    'estado' => $boolPhpEstado,
    'cantidad_final' => $cantidad_imp
);

echo json_encode($datos, JSON_FORCE_OBJECT);
