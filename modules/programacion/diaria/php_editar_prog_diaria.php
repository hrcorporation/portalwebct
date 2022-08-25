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
//Se crea un objeto de la clase programacion
$clsProgramacionDiaria = new clsProgramacionDiaria();
//id del usuario en sesion
$id_usuario = $_SESSION['id_usuario'];
//Nombre del usuario en sesion mediante el parametro del id del usuario
$nombre_usuario = $clsProgramacionDiaria->fntGetNombreClienteObj($id_usuario);
//Se crea un objeto de la clase Datetime
$fecha_actual = new DateTime();
//Se obtiene la fecha actual con el formato completo
$hoy = $fecha_actual->format("Y-m-d H:i:s");
if (isset($_POST['task'])) {
    //validar que la variable task tenga el valor de 1
    if ($_POST['task'] == 1) {
        //id de la programacion
        $id = $_POST['id'];
        //Fecha inicio de la programacion
        $inicio = $_POST['txtInicio'];
        //Fecha final de la programacion
        $fin = $_POST['txtFin'];
        if ($hoy <= $inicio) {
            //Validar que modifique correctamente la programacion (fechas)
            if ($clsProgramacionDiaria->fntEditarProgramacionBool($id, $inicio, $fin, $hoy, $id_usuario, $nombre_usuario)) {
                $php_estado = true;
            }
        } else {
            $php_error = 'No puede cambiar la fecha de la programacion a una anterior a la fecha actual';
        }
    } else if ($_POST['task'] == 2) {
        //id de la programacion
        $intId = $_POST['id_prog_evento'];
        //id cliente
        $intIdCliente = $_POST['cbxClienteEditar'];
        //nombre cliente
        $strNombreCliente = $clsProgramacionDiaria->fntGetNombreClienteObj($intIdCliente);
        //id de la obra.
        $intIdObra = $_POST['cbxObraEditar'];
        //Nombre de la obra mediante el parametro del id de la obra.
        $StrNombreObra = $clsProgramacionDiaria->fntGetNombreObraObj($intIdObra);
        //id del pedido
        $intIdPedido = $_POST['cbxPedidoEditar'];
        //id del producto
        $intIdProducto = $_POST['cbxProductoEditar'];
        //nombre del producto mediante el id
        $strNombreProducto = $clsProgramacionDiaria->fntGetNombreProductoObj($intIdProducto);
        //id de la linea de despacho.
        $intIdLineaDespacho = $_POST['cbxLineaDespachoEditar'];
        //Nombre de la linea de despacho mediante el parametro del id del producto.
        $StrNombreLineaDespacho = $clsProgramacionDiaria->fntGetNombreLineaDespachoObj($intIdLineaDespacho);
        //hora de cargue
        $dtmHoraCargue = $_POST['txtHoraCargueEditar'];
        //Hora mixer en obra
        $dtmHoraMixerObra = $_POST['txtHoraMixerEditar'];
        //Id de la mixer 
        $intIdMixer = $_POST['cbxMixerEditar'];
        //Placa de la mixer
        $StrPlacaMixer = $clsProgramacionDiaria->fntGetPlacaMixerObj($intIdMixer);
        //Id del conductor
        $intIdConductor = $_POST['cbxConductorEditar'];
        //Nombre del conductor mediante el parametro del id del conductor
        $StrNombreConductor = $clsProgramacionDiaria->fntGetNombreClienteObj($intIdConductor);
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
        $StrNombreTipoDescargue = $clsProgramacionDiaria->fntGetNombreTipoDescargueObj($intTipoDescargue);
        //Tipo de bomba
        $intTipoBomba = $_POST['cbxTipoBombaEditar'];
        //nombre del tipo de bomba
        $StrNombreTipoBomba = $clsProgramacionDiaria->fntGetNombreTipoBombaObj($intTipoBomba);
        //Observaciones
        $StrObservaciones = $_POST['txtObservacionesEditar'];
        //Fecha de inicio de la programacion
        $dtmFechaInicio = $_POST['txtInicioEditar'];
        //Fecha final de la programacion
        $dtmFechaFin = $_POST['txtFinEditar'];
        if ($hoy <= $dtmFechaInicio) {
            if ($clsProgramacionDiaria->fntEditarProgramacionTodoFuncionarioBool($intId, $intIdCliente, $strNombreCliente, $intIdObra, $StrNombreObra, $intIdPedido, $intIdProducto, $strNombreProducto, $intIdLineaDespacho, $StrNombreLineaDespacho, $dtmHoraCargue, $dtmHoraMixerObra, $intIdMixer, $StrPlacaMixer, $intIdConductor, $StrNombreConductor, $decCantidad, $bolRequiereBomba, $intTipoDescargue, $StrNombreTipoDescargue, $intTipoBomba, $StrNombreTipoBomba, $StrObservaciones, $dtmFechaInicio, $dtmFechaFin, $hoy, $id_usuario, $nombre_usuario)) {
                $php_estado = true;
                $intEstadoProgramacion = $clsProgramacionDiaria->fntGetEstadosProgramacionClienteUnoObj($intId);
                if ($intEstadoProgramacion == 4) {
                    if ($clsProgramacionDiaria->fntCambiarEstadoProgramacionSemanalFuncionarioDosObj($intId)) {
                        //Si pasa la validacion se retorna verdadero(true)
                        $php_estado = true;
                    } else {
                        //De lo contrario mostrara un mensaje mostrando que no se guardo
                        $php_error = 'No Guardo Correctamente';
                    }
                } else if ($intEstadoProgramacion == 3) {
                    $php_error = 'Hay que esperar la confirmacion del cliente';
                } else {
                    $php_error = 'La programacion ya fue cargada anteriormente';
                }
            } else {
                $php_error = 'ERROR';
            }
        } else {
            $php_error = 'No puede cambiar la fecha de la programacion a una anterior a la fecha actual';
        }
        //Validar que la variable exista, si cumple la variable se le asigna true, de lo contrario seria false.
    } elseif ($_POST['task'] == 3) {
        //id de la programacion
        $id = $_POST['id'];
        //validar que la programacion se elimine correctamente mediante el parametro de el id de la programacion
        if ($clsProgramacionDiaria->fntEliminarProgramacionDiariaObj($id)) {
            $php_estado = true;
        }
    } else if ($_POST['task'] == 4) {
        $intId = $_POST['id'];
        $intEstadoProgramacion = $clsProgramacionDiaria->fntGetEstadosProgramacionClienteUnoObj($intId);
        $datos_programacion = $clsProgramacionDiaria->fntCargarDataProgramacionDiariaObj($intId);
        if ($intEstadoProgramacion == 5) {
            if ($clsProgramacionDiaria->fntCambiarEstadoProgramacionSemanalFuncionarioTresObj($intId)) {
                //Si pasa la validacion se retorna verdadero(true).
                $php_estado = true;
                if (is_array($datos_programacion)) {
                    foreach ($datos_programacion as $dato) {
                        $intEstadoProgramacion  = 6;
                        $intIdCliente = $dato['cliente'];
                        $strNombreCliente = $dato['nombre_cliente'];
                        $intIdObra = $dato['obra'];
                        $strNombreObra = $dato['nombre_obra'];
                        $intIdPedido = $dato['id_pedido'];
                        $intIdProducto = $dato['producto'];
                        $strNombreProducto = $dato['nombre_producto'];
                        $intCantidad = $dato['cantidad'];
                        $dtmFrecuencia = $dato['frecuencia'];
                        $boolRequiereBomba = $dato['requiere_bomba'];
                        $intIdLineaDespacho = $dato['id_linea_produccion'];
                        $strNombreLineaDespacho = $dato['nombre_linea_produccion'];
                        $intIdTipoDescargue = $dato['id_tipo_descargue'];
                        $strNombreTipoDescargue = $dato['nombre_tipo_descargue'];
                        $dtmFechaInicial = $dato['inicio'];
                        $dtmFechaFinal = $dato['fin'];
                        $strElementosFundir = $dato['elementos_fundir'];
                        $strObservaciones = $dato['observaciones'];
                        $intIdUsuario = $dato['id_usuario'];
                        $strNombreUsuario = $dato['nombre_usuario'];
                        $valor_programacion = 0;

                        if ($intCantidad > 7) {
                            $numeroViajes = ($intCantidad / 7);
                            $numeroViajesAp = intval(ceil($numeroViajes));
                        } else {
                            $numeroViajesAp = 1;
                        }

                        $intIdMixer = $dato['id_mixer'];
                        $strPlacaMixer = $dato['mixer'];
                        $intIdConductor = $dato['id_conductor'];
                        $strNombreConductor = $dato['nombre_conductor'];
                        $intTipoBomba = $dato['id_tipo_bomba'];
                        $strNombreTipoBomba = $dato['tipo_bomba'];
                        $metrosTuberia = $dato['metros'];
                        //Calcular los metros cubicos de cada viaje
                        $metrosCubicos = ($intCantidad / $numeroViajesAp);
                        //Calcular la hora del cargue
                        $dtmhoracargue = $clsProgramacionDiaria->restar($dtmFechaInicial, "01:00:00");
                        //La hora de la mixer en obra
                        $dtmhoramixerobra = $dtmFechaInicial;
                        //Calcular la nueva fecha inicial teniendo en cuenta la frecuencia
                        $dtmnuevafechainicial = $clsProgramacionDiaria->restar($dtmFechaInicial, $dtmFrecuencia);
                        //Calcular la fecha final de la programacion
                        $dtmNuevaFechafin = $clsProgramacionDiaria->sumar($dtmnuevafechainicial, $dtmFrecuencia);
                    }
                    for ($i = 0; $i < $numeroViajesAp; $i++) {
                        if ($clsProgramacionDiaria->fntDividirProgramacion($intEstadoProgramacion, $intIdCliente, $strNombreCliente, $intIdObra, $strNombreObra,  $intIdPedido, $intIdProducto, $strNombreProducto, $intIdLineaDespacho, $strNombreLineaDespacho, $dtmhoracargue, $dtmhoramixerobra, $intIdMixer, $strPlacaMixer, $intIdConductor, $strNombreConductor, $metrosCubicos, $boolRequiereBomba, $intIdTipoDescargue, $strNombreTipoDescargue, $intTipoBomba, $strNombreTipoBomba, $metrosTuberia, $dtmnuevafechainicial, $dtmNuevaFechafin, $strElementosFundir, $strObservaciones, $intIdUsuario, $strNombreUsuario)) {
                            //Calcular la nueva fecha inicial teniendo en cuenta la frecuencia
                            $dtmnuevafechainicial = $clsProgramacionDiaria->sumar($dtmnuevafechainicial, $dtmFrecuencia);
                            //Calcular la fecha final de la programacion
                            $dtmNuevaFechafin = $clsProgramacionDiaria->sumar($dtmnuevafechainicial, $dtmFrecuencia);
                            //Calcular la hora del cargue
                            $dtmhoracargue = $clsProgramacionDiaria->sumar($dtmnuevafechainicial, $dtmFrecuencia);
                            //La hora de la mixer en obra
                            $dtmhoramixerobra = $clsProgramacionDiaria->sumar($dtmhoracargue, "01:00:00");
                        }
                    }
                }
            } else {
                //De lo contrario mostrara un mensaje mostrando que no se guardo.
                $php_error = 'No Guardo Correctamente';
            }
        } else if ($intEstadoProgramacion == 4) {
            $php_error = 'Hay que completar todos los datos para poder confirmar la programacion';
        } else {
            $php_error = 'La programacion ya fue cargada anteriormente';
        }
    } else if ($_POST['task'] == 5) {
        $intId = $_POST['id'];
        $intEstadoProgramacion = $clsProgramacionDiaria->fntGetEstadosProgramacionFuncionarioDosObj($intId);
        if ($intEstadoProgramacion == 4) {
            if ($clsProgramacionDiaria->fntCambiarEstadoProgramacionDiariaHabilitar($intId)) {
                $php_estado = true;
            } else {
                $php_error = "ERROR";
            }
        } else if ($intEstadoProgramacion == 3) {
            $php_error = "El cliente ya esta habilitado para modificar esta programacion";
        } else {
            $php_error = "Esta programacion no se le puede habilitar al cliente para hacer modificaciones";
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
