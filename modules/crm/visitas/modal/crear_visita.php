<div class="modal fade" id="modal_crear_evento" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Agregar Crear Visita Cliente</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_crear_vitita" name="form_crear_vitita" method="post">
                <div class="modal-body">

                    <div class="row">
                    <div class="col">
                            <div class="form-group">
                                <label for="result_visit" >Asesor Comercial </label>
                               
                                        <select name="txt_asesora_comercial" style="width:100%" id="txt_asesora_comercial" class="form-control select2" >
                                            
                                        </select>
                                  
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="result_visit">Objetivo de la visita</label>
                                <select class="select2 form-control" style="width:100%" name="objetivo_visita" id="objetivo_visita">
                                    <?= $visita_clientes->select_tipo_visita() ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="result_visit">Cliente</label>
                                <select id="txt_cliente" name="txt_cliente"  style="width:100%" class="form-control select2">
                                        <?php print_r($t1_terceros->option_cliente_edit()); ?>
                                    </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="result_visit">Obra</label>
                                <select id="txt_obra" name="txt_obra" style="width:100%" class="form-control select2">
                                <?php echo $t5_obras->option_obra($id_cliente); ?>
                                    
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="obs_visit">Observaciones:</label>
                                <input type="text" name="obs_visit" id="obs_visit" class="form-control" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">inicio</label>
                                <input class="form-control" type="text" name="txt_inicio" id="txt_inicio" />
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">fin</label>
                                <input class="form-control" type="text" name="txt_fin" id="txt_fin" />
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btnCrear"> Guardar </button>
                </div>
            </form>
        </div>
    </div>
    <!-- /.modal-content -->
</div>