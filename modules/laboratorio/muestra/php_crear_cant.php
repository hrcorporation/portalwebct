<?php

session_start();
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

$modelo_remisiones = new modelo_remisiones();
$modelo_laboratorio = new modelo_laboratorio();
$PDO = new conexionPDO();
$con = $PDO->connect();

$php_estado = false;
$php_error[] = '';
$msg[] = '';
$id_muestra = false;
$asentamiento = null;
$temperatura = null;

$post_msg = $_POST;

if (isset($_POST['id_muestra']) && !empty($_POST['id_muestra'])) {

    $id_muestra = intval($_POST['id_muestra']);
    $fecha = $_POST['fecha'];
    $n_muestra = $_POST['n_muestra'];
    $n_dias = $_POST['n_dias'];
    $codigo_muestra = $_POST['codigo_muestra'];

    $id_cant_dias =  $modelo_laboratorio->insert_cant_dias_muestra($con, $id_muestra, $codigo_muestra, $n_muestra, $n_dias, $fecha);

    if ($id_cant_dias) {
        $msg[] = "Guardado Correctamente";
    } else {
        $msg[] = "Error al Guardar";
    }
    // funcion guardar Datos 
    $php_estado = true;
} else {
    $php_error[] = "No es posible guardar, Faltan campos para llenar";
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $php_error,
    'msg' => $msg,
    'post_msg' => $post_msg,
);

echo json_encode($datos, JSON_FORCE_OBJECT);
