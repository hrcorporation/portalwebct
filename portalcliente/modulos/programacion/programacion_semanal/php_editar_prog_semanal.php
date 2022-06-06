<?php
session_start();
header('Content-Type: application/json');

require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';

$log = false;
$php_estado = false;
$php_error[] = "";
$resultado = "";

$eventos = new eventos();
$programacion = new programacion();
$php_clases = new php_clases();

if (isset($_SESSION['id_usuario']) && isset($_SESSION['rol_funcionario'])) {
    $id_usuario = $_SESSION['id_usuario'];
    $id_rol = $_SESSION['rol_funcionario'];
    $nombre_usuario = $programacion->get_nombre_cliente($id_usuario);
} else {
    $id_usuario = $_SESSION['id_usuario'];
    $id_rol = $_SESSION['rol'];
    $nombre_usuario = $programacion->get_nombre_cliente($id_usuario);
}

$fecha_actual = new DateTime();
$hoy = $fecha_actual->format("Y-m-d H:i:s");

if (isset($_POST['task'])) {
    if ($_POST['task'] == 1) {
        $id_usuario_creacion = $programacion->get_id_usuario($_POST['id']);
        if ($id_usuario == $id_usuario_creacion) {
            $id = $_POST['id'];
            $inicio = $_POST['start'];
            $fin = $_POST['end'];
            if ($programacion->editar_programacion($id, $inicio, $fin, $hoy, $id_usuario, $nombre_usuario)) {
                $php_estado = true;
            }
        } else {
            $php_error = "ERROR";
        }
    } elseif ($_POST['task'] == 2) {
        $id_usuario_creacion = $programacion->get_id_usuario($_POST['id_prog_evento']);
        if ($id_usuario == $id_usuario_creacion) {
            $id = $_POST['id_prog_evento'];
            $estado = $_POST['txt_edit_estado'];
            $id_cliente = $_POST['edit_txt_cliente'];
            $nombre_cliente = $programacion->get_nombre_cliente($id_cliente);
            $id_obra = $_POST['edit_txt_obra'];
            $nombre_obra = $programacion->get_nombre_obra($id_obra);
            $id_pedido = $_POST['txt_edit_pedidos'];
            $id_producto = $_POST['edit_txt_producto'];
            $nombre_producto = $programacion->get_nombre_producto($id_producto);
            $cantidad = $_POST['edit_txt_cant'];
            $cantidad_numeros = strlen($_POST['txt_edit_hora']);
            if (isset($_POST['txt_edit_hora']) && $cantidad_numeros < 2) {
                $hora = "0" . $_POST['txt_edit_hora'];
            } else if ($cantidad_numeros >= 2) {
                $hora = $_POST['txt_edit_hora'];
            } else {
                $hora = "00";
            }
            $minutos = $_POST['txt_edit_min'];
            $frecuencia = $hora . ":" . $minutos;
            if (isset($_POST['requiere_bomba'])) {
                $requiere_bomba = true;
            } else {
                $requiere_bomba = false;
            }
            $tipo_descargue = $_POST['txt_edit_tipo_descargue'];
            $nombre_tipo_descargue = $programacion->get_nombre_tipo_descargue($tipo_descargue);
            $inicio = $_POST['edit_start'];
            $fin = $_POST['edit_end'];
            $elementos = $_POST['txt_edit_elementos'];
            $observaciones = $_POST['txt_edit_observaciones'];
            if ($programacion->editar_toda_prog_semanal_v2($id, $estado, $id_cliente, $nombre_cliente, $id_obra, $nombre_obra, $id_pedido, $id_producto, $nombre_producto, $cantidad, $frecuencia, $requiere_bomba, $tipo_descargue, $nombre_tipo_descargue, $inicio, $fin, $elementos, $observaciones, $id_usuario, $nombre_usuario, $hoy)) {
                $php_estado = true;
            }
        } else {
            $php_error = "No puede hacer esta accion";
        }
    } elseif ($_POST['task'] == 3) {
        $id_usuario_creacion = $programacion->get_id_usuario($_POST['id']);
        if ($id_usuario == $id_usuario_creacion) {
            $id = $_POST['id'];
            if ($programacion->eliminar_programacion($id)) {
                $php_estado = true;
            }
        } else {
            $php_error = "No puede modificar esta programacion";
        }
    }
}

$datos = array(
    'POST' => $_POST,
    'estado' => $php_estado,
    'errores' => $php_error,
    'result' => $resultado,
    'task' => $_POST['task']
);

echo json_encode($datos, JSON_FORCE_OBJECT);
