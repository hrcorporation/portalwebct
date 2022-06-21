<?php
header('Content-Type: application/json');
require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

//se crea un objeto de la clase programacion
$programacion = new ClsProgramacionSemanal();
//Validar que el id de la programacion exista
if (isset($_POST['id'])) {
    //listar los datos de la programacion mediante el parametro de el id de la programacion 
    if (is_array($data = $programacion->fntCargarDataProgramacionObj($_POST['id']))) {
        //Recorremos los datos mediante un foreach usando la variable key para cada dato
        foreach ($data as $key) {
            //mostrar el select listando los clientes y seleccionando el cliente que esta guardado en la programacion
            $objSelectCliente  = $programacion->fntOptionClienteEditObj($key['cliente']);
            //mostrar el select listando las obras y seleccionando la obra que esta guardado en la programacion
            $objSelectObra  = $programacion->fntOptionObraEditObj($key['cliente'], $key['obra']);
            //mostrar el select listando los productos y seleccionando el producto que esta guardado en la programacion
            $objSelectProducto  = $programacion->fntOptionProductoEditObj($key['producto']);
            //Cantidad / Volumen
            $intCantidad = $key['cantidad'];
            //Fecha inicial de la programacion
            $dtmInicio = $key['inicio'];
            //Fecha final de la programacion
            $dtmFin = $key['fin'];
            //Frecuencia
            $dtmFrecuencia = $key['frecuencia'];
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
                $objCheckBomba = "<input class='form-check-input' type='checkbox' value='' id='requiere_bomba' name='requiere_bomba' checked>
                <label class='form-check-label' for='flexCheckDefault'>
                    Requiere bomba de concretolima
                </label>";
            }else{
                $objCheckBomba = "<input class='form-check-input' type='checkbox' value='' id='requiere_bomba' name='requiere_bomba'> 
                <label class='form-check-label' for='flexCheckDefault'>
                    Requiere bomba de concretolima
                </label>";
            }
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
    'cantidad' => $intCantidad,
    'inicio' => $dtmInicio,
    'frecuencia' => $dtmFrecuencia,
    'fin' => $dtmFin,
    'observaciones' => $StrObservaciones,
    'metros' => $dblMetros,
    'elementos' => $StrElementos,
    'check_bomba' => $objCheckBomba,
    'color' => $StrColor,
    'textcolor' => $StrTextColor
);

echo json_encode($datos, JSON_FORCE_OBJECT);
