<?php include '../../layout/validar_session2.php'; ?>
<?php include '../../layout/head/head2.php'; ?>
<?php include 'sidebar.php'; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>CONSIGNACIONES</h1>
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
                <h3 class="card-title">VER CONSIGNACIONES</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <table id="table_consignaciones" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>Estado</th>
                                        <th>Fecha consignacion</th>
                                        <th>Nombre del banco</th>
                                        <th>Valor</th>
                                        <th>Nombre del Cliente</th>
                                        <th>Observaciones</th>
                                        <th>Detalles</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- Modal -->
<?php include 'modal_crear_consignacion.php' ?>
<?php include 'modal_editar_consignacion.php' ?>
<?php include 'modal_importar_consignacion.php' ?>
<!-- /.modal-dialog -->
<?php include '../../layout/footer/footer2.php' ?>
<script>
     $(document).ready(function() {
        $('.select2').select2();
    });

    $("#form_crear_consignacion").on('submit', (function(e) {
        e.preventDefault();
        $.ajax({
            url: "php_crear_consignacion.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                console.log(data);
                if (data.estado) {
                    toastr.success('Se ha guardado correctamente');
                } else {
                    toastr.warning(data.errores);
                }
            },
            error: function(respuesta) {
                alert(JSON.stringify(respuesta));
            },
        });
    }));

    function format(input) {
        var num = input.value.replace(/\./g, '');
        if (!isNaN(num)) {
            num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g, '$1.');
            num = num.split('').reverse().join('').replace(/^[\.]/, '');
            input.value = num;
        } else {
            input.value = input.value.replace(/[^\d\.]*/g, '');
        }
    }

    $(document).ready(function() {
        var n = 1;
        var table = $('#table_consignaciones').DataTable({
            "ajax": {
                "url": "data_table_consignacion.php",
                "dataSrc": ""
            },
            "order": [
                [0, 'desc']
            ],
            "columns": [{
                    "data": "id"
                },
                {
                    "data": "estado"
                },
                {
                    "data": "fecha_consignacion"
                },
                {
                    "data": "nombre_banco"
                },
                {
                    "data": "valor"
                },
                {
                    "data": "nombre_cliente"
                },
                {
                    "data": "observaciones"
                },
                {
                    "data": null,
                    "defaultContent": "<button class='btn btn-warning btn-sm'> <i class='fas fa-edit'></i> </button>"
                },
                {
                    "data": null,
                    "defaultContent": "<a class='btn btn-danger btn-sm'> <i class='fas fa-trash'></i> </a>"
                }
            ],
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
        $('#table_consignaciones tbody').on('click', 'button', function() {
            var data = table.row($(this).parents('tr')).data();
            var id = data['id'];
            window.location = "editar/editar.php?id=" + id;
        });
        $('#table_consignaciones tbody').on('click', 'a', function() {
            var data = table.row($(this).parents('tr')).data();
            var id = data['id'];
            Swal.fire({
                title: '¿Esta Seguro(a) que desea eliminar la consignacion?', // mensaje de la alerta
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                cancelButtonText: 'No', // text boton
                confirmButtonText: 'Si Eliminar'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "php_eliminar_consignacion.php",
                        type: "POST",
                        data: {
                            task: 1,
                            id: id,
                        },
                        success: function(response) {
                            if (response.estado) {
                                Swal.fire(
                                    'La consignacion fue eliminado correctamente',
                                )
                                table.ajax.reload();
                            } else {
                                console.log("error");
                            }
                        },
                        error: function(respuesta) {
                            alert(JSON.stringify(respuesta));
                        },
                    });
                }
            })
        });
        setInterval(function() {
            table.ajax.reload(null, false);
        }, 10000);
    });

    $("#importar_consignaciones").change(function() {
        $("#form_importar_consignacion").on('submit', (function(e) {
            e.preventDefault();
            $.ajax({
                url: "importar/ajax_consignacion.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    console.log(data);
                    if (data.estado) {
                        toastr.success('Guardado Correctamente');
                    } else {
                        toastr.info(data.result);
                    }
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                    location.reload();
                }
            });
        }));
    });
</script>
</body>

</html>