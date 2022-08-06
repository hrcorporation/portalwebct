<?php
session_start();
header('Content-Type: application/json');
require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';

//Se crea un objeto de la clase programacion semanal.
$clsProgramacionSemanal = new clsProgramacionSemanal();
//Id del usuario en sesion.
$id_usuario = $_SESSION['id_usuario'];
//Validar que el id de la programacion exista.
if (isset($_POST['id'])) {
    //Listar los datos de la programacion mediante el parametro de el id de la programacion 
    if (is_array($data = $clsProgramacionSemanal->fntCargarDataProgramacionClienteObj($_POST['id']))) {
        //Recorremos los datos mediante un foreach usando la variable key para cada dato.
        foreach ($data as $key) {
            $strNombreCliente = $clsProgramacionSemanal->fntGetNombreClienteObj($key['cliente']);
            $strNombreObra = $clsProgramacionSemanal->fntGetNombreObra($key['obra']);
            //mostrar el select listando los clientes y seleccionando el cliente que esta guardado en la programacion
            $objSelectCliente  = "<label class='form-label'>Cliente:</label><input type='hidden' name='txtCliente' id='txtCliente' class='form-control' style='width: 100%;' value='" . $key['cliente'] . "' /><p>" . $strNombreCliente . "</p>";
            //mostrar el select listando las obras y seleccionando la obra que esta guardado en la programacion
            $objSelectObra  = "<label class='form-label'>Obra:</label><input type='hidden' name='txtObra' id='txtObra' class='form-control' style='width: 100%;' value='" . $key['obra'] . "' /><p>" . $strNombreObra . "</p>";
            //mostrar el select de los pedidos
            $objSelectPedidos = $clsProgramacionSemanal->fntOptionListaPedidosClienteObj($key['cliente'], $key['obra'], $key['id_pedido']);
            //mostrar el select listando los productos y seleccionando el producto que esta guardado en la programacion
            $objSelectProducto  = $clsProgramacionSemanal->fntOptionProductoClienteObj($key['id_pedido'], $key['producto']);
            //Cantidad / Volumen
            $intCantidad = $key['cantidad'];
            //Fecha inicial de la programacion
            $dtmInicio = $key['inicio'];
            //Fecha final de la programacion
            $dtmFin = $key['fin'];
            //Frecuencia
            $dtmFrecuencia = $clsProgramacionSemanal->fntOptionFrecuenciaEditObj($key['frecuencia']);
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
            if ($boolRequiereBomba) {
                //mostrar el select del tipo de descargue
                $objSelectTipoDescargue = $clsProgramacionSemanal->fntOptionTipoDescargueConcretolObj($key['id_tipo_descargue']);
            } else {
                //mostrar el select del tipo de descargue
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
    'select_pedido' => $objSelectPedidos,
    'select_tipo_descargue' => $objSelectTipoDescargue,
    'cantidad' => $intCantidad,
    'inicio' => $dtmInicio,
    'frecuencia' => $dtmFrecuencia,
    'fin' => $dtmFin,
    'observaciones' => $StrObservaciones,
    'metros' => $dblMetros,
    'elementos' => $StrElementos,
    'requiere_bomba' => $boolRequiereBomba,
    'color' => $StrColor,
    'textcolor' => $StrTextColor
);

echo json_encode($datos, JSON_FORCE_OBJECT);
