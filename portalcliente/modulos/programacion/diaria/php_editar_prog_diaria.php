<?php
session_start();
header('Content-Type: application/json');

require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';

$log = false;
$php_estado = false;
$php_error[] = "";
$resultado = "";
//Se crea un objeto de la clase programacion
$ClsProgramacionDiaria = new ClsProgramacionDiaria();
//id del usuario en sesion
$intIdUsuario = $_SESSION['id_usuario'];
//Nombre del usuario en sesion mediante el parametro del id del usuario
$StrNombreUsuario = $ClsProgramacionDiaria->fntGetNombreClienteObj($intIdUsuario);
//Se crea un objeto de la clase Datetime
$dtmFechaActual = new DateTime();
//Se obtiene la fecha actual con el formato completo
$dtmHoy = $dtmFechaActual->format("Y-m-d H:i:s");
$diassemana = array("Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sábado");
$dia = $diassemana[date('w')];
$hora_hoy = $dtmFechaActual->format("H:i:s");
if (isset($_POST['task'])) {
    //validar que la variable task tenga el valor de 1
    if ($_POST['task'] == 1) {
        //id de la programacion
        $intId = $_POST['id'];
        //estado de la programacion
        $intEstado = $ClsProgramacionDiaria->fntGetEstadosProgramacionCliente2Obj($intId);
        //Fecha inicio de la programacion
        $dtmFechaInicio = $_POST['txtInicio'];
        //Fecha final de la programacion
        $dtmFechaFin = $_POST['txtFin'];
        //Validar que modifique correctamente la programacion (Fechas)
        if ($intEstado == 1) {
            if ($ClsProgramacionDiaria->fntEditarProgramacionBool($intId, $dtmFechaInicio, $dtmFechaFin, $dtmHoy, $intIdUsuario, $StrNombreUsuario)) {
                $php_estado = true;
            } else {
                $php_error = 'ERROR';
            }
        } else {
            $php_error = 'La programacion ya fue enviada al area de logistica y no se puede hacer modificaciones';
        }
    } else if ($_POST['task'] == 2) {
        //id de la programacion
        $intId = $_POST['id_prog_evento'];
        //id del pedido
        $intIdPedido = $_POST['cbxPedidoEditar'];
        //id del producto
        $intIdProducto = $_POST['cbxProductoEditar'];
        //nombre del producto mediante el id
        $strNombreProducto = $ClsProgramacionDiaria->fntGetNombreProductoObj($intIdProducto);
        //id de la linea de despacho.
        $intIdLineaDespacho = $_POST['cbxLineaDespachoEditar'];
        //Nombre de la linea de despacho mediante el parametro del id del producto.
        $StrNombreLineaDespacho = $ClsProgramacionDiaria->fntGetNombreLineaDespachoObj($intIdLineaDespacho);
        //hora de cargue
        $dtmHoraCargue = $_POST['txtHoraCargueEditar'];
        //Hora mixer en obra
        $dtmHoraMixerObra = $_POST['txtHoraMixerEditar'];
        //Id de la mixer 
        $intIdMixer = $_POST['cbxMixerEditar'];
        //Placa de la mixer
        $StrPlacaMixer = $ClsProgramacionDiaria->fntGetPlacaMixerObj($intIdMixer);
        //Id del conductor
        $intIdConductor = $_POST['cbxConductorEditar'];
        //Nombre del conductor mediante el parametro del id del conductor
        $StrNombreConductor = $ClsProgramacionDiaria->fntGetNombreClienteObj($intIdConductor);
        //Cantidad
        $decCantidad = $_POST['txtCantEditar'];
        if (isset($_POST['chkRequiereBombaEditar'])) {
            $bolRequiereBomba = true;
        } else {
            $bolRequiereBomba = false;
        }
        //Tipo de descargue
        $intTipoDescargue = $_POST['cbxTipoDescargueEditar'];
        //nombre del tipo de descargue
        $StrNombreTipoDescargue = $ClsProgramacionDiaria->fntGetNombreTipoDescargueObj($intTipoDescargue);
        //Tipo de bomba
        $intTipoBomba = $_POST['cbxTipoBombaEditar'];
        //nombre del tipo de bomba
        $StrNombreTipoBomba = $ClsProgramacionDiaria->fntGetNombreTipoBombaObj($intTipoBomba);
        //Observaciones
        $StrObservaciones = $_POST['txtObservacionesEditar'];
        //Fecha de inicio de la programacion
        $dtmFechaInicio = $_POST['txtInicioEditar'];
        //Fecha final de la programacion
        $dtmFechaFin = $_POST['txtFinEditar'];
        if ($ClsProgramacionDiaria->fntEditarProgramacionTodoBool($intId, $intIdPedido, $intIdProducto, $strNombreProducto, $intIdLineaDespacho, $StrNombreLineaDespacho, $dtmHoraCargue, $dtmHoraMixerObra, $intIdMixer, $StrPlacaMixer, $intIdConductor, $StrNombreConductor, $decCantidad, $bolRequiereBomba, $intTipoDescargue, $StrNombreTipoDescargue, $intTipoBomba, $StrNombreTipoBomba, $StrObservaciones, $dtmFechaInicio, $dtmFechaFin, $dtmHoy, $intIdUsuario, $StrNombreUsuario)) {
            $php_estado = true;
        } else {
            $php_error = 'ERROR';
        }
        //Validar que la variable exista, si cumple la variable se le asigna true, de lo contrario seria false.
    } else if ($_POST['task'] == 3) {
        //id de la programacion
        $intId = $_POST['id'];
        $intEstado = $ClsProgramacionDiaria->fntGetEstadosProgramacionCliente2Obj($intId);
        //validar que la programacion se elimine correctamente mediante el parametro de el id de la programacion
        if ($intEstado == 1) {
            if ($ClsProgramacionDiaria->fntEliminarProgramacionDiariaObj($intId)) {
                $php_estado = true;
            } else {
                $php_error = 'ERROR';
            }
        } else {
            $php_error = 'La programacion ya fue enviada al area de logistica y no se puede eliminar';
        }
    }
}
$datos = array(
    'POST' => $_POST,
    'estado' => $php_estado,
    'errores' => $php_error,
    'result' => $resultado,
    'task' => $_POST['task']
);

echo json_encode($datos, JSON_FORCE_OBJECT);
