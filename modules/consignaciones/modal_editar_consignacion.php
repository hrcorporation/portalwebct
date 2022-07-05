<?php
$ClsConsignacion = new ClsConsignacion();
?>
<div class="modal fade" id="modal_editar_consignacion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Guardar consignación</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_editar_consignacion" name="form_editar_consignacion" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="txtFechaConsignacionEditar" class="form-label">Fecha consignacion:</label>
                                <input type="date" name="txtFechaConsignacionEditar" id="txtFechaConsignacionEditar" class="form-control" style="width: 100%;" />
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="cbxBancoEditar" class="form-label">Banco:</label>
                                <select name="cbxBancoEditar" id="cbxBancoEditar" class="form-control select2" style="width: 100%;">
                                    <?= $ClsConsignacion->fntOptionBancosObj(); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2">
                            <div class="form-group">
                                <label for="txtValorEditar" class="form-label">Valor:</label>
                                <input name="txtValorEditar" id="txtValorEditar" class="form-control" style="width: 100%;" onkeyup="format(this)" />
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="form-group">
                                <label for="cbxEstadoEditar" class="form-label">Estado:</label>
                                <select name="cbxEstadoEditar" id="cbxEstadoEditar" class="form-control select2" style="width: 100%;">
                                    <?= $ClsConsignacion->fntOptionEstadosObj(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="form-group">
                                <label for="cbxClienteEditar" class="form-label">Cliente:</label>
                                <select name="cbxClienteEditar" id="cbxClienteEditar" class="form-control select2" style="width: 100%;">
                                    <?= $ClsConsignacion->fntOptionClienteEditObj(); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="txtObservacionesEditar" class="form-label">Observaciones o comentarios:</label>
                                <input name="txtObservacionesEditar" id="txtObservacionesEditar" class="form-control" style="width: 100%;" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btnCrear"> Guardar </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"> No </button>
                </div>
            </form>
        </div>
    </div>
    <!-- /.modal-content -->
</div>