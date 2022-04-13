<?php include '../../../../layout/validar_session4.php' ?>
<?php include '../../../../layout/head/head4.php'; ?>
<?php include 'sidebar.php' ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>PEDIDOS</h1>
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
    <section class="content">
        <?php
        $pedidos = new pedidos();
        $id = $_GET['id'];
        ?>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">PEDIDOS</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div id="contenido">
                    <div class="row">
                        <div class="col-md-3 col-sm-12">
                            <div class="form-group">
                                <button type="button" class="btn btn-block btn-info" data-toggle="modal" data-target="#cargar_precios">
                                    CARGAR PRECIOS
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-9 col-sm-12">
                            <div class="form-group">
                                <label>PRODUCTOS</label>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <div class="form-group">
                                <button type="button" class="btn btn-block btn-info" data-toggle="modal" data-target="#crear_precio_producto">
                                    ADICIONAR PRECIO PRODUCTO
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <table id="table_precio_productos" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>N</th>
                            <th>Producto</th>
                            <th>%</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Detalles</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <!-- Default box -->
            <div class="modal fade" id="crear_precio_producto">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">ADICIONAR PRECIO PRODUCTO</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form name="form_crear_precio_producto" id="form_crear_precio_producto" method="post">
                                <input type="hidden" name="id" id="id" value="<?= $id ?>">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="id_producto">Producto</label>
                                            <select class="select2 form-control" name="id_producto" id="id_producto">
                                                <?= $pedidos->select_productos(); ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="descuento">Descuento</label>
                                            <input type="number" name="descuento" id="descuento" class="form-control" required="true" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="subtotal">Subtotal</label>
                                            <input type="number" name="subtotal" id="subtotal" class="form-control" required="true" disabled="true" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="cantidad">Cantidad m3</label>
                                            <input type="number" name="cantidad" id="cantidad" class="form-control" value="0" />
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
                                    ADICIONAR PRECIO BOMBEO
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <table id="table_precio_bomba" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>N</th>
                            <th>Tipo de bomba</th>
                            <th>Cant. min</th>
                            <th>Cant. max</th>
                            <th>Precio</th>
                            <th>Detalles</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <!-- Default box -->
            <div class="modal fade" id="crear_precio_bomba">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">ADICIONAR PRECIO BOMBA</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form name="form_crear_precio_bomba" id="form_crear_precio_bomba" method="post">
                                <input type="hidden" name="id" id="id" value="<?= $id ?>">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="id_tipo_bomba">Tipo de bomba</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <select class="select2 form-control" name="id_tipo_bomba" id="id_tipo_bomba">
                                                <?= $pedidos->select_bomba(); ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="rango">Rango M3</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="minimo">Minimo</label>
                                            <input type="number" name="minimo" id="minimo" class="form-control" required="true" />
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="maximo">Maximo</label>
                                            <input type="number" name="maximo" id="maximo" class="form-control" required="true" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="precio">Precio</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <input type="number" name="precio" id="precio" class="form-control" required="true" />
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
                                    ADICIONAR SERVICIO ADICIONAL
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <table id="table_precio_servicios" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>N</th>
                            <th>Servicio</th>
                            <th>Precio</th>
                            <th>Detalles</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <!-- Default box -->
            <div class="modal fade" id="crear_precio_servicio_adicional">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">ADICIONAR PRECIO SERVICIO ADICIONAL</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form name="form_crear_precio_servicio" id="form_crear_precio_servicio" method="post">
                                <input type="hidden" name="id" id="id" value="<?= $id ?>">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="id_tipo_servicio">Tipo de servicio</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <select class="select2 form-control" name="id_tipo_servicio" id="id_tipo_servicio">
                                                <?= $pedidos->select_servicio() ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="precio">Precio</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <input type="number" name="precio" id="precio" class="form-control" required="true" />
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
            <div class="modal fade" id="cargar_precios">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">CARGAR PRECIOS</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form name="form_cargar_precio_servicio" id="form_cargar_precio_servicio" method="post">
                                <input type="hidden" name="id_pedido_cargar" id="id_pedido_cargar" value="<?= $id ?>">

                                <div class="row">
                                <div class="col">
                                        <div class="form-group">
                                            <label for="codigo_pedido_existente">Digite el Codigo del pedido existente para cargar los datos</label>
                                            <input type="text" name="txt_cod_load" id="txt_cod_load" class="form-control">
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
        </div>
    </section>
</div>
<?php include '../../../../layout/footer/footer4.php' ?>

<script>
    $(function() {
        $(".progress").hide();
        $('.select2').select2();
    });

    $(document).ready(function() {
         // Formulacio Cargar Precios
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
                        toastr.success('Se ha Cargado los precios correctamente');
                    } else {
                        toastr.warning(data.errores);
                    }
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        }));
        
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
    })

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
                    } else {
                        toastr.warning(data.errores);
                    }
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        }));
    })

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
    })

    $(document).ready(function() {
        var n = 1;
        var id_pedido = <?= $id ?>;
        var table = $('#table_precio_productos').DataTable({
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
                    "data": "codigo_producto"
                },
                {
                    "data": "porcentaje_descuento"
                },
                {
                    "data": "cantidad_m3"
                },
                {
                    "data": "precio_m3"
                },
                {
                    "data": null,
                    "defaultContent": "<button class='btn btn-warning btn-sm'> <i class='fas fa-edit'></i> </button>"
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
        $('#table_precio_productos tbody').on('click', 'button', function() {
            var data = table.row($(this).parents('tr')).data();
            var id = data['id'];
            window.location = "update/editar.php?id=" + id;
        });
        setInterval(function() {
            table.ajax.reload(null, false);
        }, 10000);
    })

    $(document).ready(function() {
        var n = 1;
        var id_pedido = <?= $id ?>;
        var table = $('#table_precio_bomba').DataTable({
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
                    "data": null,
                    "defaultContent": "<button class='btn btn-warning btn-sm'> <i class='fas fa-edit'></i> </button>"
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
        $('#table_precio_bomba tbody').on('click', 'button', function() {
            var data = table.row($(this).parents('tr')).data();
            var id = data['id'];
            window.location = "update/editar.php?id=" + id;
        });
        setInterval(function() {
            table.ajax.reload(null, false);
        }, 10000);
    })

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
                    "data": "nombre_tipo_servicio"
                },
                {
                    "data": "precio"
                },
                {
                    "data": null,
                    "defaultContent": "<button class='btn btn-warning btn-sm'> <i class='fas fa-edit'></i> </button>"
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
        $('#table_precio_bomba tbody').on('click', 'button', function() {
            var data = table.row($(this).parents('tr')).data();
            var id = data['id'];
            window.location = "update/editar.php?id=" + id;
        });
        setInterval(function() {
            table.ajax.reload(null, false);
        }, 10000);
    })


    $('#id_producto').change(function() {
        var subtotal = $("#subtotal").val();

        $.ajax({
            url: "ajax_get_data_precios.php",
            type: "POST",
            data: {
                task: 1,
                id_producto: $('#id_producto').val(),
            },
            success: function(response) {
                toastr.success('bien');
                $("#subtotal").val(response.subtotal);

            },
            error: function(respuesta) {
                alert(JSON.stringify(respuesta));
            },

        });
    })
</script>