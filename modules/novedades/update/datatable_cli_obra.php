<?php

session_start();
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

//$oportunidad_negocio = new oportunidad_negocio();

if(isset($_POST['fecha_novedad']) && !empty($_POST['fecha_novedad'])){
    //$data = $oportunidad_negocio->dt_oportunidad_negocio();

}



//print json_encode($datos, JSON_FORCE_OBJECT);
print json_encode($data, JSON_UNESCAPED_UNICODE);