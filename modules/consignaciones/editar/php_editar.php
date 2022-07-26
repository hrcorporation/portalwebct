<?php

session_start();
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

$ClsConsignacion = new clsConsignacion();

$php_estado = false;
$php_error[] = "";
$resultado = "";
//Se hace un condicional que valida si la variable de los datos de la tabla color del concreto existe y tambien valida si ese dato esta vacio.
if (isset($_POST['id']) && !empty($_POST['id'])) {
    //Se crea un objeto de la clase Datetime
    $fecha_actual = new DateTime();
    //Se obtiene la fecha actual con el formato completo
    $dtmHoy = $fecha_actual->format("Y-m-d H:i:s");
    //id de la consignacion
    $intId = $_POST['id'];
    //id del usuario en sesion
    $intIdUsuario = $_SESSION['id_usuario'];
    //Nombre del usuario en sesion
    $StrNombreUsuario = $ClsConsignacion->fntGetNombreClienteObj($intIdUsuario);
    //Fecha de la consignacion
    $dtmFechaConsignacion = $_POST['txtFechaConsignacionEditar'];
    //Id del banco
    $intIdBanco = $_POST['cbxBancoEditar'];
    //Nombre del banco
    $StrBanco = $ClsConsignacion->fntGetBancoObj($intIdBanco);
    //Valor de la consignacion
    $dblValorConsignacion = str_replace(".", "", htmlspecialchars($_POST['txtValorEditar']));
    //Estado de la consignacion
    $intIdEstado = $_POST['cbxEstadoEditar'];
    //Id del cliente
    if (isset($_POST['cbxClienteEditar'])) {
        $intIdCliente = $_POST['cbxClienteEditar'];
        //Nombre del cliente
        $StrNombreCliente = $ClsConsignacion->fntGetNombreClienteObj($intIdCliente);
        //Estado de la consignacion
        $intIdEstado = 2;
    }else{
        $intIdCliente = 0;
        $StrNombreCliente = "";
        $intIdEstado = 1;
    }
    //Observaciones o comentarios
    $StrObservaciones = $_POST['txtObservacionesEditar'];
    //Modificacion de la consignacion
    if ($ClsConsignacion->fntEditarConsignacionObj($intId, $intIdEstado, $dtmFechaConsignacion, $intIdBanco, $StrBanco, $dblValorConsignacion, $intIdCliente, $StrNombreCliente, $StrObservaciones, $intIdUsuario, $StrNombreUsuario, $dtmHoy)) {
        $php_estado = true;
    } else {
        $log = 'No Guardo Correctamente';
    }
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $php_error,
    'result' => $resultado,
);

echo json_encode($datos, JSON_FORCE_OBJECT);
