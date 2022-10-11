<?php

//importar
require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';
//Definiendo clases
$php_clases = new php_clases();
$t26_remisiones = new t26_remisiones();

//definiendo Variables
$php_estado = false;
$errores = array();
$exitoso = array();
$dt = array();

//Validar que los campos esten con datos.
if (isset($_POST['txt_fechaini']) && !empty($_POST['txt_fechaini']) && isset($_POST['txt_fechafin']) && !empty($_POST['txt_fechafin']) && isset($_POST['txt_linea']) && !empty($_POST['txt_linea'])) {
    //Fecha inicial para generar el archivo plano.
    $fecha_ini = htmlspecialchars($_POST['txt_fechaini']);
    //Fecha final para generar el archivo plano.
    $fecha_fin = htmlspecialchars($_POST['txt_fechafin']);
    //Linea de despacho para generar el archivo plano.
    $linea_despacho = htmlspecialchars($_POST['txt_linea']);
    //Formato de la fecha dia-mes-año
    $formato_entrada = "d-m-Y";
    //Formato de la fecha año-mes-dia.
    $formato_salida = "Y-m-d";
    //aplicacion de los formatos de fecha a la fecha inicial.
    $fecha_ini =  $php_clases->formatofehaF($fecha_ini, $formato_entrada, $formato_salida);
     //aplicacion de los formatos de fecha a la fecha final.
    $fecha_fin =  $php_clases->formatofehaF($fecha_fin, $formato_entrada, $formato_salida);
    
    //include 'datos_remi.php';
    //header("Location: archivo.php?fechaini=$fecha_ini&fecha_fin=$fecha_fin&linea_despacho=$linea_despacho");
    if($linea_despacho != "todo"){
        $datos_array = $t26_remisiones->planotxt_remi($fecha_ini, $fecha_fin, $linea_despacho);
    }else{
        $datos_array = $t26_remisiones->planotxt_remi2($fecha_ini, $fecha_fin);
    }

    if (file_exists("archivo.txt")) {
        unlink("archivo.txt");
    }
    if (isset($datos_array)) {
        $fichero = fopen('archivo.txt', 'c+');
        // Ciclo de escritura 
        foreach ($datos_array as $datos) {
            $num_remi = $datos['ct29_Remision'];
            $cant_caracteres_remi = strlen($datos['ct29_Remision']);
            if($cant_caracteres_remi == 4){
                $num_remi = " ".$datos['ct29_Remision'];
            }else{
                $num_remi = $datos['ct29_Remision'];
            }
            ////////////////////////////////////////////////////////
            $fecha_remision_remi = $datos['ct29_Fecha'];
            $fecha  = date('Y-m-d', strtotime($fecha_remision_remi));
            $dia = date('d', strtotime($fecha));
            $mes = date('m', strtotime($fecha));
            $year = date('Y', strtotime($fecha));
            ////////////////////////////////////////////////////////
            $nit_cliente = $datos['ct29_NIT'];
            $nit_cliente = $php_clases->quitar_dv($nit_cliente);
            $cant_caracteres_nit = strlen($datos['ct29_NIT']);
            if($cant_caracteres_nit ==10){
                $nit_cliente = $datos['ct29_NIT'];
            }else if($cant_caracteres_nit ==9){
                $nit_cliente = " ".$datos['ct29_NIT'];
            }else if($cant_caracteres_nit ==8){
                $nit_cliente = " "." ".$datos['ct29_NIT'];
            }else if($cant_caracteres_nit ==7){
                $nit_cliente = " "." "." ".$datos['ct29_NIT'];
            }else if($cant_caracteres_nit ==6){
                $nit_cliente = " "." "." "." ".$datos['ct29_NIT'];
            }
            ////////////////////////////////////////////////////////
            $nombre_cliente_remi = $datos['ct29_IdCliente'];
            $nombre_obra =  $datos['ct29_IdObra'];
            $hora = $datos['ct29_Hora'];
            $placa = $datos['ct29_IdMixer'];
            $conductor = $datos['ct29_MixerDriver'];
            $sello = $datos['ct29_NumeroSello'];
            $metros = number_format($datos['ct29_MetrosCubicos'], 2);
            $idplanta = $datos['ct29_IdPlanta'];
            $descripcion_formula = $datos['ct29_NombreFormula'];
            $asentamiento = $datos['ct29_Asentamiento'];
            $producto = $datos['ct29_NombreFormula '];
            $codigo_producto = $datos['ct29_NombreFormula'];
            $prueba = "";

            $datos = '"' .$idplanta.'","     '.$num_remi.'","   900180449","'.$year.'","'.$mes . '","'.$dia.'","F","    ","'.$year.'","'.$mes.'","   '.$dia.'","                                                                                ","   ' .$nit_cliente.'","             ","          ' .$codigo_producto.'","          ' . $metros . '","        0.00","        0.00","       19.00","        '.$prueba.'","006"';
            fwrite($fichero, $datos . PHP_EOL);
        }
        fclose($fichero);
    }
    $fileName = basename('archivo.txt');
    if (file_exists("archivo.txt")) {
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename = $fileName");
        header("Content-Type: text/plain");
        header("Content-Transfer-Encoding: binary");
        readfile($fileName);
    } else {
        echo "no existe";
    }
    $php_estado = true;
    $dt[] = "Vamos bien =" . $fecha_ini . " - " . $fecha_fin;
} else {
    $errores[] = "Faltan completar los campos requeridos";
}

