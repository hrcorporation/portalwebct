<?php
session_start();
header('Content-Type: application/json');

require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';
//inicializacion de algunas variables que se requieren
$log = false;
$php_estado = false;
$php_error[] = "";
$resultado = "";
//Se crea un objeto de la clase Programacion
$clsProgramacionSemanal = new clsProgramacionSemanal();
//id del usuario que esta en sesion
$id_usuario = $_SESSION['id_usuario'];
//id del rol que esta en sesion
$id_rol = $_SESSION['rol'];
// $datosClientes = $clsProgramacionSemanal->fntGetClienteObraUsuarioObj($id_usuario);

$id_cliente = 2;
$id_obra = 59;

if ($data = $clsProgramacionSemanal->fntGetProgSemanalClientePorClienteObraObj($id_cliente, $id_obra)) {
    $php_estado = true;
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $php_error,
    'result' => $resultado,
);

//print json_encode($datos, JSON_FORCE_OBJECT);
print json_encode($data, JSON_UNESCAPED_UNICODE);
