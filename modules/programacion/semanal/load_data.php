<?php
session_start();
header('Content-Type: application/json');
require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';
//Se crea un objeto de la clase programacionSemanal
$objProgramacionSemanal = new ClsProgramacionSemanal();
$boolPhpEstado = false;
$objSelectObras = "";

if ($_POST['task'] == 1) {
    $objSelectCliente  = $objProgramacionSemanal->fntOptionClienteEditFuncionarioObj();
    $datos = array(
        'select_cliente' => $objSelectCliente,
    );
} elseif ($_POST['task'] == 2) {
    $intIdCliente = $_POST['cliente'];
    //Buscar el id de la obra filtrandola con el id del cliente.
    $objSelectObras = $objProgramacionSemanal->fntOptionObraEditFuncionarioObj($intIdCliente);
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