<?php include '../../../../layout/validar_session4.php' ?>
<?php include '../../../../layout/head/head4.php'; ?>
<?php include 'sidebar.php' ?>

<?php require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php'; ?>

<?php
$t24_caract_concre = new t24_caract_concre();
$php_clases = new php_clases();

$id_producto = $_GET['id'];

$datos_producto = $t24_caract_concre->get_caract_concre_id($id_producto);
if (is_array($datos_producto)) {
    foreach ($datos_producto as $key) {
        $CodCC = $key['ct24_CodCC'];
        $DescripcionCC = $key['ct24_DescripcionCC'];
    }
} else {
    echo "no es un array";
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Resistencia del concreto</h1>
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
                <h3 class="card-title">Modificar resistencia del concreto</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div id="contenido">
                    <form method="POST" name="FormModificarCaracteristicasConcreto" id="FormModificarCaracteristicasConcreto">
                        <input type="hidden" name="txt_id" id="txt_id" value="<?php echo $id_producto ?>">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Codigo resistencia Concreto </label>
                                    <input type="text" class="form-control" id="txt_CodCC" name="txt_CodCC" value="<?php echo $CodCC ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Descripcion RC </label>
                                    <input type="text" class="form-control" id="txt_DescripcionCC" name="txt_DescripcionCC" value="<?php echo $DescripcionCC ?>">
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
        $("#FormModificarCaracteristicasConcreto").on('submit', (function(e) {
            e.preventDefault();
            $.ajax({
                url: "php_editar.php",
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