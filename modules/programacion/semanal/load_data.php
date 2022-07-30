<?php
session_start();
header('Content-Type: application/json');
require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';
//Se crea un objeto de la clase programacionSemanal
$clsProgramacionSemanal = new clsProgramacionSemanal();
$boolPhpEstado = false;
$objSelectObras = "";

if ($_POST['task'] == 1) {
    //Select de los clientes
    $objSelectCliente  = $clsProgramacionSemanal->fntOptionClienteEditFuncionarioObj();
    $datos = array(
        'select_cliente' => $objSelectCliente,
    );
} elseif ($_POST['task'] == 2) {
    $intIdCliente = $_POST['cliente'];
    //Select de las obras que estan relacionadas con el cliente.
    $objSelectObras = $clsProgramacionSemanal->fntOptionObraEditFuncionarioObj($intIdCliente);
    $objSelectPedidos = "";
    $objSelectProductos = "";

    $boolPhpEstado = true;
    $datos = array(
        'estado' => $boolPhpEstado,
        'select_obra' => $objSelectObras,
        'select_pedidos' => $objSelectPedidos,
        'select_productos' => $objSelectProductos
    );
}
echo json_encode($datos, JSON_FORCE_OBJECT);