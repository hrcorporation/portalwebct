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
$clsProgramacionSemanal = new clsProgramacionSemanal();
date_default_timezone_set('America/Bogota');
setlocale(LC_ALL, "es_ES");
setlocale(LC_TIME, 'es_ES');
//id del usuario en sesion.
$intIdUsuario = $_SESSION['id_usuario'];
//Nombre del usuario en sesion mediante el parametro del id del usuario.
$strNombreUsuario = $clsProgramacionSemanal->fntGetNombreClienteObj($intIdUsuario);
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
        if ($dtmHoy <= $dtmFechaInicio) {
            if ($clsProgramacionSemanal->fntEditarProgramacionBool($intId, $dtmFechaInicio, $dtmFechaFin, $dtmHoy, $intIdUsuario, $strNombreUsuario)) {
                $php_estado = true;
            }
        } else {
            $php_error = 'No puede cambiar la fecha de la programacion a una anterior a la fecha actual';
        }
    } else if ($_POST['task'] == 2) {
        //id de la programacion.
        $intId = $_POST['id_prog_evento'];
        //id cliente.
        $intIdCliente = $_POST['cbxClienteEditar'];
        //nombre cliente.
        $strNombreCliente = $clsProgramacionSemanal->fntGetNombreClienteObj($intIdCliente);
        //id de la obra.
        $intIdObra = $_POST['cbxObraEditar'];
        //Nombre de la obra mediante el parametro del id de la obra.
        $strNombreObra = $clsProgramacionSemanal->fntGetNombreObra($intIdObra);
        //id del pedido
        $intIdPedido = $_POST['cbxPedidoEditar'];
        //id del producto
        $intIdProducto = $_POST['cbxProductoEditar'];
        //nombre del producto mediante el id
        $strNombreProducto = $clsProgramacionSemanal->fntGetNombreProducto($intIdProducto);
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
        $strNombreTipoDescargue = $clsProgramacionSemanal->fntGetNombreTipoDescargue($intTipoDescargue);
        //metros de tuberia
        $decMetrosTuberia = $_POST['txtMetrosEditar'];
        //Observaciones
        $strObservaciones = $_POST['txtObservacionesEditar'];
        //Fecha de inicio de la programacion
        $dtmFechaInicio = $_POST['txtInicioEditar'];
        //Fecha final de la programacion
        $dtmFechaFin = $_POST['txtFinEditar'];
        //Validar que la fecha inicial no sea anterior a la fecha actual.
        if ($dtmHoy <= $dtmFechaInicio) {
            //Validar que la consulta salga exitosa y actualizar la programacion semanal.
            if ($clsProgramacionSemanal->fntEditarProgramacionTodoFuncionarioBool($intId, $intIdCliente, $strNombreCliente, $intIdObra, $strNombreObra, $intIdPedido, $intIdProducto, $strNombreProducto, $dblCantidad, $dtmFrecuencia, $strElementos, $bolRequiereBomba, $intTipoDescargue, $strNombreTipoDescargue, $decMetrosTuberia, $strObservaciones, $dtmFechaInicio, $dtmFechaFin, $intIdUsuario, $strNombreUsuario, $dtmHoy)) {
                $php_estado = true;
            } else {
                $php_error = 'ERROR';
            }
        } else {
            $php_error = 'No puede cambiar la fecha de la programacion a una anterior a la fecha actual';
        }
    } elseif ($_POST['task'] == 3) {
        //id de la programacion
        $intId = $_POST['id'];
        //validar que la programacion se elimine correctamente mediante el parametro de el id de la programacion
        if ($clsProgramacionSemanal->fntEliminarProgramacionSemanalObj($intId)) {
            $php_estado = true;
        }
    } else if ($_POST['task'] == 4) {
        $intId = $_POST['id'];
        $intIdEstado = $clsProgramacionSemanal->fntGetEstadosProgramacionFuncionarioDosObj($intId);
        if ($intIdEstado == 2) {
            $objProgramacionesSemanales = $clsProgramacionSemanal->fntGetProgSemanalFuncionarioEstadoUnoObj($intId);
            if (is_array($objProgramacionesSemanales)) {
                foreach ($objProgramacionesSemanales as $estado) {
                    $intEstado = 3;
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
                }
                //Se valida que la cantidad de metros cubicos o volumen sea mayor a 7
                if ($intCantidad > 7) {
                    //Calcular la cantidad de viajes que requiere (Se divide en 7 porque es la cantidad maxima que puede llevar una mixer)
                    $numeroViajes = ($intCantidad / 7);
                    //Aca aproximamos la cantidad de viajes por lo que el valor anterior es un numero decimal.
                    $numeroViajesAp = intval(ceil($numeroViajes));
                } else {
                    //Si la cantidad es menor a 7 solo se requiere un viaje
                    $numeroViajesAp = 1;
                }
                $valor_programacion = 0;
                //Calcular los metros cubicos de cada viaje
                $metrosCubicos = ($intCantidad / $numeroViajesAp);
                //Calcular la hora del cargue
                $dtmhoracargue = $clsProgramacionSemanal->restar($dtmFechaInicial, "01:00:00");
                //Calcular la nueva fecha inicial teniendo en cuenta la frecuencia
                $dtmnuevafechainicial = $clsProgramacionSemanal->restar($dtmFechaInicial, $dtmFrecuencia);
                //La hora de la mixer en obra
                $dtmhoramixerobra = $dtmFechaInicial;
                //Calcular la fecha final de la programacion
                $dtmNuevaFechafin = $clsProgramacionSemanal->sumar($dtmnuevafechainicial, $dtmFrecuencia);
                if ($dtmHoy <= $dtmnuevafechainicial) {
                    for ($i = 1; $i <= $numeroViajesAp; $i++) {
                        if ($clsProgramacionSemanal->fntCrearProgDiariaFuncionarioBool($intEstado, $intIdCliente, $strNombreCliente, $intIdObra, $strNombreObra,  $intIdPedido, $intIdProducto, $strNombreProducto,  $metrosCubicos, $valor_programacion, $dtmhoracargue, $dtmhoramixerobra, $boolRequiereBomba, $intIdTipoDescargue, $strNombreTipoDescargue, $dblMetrosTuberia, $dtmnuevafechainicial, $dtmNuevaFechafin, $strElementosFundir, $strObservaciones, $intIdUsuario, $strNombreUsuario)) {
                            $php_estado = true;
                            //Actualizando la nueva fecha inicial.
                            $dtmnuevafechainicial = $dtmNuevaFechafin;
                            //Calcular la fecha final de la programacion.
                            $dtmNuevaFechafin = $clsProgramacionSemanal->sumar($dtmNuevaFechafin, $dtmFrecuencia);
                            //Calcular la hora del cargue.
                            $dtmhoracargue = $clsProgramacionSemanal->restar($dtmNuevaFechafin, "01:00:00");
                            // Calcular la hora que debe de estar la mixer en obra.
                            $dtmhoramixerobra = $dtmNuevaFechafin;
                        } else {
                            $php_error = 'No guardo correctamente';
                        }
                    }
                    if ($clsProgramacionSemanal->fntCambiarEstadoProgramacionSemanalFuncionarioUnoObj($intId)) {
                        //Si pasa la validacion se retorna verdadero(true)
                        $php_estado = true;
                    } else {
                        //De lo contrario mostrara un mensaje mostrando que no se guardo
                        $php_error = 'No guardo correctamente';
                    }
                }else{
                    $php_error = 'No puede generar las programaciones diarias con una fecha posterior a la actual';
                }
            } else {
                $php_error = "ERROR";
            }
        } else if ($intIdEstado >= 3) {
            $php_error = 'Programacion ya fue cargada anteriormente';
        } else {
            $php_error = 'Hay que esperar la confirmacion del cliente';
        }
    } else if ($_POST['task'] == 5) {
        $intId = $_POST['id'];
        $intEstadoProgramacion = $clsProgramacionSemanal->fntGetEstadosProgramacionFuncionarioDosObj($intId);
        if ($intEstadoProgramacion == 2) {
            if ($clsProgramacionSemanal->fntCambiarEstadoProgramacionSemanalHabilitar($intId)) {
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
        $objProgramacionesSemanales = $clsProgramacionSemanal->fntGetProgSemanalFuncionarioEstadoDosObj();
        if (is_array($objProgramacionesSemanales)) {
            foreach ($objProgramacionesSemanales as $estado) {
                $intEstado = 3;
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

                if ($intCantidad > 7) {
                    $numeroViajes = ($intCantidad / 7);
                    $numeroViajesAp = intval(ceil($numeroViajes));
                } else {
                    $numeroViajesAp = 1;
                }
                $valor_programacion = 0;
                //Calcular los metros cubicos de cada viaje
                $metrosCubicos = ($intCantidad / $numeroViajesAp);
                //Calcular la hora del cargue
                $dtmhoracargue = $clsProgramacionSemanal->restar($dtmFechaInicial, "01:00:00");
                //Calcular la nueva fecha inicial teniendo en cuenta la frecuencia
                $dtmnuevafechainicial = $clsProgramacionSemanal->restar($dtmFechaInicial, $dtmFrecuencia);
                //La hora de la mixer en obra
                $dtmhoramixerobra = $dtmFechaInicial;
                //Calcular la fecha final de la programacion
                $dtmNuevaFechafin = $clsProgramacionSemanal->sumar($dtmnuevafechainicial, $dtmFrecuencia);
                if ($dtmHoy <= $dtmnuevafechainicial) {
                    if($intEstadoProgramacion == 2){
                        for ($i = 1; $i <= $numeroViajesAp; $i++) {
                            if ($clsProgramacionSemanal->fntCrearProgDiariaFuncionarioBool($intEstado, $intIdCliente, $strNombreCliente, $intIdObra, $strNombreObra,  $intIdPedido, $intIdProducto, $strNombreProducto,  $metrosCubicos, $valor_programacion, $dtmhoracargue, $dtmhoramixerobra, $boolRequiereBomba, $intIdTipoDescargue, $strNombreTipoDescargue, $dblMetrosTuberia, $dtmnuevafechainicial, $dtmNuevaFechafin, $strElementosFundir, $strObservaciones, $intIdUsuario, $strNombreUsuario)) {
                                //Si pasa la validacion se retorna verdadero(true)
                                $php_estado = true;
                                //Actualizando la nueva fecha inicial.
                                $dtmnuevafechainicial = $dtmNuevaFechafin;
                                //Calcular la fecha final de la programacion.
                                $dtmNuevaFechafin = $clsProgramacionSemanal->sumar($dtmNuevaFechafin, $dtmFrecuencia);
                                //Calcular la hora del cargue.
                                $dtmhoracargue = $clsProgramacionSemanal->restar($dtmNuevaFechafin, "01:00:00");
                                // Calcular la hora que debe de estar la mixer en obra.
                                $dtmhoramixerobra = $dtmNuevaFechafin;
                            } else {
                                $php_error = 'No guardo correctamente';
                            }
                        }
                        if ($clsProgramacionSemanal->fntCambiarEstadoProgramacionSemanalFuncionarioDosObj()) {
                            //Si pasa la validacion se retorna verdadero(true)
                            $php_estado = true;
                        } else {
                            //De lo contrario mostrara un mensaje mostrando que no se guardo
                            $php_error = 'No Guardo Correctamente';
                        }
                    }else{
                        $php_error = 'No tiene programaciones pendientes por confirmar';
                    }
                } else {
                    $php_error = 'No puede generar las programaciones diarias con una fecha posterior a la actual';
                }
            }
        } else {
            $php_error = "NO HAY PROGRAMACIONES REALIZADAS";
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
