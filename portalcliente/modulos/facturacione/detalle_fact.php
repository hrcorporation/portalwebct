<?php include '../../../layout/validar_session_cliente3.php' ?>

<?php include '../../../layout/head/headcliente3.php'; ?>
<?php include 'sidebar.php' ?>

<?php include '../../../include/LibreriasHR.php'?>


<?php 

require '../../../librerias/autoload.php';
include '../../../modelos/autoload.php';
include '../../../vendor/autoload.php';

?>
<?php include 'sidebar.php' ?>
<?php 
switch($rol_user)
{
    case 101:
        $php_clases = new php_clases();
        $LibreriasHR = new LibreriasHR();
        $t27_factura = new t27_factura();
        $t1_terceros = new t1_terceros(); 
        $t26_remisiones = new t26_remisiones();
        $t5_obras = new t5_obras();

    break;

    default:
        print( '<script> window.location = "../../../cerrar.php"</script>');
    
    break;
}

$id = $LibreriasHR->HR_Crypt($_GET['id'],2);
?>





            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>Detalle de la Factura</h1>
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

                        <?php 
                $datos_factura = $t27_factura->select_factura_id($id);
                while($fila_factura = $datos_factura->fetch(PDO::FETCH_ASSOC)){
                    
                    $nombre_factura = $fila_factura['ct27_nombre_factura'];
                    $fecha_subda = $fila_factura['ct27_fecha_subda'];
                    $valor_factura = $fila_factura['ct27_valorfact'];
                    $archivo_fact = $fila_factura['ct27_archivofact'];
                    
                   
                    $id_obra = $fila_factura['ct27_id_obra'];


                }

?>
                        <div>
                        <div class="row justify-content-center ">

            								<div class="col-4">
            									<!-- form-group -->
            									<div class="form-group">
            										
            										<a href="<?php echo htmlspecialchars($archivo_fact); ?>" target="_blank"><img src="factura.jpg" width="70%" height="160px"></a>
            									</div>
            									<!-- /.form-group -->
            								</div>
            								<div class="col-4">
            									<div class="form-group">
            										<h3> Factura Numero : <?php echo htmlspecialchars($nombre_factura);?>.</h3>
            										<hr>
            										<h3> Fecha Subida : <?php echo htmlspecialchars($fecha_subda);?></h3>
            										<hr>
            										<h3> Valor Total: $ <?php echo htmlspecialchars(number_format($valor_factura));?></h3>

            									</div>
            								</div>
            							</div>
                        </div>
<hr>
<div>
<div class="row justify-content-center">
            								<div class="col-10">
            									<div class="form-group">
            										<h4> Identificacion : <?php //echo htmlspecialchars($fila['cliCednit']);?></h4>
            										<hr>
            										<h4> Cliente : <?php //echo htmlspecialchars($fila['cliNombre']);?> </h4>
            										<hr>
            										<h4> OBRA : <?php //echo htmlspecialchars($fila['nombreObra']);?></h4>
            										<hr>
            										<h4> Direccion de la Obra: <?php //echo htmlspecialchars($fila['direccionObra']);?></h4>
            										<hr>
            									</div>
            								</div>

            							</div>
            							<br>
            							
</div>
<hr>
<div>
<table id="example1" class="table table-bordered table-striped">
            									<thead >
            										<tr>
            											<th>Nº</th>
            											<th width="70%">Codigo</th>
            											<th > Archivo</th>
            											<th > Descargar</th>
            										</tr>
            									</thead>
                                                <tbody>
                                                <?php
                                                $i = 0;
                    $dato_factura_remi =  $t27_factura->buscar_factura_remi($id);
                    while($fila_factremi = $dato_factura_remi->fetch(PDO::FETCH_ASSOC)){
                        $i++;
                        $id_remision = $fila_factremi['ct28_id_remision'];
                     
                    
                        
                    $dato_remi=  $t26_remisiones->get_remision_id($id_remision);


                        while($fila_remi = $dato_remi->fetch(PDO::FETCH_ASSOC)){
                            $codigo_remi = $fila_remi['ct26_codigo_remi'];
                            $archivo = $fila_remi['ct26_imagen_remi'];
                        }
                            
                        

                 


?>

<tr>
<td><?php echo $i; ?></td>
<td><?php echo $codigo_remi; ?></td>
<?php
if(empty($archivo)){

$archivo = "ver_remision/remision.php?id=".  $php_clases->HR_Crypt($id_remision, 1);
}
?>

<td><a class="btn btn-block bg-gradient-success" href="<?php echo htmlspecialchars($archivo); ?>" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
<td><a class="btn btn-block bg-gradient-success" href="<?php echo htmlspecialchars($archivo); ?>" download><i class="fa fa-download" aria-hidden="true"></i></a></td>

</tr>

                <?php } ?>


                                                </tbody>
                                                <tfooter>
                                                </tfooter>
                                                </table>
</div>




<br>
<hr>
<hr>
                        
                        
                                                    <div id="contenido">







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
            


            <?php include '../../../layout/footer/footercliente3.php' ?>

    <script src="../../../plugins/datatables/datatables.js"></script>
       
        <script>
        $(document).ready(function() {
    $('#example1').DataTable();
} );
        </script>

    </body>
</html>
