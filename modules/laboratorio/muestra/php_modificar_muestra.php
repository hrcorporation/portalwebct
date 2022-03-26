<?php

session_start();
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

$modelo_remisiones = new modelo_remisiones();
$modelo_laboratorio = new modelo_laboratorio();
$t4_productos = new t4_productos();

$php_estado = false;
$php_error[] = '';
$msg[] = '';
$id_muestra = false;
$asentamiento = null;
$temperatura = null;

if (isset($_POST['id_muestra']) && !empty($_POST['id_muestra'])) {

    $id = intval($_POST['id_muestra']);
    $array_remision = $modelo_remisiones->data_remision_for_id($id);

    if (is_array($array_remision)) {
        foreach ($array_remision as $fila) {
            $hora = $_POST['hora'];
            $tipo_muesta = $_POST['tipo_muestra'];
        } 
        // fin del ciclo 1
    } 
    // funcion guardar Datos
    $id_muestra = $modelo_laboratorio->actualizar_datos_muestra($id, $hora, $tipo_muestra);

    if ($id_muestra) {
        $array_data_muestra = $modelo_laboratorio->select_muestra_for_id($id_muestra);

        foreach ($array_data_muestra as $fila_muestra) {
            $asentamiento = $fila_muestra['asentamieto'];
            $temperatura = $fila_muestra['temperarura'];
        }
        $msg[] = "Guardado Correctamente";
        $php_estado = true;
    } else {
        $msg[] = "Error al Guardar";
    }
    // fin de la funcion de guardar datos
} else {
    $php_error[] = "No es posible guardar, Faltan campos para llenar";
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $php_error,
    'msg' => $msg,
    'id_muestra' => $id_muestra,
    'asentamiento' => $asentamiento,
    'temperatura' => $temperatura,
    'post' => $_POST
);

echo json_encode($datos, JSON_FORCE_OBJECT);
