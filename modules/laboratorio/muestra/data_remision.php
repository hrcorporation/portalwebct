<?php

session_start();
header('Content-Type: application/json');


require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

$firephp = FirePHP::getInstance(true);

//$con = new conexionPDO();
//$php_clases = new php_clases();
//$t26_remisiones = new t26_remisiones();
$modelo_remisiones = new modelo_remisiones();


$php_estado = false;
$errores[] = "";
$resultado = "";
$php_error;


if (isset($_POST['cod_remision']) && !empty($_POST['cod_remision'])) {

    $id_remision =  intval($_POST['id_remision']);
    $cod_remision = intval($_POST['cod_remision']);

    $data = $modelo_remisiones->data_remision_id($cod_remision,$id_remision);

    $id_cliente = "";
    $nombre_cliente = "";
    $errores[] = "bien";

} else {
    $errores[] = "No se ha seleccionado ningun archivo";
}




$datos = array(
    'estado' => $php_estado,
    'errores' => $errores,
    
);


echo json_encode($datos, JSON_FORCE_OBJECT);
