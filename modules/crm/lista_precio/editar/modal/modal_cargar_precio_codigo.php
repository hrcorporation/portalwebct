 <!-- MODAL CARGAR PRECIOS MEDIANTE CODIGO DE PEDIDO INICIO -->
 <?php
    $clslistaprecio = new clslistaprecio();
    $ClsProgramacionSemanal = new ClsProgramacionSemanal();
?>
 <div class="modal fade" id="cargar_precios">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <div class="modal-header">
                 <h4 class="modal-title">CARGAR PRECIOS</h4>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form name="form_cargar_precio_servicio" id="form_cargar_precio_servicio" method="post">
                     <input type="hidden" name="id_pedido_cargar" id="id_pedido_cargar" value="<?= $id ?>">
                     <div class="row">
                         <div class="col">
                             <div class="form-group">
                                 <label>Digite el Codigo del pedido existente para cargar los datos</label>
                                 <input type="text" name="txt_cod_load" id="txt_cod_load" class="form-control validanumericos">
                             </div>
                         </div>
                     </div>
                     <div class="row">
                         <div class="col-10">
                             <div class="form-group">
                                 <label></label>
                             </div>
                         </div>
                         <div class="col">
                             <div class="form-group">
                                 <button type="submit" class="btn btn-success">Guardar</button>
                             </div>
                         </div>
                     </div>
                 </form>
             </div>
         </div>
     </div>
     <!-- /.modal-content -->
 </div><!-- MODAL CARGAR PRECIOS MEDIANTE CODIGO DE PEDIDO INICIO -->