<?php
header('Content-Type: application/json');
require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';
//se crea un objeto de la clase programacion
$ClsProgramacionSemanal = new ClsProgramacionDiaria();
//Validar que el id de la programacion exista
if (isset($_POST['id'])) {
    //listar los datos de la programacion mediante el parametro de el id de la programacion 
    if (is_array($data = $ClsProgramacionSemanal->fntCargarDataProgramacionDiariaObj($_POST['id']))) {
        //Recorremos los datos mediante un foreach usando la variable key para cada dato
        foreach ($data as $key) {
            //mostrar el select listando los clientes y seleccionando el cliente que esta guardado en la programacion
            $objSelectCliente  = $key['nombre_cliente'];
            //mostrar el select listando las obras y seleccionando la obra que esta guardado en la programacion
            $objSelectObra  = $key['nombre_obra'];
            //mostrar el select listando los productos y seleccionando el producto que esta guardado en la programacion
            $objSelectProducto  = $ClsProgramacionSemanal->fntOptionProductoEditObj($key['producto']);
            //mostrar el select de los pedidos
            $objSelectPedidos = $ClsProgramacionSemanal->fntOptionListaPedidosObj($key['id_pedido']);
            //mostrar el select del lineas de despacho
            $objSelectLineasDespacho = $ClsProgramacionSemanal->fntOptionLineaDespachoObj($key['id_linea_produccion']);
            //mostrar el select de las mixer en obra
            $objSelectMixer = $ClsProgramacionSemanal->fntOptionVehiculoObj($key['id_mixer']);
            //mostrar el select de los conductores
            $objSelectConductores = $ClsProgramacionSemanal->fntOptionConductorObj($key['id_conductor']);
            //mostrar el select del tipo de descargue
            $objSelectTipoDescargue = $ClsProgramacionSemanal->fntOptionTipoDescargueDosObj($key['id_tipo_descargue']);
            //mostrar el select del tipo de bomba
            $objSelectTipoBomba = $ClsProgramacionSemanal->fntOptionTipoBombaObj($key['id_tipo_bomba']);
            //Hora cargue
            $dtmHoraCargue = $key['hora_cargue'];
            //Hora mixer obra
            $dtmHoraMixerObra = $key['hora_mixer_obra'];
            //Cantidad / Volumen
            $intCantidad = $key['cantidad'];
            //Observaciones
            $StrObservaciones = $key['observaciones'];
            //Fecha inicial de la programacion
            $dtmInicio = $key['inicio'];
            //Fecha final de la programacion
            $dtmFin = $key['fin'];
            //el color del recuadro de la programacion
            $StrColor = $key['color'];
            //el color del texto del recuadro de la programacion
            $StrTextColor = $key['textcolor'];
            //Requiere bomba de concretolima (1. true, 0 false)
            $boolRequiereBomba = $key['requiere_bomba'];
            if ($boolRequiereBomba) {
                $objCheckBomba = "<input class='form-check-input' type='checkbox' value='' id='requiere_bomba' name='requiere_bomba' checked>
                <label class='form-check-label' for='flexCheckDefault'>
                    Requiere bomba de Concre Tolima
                </label>";
            } else {
                $objCheckBomba = "<input class='form-check-input' type='checkbox' value='' id='requiere_bomba' name='requiere_bomba'> 
                <label class='form-check-label' for='flexCheckDefault'>
                    Requiere bomba de Concre Tolima
                </label>";
            }
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
    'select_cliente' => $objSelectCliente,
    'select_obra' => $objSelectObra,
    'select_producto' => $objSelectProducto,
    'select_pedidos' => $objSelectPedidos,
    'select_linea_produccion' => $objSelectLineasDespacho,
    'select_mixer' => $objSelectMixer,
    'select_conductor' => $objSelectConductores,
    'select_tipo_descargue' => $objSelectTipoDescargue,
    'select_tipo_bomba' => $objSelectTipoBomba,
    'hora_cargue' => $dtmHoraCargue,
    'hora_mixer_obra' => $dtmHoraMixerObra,
    'cantidad' => $intCantidad,
    'inicio' => $dtmInicio,
    'fin' => $dtmFin,
    'observaciones' => $StrObservaciones,
    'check_bomba' => $objCheckBomba,
    'color' => $StrColor,
    'textcolor' => $StrTextColor
);
echo json_encode($datos, JSON_FORCE_OBJECT);
