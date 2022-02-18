<?php include '../../../../layout/validar_session4.php' ?>
<?php include '../../../../layout/head/head4.php'; ?>
<?php include 'sidebar.php' ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Resistencia Concreto</h1>
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
                <h3 class="card-title"> Editar Resistencia Concreto</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                            class="fas fa-expand"></i></button>
                </div>
            </div>
            <div class="card-body">
                <form name="form_add_resistencia_concreto" id="form_add_resistencia_concreto" method="post">
                    <div class="row">
                        <div class="col">
                            <?php
                                switch ($rol_user) {
                                    case 1:
                                        $permisos_cod_desp = '';
                                        break;
                                    
                                    default:
                                        $permisos_cod_desp = " disabled='true' ";
                                        
                                        break;
                                }
                            ?>
                        <div class="form-group">
                                    <div class="form-group clearfix">
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" id="check_hab_resistencia" name="check_hab_resistencia" value="1" <?php print_r($permisos_cod_desp); ?>>
                                            <label for="check_hab_resistencia">
                                                Hab. Codigo y Descripcion
                                            </label>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="txt_cod">Codigo Resistencia</label>
                                <input type="text" name="txt_cod" id="txt_cod" class="form-control" disabled='true' >
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="txt_descripcion">Descripcion Resistencia</label>
                                <input type="text" name="txt_descripcion" id="txt_descripcion" class="form-control" disabled='true' >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col">
                            <div class="form-group">
                                <button type="button" name="btn-guardar" id="btn-guardar"
                                    class="btn btn-danger">Eliminar</button>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <button type="submit" name="btn-guardar" id="btn-guardar"
                                    class="btn btn-info">Actualizar</button>
                            </div>
                        </div>
                    </div>
                </form>
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


    $('#check_hab_resistencia').click(function() {
            if (!$(this).is(':checked')) {
                $("#txt_cod").attr('disabled', true);
                $("#txt_descripcion").attr('disabled', true);
            } else {
                $("#txt_cod").attr('disabled', true);
                $("#txt_descripcion").attr('disabled', true)
            }
        });

    $("#form_add_resistencia_concreto").on('submit', (function(e) {
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