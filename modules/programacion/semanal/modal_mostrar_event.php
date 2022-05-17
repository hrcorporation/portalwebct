<div class="modal fade" id="modal_show_evento" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Editar Evento </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_mostrar_event" name="form_mostrar_event" method="post">
                <div class="modal-body">
                    <input type="hidden" value="" id="id_evento" /> 
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="titulo_event" class="col-sm-2 control-label">Titulo del Evento</label>
                                <div class="col-sm-10">
                                    <input type="text" name="titulo_event" id="titulo_event" class="form-control" placeholder="titulo_event">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="start" class="col-sm-2 control-label">Fecha Inicial</label>
                                <div class="col-sm-10">
                                    <input type="datetime-local" name="start" class="form-control" id="start">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="end" class="col-sm-2 control-label">Fecha Final</label>
                                <div class="col-sm-10">
                                    <input type="datetime" name="end" class="form-control" id="end">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btn_guardar" class="btn btn-success">Guardar</button>
                    <button type="button" id="btn_eliminar" class="btn btn-danger">Eliminar</button>
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
                </div>
            </form>

        </div>

    </div>
    <!-- /.modal-content -->
</div>