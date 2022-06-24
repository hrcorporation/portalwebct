<?php
session_start();
header('Content-Type: application/json');
require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';
//Se crea un objeto de la clase programacion
$ClsProgramacionSemanal = new ClsProgramacionSemanal();
$log = false;
$php_estado = false;
$php_error[] = "";
$resultado = "";
//Validar que la variable de txt_cliente exista y no este vacia
if (isset($_POST['cbxCliente']) && !empty($_POST['cbxCliente'])) {
    //id del usuario
    $intIdUsuario = $_SESSION['id_usuario'];
    //Nombre del usuario mediante el parametro del id del usuario
    $StrNombreUsuario = $ClsProgramacionSemanal->fntGetNombreCliente($intIdUsuario);
    //Estado (1. Aprobado, 2. Pendiente, 3. Cancelado)
    $intEstado = 2;
    //id del cliente
    $intIdCliente = $_POST['cbxCliente'];
    //Nombre del cliente mediante el parametro del id del cliente
    $StrNombreCliente = $ClsProgramacionSemanal->fntGetNombreCliente($intIdCliente);
    //id de la obra
    $intIdObra = $_POST['cbxObra'];
    //Nombre de la obra mediante el parametro del id de la obra.
    $StrNombreObra = $ClsProgramacionSemanal->fntGetNombreObra($intIdObra);
    //id del pedido
    $intPedido = $_POST['cbxPedido'];
    //id del producto.
    $intIdProducto = $_POST['cbxProducto'];
    //Nombre del producto mediante el parametro del id del producto.
    $StrNombreProducto = $ClsProgramacionSemanal->fntGetNombreProducto($intIdProducto);
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
    $StrNombreTipoDescargue = $ClsProgramacionSemanal->fntGetNombreTipoDescargue($intTipoDescargue);
    //metros de tuberia
    $decMetrosTuberia = $_POST['txtMetros'];
    //Observaciones
    $StrObservaciones = $_POST['txtObservaciones'];
    //Fecha de inicio de la programacion
    $dtmFechaInicio = $_POST['txtInicio'];
    //Fecha final de la programacion
    $dtmFechaFin = $_POST['txtFin'];
    //Validar que tome bien los parametros y guarde correctamente la programacion
    if ($ClsProgramacionSemanal->fntCrearProgSemanalBool($intEstado, $intIdCliente, $StrNombreCliente, $intIdObra, $StrNombreObra,  $intPedido, $intIdProducto, $StrNombreProducto, $decCantidad, $dtmFrecuencia, $bolRequiereBomba, $intTipoDescargue, $StrNombreTipoDescargue, $decMetrosTuberia, $dtmFechaInicio, $dtmFechaFin, $StrElementos, $StrObservaciones, $intIdUsuario, $StrNombreUsuario)) {
        //Si pasa la validacion se retorna verdadero(true)
        $php_estado = true;
    } else {
        //De lo contrario mostrara un mensaje mostrando que no se guardo
        $php_error = 'No Guardo Correctamente';
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
