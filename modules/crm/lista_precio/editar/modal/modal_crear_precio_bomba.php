<!-- MODAL BOMBAS PRODUCTOS PEDIDOS INICIO -->
<?php
$clslistaprecio = new clslistaprecio();
$ClsProgramacionSemanal = new ClsProgramacionSemanal();
?>
<div class="modal fade" id="crear_precio_bomba">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">ADICIONAR PRECIO BOMBA</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="form_crear_precio_bomba" id="form_crear_precio_bomba" method="post">
                    <input type="hidden" name="id" id="id" value="<?= $id ?>">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="id_tipo_bomba">Tipo de bomba</label>
                                <select class="form-control select2" name="id_tipo_bomba" id="id_tipo_bomba" required="true">
                                    <?= $clslistaprecio->select_bomba(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="rango">Rango M3</label>
                                <label for="minimo">Minimo</label>
                                <input type="number" name="minimo" id="minimo" step="any" class="form-control validanumericos" required="true" />
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="rango">Rango M3</label>
                                <label for="maximo">Maximo</label>
                                <input type="number" name="maximo" id="maximo" step="any" class="form-control validanumericos" required="true" />
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="precio">Precio</label>
                                <input type="text" name="precio" id="precio" class="form-control" required="true" onkeyup="format(this)" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="observaciones">Observaciones</label>
                                <input type="text" name="observaciones" id="observaciones" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-10">
                            <div class="form-group">
                                <label for=""></label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Guardar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.modal-content -->
</div><!-- MODAL BOMBA PRECIOS PEDIDOS FIN -->