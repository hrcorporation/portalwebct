<?php
session_start();
header('Content-Type: application/json');
require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';
//Se crea un objeto de la clase programacion
$ClsProgramacionDiaria = new ClsProgramacionDiaria();
$log = false;
$php_estado = false;
$php_error[] = "";
$resultado = "";
//Validar que la variable de txt_cliente exista y no este vacia
if (isset($_POST['cbxPedido']) && !empty($_POST['cbxPedido'])) {
    //id del usuario
    $intIdUsuario = $_SESSION['id_usuario'];
    //Nombre del usuario mediante el parametro del id del usuario
    $StrNombreUsuario = $ClsProgramacionDiaria->fntGetNombreClienteObj($intIdUsuario);
    //Estado
    $intEstado = 1;
    //id del cliente
    $intIdCliente = $_POST['txtCliente'];
    //Nombre del cliente mediante el parametro del id del cliente
    $StrNombreCliente = $ClsProgramacionDiaria->fntGetNombreClienteObj($intIdCliente);
    //id de la obra
    $intIdObra = $_POST['txtObra'];
    //Nombre de la obra mediante el parametro del id de la obra.
    $StrNombreObra = $ClsProgramacionDiaria->fntGetNombreObraObj($intIdObra);
    //id del pedido
    $intPedido = $_POST['cbxPedido'];
    //id del producto.
    $intIdProducto = $_POST['cbxProducto'];
    //Nombre del producto mediante el parametro del id del producto.
    $StrNombreProducto = $ClsProgramacionDiaria->fntGetNombreProductoObj($intIdProducto);
    //id de la linea de despacho.
    $intIdLineaDespacho = $_POST['cbxProducto'];
    //Nombre de la linea de despacho mediante el parametro del id del producto.
    $StrNombreLineaDespacho = $ClsProgramacionDiaria->fntGetNombreLineaDespachoObj($intIdLineaDespacho);
    //hora de cargue
    $dtmHoraCargue = $_POST['txtHoraCargue'];
    //Hora mixer en obra
    $dtmHoraMixerObra = $_POST['txtHoraMixer'];
    //Id de la mixer 
    $intIdMixer = $_POST['cbxMixer'];
    //Placa de la mixer
    $StrPlacaMixer = $ClsProgramacionDiaria->fntGetPlacaMixerObj($intIdMixer);
    //Id del conductor
    $intIdConductor = $_POST['cbxConductor'];
    //Nombre del conductor mediante el parametro del id del conductor
    $StrNombreConductor = $ClsProgramacionDiaria->fntGetNombreClienteObj($intIdConductor);
    //Cantidad
    $decCantidad = $_POST['txtCant'];
    //Validar que la variable exista, si cumple la variable se le asigna true, de lo contrario seria false.
    if (isset($_POST['chkRequiereBomba'])) {
        $bolRequiereBomba = true;
    } else {
        $bolRequiereBomba = false;
    }
    //Tipo de descargue
    $intTipoDescargue = $_POST['cbxTipoDescargue'];
    //nombre del tipo de descargue
    $StrNombreTipoDescargue = $ClsProgramacionDiaria->fntGetNombreTipoDescargueObj($intTipoDescargue);
    //Tipo de bomba
    $intTipoBomba = $_POST['cbxTipoBomba'];
    //nombre del tipo de bomba
    $StrNombreTipoBomba = $ClsProgramacionDiaria->fntGetNombreTipoBombaObj($intTipoBomba);
    //Observaciones
    $StrObservaciones = $_POST['txtObservaciones'];
    //Fecha de inicio de la programacion
    $dtmFechaInicio = $_POST['txtInicio'];
    //Fecha final de la programacion
    $dtmFechaFin = $_POST['txtFin'];
    //Validar que tome bien los parametros y guarde correctamente la programacion
    if ($ClsProgramacionDiaria->fntCrearProgDiariaClienteBool($intEstado, $intIdCliente, $StrNombreCliente, $intIdObra, $StrNombreObra,  $intPedido, $intIdProducto, $StrNombreProducto, $intIdLineaDespacho, $StrNombreLineaDespacho, $dtmHoraCargue, $dtmHoraMixerObra, $intIdMixer, $StrPlacaMixer, $intIdConductor, $StrNombreConductor, $decCantidad, $bolRequiereBomba, $intTipoDescargue, $StrNombreTipoDescargue, $intTipoBomba, $StrNombreTipoBomba, $dtmFechaInicio, $dtmFechaFin, $StrObservaciones, $intIdUsuario, $StrNombreUsuario)) {
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
