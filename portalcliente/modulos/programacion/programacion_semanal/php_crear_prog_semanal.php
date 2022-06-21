<?php

session_start();
header('Content-Type: application/json');

require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';
//Se crea un objeto de la clase Eventos
$eventos = new eventos();
//Se crea un objeto de la clase Programacion
$programacion = new programacion();
//Se crea un objeto de la clase Php_Clases
$php_clases = new php_clases();
//Inicializar algunas variables para su uso
$log = false;
$php_estado = false;
$php_error[] = "";
$resultado = "";
//id del usuario que esta en sesion
$id_usuario = $_SESSION['id_usuario'];
//id del rol que esta en sesion
$id_rol = $_SESSION['rol'];
//nombre del usuario que esta en sesion mediante su id
$nombre_usuario = $programacion->get_nombre_cliente($id_usuario);
date_default_timezone_set('America/Bogota');
setlocale(LC_ALL, 'es_ES');
setlocale(LC_TIME, 'es_ES');
$hora_actual = new DateTime();
$hora_hoy = $hora_actual->format("H:i:s");
if ($hora_hoy < "16:00:00") {
    if (isset($_POST['txt_cliente']) && !empty($_POST['txt_cliente'])) {
        //Estado de la programacion
        $estado = 2;
        // Id del cliente.
        $id_cliente = $_POST['txt_cliente'];
        //Nombre del cliente mediante su Id.
        $nombre_cliente = $programacion->get_nombre_cliente($id_cliente);
        // Id de la obra.
        $id_obra = $_POST['txt_obra'];
        //Nombre de la obra mediante su Id
        $nombre_obra = $programacion->get_nombre_obra($id_obra);
        // Id del pedido.
        $id_pedido = $_POST['txt_pedidos'];
        // Id del producto.
        $id_producto = $_POST['txt_producto'];
        //Nombre del producto mediante su Id
        $nombre_producto = $programacion->get_nombre_producto($id_producto);
        //Volumen
        $cantidad = $_POST['txt_cant'];
        //Longitud de caracteres del campo hora.
        $cantidad_numeros = strlen($_POST['txt_hora']);
        //Validar la cantidad de caracteres del campo hora, si la variable se esta usando y tiene menos de 2 caracteres se concatena un cero.
        if (isset($_POST['txt_hora']) && $cantidad_numeros < 2) {
            $hora = "0" . $_POST['txt_hora'];
        //Validar la cantidad de caracteres del campo hora, si la variable tiene 2 caracteres se usa la variable normal.
        } else if ($cantidad_numeros >= 2) {
            $hora = $_POST['txt_hora'];
        //Si no cumple las condiciones se guardan dos ceros.
        } else {
            $hora = "00";
        }
        $minutos = $_POST['txt_min'];
        //Este campo es la combinacion entre la hora y los minutos.
        $frecuencia = $hora . ":" . $minutos;
        //Validar que la variable exista, si cumple la variable se le asigna true, de lo contrario seria false.
        if (isset($_POST['requiere_bomba'])) {
            $requiere_bomba = true;
        } else {
            $requiere_bomba = false;
        }
        //Id del tipo de descargue
        $tipo_descargue = $_POST['txt_tipo_descargue'];
        //Nombre del tipo de descargue mediante el id del descargue.
        $nombre_tipo_descargue = $programacion->get_nombre_tipo_descargue($tipo_descargue);
        //Fecha de inicio de programacion.
        $inicio = $_POST['start'];
        //Fecha final de la programacion.
        $fin = $_POST['end'];
        //Elementos.
        $elementos = $_POST['txt_elementos'];
        //Observaciones.
        $observaciones = $_POST['txt_observaciones'];
        //Validacion de que se guarde correctamente la programacion.
        if ($programacion->crear_prog_semanal_v2($estado, $id_cliente, $nombre_cliente, $id_obra, $nombre_obra,  $id_pedido, $id_producto, $nombre_producto, $cantidad, $frecuencia, $requiere_bomba, $tipo_descargue, $nombre_tipo_descargue, $inicio, $fin, $elementos, $observaciones, $id_usuario, $nombre_usuario)) {
            $php_estado = true;
        } else {
            $php_error = 'No Guardo Correctamente';
        }
    } else {
        $php_error = 'Se requieren los datos';
    }
} else {
    $php_error = 'Fuera de la hora establecida';
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $php_error,
    'result' => $resultado,
);

echo json_encode($datos, JSON_FORCE_OBJECT);
