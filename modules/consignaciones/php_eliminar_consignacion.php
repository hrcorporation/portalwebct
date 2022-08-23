<?php

session_start();
header('Content-Type: application/json');

require '../../librerias/autoload.php';
require '../../modelos/autoload.php';
require '../../vendor/autoload.php';

$ClsConsignacion = new clsConsignacion();
$php_estado = false;
$php_error[] = "";
$resultado = "";
//Se hace un condicional que valida si el id de la consignacion existe.
if (isset($_POST['id']) && !empty($_POST['id'])) {
    $id = $_POST['id'];
    //obtener el saldo del cliente.
    $id_cliente = $ClsConsignacion->fntGetIdCliente($id);
    $saldo = $ClsConsignacion->fntGetSaldoCliente($id_cliente);
    $saldo_cliente = $saldo;
    $valor_consignacion = $ClsConsignacion->fntGetValorConsignacion($id);

    $nuevo_saldo_cliente = $saldo_cliente + $valor_consignacion;

    if($ClsConsignacion->fntActualizarSaldoCliente($id_cliente, $nuevo_saldo_cliente)){
        if ($ClsConsignacion->fntEliminarConsignacionObj($id)) {
            $php_estado = true;
        } else {
            $php_error = 'No elimino Correctamente';
        }
    }
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $php_error,
    'result' => $resultado,
    'saldo' => $saldo_cliente
);

echo json_encode($datos, JSON_FORCE_OBJECT);
