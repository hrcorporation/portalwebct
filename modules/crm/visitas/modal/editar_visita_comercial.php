<div class="modal fade" id="modal_editar_evento" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Editar Visita Cliente</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_editar_vitita" name="form_editar_vitita" method="post">
                <div class="modal-body">
                    <input type="hidden" name="txt_id" id="txt_id">

                    <div class="row">
                    <div class="col">
                            <div class="form-group">
                                <label for="result_visit" >Asesor Comercial </label>
                               
                                        <select name="asesora_comercial_edit" style="width:100%" id="asesora_comercial_edit" class="form-control select2" >
                                            
                                        </select>
                                  
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="result_visit" >Objetivo de la visita</label>
                                <select class="select2 form-control"  style="width:100%" name="objetivo_visita_edit"
                                    id="objetivo_visita_edit">
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="result_visit">Cliente</label>
                                <select id="txt_cliente_edit" name="txt_cliente_edit" style="width:100%" class="form-control select2">

                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="result_visit">Obra</label>
                                <select id="txt_obra_edit" name="txt_obra_edit" style="width:100%" class="form-control select2">


                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="obs_visit">Observaciones:</label>
                                <input type="text" name="obs_visit_edit" id="obs_visit_edit" class="form-control" />
                            </div>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">inicio</label>
                                <input class="form-control" type="text" name="txt_inicio_edit" id="txt_inicio_edit" />
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">fin</label>
                                <input class="form-control" type="text" name="txt_fin_edit" id="txt_fin_edit" />
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Estado</label>
                                <select name="txt_estado" id="txt_estado">
                                    <option value="2">Naranja</option>
                                    <option value="3">Rojo</option>
                                    <option value="4">Morado</option>
                                    <option value="5">Verde</option>
                                    <option value="6">Verde</option>
                                    <option value="7">Azul</option>
                                    <option value="1">Verde</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <button type="submit" class="btn btn-success" id="btnguardar"> Actualizar </button>
                            </div>
                        </div>
                    </div>




            </form>
            <hr>
            <hr>
            <hr>
            <form name="form_subir_anexo" id="form_subir_anexo" method="post">
                <input type="hidden" name="txt_id2" id="txt_id2">

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="">Nombre del Anexo</label>
                            <input type="text" class="form-control" name="nombre_anexo" id="nombre_anexo">
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <label>Subir Imagen</label>
                            <input type="radio" class="form-control tipoarchivo" name="subirtipo"
                                value="image/x-png,image/jpeg" required checked="">
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <label>Subir PDF</label>
                            <input type="radio" class="form-control tipoarchivo" name="subirtipo"
                                value="application/pdf" required>
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <div>
                                <input type="file" class="form-control" name="imgfiles" id="imgfiles"
                                    accept="image/x-png,image/jpeg" required="required" />
                                <label class="" for="imgfiles">Seleccionar Archivo</label>
                            </div>
                            <!-- <input class="form-control" type="file" name="imgfiles2" id="imgfiles2" accept="image/x-png,image/jpeg" disabled="disabled" />
                                    <label class="custom-file-label" for="imgfiles2">Choose file</label> !-->
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" id="btnguardar"> Subir Anexo </button>
                        </div>
                    </div>
                </div>
            </form>

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <table class="table table-striped" id="tabla_anexos">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Nombre del anexo</th>
                                        <th>Archivo</th>
                                        <th>Detalle</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

        </div>
        <div class="modal-footer">
        </div>


    </div>
</div>
<!-- /.modal-content -->
</div>