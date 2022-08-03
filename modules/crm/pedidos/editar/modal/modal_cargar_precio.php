<!-- MODAL OPCIONES CARGAR PRECIOS INICIO -->
<?php
$pedidos = new pedidos();
$ClsProgramacionSemanal = new ClsProgramacionSemanal();
?>
<div class="modal fade" id="modal_cargar">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">CARGAR PRECIOS</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <div class="btn-group">
                            <input type="hidden" class="btn-check" name="options" id="option1" autocomplete="off" />
                            <label class="btn btn-primary" for="option1" data-toggle="modal" data-target="#cargar_precios">Cargar lista de precios existentes por codigo</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="btn-group">
                            <input type="hidden" class="btn-check" name="options" id="option2" autocomplete="off" />
                            <label class="btn btn-primary" for="option2" data-toggle="modal" data-target="#cargar_excel">Cargar lista de precios en un archivo excel</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.modal-content -->
</div><!-- MODAL OPCIONES CARGAR PRECIOS FIN -->