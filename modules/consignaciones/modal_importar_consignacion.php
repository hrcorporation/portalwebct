<?php
    $ClsConsignacion = new ClsConsignacion();
?>
<div class="modal fade" id="modal_importar_consignacion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Importar consignación</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_importar_consignacion" name="form_importar_consignacion" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Seleccionar Archivo:</label>
                                <!-- input para seleccionar el archivo -->
                                <input type="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" class="form-control" name="importar_consignaciones" id="importar_consignaciones"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btnImportar" disabled = "true"> Guardar </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"> No </button>
                </div>
            </form>
        </div>
    </div>
    <!-- /.modal-content -->
</div>