<?php

session_start();
header('Content-Type: application/json');

require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';

//$con = new conexionPDO();
//$php_clases = new php_clases();
//$t26_remisiones = new t26_remisiones();
$modelo_remisiones = new modelo_remisiones();
$modelo_laboratorio = new modelo_laboratorio();

$php_estado = false;
$php_error[] = '';
$msg[] = '';
$id_muestra = false;
$var = 12;
$result = false;
$post_msg = $_POST;
$codigo_muestra = false;
$result  = false;


if (isset($_POST['id_muestra']) && !empty($_POST['id_muestra']) && isset($_POST['codigo_muestra']) && !empty($_POST['codigo_muestra'])) {

    $id_muestra = intval($_POST['id_muestra']);
    $codigo_muestra = intval($_POST['codigo_muestra']);

    if($result = $modelo_laboratorio->cargar_data_dias($id_muestra,$codigo_muestra))
    {
        $php_estado = true;
    }else{

        $php_estado = false;
    }
/*
ANTES SACAR DEBIDO AL A
* 1 - >select para traer el tipo de concreto dendiendo el id de la muestra = tipo_concreto
    2 -> Select para traer ct61_dias_tipoconcreto para dependiendo el tipo de concreto
    3 -> function para sumar los dias y definir las fechas de fallo
    4 -> insertar registros
* 
*/
    $msg[] = $result;
} else {
    $php_error[] = "No es posible guardar, Faltan campos para llenar";
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $php_error,
    'msg' => $msg,
    'post' => $post_msg,
  
);

echo json_encode($datos, JSON_FORCE_OBJECT);
