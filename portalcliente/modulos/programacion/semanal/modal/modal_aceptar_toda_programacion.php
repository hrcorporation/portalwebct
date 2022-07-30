<?php
    $clsProgramacionSemanal = new clsProgramacionSemanal();
?>
<div class="modal fade" id="modal_aceptar_toda_programacion" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">¿Esta seguro?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_aceptar_toda_programacion" name="form_aceptar_programacion" method="post">
                <div class="modal-body">
                    <p>Da clic en el boton Aceptar para enviar todas las programaciones semanales al area de logistica de Concretol</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btnConfirmarTodaProgramacion"> Aceptar </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"> No </button>
                </div>
            </form>
        </div>
    </div>
    <!-- /.modal-content -->
</div>