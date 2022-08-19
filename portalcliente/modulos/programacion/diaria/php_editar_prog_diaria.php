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
$clsProgramacionDiaria = new clsProgramacionDiaria();
//id del usuario en sesion
$intIdUsuario = $_SESSION['id_usuario'];
//Nombre del usuario en sesion mediante el parametro del id del usuario
$StrNombreUsuario = $clsProgramacionDiaria->fntGetNombreClienteObj($intIdUsuario);
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
        $intEstado = $clsProgramacionDiaria->fntGetEstadosProgramacionCliente2Obj($intId);
        //Fecha inicio de la programacion
        $dtmFechaInicio = $_POST['txtInicio'];
        //Fecha final de la programacion
        $dtmFechaFin = $_POST['txtFin'];
        //Validar que modifique correctamente la programacion (Fechas)
        if ($dtmHoy <= $dtmFechaInicio) {
            if ($intEstado == 4) {
                if ($clsProgramacionDiaria->fntEditarProgramacionBool($intId, $dtmFechaInicio, $dtmFechaFin, $dtmHoy, $intIdUsuario, $StrNombreUsuario)) {
                    $php_estado = true;
                } else {
                    $php_error = 'ERROR';
                }
            } else {
                $php_error = 'La programacion ya fue enviada al area de logistica y no se puede hacer modificaciones';
            }
        } else {
            $php_error = "No puede modificar la programacion a una hora anterior a la hora actual";
        }
    } else if ($_POST['task'] == 2) {
        //id de la programacion
        $intId = $_POST['id_prog_evento'];
        //estado de la programacion
        $intEstado = $clsProgramacionDiaria->fntGetEstadosProgramacionCliente2Obj($intId);
        //id del producto
        $intIdProducto = $_POST['cbxProductoEditar'];
        //nombre del producto mediante el id
        $strNombreProducto = $clsProgramacionDiaria->fntGetNombreProductoObj($intIdProducto);
        //Cantidad
        $decCantidad = $_POST['txtCantEditar'];
        //Fecha de inicio de la programacion
        $dtmFechaInicio = $_POST['txtInicioEditar'];
        //Fecha final de la programacion
        $dtmFechaFin = $_POST['txtFinEditar'];
        if ($dtmHoy <= $dtmFechaInicio) {
            if ($intEstado == 3) {
                if ($clsProgramacionDiaria->fntEditarProgramacionTodoClienteBool($intId, $intIdProducto, $strNombreProducto, $decCantidad, $dtmFechaInicio, $dtmFechaFin, $dtmHoy, $intIdUsuario, $StrNombreUsuario)) {
                    $php_estado = true;
                } else {
                    $php_error = 'ERROR';
                }
            } else {
                $php_error = 'La programacion ya fue confirmada por el area de logistica de Concre Tolima';
            }
        } else {
            $php_error = "No puede modificar la programacion a una hora anterior a la hora actual";
        }
        //Validar que la variable exista, si cumple la variable se le asigna true, de lo contrario seria false.
    } else if ($_POST['task'] == 3) {
        //id de la programacion
        $intId = $_POST['id'];
        $intEstado = $clsProgramacionDiaria->fntGetEstadosProgramacionCliente2Obj($intId);
        //validar que la programacion se elimine correctamente mediante el parametro de el id de la programacion
        if ($intEstado == 4) {
            if ($clsProgramacionDiaria->fntEliminarProgramacionDiariaObj($intId)) {
                $php_estado = true;
            } else {
                $php_error = 'ERROR';
            }
        } else {
            $php_error = 'La programacion ya fue enviada al area de logistica y no se puede eliminar';
        }
    } else if ($_POST['task'] == 4) {
        $intId = $_POST['id'];
        $objEstados = $clsProgramacionDiaria->fntGetEstadosProgramacionClienteUnoObj($intId);
        if (is_array($objEstados)) {
            foreach ($objEstados as $estado) {
                $intEstadoProgramacion = $estado['status'];
                if ($intEstadoProgramacion == 3) {
                    if ($clsProgramacionDiaria->fntCambiarEstadoProgramacionSemanalClienteDosObj($intId)) {
                        //Si pasa la validacion se retorna verdadero(true)
                        $php_estado = true;
                    } else {
                        //De lo contrario mostrara un mensaje mostrando que no se guardo
                        $php_error = 'No Guardo Correctamente';
                    }
                } else {
                    $php_error = 'No tiene programaciones pendientes por confirmar';
                }
            }
        } else {
            $php_error = 'NO HAY PROGRAMACIONES REALIZADAS';
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
