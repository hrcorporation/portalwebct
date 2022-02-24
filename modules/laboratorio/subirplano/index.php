<?php include '../../../layout/validar_session3.php' ?>
<?php include '../../../layout/head/head3.php'; ?>
<?php include 'sidebar.php' ?>

<?php require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php'; ?>

<?php

$usuarios = new usuarios();
$permisos = new permisos();



// Roles
$rol_user = $usuarios->buscar_roles($_SESSION['id_usuario']);
$modulo_remisiones = array(1, 8, 15, 17, 20, 29, 22, 26);
$modulo_remisiones =  $permisos->habilitar($modulo_remisiones, $rol_user);

if ($modulo_remisiones) {
} else {
    $data = null;
    print('<script> window.location = "../index.php"</script>');
}




?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Subir Plano</h1>
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



                <h3 class="card-title"> Plano </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>

                </div>
            </div>
            <div class="card-body">
                <div id="contenido">

                    <form id="form_subir_plano" name="form_subir_plano" method="post">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Subir Archivo Plano</label>
                                    <input type="file" name="plano_txt" id="plano_txt" class="form-control" require>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-default btn-block" >Subir</button>
                                </div>
                            </div>
                        </div>
                    </form>


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
        $('.select2').select2();

    });
    $(document).ready(function() {
        $("#form_subir_plano").on('submit', (function(e) {
            e.preventDefault();

            $.ajax({
                url: "php_subir.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {

                    const datos_errores = Object.values(data.errores);
                    console.log(datos_errores);
                    if (data.estado) {
                        toastr.success('exitoso');

                    } else {
                        for (let index = 0; index < datos_errores.length; index++) {

                            toastr.warning(data.errores[index]);

                            console.log(data.errores[index]);
                        }
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