<?php
    $ClsConsignacion = new ClsConsignacion();
?>
<div class="modal fade" id="modal_crear_consignacion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Guardar consignacion</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_crear_consignacion" name="form_crear_consignacion" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="txtFechaConsignacion" class="form-label">Fecha consignacion:</label>
                                <input type="date" name="txtFechaConsignacion" id="txtFechaConsignacion" class="form-control" style="width: 100%;" />
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="cbxBanco" class="form-label">Banco:</label>
                                <select name="cbxBanco" id="cbxBanco" class="form-control select2" style="width: 100%;">
                                    <?= $ClsConsignacion->fntOptionBancosObj() ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2">
                            <div class="form-group">
                                <label for="txtValor" class="form-label">Valor:</label>
                                <input name="txtValor" id="txtValor" class="form-control" style="width: 100%;" onkeyup="format(this)"/>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="form-group">
                                <label for="cbxEstado" class="form-label">Estado:</label>
                                <select name="cbxEstado" id="cbxEstado" class="form-control select2" style="width: 100%;">
                                    <?= $ClsConsignacion->fntOptionEstadosObj() ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="form-group">
                                <label for="cbxCliente" class="form-label">Cliente:</label>
                                <select name="cbxCliente" id="cbxCliente" class="form-control select2" style="width: 100%;">
                                <?= $ClsConsignacion->fntOptionClienteEditObj() ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="txtObservaciones" class="form-label">Observaciones o comentarios:</label>
                                <input name="txtObservaciones" id="txtObservaciones" class="form-control" style="width: 100%;" />
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
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>