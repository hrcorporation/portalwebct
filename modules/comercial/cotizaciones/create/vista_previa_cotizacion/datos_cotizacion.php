<?php

//========================================================================================================
// ENCABEZADO
//========================================================================================================
require '../../../../../librerias/autoload.php';
require '../../../../../modelos/autoload.php';
require '../../../../../vendor/autoload.php';

$php_clases = new php_clases();


$titulo = "";
$metros = 0;


$datos_array = $t26_remision->get_remision($id_remision);

if (isset($datos_array)) {

    foreach ($datos_array as $datos) {
     
        
        //$ = $datos[''];
        //$ = $datos[''];
    }
    
    switch ($idplanta) 
    {
        case "RMI":
            $planta = "PLANTA";
            $linea_planta = "LINEA 1";
            break;
        case "RZO":
            $planta = "PLANTA ";
            $linea_planta = "LINEA 2";
            break;

        case "RMT":
            $planta = "PLANTA DOS";
            $linea_planta = "CIUDAD TORREON";
        break;

        default:
            $planta = "PLANTA";
            $linea_planta = "";
    }
}
