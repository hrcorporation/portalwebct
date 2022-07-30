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
// //id del cliente
$id_cliente = $_POST['id_cliente'];
// //id de la obra
$id_obra = $_POST['id_obra'];
//Validar que la consulta salga exitosamente
if ($data = $clsProgramacionSemanal->fntGetProgSemanalClienteObj($id_usuario)) {
    $php_estado = true;
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $php_error,
    'result' => $resultado,
);

//print json_encode($datos, JSON_FORCE_OBJECT);
print json_encode($data, JSON_UNESCAPED_UNICODE);
