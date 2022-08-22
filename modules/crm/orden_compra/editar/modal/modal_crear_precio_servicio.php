 <!-- MODAL PRECIOS SERVICIOS PEDIDOS INICIO -->
 <?php
    $pedidos = new pedidos();
    $ClsProgramacionSemanal = new ClsProgramacionSemanal();
    ?>
 <div class="modal fade" id="crear_precio_servicio_adicional">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <div class="modal-header">
                 <h4 class="modal-title">ADICIONAR PRECIO SERVICIO</h4>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form name="form_crear_precio_servicio" id="form_crear_precio_servicio" method="post">
                     <input type="hidden" name="id" id="id" value="<?= $id ?>">
                     <div class="row">
                         <div class="col">
                             <div class="form-group">
                                 <label for="id_tipo_servicio">Tipo de servicio</label>
                                 <select class="form-control select2" name="id_tipo_servicio" id="id_tipo_servicio" style="width:100%">
                                     <?= $pedidos->select_servicio(); ?>
                                 </select>
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
                                 <label for="descuento">Observaciones</label>
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
 </div><!-- MODAL PRECIOS SERVICIOS PEDIDOS FIN -->