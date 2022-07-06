<?php
session_start();
header('Content-Type: application/json');
require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';
$clsProgramacionSemanal = new ClsProgramacionSemanal();
$log = false;
$php_estado = false;
$php_error[] = "";
$resultado = "";
$intIdUsuario = $_SESSION['id_usuario'];
$objEstados = $clsProgramacionSemanal->fntGetEstadosProgramacionClienteObj($intIdUsuario);
if (is_array($objEstados)) {
    foreach ($objEstados as $estado) {
        $intEstadoProgramacion = $estado['status'];
        if ($intEstadoProgramacion != 3 || $intEstadoProgramacion !=4) {
            if ($clsProgramacionSemanal->fntCambiarEstadoProgramacionSemanal($intIdUsuario)) {
                //Si pasa la validacion se retorna verdadero(true)
                $php_estado = true;
            } else {
                //De lo contrario mostrara un mensaje mostrando que no se guardo
                $php_error = 'No Guardo Correctamente';
            }
        } else {
            $php_error = 'PROGRAMACION YA CARGADA';
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
