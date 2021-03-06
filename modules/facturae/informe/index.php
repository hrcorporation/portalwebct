<?php include '../../../layout/validar_session3.php' ?>
<?php include '../../../layout/head/head3.php'; ?>
<?php include 'sidebar.php' ?>

<?php
require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php'; ?>
<?php

//$t10_vehiculo = new vehiculos_t10();
$t26_remisiones = new t26_remisiones();
$php_clases = new php_clases();
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Exportar Listado de Facturas de excel</h1>
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
                <form id="form-informe-remisiones" name="form-informe-remisiones" method="GET" action="excel.php">
                <div id="contenido">
                    
                    
                    <div class="row">
                        <div class="col">
                            <h5>Seleccionar Rango de Fecha</h5>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col">
                            <label>Fecha inicio: </label>
                            <input type="date" class="form-control" name="txt_fecha_ini" id="txt_fecha_ini" required>
                        </div>
                        <div class="col">
                            <label>Fecha Fin: </label>
                            <input type="date" name="txt_fecha_fin" class="form-control" id="txt_fecha_fin" required>
                        </div>
                    </div>
                    
                    <HR>
 
                    <div class="row">
                        <div class="col-2">
                            <button class="btn btn-block bg-gradient-success"> <i class="fas fa-file-excel"></i>     Exportar </button>
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

<?php include '../../../layout/footer/footer3.php' ?>




</body>

</html>