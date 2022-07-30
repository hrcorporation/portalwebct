<?php
session_start();
header('Content-Type: application/json');
require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';
//Se crea un objeto de la clase programacionSemanal
$clsProgramacionDiaria = new clsProgramacionDiaria();

$php_estado = false;
$errores = "";
$resultado = "";

if ($_POST['task'] == 1) {
    $intIdCliente = $_POST['cliente'];
    $intIdObra = $_POST['obra'];
    //Buscar el id de la obra filtrandola con el id del cliente.
    $objSelectPedidos = $clsProgramacionDiaria->fntOptionListaPedidosClienteObj($intIdCliente, $intIdObra);
    $objSelectProductos = "";
    $php_estado = true;
    $datos = array(
        'estado' => $php_estado,
        'errores' => $errores,
        'result' => $resultado,
        'select_pedidos' => $objSelectPedidos,
        'select_productos' => $objSelectProductos
    );
} elseif ($_POST['task'] == 2) {
    $intIdPedido = $_POST['pedido'];
    $objSelectProductos = $clsProgramacionDiaria->fntOptionProductoFuncionarioObj($intIdPedido);
    $datos = array(
        'estado' => $php_estado,
        'errores' => $errores,
        'result' => $resultado,
        'select_productos' => $objSelectProductos
    );
}
echo json_encode($datos, JSON_FORCE_OBJECT);
