<?php
session_start();
header('Content-Type: application/json');
require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';
//Se crea un objeto de la clase programacionSemanal
$objProgramacionSemanal = new ClsProgramacionSemanal();
$boolPhpEstado = false;
$objSelectObras = "";
if ($_POST['task'] == 1) {
    $objSelectCliente  = $objProgramacionSemanal->fntOptionClienteEditObj();
    $datos = array(
        'select_cliente' => $objSelectCliente,
    );
} 
elseif ($_POST['task'] == 2) {
    $intIdCliente = $_POST['cliente'];
    //Buscar el id de la obra filtrandola con el id del cliente.
    $objSelectObras = $objProgramacionSemanal->fntOptionObraEditObj($intIdCliente);
    $boolPhpEstado = true;

    $datos = array(
        'estado' => $boolPhpEstado,
        'select_obra' => $objSelectObras,
    );
}
echo json_encode($datos, JSON_FORCE_OBJECT);
