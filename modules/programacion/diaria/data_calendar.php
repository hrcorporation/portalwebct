<?php
session_start();
header('Content-Type: application/json');
require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';
$log = false;
$boolPhpEstado = false;
$arrayPhpError[] = "";
$StrResultado = "";
//se crea un objeto de la clase programacion.
$clsProgramacionDiaria = new clsProgramacionDiaria();
//Se listan todas las programaciones.
$objData = $clsProgramacionDiaria->fntGetProgDiariaFuncionarioObj();
$boolPhpEstado = true;
//Datos de los arreglos.
$datos = array(
    'estado' => $boolPhpEstado,
    'errores' => $arrayPhpError,
    'result' => $StrResultado,
);
print json_encode($objData, JSON_UNESCAPED_UNICODE);
