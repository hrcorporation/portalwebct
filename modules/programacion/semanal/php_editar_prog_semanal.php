<?php
session_start();
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

$log = false;
$php_estado = false;
$php_error[] = "";
$resultado = "";
//Se crea un objeto de la clase eventos
$eventos = new eventos();
//Se crea un objeto de la clase programacion
$programacion = new programacion();
//Se crea un objeto de la clase php_clases
$php_clases = new php_clases();
//id del usuario en sesion
$id_usuario = $_SESSION['id_usuario'];
//Nombre del usuario en sesion mediante el parametro del id del usuario
$nombre_usuario = $programacion->get_nombre_cliente($id_usuario);
//id del rol del usuario en sesion
$id_rol = $_SESSION['rol_funcionario'];
//Se crea un objeto de la clase Datetime
$fecha_actual = new DateTime();
//Se obtiene la fecha actual con el formato completo
$hoy = $fecha_actual->format("Y-m-d H:i:s");
//Se valida que la variable task exista
if (isset($_POST['task'])) {
    //validar que la variable task tenga el valor de 1
    if ($_POST['task'] == 1) {
        //Validacion de roles 
        if ($id_rol == 1 || $id_rol == 15 || $id_rol == 16) {
            //id de la programacion
            $id = $_POST['id'];
            //Fecha inicio de la programacion
            $inicio = $_POST['start'];
            //Fecha final de la programacion
            $fin = $_POST['end'];
            //Validar que modifique correctamente la programacion (fechas)
            if ($programacion->editar_programacion($id, $inicio, $fin, $hoy, $id_usuario, $nombre_usuario)) {
                $php_estado = true;
            }
        }
        //Validar que la variable task tenga el valor de 2
    } elseif ($_POST['task'] == 2) {
        //Validacion de roles 
        if ($id_rol == 1 || $id_rol == 15 || $id_rol == 16) {
            //id de la programacion
            $id = $_POST['id_prog_evento'];
            //Estado de la programacion(1. Aprobado, 2.Pendiente, 3.Cancelado)
            $estado = $_POST['edit_status'];
            //id del cliente
            $id_cliente = $_POST['edit_txt_cliente'];
            //Nombre del cliente mediante el id del cliente
            $nombre_cliente = $programacion->get_nombre_cliente($id_cliente);
            //id de la obra
            $id_obra = $_POST['edit_txt_obra'];
            //Nombre de la obra mediante el id de la obra
            $nombre_obra = $programacion->get_nombre_obra($id_obra);
            //Cantidad/volumen
            $cantidad = $_POST['edit_txt_cant'];
            //id del producto
            $id_producto = $_POST['edit_txt_producto'];
            //Nombre del producto mediante el id del producto
            $nombre_producto = $programacion->get_nombre_producto($id_producto);
            //Fecha inicial de la programacion
            $inicio = $_POST['edit_start'];
            //Fecha final de la programacion
            $fin = $_POST['edit_end'];
            //Validar que se modifique correctamente la programacion
            if ($programacion->editar_toda_prog_semanal($id, $estado, $id_cliente, $nombre_cliente, $id_obra, $nombre_obra, $id_producto, $nombre_producto, $cantidad, $inicio, $fin, $id_usuario, $nombre_usuario, $hoy)) {
                $php_estado = true;
            }
        }
        //Validar que la variable task tenga el valor de 3
    } elseif ($_POST['task'] == 3) {
        //Validacion de roles 
        if ($id_rol == 1 || $id_rol == 15 || $id_rol == 16) {
            //id de la programacion
            $id = $_POST['id'];
            //validar que la programacion se elimine correctamente mediante el parametro de el id de la programacion
            if ($programacion->eliminar_programacion($id)) {
                $php_estado = true;
            }
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
