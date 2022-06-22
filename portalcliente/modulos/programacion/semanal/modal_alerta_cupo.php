<?php
    $ClsProgramacion = new ClsProgramacionSemanal();
?>
<div class="modal fade" id="modal_alerta_cupo" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Informativo</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_alerta_cupo" name="form_aceptar_programacion" method="post">
                <div class="modal-body">
                    <p><b>Usted ha superado el cupo</b></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"> Aceptar </button>
                </div>
            </form>
        </div>
    </div>
    <!-- /.modal-content -->
</div>