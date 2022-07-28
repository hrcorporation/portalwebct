<?php

session_start();
header('Content-Type: application/json');

require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';

//Se crea un objeto de la clase php_clases y pedidos
$php_clases = new php_clases();
$clsprogramacionsemanal = new ClsProgramacionSemanal();

$log = false;
$php_estado = false;
$php_error[] = "";
$resultado = "";

if ($_POST['id']) {
    $id_producto = 1;
    $nombre_producto = "";
    //Id del usuario.
    $id_usuario = $_SESSION['id_usuario'];
    //Nombre del usuario mediante el parametro del id del usuario
    $nombre_usuario = $clsprogramacionsemanal->fntGetNombreClienteObj($id_usuario);
    $status = 2;
    $id_pedido = $_POST['id'];
    $id_cliente = $_POST['txtCliente'];
    $nombre_cliente = $clsprogramacionsemanal->fntGetNombreClienteObj($id_cliente);
    $id_obra = $_POST['txtObra'];
    $nombre_obra = $clsprogramacionsemanal->fntGetNombreObra($id_obra);
    $cantidad = $_POST['txtcantidadmetros'];
    $frecuencia = $_POST['cbxFrecuencia'];
    $horacargue = $_POST['txtHoraCargue'];
    $fechafundida = $_POST['txtFechaFundida'];
    // $horainicio = $clsprogramacionsemanal->sumar($horacargue, "01:00:00");
    $fecha_ini = $fechafundida ." ". $horacargue;
    $fecha_fin = $fechafundida ." ". $horacargue;

    if (isset($_POST['chkRequiereBomba'])) {
        $requiereBomba = true;
    } else {
        $requiereBomba = false;
    }

    $observaciones = $_POST['txtObservaciones'];

    if ($clsprogramacionsemanal->fntCrearProgSemanalPedidosBool($status, $id_cliente, $nombre_cliente, $id_obra, $nombre_obra,  $id_pedido, $id_producto, $nombre_producto, $cantidad, $frecuencia, $requiereBomba, $fecha_ini, $fecha_fin, $observaciones, $id_usuario, $nombre_usuario)) {
        $php_estado = true;
    } else {
        $log = 'No Guardo Correctamente';
    }
} else {
    $php_error = "El servicio ya se encuentra guardado con este pedido";
}
$datos = array(
    'estado' => $php_estado,
    'errores' => $php_error,
    'result' => $resultado,
);

echo json_encode($datos, JSON_FORCE_OBJECT);
