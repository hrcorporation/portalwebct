<?php
session_start();
header('Content-Type: application/json');
require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';
$programacion = new ClsProgramacion();
$clsProgramacionSemanal = new clsProgramacionSemanal();
$log = false;
$php_estado = false;
$php_error[] = "";
$resultado = "";
date_default_timezone_set('America/Bogota');
setlocale(LC_ALL, "es_ES");
setlocale(LC_TIME, 'es_ES');
$hora_actual = new DateTime();
$hora_hoy = $hora_actual->format("H:i:s");
$diassemana = array("Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado");
$dia = $diassemana[date('w')];
//id del usuario
$intIdUsuario = $_SESSION['id_usuario'];
//Nombre del usuario mediante el parametro del id del usuario
$StrNombreUsuario = $clsProgramacionSemanal->fntGetNombreClienteObj($intIdUsuario);
$dtmHoraValidacion = $clsProgramacionSemanal->validacionHora($intIdUsuario);
// Crear la programacion hasta las 04 pm
//Validar que la variable de txt_cliente exista y no este vacia
if (isset($_POST['txtCliente']) && !empty($_POST['txtCliente'])) {
    //Estado
    $intEstado = 1;
    //id del cliente
    $intIdCliente = $_POST['txtCliente'];
    //Nombre del cliente mediante el parametro del id del cliente
    $StrNombreCliente = $clsProgramacionSemanal->fntGetNombreClienteObj($intIdCliente);
    //id de la obra
    $intIdObra = $_POST['txtObra'];
    //Nombre de la obra mediante el parametro del id de la obra.
    $StrNombreObra = $clsProgramacionSemanal->fntGetNombreObra($intIdObra);
    //id del pedido
    $intPedido = $_POST['cbxPedido'];
    //id del producto.
    $intIdProducto = $_POST['cbxProducto'];
    //Nombre del producto mediante el parametro del id del producto.
    $StrNombreProducto = $clsProgramacionSemanal->fntGetNombreProducto($intIdProducto);
    //Cantidad
    $decCantidad = $_POST['txtCant'];
    //Frecuencia
    $dtmFrecuencia = $_POST['cbxFrecuencia'];
    //Elementos a fundir
    $StrElementos = $_POST['txtElementos'];
    //Requiere bomba (si/no - true/false)
    if (isset($_POST['chkRequiereBomba'])) {
        $bolRequiereBomba = true;
    } else {
        $bolRequiereBomba = false;
    }
    //Tipo de descargue.
    $intTipoDescargue = $_POST['cbxTipoDescargue'];
    //nombre del tipo de descargue.
    $StrNombreTipoDescargue = $clsProgramacionSemanal->fntGetNombreTipoDescargue($intTipoDescargue);
    //metros de tuberia.
    $decMetrosTuberia = $_POST['txtMetros'];
    //Observaciones.
    if (isset($_POST['txtObservaciones'])) {
        $StrObservaciones = $_POST['txtObservaciones'];
    } else {
        $StrObservaciones = "";
    }
    //Fecha de inicio de la programacion.
    $dtmFechaInicio = $_POST['txtInicio'];
    //Fecha final de la programacion.
    $dtmFechaFin = $_POST['txtFin'];
    //Validar que tome bien los parametros y guarde correctamente la programacion.
    if ($decCantidad > 7) {
        $numeroViajes = ($decCantidad / 7);
        $numeroViajesAp = intval(ceil($numeroViajes));
    } else {
        $numeroViajesAp = 1;
    }

    $metrosCubicos = ($decCantidad / $numeroViajesAp);
    $dtmFrecuenciaNueva = $clsProgramacionSemanal->multiplicar_horas($numeroViajesAp, $dtmFrecuencia);
    $dtmNuevaFechafin = $clsProgramacionSemanal->sumar($dtmFechaInicio, $dtmFrecuenciaNueva);

    if ($dia == "Sabado" && $hora_hoy <= $dtmHoraValidacion || $dia == "Lunes" && $hora_hoy >= $dtmHoraValidacion) {
        if ($clsProgramacionSemanal->fntCrearProgSemanalBool($intEstado, $intIdCliente, $StrNombreCliente, $intIdObra, $StrNombreObra,  $intPedido, $intIdProducto, $StrNombreProducto, $decCantidad, $dtmFrecuencia, $bolRequiereBomba, $intTipoDescargue, $StrNombreTipoDescargue, $decMetrosTuberia, $dtmFechaInicio, $dtmNuevaFechafin, $StrElementos, $StrObservaciones, $intIdUsuario, $StrNombreUsuario)) {
            //Si pasa la validacion se retorna verdadero(true).
            $php_estado = true;
        } else {
            //De lo contrario mostrara un mensaje mostrando que no se guardo.
            $php_error = 'No Guardo Correctamente';
        }
    } else if ($dia != "Sabado" && $dia != "Domingo" && $dia != "Lunes") {
        if ($clsProgramacionSemanal->fntCrearProgSemanalBool($intEstado, $intIdCliente, $StrNombreCliente, $intIdObra, $StrNombreObra,  $intPedido, $intIdProducto, $StrNombreProducto, $decCantidad, $dtmFrecuencia, $bolRequiereBomba, $intTipoDescargue, $StrNombreTipoDescargue, $decMetrosTuberia, $dtmFechaInicio, $dtmNuevaFechafin, $StrElementos, $StrObservaciones, $intIdUsuario, $StrNombreUsuario)) {
            //Si pasa la validacion se retorna verdadero(true).
            $php_estado = true;
        } else {
            //De lo contrario mostrara un mensaje mostrando que no se guardo.
            $php_error = 'No Guardo Correctamente';
        }
    } else {
        $php_error = 'Fuera del horario establecido para programar';
    }
} else {
    $php_error = 'Se requieren los datos';
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $php_error,
    'result' => $resultado,
);
echo json_encode($datos, JSON_FORCE_OBJECT);
