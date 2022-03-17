<?php include '../../../../layout/validar_session4.php'; ?>
<?php include '../../../../layout/head/head4.php'; ?>
<?php include 'sidebar.php'; ?>



<?php

// cargar Clases
    $php_clases = new php_clases();
    $t5_obras = new t5_obras();
    $t1_terceros = new t1_terceros();
    $id_obra  = $php_clases->HR_Crypt($_GET['id'], 2);


?>

<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Obras</h1>
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
                <h3 class="card-title">Editar</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                            class="fas fa-expand"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div id="contenido">
                    <form name="F_editar" id="F_editar" method="POST">
                        <?php
                        $datos_obra = $t5_obras->select_obras_id($id_obra);
                        while ($fila_obra = $datos_obra->fetch(PDO::FETCH_ASSOC)) {
                            $id_cliente = $fila_obra['ct5_IdTerceros'];
                            $NombreObra = $fila_obra['ct5_NombreObra'];
                            $direccion_obra = $fila_obra['ct5_DireccionObra'];
                            $id_departamento = $fila_obra['ct5_id_departamento'];
                            $id_municipio = $fila_obra['ct5_id_ciudad'];
                            $segmento = $fila_obra['ct5_segmento'];
                        }
                        ?>

                        <input type="hidden" value="<?php echo $id_obra ?>" name="id_obra" id="id_obra">

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Datos del Proyecto</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 0.5%"  aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"> <span class=" text_progresbar">0% </span> </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Cliente Pagador</label>
                                            <select class="js-example-basic-single select2 form-control" id="cliente"
                                                name="cliente" required>
                                                <?php echo $t1_terceros->option_cliente_edit($id_cliente); ?>
                                            </select>
                                        </div>
                                    </div>
                                </div> <!-- Fin Row -->
                                <div class="row">

                                    <div class="col">

                                        <div class="form-group">

                                            <label>Nombre de la Obra</label>

                                            <input name="nombre_obra" id="nombre_obra" type="text" class="form-control"
                                                placeholder="Digite el nombre" value="<?php echo $NombreObra ?>"
                                                required>

                                        </div>

                                    </div>

                                    <div class="col">

                                        <div class="form-group">

                                            <label>Departamento</label>

                                            <select name="departamento" id="departamento" class="form-control select2">



                                            </select>

                                        </div>

                                    </div>

                                    <div class="col">

                                        <div class="form-group">

                                            <label>Ciudad</label>

                                            <select name="ciudad" id="ciudad" class="form-control select2">



                                            </select>

                                        </div>

                                    </div>

                                </div>
                                <div class="row">

                                    <div class="col">

                                        <div class="form-group">



                                            <label>Segmento</label>

                                            <select class="js-example-basic-single select2 form-control" name="segmento"
                                                id="segmento">

                                                <optgroup label="Vivienda">

                                                    <option value="1">Vivienda de interés social (VIS) ( < 135 SMLMV )
                                                            </option>

                                                    <option value="2">Vivienda diferente de interés social (NO VIS) - (
                                                        > 135 SMLMV )</option>

                                                </optgroup>

                                                <optgroup label="Obras Civiles">

                                                    <option value="10">530201 Carreteras, calles, vías férreas y pistas
                                                        de aterrizaje, puentes, carreteras elevadas y túneles.</option>

                                                    <option value="11">530202 Puertos, canales, presas, sistemas de
                                                        riego y otras obras hidráulicas.</option>

                                                    <option value="12">530203 Tuberías para la conducción de gas a larga
                                                        distancia, líneas de comunicación y cables de poder, tuberías y
                                                        cables locales y obras conexas.</option>

                                                    <option value="13">530204 Construcciones en minas y plantas
                                                        industriales</option>

                                                    <option value="14">530205 Construcciones deportivas al aire libre,
                                                        otras obras de ingeniería civil</option>

                                                </optgroup>

                                                <optgroup label="Edificaciones">

                                                    <option value="20">EDIFICACIONES - bodegas, edificaciones
                                                        comerciales, edificaciones industriales, oficinas, hoteles,
                                                        edificaciones para administración pública, centros sociales y/o
                                                        recreacionales, entre otros.</option>

                                                </optgroup>

                                                <optgroup label="Otros">

                                                    <option value="30">OTROS - aquellos despachos de los cuales no es
                                                        posible identificar su destino o uso. Entre ellos: mayoristas,
                                                        intermediarios, comercializadores, distribuidores,
                                                        transformadores (prefabricados), etc.</option>

                                                </optgroup>



                                            </select>

                                        </div>

                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Direccion</label>
                                            <input name="direccion" id="direccion" type="text" class="form-control"
                                                placeholder="Digite el direccion">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                        <hr>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-block bg-gradient-orange" name="boton_guardar"
                                        id="boton_guardar"> Guardar </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Listado Visitas</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                            class="fas fa-expand"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#crear_visita">
                            Crear Visita
                        </button>
                    </div>
                </div>
                <div id="contenido">
                    <table name="table_visitas" id="table_visitas">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Fecha</th>
                                <th>Objetivo visita </th>
                                <th>Observacion</th>
                                <th>Detalle</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->
        <div class="modal fade" id="crear_visita">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Crear Visita</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form name="form_add_visita" id="form_add_visita" method="post">
                            <input type="hidden" name="id_cliente" id="id_clente" value="<?php echo intval($id) ?>">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="fecha_vist">Fecha</label>
                                        <input type="date" name="fecha_vist" id="fecha_vist" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="result_visit">Objetivo de la visita</label>
                                        <select class="select2 form-control" name="objetivo_visita"
                                            id="objetivo_visita">
                                            <?= $visita_clientes->select_tipo_visita() ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="obs_visit">Observaciones</label>
                                        <input type="text" name="obs_visit" id="obs_visit" class="form-control" />
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
        <!--- Modal Editar Visita -->
        <div class="modal fade" id="edit_visita">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Ver Visita</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form name="form_edit_visita" id="form_edit_visita" method="post">
                            <input type="hidden" name="id_visita" id="id_visita" />
                            <input type="hidden" name="id_clente_edit" id="id_clente_edit"
                                value="<?php echo intval($_GET['id']) ?>">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="edit_fecha_vist">Fecha</label>
                                        <input type="date" name="edit_fecha_vist" id="edit_fecha_vist"
                                            class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="edit_result_visit">Objetivo de la visita</label>
                                        <select class="select2 form-control" name="edit_result_visit"
                                            id="edit_result_visit">
                                            <?= $visita_clientes->select_tipo_visita() ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="edit_obs_visit">Observaciones</label>
                                        <input type="text" name="edit_obs_visit" id="edit_obs_visit"
                                            class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Actualizar</button>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <button type="button" id="btn_eliminar_visitas"
                                            class="btn btn-danger">Eliminar</button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include '../../../../layout/footer/footer4.php' ?>
<script>
$("#form_add_visita").on('submit', (function(e) {
    e.preventDefault();
    $.ajax({
        url: "php_addvisita.php",
        type: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function(data) {
            console.log(data);
            const datos_errores = Object.values(data.errores);
            console.log(datos_errores);
            if (data.estado) {
                toastr.success('visita creada exitosamente');
            } else {
                for (let index = 0; index < datos_errores.length; index++) {
                    toastr.warning(data.errores[index]);
                }
            }
            $('#crear_visita').modal('toggle');
        },
        error: function(respuesta) {
            alert(JSON.stringify(respuesta));
        },
    });
}));

function datatable_visitas(id_cliente) {
    var table = $('#table_visitas').DataTable({
        //"processing": true,
        //"scrollX": true,
        "ajax": {
            "url": "datatable_visitas.php",
            'data': {
                'id_cliente': id_cliente,
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
                "data": "fecha"
            },
            {
                "data": "tipo_visita"
            },
            {
                "data": "observaciones"
            },
            {
                "data": null,
                "defaultContent": "<button class='btn btn-warning btn-sm' data-toggle='modal' data-target='#edit_visita'> Editar </button> "
            },

        ],
        'paging': false,
        'searching': false
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

    table.ajax.reload();
    return table;
}
if ($.fn.dataTable.isDataTable('#table_visitas')) {
    table_visitas = $('#table_visitas').DataTable();
    table_visitas.destroy();
}
var id_cliente = <?php echo intval($id_cliente); ?>;
table_visitas = datatable_visitas(id_cliente);
setInterval(function() {
    table_visitas.ajax.reload(null, false);
}, 5000);


$("#btn_eliminar_visitas").on('click', function() {
    var id_visita = $("#id_visita").val();
    $.ajax({
        url: "php_eliminar_visita.php",
        type: "POST",
        data: {
            'id_visita': id_visita,
        },

        success: function(data) {
            console.log(data);
            $("#edit_visita").modal('hide');
            toastr.success("Visita eliminada Exitosamente");
        },
        error: function(respuesta) {
            alert(JSON.stringify(respuesta));
        },
    });
});

$('#table_visitas tbody').on('click', 'button', function() {
    var data = table_visitas.row($(this).parents('tr')).data();
    var id = data['id'];
    console.log(data['tipo_visita']);

    $('#id_visita').val(data['id']);
    $('#edit_fecha_vist').val(data['fecha']);
    $('#edit_obs_visit').val(data['observaciones']);
    $('#edit_result_visit').val(data['id_tipo_visita']);

    //var resultado = data['resultado'];


    //$("#edit_result_visit option[value='']").prop("selected", 'selected');
    //$('#edit_result_visit').val(data['resultado']);


});

$("#form_edit_visita").on('submit', (function(e) {
    e.preventDefault();
    $.ajax({
        url: "php_edit_visita.php",
        type: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function(data) {
            console.log(data);
            const datos_errores = Object.values(data.errores);
            console.log(datos_errores);
            if (data.estado) {
                toastr.success('visita Editada exitosamente');
            } else {
                for (let index = 0; index < datos_errores.length; index++) {
                    toastr.warning(data.errores[index]);
                }
            }
            $('#edit_visita').modal('toggle');
        },
        error: function(respuesta) {
            alert(JSON.stringify(respuesta));
        },
    });
}));

</script>


<script>


$(document).ready(function() {
    $(".progress").hide();
    $('.select2').select2();
    // Ciudad
    $.ajax({
        url: "get_data.php",
        type: "POST",
        data: {
            task: 1,
            id_departamento: <?php echo intval($id_departamento); ?>,
            id_municipio: <?php echo intval($id_municipio); ?>
        },
        success: function(response) {
            console.log(response.post);
            $('#departamento').html(response.departamento);
            $('#ciudad').html(response.ciudad);
        },
        error: function(respuesta) {
            alert(JSON.stringify(respuesta));
        },
    });

    // Departamento
    $('#departamento').on('change', function() {
        $.ajax({
            url: "get_data.php",
            type: "POST",
            data: {
                id_departamento: ($('#departamento').val()),
                task: 2,
            },
            success: function(response) {
                $('#ciudad').html(response.ciudad);
            },
            error: function(respuesta) {
                alert(JSON.stringify(respuesta));
            },
        });
    });
});
</script>

<script>
$(document).ready(function(e) {
    $("#btn-eliminar").click(function() {
        var id_obra = <?php echo $id_obra ?>;
        var url = "../index.php";
        $.ajax({
            url: "php_eliminar.php",
            type: "POST",
            data: {
                id_obra: id_obra,
            },
            success: function(response) {
                window.window.location = url;
            },

            error: function(respuesta) {
                alert(JSON.stringify(respuesta));
                window.window.location = url;
            },
        });

    });



    $("#F_editar").on('submit', (function(e) {
        e.preventDefault();
        $.ajax({
            url: "php_editar.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {

                console.log(data.estado);

                if (data.estado) {

                    toastr.success('exitoso');



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