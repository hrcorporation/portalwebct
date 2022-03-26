<?php

session_start();
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

$data = "";
$oportunidad_negocio = new oportunidad_negocio();

$id_usuario = (int) ($_SESSION['id_usuario']);
if ($_SESSION['rol_funcionario'] == 1) {
    $data = $oportunidad_negocio->dt_oportunidad_negocio();
} else if ($_SESSION['rol_funcionario'] == 12 || $_SESSION['rol_funcionario'] == 13) {
    $data = $oportunidad_negocio->dt_oportunidad_negocio_por_id($id_usuario);
}

//print json_encode($datos, JSON_FORCE_OBJECT);
print json_encode($data, JSON_UNESCAPED_UNICODE);
