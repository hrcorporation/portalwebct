<?php
session_start();
header('Content-Type: application/json');
require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';
//Se crea un objeto de la clase programacionSemanal
$clsProgramacionSemanal = new clsProgramacionSemanal();
$php_estado = false;
$errores = "";
$resultado = "";
if ($_POST['task'] == 1) {
    //id del cliente
    $intIdCliente = $_POST['cliente'];
    //id de la obra
    $intIdObra = $_POST['obra'];
    //Select de los pedidos que estan relacionados con el cliente y obra.
    $objSelectPedidos = $clsProgramacionSemanal->fntOptionListaPedidosObj($intIdCliente, $intIdObra);
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
    //id del pedido.
    $intIdPedido = $_POST['pedido'];
    //Select de los productos que estan relacionados con el pedido.
    $objSelectProductos = $clsProgramacionSemanal->fntOptionProductoFuncionarioObj($intIdPedido);
    $datos = array(
        'estado' => $php_estado,
        'errores' => $errores,
        'result' => $resultado,
        'select_productos' => $objSelectProductos
    );
}
echo json_encode($datos, JSON_FORCE_OBJECT);