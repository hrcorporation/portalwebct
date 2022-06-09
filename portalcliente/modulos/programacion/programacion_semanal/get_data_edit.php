<?php
header('Content-Type: application/json');
require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';
//Se crea un objeto de la clase Eventos
$eventos = new eventos();
//Se crea un objeto de la clase Programacion
$programacion = new programacion();
//Validar que el id de la programacio exista
if (isset($_POST['id'])) {
    //Cargar los datos de la programacion mediante su id
    if (is_array($data = $programacion->cargar_data_programacion_v2($_POST['id']))) {
        //Se recorren los datos mediante el ciclo foreach
        foreach ($data as $key) {
            //select de clientes mediante el id
            $select_cliente  = $programacion->option_cliente_edit($key['cliente']);
            //select de obras mediante el id
            $select_obra  = $programacion->option_obra_edit($key['cliente'], $key['obra']);
            //select de productos mediante el id
            $select_producto  = $programacion->option_producto_edit($key['producto']);
            //select de tipo de descargue mediante el id
            $tipo_descargue = $programacion->option_tipo_descargue($key['id_tipo_descargue']);
            //select de pedidos mediante el id
            $pedidos = $programacion->option_lista_pedidos($key['id_pedido']);
            //select de estados mediante el id
            $select_estado = $programacion->option_estado_edit($key['estado']);
            //frecuencia
            $frecuencia = $key['frecuencia'];
            //se sacan los dos primeros caracteres de frecuencia para obtener la hora aparte
            $hora = substr($frecuencia, 0, 2);
            //se sacan los dos ultimos caracteres de frecuencia para obtener los minutos aparte
            $minutos = substr($frecuencia, 3, 5);
            //volumen
            $cantidad = $key['cantidad'];
            //fecha inicio de la programacion
            $inicio = $key['inicio'];
            //fecha final de la programacion
            $fin = $key['fin'];
            //elementos
            $elementos = $key['elementos_fundir'];
            //observaciones
            $observaciones = $key['observaciones'];
            //si requiere o no bomba
            $requiere_bomba = $key['requiere_bomba'];
            //si la variable de requiere bomba existe retorna un checkbox activado, de lo contrario aparecera desactivado.
            if ($requiere_bomba) {
                $check_bomba = "<input class='form-check-input' type='checkbox' value='' id='requiere_bomba' name='requiere_bomba' checked>
                <label class='form-check-label' for='flexCheckDefault'>
                    Requiere bomba de concretolima
                </label>";
            }else{
                $check_bomba = "<input class='form-check-input' type='checkbox' value='' id='requiere_bomba' name='requiere_bomba'> 
                <label class='form-check-label' for='flexCheckDefault'>
                    Requiere bomba de concretolima
                </label>";
            }
            //color del recuadro
            $color = $key['color'];
            //color del texto
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
    'tipo_descargue' => $tipo_descargue,
    'pedidos' => $pedidos,
    'select_estado' => $select_estado,
    'cantidad' => $cantidad,
    'frecuencia' => $frecuencia,
    'hora' => $hora,
    'minutos' => $minutos,
    'inicio' => $inicio,
    'fin' => $fin,
    'elementos' => $elementos,
    'observaciones' => $observaciones,
    'check_bomba' => $check_bomba,
    'color' => $color,
    'textcolor' => $textcolor
);

echo json_encode($datos, JSON_FORCE_OBJECT);
