<?php
session_start();
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';
//Se crea un objeto de la clase programacion.
$clsProgramacionSemanal = new clsProgramacionSemanal();
$log = false;
$php_estado = false;
$php_error[] = "";
$resultado = "";
//Validar que la variable de cbxCliente exista y no este vacia
if (isset($_POST['cbxCliente']) && !empty($_POST['cbxCliente'])) {
    //Id del usuario.
    $intIdUsuario = $_SESSION['id_usuario'];
    //Nombre del usuario mediante el parametro del id del usuario
    $StrNombreUsuario = $clsProgramacionSemanal->fntGetNombreClienteObj($intIdUsuario);
    //Estado.
    $intEstado = 2;
    //Id del cliente.
    $intIdCliente = $_POST['cbxCliente'];
    //Nombre del cliente mediante el parametro del id del cliente
    $StrNombreCliente = $clsProgramacionSemanal->fntGetNombreClienteObj($intIdCliente);
    //id de la obra.
    $intIdObra = $_POST['cbxObra'];
    //Nombre de la obra mediante el parametro del id de la obra.
    $StrNombreObra = $clsProgramacionSemanal->fntGetNombreObra($intIdObra);
    //Id del pedido.
    $intPedido = $_POST['cbxPedido'];
    //Id del producto.
    $intIdProducto = $_POST['cbxProducto'];
    //Nombre del producto mediante el parametro del id del producto.
    $StrNombreProducto = $clsProgramacionSemanal->fntGetNombreProducto($intIdProducto);
    //Cantidad.
    $decCantidad = $_POST['txtCant'];
    //Frecuencia.
    $dtmFrecuencia = $_POST['cbxFrecuencia'];
    //Elementos a fundir.
    $StrElementos = $_POST['txtElementos'];
    //Validar que la variable exista, si cumple la variable se le asigna true, de lo contrario seria false.
    if (isset($_POST['chkRequiereBomba'])) {
        $bolRequiereBomba = true;
    } else {
        $bolRequiereBomba = false;
    }
    //Tipo de descargue.
    $intTipoDescargue = $_POST['cbxTipoDescargue'];
    //Nombre del tipo de descargue.
    $StrNombreTipoDescargue = $clsProgramacionSemanal->fntGetNombreTipoDescargue($intTipoDescargue);
    //Metros de tuberia.
    $decMetrosTuberia = $_POST['txtMetros'];
    //Observaciones.
    $StrObservaciones = $_POST['txtObservaciones'];
    //Fecha de inicio de la programacion.
    $dtmFechaInicio = $_POST['txtInicio'];
    //Fecha final de la programacion.
    $dtmFechaFin = $_POST['txtFin'];
    //Validar que tome bien los parametros y guarde correctamente la programacion.
    if ($clsProgramacionSemanal->fntCrearProgSemanalBool($intEstado, $intIdCliente, $StrNombreCliente, $intIdObra, $StrNombreObra,  $intPedido, $intIdProducto, $StrNombreProducto, $decCantidad, $dtmFrecuencia, $bolRequiereBomba, $intTipoDescargue, $StrNombreTipoDescargue, $decMetrosTuberia, $dtmFechaInicio, $dtmFechaFin, $StrElementos, $StrObservaciones, $intIdUsuario, $StrNombreUsuario)) {
        //Si pasa la validacion se retorna verdadero(true).
        $php_estado = true;
    } else {
        //De lo contrario mostrara un mensaje mostrando que no se guardo.
        $php_error = 'No guardo Correctamente';
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
