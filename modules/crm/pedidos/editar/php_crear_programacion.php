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
    $id_producto = $_POST['id_producto'];
    $nombre_producto = $clsprogramacionsemanal->fntGetNombreProducto($id_producto);
    //Id del usuario.
    $id_usuario = $_SESSION['id_usuario'];
    //Nombre del usuario mediante el parametro del id del usuario
    $nombre_usuario = $clsprogramacionsemanal->fntGetNombreClienteObj($id_usuario);
    //Estado de la programacion
    $status = 2;
    $id_pedido = $_POST['id'];
    //Id del cliente
    $id_cliente = $_POST['txtCliente'];
    $nombre_cliente = $clsprogramacionsemanal->fntGetNombreClienteObj($id_cliente);
    $id_obra = $_POST['txtObra'];
    $nombre_obra = $clsprogramacionsemanal->fntGetNombreObra($id_obra);
    $cantidad = $_POST['txtcantidadmetros'];
    $frecuencia = $_POST['cbxFrecuencia'];
    $horacargue = $_POST['txtHoraCargue'];
    $fechafundida = $_POST['txtFechaFundida'];
    $fecha_ini = $fechafundida . " " . $horacargue;
    $fecha_fin = $fechafundida . " " . $horacargue;
    //Validar si el checkbox esta activo o no
    if (isset($_POST['chkRequiereBomba'])) {
        //Si esta activo se guarda como verdadero
        $requiereBomba = true;
    } else {
        //De lo contrario se guarda como falso.
        $requiereBomba = false;
    }
    $observaciones = $_POST['txtObservaciones'];
    //Se valida que se guarde correctamente todos los datos de la programacion.
    if ($clsprogramacionsemanal->fntCrearProgSemanalPedidosBool($status, $id_cliente, $nombre_cliente, $id_obra, $nombre_obra,  $id_pedido, $id_producto, $nombre_producto, $cantidad, $frecuencia, $requiereBomba, $fecha_ini, $fecha_fin, $observaciones, $id_usuario, $nombre_usuario)) {
        $php_estado = true;
    } else {
        $log = 'No Guardo Correctamente';
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
