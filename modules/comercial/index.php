<?php include '../../layout/validar_session2.php' ?>
<?php include '../../layout/head/head2.php'; ?>
<?php include 'sidebar.php' ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>COMERCIAL</h1>
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
        $t1_terceros = new t1_terceros();
       ?>
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tabla de Clientes</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                            class="fas fa-expand"></i></button>
                </div>
            </div>
            <div class="card-body">

                <div id="contenido">

                    <div class="row">
                        <!-- Modulo HTMl -->
                        <div class="col-4" id="">
                            <div class="small-box bg-info ">
                                <div class="ribbon-wrapper ribbon-lg">
                                    <div class="ribbon bg-warning">
                                        proximamente
                                    </div>
                                </div>
                                <div class="inner">
                                    <!-- Nombre de Modulo -->
                                    <h3>OPORTUNIDAD DE</h3>
                                    <h3> NEGOCIO</H3>
                                </div>
                                <div class="icon">
                                    <!-- icono del Modulo -->
                                    <i class="fas fa-wallet"></i>
                                </div>
                                <!-- Enlace de redireccionamiento del Modulo  -->
                                <a class="small-box-footer disabled" href="oportunidad_negocio/">
                                    Ir <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <!-- Modulo HTMl -->
                        <div class="col-4" id="">
                            <div class="small-box bg-info ">
                                <div class="ribbon-wrapper ribbon-lg">
                                    <div class="ribbon bg-warning">
                                        proximamente
                                    </div>
                                </div>
                                <div class="inner">
                                    <!-- Nombre de Modulo -->
                                    <h3>CLIENTES</H3>
                                </div>
                                <div class="icon">
                                    <!-- icono del Modulo -->
                                    <i class="fas fa-wallet"></i>
                                </div>
                                <!-- Enlace de redireccionamiento del Modulo  -->
                                <a class="small-box-footer disabled" href="clientes/">
                                    Ir <i class="fas fa-arrow-circle-right"></i>
                                </a>
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

       

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include '../../layout/footer/footer2.php' ?>



</body>

</html>