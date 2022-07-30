<?php
header('Content-Type: application/json');
require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

//se crea un objeto de la clase programacion
$clsProgramacionSemanal = new clsProgramacionSemanal();
//Validar que el id de la programacion exista
if (isset($_POST['id'])) {
    //listar los datos de la programacion mediante el parametro de el id de la programacion 
    if (is_array($data = $clsProgramacionSemanal->fntCargarDataProgramacionFuncionarioObj($_POST['id']))) {
        //Recorremos los datos mediante un foreach usando la variable key para cada dato
        foreach ($data as $key) {
            //mostrar el select listando los clientes y seleccionando el cliente que esta guardado en la programacion
            $objSelectCliente  = $clsProgramacionSemanal->fntOptionClienteEditFuncionarioObj($key['cliente']);
            //mostrar el select listando las obras y seleccionando la obra que esta guardado en la programacion
            $objSelectObra  = $clsProgramacionSemanal->fntOptionObraEditFuncionarioObj($key['cliente'], $key['obra']);
            //mostrar el select listando los productos y seleccionando el producto que esta guardado en la programacion
            $objSelectProducto  = $clsProgramacionSemanal->fntOptionProductoFuncionarioObj($key['id_pedido'], $key['producto']);
            //mostrar el select de los pedidos
            $objSelectPedidos = $clsProgramacionSemanal->fntOptionListaPedidosObj($key['cliente'], $key['obra'], $key['id_pedido']);
            //mostrar el select del listado de las frecuencias
            $objSelectFrecuencia = $clsProgramacionSemanal->fntOptionFrecuenciaEditObj($key['frecuencia']);
            //Cantidad / Volumen
            $intCantidad = $key['cantidad'];
            //Fecha inicial de la programacion
            $dtmInicio = $key['inicio'];
            //Fecha final de la programacion
            $dtmFin = $key['fin'];
            //Elementos a fundir
            $StrElementos = $key['elementos'];
            //Observaciones
            $StrObservaciones = $key['observaciones'];
            //metros tuberia
            $dblMetros = $key['metros'];
            //el color del recuadro de la programacion
            $StrColor = $key['color'];
            //el color del texto del recuadro de la programacion
            $StrTextColor = $key['textcolor'];
            //Requiere bomba de concretolima (1. true, 0 false)
            $boolRequiereBomba = $key['requiere_bomba'];
            //Validar que si requiere o no la bomba de concretolima
            if ($boolRequiereBomba) {
                //Si el checkbox esta activado se lista dos tipos de descargues
                $objSelectTipoDescargue = $clsProgramacionSemanal->fntOptionTipoDescargueConcretolObj($key['id_tipo_descargue']);
            } else {
                //Si el checkbox esta desactivado se lista los 4 tipos de descargue
                $objSelectTipoDescargue = $clsProgramacionSemanal->fntOptionTipoDescargueObj($key['id_tipo_descargue']);
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
    'select_frecuencia' => $objSelectFrecuencia,
    'select_tipo_descargue' => $objSelectTipoDescargue,
    'requiere_bomba' => $boolRequiereBomba,
    'cantidad' => $intCantidad,
    'inicio' => $dtmInicio,
    'fin' => $dtmFin,
    'observaciones' => $StrObservaciones,
    'metros' => $dblMetros,
    'elementos' => $StrElementos,
    'color' => $StrColor,
    'textcolor' => $StrTextColor
);

echo json_encode($datos, JSON_FORCE_OBJECT);
