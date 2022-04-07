<?php

session_start();
header('Content-Type: application/json');

require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';


// Carga de clases
$modelo_remisiones = new modelo_remisiones();
$modelo_laboratorio = new modelo_laboratorio();
$t4_productos = new t4_productos();
$cls_terceros = new t1_terceros();

$php_estado = false;
$php_error[] = '';
$msg[] = '';
$id_muestra = false;
$asentamiento = null;
$temperatura = null;

if (isset($_POST['id_remision']) && !empty($_POST['id_remision'])) {

    // se trae los post  id remision y el id del producto
    $id_remision = intval($_POST['id_remision']);
    $id_producto = intval($_POST['id_producto']);

    // se valida el id de la Muestra con la remision si ya esta creada en la base de datos
    if ($id_muestra = $modelo_laboratorio->buscar_muestras_existentes($id_remision)) { // 
        // Redirecciona directamente al editar

    } else { // No Existe la muestra enlazada con el id de la remision
        // se vailala consulta donde extrae los datos de las remisiones y del producto
        if (is_array($array_remision = $modelo_remisiones->data_remision_for_id($id_remision)) && is_array($array_producto = $modelo_remisiones->data_productos_for_id($id_producto))) {
            foreach ($array_remision as $fila) {
                $fecha_remision = $fila['fecha_remi'];
                $codigo_remi = $fila['codigo_remi'];
                $id_cliente = $fila['id_cliente'];
                $nombre_cliente = $cls_terceros->get_nombre_for_id(intval($fila['id_cliente']));
                $id_obra = $fila['id_obra'];
                $nombre_obra = $fila['nombre_obra'];
                $id_mixer = $fila['id_mixer'];
                $placa = $fila['placa'];
                $metros = doubleval($fila['metros']);
            } // fin del ciclo 1
            foreach ($array_producto as $fila) {
                $id_producto = $fila['id_producto'];
                $codproducto = $fila['codproducto'];
                $producto = $fila['descripcion'];
            } // fin del ciclo 2


        } else {
            // Si la consulta fue fallida Colocamos el valor null de las variables
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
            $producto = null;
            $metros = null;
        }

        $hora = $_POST['hora'];
        $tipo_muesta = $_POST['tipo_muestra'];
        $m3_muestra = null;

        // funcion guardar Datos 
        $id_muestra = $modelo_laboratorio->crear_muestras($id_remision, $fecha_remision, $codigo_remi, $id_cliente, $nombre_cliente, $id_obra, $nombre_obra, $id_mixer, $id_producto, $codproducto, $producto, $metros, $m3_muestra, $hora, $tipo_muesta);
        $php_estado = true;
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

);

echo json_encode($datos, JSON_FORCE_OBJECT);
