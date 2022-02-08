<?php include '../../../layout/validar_session3.php' ?>

<?php
require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php'; ?>
<?php
$php_clases = new php_clases();
$t27_factura = new t27_factura();
$t1_terceros = new t1_terceros();
$t5_obras = new t5_obras();
$t26_remisiones = new t26_remisiones();

$id = $php_clases->HR_Crypt($_GET['id'], 2);

$datos_fact = $t27_factura->select_factura_id($id);

while ($fila_t27 = $datos_fact->fetch(PDO::FETCH_ASSOC)) {
    $numero_factura = $fila_t27['ct27_nombre_factura'];
    $valorfact = $fila_t27['ct27_valorfact'];
    $id_cliente = $fila_t27['ct27_id_cliente'];
    $id_obra = $fila_t27['ct27_id_obra'];
    $archivo_factura = $fila_t27['ct27_archivofact'];
}
?>
<?php include '../../../layout/head/head3.php'; ?>
<?php include 'sidebar.php' ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Factura e</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active"><a href="#">Inicio</a></li>
                        <!--<li class="breadcrumb-item active">Legacy User Menu</li> -->
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">



        <!-- <script type="text/javascript">
        $(document).ready(function (e) {
            $("#buscadorfacturas1").on('submit',(function(e) {
                e.preventDefault();         
                $("#pageMessage").empty();  
                $('#pageContent').hide();
                $('#pageAnimation').show(); 
                var form =  new FormData(this);
                form.append('task', '2');   
                $.ajax({
                    url: "registrar_step1ajax.php",
                    type: "POST",
                    data:  form,
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(data){    

                        $("#pageMessage").html(data);   
                        $('#pageContent').show();
                        $('#pageAnimation').hide();     
                        $('html, body').animate({ scrollTop: $('#slowoffset').offset().top }, 'slow');
                    }
                });
            }));
        });
    </script> -->

        <!-- /.card -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"> Crear Factura </h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <form action="" name="F_EditarFacturae" id="F_EditarFacturae" method="post">
                    <div class="row">
                        <div class="col">
                            <input type="checkbox" name="h_datos" id="h_datos" value="1"><label>Modificar Cliente y obra </label>
                        </div>
                    </div>
                    <input type="hidden" name="id_factura" id="id_factura" value="<?php echo $id; ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> Seleccione Cliente </label>
                                <select class="form-control select2 " style="width: 100%;" id="Txb_IdTercero" name="Txb_IdTercero" aria-hidden="true" disabled="disabled">
                                    <?php echo  $option_cliente  = $t1_terceros->option_cliente_edit($id_cliente);
                                    ?>
                                </select>

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label> Seleccione la Obra </label>
                                <select class="form-control select2 " style="width: 100%;" id="Txb_IdObras" name="Txb_IdObras" aria-hidden="true" disabled="disabled"><?php
                                                                                                                                                                        echo $t5_obras->option_obra_edit($id_cliente, $id_obra);
                                                                                                                                                                        ?>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Razon de la modificacion</label>
                                <br>
                                <input type="text" class="form-control" name="Txb_RazonM" id="Txb_RazonM" disabled="disabled">
                                <br>
                                <input type="checkbox" name=""><label>Aceptar los Terminos</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Titulo de la Factura</label>
                                <br>
                                <input type="text" class="form-control" name="numero_factura" id="numero_factura" value="<?php echo $numero_factura ?>">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>valor de la factura</label>
                                <br>
                                <input type="text" class="form-control" name="valor_factura" value="<?php echo $valorfact ?>">
                            </div>
                        </div><br>
                        <div class="col"><br>
                            <div class="form-group">
                                <h2><?php echo  "$ " .  number_format($valorfact, 2, ',', ' ');  ?></h2>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col-1"></div>
                        <div class="col">
                            <div class="form-group">
                                <label> <input type="radio" class="form-control tipoarchivo" name="subirtipo" value="image/x-png,image/jpeg" required checked=""> Subir Imagen </label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label> <input type="radio" class="form-control tipoarchivo" id="subirpdf" name="subirtipo" value="application/pdf" required> Subir PDF </label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <a href="<?php echo $archivo_factura ?>" class="btn btn-info">Ver Factura</a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <input type="checkbox" name="habi_img" id="habi_img" value="1"><label>Habilitar edicion</label>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Subir Imagen o PDF Seleccione el Archivo</label>
                                <input type="file" class="form-control" name="image" id="image" disabled="disabled">
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">

                                <?php
                                $datos_factura = $t27_factura->buscar_factura_remi($id);
                                $i = 0;

                                while ($fila_fact = $datos_factura->fetch(PDO::FETCH_ASSOC)) {
                                    $i++;
                                    $jsonremi[$fila_fact['ct28_id_remision']] = $fila_fact['ct28_id_fact'];
                                    $remisiones_old[] = $fila_fact['ct28_id_remision'];
                                }

                                


                                ?>
                                <table id="tabla_remi" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Codigo Remision</th>
                                            <th>Imagen </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        $datos_remi = $t26_remisiones->select_remisiones_obra_editFact($id_obra);

                                        $h = 0;
                                        foreach ($datos_remi as $fila_remi) {
                                            $h++;
                                            $id_remi = $fila_remi['ct26_id_remision'];
                                            $codigo_remi = $fila_remi['ct26_codigo_remi'];
                                            $archivo = $fila_remi['ct26_imagen_remi'];
                                            //}

                                        ?>

                                            <tr>
                                                <td><?php echo $h; ?></td>

                                                <td><input type="checkbox" name="remision[]" id="<?php echo $id_remi; ?>" value="<?php echo $id_remi; ?>"><label for="<?php echo $id_remi; ?>"> <?php echo "  " . $codigo_remi; ?></label> </td>
  <?php
                                                if(empty($archivo)){

$archivo = "../ver_remision/remision.php?id=".  $php_clases->HR_Crypt($id_remi, 1);
}
?>
                                                <td><a target="_blank" href="<?php echo $archivo; ?>" class="btn btn-block btn-success btn-sm"> <i class="far fa-eye"></i> ver </a></td>

                                            </tr>
                                        <?php } ?>




                                    </tbody>

                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Codigo Remision</th>
                                            <th>Imagen </th>
                                        </tr>
                                    </tfoot>

                                </table>
                                <script type="text/javascript">
                                    var select = <?php echo json_encode($jsonremi); ?>;

                                    $.each(select, function(key, value) {
                                        $('#' + key).prop('checked', true);
                                    });
                                    $(document).ready(function() {
                                        $('.required_group').click(function() {

                                            var checked = $(".required_group:input[type=checkbox]:checked").length;

                                            if (checked == 0) {
                                                alert("Seleccione minimo una remision, si va vacia no se guardaran cambios.");
                                            }

                                        });
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col"></div>
                        <div class="col">
                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-success">Guardar</button>
                            </div>
                        </div>
                        <div class="col"></div>
                    </div>
                </form>




            </div>
            <!-- /.card-body -->
            <div class="card-footer">

            </div>
            <!-- /.card-footer-->
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?php include '../../../layout/footer/footer3.php' ?>


<script src="ajax_editar.js"></script>

<script>
    $(document).ready(function() {

        $('#h_datos').click(function() {
            if (!$(this).is(':checked')) {
                $("#Txb_IdTercero").prop('disabled', true);
                $("#Txb_IdObras").prop('disabled', true);
                $("#Txb_RazonM").prop('disabled', true);
            } else {
                $("#Txb_IdTercero").prop('disabled', false);
                $("#Txb_IdObras").prop('disabled', false);
                $("#Txb_RazonM").prop('disabled', false);
            }
        });


    })
</script>


<script>
    $(document).ready(function() {
        $('#habi_img').click(function() {
            if (!$(this).is(':checked')) {

                $("#image").prop('disabled', true);
                var archivo_factura = false;


            } else {
                $("#image").prop('disabled', false);
                var archivo_factura = true;

            }
        });


    })
</script>
<script>
    $(document).ready(function() {

        $('#Txb_IdTercero').on('change', function() {
            $.ajax({
                url: "get_data.php",
                type: "POST",
                data: {
                    idCliente: ($('#Txb_IdTercero').val()),
                    task: "1",
                },
                success: function(response) {
                    console.log(response.estado);
                    $('#Txb_IdObras').html(response.obras);
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        });
    })
</script>
<script type="text/javascript">
    function format(input) {
        var num = input.value.replace(/\./g, '');
        if (!isNaN(num)) {
            num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g, '$1.');
            num = num.split('').reverse().join('').replace(/^[\.]/, '');
            input.value = num;
            document.getElementById("h2valor").innerHTML = "$ " + num;
        } else {

            input.value = input.value.replace(/[^\d\.]*/g, '');
        }
    }
    $(document).ready(function() {
        $('.tipoarchivo').change(function() {
            $('#image').attr("accept", $('input[name=subirtipo]:checked').val());
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#tabla_remi').DataTable({
            "scrollY": "500px",
            "scrollCollapse": true,
            "paging": false
        });
    });
</script>

</body>

</html>