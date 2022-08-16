<?php

session_start();
header('Content-Type: application/json');

require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';
//SE CREA UN OBJETO DE LA CLASE PEDIDOS
$pedidos = new pedidos();
//SE HACE UNA VALIDACION DE QUE EL PEDIDO EXISTA
if (isset($_POST['id_pedido']) && !empty($_POST['id_pedido'])) {
     //TRAE TODOS LOS DATOS DE LOS PRODUCTOS FILTRANDOLOS POR EL ID DEL PEDIDO
    $data = $pedidos->get_productos_precio($_POST['id_pedido']);
} else {
    //DE LO CONTRARIO DEVUELVE UN FALSO
    $data = false;
}

//print json_encode($datos, JSON_FORCE_OBJECT);
print json_encode($data, JSON_UNESCAPED_UNICODE);
