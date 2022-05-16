<?php 

header('Content-Type: application/json');

//require '../../../include/conexionPDO.php';
require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

$eventos = new eventos();

if(isset($_POST)){
    if($_POST['task'] == 1){
        $id = $_POST['id'];
        $inicio = $_POST['start'];
        $fin = $_POST['end'];
        $eventos->editar_event($id,$inicio,$fin);
    }elseif($_POST['task'] == 2){
        $id = $_POST['id'];
        $titulo = $_POST['titulo'];
        $inicio = $_POST['start'];
        $fin = $_POST['end'];
        $eventos->editar_todo_event($id,$titulo,$inicio,$fin);
    }elseif($_POST['task'] == 3){
        $id = $_POST['id'];
        $eventos->eliminar_event($id);
    }
    
}



$datos = array(
    'POST' => $_POST,
);


echo json_encode($datos, JSON_FORCE_OBJECT);
