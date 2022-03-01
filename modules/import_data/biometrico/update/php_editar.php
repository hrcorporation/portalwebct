<?php

session_start();
header('Content-Type: application/json');

require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';

//Se crea un objeto de la clase t24_caract_concre
$cls_importdata = new cls_importdata();
//Se crea un objeto de la clase general_modelos
$general_modelos = new general_modelos();

$php_estado = false;
$php_error[] = "";
$resultado = "";
//Se hace un condicional que valida si la variable de los datos de la tabla caracteristicas del concreto existe y tambien valida si ese dato esta vacio.
if (isset($_POST['txt_fecha']) && !empty($_POST['txt_fecha']) && isset($_POST['txt_h_llegada1']) && !empty($_POST['txt_h_llegada1'])) {
    //Parametro del campo codigo caracteristica del concreto
    $fecha = $_POST['txt_fecha'];
    //Parametro del campo descripcion del caracteristica del concreto
    $entrada_1 = $_POST['txt_h_llegada1'];
    //Parametro del campo descripcion del caracteristica del concreto
    $salida_1 = $_POST['txt_h_salida1'];
    //Parametro del campo id
    $id = $_POST['txt_id'];
    //Se hace un condicional que valida si la funcion que se esta con los parametros adecuados y estos parametros se llamaron anteriormente
    if ($cls_importdata->modificar_datos_biometrico($id, $fecha, $entrada_1, $salida_1)) {
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
