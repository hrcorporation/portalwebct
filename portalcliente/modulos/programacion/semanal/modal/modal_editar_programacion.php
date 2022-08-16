<?php
    $clsProgramacionSemanal = new clsProgramacionSemanal();
?>
<div class="modal fade" id="modal_show_evento" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Editar Programacion semanal </h4>
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
                            <div class="form-group" id="cliente">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group" id="obra">
                                <label class="form-label">Obra:</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group" id="obra">
                                <label class=" control-label">Orden de compra</label>
                                <select name="cbxPedidoEditar" id="cbxPedidoEditar" class="form-control select-2" style="width: 100%;" required="true">
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Producto</label>
                                <select name="cbxProductoEditar" id="cbxProductoEditar" class="form-control select-2" style="width: 100%;" required="true">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Volumen:</label>
                                <input name="txtCantEditar" id="txtCantEditar" class="form-control validanumericos" style="width: 100%;" required="true"/>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="col-sm-2 form-label">Frecuencia:</label>
                                <select name="cbxFrecuenciaEditar" id="cbxFrecuenciaEditar" class="form-control select-2" style="width: 100%;" required="true">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Elementos a fundir:</label>
                                <input name="txtElementosEditar" id="txtElementosEditar" class="form-control" style="width: 100%;" required="true"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="chkRequiereBombaEditar" name="chkRequiereBombaEditar">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Requiere bomba de Concre Tolima
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Tipo de descargue:</label>
                                <select name="cbxTipoDescargueEditar" id="cbxTipoDescargueEditar" class="form-control select-2" style="width: 100%;" required="true">
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Metros de tuberia:</label>
                                <input name="txtMetrosEditar" id="txtMetrosEditar" class="form-control validanumericos" style="width: 100%;" required="true"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Observaciones:</label>
                                <input name="txtObservacionesEditar" id="txtObservacionesEditar" class="form-control" style="width: 100%;" required="true"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Fecha Inicial:</label>
                                <input type="text" name="txtInicioEditar" id="txtInicioEditar" class="form-control" required="true">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="control-label">Fecha Final:</label>
                                <input type="text" name="txtFinEditar" id="txtFinEditar" class="form-control" required="true">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnConfirmar" class="btn btn-success" data-toggle="modal" data-target="#modal_aceptar_programacion"> Confirmar </button>
                    <button type="submit" id="btnGuardar" class="btn btn-primary"> Guardar </button>
                    <button type="button" id="btnEliminar" class="btn btn-danger"> Eliminar </button>
                    <button type="button" class="btn btn-info" data-dismiss="modal"> Cerrar </button>
                </div>
            </form>
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