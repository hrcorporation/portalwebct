<?php

header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';
//Inicializar las variables requeridas.
$php_estado = false;
$php_msg = "";
$id_novedad  = 0;
//Se crea un objeto de la clase novedades_despacho.
$cls_novedades = new novedades_despacho();
//Validar que la variable fecha novedad exista y no este vacia.
if (isset($_POST['fecha_novedad']) && !empty($_POST['fecha_novedad']) ){
    //Validar si se crea correctamente la novedad con el parametro de la fecha.
    if($id_novedad = $cls_novedades->insertar_novedad_despacho($_POST['fecha_novedad'])){
        $php_estado = true;
    }else{
        $php_msg = "No Guardo Correctamente";
        $php_estado = false;
    }
}else{
    //Si no se digito la fecha saldra este mensaje.
    $php_msg = "Falta datos requeridos para crear la novedad";
}

$datos = array(
    'estado' => $php_estado,
    'msg' => $php_msg,
    'id_novedad' => $id_novedad,
    'post' => $_POST,
);

echo json_encode($datos, JSON_FORCE_OBJECT);
