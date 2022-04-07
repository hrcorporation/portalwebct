<?php include '../../../../layout/validar_session4.php' ?>
<?php include '../../../../layout/head/head4.php'; ?>
<?php include 'sidebar.php' ?>
<?php

$labmuestras = new labmuestras();
$datos = $labmuestras->get_datos_lab_id($_GET['id']);
fb($_GET['id'], 'id de la muestra', FirePHP::LOG);

if (is_array($datos)) {
    foreach ($datos as $dato) {
        $cod_muestra = $dato['ct57_id_muestra'];
        $fecha = $dato['ct57_fecha'];
        $hora = $dato['ct57_hora'];
        $remision = $dato['ct57_id_remision'];
        $id_mixer = $dato['ct57_id_mixer'];
        $cantidad = $dato['ct57_cantidad'];
        $id_cliente = $dato['ct57_id_cliente'];
        $id_obra = $dato['ct57_id_obra'];
        $id_producto = $dato['ct57_id_producto'];
        $cementante = $dato['ct57_cementante'];
        $m3_muestra = $dato['ct57_m3_muestra'];
        $asentamiento = $dato['ct57_asentamiento'];
        $temperatura = $dato['ct57_temperatura'];
        $aire = $dato['ct57_aire'];
        $volumetrico = $dato['ct57_rend_volumetrico'];
        $cantidad_muestra = $dato['ct57_cantidad_muestra'];
    }
}
?>

<script>
    // funciones de java scrip de sumar dias a una fecha en especifica
    // Funcion Sumar Dias deacuerdo a la fecha
    function sumarDias(fecha, dias) {
        var new_fecha = new Date(); // fecha de hoy
        new_fecha.setDate(fecha.getDate() + dias); // se suma los dias con la fecha de hoy
        return new_fecha; // Retorna la suma de las fechas
    }

    // actualizar input 
    function updateInput(n_dia) {
        var fecha = new Date(); // fecha de Hoy

        var new_fecha = sumarDias(fecha, parseInt(n_dia));
        //console.log(sumarDias(fecha, parseInt(n_dia)));

        fecha_new.innerText = (new_fecha.getDate()) + "/" + (new_fecha.getMonth() + 1) + "/" + new_fecha.getFullYear(); //
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
                <h3 class="card-title"> Ver Muestra <b><?php echo intval($_GET['id']); ?> </b> </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div id="contenido">
                    <!-- Formulario de Crear Muestras. la mayoria de los datos se escogen de las remisiones -->
                    <form id="form_crear_muestra" name="form_crear_muestra" method="post">
                        <!-- el id de la remision es oculto -->
                        <input id="id_remision" name="id_remision" type="hidden">
                        <div class="row">
                            <div class="col-2">
                                <div class="form-group">
                                    <label>Fecha</label>
                                    <input type="text" class="form-control" id="fecha_remision" name="fecha_remision" readonly="true" value="<?= $fecha ?>">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label>Hora</label>
                                    <input type="text" class="form-control" id="hora" name="hora" placeholder="00:00" value="<?= $hora ?>">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label>Codigo Remision</label>
                                    <input type="text" class="form-control" id="cod_remision" name="cod_remision" readonly="true" value="<?= $remision ?>">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label>Mixer</label>
                                    <input type="hidden" name="id_mixer" id="id_mixer">
                                    <input type="text" class="form-control" id="placa_mixer" name="placa_mixer" readonly="true" value="<?= $id_mixer ?>">
                                </div>
                            </div>
                            <div class="col-1">
                                <div class="form-group">
                                    <label>Cantidad</label>
                                    <input type="text" class="form-control" id="cantidad" name="cantidad" readonly="true" value="<?= $cantidad ?>">
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
                                    <input type="text" name="cliente" id="cliente" class="form-control" readonly="true" value="<?= $id_cliente ?>">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <h5>Obra</h5>
                                    <input type="hidden" name="id_obra" id="id_obra" class="form-control">
                                    <input type="text" name="obra" id="obra" class="form-control" readonly="true" value="<?= $id_obra ?>">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <h5>producto</h5>
                                    <input type="hidden" name="id_producto" id="id_producto" class="form-control">
                                    <input type="text" name="producto" id="producto" class="form-control" readonly="true" value="<?= $id_producto ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Cementante</label>
                                    <input type="text" name="cementante" id="cementante" class="form-control" value="<?= $cementante ?>" />
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>m3 Muestra</label>
                                    <input type="text" name="m3" id="m3" class="form-control" value="<?= $m3_muestra ?>" />
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Asentamiento</label>
                                    <input type="text" name="asentamiento" id="asentamiento" class="form-control" value="<?= $asentamiento ?>" />
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Temperatura</label>
                                    <input type="text" name="temperatura" id="temperatura" class="form-control" value="<?= $temperatura ?>" />
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Aire</label>
                                    <input type="text" name="aire" id="aire" class="form-control" value="<?= $aire ?>" />
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Rend Volumetrico</label>
                                    <input type="text" name="rend_volumetrico" id="rend_volumetrico" class="form-control" value="<?= $volumetrico ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success form-control"> Actualizar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- Fin del Formulario de Crear Muestra con los datos especificos de la remision -->
                    <hr>
                    <hr>
                    <!-------->
                    <form name="form_crear_cant" id="form_crear_cant" method="post">
                        <div class="row">
                            <div class="col">
                                <label>Codigo Muestra</label>
                                <input type="text" class="form-control" id="codigo_muestra" name="codigo_muestra" readonly="true" value="<?= $cod_muestra ?>" />
                            </div>
                            <div class="col">
                                <label>Cantidad</label>
                                <input type="text" class="form-control" id="n_muestra" name="n_muestra" required value="<?= $cantidad_muestra ?>" />
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
                    <hr>
                    <br>
                    <hr>
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

<?php include '../../../../layout/footer/footer4.php' ?>

<script>
    $(document).ready(function() {
        // ==============================================================
        // Funciones 
        // ==============================================================


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
            var codigo_muestra = $("#codigo_muestra").val();
            var id_muestra = $("#id_muestra").val();

            $.ajax({
                url: "php_cargar_dias.php",
                type: "POST",
                data: {
                    codigo_muestra: codigo_muestra,
                    id_muestra: id_muestra,
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

        // Funcion tabla Remision




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
                    // $("#form_crear_cant")[0].reset();  // Limpiar Formulario
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