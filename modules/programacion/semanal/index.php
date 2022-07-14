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
                    <span class="badge bg-secondary" title='Programaciones sin Confirmar, cuando el cliente registra en la Base de datos.'><?= $intCantidadProgramacionSinConfirmar ?> - Sin Confirmar</span>
                    <span class="badge bg-warning" title='Programaciones por cargar, cuando el cliente confirma y envia al area de programacion.'><?= $intCantidadProgramacionPorCargar ?> - Por Cargar</span>
                    <span class="badge bg-info" title='Programaciones confirmadas por el area de programacion.'><?= $intCantidadProgramacionConfirmadas ?> - Confirmadas</span>
                    <span class="badge bg-success" title='Programaciones ejecutadas y anexadas a la programacion diaria.'><?= $intCantidadProgramacionEjecutadas ?> - Ejecutadas</span>
                    <button style="position: absolute; right: 69%; top: 12.2%" type="button" class="btn btn-success" id="btnConfirmarProgramacion" title='Cargar todas las programaciones de la proxima semana' data-toggle="modal" data-target="#modal_confirmar_programacion"> Cargar programación </button>
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
        $("#volumen").hide();

        $('#form_confirmar_programacion').on('submit', function(e) {                                                    
            e.preventDefault();
            $.ajax({
                url: "php_cargar_programacion.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    if (data.estado) {
                        toastr.success('Se ha guardado correctamente');
                        $('#modal_confirmar_programacion').modal('hide');
                    } else {
                        toastr.warning(data.errores);
                        $('#modal_confirmar_programacion').modal('hide');
                    }
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
                    $("#cbxProducto").html(data.select_productos)
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
                    $("#cbxPedidoEditar").html(data.select_pedidos)
                    $("#cbxProductoEditar").html(data.select_productos)
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        });

        $('#cbxObra').on('change', function() {
            //Ajax 
            var formData = new FormData();
            formData.append('task', 1);
            formData.append('cliente', $("#cbxCliente").val());
            formData.append('obra', $("#cbxObra").val());
            $.ajax({
                url: "load_data_pedido.php", // URL
                type: "POST", // Metodo HTTP
                //data: formData,
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    $("#cbxPedido").html(data.select_pedidos)
                    $("#cbxProducto").html(data.select_productos)
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        });

        $('#cbxObraEditar').on('change', function() {
            //Ajax 
            var formData = new FormData();
            formData.append('task', 1);
            formData.append('cliente', $("#cbxClienteEditar").val());
            formData.append('obra', $("#cbxObraEditar").val());
            $.ajax({
                url: "load_data_pedido.php", // URL
                type: "POST", // Metodo HTTP
                //data: formData,
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    $("#cbxPedidoEditar").html(data.select_pedidos)
                    $("#cbxProductoEditar").html(data.select_productos)
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        });

        $('#cbxPedido').on('change', function() {
            //Ajax 
            var formData = new FormData();
            formData.append('task', 2);
            formData.append('pedido', $("#cbxPedido").val());
            $.ajax({
                url: "load_data_pedido.php", // URL
                type: "POST", // Metodo HTTP
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    $("#cbxProducto").html(data.select_productos)
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        });

        $('#cbxPedidoEditar').on('change', function() {
            //Ajax 
            var formData = new FormData();
            formData.append('task', 2);
            formData.append('pedido', $("#cbxPedidoEditar").val());
            $.ajax({
                url: "load_data_pedido.php", // URL
                type: "POST", // Metodo HTTP
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    $("#cbxProductoEditar").html(data.select_productos)
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        });

        $('#cbxProducto').on('change', function() {
            $("#volumen").show();
        });
        /////////////////////////////////////////////////////
        $('#chkRequiereBomba').on('click', function() {
            //Ajax 
            var formData = 'null';
            if ($(this).is(':checked')) {
                $.ajax({
                    url: "load_tipo.php", // URL
                    type: "POST", // Metodo HTTP
                    data: formData,

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
                    success: function(data) {
                        $("#cbxTipoDescargue").html(data.select_tipo_dos)
                    },
                    error: function(respuesta) {
                        alert(JSON.stringify(respuesta));
                    },
                });
            }
        });

        $('#chkRequiereBombaEditar').on('click', function() {
            //Ajax 
            var formData = 'null';
            if ($(this).is(':checked')) {
                $.ajax({
                    url: "load_tipo.php", // URL
                    type: "POST", // Metodo HTTP
                    data: formData,
                    success: function(data) {
                        $("#cbxTipoDescargueEditar").html(data.select_tipo_uno)
                        console.log(data);
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
                    success: function(data) {
                        $("#cbxTipoDescargueEditar").html(data.select_tipo_dos)
                        console.log(data);
                    },
                    error: function(respuesta) {
                        alert(JSON.stringify(respuesta));
                    },
                });
            }
        });

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
                        $('#modal_crear_evento').modal('hide');
                    } else {
                        toastr.warning(data.errores);
                    }
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        }));

        $('#txtCant').on('change', function() {
            $('#modal_informativo').modal('show');
        });

        $('#txtCantEditar').on('change', function() {
            $('#modal_informativo').modal('show');
        });
    });
</script>
</body>

</html>