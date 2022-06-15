<?php
header('Content-Type: application/json');
require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

// $eventos = new eventos();
//se crea un objeto de la clase programacion
$programacion = new programacion();
//Validar que el id de la programacion exista
if (isset($_POST['id'])) {
    //listar los datos de la programacion mediante el parametro de el id de la programacion 
    if (is_array($data = $programacion->cargar_data_programacion($_POST['id']))) {
        //Recorremos los datos mediante un foreach usando la variable key para cada dato
        foreach ($data as $key) {
            //mostrar el select listando los clientes y seleccionando el cliente que esta guardado en la programacion
            $select_cliente  = $programacion->option_cliente_edit($key['cliente']);
            //mostrar el select listando las obras y seleccionando la obra que esta guardado en la programacion
            $select_obra  = $programacion->option_obra_edit($key['cliente'], $key['obra']);
            //mostrar el select listando los productos y seleccionando el producto que esta guardado en la programacion
            $select_producto  = $programacion->option_producto_edit($key['producto']);
            //cantidad/volumen
            $cantidad = $key['cantidad'];
            //Fecha inicial de la programacion
            $inicio = $key['inicio'];
            //Fecha final de la programacion
            $fin = $key['fin'];
            //mostrar el select listando los estados de la programacion(1. Aprobado, 2. Pendiente, 3. Cancelado) y seleccionando el estado que esta guardado en la programacion
            $select_estado = $programacion->option_estado_edit($key['estado']);
            //el color del recuadro de la programacion (Verde - Aprobado, Amarillo - Pendiente, Rojo - Cancelado)
            $color = $key['color'];
            //el color del texto del recuadro de la programacion
            $textcolor = $key['textcolor'];
        }
    } else {

    }
} else {
    $data = false;
}

$datos = array(
    'post' => $_POST,
    'datos_consulta' => $data,
    'select_cliente' => $select_cliente,
    'select_obra' => $select_obra,
    'select_producto' => $select_producto,
    'select_estado' => $select_estado,
    'cantidad' => $cantidad,
    'inicio' => $inicio,
    'fin' => $fin,
    'color' => $color,
    'textcolor' => $textcolor
);

echo json_encode($datos, JSON_FORCE_OBJECT);
//print json_encode($datos, JSON_FORCE_OBJECT);
//print json_encode($data, JSON_UNESCAPED_UNICODE);