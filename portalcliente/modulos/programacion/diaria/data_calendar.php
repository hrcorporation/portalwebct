<?php

session_start();
header('Content-Type: application/json');

require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';

//Se crea un objeto de la clase Programacion.
$clsProgramacionDiaria = new clsProgramacionDiaria();
//Id del usuario que esta en sesion.
$id_usuario = $_SESSION['id_usuario'];
$data = $clsProgramacionDiaria->fntGetClienteObraUsuarioObj($id_usuario);

foreach ($data as $fila) {
    $id_clientes[] = $fila['id_cliente'];
    $id_obra[] = $fila['id_obra'];
}

$clientes = implode(",", $id_clientes);
$obras = implode(",", $id_obra);
//Si la consulta sale exitosa se guarda todas las programaciones en la variable data.
$datos = $clsProgramacionDiaria->fntGetProgDiariaClientePorClienteObraObj($clientes, $obras);

//print json_encode($datos, JSON_FORCE_OBJECT);
print json_encode($datos, JSON_UNESCAPED_UNICODE);
