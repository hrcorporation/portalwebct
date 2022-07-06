<?php
session_start();
header('Content-Type: application/json');
require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';
$programacion = new ClsProgramacion();
$clsProgramacionSemanal = new ClsProgramacionSemanal();
$log = false;
$php_estado = false;
$php_error[] = "";
$resultado = "";
date_default_timezone_set('America/Bogota');
setlocale(LC_ALL, 'es_ES');
setlocale(LC_TIME, 'es_ES');
$hora_actual = new DateTime();
$hora_hoy = $hora_actual->format("H:i:s");
//Validar que el rol del funcionario sea el el administrador o los dos cargos de programacion(15 y 16)
if ($hora_hoy < "16:00:00") {
    //Validar que la variable de txt_cliente exista y no este vacia
    if (isset($_POST['txtCliente']) && !empty($_POST['txtCliente'])) {
        //id del usuario
        $intIdUsuario = $_SESSION['id_usuario'];
        //Nombre del usuario mediante el parametro del id del usuario
        $StrNombreUsuario = $clsProgramacionSemanal->fntGetNombreClienteObj($intIdUsuario);
        //Estado
        $intEstado = 2;
        //id del cliente
        $StrNombreCliente = $_POST['txtCliente'];
        //Nombre del cliente mediante el parametro del id del cliente
        // $StrNombreCliente = $programacion->get_nombre_cliente($intIdCliente);
        $intIdCliente = 1;
        //id de la obra
        $StrNombreObra = $_POST['txtObra'];
        //Nombre de la obra mediante el parametro del id de la obra.
        // $StrNombreObra = $programacion->get_nombre_obra($intIdObra);
        $intIdObra = 5;
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
        $bolRequiereBomba = $_POST['chkRequiereBomba'];
        //Tipo de descargue
        $intTipoDescargue = $_POST['cbxTipoDescargue'];
        //nombre del tipo de descargue
        $StrNombreTipoDescargue = $clsProgramacionSemanal->fntGetNombreTipoDescargue($intTipoDescargue);
        //metros de tuberia
        $decMetrosTuberia = $_POST['txtMetros'];
        //Observaciones
        $StrObservaciones = $_POST['txtObservaciones'];
        //Fecha de inicio de la programacion
        $dtmFechaInicio = $_POST['txtInicio'];
        //Fecha final de la programacion
        $dtmFechaFin = $_POST['txtFin'];
        //Validar que tome bien los parametros y guarde correctamente la programacion
        if ($clsProgramacionSemanal->fntCrearProgSemanalBool($intEstado, $intIdCliente, $StrNombreCliente, $intIdObra, $StrNombreObra,  $intPedido, $intIdProducto, $StrNombreProducto, $decCantidad, $dtmFrecuencia, $bolRequiereBomba, $intTipoDescargue, $StrNombreTipoDescargue, $decMetrosTuberia, $dtmFechaInicio, $dtmFechaFin, $StrElementos, $StrObservaciones, $intIdUsuario, $StrNombreUsuario)) {
            //Si pasa la validacion se retorna verdadero(true)
            $php_estado = true;
        } else {
            //De lo contrario mostrara un mensaje mostrando que no se guardo
            $php_error = 'No Guardo Correctamente';
        }
    } else {
        $php_error = 'Se requieren los datos';
    }
}else{
    $php_error = 'FUERA DE LA HORA DE PROGRAMACION, INTENTE MAS TARDE';
}
$datos = array(
    'estado' => $php_estado,
    'errores' => $php_error,
    'result' => $resultado,
);
echo json_encode($datos, JSON_FORCE_OBJECT);