<?php include '../../../layout/validar_session3.php' ?>
<?php include '../../../layout/head/head3.php'; ?>
<?php include 'sidebar.php' ?>

<?php require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php'; ?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <!-- Titulo de pagina -->
                    <h1>Centro de Costo</h1>
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
                <h3 class="card-title"> </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                            class="fas fa-expand"></i></button>

                </div>
            </div>
            <div class="card-body">
                <!-- formulario de balance -->
                <form name="form_centro_costo" id="form_centro_costo" method="post">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Seleccionar Archivo</label>
                                <!-- input para seleccionar el archivo -->
                                <input type="file" class="form-control" name="file_centro_costo" id="file_centro_costo" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <!-- boton para guardar el archivo -->
                                <button type="submit" class="btn btn-success" name="btn_subirarchivo"
                                    id="btn_subirarchivo">Subir </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">

            </div>
        </div>

    </section>
</div>

<?php include '../../../layout/footer/footer3.php' ?>

<script>
// subir Archivo
$("#form_balance").on('submit', (function(e) {
    e.preventDefault();

    $.ajax({
        url: "ajax_centro_costo.php",
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
            // toastr.error('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.');
            // toastr.warning('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.');
            // toastr.info('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.');
            // toastr.success('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.');
        },
        error: function(respuesta) {
            alert(JSON.stringify(respuesta));
            location.reload();
        }
    });
}));
</script>
</body>

</html>