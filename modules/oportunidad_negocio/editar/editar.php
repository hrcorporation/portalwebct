<?php include '../../../layout/validar_session3.php' ?>
<?php include '../../../layout/head/head3.php'; ?>
<?php include 'sidebar.php' ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> OPORTUNIDAD DE NEGOCIO</h1>
                </div>
                <div class="col-sm-6">
                    <!--
                              <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                                <li class="breadcrumb-item active">Actual</li>
                              </ol> 
                                -->
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <?php
        /**
         * Validacion de Usuario
         */
        $op = new oportunidad_negocio();

        if (is_array($array_data = $op->getdata_oportunidad_negocio_for_id(intval($_GET['id'])))) {
            foreach ($array_data as $key) {
                $nidentificacion = $key['nidentificacion'];
                $nombres_completos = $key['nombrescompletos'];
                $apellidos_completos = $key['apellidoscompletos'];
                $estado = $key['status_op'];

            }
        }

     
        ?>
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">EDITAR OPORTUNIDAD DE NEGOCIO</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                            class="fas fa-expand"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="progress">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 0.5%" aria-valuenow="25"
                        aria-valuemin="0" aria-valuemax="100"> <span class=" text_progresbar">0% </span> </div>
                </div>
                <div id="contenido">
                    <form name="form_edit_op" id="form_edit_op" method="post">
                        <input type="hidden" name="id_oportunidad_negocio" id="id_oportunidad_negocio" value="<?php echo $_GET['id']; ?>" />
                        <div class="row">
                            <div class="col">
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input type="checkbox" value="1" name="check_habilitar_cli"
                                            id="check_habilitar_cli" ?>
                                        <label for="check_habilitar_cli">
                                            Habilitar para modificar
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4  col-sm-12">
                                <div class="form-group">
                                    <label>Numero de Documento</label>
                                    <input type="text" name="nit" id="nit" class="form-control"
                                        value="<?php echo $nidentificacion; ?>" disabled="true" />
                                </div>
                            </div>
                            <div class="col-md-4  col-sm-12">
                                <div class="form-gorup">
                                    <label>Nombre Completo</label>
                                    <input type="text" name="nombre_completo" id="nombre_completo" class="form-control"
                                        value="<?php echo $nombres_completos; ?>" disabled="true" />
                                </div>
                            </div>
                            <div class="col-md-4  col-sm-12">
                                <div class="form-gorup">
                                    <label>Apellido Completo</label>
                                    <input type="text" name="ap_completo" id="ap_completo"
                                        value="<?php echo $apellidos_completos ?>" class="form-control"
                                        disabled="true" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>RESULTADO DE LA GESTION</label>
                                    <select class="select2 form-control" name="resultado_op_edit" id="resultado_op_edit" disabled="true" >
                                        <?php echo $op->select_resultado_op($estado) ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" name="crear_op" id="crear_op" class="btn btn-info"
                                    disabled="true">Actualizar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Listado Visitas</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                            class="fas fa-expand"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#crear_visita">
                            Crear Visita
                        </button>
                    </div>
                </div>
                <div id="contenido">
                    <table name="table_visitas" id="table_visitas">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Fecha</th>
                                <th>Resultado </th>
                                <th>Observacion</th>
                                <th>Detalle</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->
     

        <div class="modal fade" id="crear_visita">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Crear Visita</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form name="form_add_visita" id="form_add_visita" method="post">
                            <input type="hidden" name="id_cliente" id="id_clente"
                                value="<?php echo intval($_GET['id']) ?>">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="">Fecha</label>
                                        <input type="date" name="fecha_vist" id="fecha_vist" class="form-control" />

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="result_visit">Resultado de la Visita</label>
                                        <select class="select2 form-control" name="result_vist" id="result_visit">
                                            <?php echo $op->select_resultado_op($estado) ?>
                                        </select>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="obs_visit">Observaciones</label>
                                        <input type="text" name="obs_visit" id="obs_visit" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>


        <!--- Modal Editar Visita -->
        <div class="modal fade" id="edit_visita">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Ver Visita</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form name="form_edit_visita" id="form_edit_visita" method="post">
                            <input type="hidden" name="id_visita" id="id_visita" />
                            <input type="hidden" name="id_clente_edit" id="id_clente_edit"
                                value="<?php echo intval($_GET['id']) ?>">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="edit_fecha_vist">Fecha</label>
                                        <input type="date" name="edit_fecha_vist" id="edit_fecha_vist"
                                            class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="edit_result_visit">Resultado de la Visita</label>
                                        <select class="select2 form-control" name="edit_result_visit" id="edit_result_visit">
                                            <?php echo $op->select_resultado_op($estado) ?>
                                        </select>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="edit_obs_visit">Observaciones</label>
                                        <input type="text" name="edit_obs_visit" id="edit_obs_visit"
                                            class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Actualizar</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->



<!-- /.modal-dialog -->
</div>

<?php include '../../../layout/footer/footer3.php' ?>
<script>
$(document).ready(function(e) {
    $('.select2').select2();

    $(".progress").hide();
    $('#check_habilitar_cli').click(function() {
        if (!$(this).is(':checked')) {
            $("#nit").attr('disabled', true);
            $("#nombre_completo").attr('disabled', true);
            $("#ap_completo").attr('disabled', true);
            $("#crear_op").attr('disabled', true);
            $('#resultado_op_edit').attr('disabled',true);
        } else {
            $("#nit").attr('disabled', false);
            $("#nombre_completo").attr('disabled', false);
            $("#ap_completo").attr('disabled', false);
            $("#crear_op").attr('disabled', false);
            $('#resultado_op_edit').attr('disabled',false);

        }
    });
});
</script>

<script>
$(document).ready(function(e) {


    $("#fecha_vist").focus(function() {
        let formData = new FormData();

        formData.append('id_cliente', <?php echo intval($_GET['id']); ?>);

        $.ajax({
            url: "fecha_min.php",
            type: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                console.log(data);
                $("#fecha_vist").attr({
                    "min": data.fecha,
                });
            },
            error: function(respuesta) {
                alert(JSON.stringify(respuesta));
            },
        });
    });


    function datatable_visitas(id_cliente) {
        var table = $('#table_visitas').DataTable({
            //"processing": true,
            //"scrollX": true,

            "ajax": {
                "url": "datatable_visitas.php",
                'data': {
                    'id_cliente': id_cliente,
                },
                'type': 'post',
                "dataSrc": ""
            },
            "order": [
                [0, 'desc']
            ],

            "columns": [{
                    "data": "id"
                },
                {
                    "data": "fecha"
                },
                {
                    "data": "resultado"
                },
                {
                    "data": "obs"
                },
                {
                    "data": null,
                    "defaultContent": "<button class='btn btn-warning btn-sm' data-toggle='modal' data-target='#edit_visita'> Editar </button> "
                },

            ],
            'paging': false,
            'searching': false
            //"scrollX": true,

        });
        table.on('order.dt search.dt', function() {
            table.column(0, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();

        table.ajax.reload();
        return table;
    }



    if ($.fn.dataTable.isDataTable('#table_visitas')) {
        table_visitas = $('#table_visitas').DataTable();
        table_visitas.destroy();
    }
    var id_cliente = <?php echo intval($_GET['id']); ?>;
    table_visitas = datatable_visitas(id_cliente);
    setInterval(function() {
        table_visitas.ajax.reload(null, false);
    }, 5000);


    $('#table_visitas tbody').on('click', 'button', function() {
        var data = table_visitas.row($(this).parents('tr')).data();
        var id = data['id'];

        $('#id_visita').val(data['id'])
        $('#edit_fecha_vist').val(data['fecha']);
        //var resultado = data['resultado'];
        

        //$("#edit_result_visit option[value='']").prop("selected", 'selected');
        //$('#edit_result_visit').val(data['resultado']);
        $('#edit_obs_visit').val(data['obs']);

    });


    $("#form_edit_visita").on('submit', (function(e) {
        e.preventDefault();
        $.ajax({
            url: "php_edit_visita.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                console.log(data);
                const datos_errores = Object.values(data.errores);
                console.log(datos_errores);
                if (data.estado) {
                    toastr.success('visita Editada exitosamente');
                } else {
                    for (let index = 0; index < datos_errores.length; index++) {
                        toastr.warning(data.errores[index]);
                    }
                }
                $('#edit_visita').modal('toggle');
            },
            error: function(respuesta) {
                alert(JSON.stringify(respuesta));
            },
        });
    }));


    $("#form_add_visita").on('submit', (function(e) {
        e.preventDefault();
        $.ajax({
            url: "php_addvisita.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                console.log(data);
                const datos_errores = Object.values(data.errores);
                console.log(datos_errores);
                if (data.estado) {
                    toastr.success('visita creada exitosamente');
                } else {
                    for (let index = 0; index < datos_errores.length; index++) {
                        toastr.warning(data.errores[index]);
                    }
                }
                $('#crear_visita').modal('toggle');
               

                
            },
            error: function(respuesta) {
                alert(JSON.stringify(respuesta));
            },
        });
    }));

    $("#form_edit_op").on('submit', (function(e) {
        e.preventDefault();
        $.ajax({
            url: "editar_oportunidad.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                console.log(data);
                const datos_errores = Object.values(data.errores);
                console.log(datos_errores);
                if (data.estado) {
                    toastr.success('Oportunidad Editada exitosamente');
                } else {
                    for (let index = 0; index < datos_errores.length; index++) {
                        toastr.warning(data.errores[index]);
                    }
                }
            },
            error: function(respuesta) {
                alert(JSON.stringify(respuesta));
            },
        });
    }));
});
</script>

</body>

</html>