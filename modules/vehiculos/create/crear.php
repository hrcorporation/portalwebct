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
                    <h1>Vehiculo</h1>
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
                <h3 class="card-title">Registrar Nuevo Vehiculo</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div id="contenido">
                    <form name="F_crear" id="F_crear" method="POST">
                        <div class="row">
                            <div class="col-2">
                                <div class="form-group">
                                    <label>Escribir Placa del Vehiculo - LETRAS</label>
                                    <input type="text" id="txt_letras" name="txt_letras" class="form-control" placeholder="Solo Letras" maxlength="3">
                                </div>
                            </div>
                            <div class="col-1">
                                <center> - </center>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label>Escribir Placa del Vehiculo - NUMEROS</label>
                                    <input type="text" id="txt_num" name="txt_num" class="form-control validanumericos" placeholder="Solo numeros" maxlength="3">
                                </div>
                            </div>
                            <div class="col-1">
                                <center> - </center>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label>Cantidad m3 limite:</label>
                                    <br><br>
                                    <input type="text" id="txt_m3" name="txt_m3" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-block bg-gradient-info">Guardar</button>
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

<?php include '../../../layout/footer/footer3.php' ?>

<script>
    $(function() {
        $('.validanumericos').keypress(function(e) {
                if (isNaN(this.value + String.fromCharCode(e.charCode)))
                    return false;
            })
            .on("cut copy paste", function(e) {
                e.preventDefault();
            });
    });
    $(document).ready(function(e) {
        $("#F_crear").on('submit', (function(e) {
            e.preventDefault();
            $.ajax({
                url: "php_crear.php",
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