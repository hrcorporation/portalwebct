<?php
session_start();
header('Content-Type: application/json');
require '../../librerias/autoload.php';
require '../../modelos/autoload.php';
require '../../vendor/autoload.php';
//Se crea un objeto de la clase consignacion
$ClsConsignaciones = new clsConsignacion();
$log = false;
$boolPhpEstado = false;
$php_error[] = "";
$resultado = "";
// Validar que la variable de txtFechaConsignacion exista y no este vacia
if (isset($_SESSION['id_usuario']) && !empty($_SESSION['id_usuario'])) {
    //id del usuario en sesion
    $intIdUsuario = $_SESSION['id_usuario'];
    //Nombre del usuario en sesion
    $StrNombreUsuario = $ClsConsignaciones->fntGetNombreClienteObj($intIdUsuario);
    //Fecha de la consignacion
    $dtmFechaConsignacion = $_POST['txtFechaConsignacion'];
    //Id del banco
    $intIdBanco = $_POST['cbxBanco'];
    //Nombre del banco
    $StrBanco = $ClsConsignaciones->fntGetBancoObj($intIdBanco);
    //Valor de la consignacion
    $dblValorConsignacion = str_replace(".", "", htmlspecialchars($_POST['txtValor']));
    if (isset($_POST['cbxEstado'])) {
        //Estado de la consignacion
        $intIdEstado = $_POST['cbxEstado'];
    }else{
        $intIdEstado = 1;
    }
    //Id del cliente
    $intIdCliente = $_POST['cbxCliente'];
    //Nombre del cliente
    $StrNombreCliente = $ClsConsignaciones->fntGetNombreClienteObj($intIdCliente);
    //Observaciones o comentarios
    $StrObservaciones = $_POST['txtObservaciones'];

    //Obtener el saldo del cliente
    $dblSaldoCliente = $ClsConsignaciones->fntGetSaldoCliente($intIdCliente);
    $dblSaldoNuevo = $dblSaldoCliente - $dblValorConsignacion;
    if ($ClsConsignaciones->fntCrearConsignacionObj($dtmFechaConsignacion, $intIdBanco, $StrBanco, $dblValorConsignacion, $intIdEstado,  $intIdCliente, $StrNombreCliente, $StrObservaciones, $intIdUsuario, $StrNombreUsuario)) {
        //Si pasa la validacion se retorna verdadero(true)
        $boolPhpEstado = true;
        $ClsConsignaciones->fntActualizarSaldoCliente($intIdCliente, $dblSaldoNuevo);
    } else {
        //De lo contrario mostrara un mensaje mostrando que no se guardo
        $php_error = 'No Guardo Correctamente';
    }
} else {
    $php_error = 'Se requieren los datos';
}
$datos = array(
    'estado' => $boolPhpEstado,
    'errores' => $php_error,
    'result' => $resultado,
);
echo json_encode($datos, JSON_FORCE_OBJECT);
