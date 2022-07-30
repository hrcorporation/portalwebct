<?php
session_start();
header('Content-Type: application/json');
require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';
$boolPhpEstado = false;
$arrayPhpError[] = "";
$StrResultado = "";
//se crea un objeto de la clase clsProgramacionSemanal.
$clsProgramacionSemanal = new clsProgramacionSemanal();
//Se listan todas las programaciones.
$objData = $clsProgramacionSemanal->fntGetProgSemanalFuncionarioObj();
$boolPhpEstado = true;
//Datos de los arreglos.
$datos = array(
    'estado' => $boolPhpEstado,
    'errores' => $arrayPhpError,
    'result' => $StrResultado,
);
//print json_encode($datos, JSON_FORCE_OBJECT);
print json_encode($objData, JSON_UNESCAPED_UNICODE);
