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
    $hora_salida = $dato['ct26_hora_salida_planta'];
    $hora_llegada = $dato['ct26_hora_llegada_obra'];
    $notificacion = $dato['ct26_notificacion'];

    $hora_salida_planta = $fecha . " " . $hora_salida;
    $hora_llegada_obra = $fecha . " " . $hora_llegada;

    $anio = date('Y', $fecha);

    if ($notificacion == 3 && $anio == 2022) {
        if ($t26->actualizarFechaTres($hora_salida_planta, $fecha)) {
            $php_estado = true;
        } else {
            $php_estado = false;
        }
    } else if ($notificacion == 4 && $anio == 2022) {
        if ($t26->actualizarFechaTres($hora_salida_planta, $hora_llegada_obra, $fecha)) {
            $php_estado = true;
        } else {
            $php_estado = false;
        }
    }
}

echo json_encode($php_estado, JSON_FORCE_OBJECT);
