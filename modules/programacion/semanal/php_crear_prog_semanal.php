<?php

session_start();
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

//Se crea un objeto de la clase eventos
$eventos = new eventos();
//Se crea un objeto de la clase programacion
$programacion = new programacion();
//Se crea un objeto de la clase php_clases
$php_clases = new php_clases();

$log = false;
$php_estado = false;
$php_error[] = "";
$resultado = "";

//Validar que el rol del funcionario sea el el administrador o los dos cargos de programacion(15 y 16)
if ($_SESSION['rol_funcionario'] == 1 || $_SESSION['rol_funcionario'] == 15 || $_SESSION['rol_funcionario'] == 16) {
    //Validar que la variable de txt_cliente exista y no este vacia
    if (isset($_POST['txt_cliente']) && !empty($_POST['txt_cliente'])) {
        //id del usuario
        $id_usuario = $_SESSION['id_usuario'];
        //Nombre del usuario mediante el parametro del id del usuario
        $nombre_usuario = $programacion->get_nombre_cliente($id_usuario);
        //Estado (1. Aprobado, 2. Pendiente, 3. Cancelado)
        $estado = 2;
        //id del cliente
        $id_cliente = $_POST['txt_cliente'];
        //Nombre del cliente mediante el parametro del id del cliente
        $nombre_cliente = $programacion->get_nombre_cliente($id_cliente);
        //id de la obra
        $id_obra = $_POST['txt_obra'];
        //Nombre de la obra mediante el parametro del id de la obra.
        $nombre_obra = $programacion->get_nombre_obra($id_obra);
        //id del pedido
        $id_pedido = 1;
        //id del producto.
        $id_producto = $_POST['txt_producto'];
        //Nombre del producto mediante el parametro del id del producto.
        $nombre_producto = $programacion->get_nombre_producto($id_producto);
        //Cantidad
        $cantidad = $_POST['txt_cant'];
        //Fecha de inicio de la programacion
        $inicio = $_POST['start'];
        //Fecha final de la programacion
        $fin = $_POST['end'];
        //Validar que tome bien los parametros y guarde correctamente la programacion
        if ($programacion->crear_prog_semanal($estado, $id_cliente, $nombre_cliente, $id_obra, $nombre_obra, $id_pedido, $id_producto, $nombre_producto, $cantidad, $inicio, $fin, $id_usuario, $nombre_usuario)) {
            //Si pasa la validacion se retorna verdadero(true)
            $php_estado = true;
        } else {
            //De lo contrario mostrara un mensaje mostrando que no se guardo
            $php_error = 'No Guardo Correctamente';
        }
    } else {
        $php_error = 'Se requieren los datos';
    }
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $php_error,
    'result' => $resultado,
);

echo json_encode($datos, JSON_FORCE_OBJECT);
