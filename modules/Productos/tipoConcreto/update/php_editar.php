<?php

session_start();
header('Content-Type: application/json');

require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php'; 
//Se crea un objeto de la clase t4_productos
$t4_productos = new t4_productos();
//Se crea un objeto de la clase t21_tipoconcreto
$t21_tipoconcreto = new t21_tipoconcreto();
// $t22_resistencia_concre = new t22_resistencia_concre();
// $t23_tamano_agregado_concre = new t23_tamano_agregado();
// $t24_caract_concre = new t24_caract_concre();
// $t25_colorconcreto = new t25_colorconcreto();
//Se crea un objeto de la clase general_modelos
$general_modelos = new general_modelos();

$php_estado = false;
$php_error[] = "";
$resultado = "";

//Se hace un condicional que valida si la variable de los datos de la tabla tipo de concreto existe y tambien valida si ese dato esta vacio.
if (isset($_POST['txt_CodTConcreto']) && !empty($_POST['txt_CodTConcreto']) && isset($_POST['txt_DescripcionTC']) && !empty($_POST['txt_DescripcionTC'])) {
    //Parametro del campo codigo
    $codTC = $_POST['txt_CodTConcreto'];
    //Parametro del campo descripcion
    $descripcionTC = $_POST['txt_DescripcionTC'];
    //Parametro del campo id
    $id = $_POST['txt_id'];
    //Se hace un condicional para validar la funcion de la clase t21_tipoconcreto con los parametros que se llamaron anteriormente
    if ($t21_tipoconcreto->modificar_tipo_concreto($id, $codTC, $descripcionTC)) {
        $php_estado = true;
    } else {
        $log = 'No Guardo Correctamente';
    }
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $php_error,
    'result' => $resultado,
);


echo json_encode($datos, JSON_FORCE_OBJECT);
