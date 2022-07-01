<?php include '../../../layout/validar_session3.php' ?>
<?php include '../../../layout/head/head3.php'; ?>
<?php include 'sidebar.php'; ?>

<?php $objProgramacionSemanal = new ClsProgramacionSemanal(); ?>
<?php $intCantidadProgramacionSinConfirmar = $objProgramacionSemanal->fntContarProgramacionesSinConfirmarObj(); ?>
<?php $intCantidadProgramacionPorCargar = $objProgramacionSemanal->fntContarProgramacionesPorCargarObj(); ?>
<?php $intCantidadProgramacionConfirmadas = $objProgramacionSemanal->fntContarProgramacionesConfirmadasObj(); ?>
<?php $intCantidadProgramacionEjecutadas = $objProgramacionSemanal->fntContarProgramacionesEjecutadasObj(); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>PROGRAMACION SEMANAL</h1>
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
                <h3 class="card-title">VER PROGRAMACIONES SEMANALES</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize">
                        <i class="fas fa-expand"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <span class="badge bg-secondary"><?= $intCantidadProgramacionSinConfirmar ?> - Sin Confirmar</span>
                    <span class="badge bg-warning"><?= $intCantidadProgramacionPorCargar ?> - Por Cargar</span>
                    <span class="badge bg-info"><?= $intCantidadProgramacionConfirmadas ?> - Confirmadas</span>
                    <span class="badge bg-success"><?= $intCantidadProgramacionEjecutadas ?> - Ejecutadas</span>
                    <button style="position: absolute; right: 75%; top: 12.2%" type="button" class="btn btn-success" id="btnConfirmarProgramacion" data-toggle="modal" data-target="#modal_cargar_programacion"> Confirmar </button>
                </div>
                <div id='calendar'></div>
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
<!-- Modal -->
<?php include 'modal_crear_programacion.php' ?>
<?php include 'modal_editar_programacion.php' ?>
<?php include 'modal_cargar_programacion.php' ?>
<?php include 'modal_confirmar_programacion.php' ?>
<?php include 'modal_informativo.php' ?>
<!-- /.modal-dialog -->
<?php include '../../../layout/footer/footer3.php' ?>
<script src="calendar.js"> </script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
    $(function() {
        $('#chkRequiereBomba').on('click', function() {
            //Ajax 
            var formData = new FormData();
            if ($(this).is(':checked')) {
                $.ajax({
                    url: "load_tipo.php", // URL
                    type: "POST", // Metodo HTTP
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        $("#cbxTipoDescargue").html(data.select_tipo_uno)
                    },
                    error: function(respuesta) {
                        alert(JSON.stringify(respuesta));
                    },
                });
            } else {
                $.ajax({
                    url: "load_tipo.php", // URL
                    type: "POST", // Metodo HTTP
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        $("#cbxTipoDescargue").html(data.select_tipo_dos)
                    },
                    error: function(respuesta) {
                        alert(JSON.stringify(respuesta));
                    },
                });
            }
        });

        $('#bomba').on('click', function() {
            //Ajax 
            var formData = new FormData();
            if ($(this).is(':checked')) {
                $.ajax({
                    url: "load_tipo.php", // URL
                    type: "POST", // Metodo HTTP
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        $("#cbxTipoDescargueEditar").html(data.select_tipo_uno)
                    },
                    error: function(respuesta) {
                        alert(JSON.stringify(respuesta));
                    },
                });
            } else {
                $.ajax({
                    url: "load_tipo.php", // URL
                    type: "POST", // Metodo HTTP
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        $("#cbxTipoDescargueEditar").html(data.select_tipo_dos)
                    },
                    error: function(respuesta) {
                        alert(JSON.stringify(respuesta));
                    },
                });
            }
        });

        $("#form_mostrar_event").on('submit', (function(e) {
            e.preventDefault();
            $.ajax({
                url: "php_editar_prog_semanal.php",
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

        $("#form_crear_programacion").on('submit', (function(e) {
            e.preventDefault();
            $.ajax({
                url: "php_crear_prog_semanal.php",
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

        $('#cbxPedido').on('change', function() {
            $.ajax({
                url: "load_data_pedido.php", // URL
                type: "POST", // Metodo HTTP
                data: {
                    'task': 1,
                    'id_pedido': $('#cbxPedido').val()
                },
                dataType: 'json',
                success: function(data) {
                    $("#cbxProducto").html(data.select_producto)
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        });
        
        $('#cbxCliente').on('change', function() {
            //Ajax 
            var formData = new FormData();
            formData.append('task', 2);
            formData.append('cliente', $("#cbxCliente").val());
            $.ajax({
                url: "load_data.php", // URL
                type: "POST", // Metodo HTTP
                //data: formData,
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    $("#cbxObra").html(data.select_obra)
                    $("#cbxPedido").html(data.select_pedidos)
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        });

        $('#cbxClienteEditar').on('change', function() {
            //Ajax 
            var formData = new FormData();
            formData.append('task', 2);
            formData.append('cliente', $("#cbxClienteEditar").val());
            $.ajax({
                url: "load_data.php", // URL
                type: "POST", // Metodo HTTP
                //data: formData,
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    $("#cbxObraEditar").html(data.select_obra)
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        });
    });
</script>
</body>

</html>