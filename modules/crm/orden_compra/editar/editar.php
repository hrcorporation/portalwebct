<?php include '../../../../layout/validar_session4.php' ?>
<?php include '../../../../layout/head/head4.php'; ?>
<?php include 'sidebar.php' ?>
<?php
// SE CREAN OBJETOS DE LA CLASE PEDIDOS
$pedidos = new pedidos();
$clsProgramacionSemanal = new clsProgramacionSemanal();
// SE OBTIENE EL ID POR GET
$id = $_GET['id'];
// SE LLAMA UNA FUNCION PARA OBTENER EL CLIENTE Y LA OBRA DEL PEDIDO
$datos = $pedidos->get_nombre_cliente_obra($id);
// SE VA LISTANDO MEDIANTE UN FOREACH
foreach ($datos as $dato) {
    $nombre_orden_compra = $dato['nombre_orden_compra'];
    $nombre_cliente = $dato['nombre_cliente'];
    $nombre_obra = $dato['nombre_obra'];
    $id_cliente = $dato['id_cliente'];
    $id_obra = $dato['id_obra'];
    $plan_maestro = $dato['plan_maestro'];
}

$id_lista_pedidos = $pedidos->get_id_lista_precios($id_cliente, $id_obra);


?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <!-- SE MUESTRA EL ID DEL PEDIDO -->
                    <h5><b>ORDEN DE COMPRA:</b> #<?= $id ?></h5>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">ORDEN DE COMPRA</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div id="contenido">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <!-- SE MUESTRA EL NOMBRE DEL CLIENTE -->
                                <h5><b>CLIENTE:</b> <?= $nombre_cliente ?></h5>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <!-- SE MUESTRA EL NOMBRE DE LA OBRA -->
                                <h5><b>OBRA:</b> <?= $nombre_obra ?></h5>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <h5><b>ORDEN DE COMPRA: </b> <?= $nombre_orden_compra ?></h5>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>PRODUCTOS</label>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-12">
                            <div class="form-group">
                                <button type="button" id="cargar_todo" class="btn btn-block btn-success">
                                    <i class="fas fa-plus"></i> CARGAR TODO
                                </button>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <button type="button" class="btn btn-block btn-info" data-toggle="modal" data-target="#crear_precio_producto">
                                    <i class="fas fa-plus"></i> ADICIONAR PRECIO PRODUCTO
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- TABLA PRECIOS PRODUCTOS PEDIDOS -->
                <table id="table_precio_productos" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>N</th>
                            <th>Status</th>
                            <th>Producto</th>
                            <th>Cantidad m3</th>
                            <th>Saldo m3</th>
                            <th>Precio</th>
                            <th>Observaciones</th>
                            <th>Detalles</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <!-- TABLA PRECIOS BOMBA PEDIDOS -->
            <div class="card-body">
                <div id="contenido">
                    <div class="row">
                        <div class="col-md-9 col-sm-12">
                            <div class="form-group">
                                <label>BOMBEO</label>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <div class="form-group">
                                <button type="button" class="btn btn-block btn-info" data-toggle="modal" data-target="#crear_precio_bomba">
                                    <i class="fas fa-plus"></i> ADICIONAR PRECIO BOMBA
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <table id="table_precio_bomba" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>N</th>
                            <th>Status</th>
                            <th>Tipo de bomba</th>
                            <th>Cant. min</th>
                            <th>Cant. max</th>
                            <th>Precio</th>
                            <th>Observaciones</th>
                            <th>Detalles</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <!-- TABLA PRECIOS SERVICIOS PEDIDOS -->
            <div class="card-body">
                <div id="contenido">
                    <div class="row">
                        <div class="col-md-9 col-sm-12">
                            <div class="form-group">
                                <label>SERVICIOS ADICIONALES</label>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <div class="form-group">
                                <button type="button" class="btn btn-block btn-info" data-toggle="modal" data-target="#crear_precio_servicio_adicional">
                                    <i class="fas fa-plus"></i> ADICIONAR SERVICIO
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <table id="table_precio_servicios" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>N</th>
                            <th>Status</th>
                            <th>Servicio</th>
                            <th>Precio</th>
                            <th>Observaciones</th>
                            <th>Detalles</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
<?php include '../../../../layout/footer/footer4.php' ?>
<?php include 'modal/modal_cargar_precio.php' ?>
<?php include 'modal/modal_crear_precio_producto.php' ?>
<?php include 'modal/modal_crear_precio_bomba.php' ?>
<?php include 'modal/modal_crear_precio_servicio.php' ?>
<?php include 'modal/modal_cargar_precio_codigo.php' ?>
<?php include 'modal/modal_cargar_precio_excel.php' ?>

<script>
    $("#guardarProductoOC").attr('disabled', true);
    $(function() {
        var plan_maestro = Boolean(<?php echo $plan_maestro ?>);
        //var plan_maestro = 0;
        if (plan_maestro) {
            $("#subtotal").removeAttr('disabled');
        } else {
            $("#subtotal").attr('disabled', 'disabled');
        }
        $(".progress").hide();
        $('.select2').select2();
        $("#descuento_oculto").hide();
    });

    $('#id_producto').on('change', function() {
        $("#descuento_oculto").show();
    });

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
        // Formulario Cargar Precios
        $("#form_cargar_precio_servicio").on('submit', (function(e) {
            $('#cargar_precios').modal('toggle');
            e.preventDefault();
            $.ajax({
                url: "php_cargar_precios_pedidos.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    if (data.estado) {
                        toastr.success('Se han cargado los productos exitosamente');
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

    $(document).ready(function() {
        // Formulario Cargar Precios
        $("#cargar_todo").on('click', function() {
            var id_lista_precios = <?php echo $id_lista_pedidos ?>;
            var id_pedido = <?php echo $id ?>;
            var formData = new FormData();
            formData.append('lista_precios', id_lista_precios);
            formData.append('id_pedido', id_pedido);
            $.ajax({
                url: "php_cargar_lista_precios.php",
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    if (data.estado) {
                        toastr.success('Se han cargado los productos exitosamente');
                    } else {
                        toastr.warning(data.errores);
                    }
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        });
    });

    $(document).ready(function() {
        $("#form_crear_precio_producto").on('submit', (function(e) {
            $('#crear_precio_producto').modal('toggle');
            e.preventDefault();
            $.ajax({
                url: "php_crear_precio_producto.php",
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
    });

    $(document).ready(function() {
        $("#form_crear_precio_bomba").on('submit', (function(e) {
            $('#crear_precio_bomba').modal('toggle');
            e.preventDefault();
            $.ajax({
                url: "php_crear_precio_bomba.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    console.log(data);
                    if (data.estado) {
                        toastr.success('Se ha guardado correctamente');
                        table_bomba.ajax.reload();
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

    $(document).ready(function() {
        $("#form_crear_precio_servicio").on('submit', (function(e) {
            $('#crear_precio_servicio_adicional').modal('toggle');
            e.preventDefault();
            $.ajax({
                url: "php_crear_precio_servcicio.php",
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
    });

    $(document).ready(function() {
        var n = 1;
        var id_pedido = <?= $id ?>;
        var table_producto = $('#table_precio_productos').DataTable({
            "ajax": {
                "url": "data_table_productos.php",
                'data': {
                    'id_pedido': id_pedido,
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
                    "data": "status"
                },
                {
                    "data": "codigo_producto"
                },
                {
                    "data": "cantidad_m3"
                },
                {
                    "data": "saldo_m3"
                },
                {
                    "data": "precio_m3"
                },
                {
                    "data": "observaciones"
                },
                {
                    "data": null,
                    "defaultContent": "<a class='btn btn-danger btn-sm' id = 'btn-eliminar'> <i class='fas fa-trash'></i> </a>"
                },
                {
                    "data": null,
                    "defaultContent": "<button class='btn btn-primary btn-sm' id = 'btn-cargar'> Cargar </button>"
                },
            ],
            //"scrollX": true,
        });
        table_producto.on('order.dt search.dt', function() {
            table_producto.column(0, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();
        $('#table_precio_productos tbody').on('click', 'button', function() {
            var data = table_producto.row($(this).parents('tr')).data();
            var id = data['id'];
            window.location = "crear_programacion.php?id_pedido=" + id_pedido + '&id_producto=' + id;
        });

        $('#table_precio_productos tbody').on('click', 'a', function() {
            var data = table_producto.row($(this).parents('tr')).data();
            var id = data['id'];
            Swal.fire({
                title: '¿Esta Seguro(a) que desea eliminar el producto?', // mensaje de la alerta                                                               
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
                        url: "php_eliminar_producto.php",
                        type: "POST",
                        data: {
                            task: 1,
                            id: id,
                        },
                        success: function(response) {
                            if (response.estado) {
                                Swal.fire(
                                    'El producto fue eliminado correctamente',
                                )
                                table_producto.ajax.reload();
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
            table_producto.ajax.reload(null, false);
        }, 5000);
    });

    $(document).ready(function() {
        var n = 1;
        var id_pedido = <?= $id ?>;
        var table_bomba = $('#table_precio_bomba').DataTable({
            "ajax": {
                "url": "data_table_bomba.php",
                'data': {
                    'id_pedido': id_pedido,
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
                    "data": "status"
                },
                {
                    "data": "nombre_tipo_bomba"
                },
                {
                    "data": "min_m3"
                },
                {
                    "data": "max_m3"
                },
                {
                    "data": "precio"
                },
                {
                    "data": "observaciones"
                },
                {
                    "data": null,
                    "defaultContent": "<button class='btn btn-danger btn-sm' id = 'btn-eliminar'> <i class='fas fa-trash'></i> </button>"
                }
            ],
            //"scrollX": true,
        });
        table_bomba.on('order.dt search.dt', function() {
            table_bomba.column(0, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();
        $('#table_precio_bomba tbody').on('click', 'button', function() {
            var data = table_bomba.row($(this).parents('tr')).data();
            var id = data['id'];
            Swal.fire({
                title: '¿Esta Seguro(a) que desea eliminar la bomba?', // mensaje de la alerta
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
                        url: "php_eliminar_bomba.php",
                        type: "POST",
                        data: {
                            task: 1,
                            id: id,
                        },
                        success: function(response) {
                            if (response.estado) {
                                Swal.fire(
                                    'La bomba fue eliminada correctamente',
                                )
                                table_bomba.ajax.reload();
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
            table_bomba.ajax.reload(null, false);
        }, 5000);
    });

    $(document).ready(function() {
        var n = 1;
        var id_pedido = <?= $id ?>;
        var table = $('#table_precio_servicios').DataTable({
            "ajax": {
                "url": "data_table_servicios.php",
                'data': {
                    'id_pedido': id_pedido,
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
                    "data": "status"
                },
                {
                    "data": "nombre_tipo_servicio"
                },
                {
                    "data": "precio"
                },
                {
                    "data": "observaciones"
                },
                {
                    "data": null,
                    "defaultContent": "<button class='btn btn-danger btn-sm' id = 'btn-eliminar'> <i class='fas fa-trash'></i> </button>"
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
        $('#table_precio_servicios tbody').on('click', 'button', function() {
            var data = table.row($(this).parents('tr')).data();
            var id = data['id'];
            Swal.fire({
                title: '¿Esta Seguro(a) que desea eliminar el servicio?', // mensaje de la alerta
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
                        url: "php_eliminar_servicios.php",
                        type: "POST",
                        data: {
                            task: 1,
                            id: id,
                        },
                        success: function(response) {
                            if (response.estado) {
                                Swal.fire(
                                    'El servicio fue eliminado correctamente',
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
        }, 5000);
    });

    $('#id_producto').change(function() {
        var subtotal = $("#subtotal").val();
        var id_lista_precios = <?php echo $id_lista_pedidos ?>;
        $("#guardarProductoOC").attr('disabled', false);
        $.ajax({
            url: "ajax_get_data_precios.php",
            type: "POST",
            data: {
                task: 1,
                id_producto: $("#id_producto").val(),
                descuento: $('#descuento').val(),
                id_lista_precios: id_lista_precios,
            },
            success: function(response) {
                if (response.estado) {
                    $("#subtotal").val(response.subtotal);
                } else {
                    toastr.warning(response.msg);
                }
            },
            error: function(respuesta) {
                alert(JSON.stringify(respuesta));
            },
        });
    });

    $('#descuento').change(function() {
        var subtotal = $("#subtotal").val();
        $.ajax({
            url: "ajax_get_data_precios.php",
            type: "POST",
            data: {
                task: 1,
                id_producto: $('#id_producto').val(),
                descuento: $('#descuento').val(),
            },
            success: function(response) {
                if (response.estado) {
                    $("#subtotal").val(response.subtotal);
                } else {
                    toastr.warning(response.msg);
                }
            },
            error: function(respuesta) {
                alert(JSON.stringify(respuesta));
            },
        });
    });

    $("#id_select_producto").change(function() {
        var producto = $("#id_select_producto").val();
        console.log(producto);
        if (producto == 1) {
            $("#file_productos").attr('disabled', false);
            $("#form_productos").on('submit', (function(e) {
                $('#cargar_excel').modal('toggle');
                e.preventDefault();
                $.ajax({
                    url: "../importar_productos/ajax_productos_uno.php",
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
                        //location.reload();
                    }
                });
            }));
        } else if (producto == 2) {
            $("#file_productos").attr('disabled', false);
            $("#form_productos").on('submit', (function(e) {
                e.preventDefault();
                $.ajax({
                    url: "../importar_productos/ajax_productos_dos.php",
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
                        //location.reload();
                    }
                });
            }));
        } else {
            $("#file_productos").attr('disabled', true);
        }
    });

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
</script>