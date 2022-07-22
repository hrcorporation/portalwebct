<?php
session_start();
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

require 'modelo_t26.php';
$t26 = new modelo_t26();

$php_estado = false;
$datosRemi = $t26->getFechaHora();

foreach ($datosRemi as $dato) {
    $fecha = $dato['ct26_fecha_remi'];
    $hora = $dato['ct26_hora_salida_planta'];

    $hora_salida_planta = $fecha. " " .$hora;
}

if ($t26->actualizarFecha($hora_salida_planta, $fecha, $hora)) {
    $php_estado = true;
} else {
    $php_estado = false;
}

echo json_encode($php_estado, JSON_FORCE_OBJECT);
