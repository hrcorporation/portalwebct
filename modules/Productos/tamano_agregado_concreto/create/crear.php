<?php include '../../../../layout/validar_session4.php' ?>
<?php include '../../../../layout/head/head4.php'; ?>
<?php include 'sidebar.php' ?>

<?php require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php'; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tamaño agregado del concreto</h1>
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
                <h3 class="card-title">Crear tamaño agregado del concreto</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div id="contenido">
                    <!-- Inicio del formulario -->
                    <form method="POST" name="FormCrearTamanoAgregadoConcreto" id="FormCrearTamanoAgregadoConcreto">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Codigo TAC </label>
                                    <input type="text" class="form-control" id="txt_CodTCA" name="txt_CodTCA">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Descripcion TCA </label>
                                    <input type="text" class="form-control" id="txt_DescripcionTCA" name="txt_DescripcionTCA">
                                </div>
                            </div>
                        </div>
                        <div class="container">
                            <div class="row" style="text-align:center">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-block btn-success">Guardar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- Fin del formulario -->
                </div>
            </div>
        </div>
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

<?php include '../../../../layout/footer/footer4.php' ?>
<script>
    $(document).ready(function(e) {
        $("#FormCrearTamanoAgregadoConcreto").on('submit', (function(e) {
            e.preventDefault();
            $.ajax({
                url: "php_crear.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    console.log(data);
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