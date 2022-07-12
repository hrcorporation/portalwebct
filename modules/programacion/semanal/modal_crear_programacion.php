<?php
    $ClsProgramacionSemanal = new ClsProgramacionSemanal();
?>
<div class="modal fade" id="modal_crear_evento" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Agregar programacion semanal</h4>
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
                        <div class="col-6">
                            <div class="form-group">
                                <label for="cbxPedido" class="form-label">Pedido:</label>
                                <select name="cbxPedido" id="cbxPedido" class="form-control select2" style="width: 100%;">
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="cbxProducto" class="form-label">Producto:</label>
                                <select name="cbxProducto" id="cbxProducto" class="form-control select2" style="width: 100%;">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row" id = "volumen">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="txtCant" class="form-label">Volumen:</label>
                                <input name="txtCant" id="txtCant" class="form-control" style="width: 100%;" />
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="txtFrecuencia" class="form-label">Frecuencia:</label>
                                <select name="cbxFrecuencia" id="cbxFrecuencia" class="form-control select2" style="width: 100%;">
                                    <?= $ClsProgramacionSemanal->fntOptionFrecuenciaEditObj(); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="txtElementos" class="form-label">Elementos a fundir:</label>
                                <input name="txtElementos" id="txtElementos" class="form-control" style="width: 100%;" />
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
                                    <?= $ClsProgramacionSemanal->fntOptionTipoDescargueObj(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="txtMetros" class="form-label">Metros de tuberia:</label>
                                <input name="txtMetros" id="txtMetros" class="form-control" style="width: 100%;" />
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