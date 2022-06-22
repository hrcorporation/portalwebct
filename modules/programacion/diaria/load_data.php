<?php

session_start();
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php'; 

//Se crea un objeto de la clase programacionSemanal
$programacion = new ClsProgramacionDiaria();

$php_estado = false;
$errores = "";
$resultado = "";
$select_obras ="";

if ($_POST['task'] == 1){
    $select_cliente  = $programacion->fntOptionClienteEditObj();
    $datos = array(
        'select_cliente' => $select_cliente,
    );

}elseif($_POST['task'] == 2){
    $id_cliente = $_POST['cliente'];
    //Buscar el id de la obra filtrandola con el id del cliente.
    $select_obras = $programacion->fntOptionObraEditObj($id_cliente);
    $php_estado = true; 

    $datos = array(
        'estado' => $php_estado,
        'select_obra' => $select_obras,
    );
}

echo json_encode($datos, JSON_FORCE_OBJECT);
