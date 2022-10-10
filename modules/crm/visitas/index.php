<?php include '../../../layout/validar_session3.php' ?>
<?php include '../../../layout/head/head3.php'; ?>
<?php include 'sidebar.php';

$t1_terceros = new t1_terceros();
$visita_clientes = new visitas_clientes();
$t5_obras = new t5_obras();
$oportunidad_negocio = new oportunidad_negocio();
$php_clases = new php_clases();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>VISITAS COMERCIALES</h1>
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
                <h3 class="card-title">Explorar las visitas comerciales</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                </div>
            </div>
            <div class="card-body">
                
              <div class="row">
                <div class="col">
                <div id='calendar'></div>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->


    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<!----- modales ---------->
    <!--- modal Crear Visita Comercial -->
    <?php include 'modal/crear_visita.php'; ?>
    <?php include 'modal/editar_visita_comercial.php'; ?>

    


<!----- Fin Modales--->

<?php include '../../../layout/footer/footer3.php' ?>
<script src="calendar.js"> </script>


</body>

</html>