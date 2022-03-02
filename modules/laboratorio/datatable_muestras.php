<?php
// importar Validacion de la sesion
include '../../layout/validar_session2.php';

// Define el tipo de archivo {json}
header('Content-Type: application/json');

// importacion de clases
$php_clases = new php_clases();
$cls_muestras = new labmuestras();



// estadp
if(!empty($_POST['status']) && isset($_POST['status'])){
    $status = $_POST['status'];
}else{
    $status = '';
}


// Codigo Remision
if(!empty($_POST['id_obra']) && isset($_POST['id_obra'])){
    $id_obra = $_POST['id_obra'];
}else{
    $id_obra = '';
}


// Codigo Remision
if(!empty($_POST['id_cliente']) && isset($_POST['id_cliente'])){
    $id_cliente = $_POST['id_cliente'];
}else{
    $id_cliente = '';
}


// Codigo Remision
if(!empty($_POST['id_producto']) && isset($_POST['id_producto'])){
    $id_producto = $_POST['id_producto'];
}else{
    $id_producto = '';
}

// Codigo Remision
if(!empty($_POST['cod_muestra']) && isset($_POST['cod_muestra'])){
    $cod_muestra = $_POST['cod_muestra'];
}else{
    $cod_muestra = '';
}


// Codigo Remision
if(!empty($_POST['cod_remi']) && isset($_POST['cod_remi'])){
    $cod_remi = $_POST['cod_remi'];
}else{
    $cod_remi = '';
}
// Fecha
if(!empty($_POST['fecha']) && isset($_POST['fecha'])){
    $fecha = $_POST['fecha'];
}else{
    $fecha = '';
}
$data = $cls_muestras->datatable_muestras_buscador($fecha,$cod_remi,$cod_muestra,$id_producto,$id_cliente,$id_obra, $status);





// imprime los datos de la tabla convirtiendolos en archivo json.
print json_encode($data, JSON_UNESCAPED_UNICODE);
