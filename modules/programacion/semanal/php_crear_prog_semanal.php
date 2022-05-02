<?php 

header('Content-Type: application/json');

//require '../../../include/conexionPDO.php';
require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

$eventos = new eventos();

if(isset($_POST)){
    $titulo = $_POST['titulo'];
    $inicio = $_POST['start'];
    $fin = $_POST['end'];
    $result = $eventos->crear_eventos($titulo,$inicio,$fin);
}



$datos = array(
    'POST' => $_POST,
);


echo json_encode($datos, JSON_FORCE_OBJECT);
