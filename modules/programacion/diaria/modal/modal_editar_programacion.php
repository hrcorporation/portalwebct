<?php
$clsProgramacionDiaria = new clsProgramacionDiaria();
?>
<div class="modal fade" id="modal_show_evento" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Programación diaria </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Editar programacion diaria</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="form_mostrar_programacion" name="form_mostrar_programacion" method="post">
                            <input type="hidden" value="" id="id_prog_evento" name="id_prog_evento" />
                            <input type="hidden" value="2" id="task" name="task" />
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="form-label">Cliente:</label>
                                        <select name="cbxClienteEditar" id="cbxClienteEditar" class="form-control select-2" style="width: 100%;">
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label class="form-label">Obra:</label>
                                        <select name="cbxObraEditar" id="cbxObraEditar" class="form-control select-2" style="width: 100%;">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="form-label">Pedido:</label>
                                        <select name="cbxPedidoEditar" id="cbxPedidoEditar" class="form-control select-2" style="width: 100%;">
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label class="form-label">Producto:</label>
                                        <select name="cbxProductoEditar" id="cbxProductoEditar" class="form-control select-2" style="width: 100%;">
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label class="form-label">Volumen:</label>
                                        <input type="text" name="txtCantEditar" id="txtCantEditar" class="form-control validanumericos" style="width: 100%;" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="form-label">Linea de despacho:</label>
                                        <select name="cbxLineaDespachoEditar" id="cbxLineaDespachoEditar" class="form-control select-2" style="width: 100%;">
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="txtHoraCargueEditar" class="form-label">Hora de cargue:</label>
                                        <input type="time" name="txtHoraCargueEditar" id="txtHoraCargueEditar" class="form-control" style="width: 100%;" />
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="txtHoraMixerEditar" class="form-label">Hora en mixer en obra:</label>
                                        <input type="time" name="txtHoraMixerEditar" id="txtHoraMixerEditar" class="form-control" style="width: 100%;" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="cbxMixerEditar" class="form-label">Mixer:</label>
                                        <select name="cbxMixerEditar" id="cbxMixerEditar" class="form-control select-2" style="width: 100%;">
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="txtConductorEditar" class="form-label">Conductor:</label>
                                        <select name="cbxConductorEditar" id="cbxConductorEditar" class="form-control select-2" style="width: 100%;">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" id="chkRequiereBombaEditar" name="chkRequiereBombaEditar">
                                            <label for="chkRequiereBombaEditar" class="form-check-label" for="flexCheckDefault">
                                                <b>¿Requiere bomba de Concre Tolima?</b>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="form-label">Tipo de descargue:</label>
                                        <select name="cbxTipoDescargueEditar" id="cbxTipoDescargueEditar" class="form-control select-2" style="width: 100%;">
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="cbxTipoBombaEditar" class="form-label">Tipo de bomba:</label>
                                        <select name="cbxTipoBombaEditar" id="cbxTipoBombaEditar" class="form-control select-2" style="width: 100%;">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="form-label">Observaciones:</label>
                                        <input name="txtObservacionesEditar" id="txtObservacionesEditar" class="form-control" style="width: 100%;" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="form-label">Fecha Inicial:</label>
                                        <input type="text" name="txtInicioEditar" id="txtInicioEditar" class="form-control">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label class="control-label">Fecha Final:</label>
                                        <input type="text" name="txtFinEditar" id="txtFinEditar" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" id="btnHabilitarCliente" class="btn btn-warning" title='Habilitar al cliente la edicion de la programacion'> Habilitar edicion al cliente </button>
                                <button type="button" id="btnConfirmarProgramacion" class="btn btn-success" data-toggle="modal" data-target="#modal_confirmar_programacion">Confirmar</button>
                                <button type="submit" id="btnGuardar" class="btn btn-primary">Guardar</button>
                                <button type="button" id="btnEliminar" class="btn btn-danger">Cancelar programacion</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Programado</span>
                            <span class="info-box-number"> <span id="cantidad_m3"> </span> <small>m3</small>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="info-box">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-cog"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Ejecutado</span>
                            <span class="info-box-number"> <span id="suma"></span> <small>m3</small>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-cog"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Pendiente</span>
                            <span class="info-box-number"> <span id="restante"> </span> <small>m3</small>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Remisiones </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <table id="table_remisiones" class="display" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>N°</th>
                                                <th>Hora</th>
                                                <th>Planta</th>
                                                <th>Codigo remision</th>
                                                <th>Cliente</th>
                                                <th>Obra</th>
                                                <th>Producto</th>
                                                <th>Cantidad m3</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.modal-content -->
<script>
    $(document).ready(function() {
        $(".select-2").select2({
            dropdownParent: $("#modal_show_evento")
        });
    });
</script>