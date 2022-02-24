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
$asentamiento = null;
$temperatura = null;



if (isset($_POST['id_remision']) && !empty($_POST['id_remision'])) {

    $id_remision = intval($_POST['id_remision']);
    $array_remision = $modelo_remisiones->data_remision_for_id($id_remision);

    if (is_array($array_remision)) {
        foreach ($array_remision as $fila) {
            $fecha_remision = $fila['fecha_remi'];
            $codigo_remi = $fila['codigo_remi'];
            $id_cliente = $fila['id_cliente'];
            $nombre_cliente = $fila['nombre_cliente'];
            $id_obra = $fila['id_obra'];
            $nombre_obra = $fila['nombre_obra'];
            $id_mixer = $fila['id_mixer'];
            $placa = $fila['placa'];
            $id_producto = $fila['id_producto'];
            $codproducto = $fila['codproducto'];
            $metros = doubleval($fila['metros']);
        } // fin del ciclo
    } else {
        $fecha_remision = null;
        $codigo_remi = null;
        $id_cliente = null;
        $nombre_cliente = null;
        $id_obra = null;
        $nombre_obra = null;
        $id_mixer = null;
        $placa = null;
        $id_producto = null;
        $codproducto = null;
        $metros = null;
    }
    $hora = $_POST['hora'];
    $tipo_muesta = $_POST['tipo_muestra'];

    // funcion guardar Datos 
    $id_muestra = $modelo_laboratorio->crear_muestras($id_remision, $fecha_remision, $codigo_remi, $id_cliente, $id_obra, $id_mixer, $id_producto, $metros, $hora, $tipo_muesta);




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
);


echo json_encode($datos, JSON_FORCE_OBJECT);
