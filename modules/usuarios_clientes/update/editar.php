<?php include '../../../layout/validar_session3.php' ?>

<?php include '../../../layout/head/head3.php'; ?>
<?php include 'sidebar.php' ?>

<?php require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php'; ?>
         <?php 
    $php_clases = new php_clases();
  
    $t1_terceros = new t1_terceros(); 
    $t5_obras = new t5_obras();
  
    
    $id = $php_clases->HR_Crypt($_GET['id'], 2);

$datos_tercero = $t1_terceros->search_tercero_custom_id($id);

while($fila_t1 = $datos_tercero->fetch(PDO::FETCH_ASSOC)){
    $numero_identificacion = $fila_t1['ct1_NumeroIdentificacion'];
    $nombre1 = $fila_t1['ct1_Nombre1'];
    $apellido1 = $fila_t1['ct1_Apellido1'];
    $id_obra = $fila_t1['ct1_obra_id'];
    $id_cliente1 = $fila_t1['ct1_id_cliente1'];




}
?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>Usuarios Clientes</h1>
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
                            <h3 class="card-title">Editar Usuario Cliente</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>

                            </div>
                        </div>
                        <div class="card-body">
                            <div id="contenido">
                                <form name="F_editar" id="F_editar" method="POST">
                                    <input type="hidden" name="id" id="id" value="<?php echo $id ?>">

  
                                    <script> var id = <?php echo json_encode($id);?>; </script>

                                    <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Seleccionar cliente</label>
                                    <select class="js-example-basic-single select2 form-control" id="C_IdTerceros" name="C_IdTerceros" required>
                                        <?php echo $t1_terceros->option_cliente_edit($id_cliente1); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label> Selecccionar Obra</label>
                                    <select class="js-example-basic-single select2 form-control" id="C_Obras" name="C_Obras">
                                        <?php  echo $t5_obras->option_obra_edit($id_cliente1, $id_obra);
                                        ?>
                                    </select>
                                </div>
                               
                            </div>
                        </div>


                        <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Numero de Cedula de ciudadania</label>
                                                <input name="C_NumeroID" id="C_NumeroID" type="text" class="form-control" placeholder="Digite el numero de la Cedula" value="<?php echo $numero_identificacion; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Nombres Completos</label>
                                                <input name="C_nombres" id="C_nombres" type="text" class="form-control" value="<?php echo $nombre1; ?>" placeholder="Digite el nombre">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Apellidos Completos</label>
                                                <input name="C_Apellidos" id="C_Apellidos" type="text" class="form-control"  value="<?php echo $apellido1 ?>"placeholder="Digite los Apellidos">
                                            </div>
                                        </div>
                                    </div>
                               <div class="row">
                            
                            <div class="col">
                                <div class="form-group">
                                    <button type="submit"  class="btn btn-block btn-info" >Guardar</button>
                                    
                                </div>
                            </div>
                            <div class="col"><button type="button" name="btn-restablecer" id="btn-restablecer"  class="btn btn-block bg-gradient-warning" >Restablecer Contraseña</button></div>
                            <div class="col"> <div class="form-group">
                                    <button type="button" class="btn btn-block btn-danger" id="btn-eliminar" > Eliminar Usuario</button>
                                    
                                </div> </div>
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
    $(document).ready(function () {
        $('.select2').select2();

    });

    </script>
    
    <script>
    $(document).ready(function() {

        $('#C_IdTerceros').on('change', function() {
            $.ajax({
                url: "get_data.php",
                type: "POST",
                data: {
                    idCliente: ($('#C_IdTerceros').val()),
                    task: "1",
                },
                success: function(response) {
                    console.log(response.estado);
                    $('#C_Obras').html(response.obras);
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        });
    })
</script>
    <script src="ajax_editar.js"> </script>
    <script src="ajax_restablecer_pass.js"> </script>
    <script src="ajax_eliminar.js"> </script>
</body>
</html>







