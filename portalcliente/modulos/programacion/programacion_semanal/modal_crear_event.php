<?php
$programacion = new programacion();
?>
<div class="modal fade" id="modal_crear_evento">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Agregar Programacion </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_crear_event" name="form_crear_event" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="txt_cliente" class="form-label">Cliente</label>
                                <select name="txt_cliente" id="txt_cliente" class="form-control select2" style="width: 100%;">
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="txt_obra" class="form-label">Obra</label>
                                <select name="txt_obra" id="txt_obra" class="form-control select2" style="width: 100%;">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="txt_pedidos" class="form-label">Pedidos</label>
                                <select name="txt_pedidos" id="txt_pedidos" class="form-control select2" style="width: 100%;">
                                    <?= $programacion->option_lista_pedidos() ?>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="txt_producto" class="form-label">Productos</label>
                                <select name="txt_producto" id="txt_producto" class="form-control select2" style="width: 100%;">
                                    <?= $programacion->option_producto_edit(); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="txt_cant" class="form-label">Volumen</label>
                                <input name="txt_cant" id="txt_cant" class="form-control" style="width: 100%;" />
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="txt_hora" class="form-label">Hora</label>
                                <input name="txt_hora" id="txt_hora" class="form-control" style="width: 100%;" />
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="txt_min" class="form-label">Min</label>
                                <input name="txt_min" id="txt_min" class="form-control" style="width: 100%;" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="requiere_bomba" name="requiere_bomba">
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
                                <label for="txt_tipo_descargue" class="control-label">Tipo de descargue:</label>
                                <select name="txt_tipo_descargue" id="txt_tipo_descargue" class="form-control select2" style="width: 100%;">
                                    <?= $programacion->option_tipo_descargue(); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="start" class="form-label">Fecha Inicial</label>
                                <input type="text" name="start" class="form-control" id="start">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="end" class="control-label">Fecha Final</label>
                                <input type="text" name="end" class="form-control" id="end">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="txt_elementos" class="form-label">Elementos a fundir</label>
                                <input name="txt_elementos" id="txt_elementos" class="form-control" style="width: 100%;" />
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="txt_observaciones" class="form-label">Observaciones</label>
                                <input name="txt_observaciones" id="txt_observaciones" class="form-control" style="width: 100%;" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="btn_crear" class="btn btn-success"> Guardar </button>
                    <button type="button" class="btn btn-info" data-dismiss="modal"> Cerrar </button>
                </div>
            </form>
        </div>
    </div>
    <!-- /.modal-content -->
</div>