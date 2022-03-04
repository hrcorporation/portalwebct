<?php

session_start();
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

//$con = new conexionPDO();
//$php_clases = new php_clases();
//$t26_remisiones = new t26_remisiones();
$modelo_remisiones = new modelo_remisiones();
$modelo_laboratorio = new modelo_laboratorio();

$php_estado = false;
$php_error[] = '';
$msg[] = '';
$id_muestra = false;
$PDO = new conexionPDO();
$con = $PDO->connect();

$post_msg = $_POST;

if (isset($_POST['id']) && !empty($_POST['id'])) {

    $id = intval($_POST['id']);


    $result = $modelo_laboratorio::eliminar_dias_cant_muestra($con, $id);

    if ($result) {
        $php_estado = true;
    } else {

        $php_estado = false;
    }
    $msg[] = $result;
} else {
    $php_error[] = "No es posible guardar, Faltan campos para llenar";
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $php_error,
    'msg' => $msg,
    'post' => $post_msg,
    'result' => $result,
);

echo json_encode($datos, JSON_FORCE_OBJECT);
