<?php
session_start();
header('Content-Type: application/json');
require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';
$clsProgramacionSemanal = new ClsProgramacionSemanal();
$log = false;
$php_estado = false;
$php_error[] = "";
$resultado = "";

$objEstados = $clsProgramacionSemanal->fntGetEstadosProgramacionFuncionarioObj();
if (is_array($objEstados)) {
    foreach ($objEstados as $estado) {
        $intEstadoProgramacion = $estado['status'];
        if ($intEstadoProgramacion == 2) {
            if ($clsProgramacionSemanal->fntCambiarEstadoProgramacionSemanalFuncionario()) {
                //Si pasa la validacion se retorna verdadero(true)
                $php_estado = true;
            } else {
                //De lo contrario mostrara un mensaje mostrando que no se guardo
                $php_error = 'No Guardo Correctamente';
            }
        } else {
            $php_error = 'No tiene programaciones pendientes por confirmar';
        }
    }
}else{
    $php_error = 'NO HAY PROGRAMACIONES REALIZADAS';
}
$datos = array(
    'estado' => $php_estado,
    'errores' => $php_error,
    'result' => $resultado,
);
echo json_encode($datos, JSON_FORCE_OBJECT);
