<?php

session_start();
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

$modelo_remisiones = new modelo_remisiones();
$modelo_laboratorio = new modelo_laboratorio();

$php_estado = false;
$php_error[] = '';
$msg[] = '';

if (isset($_POST['id_muestra']) && !empty($_POST['id_muestra'])) {

    $id_muestra = intval($_POST['id_muestra']);

    $m3 = $_POST['m3'];
    $cementante = $_POST['cementante'];
    $asentamiento = $_POST['asentamiento'];
    $temperatura = $_POST['temperatura'];
    $aire = $_POST['aire'];
    $rendimiento_volumentrico = $_POST['rend_volumetrico'];

    // funcion guardar Datos 
    $result = $modelo_laboratorio->actualizar_data_muestra($id_muestra, $asentamiento, $temperatura, $m3, $cementante, $aire, $rendimiento_volumentrico);

    if ($result) {
        $msg[] = "Guardado Correctamente";
        $php_estado = true;
    } else {
        $php_error[] = "Error al Guardar ";
    }
    // fin de la funcion de guardar datos
} else {
    $php_error[] = "No es posible guardar, Faltan campos para llenar";
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $php_error,
    'msg' => $msg
);

echo json_encode($datos, JSON_FORCE_OBJECT);
