<?php
    $clsProgramacionDiaria = new clsProgramacionDiaria();
?>
<div class="modal fade" id="modal_informativo" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Informativo</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_confirmar_programacion" name="form_confirmar_programacion" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <span class="badge bg-secondary" style="width: 100%;">
                                    <h6>Cupo Total Cantidades</h6>
                                </span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <span class="badge bg-warning" style="width: 100%;">
                                    <h6>Cupo Disponible Cantidades</h6>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <span class="badge bg-secondary" style="width: 100%;">
                                    <h6>Cupo Total Pesos</h6>
                                </span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <span class="badge bg-warning" style="width: 100%;">
                                    <h6>Cupo Disponible Pesos</h6>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal"> Cerrar </button>
                </div>
            </form>
        </div>
    </div>
    <!-- /.modal-content -->
</div>