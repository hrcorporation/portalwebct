<?php
header('Content-Type: application/json');
require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

//se crea un objeto de la clase programacion
$cls_visitas_comerciales = new cls_visitas_comerciales();
$t1_terceros = new t1_terceros();
$visita_clientes = new visitas_clientes();
$t5_obras = new t5_obras();
$oportunidad_negocio = new oportunidad_negocio();
//Validar que el id de la programacion exista
if (isset($_POST['id'])) {
    //listar los datos de la programacion mediante el parametro de el id de la programacion 
    if (is_array($data = $cls_visitas_comerciales->get_visitas_comerciales_id($_POST['id']))) {
        //Recorremos los datos mediante un foreach usando la variable key para cada dato
        foreach ($data as $key) {
            $id = $key['id'];
            $titulo = '';
            if(is_null($key['id_comercial'])){
                
                $id_asesora = $cls_visitas_comerciales->get_comercial_tercero($key['id_cliente']);
                
            }else{
                $id_asesora = $key['id_comercial'];
            }

            
            $select_comercial = $oportunidad_negocio->select_comercial($id_asesora);
            $objetivo_visita = $visita_clientes->select_tipo_visita($key['id_tipo_visita']);
            $select_cliente = $t1_terceros->option_cliente_edit($key['id_cliente']);
            $select_obra =  $t5_obras->option_obra($key['id_cliente'], $key['id_obra'] );
            $observaciones = $key['observaciones'];
            $inicio = $key['start'];
            $fin = $key['end'];
        }
    } else {
        $data = false;
    }
} else {
    $data = false;
}

$datos = array(
    'post' => $_POST,
    'datos_consulta' => $data,
    'id'=>$id,
    'titulo' => $titulo,
    'objetivo' =>$objetivo_visita,
    'select_cliente' =>$select_cliente,
    'select_obra' =>$select_obra,
    'observaciones' =>$observaciones,
    'select_comercial' => $select_comercial,
    'id_asesora' => $id_asesora,
    'inicio' => $inicio,
    'fin' => $fin,
    
);

echo json_encode($datos, JSON_FORCE_OBJECT);
