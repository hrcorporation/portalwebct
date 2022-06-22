<?php
session_start();
header('Content-Type: application/json');
require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';
//Se crea un objeto de la clase Eventos
$eventos = new eventos();
//Se crea un objeto de la clase Programacion
$programacion = new ClsProgramacionSemanal();
//id del usuario en sesion
$id_usuario = $_SESSION['id_usuario'];
//Validar que el id de la programacio exista
if (isset($_POST['id'])) {
    //Cargar los datos de la programacion mediante su id
    if (is_array($data = $programacion->fntCargarDataProgramacionObj($_POST['id']))) {
        //Se recorren los datos mediante el ciclo foreach
        foreach ($data as $key) {
            //  select de clientes mediante el id
            $objSelectCliente  = $programacion->option_cliente_edit_cliente($id_usuario, $key['cliente']);
            //  select de obras mediante el id
            $objSelectObra  = $programacion->fntOptionObraEditObj($key['cliente'], $key['obra']);
            //  select de productos mediante el id
            $objSelectProducto  = $programacion->fntOptionProductoEditObj($key['producto']);
            //  select de tipo de descargue mediante el id
            $objTipoDescargue = $programacion->fntOptionTipoDescargueObj($key['id_tipo_descargue']);
            //  select de pedidos mediante el id
            $objPedidos = $programacion->fntOptionListaPedidosObj($key['id_pedido']);
            //  frecuencia
            $dtmFrecuencia = $key['frecuencia'];
            //  volumen
            $dblCantidad = $key['cantidad'];
            //  fecha inicio de la programacion
            $dtmInicio = $key['inicio'];
            //  fecha final de la programacion
            $dtmFin = $key['fin'];
            //  elementos
            $StrElementos = $key['elementos_fundir'];
            //  observaciones
            $StrObservaciones = $key['observaciones'];
            //  si requiere o no bomba
            $requiere_bomba = $key['requiere_bomba'];
            //  si la variable de requiere bomba existe retorna un checkbox activado, de lo contrario aparecera desactivado.
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
    'select_cliente' => $objSelectCliente,
    'select_obra' => $objSelectObra,
    'select_producto' => $objSelectProducto,
    'tipo_descargue' => $objTipoDescargue,
    'pedidos' => $objPedidos,
    'cantidad' => $dblCantidad,
    'frecuencia' => $dtmFrecuencia,
    'inicio' => $dtmInicio,
    'fin' => $dtmFin,
    'elementos' => $StrElementos,
    'observaciones' => $observaciones,
    'check_bomba' => $check_bomba,
    'color' => $color,
    'textcolor' => $textcolor
);

echo json_encode($datos, JSON_FORCE_OBJECT);
