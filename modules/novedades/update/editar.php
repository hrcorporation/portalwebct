<?php include '../../../layout/validar_session3.php'; ?>
<?php include '../../../layout/head/head3.php'; ?>
<?php include 'sidebar.php';

$fecha_novedad = '17/03/2022';
$id_novedad = '3';

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for=""></label>
                        <h1>Registrar novedad</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <!--
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item active">Actual</li>
                    </ol>
                -->
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Gestion novedad <b><?php echo $id_novedad; ?> </b> </h3>
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
                        <div class="form-group">
                            <h3><?php echo $fecha_novedad; ?></h3>
                        </div>
                    </div>
                </div>
                <hr>
                <form name="form_add_cliente_obra" id="form_add_cliente_obra" method="post">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label>Cliente</label>
                                <select class="js-example-basic-single select2  form-control" id="txt_cliente"
                                    name="txt_cliente" required />
                                <option value="1">cliente_prueba</option>
                                <?php //echo $t1_terceros->option_cliente(); 
                                ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Obra</label>
                                <select class="js-example-basic-single select2 form-control" id="txt_obra"
                                    name="txt_obra" required />
                                <option value="2">obra_prueba</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="">Adicionar Cliente y Obra</label>
                                <button type="submit" name="btn_adicionar_cliente_obra" id="btn_adicionar_cliente_obra"
                                    class="btn btn-block btn-info">
                                    Adicionar
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="row">
                    <div class="col">
                        <table name="table_clientes_obras" id="table_clientes_obras">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Cliente</th>
                                    <th>Obra </th>
                                    <th>Detalle </th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>

            </div> <!--  Fin del Cardbody -->
        </div>

        <!-- /.card-body -->
        <div class="card-footer">
        </div>
        <!-- /.card-footer-->

    </section>
</div>
<?php include '../../../layout/footer/footer3.php' ?>


<script>
// Tablas
$(document).ready(function() {
    var id_novedad = '<?php echo $id_novedad; ?>';
    // crear tablas
    table_cliente_obra = datatable_cliente_obras(id_novedad);
    setInterval(function() {
        table_cliente_obra.ajax.reload(null, false);
    }, 5000);

    // $('#cliente').on('change', function() {

    var n = 1;

    // tabla de cliente y obras
    function datatable_cliente_obras(id_novedad) {
        var table_cliente_obra = $('#table_clientes_obras').DataTable({
            //"processing": true,
            //"scrollX": true,
            "ajax": {
                "url": "datatable_cli_obra.php",
                'data': {
                    'id_novedad': id_novedad,
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
                    "data": "nombre_cliente"
                },
                {
                    "data": "nombre_obra" // codigo de la novedad
                },
                {
                    "data": null,
                    "defaultContent": "<button class='btn btn-warning btn-sm'> <i class='fas fa-eye'></i> Ver </button>"
                }
            ],
            //"scrollX": true,
        });

        datatable_cliente_obras.on('order.dt search.dt', function() {
            datatable_cliente_obras.column(0, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();
        datatable_cliente_obras.ajax.reload();
        return datatable_cliente_obras;
    } //  fin de la funcion
});
</script>


<script>
// adicionar Cliente y Obra en la tabla
$(document).ready(function() {
    var n = 1;
    $("#form_add_cliente_obra").on('submit', (function(e) {
        // actualizar la tabla


        e.preventDefault();
        $.ajax({
            url: "php_add_cliente_obra.php",
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
                    toastr.warning(data.msg);
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