<?php
session_start();
header('Content-Type: application/json');

require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';
// Inicializacion de algunas variables que se requieren
$log = false;
$php_estado = false;
$php_error[] = "";
$resultado = "";
//Se crea un objeto de la clase Programacion
$clsProgramacionSemanal = new clsProgramacionSemanal();
//Id del usuario que esta en sesion
$id_usuario = $_SESSION['id_usuario'];
//Id del cliente
$id_cliente = 2;
//Id de la obra
$id_obra = 59;
//Si la consulta sale exitosa se guarda todas las programaciones en la variable data.
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
