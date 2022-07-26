<?php
$ClsProgramacionSemanal = new ClsProgramacionSemanal();

$dtmHora = $ClsProgramacionSemanal->fntGetHoraObj();
$intIdUsuario = $ClsProgramacionSemanal->fntGetIdUsuarioObj();
?>
<div class="modal fade" id="modal_cambiar_hora" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">¿Esta seguro de actualizar la hora limite para crear/editar programacion?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_cambiar_hora" name="form_cambiar_hora" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Hora:</label>
                                <input type="time" name="dtmHora" id="dtmHora" class="form-control" style="width: 100%;" value="<?= $dtmHora ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Usuario:</label>
                                <select name="cbxUsuario" id="cbxUsuario" class="form-control select" style="width: 100%;">
                                    <?= $ClsProgramacionSemanal->fntOptionUsuariosObj($intIdUsuario) ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"> Confirmar </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"> No </button>
                </div>
            </form>
        </div>
    </div>
    <!-- /.modal-content -->
</div>

<script>
    $(document).ready(function() {
        $(".select").select2({
            dropdownParent: $("#modal_cambiar_hora")
        });
    });
</script>