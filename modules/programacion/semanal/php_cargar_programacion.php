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

$objProgramacionesSemanales = $clsProgramacionSemanal->fntGetProgSemanalFuncionarioEstadoObj();

if (is_array($objProgramacionesSemanales)) {
    foreach ($objProgramacionesSemanales as $estado) {
        $intEstado = $estado['status'];
        $intIdCliente = $estado['id_cliente'];
        $strNombreCliente = $estado['nombre_cliente'];
        $intIdObra = $estado['id_obra'];
        $strNombreObra = $estado['nombre_obra'];
        $intIdPedido = $estado['id_pedido'];
        $intIdProducto = $estado['id_producto'];
        $strNombreProducto = $estado['nombre_producto'];
        $intCantidad = $estado['cantidad'];
        $intValorProgramacion = $estado['valor_programacion'];
        $dtmFrecuencia = $estado['frecuencia'];
        $boolRequiereBomba = $estado['requiere_bomba'];
        $intIdTipoDescargue = $estado['id_tipo_descargue'];
        $strNombreTipoDescargue = $estado['nombre_tipo_descargue'];
        $dblMetrosTuberia = $estado['metros_tuberia'];
        $dtmFechaInicial = $estado['fecha_ini'];
        $dtmFechaFinal = $estado['fecha_fin'];
        $strElementosFundir = $estado['elementos_fundir'];
        $strObservaciones = $estado['observaciones'];
        $intIdUsuario = $estado['id_usuario'];
        $strNombreUsuario = $estado['nombre_usuario'];

        $numeroViajes = $intCantidad / 7;
        $numeroViajesAp = ceil($numeroViajes);
        
        if ($intEstado == 2) {
            if ($clsProgramacionSemanal->fntCrearProgDiariaFuncionarioBool($intEstado, $intIdCliente, $strNombreCliente, $intIdObra, $strNombreObra,  $intIdPedido, $intIdProducto, $strNombreProducto,  $intCantidad, $numeroViajesAp, $boolRequiereBomba, $intIdTipoDescargue, $strNombreTipoDescargue, $dblMetrosTuberia, $dtmFechaInicial, $dtmFechaFinal, $strElementosFundir, $strObservaciones, $intIdUsuario, $strNombreUsuario)) {
                //Si pasa la validacion se retorna verdadero(true)
                $php_estado = true;
            } else {
                $php_error = 'No guardo correctamente';
            }

            if ($clsProgramacionSemanal->fntCambiarEstadoProgramacionSemanalFuncionario()) {
                //Si pasa la validacion se retorna verdadero(true)
                $php_estado = true;
            } else {
                //De lo contrario mostrara un mensaje mostrando que no se guardo
                $php_error = 'No guardo correctamente';
            }
        } else {
            $php_error = 'No tiene programaciones pendientes por confirmar';
        }
    }
} else {
    $php_error = 'NO HAY PROGRAMACIONES REALIZADAS';
}
$datos = array(
    'estado' => $php_estado,
    'errores' => $php_error,
    'result' => $resultado,
);
echo json_encode($datos, JSON_FORCE_OBJECT);
