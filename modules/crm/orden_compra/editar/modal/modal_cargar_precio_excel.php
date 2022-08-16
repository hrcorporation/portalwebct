 <!-- MODAL CARGAR PRECIOS MEDIANTE FORMATO DE EXCEL INICIO -->
 <?php
    $pedidos = new pedidos();
    $ClsProgramacionSemanal = new ClsProgramacionSemanal();
?>
 <div class="modal fade" id="cargar_excel">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <div class="modal-header">
                 <h4 class="modal-title">CARGAR PRECIOS EXCEL</h4>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form name="form_productos" id="form_productos" method="post">
                     <input type="hidden" name="id" id="id" value="<?= $id ?>">
                     <div class="row">
                         <div class="col">
                             <div class="form-group">
                                 <label>Seleccione una opcion</label>
                                 <br>
                                 <select class="select2 form-control" name="id_select_producto" id="id_select_producto" style="width:100%">
                                     <option selected disabled value="">Seleccione</option>
                                     <option value="1">Actualizar toda la lista</option>
                                     <option value="2">Adicionar precios</option>
                                 </select>
                             </div>
                         </div>
                         <div class="col">
                             <div class="form-group">
                                 <label>Seleccionar Archivo</label>
                                 <!-- input para seleccionar el archivo -->
                                 <input type="file" class="form-control" name="file_productos" id="file_productos" disabled="true" />
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
                                 <!-- boton para guardar el archivo -->
                                 <button type="submit" class="btn btn-success" name="btn_subirarchivo" id="btn_subirarchivo" onclick="return confirm('¿Desea agregar los productos?')">
                                     Subir
                                 </button>
                             </div>
                         </div>
                     </div>
                 </form>
             </div>
         </div>
     </div>
     <!-- /.modal-content -->
 </div><!-- MODAL CARGAR PRECIOS MEDIANTE FORMATO DE EXCEL FIN -->