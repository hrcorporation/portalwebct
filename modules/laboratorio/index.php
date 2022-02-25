<?php include '../../layout/validar_session2.php' ?>
<?php include '../../layout/head/head2.php'; ?>
<?php include 'sidebar.php' ?>



<?php





// Roles
$rol_user = $usuarios->buscar_roles($_SESSION['id_usuario']);
$modulo_lab = array(1, 3, 8, 15, 16, 17, 19, 20, 22, 26, 27, 29);
$modulo_lab =  $permisos->habilitar($modulo_lab, $rol_user);

if ($modulo_lab) {
    $php_clases = new php_clases();
    $t1_terceros = new t1_terceros();
    $t5_obras = new t5_obras();
    $t26_remisiones = new t26_remisiones();
}

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Muestras</h1>
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
                <h3 class="card-title"></h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                </div>
            </div>
            <div class="card-body">

                <div id="contenido">
                    <table id="t_remisiones" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>N</th>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Remision</th>
                                <th>Resultado</th>
                                <th style="width:100px">Detalle</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfooter>
                            <tr>
                                <th>N</th>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Remision</th>
                                <th>Resultado</th>
                                <th style="width:100px">Detalle</th> 
                            </tr>
                        </tfooter>
                    </table>
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

<?php include '../../layout/footer/footer2.php' ?>




</body>

</html>