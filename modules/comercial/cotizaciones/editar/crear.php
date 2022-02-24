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
                    <h1>CREAR OPORTUNIDAD DE NEGOCIO</h1>
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
        <?php
        /**
         * Validacion de Usuario
         */
        if (is_array($array_rol_user =  $login->get_rol_tercero($_SESSION['id_usuario']))) :

            $modulos = array(1); // Array de roles para habilitar roles
            if ($login->validar_rol_user($modulos, $array_rol_user)) : // Validacion para habilitar el usuario
                $t1_terceros = new t1_terceros();

                /**
                 * Card Body
                 */
        ?>
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">CREAR OPORTUNIDAD DE NEGOCIO</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                            class="fas fa-expand"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="progress">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 0.5%" aria-valuenow="25"
                        aria-valuemin="0" aria-valuemax="100"> <span class=" text_progresbar">0% </span> </div>
                </div>
                <div id="contenido">
                    <form name="form_crear_op" id="form_crear_op" method="post">
                        <div class="row">
                            <div class="col-md-4  col-sm-12">
                                <div class="form-group">
                                    <label>Numero de Documento</label>
                                    <input type="text" name="nit" id="nit" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-4  col-sm-12">
                                <div class="form-gorup">
                                    <label>Nombre Completo</label>
                                    <input type="text" name="nombre_completo" id="nombrecompleto"
                                        class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-4  col-sm-12">
                                <div class="form-gorup">
                                    <label>Apellido Completo</label>
                                    <input type="text" name="ap_completo" id="ap_completo" class="form-control" />
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                <button type="submit" name="crear_op" id="crear_op" class="btn btn-block btn-info">Crear</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <div id="bq-boton">

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
        </div>
        <!-- /.card -->

        <!-- Default box -->
       
        <!-- /.card -->
        <?php
            else :
            ?>
        <div class="callout callout-warning">
            <h5>No posee permisos en este modulo</h5>
        </div>
        <?php
            endif;
        else :
            header('location : ../../../../cerrar.php');
        endif;

        ?>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- /.modal-dialog -->
</div>

<?php include '../../../../layout/footer/footer4.php' ?>
<script>
$(document).ready(function(e) {
    $(".progress").hide();
});
</script>

<script src="ajax_crear.js"></script>

</body>

</html>