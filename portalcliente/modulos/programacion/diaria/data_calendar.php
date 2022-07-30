<?php
session_start();
header('Content-Type: application/json');

require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';
// Inicializacion de algunas variables que se requieren.
$log = false;
$php_estado = false;
$php_error[] = "";
$resultado = "";
//Se crea un objeto de la clase Programacion.
$clsProgramacionDiaria = new clsProgramacionDiaria();
//id del usuario que esta en sesion.
$id_usuario = $_SESSION['id_usuario'];
//Validar que la consulta salga exitosamente.
if ($data = $clsProgramacionDiaria->fntGetProgDiariaClienteObj($id_usuario)) {
    $php_estado = true;
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $php_error,
    'result' => $resultado,
);

//print json_encode($datos, JSON_FORCE_OBJECT);
print json_encode($data, JSON_UNESCAPED_UNICODE);
