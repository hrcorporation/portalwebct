<?php include '../../../layout/validar_session3.php' ?>
<?php include '../../../layout/head/head3.php'; ?>
<?php include 'sidebar.php'; ?>
<!-- Se crea un objeto de la clase clsProgramacionSemanal -->
<?php $clsProgramacionSemanal = new clsProgramacionSemanal(); ?>
<!-- La cantidad de programaciones semanales sin confirmar por el cliente -->
<?php $intCantidadProgramacionSinConfirmar = $clsProgramacionSemanal->fntContarProgramacionesSinConfirmarObj(); ?>
<!-- La cantidad de programaciones por cargar por parte del funcionario -->
<?php $intCantidadProgramacionPorCargar = $clsProgramacionSemanal->fntContarProgramacionesPorCargarObj(); ?>
<!-- La cantidad de programaciones confirmadas por parte del funcionario -->
<?php $intCantidadProgramacionConfirmadas = $clsProgramacionSemanal->fntContarProgramacionesConfirmadasObj(); ?>
<!-- La cantidad de programaciones ya ejecutadas -->
<?php $intCantidadProgramacionEjecutadas = $clsProgramacionSemanal->fntContarProgramacionesEjecutadasObj(); ?>
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
                    <span class="badge bg-secondary" title='Programaciones sin confirmar por parte del cliente, cuando el cliente registra su programacion.'><?= $intCantidadProgramacionSinConfirmar ?> - Sin Confirmar</span>
                    <span class="badge bg-warning" title='Programaciones sin confirmar por parte del funcionario, cuando el cliente confirma y envia al area de logistica de Concre Tolima.'><?= $intCantidadProgramacionPorCargar ?> - Por Confirmar</span>
                    <span class="badge bg-info" title='Programaciones confirmadas por el area de logistica de Concre Tolima y anexadas a la programacion diaria.'><?= $intCantidadProgramacionConfirmadas ?> - Confirmadas</span>
                    <span class="badge bg-success" title='Programaciones ejecutadas.'><?= $intCantidadProgramacionEjecutadas ?> - Ejecutadas</span>
                    <button style="position: absolute; right: 65%; top: 12.2%" class="btn btn-success" id="btnModalConfirmarProgramacion" title='Cargar todas las programaciones de la proxima semana' data-toggle="modal" data-target="#modal_cargar_programacion"> Confirmar programación </button>
                    <button style="position: absolute; right: 25%; top: 12.2%" class="btn btn-warning" id="btnModalCambiarHoraLimite" title='Cambiar la hora limite para modificar la programacion el dia sabado' data-toggle="modal" data-target="#modal_cambiar_hora"> Cambiar hora limite </button>
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
<?php include 'modal/modal_cargar_programacion.php' ?>
<?php include 'modal/modal_confirmar_programacion.php' ?>
<?php include 'modal/modal_informativo.php' ?>
<?php include 'modal/modal_cambiar_hora.php' ?>
<!-- /.modal-dialog -->
<?php include '../../../layout/footer/footer3.php' ?>
<script src="calendar.js"> </script>
<script>
    $(function() {
        //Ocultar el input del volumen o cantidad de m3
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
        //Al seleccionar el cliente se lista las obras que estan relacionadas con el cliente seleccionado a la hora de crear una programacion semanal.
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
        //Al seleccionar el cliente se lista las obras que estan relacionadas con el cliente seleccionado a la hora de editar una programacion semanal.
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
        //Al seleccionar la obra se lista todos los pedidos que estan relacionadas con el cliente y obra seleccionado a la hora de crear una programacion semanal.
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
        //Al seleccionar la obra se lista todos los pedidos que estan relacionadas con el cliente y obra seleccionado a la hora de editar una programacion semanal.
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
        //Al seleccionar el pedido se lista todos los productos que estan relacionadas con el pedido seleccionado a la hora de crear una programacion semanal.
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
        //Al seleccionar el pedido se lista todos los productos que estan relacionadas con el pedido seleccionado a la hora de editar una programacion semanal.
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
        //Al seleccionar el producto se habilita el input para ingresar el volumen o cantidad de m3.
        $('#cbxProducto').on('change', function() {
            $("#volumen").show();
        });
        //Al dar click al checkbox se despliega una lista diferente de tipo de descargue a la hora de crear una programacion semanal.
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
        //Al dar click al checkbox se despliega una lista diferente de tipo de descargue a la hora de editar una programacion semanal.
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
        //Para crear una programacion semanal.
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
        //Para editar una programacion semanal.
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
                    } else {
                        toastr.warning(data.errores);
                    }
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        }));
        //para actualizar la hora de plazo para que el cliente pueda crear o editar alguna programacion el dia sabado.
        $("#form_cambiar_hora").on('submit', (function(e) {
            e.preventDefault();
            $.ajax({
                url: "php_cambiar_hora.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    console.log(data);
                    if (data.estado) {
                        toastr.success('Se ha guardado correctamente');
                        $('#modal_cambiar_hora').modal('hide');
                    } else {
                        toastr.warning(data.errores);
                        $('#modal_cambiar_hora').modal('hide');
                    }
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        }));
        //Para cargar la programacion semanal la cual el cliente hizo la confirmacion.
        $("#form_cargar_programacion").on('submit', (function(e) {
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
                        $('#modal_cargar_programacion').modal('hide');
                    } else {
                        toastr.warning(data.errores);
                        $('#modal_cargar_programacion').modal('hide');
                    }
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        }));

        // Do this before you initialize any of your modals
        $.fn.modal.Constructor.prototype.enforceFocus = function() {
            
        };
    });
</script>
</body>

</html>