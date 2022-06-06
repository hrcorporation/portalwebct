<?php
header('Content-Type: application/json');
require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';

$eventos = new eventos();
$programacion = new programacion();
if (isset($_POST['id'])) {
    if (is_array($data = $programacion->cargar_data_programacion($_POST['id']))) {
        foreach ($data as $key) {
            $select_cliente  = $programacion->option_cliente_edit($key['cliente']);
            $select_obra  = $programacion->option_obra_edit($key['cliente'], $key['obra']);
            $select_producto  = $programacion->option_producto_edit($key['producto']);
            $tipo_descargue = $programacion->option_tipo_descargue($key['id_tipo_descargue']);
            $pedidos = $programacion->option_lista_pedidos($key['id_pedido']);
            $select_estado = $programacion->option_estado_edit($key['estado']);
            $frecuencia = $key['frecuencia'];
            $hora = substr($frecuencia, 0, 2);
            $minutos = substr($frecuencia, 3, 5);
            $cantidad = $key['cantidad'];
            $inicio = $key['inicio'];
            $fin = $key['fin'];
            $elementos = $key['elementos_fundir'];
            $observaciones = $key['observaciones'];
            $requiere_bomba = $key['requiere_bomba'];
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
            $color = $key['color'];
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
