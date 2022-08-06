<?php include '../../../layout/validar_session3.php'; ?>
<?php include '../../../layout/head/head3.php'; ?>
<?php include 'sidebar.php'; ?>
<?php $clsProgramacionDiaria = new clsProgramacionDiaria(); //Se crea un objeto de la clase programacion 
?>
<?php $intCantidadProgramacionSinConfirmar = $clsProgramacionDiaria->fntContarProgramacionesSinConfirmarFuncionarioObj(); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>PROGRAMACION DIARIA</h1>
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
                <h3 class="card-title">VER PROGRAMACIONES DIARIAS</h3>
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
                            <span style="position: absolute; right: 20%; top: 40%" class="badge bg-secondary">
                                <?= $intCantidadProgramacionSinConfirmar ?> - Sin Confirmar
                            </span>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label class="form-label">Linea de despacho</label>
                            <select name="cbxFrecuencia" id="cbxFrecuencia" class="form-control select" style="width: 100%;">
                                <?= $clsProgramacionDiaria->fntOptionLineaDespachoObj() ?>
                            </select>
                        </div>
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
<?php include 'modal/modal_crear_programacion.php' ?>
<?php include 'modal/modal_editar_programacion.php' ?>
<?php include 'modal/modal_confirmar_programacion.php' ?>
<?php include 'modal/modal_informativo.php' ?>

<!-- /.modal-dialog -->

<?php include '../../../layout/footer/footer3.php' ?>

<script src="calendar.js"></script>
<script>
    $(function() {
        $('.validanumericos').keypress(function(e) {
                if (isNaN(this.value + String.fromCharCode(e.charCode)))
                    return false;
            })
            .on("cut copy paste", function(e) {
                e.preventDefault();
            });
    });

    $(document).ready(function() {
        $('.select').select2();
    });

    $("#volumen").hide();
    //Validar que la cantidad de m3 no exceda al que esta en el pedido al crear la programacion semanal
    $('#txtCant').on('change', function() {
        //Ajax 
        var formData = new FormData();
        formData.append('pedido', $("#cbxPedido").val());
        formData.append('producto', $("#cbxProducto").val());
        formData.append('cantidad', $("#txtCant").val());
        $.ajax({
            url: "validar_cantidad.php", // URL
            type: "POST", // Metodo HTTP
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                console.log(data);
                if (data.estado) {
                    $("#btnCrear").attr('disabled', false);
                } else {
                    toastr.warning("La cantidad excede la del pedido");
                    $("#btnCrear").attr('disabled', true);
                }
            },
            error: function(respuesta) {
                alert(JSON.stringify(respuesta));
            },
        });
    });
    //Validar que la cantidad de m3 no exceda al que esta en el pedido. al editar la programacion semanal.
    $('#txtCantEditar').on('change', function() {
        //Ajax 
        var formData = new FormData();
        formData.append('pedido', $("#cbxPedidoEditar").val());
        formData.append('producto', $("#cbxProductoEditar").val());
        formData.append('cantidad', $("#txtCantEditar").val());
        $.ajax({
            url: "validar_cantidad.php", // URL
            type: "POST", // Metodo HTTP
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                console.log(data);
                if (data.estado) {
                    $("#btnEditar").attr('disabled', false);
                } else {
                    toastr.warning('La cantidad excede los metros cubicos que estan en el pedido');
                    $("#btnEditar").attr('disabled', true);
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
            //data: formData,
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
            //data: formData,
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
                } else {
                    toastr.warning(data.errores);
                }
            },
            error: function(respuesta) {
                alert(JSON.stringify(respuesta));
            },
        });
    }));

    $("#form_mostrar_programacion").on('submit', (function(e) {
        e.preventDefault();
        $.ajax({
            url: "php_editar_prog_diaria.php",
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
</script>
</body>

</html>