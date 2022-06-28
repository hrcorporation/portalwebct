<?php
    $ClsConsignacion = new ClsConsignacion();
?>
<div class="modal fade" id="modal_eliminar_programacion" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">¿Esta seguro?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_eliminar_programacion" name="form_eliminar_programacion" method="post">
                <div class="modal-body">
                    <p>Desea eliminar la consignacion.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="btnEliminarConsignacion"> Si, eliminar </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"> No </button>
                </div>
            </form>
        </div>
    </div>
    <!-- /.modal-content -->
</div>