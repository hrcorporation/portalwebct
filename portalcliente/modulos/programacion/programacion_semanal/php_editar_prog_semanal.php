<?php
session_start();
header('Content-Type: application/json');

require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';
//Inicializar algunas variables para su uso
$log = false;
$php_estado = false;
$php_error[] = "";
$resultado = "";
//Se crea un objeto de la clase Eventos
$eventos = new eventos();
//Se crea un objeto de la clase Programacion
$programacion = new programacion();
//Se crea un objeto de la clase Php_Clases
$php_clases = new php_clases();
//id del usuario que esta en sesion
$id_usuario = $_SESSION['id_usuario'];
//id del rol que esta en sesion
$id_rol = $_SESSION['rol'];
//nombre del usuario que esta en sesion mediante su id
$nombre_usuario = $programacion->get_nombre_cliente($id_usuario);
date_default_timezone_set('America/Bogota');
setlocale(LC_ALL, 'es_ES');
setlocale(LC_TIME, 'es_ES');
$fecha_actual = new DateTime();
$hoy = $fecha_actual->format("Y-m-d H:i:s");

if (isset($_POST['task'])) {
    if ($_POST['task'] == 1) {
        $id_usuario_creacion = $programacion->get_id_usuario($_POST['id']);
        //Validar que la persona que esta en sesion sea la que creo la programacion
        if ($id_usuario == $id_usuario_creacion) {
            //id de la programacion
            $id = $_POST['id'];
            //fecha inicial de la programacion
            $inicio = $_POST['start'];
            //fecha final de la programacion
            $fin = $_POST['end'];
            //Validar que se hagan las modificaciones correctamente
            if ($programacion->editar_programacion_v2($id, $inicio, $fin, $hoy, $id_usuario, $nombre_usuario)) {
                $php_estado = true;
            }
        } else {
            $php_error = "ERROR";
        }
    } elseif ($_POST['task'] == 2) {
        $id_usuario_creacion = $programacion->get_id_usuario($_POST['id_prog_evento']);
         //Validar que la persona que esta en sesion sea la que creo la programacion
        if ($id_usuario == $id_usuario_creacion) {
            //id de la programacion
            $id = $_POST['id_prog_evento'];
            //Estado de la programacion
            $estado = $_POST['txt_edit_estado'];
            //id del cliente
            $id_cliente = $_POST['edit_txt_cliente'];
            //nombre del cliente mediante el id
            $nombre_cliente = $programacion->get_nombre_cliente($id_cliente);
            //id de la obra
            $id_obra = $_POST['edit_txt_obra'];
            //nombre de la obra mediante el id
            $nombre_obra = $programacion->get_nombre_obra($id_obra);
            //id del pedido
            $id_pedido = $_POST['txt_edit_pedidos'];
            //id del producto
            $id_producto = $_POST['edit_txt_producto'];
            //nombre del producto mediante el id
            $nombre_producto = $programacion->get_nombre_producto($id_producto);
            //Volumen
            $cantidad = $_POST['edit_txt_cant'];

            //cantidad caracteres de la variable hora
            $cantidad_numeros = strlen($_POST['txt_edit_hora']);
            //Validacion de caracteres de la variable hora, si tiene un caracter y que la variable exista, si tiene un caracter se le concatena un cero a la variable final de hora.
            if (isset($_POST['txt_edit_hora']) && $cantidad_numeros < 2) {
                $hora = "0" . $_POST['txt_edit_hora'];
            //Validar si la variable hora tiene dos caracteres, si cumple no se le concatena nada solo queda la variable.
            } else if ($cantidad_numeros >= 2) {
                $hora = $_POST['txt_edit_hora'];
            //Si no cumple alguna de las dos simplemente se ponen dos ceros en la variable hora
            } else {
                $hora = "00";
            }
            //minutos de la frecuencia
            $minutos = $_POST['txt_edit_min'];
            //la frecuencia es el resultado de la concatenacion de la hora y los minutos
            $frecuencia = $hora . ":" . $minutos;
            //Validar que existe la variable requiere bomba, si cumple la variable tomara un valor de verdadero (true), de lo contrario seria falso (false).
            if (isset($_POST['requiere_bomba'])) {
                $requiere_bomba = true;
            } else {
                $requiere_bomba = false;
            }
            //id del tipo de descargue
            $tipo_descargue = $_POST['txt_edit_tipo_descargue'];
            //nombre del tipo de descargue mediante el id
            $nombre_tipo_descargue = $programacion->get_nombre_tipo_descargue($tipo_descargue);
            //fecha inicial de la programacion
            $inicio = $_POST['edit_start'];
            //Fecha final de la programacion
            $fin = $_POST['edit_end'];
            //elementos
            $elementos = $_POST['txt_edit_elementos'];
            //observaciones
            $observaciones = $_POST['txt_edit_observaciones'];
            //validar que se modifique correctamente la programacion
            if ($programacion->editar_toda_prog_semanal_v2($id, $estado, $id_cliente, $nombre_cliente, $id_obra, $nombre_obra, $id_pedido, $id_producto, $nombre_producto, $cantidad, $frecuencia, $requiere_bomba, $tipo_descargue, $nombre_tipo_descargue, $inicio, $fin, $elementos, $observaciones, $id_usuario, $nombre_usuario, $hoy)) {
                $php_estado = true;
            }
        } else {
            $php_error = "No puede hacer esta accion";
        }
    } elseif ($_POST['task'] == 3) {
        $id_usuario_creacion = $programacion->get_id_usuario($_POST['id']);
        //Validar que la persona que esta en sesion sea la que creo la programacion
        if ($id_usuario == $id_usuario_creacion) {
            //id de la programacion
            $id = $_POST['id'];
            //validar que se elimine correctamente la programacion
            if ($programacion->eliminar_programacion_v2($id)) {
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
