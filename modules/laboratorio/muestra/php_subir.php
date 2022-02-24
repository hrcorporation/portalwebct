<?php

session_start();
header('Content-Type: application/json');


require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

//$con = new conexionPDO();
//$php_clases = new php_clases();
//$t26_remisiones = new t26_remisiones();
//$modelo_remisiones = new modelo_remisiones();


$php_estado = false;
$errores[] = "MAl";
$resultado = "";
$php_error;


if (isset($_FILES['plano_txt']) && !empty($_FILES['plano_txt'])) {
    
    ///////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////

    $plano_txt = htmlspecialchars($_FILES['plano_txt']['name']);
    $ruta = htmlspecialchars($_FILES['plano_txt']['tmp_name']);

    $php_fechatime = date("Y-m-d H:i:s");
    $date = "" . date('Y/m/d h:i:s', time());

    
    
    $php_fileexten = strrchr($plano_txt, ".");
    $php_serial = strtoupper(substr(hash('sha1', $plano_txt . $date), 0, 40)) . $php_fileexten;


    $carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/internal/images/remisiones/';
    $php_tempfoto = ('/internal/images/remisiones/' . $php_serial);

    ///////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////
    

} else {
    $php_error[] = "No se ha habilitado ningun cambio";
}




$datos = array(
    'estado' => $php_estado,
    'errores' => $php_error,
    //'result' => $result2,
);


echo json_encode($datos, JSON_FORCE_OBJECT);
