<?php
$ClsProgramacionDiaria = new ClsProgramacionDiaria();
?>
<div class="modal fade" id="modal_crear_evento" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Agregar programación diaria</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_crear_programacion" name="form_crear_programacion" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="cbxCliente" class="form-label">Cliente:</label>
                                <select name="cbxCliente" id="cbxCliente" class="form-control select2" style="width: 100%;">
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="cbxObra" class="form-label">Obra:</label>
                                <select name="cbxObra" id="cbxObra" class="form-control select2" style="width: 100%;">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="cbxPedido" class="form-label">Pedido:</label>
                                <select name="cbxPedido" id="cbxPedido" class="form-control select2" style="width: 100%;">
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="cbxProducto" class="form-label">Producto:</label>
                                <select name="cbxProducto" id="cbxProducto" class="form-control select2" style="width: 100%;">
                                </select>
                            </div>
                        </div>
                        <div class="col" id="volumen">
                            <div class="form-group">
                                <label for="txtCant" class="form-label">Volumen:</label>
                                <input type="text" name="txtCant" id="txtCant" class="form-control" style="width: 100%;" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Linea de despacho:</label>
                                <select name="cbxLineaDespacho" id="cbxLineaDespacho" class="form-control select2" style="width: 100%;">
                                    <?= $ClsProgramacionDiaria->fntOptionLineaDespachoObj(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="txtHoraCargue" class="form-label">Hora de cargue:</label>
                                <input type="time" name="txtHoraCargue" id="txtHoraCargue" class="form-control" style="width: 100%;" />
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="txtHoraMixer" class="form-label">Hora en mixer en obra:</label>
                                <input type="time" name="txtHoraMixer" id="txtHoraMixer" class="form-control" style="width: 100%;" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="cbxMixer" class="form-label">Mixer:</label>
                                <select name="cbxMixer" id="cbxMixer" class="form-control select2" style="width: 100%;">
                                    <?= $ClsProgramacionDiaria->fntOptionVehiculoObj(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="txtConductor" class="form-label">Conductor:</label>
                                <select name="cbxConductor" id="cbxConductor" class="form-control select2" style="width: 100%;">
                                    <?= $ClsProgramacionDiaria->fntOptionConductorObj(); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="chkRequiereBomba" name="chkRequiereBomba">
                                    <label for="chkRequiereBomba" class="form-check-label" for="flexCheckDefault">
                                        <b>¿Requiere bomba de Concre Tolima?</b>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="cbxTipoDescargue" class="form-label">Tipo de descargue:</label>
                                <select name="cbxTipoDescargue" id="cbxTipoDescargue" class="form-control select2" style="width: 100%;">
                                    <?= $ClsProgramacionDiaria->fntOptionTipoDescargueObj(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="cbxTipoBomba" class="form-label">Tipo de bomba:</label>
                                <select name="cbxTipoBomba" id="cbxTipoBomba" class="form-control select2" style="width: 100%;">
                                    <?= $ClsProgramacionDiaria->fntOptionTipoBombaObj(); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="txtObservaciones" class="form-label">Observaciones:</label>
                                <input name="txtObservaciones" id="txtObservaciones" class="form-control" style="width: 100%;" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="txtInicio" class="form-label">Fecha Inicial:</label>
                                <input type="text" name="txtInicio" id="txtInicio" class="form-control">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="txtFin" class="form-label">Fecha Final:</label>
                                <input type="text" name="txtFin" id="txtFin" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="btnConfirmarProgramacion" data-toggle="modal" data-target="#modal_confirmar_programacion"> Confirmar </button>
                    <button type="submit" class="btn btn-primary" id="btnCrear"> Guardar </button>
                </div>
            </form>
        </div>
    </div>
    <!-- /.modal-content -->
</div>