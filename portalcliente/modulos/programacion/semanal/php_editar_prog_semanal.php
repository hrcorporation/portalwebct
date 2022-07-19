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
$ClsProgramacionSemanal = new ClsProgramacionSemanal();
//id del usuario en sesion
$intIdUsuario = $_SESSION['id_usuario'];
//Nombre del usuario en sesion mediante el parametro del id del usuario
$StrNombreUsuario = $ClsProgramacionSemanal->fntGetNombreClienteObj($intIdUsuario);
//Se crea un objeto de la clase Datetime
$dtmFechaActual = new DateTime();
//Se obtiene la fecha actual con el formato completo
$dtmHoy = $dtmFechaActual->format("Y-m-d H:i:s");
$dtmDiaSemana = array("Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado");
$dtmDia = $dtmDiaSemana[date('w')];
$dtmHoraHoy = $dtmFechaActual->format("H:i:s");
$dtmHoraValidacion = $ClsProgramacionSemanal->validacionHora($intIdUsuario);
if (isset($_POST['task'])) {
    //validar que la variable task tenga el valor de 1
    if ($_POST['task'] == 1) {
        //id de la programacion
        $intId = $_POST['id'];
        //estado de la programacion
        $intEstado = $ClsProgramacionSemanal->fntGetEstadosProgramacionClienteDosObj($intId);
        //Fecha inicio de la programacion
        $dtmFechaInicio = $_POST['txtInicio'];
        //Fecha final de la programacion
        $dtmFechaFin = $_POST['txtFin'];
        //Validar que modifique correctamente la programacion (Fechas)
        if ($intEstado == 1) {
            if ($dtmDia == "Sabado" && $dtmHoraHoy <= $dtmHoraValidacion || $dtmDia == "Lunes" && $dtmHoraHoy >= $dtmHoraValidacion) {
                if ($ClsProgramacionSemanal->fntEditarProgramacionBool($intId, $dtmFechaInicio, $dtmFechaFin, $dtmHoy, $intIdUsuario, $StrNombreUsuario)) {
                    $php_estado = true;
                } else {
                    $php_error = 'ERROR';
                }
            } else if ($dtmDia != "Sabado" && $dtmDia != "Domingo" && $dtmDia != "Lunes") {
                if ($ClsProgramacionSemanal->fntEditarProgramacionBool($intId, $dtmFechaInicio, $dtmFechaFin, $dtmHoy, $intIdUsuario, $StrNombreUsuario)) {
                    $php_estado = true;
                } else {
                    $php_error = 'ERROR';
                }
            } else {
                $php_error = 'Fuera del horario establecido para modificar la programación';
            }
        } else {
            $php_error = 'La programacion ya fue enviada al area de logistica de Concre Tolima y no se puede hacer modificaciones';
        }
    } else if ($_POST['task'] == 2) {
        //id de la programacion
        $intId = $_POST['id_prog_evento'];
        // id del estado
        $intEstado = $ClsProgramacionSemanal->fntGetEstadosProgramacionClienteDosObj($intId);
        //id del pedido
        $intIdPedido = $_POST['cbxPedidoEditar'];
        //id del producto
        $intIdProducto = $_POST['cbxProductoEditar'];
        //nombre del producto mediante el id
        $strNombreProducto = $ClsProgramacionSemanal->fntGetNombreProducto($intIdProducto);
        //Volumen
        $dblCantidad = $_POST['txtCantEditar'];
        //Frecuencia
        $dtmFrecuencia = $_POST['cbxFrecuenciaEditar'];
        // Elementos
        $strElementos = $_POST['txtElementosEditar'];
        // Requiere bomba concretol
        if (isset($_POST['chkRequiereBombaEditar'])) {
            $bolRequiereBomba = true;
        } else {
            $bolRequiereBomba = false;
        }
        //Tipo de descargue
        $intTipoDescargue = $_POST['cbxTipoDescargueEditar'];
        //nombre del tipo de descargue
        $StrNombreTipoDescargue = $ClsProgramacionSemanal->fntGetNombreTipoDescargue($intTipoDescargue);
        //metros de tuberia
        $decMetrosTuberia = $_POST['txtMetrosEditar'];
        //Observaciones
        $StrObservaciones = $_POST['txtObservacionesEditar'];
        //Fecha de inicio de la programacion
        $dtmFechaInicio = $_POST['txtInicioEditar'];
        //Fecha final de la programacion
        $dtmFechaFin = $_POST['txtFinEditar'];
        //Editar programacion
        if ($intEstado == 1) {
            if ($dtmDia == "Sabado" && $dtmHoraHoy <= $dtmHoraValidacion || $dtmDia == "Lunes" && $dtmHoraHoy >= $dtmHoraValidacion) {
                if ($ClsProgramacionSemanal->fntEditarProgramacionTodoClienteBool($intId, $intIdPedido, $intIdProducto, $strNombreProducto, $dblCantidad, $dtmFrecuencia, $strElementos, $bolRequiereBomba, $intTipoDescargue, $StrNombreTipoDescargue, $decMetrosTuberia, $StrObservaciones, $dtmFechaInicio, $dtmFechaFin, $intIdUsuario, $StrNombreUsuario, $dtmHoy)) {
                    $php_estado = true;
                } else {
                    $php_error = 'ERROR';
                }
            } else if ($dtmDia != "Sabado" && $dtmDia != "Domingo" && $dtmDia != "Lunes") {
                if ($ClsProgramacionSemanal->fntEditarProgramacionTodoClienteBool($intId, $intIdPedido, $intIdProducto, $strNombreProducto, $dblCantidad, $dtmFrecuencia, $strElementos, $bolRequiereBomba, $intTipoDescargue, $StrNombreTipoDescargue, $decMetrosTuberia, $StrObservaciones, $dtmFechaInicio, $dtmFechaFin, $intIdUsuario, $StrNombreUsuario, $dtmHoy)) {
                    $php_estado = true;
                } else {
                    $php_error = 'ERROR';
                }
            } else {
                $php_error = 'Fuera del horario establecido para modificar la programación';
            }
        } else {
            $php_error = 'La programacion ya fue enviada al area de logistica y no se puede hacer modificaciones';
        }
    } elseif ($_POST['task'] == 3) {
        //id de la programacion
        $intId = $_POST['id'];
        $intEstado = $ClsProgramacionSemanal->fntGetEstadosProgramacionClienteDosObj($intId);
        //validar que la programacion se elimine correctamente mediante el parametro de el id de la programacion
        if ($intEstado == 1) {
            if ($dtmDia == "Sabado" && $dtmHoraHoy <= $dtmHoraValidacion || $dtmDia == "Lunes" && $dtmHoraHoy >= $dtmHoraValidacion) {
                if ($ClsProgramacionSemanal->fntEliminarProgramacionSemanalObj($intId)) {
                    $php_estado = true;
                } else {
                    $php_error = 'ERROR';
                }
            } else if ($dtmDia != "Sabado" && $dtmDia != "Domingo" && $dtmDia != "Lunes") {
                if ($ClsProgramacionSemanal->fntEliminarProgramacionSemanalObj($intId)) {
                    $php_estado = true;
                } else {
                    $php_error = 'ERROR';
                }
            } else {
                $php_error = 'Fuera del horario establecido para cancelar la programación';
            }
        } else {
            $php_error = 'La programacion ya fue enviada al area de logistica y no se puede eliminar';
        }
    } else if ($_POST['task'] == 4) {
        $intId = $_POST['id'];
        $intEstadoProgramacion = $ClsProgramacionSemanal->fntGetEstadosProgramacionClienteDosObj($intId);
        if ($intEstadoProgramacion == 1) {
            if ($ClsProgramacionSemanal->fntCambiarEstadoProgramacionSemanalClienteUnoObj($intId)) {
                //Si pasa la validacion se retorna verdadero(true)
                $php_estado = true;
            } else {
                //De lo contrario mostrara un mensaje mostrando que no se guardo
                $php_error = 'No Guardo Correctamente';
            }
        } else {
            $php_error = 'La programacion ya fue enviada al area de logistica de Concre Tolima';
        }
    } else if ($_POST['task'] == 5) {
        $objEstados = $ClsProgramacionSemanal->fntGetEstadosProgramacionClienteUnoObj($intIdUsuario);
        if (is_array($objEstados)) {
            foreach ($objEstados as $estado) {
                $intEstadoProgramacion = $estado['status'];
                if ($intEstadoProgramacion == 1) {
                    if ($ClsProgramacionSemanal->fntCambiarEstadoProgramacionSemanalClienteDosObj()) {
                        //Si pasa la validacion se retorna verdadero(true)
                        $php_estado = true;
                    } else {
                        //De lo contrario mostrara un mensaje mostrando que no se guardo
                        $php_error = 'No Guardo Correctamente';
                    }
                } else {
                    $php_error = 'No tiene programaciones pendientes por cargar';
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
