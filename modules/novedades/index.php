<?php include '../../layout/validar_session2.php'; ?>
<?php include '../../layout/head/head2.php'; ?>
<?php include 'sidebar.php';

$t1_terceros = new t1_terceros();
$oportunidad_negocio = new oportunidad_negocio();

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
                <h3 class="card-title">Registrar novedad</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div id="contenido">
                    <form name="form_crear_novedad" id="form_crear_novedad" method="post" content="width=device-width, initial-scale=1">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Fecha</label>
                                    <input type="date" name="fecha" id="fecha" class="form-control" />
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Crear novedad</label>
                                    <button type="submit" name="adicionar" id="adicionar" class="btn btn-block btn-success">
                                        Crear novedad
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Registrar datos completos de la novedad</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div id="contenido">
                    <form name="form_crear_novedad" id="form_crear_novedad" method="post" content="width=device-width, initial-scale=1">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Cliente</label>
                                    <select class="js-example-basic-single select2  form-control" id="C_IdTerceros" name="C_IdTerceros" required />
                                    <?php echo $t1_terceros->option_cliente(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Obra</label>
                                    <select class="js-example-basic-single select2 form-control" id="C_Obras" name="C_Obras" required />

                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="">Adicionar</label>
                                    <button type="submit" name="adicionar" id="adicionar" class="btn btn-block btn-info">
                                        Adicionar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <br><br>
                    <div class="row">
                        <div class="col-12">
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
                    <br>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <button type="button" name="guardar_novedad" id="guardar_novedad" class="btn btn-block btn-success">
                                    Adicionar novedad
                                </button>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <button type="submit" name="cargar_remisiones" id="cargar_remisiones" class="btn btn-block btn-info">
                                    Cargar remisiones
                                </button>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <table name="table_remisiones" id="table_remisiones">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Remision</th>
                                        <th>Mixer </th>
                                        <th>Hora</th>
                                        <th>Detalle</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for=""></label>
                                <button type="submit" name="guardar_novedades_remisiones" id="guardar_novedades_remisiones" class="btn btn-block btn-success" onclick="return confirm('¿Esta seguro que quiere cargar las remisiones?')">
                                    Guardar novedades generales de las remisiones
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
        </div>
        <!-- /.card-footer-->

    </section>
</div>
<?php include '../../layout/footer/footer2.php' ?>
<script>
    $(document).ready(function() {
        var n = 1;
        var table = $('#table_clientes_obras').DataTable({
            //"processing": true,
            //"scrollX": true,
            "ajax": {
                "url": "",
                "dataSrc": ""
            },
            "order": [
                [0, 'desc']
            ],
            "columns": [{
                    "data": "id"
                },
                {
                    "data": "cliente"
                },
                {
                    "data": "obra"
                },
                {
                    "data": null,
                    "defaultContent": "<button class='btn btn-warning btn-sm'> <i class='fas fa-eye'></i> </button>"
                }
            ],
            //"scrollX": true,

        });
        var table = $('#table_remisiones').DataTable({
            //"processing": true,
            //"scrollX": true,
            "ajax": {
                "url": "",
                "dataSrc": ""
            },
            "order": [
                [0, 'desc']
            ],
            "columns": [{
                    "data": "id"
                },
                {
                    "data": "remision"
                },
                {
                    "data": "mixer"
                },
                {
                    "data": "hora"
                },
                {
                    "data": null,
                    "defaultContent": "<button class='btn btn-danger btn-sm'> <i class='fas fa-eye'></i> </button>"
                }
            ],
            //"scrollX": true,

        });
    });
</script>

</body>

</html>