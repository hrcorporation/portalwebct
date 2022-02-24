<?php include '../../../layout/validar_session3.php' ?>
<?php include '../../../layout/head/head3.php'; ?>
<?php include 'sidebar.php' ?>
<?php //include '../../../include/model/tablas/conexionPDO.php'; ?>

<?php
require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';
?>
<?php

$php_clases = new php_clases();
$t1_terceros = new t1_terceros();


$id = $php_clases->HR_Crypt($_GET['id'],2);
$datos = $t1_terceros->search_tercero_custom_id($id);

while($fila = $datos->fetch(PDO::FETCH_ASSOC)){
    
   
    $nit = $fila['ct1_NumeroIdentificacion'];
    $razon_social = $fila['ct1_RazonSocial'];

}

?>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>CLIENTE</h1>
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
                            <h3 class="card-title">Editar cliente</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>

                            </div>
                        </div>
                        <div class="card-body">
                            <div id="contenido">
                                <form name="F_editar" id="F_editar" method="POST">
                                <input type="hidden" value="<?php echo $id; ?>"  name="id">
                                <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Numero de Identificacion</label>
                                                <input name="C_NumeroID" id="C_NumeroID" type="text" value="<?php echo $nit; ?>" class="form-control" placeholder="Digite el numero de la Cedula">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Razon Social / Nombres Completos</label>
                                                <input name="C_nombres" id="C_nombres" type="text" value="<?php echo $razon_social; ?>" class="form-control" placeholder="Digite el nombre">
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <input type="submit" class="btn btn-block bg-gradient-orange" name="Registrar" value="ACTUALIZAR" id="Guardar">
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
<script src="ajax_editar.js"></script>




</body>
</html>







