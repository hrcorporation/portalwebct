<?php include '../../layout/validar_session2.php' ?>
<?php include '../../layout/head/head2.php'; ?>
<?php include 'sidebar.php' ?>

<?php
// Cargar Clases clases
$t1_terceros = new t1_terceros();
$t5_obras = new t5_obras();
$t4_productos = new t4_productos();

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <!-- TITULO DE LA PAGINA -->
                    <h1>Muestras</h1>
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
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"></h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="">Fecha</label>
                            <input type="date" name="txt_fecha" id="txt_fecha" class="form-control" />
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="">Codigo Remision</label>
                            <input type="number" name="txt_codigo_remision" id="txt_codigo_remision" class="form-control" />
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="">Codigo Muestra</label>
                            <input type="number" name="txt_codigo_muestra" id="txt_codigo_muestra" class="form-control" />
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="">Codigo Concreto</label>
                            <select id="txt_concreto" name="txt_concreto" class="form-control select2">
                            <?php echo $t4_productos->option_producto_edit($id_producto); ?>
                        </select>
                            
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="">Cliente</label>
                            <select name="txd_cliente" id="txd_cliente" class="form-control select2">
                            <?php print_r($t1_terceros->option_cliente_edit()); ?>

                            </select>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="">Obra</label>
                            <select name="txd_obra" id="txd_obra" class="form-control select2">
                            
                            </select>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="">Status</label>
                            <select name="txd_status" id="txd_status" class="form-control">
                           
                            </select>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="">Buscar</label>
                            <button type="button" id="buscar" class="btn btn-block btn-info">Buscar</button>
                        </div>
                    </div>
                </div>
                <!-- Tabla de Muestras -->
                <table id="t_muestras" class="display " style="width:100%">
                    <thead>
                        <tr>
                            <th>N</th>
                            <th>Codigo Muestra</th>
                            <th>Fecha</th>
                            <th>Cod Remision </th>
                            <th>Cod Concreto</th>
                            <th>Concreto</th>
                            <th>Cliente</th>
                            <th>Obras</th>
                            <th>Cant Muestras</th>
                            <th>Pendientes</th>
                            <th>Estado</th>
                            <th style="width:100px">Detalle</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>

                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Se importa los scripts de la pagina -->
<?php include '../../layout/footer/footer2.php' ?>

<script>
    

$('.select2').select2();

    function datatable_muestra(fecha,cod_remi,cod_muestra,id_producto,id_cliente,id_obra,status) {

        var table = $('#t_muestras').DataTable({
            'searching': false,
            "processing": true,
            "scrollX": true,
            "ajax": {
                "url": "datatable_muestras.php",
                'data': {
                    'fecha': fecha,
                    'cod_remi': cod_remi,
                    'cod_muestra': cod_muestra,
                    'id_producto': id_producto,
                    'id_cliente': id_cliente,
                    'id_obra': id_obra,
                    'status': status,
                },
                'type': 'post',
                "dataSrc": ""
            },
            "order": [
                [0, 'desc']
            ],
            "columns": [
                // los datos que se importan debe tener el mismo nombre que el objeto
                {
                    "data": "id"
                },
                {
                    "data": "id"
                },
                {
                    "data": "fecha"
                },
                {
                    "data": "codremision"
                },
                {
                    "data": "cod_producto"
                },
                {
                    "data": "desp_producto"
                },
                {
                    "data": "nombre_cliente"
                },
                {
                    "data": "nombre_obra"
                },
                {
                    "data": "cant_muestras_total"
                },
                {
                    "data": "cant_pendientes"
                },
                {
                    "data": "id"
                },
                {
                    "data": null,
                    "defaultContent": "<button class='btn btn-warning btn-sm btn_editar'> <i class='fas fa-edit'></i> </button>"
                }
            ],
            'paging': true,

        });

        table.on('order.dt search.dt', function() {
            table.column(0, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();

        $('#t_muestras tbody').on('click', 'button.btn_editar', function() {
            /**
             * Al hacer clic en la fila traemos los datos de esa fila
             */
            var data = table.row($(this).parents('tr')).data();
            var id = data['id']; // obtenemos el id
            // la accion de Rederigir al editar.
            window.location = "muestra/update.php?id=" + id;
        });
        table.ajax.reload();
        return table;
    }
    $('#txd_cliente').on('change', function(){
        $.ajax({
            url: "getdata.php",
            type: "POST",
            data: {
                idCliente: ($('#txd_cliente').val()),
                task: "1",
            },
            success: function(response) {
                
                $('#txd_obra').html(response.obras);
            },
            error: function(respuesta) {
                alert(JSON.stringify(respuesta));
            },
        });
    })

    $('#buscar').on('click', function() {
        var fecha = $('#txt_fecha').val();
        var cod_remi = $('#txt_codigo_remision').val();
        var cod_muestra = $('#txt_codigo_muestra').val();
        var id_producto = $('#txt_concreto').val();
        var id_cliente = $('#txd_cliente').val();
        var id_obra = $('#txd_obra').val();
        var status = $('#txd_status').val();
        if ($.fn.dataTable.isDataTable('#t_muestras')) {
            table = $('#t_muestras').DataTable();
            table.destroy();
        }
        table = datatable_muestra(fecha,cod_remi,cod_muestra,id_producto,id_cliente,id_obra,status);
        setInterval(function() {
            table.ajax.reload(null, false);
        }, 5000);
    });


</script>
</body>

</html>