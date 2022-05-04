<?php

session_start();
header('Content-Type: application/json');

require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';

$php_clases = new php_clases();
$pedidos = new pedidos();


$log = false;
$php_estado = false;
$php_error[] = "";
$resultado = "";


if(isset($_POST['minimo']) && !empty($_POST['minimo']) && isset($_POST['maximo']) && !empty($_POST['maximo'])){
$id_pedido = $_POST['id'];
$id_tipo_bomba = $_POST['id_tipo_bomba'];
$nombre_tipo_bomba = $pedidos->get_nombre_bomba($id_tipo_bomba);
$minimo_m3 = $_POST['minimo'];
$maximo_m3 = $_POST['maximo'];
$precio = str_replace(".", "", htmlspecialchars($_POST['precio']));
$observaciones = $_POST['observaciones'];

if(is_array($datos_m = $pedidos->bomba_precio($id_pedido))){
    $array_list = "";
    $array_list = array();
    $diferencia = $maximo_m3 - $minimo_m3;
    $minimo_m3 = $minimo_m3 - 1;
  
    for ($new_min=$minimo_m3; $new_min <= $maximo_m3 ; $new_min++) { 
        array_push($array_list,$new_min);
    }

    foreach($datos_m as $fila)
    {
        $min_busq = $fila['min_m3'];
        $max_busq = $fila['max_m3'];

        for($new2_min = $min_busq; $new2_min <= $max_busq ; $new2_min++  ){
         
            
            
        }



    }
    

    
    $php_error = "Exitoso";

}else{
    $php_error = "Error en la consulta";
}



// $pedidos->crear_precio_bomba($id_pedido, $id_tipo_bomba, $nombre_tipo_bomba, $minimo, $maximo, $precio, $observaciones)


}else{
    $php_error = " falta campos por completar";
}



$datos = array(
    'estado' => $php_estado,
    'errores' => $php_error,
    'result' => $datos_m,

);

echo json_encode($datos, JSON_FORCE_OBJECT);
