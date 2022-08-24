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
//Id de la linea de produccion.
$id_linea_produccion = $_POST['lineaproduccion'];
if ($id_linea_produccion != 0) {
    $id_linea_produccion = $_POST['lineaproduccion'];
    $objData = $clsProgramacionDiaria->fntGetProgDiariaFuncionario2Obj($id_linea_produccion);
}else{
    $objData = $clsProgramacionDiaria->fntGetProgDiariaFuncionarioObj();
}
//Se listan todas las programaciones.

$boolPhpEstado = true;
//Datos de los arreglos.
$datos = array(
    'estado' => $boolPhpEstado,
    'errores' => $arrayPhpError,
    'result' => $StrResultado,
    'post'  => $_POST,
);
print json_encode($objData, JSON_UNESCAPED_UNICODE);
