<?php
session_start();
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

$log = false;
$php_estado = false;
$php_error[] = "";
$resultado = "";
//Se crea un objeto de la clase programacion.
$ClsProgramacionSemanal = new ClsProgramacionSemanal();
//id del usuario en sesion.
$intIdUsuario = $_SESSION['id_usuario'];
//Nombre del usuario en sesion mediante el parametro del id del usuario.
$StrNombreUsuario = $ClsProgramacionSemanal->fntGetNombreClienteObj($intIdUsuario);
//Se crea un objeto de la clase Datetime.
$dtmFechaActual = new DateTime();
//Se obtiene la fecha actual con el formato completo.
$dtmHoy = $dtmFechaActual->format("Y-m-d H:i:s");
if (isset($_POST['task'])) {
    //validar que la variable task tenga el valor de 1.
    if ($_POST['task'] == 1) {
        //id de la programacion.
        $intId = $_POST['id'];
        //Fecha inicio de la programacion.
        $dtmFechaInicio = $_POST['txtInicio'];
        //Fecha final de la programacion.
        $dtmFechaFin = $_POST['txtFin'];
        //Validar que modifique correctamente la programacion (fechas).
        if ($ClsProgramacionSemanal->fntEditarProgramacionBool($intId, $dtmFechaInicio, $dtmFechaFin, $dtmHoy, $intIdUsuario, $StrNombreUsuario)) {
            $php_estado = true;
        }
    } else if ($_POST['task'] == 2) {
        //id de la programacion.
        $intId = $_POST['id_prog_evento'];
        //id cliente.
        $intIdCliente = $_POST['cbxClienteEditar'];
        //nombre cliente.
        $strNombreCliente = $ClsProgramacionSemanal->fntGetNombreClienteObj($intIdCliente);
        //id de la obra.
        $intIdObra = $_POST['cbxObraEditar'];
        //Nombre de la obra mediante el parametro del id de la obra.
        $StrNombreObra = $ClsProgramacionSemanal->fntGetNombreObra($intIdObra);
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
        if ($ClsProgramacionSemanal->fntEditarProgramacionTodoFuncionarioBool($intId, $intIdCliente, $strNombreCliente, $intIdObra, $StrNombreObra, $intIdPedido, $intIdProducto, $strNombreProducto, $dblCantidad, $dtmFrecuencia, $strElementos, $bolRequiereBomba, $intTipoDescargue, $StrNombreTipoDescargue, $decMetrosTuberia, $StrObservaciones, $dtmFechaInicio, $dtmFechaFin, $intIdUsuario, $StrNombreUsuario, $dtmHoy)) {
            $php_estado = true;
        } else {
            $php_error = 'ERROR';
        }
    } elseif ($_POST['task'] == 3) {
        //id de la programacion
        $intId = $_POST['id'];
        //validar que la programacion se elimine correctamente mediante el parametro de el id de la programacion
        if ($ClsProgramacionSemanal->fntEliminarProgramacionSemanalObj($intId)) {
            $php_estado = true;
        }
    } else if ($_POST['task'] == 4) {
        $intId = $_POST['id'];
        $intIdEstado = $ClsProgramacionSemanal->fntGetEstadosProgramacionFuncionarioDosObj($intId);
        if ($intIdEstado == 2) {
            $objProgramacionesSemanales = $ClsProgramacionSemanal->fntGetProgSemanalFuncionarioEstadoUnoObj($intId);
            if (is_array($objProgramacionesSemanales)) {
                foreach ($objProgramacionesSemanales as $estado) {
                    $intEstado = $estado['status'];
                    $intIdCliente = $estado['id_cliente'];
                    $strNombreCliente = $estado['nombre_cliente'];
                    $intIdObra = $estado['id_obra'];
                    $strNombreObra = $estado['nombre_obra'];
                    $intIdPedido = $estado['id_pedido'];
                    $intIdProducto = $estado['id_producto'];
                    $strNombreProducto = $estado['nombre_producto'];
                    $intCantidad = $estado['cantidad'];
                    $intValorProgramacion = $estado['valor_programacion'];
                    $dtmFrecuencia = $estado['frecuencia'];
                    $boolRequiereBomba = $estado['requiere_bomba'];
                    $intIdTipoDescargue = $estado['id_tipo_descargue'];
                    $strNombreTipoDescargue = $estado['nombre_tipo_descargue'];
                    $dblMetrosTuberia = $estado['metros_tuberia'];
                    $dtmFechaInicial = $estado['fecha_ini'];
                    $dtmFechaFinal = $estado['fecha_fin'];
                    $strElementosFundir = $estado['elementos_fundir'];
                    $strObservaciones = $estado['observaciones'];
                    $intIdUsuario = $estado['id_usuario'];
                    $strNombreUsuario = $estado['nombre_usuario'];
                    if ($intCantidad >= 7) {
                        $numeroViajes = ($intCantidad / 7);
                        $numeroViajesAp = ceil($numeroViajes);
                    } else {
                        $numeroViajes = 1;
                        $numeroViajesAp = 1;
                    }
                    
                    $metrosCubicos = ($intCantidad / $numeroViajesAp);
                    $nuevaFechaFin = 0;
                    for ($i = 1; $i <= $numeroViajesAp; $i++) {
                        //$nuevaFechaFin = date("Y-m-d H:i:s",strtotime($dtmFechaInicial)) + date("Y-m-d H:i:s",strtotime( $dtmFrecuencia));
                        $nuevaFechaFin = $dtmFechaInicial->modify('+'.$dtmFrecuencia.'minutos');
                    }
                    if ($ClsProgramacionSemanal->fntCrearProgDiariaFuncionarioBool($intEstado, $intIdCliente, $strNombreCliente, $intIdObra, $strNombreObra,  $intIdPedido, $intIdProducto, $strNombreProducto,  $intCantidad, $numeroViajesAp, $boolRequiereBomba, $intIdTipoDescargue, $strNombreTipoDescargue, $dblMetrosTuberia, $dtmFechaInicial, $dtmFechaFinal, $strElementosFundir, $strObservaciones, $intIdUsuario, $strNombreUsuario)) {
                        //Si pasa la validacion se retorna verdadero(true)
                        $php_estado = true;
                    } else {
                        $php_error = 'No guardo correctamente';
                    }
                    if ($ClsProgramacionSemanal->fntCambiarEstadoProgramacionSemanalFuncionarioUnoObj($intId)) {
                        //Si pasa la validacion se retorna verdadero(true)
                        $php_estado = true;
                    } else {
                        //De lo contrario mostrara un mensaje mostrando que no se guardo
                        $php_error = 'No guardo correctamente';
                    }
                }
            } else {
                $php_error = "ERROR";
            }
        } else {
            $php_error = 'Hay que esperar la confirmacion del cliente';
        }
    } else if ($_POST['task'] == 5) {
        $intId = $_POST['id'];
        $intEstadoProgramacion = $ClsProgramacionSemanal->fntGetEstadosProgramacionFuncionarioDosObj($intId);
        if ($intEstadoProgramacion == 2) {
            if ($ClsProgramacionSemanal->fntCambiarEstadoProgramacionSemanalHabilitar($intId)) {
                $php_estado = true;
            } else {
                $php_error = "ERROR";
            }
        } else if ($intEstadoProgramacion == 1) {
            $php_error = "El cliente ya esta habilitado para modificar esta programacion";
        } else {
            $php_error = "Esta programacion no se le puede habilitar al cliente para hacer modificaciones";
        }
    } else if ($_POST['task'] == 6) {
        $objProgramacionesSemanales = $ClsProgramacionSemanal->fntGetProgSemanalFuncionarioEstadoDosObj();
        if (is_array($objProgramacionesSemanales)) {
            foreach ($objProgramacionesSemanales as $estado) {
                $intEstado = 4;
                $intEstadoProgramacion  = $estado['status'];
                $intIdCliente = $estado['id_cliente'];
                $strNombreCliente = $estado['nombre_cliente'];
                $intIdObra = $estado['id_obra'];
                $strNombreObra = $estado['nombre_obra'];
                $intIdPedido = $estado['id_pedido'];
                $intIdProducto = $estado['id_producto'];
                $strNombreProducto = $estado['nombre_producto'];
                $intCantidad = $estado['cantidad'];
                $intValorProgramacion = $estado['valor_programacion'];
                $dtmFrecuencia = $estado['frecuencia'];
                $boolRequiereBomba = $estado['requiere_bomba'];
                $intIdTipoDescargue = $estado['id_tipo_descargue'];
                $strNombreTipoDescargue = $estado['nombre_tipo_descargue'];
                $dblMetrosTuberia = $estado['metros_tuberia'];
                $dtmFechaInicial = $estado['fecha_ini'];
                $dtmFechaFinal = $estado['fecha_fin'];
                $strElementosFundir = $estado['elementos_fundir'];
                $strObservaciones = $estado['observaciones'];
                $intIdUsuario = $estado['id_usuario'];
                $strNombreUsuario = $estado['nombre_usuario'];

                $numeroViajes = ($intCantidad / 7);
                $numeroViajesAp = ceil($numeroViajes);
                $metrosCubicos = ($intCantidad / $numeroViajes);

                if ($ClsProgramacionSemanal->fntCrearProgDiariaFuncionarioBool($intEstado, $intIdCliente, $strNombreCliente, $intIdObra, $strNombreObra,  $intIdPedido, $intIdProducto, $strNombreProducto,  $intCantidad, $numeroViajesAp, $boolRequiereBomba, $intIdTipoDescargue, $strNombreTipoDescargue, $dblMetrosTuberia, $dtmFechaInicial, $dtmFechaFinal, $strElementosFundir, $strObservaciones, $intIdUsuario, $strNombreUsuario)) {
                    //Si pasa la validacion se retorna verdadero(true)
                    $php_estado = true;
                } else {
                    $php_error = 'No guardo correctamente';
                }
                if ($intEstadoProgramacion == 2) {
                    if ($ClsProgramacionSemanal->fntCambiarEstadoProgramacionSemanalFuncionarioDosObj()) {
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
            $php_error = "ERROR";
        }
    } else {
        $php_error = 'No tiene programaciones pendientes por confirmar';
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
