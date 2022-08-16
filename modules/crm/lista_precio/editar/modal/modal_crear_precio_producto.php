<!-- MODAL PRECIOS PRODUCTOS PEDIDOS INICIO -->
<?php
$clslistaprecio = new clslistaprecio();
$ClsProgramacionSemanal = new ClsProgramacionSemanal();
?>
<div class="modal fade " id="crear_precio_producto">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">ADICIONAR PRODUCTO A LA LISTA DE PRECIOS</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="form_crear_precio_producto" id="form_crear_precio_producto" method="post">
                    <input type="hidden" name="id" id="id" value="<?= $id ?>">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="id_producto">Producto</label>
                                <br>
                                <select class="form-control select2" style="width:100%" name="id_producto" id="id_producto">
                                    <?= $clslistaprecio->select_productos(); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col" id="descuento_oculto">
                            <div class="form-group">
                                <label for="descuento">Descuento</label>
                                <input type="text" name="descuento" id="descuento" class="form-control validanumericos" maxlength="2"/>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="subtotal">Subtotal</label>
                                <input type="text" name="subtotal" id="subtotal" class="form-control" required="true" onkeyup="format(this)"/>
                            </div>
                        </div>
                        <!-- <div class="col">
                            <div class="form-group">
                                <label for="cantidad">Cantidad m3</label>
                                <input type="text" name="cantidad" id="cantidad" class="form-control validanumericos" />
                            </div>
                        </div> -->
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
</div><!-- MODAL PRECIOS PRODUCTOS PEDIDOS FIN -->