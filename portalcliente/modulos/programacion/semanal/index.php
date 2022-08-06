<?php include '../../../../layout/validar_session_cliente4.php' ?>
<?php include '../../../../layout/head/headcliente4.php' ?>
<?php include 'sidebar.php' ?>
<?php
$id_cliente = $_GET['id_cliente'];
$id_obra = $_GET['id_obra'];
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
                        <strong> <?php echo $_SESSION['nombre_usuario']; ?> </strong> Bienvenido al <strong style="color:#ac4661">PORTAL DE CLIENTES</strong>
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
                <button class="btn btn-success" id="btnAceptarTodaProgramacion" data-toggle="modal" data-target="#modal_aceptar_toda_programacion">
                    Aceptar y enviar
                </button>
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
<?php include 'modal/modal_aceptar_programacion.php' ?>
<?php include 'modal/modal_aceptar_toda_programacion.php' ?>
<?php include 'modal/modal_alerta_cupo.php' ?>


<!-- /.modal-dialog -->
<?php include '../../../../layout/footer/footercliente4.php' ?>

<script src="calendar.js"> </script>
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

    $(function() {
        //Ocultar el campo de volumen
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
        //Modificar o eliminar programacion semanal
        $("#form_mostrar_programacion").on('submit', (function(e) {
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
                        $('#modal_aceptar_programacion').modal('show');
                    } else {
                        toastr.warning(data.errores);
                    }
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        }));
        //Crear programacion semanal
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
        //Aceptar programacion y cambiar estado a (Por confirmar)
        $("#form_aceptar_toda_programacion").on('submit', (function(e) {
            e.preventDefault();
            $.ajax({
                url: "php_cambiar_estado.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    console.log(data);
                    if (data.estado) {
                        toastr.success('Se ha guardado correctamente');
                        $('#modal_aceptar_toda_programacion').modal('hide');
                    } else {
                        toastr.warning(data.errores);
                        $('#modal_aceptar_toda_programacion').modal('hide');
                    }
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        }));
        //Validar si esta activado el checkbox o no a la hora de crear una programacion semanal.
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
        //Validar si esta activado el checkbox o no a la hora de modificar una programacion semanal.
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
        //Validar si se selecciono algun pedido para que le liste todos los productos que estan relacionados con el pedido a la hora de crear una programacion semanal.
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
        //Validar si se selecciono algun pedido para que le liste todos los productos que estan relacionados con el pedido a la hora de modificar una programacion semanal.
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
        //Validar que se seleccione algun producto para habilitar el campo de volumen.
        $('#cbxProducto').on('change', function() {
            $("#volumen").show();
        });
    });
</script>

</body>

</html>