<?php

session_start();
header('Content-Type: application/json');

require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';

$php_clases = new php_clases();
$pedidos = new pedidos();

$log = false;
$php_estado = false;
$php_error[] = "";
$resultado = "";

if (isset($_POST['minimo']) && !empty($_POST['minimo']) && isset($_POST['maximo']) && !empty($_POST['maximo'])) {
    $id_pedido = $_POST['id'];
    $id_tipo_bomba = $_POST['id_tipo_bomba'];
    $nombre_tipo_bomba = $pedidos->get_nombre_bomba($id_tipo_bomba);
    $minimo_m3 = $_POST['minimo'];
    $maximo_m3 = $_POST['maximo'];
    $precio = str_replace(".", "", htmlspecialchars($_POST['precio']));
    $observaciones = $_POST['observaciones'];

    if (is_array($datos_m = $pedidos->bomba_precio($id_pedido, $id_tipo_bomba))) {
        $arraym_post =  $pedidos->array_list_min_max($minimo_m3, $maximo_m3);
        foreach ($datos_m as $fila) {
            $arraym_busq =  $pedidos->array_list_min_max(intval($fila['min_m3']), intval($fila['max_m3']));
            foreach ($arraym_busq as $row) {
                if (in_array($row, $arraym_post, false)) {
                    $resultado_f[] = false;
                } else {
                    $resultado_f[] = true;
                }
            }
        }

        if (in_array(false, $resultado_f, false)) {
            $php_error = "Esta bomba ya existe";
        } else if (in_array(true, $resultado_f, true)) {
            $php_estado = true;
            $pedidos->crear_precio_bomba($id_pedido, $id_tipo_bomba, $nombre_tipo_bomba, $minimo_m3, $maximo_m3, $precio, $observaciones);
        } else {
            $php_error = "ERROR";
        }
    } else {
        $php_estado = true;
        $pedidos->crear_precio_bomba($id_pedido, $id_tipo_bomba, $nombre_tipo_bomba, $minimo_m3, $maximo_m3, $precio, $observaciones);
    }
    // $pedidos->crear_precio_bomba($id_pedido, $id_tipo_bomba, $nombre_tipo_bomba, $minimo, $maximo, $precio, $observaciones)
} else {
    $php_error = "falta campos por completar";
}



$datos = array(
    'estado' => $php_estado,
    'errores' => $php_error,
);

echo json_encode($datos, JSON_FORCE_OBJECT);
