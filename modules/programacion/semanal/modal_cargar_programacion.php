<?php
$ClsProgramacionSemanal = new ClsProgramacionSemanal();
?>
<div class="modal fade" id="modal_cargar_programacion" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">¿Esta seguro?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_cargar_programacion" name="form_cargar_programacion" method="post">
                <div class="modal-body">
                    <p>Da clic en el boton Aceptar para cargar todas las programaciones de la proxima semana.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btnCargarProgramacion"> Aceptar </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"> No </button>
                </div>
            </form>
        </div>
    </div>
    <!-- /.modal-content -->
</div>