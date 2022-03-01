<?php
// importar Validacion de la sesion
include '../../layout/validar_session2.php';

// Define el tipo de archivo {json}
header('Content-Type: application/json');

// importacion de clases
$php_clases = new php_clases();
$cls_muestras = new labmuestras();


// importar los datos de la tabla
$data = $cls_muestras->datatable_muestras();

// imprime los datos de la tabla convirtiendolos en archivo json.
print json_encode($data, JSON_UNESCAPED_UNICODE);