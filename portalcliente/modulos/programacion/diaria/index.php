<?php include '../../../../layout/validar_session_cliente4.php' ?>
<?php include '../../../../layout/head/headcliente4.php' ?>
<?php include 'sidebar.php' ?>
<?php $programacionDiaria = new ClsProgramacionDiaria();
//Se crea un objeto de la clase programacion
$intIdUsuario = $_SESSION['id_usuario']; ?>
<?php $intCantidadProgramacionSinConfirmar = $programacionDiaria->fntContarProgramacionesSinConfirmarClienteObj($intIdUsuario); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> <strong> <?php echo $_SESSION['nombre_usuario']; ?> </strong> Bienvenido al <strong style="color:#ac4661">PORTAL DE CLIENTES</strong>
                    </h1>
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
                <h3 class="card-title">VER PROGRAMACIONES DIARIA</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="col-1">
                    <div class="form-group">
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <div class="form-group">
                            <span style="position: absolute; right: 20%; top: 40%" class="badge bg-secondary"> <?=$intCantidadProgramacionSinConfirmar?> - Sin Confirmar </span>
                        </div>
                    </div>
                    <div class="col-4">
                        <!-- <div class="form-group">
                            <label class="form-label">Linea de despacho</label>
                            <select name="cbxFrecuencia" id="cbxFrecuencia" class="form-control select2" style="width: 100%;">
                                <?= $programacionDiaria->fntOptionLineaDespachoObj(); ?>
                            </select>
                        </div> -->
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                        </div>
                    </div>
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
<?php include 'modal_confirmar_programacion.php' ?>
<!-- /.modal-dialog -->
<?php include '../../../../layout/footer/footercliente4.php' ?>

<script src="calendar.js"> </script>
<script>
    $(function() {
        $('.select2').select2();
        $("#volumen").hide();

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
        
        $('#cbxPedido').on('change', function() {
            $.ajax({
                url: "load_data_pedido.php", // URL
                type: "POST", // Metodo HTTP
                data: {
                    'task': 1,
                    'id_cliente': $('#txtCliente').val(),
                    'id_obra': $('#txtObra').val(),
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

        $('#cbxPedidoEditar').on('change', function() {
            $.ajax({
                url: "load_data_pedido.php", // URL
                type: "POST", // Metodo HTTP
                data: {
                    'task': 1,
                    'id_pedido': $('#cbxPedidoEditar').val()
                },
                dataType: 'json',
                success: function(data) {
                    $("#cbxProductoEditar").html(data.select_producto)
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        });
        
        $('#cbxProducto').on('change', function(){
            $("#volumen").show();
        });

        $("#form_crear_programacion").on('submit', (function(e) {
            e.preventDefault();
            $.ajax({
                url: "php_crear_prog_diaria.php",
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
    });
</script>

</body>

</html>