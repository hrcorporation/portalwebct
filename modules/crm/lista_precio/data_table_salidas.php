<?php

session_start();
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';
//OBTENER LA FECHA ACTUAL
$fecha_hoy = date('Y-m-d');
//SE CREA UN OBJETO DE LA CLASE PEDIDOS
$clslistaprecio = new clslistaprecio();
//LISTA TODOS LOS PEDIDOS REALIZADOS
$data = $clslistaprecio->get_pedidos();
//CAMBIA EL STATUS DE LOS PEDIDOS DESPUES DE SUPERAR LA FECHA DE VENCIMIENTO CON LA FECHA DE HOY
$clslistaprecio->cambiar_status_pedido($fecha_hoy);
//print json_encode($datos, JSON_FORCE_OBJECT);
print json_encode($data, JSON_UNESCAPED_UNICODE);