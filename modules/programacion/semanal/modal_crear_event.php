<div class="modal fade" id="modal_crear_evento" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Agregar Evento </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_crear_event" name="form_crear_event" method="post">
                <div class="modal-body">

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="titulo_event" class=" control-label">Titulo del Evento</label>
                                <input type="text" name="titulo_event" id="titulo_event" class="form-control" placeholder="titulo_event">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="txt_cliente" class=" control-label">Cliente</label>
                                <select name="txt_cliente" id="txt_cliente" class="form-control select2" style="width: 100%;">
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="txt_obra" class=" control-label">Obra</label>
                                <select name="txt_obra" id="txt_obra" class="form-control select2" style="width: 100%;">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <br>
                            <div class="form-group" style="text-align:center;display: flex;justify-content: center;">
                                <h5>PEDIDO 5</h5>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <label for="txt_cant" class="col-sm-2 control-label">Cant</label>
                                <input name="txt_cant" id="txt_cant" class="form-control select2" style="width: 100%;" />
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="txt_producto" class=" control-label">Producto</label>
                                <select name="txt_producto" id="txt_producto" class="form-control select2" style="width: 100%;">
                                </select>
                            </div>
                        </div>
                        <div class="col-2">
                            <br>
                            <div class="form-group"  style="text-align:center;display: flex;justify-content: center;">
                                <button type="button" class="btn btn-warning">Verificar</button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="start" class="control-label">Fecha Inicial</label>
                                <input type="text" name="start" class="form-control" id="start">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="end" class=control-label">Fecha Final</label>
                                <input type="text" name="end" class="form-control" id="end">
                            </div>
                        </div>
                    </div>




                </div>
                <div class="modal-footer">
                    <button type="button" id="btn_crear" class="btn btn-success">Guardar</button>
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
                </div>
            </form>

        </div>

    </div>
    <!-- /.modal-content -->
</div>