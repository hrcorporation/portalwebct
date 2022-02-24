<?php

session_start();
header('Content-Type: application/json');


require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

$firephp = FirePHP::getInstance(true);

//$con = new conexionPDO();
//$php_clases = new php_clases();
//$t26_remisiones = new t26_remisiones();
//$modelo_remisiones = new modelo_remisiones();
$modelo_laboratorio = new modelo_laboratorio();

$php_estado = false;
$errores[] = "";
$resultado = "";
$php_error;


if (isset($_FILES['plano_txt']) && !empty($_FILES['plano_txt']['tmp_name'])) {

    ///////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////

    $plano_txt = htmlspecialchars($_FILES['plano_txt']['name']);
    $ruta = htmlspecialchars($_FILES['plano_txt']['tmp_name']);

    $php_fechatime = date("Y-m-d H:i:s");
    $date = "" . date('Y/m/d h:i:s', time());

    $errores[] = $ruta;

    $php_fileexten = strrchr($plano_txt, ".");
    $php_serial = strtoupper(substr(hash('sha1', $plano_txt . $date), 0, 40)) . $php_fileexten;

    $carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/internal/images/remisiones/';
    $php_tempfoto = ('/internal/images/remisiones/' . $php_serial);

    $array_plano = file($ruta, FILE_IGNORE_NEW_LINES);

    //var_dump($array);
    foreach ($array_plano as $fila) {
        $arrayfilas[] = explode(";", $fila);
    }

    //$firephp->fb($arrayfilas, FirePHP::LOG);

    //  Recorrer El archivo 
    foreach ($arrayfilas as $key) {
        $id_log = $key[0];
        $fecha = $key[4];
        $hora = $key[5];
        $remision = intval($key[2]);
        $resultado1 = doubleval($key[19]);
        $resultado2 = doubleval($key[20]);


        $id_registro = $modelo_laboratorio->guardar_data_archivo_plano($id_log,$fecha,$hora,$remision, $resultado1, $resultado2);
        
                
        $errores[] = 'id log es :'.$id_log."  => EL Resultado de laboratorio : " . " kN: " . $resultado1 . " =  MPa: " . $resultado2  . " ||||  fecha :  " . $fecha . ", hora:" . $hora . " |||| Estan enlazados en la remision " . $remision;



    }
    ///////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////


}else {
    $errores[] = "No se ha seleccionado ningun archivo";
}




$datos = array(
    'estado' => $php_estado,
    'errores' => $errores,
    //'result' => $result2,
);


echo json_encode($datos, JSON_FORCE_OBJECT);
