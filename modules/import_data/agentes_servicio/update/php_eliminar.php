<?php

session_start();
header('Content-Type: application/json');

require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php'; 

//Se crea un objeto de la clase t4_productos
$cls_importdata = new cls_importdata();
// $t21_tipoconcreto = new t21_tipoconcreto();
// $t22_resistencia_concre = new t22_resistencia_concre();
// $t23_tamano_agregado_concre = new t23_tamano_agregado();}
//Se crea un objeto de la clase t24_caract_concre
$t24_caract_concre = new t24_caract_concre();
// $t25_colorconcreto = new t25_colorconcreto();
//Se crea un objeto de la clase general_modelos
$general_modelos = new general_modelos();

$php_estado = false;
$php_error[] = "";
$resultado = "";
//Se hace un condicional que valida si la variable de los datos de la tabla caracteristicas del concreto existe y tambien valida si ese dato esta vacio.
if (isset($_POST['id']) && !empty($_POST['id'])) {
     //Parametro del campo id
    $id = $_POST['id'];
     //Se hace un condicional que valida si la funcion que se esta el parametro adecuado y este parametro se llamo anteriormente
    if ($cls_importdata->eliminar_datos_biometrico($id)) {
        $php_estado = true;
    } else {
        $log = 'No elimino Correctamente';
    }
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $php_error,
    'result' => $resultado,
);

echo json_encode($datos, JSON_FORCE_OBJECT);