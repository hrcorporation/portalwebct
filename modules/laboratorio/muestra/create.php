<?php include '../../../layout/validar_session3.php' ?>
<?php include '../../../layout/head/head3.php'; ?>
<?php include 'sidebar_crear.php' ?>

<?php require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php'; ?>
<?php
?>
<script>
    function sumarDias(fecha, dias) {
        var new_fecha = new Date();
        new_fecha.setDate(fecha.getDate() + dias);
        return new_fecha;
    }

    function updateInput(n_dia) {
        var fecha = new Date();

        var new_fecha = sumarDias(fecha, parseInt(n_dia));
        //console.log(sumarDias(fecha, parseInt(n_dia)));

        fecha_new.innerText = (new_fecha.getDate()) + "/" + (new_fecha.getMonth() + 1) + "/" + new_fecha.getFullYear();
        return new_fecha;
    }
</script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
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
                <h3 class="card-title"> Crear </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>

                </div>
            </div>
            <div class="card-body">
                <div id="contenido">

                    <form id="form_crear_muestra" name="form_crear_muestra" method="post">
                        <input id="id_remision" name="id_remision" type="hidden">
                        <div class="row">
                            <div class="col-2">
                                <div class="form-group">
                                    <label>Fecha</label>
                                    <input type="text" class="form-control" id="fecha_remision" name="fecha_remision" readonly="true">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label>Hora</label>
                                    <input type="text" class="form-control" id="hora" name="hora">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label>Codigo Remision</label>
                                    <input type="text" class="form-control" id="cod_remision" name="cod_remision" readonly="true">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label>Mixer</label>
                                    <input type="hidden" name="id_mixer" id="id_mixer">
                                    <input type="text" class="form-control" id="placa_mixer" name="placa_mixer" readonly="true">
                                </div>
                            </div>
                            <div class="col-1">
                                <div class="form-group">
                                    <label>Cantidad</label>

                                    <input type="text" class="form-control" id="cantidad" name="cantidad" readonly="true">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Tipo de Muestra </label>
                                    <select name="tipo_muestra" id="tipo_muestra" class="select2 form-control">
                                        <option value="1">Cilindro</option>
                                        <option value="2">Viga</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <h5>Cliente</h5>
                                    <input type="hidden" name="id_cliente" id="id_cliente" class="form-control">
                                    <input type="text" name="cliente" id="cliente" class="form-control" readonly="true">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <h5>Obra</h5>
                                    <input type="hidden" name="id_obra" id="id_obra" class="form-control">
                                    <input type="text" name="obra" id="obra" class="form-control" readonly="true">
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <h5>producto</h5>
                                    <input type="hidden" name="id_producto" id="id_producto" class="form-control">
                                    <input type="text" name="producto" id="producto" class="form-control" readonly="true" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <button type="submit" id="btn_crear_muestra" class="btn btn-info form-control">Crear y Seguir</button>
                                </div>
                            </div>
                        </div>

                    </form>
                    <br>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <button type="button" id="btn_modal_dias_fallo" class="btn btn-info" data-toggle="modal" data-target="#modal-default">Adicionar Dias de fallo de compresion</button>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="modal-default">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Adicionar Dias de Fallo Compresion</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form name="form_crear_cant" id="form_crear_cant" method="post">

                                        <div class="row">
                                            <div class="col">
                                                <label>Codigo Muestra</label>
                                                <input type="text" class="form-control" id="Z" name="codigo_muestra" />
                                            </div>
                                            <div class="col">
                                                <label>Cantidad</label>
                                                <input type="text" class="form-control" id="n_muestra" name="n_muestra" required />
                                            </div>
                                            <div class="col">
                                                <label>Dia</label>
                                                <input type="number" class="form-control" id="n_dias" name="n_dias" onchange="updateInput(value)" required>
                                            </div>
                                            <div class="col">
                                                <label>Fecha</label>
                                                <H3><span id="fecha_new"></span></H3>

                                            </div>
                                            <div class="col">
                                                <button type="submit" class="btn btn-success form-control">Guardar </button>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="row">
                                        <div class="col">
                                            <table id="tabla_cant_muestra" class="display" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>N</th>
                                                        <th>Codigo</th>
                                                        <th>Cantidad</th>
                                                        <th>Dia</th>
                                                        <th>Fecha</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-info" id="cargar_data">Cargar Datos</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <form name="form_insert_data" id="form_insert_data" method="post">
                        <input type="hidden" name="id_muestra" id="id_muestra" />
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Cementante</label>
                                    <input type="text" name="cementante" id="cementante" class="form-control" />
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>m3 Muestra</label>
                                    <input type="text" name="m3" id="m3" class="form-control" />
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Asentamiento</label>
                                    <input type="text" name="asentamiento" id="asentamiento" class="form-control" />
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Temperatura</label>
                                    <input type="text" name="temperatura" id="temperatura" class="form-control" />
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Aire</label>
                                    <input type="text" name="aire" id="aire" class="form-control" />
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Rend Volumetrico</label>
                                    <input type="text" name="rend_volumetrico" id="rend_volumetrico" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-info form-control">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <br>
                    <!-- Button trigger modal -->
                    <div class="row">
                        <div class="col">
                            <table id="t_remisiones" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>N</th>
                                        <th>Fecha</th>
                                        <th>Codigo</th>
                                        <th>Cliente</th>
                                        <th>Obra</th>
                                        <th>Producto</th>
                                        <th>Metros</th>
                                        <th>Mixer</th>
                                        <th style="width:100px">Detalle</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfooter>
                                    <tr>
                                        <th>N</th>
                                        <th>Fecha</th>
                                        <th>Codigo</th>
                                        <th>Cliente</th>
                                        <th>Obra</th>
                                        <th>Producto</th>
                                        <th>Metros</th>
                                        <th>Mixer</th>
                                        <th style="width:100px">Detalle</th>
                                    </tr>
                                </tfooter>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- </form> -->
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">

        </div>
</div>
</section>
</div>

<?php include '../../../layout/footer/footer3.php' ?>

<script>
    $(document).ready(function() {
        // ==============================================================
        // Funciones 
        // ==============================================================

        //Funciones Tabla Dia Muestra
        function datatable_dia_muestra(id_muestra) {
            var table_dia_muestra = $('#tabla_cant_muestra').DataTable({
                //"processing": true,
                //"scrollX": true,
                "ajax": {
                    "url": "datatable_dias.php",
                    'data': {
                        'id_muestra': id_muestra,
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
                        "data": "cod_muestra"
                    },
                    {
                        "data": "cant_muestra"
                    },
                    {
                        "data": "dia"
                    },
                    {
                        "data": "fecha"
                    },
                    {
                        "data": null,
                        "defaultContent": "<button class='btn btn-danger  btn-sm btn_eliminar_dia'> <i class='fas fa-hand-point-up'></i> </button>"
                    }
                ],
                'paging': false,
                'searching': false
                //"scrollX": true,
            });
            table_dia_muestra.on('order.dt search.dt', function() {
                table_dia_muestra.column(0, {
                    search: 'applied',
                    order: 'applied'
                }).nodes().each(function(cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();
            table_dia_muestra.ajax.reload();
            return table_dia_muestra;
        }
        // Accion Boton Tabla Ver Remision
        $('#tabla_cant_muestra tbody').on('click', 'button.btn_eliminar_dia', function() {
            var data = table_dia_muestra.row($(this).parents('tr')).data();
            console.log(data);
            var id = data['id'];
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })
            swalWithBootstrapButtons.fire({
                title: 'Esta Seguro de eliminar?',
                //text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Si, Eliminar',
                cancelButtonText: 'No, Cancelar',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    //php_eliminar_dia_muestra.php

                    $.ajax({
                        url: "php_eliminar_dia_muestra.php",
                        type: "POST",
                        data: {
                            id: data['id'],
                        },
                        success: function(data) {
                            swalWithBootstrapButtons.fire(
                                'Eliminado Correctamente',
                                'success'
                            )
                        },
                        error: function(respuesta) {
                            alert(JSON.stringify(respuesta));
                        },
                    });

                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelado',
                        '',
                        'error'
                    )
                }
            })
        });

        // Declarar funcion destruir tabla
        function destruir_tabla() {
            var table_dia_muestra = $('#tabla_cant_muestra').DataTable();
            table_dia_muestra.destroy();
        }
        // ==============================================================
        // ==============================================================
        // Tabla dia muestra
        // ==============================================================
        var n = 1;
        //var id_muestra = $("#id_remision").val();
        $("#btn_modal_dias_fallo").click(function() {
            var id_muestra = $("#id_muestra").val();
            if ($.fn.dataTable.isDataTable('#tabla_cant_muestra')) {
                table_dia_muestra = $('#tabla_cant_muestra').DataTable();
                table_dia_muestra.destroy();
            }
            table_dia_muestra = datatable_dia_muestra(id_muestra);

            setInterval(function() {
                table_dia_muestra.ajax.reload(null, false);
            }, 5000);

        })

        // Accion Boton Cargar data
        $("#cargar_data").click(function() {

            $.ajax({
                url: "php_cargar_dias.php",
                type: "POST",
                data: {
                    id_muestra: $("#id_muestra").val(),
                    codigo_muestra: $("#codigo_muestra").val(),
                },

                success: function(data) {

                    const datos_errores = Object.values(data.errores);
                    const datos_msg = Object.values(data.msg);


                    if (data.estado) {
                        for (let indexh = 0; indexh < datos_msg.length; indexh++) {
                            toastr.success(data.msg[indexh]);
                        }
                    } else {
                        for (let index = 0; index < datos_errores.length; index++) {
                            toastr.warning(data.errores[index]);
                        }
                    }
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
            if ($.fn.dataTable.isDataTable('#tabla_cant_muestra')) {
                table_dia_muestra = $('#tabla_cant_muestra').DataTable();
                table_dia_muestra.destroy();
            }
            table_dia_muestra = datatable_dia_muestra($("#id_muestra").val());
        });
        // ==============================================================
        // ==============================================================
        // Tabla Remisiones
        // ==============================================================

        // Funcion tabla Remisiones
        var table_remisiones = $('#t_remisiones').DataTable({
            //"processing": true,
            //"scrollX": true,
            "ajax": {
                "url": "datatable_remisiones.php",
                "dataSrc": ""
            },
            "order": [
                [0, 'desc']
            ],
            "columns": [{
                    "data": "id_remision"
                },
                {
                    "data": "fecha_remi"
                },
                {
                    "data": "codigo_remi"
                },
                {
                    "data": "nombre_cliente"
                },
                {
                    "data": "nombre_obra"
                },
                {
                    "data": "producto"
                },
                {
                    "data": "metros"
                },
                {
                    "data": "placa"
                },
                {
                    "data": null,
                    "defaultContent": "<button class='btn btn-info get_remi  btn-sm'> <i class='fas fa-hand-point-up'></i> </button><button class='btn btn-success ver_remi btn-sm'> <i class='fas fa-eye'></i> </button>"
                }
            ],
            //"scrollX": true,
        });
        table_remisiones.on('order.dt search.dt', function() {
            table_remisiones.column(0, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();

        // Accion Boton Tabla Ver Remision
        $('#t_remisiones tbody').on('click', 'button.ver_remi', function() {
            var data = table_remisiones.row($(this).parents('tr')).data();
            var id = data['id_remision'];
            window.location = "ver_remision/remision.php?id=" + id;
        });

        // Accion Boton Tabla  Traer datatos de Remision
        $('#t_remisiones tbody').on('click', 'button.get_remi', function() {
            var data = table_remisiones.row($(this).parents('tr')).data();
            var id = data['id_remision'];
            $("#id_remision").val(data['id_remision']);
            $("#cod_remision").val(data['codigo_remi']);
            $("#id_cliente").val(data['id_cliente']); // id cliente
            $("#cliente").val(data['nombre_cliente']);
            $("#id_mixer").val(data['id_mixer']); // id mixer
            $("#placa_mixer").val(data['placa']); // placa mixer
            $("#id_obra").val(data['id_obra']); // id obra
            $("#obra").val(data['nombre_obra']);
            $("#id_producto").val(data['id_producto']); // id producto
            $("#producto").val(data['codproducto'] + ' - ' + data['producto']);
            $("#cantidad").val(data['metros']); // metros
            $("#fecha_remision").val(data['fecha_remi']); // fecha
            $("#hora").val('<?php echo date('H:i:s'); ?>'); // hora
        });

        // ==============================================================
        // Fin Tabla Remisiones
        // ==============================================================

        var id_muestra = $("#id_muestra").val();
        if ($.fn.dataTable.isDataTable('#tabla_cant_muestra')) {
            var table_dia_muestra = $('#tabla_cant_muestra').DataTable();
            table_dia_muestra.destroy();
        }
        var table_dia_muestra = datatable_dia_muestra(id_muestra);

        setInterval(function() {
            table_remisiones.ajax.reload(null, false);
        }, 5000);
    });
</script>
<script>
    $(document).ready(function() {
        $('.select2').select2();

    });
    $(document).ready(function() {

        // Crear Muestra
        $("#form_insert_data").hide();
        $("#btn_modal_dias_fallo").hide();
        $("#form_crear_muestra").on('submit', (function(e) {

            e.preventDefault();
            $.ajax({
                url: "php_crear_muestra.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    const datos_errores = Object.values(data.errores);
                    const datos_msg = Object.values(data.msg);
                    console.log(data.estado);
                    console.log(datos_errores);
                    console.log(datos_msg);
                    if (data.estado) {
                        for (let indexh = 0; indexh < datos_msg.length; indexh++) {
                            toastr.success(data.msg[indexh]);
                        }
                        $("#form_insert_data").show();
                        $("#btn_modal_dias_fallo").show();
                        $("#btn_crear_muestra").hide();
                        $("#id_muestra").val(data.id_muestra);
                        $("#codigo_muestra").val(data.id_muestra);

                        $("#asentamiento").val(data.asentamiento);
                        $("#temperatura").val(data.temperatura);
                        let id_muestra = data.id_muestra;
                    } else {
                        for (let index = 0; index < datos_errores.length; index++) {
                            toastr.warning(data.errores[index]);
                        }
                    }
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        }));

        // Adicionar datos de las muestras temperatura asentamiento
        $("#form_insert_data").on('submit', (function(e) {
            e.preventDefault();
            $.ajax({
                url: "php_insert_data_muestra.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    const datos_errores = Object.values(data.errores);
                    const datos_msg = Object.values(data.msg);
                    console.log(data.estado);
                    console.log(datos_errores);
                    console.log(datos_msg);
                    if (data.estado) {
                        for (let indexh = 0; indexh < datos_msg.length; indexh++) {
                            toastr.success(data.msg[indexh]);
                        }
                    } else {
                        for (let index = 0; index < datos_errores.length; index++) {
                            toastr.warning(data.errores[index]);
                        }
                    }
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        }));
        // Crear Dias y Cantidades de las Muestras
        $("#form_crear_cant").on('submit', (function(e) {
            e.preventDefault();
            var fecha_muestra = updateInput($("#n_dias").val());
            fecha_muestra = fecha_muestra.getFullYear() + "-" + (fecha_muestra.getMonth() + 1) + "-" + fecha_muestra.getDate();
            var formData = new FormData(this);
            formData.append('id_muestra', parseInt($("#id_muestra").val()));
            formData.append('fecha', fecha_muestra);
            $.ajax({
                url: "php_crear_cant.php",
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    $("#form_crear_cant")[0].reset();
                    const datos_errores = Object.values(data.errores);
                    const datos_msg = Object.values(data.msg);
                    if (data.estado) {
                        for (let indexh = 0; indexh < datos_msg.length; indexh++) {
                            toastr.success(data.msg[indexh]);
                        }
                    } else {
                        for (let index = 0; index < datos_errores.length; index++) {
                            toastr.warning(data.errores[index]);
                        }
                    }
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        }));
    });
    // Crear 2
</script>

</body>

</html>