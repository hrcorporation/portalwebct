<?php
    $ClsProgramacionDiaria = new ClsProgramacionDiaria();
?>
<div class="modal fade" id="modal_show_evento" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Editar Programación diaria </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_mostrar_programacion" name="form_mostrar_programacion" method="post">
                <div class="modal-body">
                    <input type="hidden" value="" id="id_prog_evento" name="id_prog_evento" />
                    <input type="hidden" value="2" id="task" name="task" />
                    <div class="row">
                    <div class="col">
                            <div class="form-group">
                                <label for="txtClienteEditar" class="form-label">Cliente:</label>
                                <input type="text" name="txtClienteEditar" id="txtClienteEditar" class="form-control" style="width: 100%;"/>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="txtObraEditar" class="form-label">Obra:</label>
                                <input type="text" name="txtObraEditar" id="txtObraEditar" class="form-control" style="width: 100%;"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label class=" control-label">Pedido:</label>
                                <select name="cbxPedidoEditar" id="cbxPedidoEditar" class="form-control select2" style="width: 100%;">
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label class="form-label">Producto:</label>
                                <select name="cbxProductoEditar" id="cbxProductoEditar" class="form-control select2" style="width: 100%;">
                                </select>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <label class="col-sm-2 form-label">Volumen:</label>
                                <input type="text" name="txtCantEditar" id="txtCantEditar" class="form-control" style="width: 100%;" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Linea de despacho:</label>
                                <select name="cbxLineaDespachoEditar" id="cbxLineaDespachoEditar" class="form-control select2" style="width: 100%;">
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="txtHoraCargueEditar" class="form-label">Hora de cargue:</label>
                                <input type="time" name="txtHoraCargueEditar" id="txtHoraCargueEditar" class="form-control" style="width: 100%;" />
                            </div>
                        </div>
                        <div class="col-3">
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
                                <select name="cbxMixerEditar" id="cbxMixerEditar" class="form-control select2" style="width: 100%;">
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="txtConductorEditar" class="form-label">Conductor:</label>
                                <select name="cbxConductorEditar" id="cbxConductorEditar" class="form-control select2" style="width: 100%;">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <div class="form-check" id="bomba">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Tipo de descargue:</label>
                                <select name="cbxTipoDescargueEditar" id="cbxTipoDescargueEditar" class="form-control select2" style="width: 100%;">
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cbxTipoBombaEditar" class="form-label">Tipo de bomba:</label>
                            <select name="cbxTipoBombaEditar" id="cbxTipoBombaEditar" class="form-control select2" style="width: 100%;">
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Observaciones</label>
                                <input name="txtObservacionesEditar" id="txtObservacionesEditar" class="form-control" style="width: 100%;" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Fecha Inicial</label>
                                <input type="text" name="txtInicioEditar" id="txtInicioEditar" class="form-control">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="control-label">Fecha Final</label>
                                <input type="text" name="txtFinEditar" id="txtFinEditar" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnConfirmarProgramacion" class="btn btn-success" data-toggle="modal" data-target="#modal_confirmar_programacion">Confirmar</button>
                    <button type="submit" id="btnGuardar" class="btn btn-primary">Guardar</button>
                    <button type="button" id="btnEliminar" class="btn btn-danger">Eliminar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.modal-content -->
</div>