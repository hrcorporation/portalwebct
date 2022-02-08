<?php

session_start();
header('Content-Type: application/json');

//require '../../../include/conexionPDO.php';
require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php'; 
//$con = new conexionPDO();
$php_clases = new php_clases();
$t26_remisiones = new t26_remisiones();


$php_estado = false;
$errores[] = "";
$resultado = "";
$php_error= "";
$result_bm = false;


if (isset($_POST['txt_cliente'])    && !empty($_POST['txt_cliente'])    &&
    isset($_POST['txt_mixer'])    && !empty($_POST['txt_mixer'])    && 
    isset($_POST['C_Obras'])        && !empty($_POST['C_Obras'])        && 
    isset($_POST['C_id_conductor']) && !empty($_POST['C_id_conductor']) && 
    isset($_POST['C_IdProductos'])  && !empty($_POST['C_IdProductos']) ) {

    $id_remision = $php_clases->HR_Crypt($_POST['id'],2);

    $cliente =(int) htmlspecialchars($_POST['txt_cliente']);
    $obra_remi = (int) htmlspecialchars($_POST['C_Obras']);

    $id_mixer = (int)htmlspecialchars($_POST['txt_mixer']);
    $conductor = (int) htmlspecialchars($_POST['C_id_conductor']);

    $id_producto = (int)htmlspecialchars($_POST['C_IdProductos']);
    $observacion_desp = htmlspecialchars($_POST['txt_observaciones']);

    $estado = 3;
    $result = $t26_remisiones->editar_datos_remision1($id_remision, $cliente, $obra_remi, $id_mixer,  $conductor, $id_producto,$estado,$observacion_desp  );
    
 
    if ($result) {

        $bomba = htmlspecialchars($_POST['select_servicio_bomba']);
        $id_op_bomba = (int)htmlspecialchars($_POST['select_op_bomba']);
        if($id_op_bomba<=0){
            $id_op_bomba = null;
        }
        $id_aux_bomba = (int)htmlspecialchars($_POST['select_aux_bomba']);
        if($id_aux_bomba<=0){
            $id_aux_bomba = null;
        }


        $result_bm = $t26_remisiones->actualizar_bombeo($id_remision,$bomba, $id_op_bomba, $id_aux_bomba);
        if($result_bm){
            $php_estado = true;
            $php_error = $result_bm;

        }else{
        $php_estado = false;
        $php_error = "error ". $id_aux_bomba;

        }

        //$php_error = $result;
    } else {
        $php_estado = false;
        $php_error = "error al guardar en la base de datos";
    }

}else{
    $php_error = "Faltan llenar los campos requeridos" ;
 }


$datos = array(
    'estado' => $php_estado,
    'errores' => $php_error,
    'result' => $result_bm,
);


echo json_encode($datos, JSON_FORCE_OBJECT);
