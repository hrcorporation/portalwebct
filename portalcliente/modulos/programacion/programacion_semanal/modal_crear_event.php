<?php
    $programacion = new programacion();
?>
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
                                <label for="txt_cliente" class="form-label">Cliente</label>
                                <select name="txt_cliente" id="txt_cliente" class="form-control select2" style="width: 100%;">
                                    <?= $programacion->option_cliente_edit() ?>
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
                                <label for="txt_cant" class="col-sm-2 form-label">Cantidad</label>
                                <input name="txt_cant" id="txt_cant" class="form-control" style="width: 100%;" />
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="txt_producto" class="control-label">Producto</label>
                                <select name="txt_producto" id="txt_producto" class="form-control select2" style="width: 100%;">
                                    <?= $programacion->option_producto_edit() ?>
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

<script>
    $(function() {
        $('.select2').select2();
    });

    $(document).ready(function() {
        $("#txt_cliente").change(function() {
            $.ajax({
                url: "load_data.php",
                type: "POST",
                data: {
                    'task': 1,
                    'txt_cliente': $('#txt_cliente').val()
                },
                dataType: 'json',
                success: function(data) {
                    $('#txt_obra').html(data.obras);
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        });
    });

    $(document).ready(function(e) {
        $("#form_crear_event").on('submit', (function(e) {
            e.preventDefault();
            $.ajax({
                url: "php_crear_prog_semanal.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    console.log(data);
                    if (data.estado) {
                        toastr.success('Se ha guardado correctamente');
                    } else {
                        toastr.warning(data.errores);
                    }
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        }));
    });
</script>