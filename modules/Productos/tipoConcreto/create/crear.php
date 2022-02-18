<?php include '../../../../layout/validar_session4.php' ?>
<?php include '../../../../layout/head/head4.php'; ?>
<?php include 'sidebar.php' ?>

<?php require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php'; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tipo de concreto</h1>
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
                <h3 class="card-title">Crear tipo de concreto</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div id="contenido">
                    <form method="POST" name="FormCrearTipoConcreto" id="FormCrearTipoConcreto">
                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
                                    <label> Codigo TConcreto </label>
                                    <input type="text" class="form-control" id="Txb_CodTConcreto" name="Txb_CodTConcreto">
                                </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                                    <label> Descripcion TC </label>
                                    <input type="text" class="form-control" id="Txb_DescripcionTC" name="Txb_DescripcionTC">
                                </div>
                            </div>
                        </div>
                        <div class="container">
                            <div class="row" style="text-align:center">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-block btn-success">Guardar</button>
                                    </div>
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

<?php include '../../../../layout/footer/footer4.php' ?>


<script>
    $(function() {
        $("#example1").DataTable();
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
        });
        //Initialize Select2 Elements
        $('.select2').select2()
    });
</script>
<script>
    $(function() {
        $(document).ready(function(e) {
            /**********************************************************************************************************************************/
            // LISTA CLIENTE      - cheke  
            /**********************************************************************************************************************************/
            $.ajax({
                url: "get_datosConcreto.php",
                type: "POST",
                data: {
                    tipo: "Get_DatosConcreto",
                    task: "1",
                },
                success: function(response) {

                    if (response.estado) {
                        $('#Txb_CodTConcreto').html(response.CodTConcreto);
                        $('#Txb_DescripcionTC').html(response.DescripcionTC);
                    } else {
                        console.log(response.msg);
                    }
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                }
            });
            ////////////////////////////////////////////////////
            $('#Txb_TipoConcreto').on('change', function() {
                $('#CodigoConcreto').html("");
                $('#DescripcionConcreto').html("");
                $.ajax({
                    url: "GetDatos.php",
                    type: "POST",
                    data: {
                        Txb_TipoConcreto: ($('#Txb_TipoConcreto').val()),
                        Txb_ResistenciaConcreto: ($('#Txb_ResistenciaConcreto').val()),
                        Txb_TMAgregado: ($('#Txb_TMAgregado').val()),
                        Txb_CrtConcreto: ($('#Txb_CrtConcreto').val()),
                        Txb_ColorConcreto: ($('#Txb_ColorConcreto').val()),

                        tipo: "Get_Datos1",
                        task: "2",
                    },
                    success: function(response) {

                        $('#Txb_CodigoSyscafe').html(response.CodigoF);
                        $('#CodigoConcreto').html(response.CodigoF);
                        $('#DescripcionConcreto').html(response.DescpF);
                        $('#Txb_Nombre').val(response.CodigoF);
                        $('#Txb_Descripcion').val(response.DescpF);
                    },
                    error: function(respuesta) {

                        alert(JSON.stringify(respuesta));
                    }
                });
            });
            ///////////////////////////////////////////////////
            ////////////////////////////////////////////////////
            $('#Txb_ResistenciaConcreto').on('change', function() {
                $('#CodigoConcreto').html("");
                $('#DescripcionConcreto').html("");
                $.ajax({
                    url: "GetDatos.php",
                    type: "POST",
                    data: {
                        Txb_TipoConcreto: ($('#Txb_TipoConcreto').val()),
                        Txb_ResistenciaConcreto: ($('#Txb_ResistenciaConcreto').val()),
                        Txb_TMAgregado: ($('#Txb_TMAgregado').val()),
                        Txb_CrtConcreto: ($('#Txb_CrtConcreto').val()),
                        Txb_ColorConcreto: ($('#Txb_ColorConcreto').val()),
                        tipo: "Get_Datos1",
                        task: "2",
                    },
                    success: function(response) {


                        $('#CodigoConcreto').html(response.CodigoF);
                        $('#DescripcionConcreto').html(response.DescpF);
                        $('#Txb_Nombre').val(response.CodigoF);
                        $('#Txb_Descripcion').val(response.DescpF);
                    },
                    error: function(respuesta) {

                        alert(JSON.stringify(respuesta));

                    }
                });
            });
            ///////////////////////////////////////////////////
            ////////////////////////////////////////////////////
            $('#Txb_TMAgregado').on('change', function() {
                $.ajax({
                    url: "GetDatos.php",
                    type: "POST",
                    data: {

                        Txb_TipoConcreto: ($('#Txb_TipoConcreto').val()),
                        Txb_ResistenciaConcreto: ($('#Txb_ResistenciaConcreto').val()),
                        Txb_TMAgregado: ($('#Txb_TMAgregado').val()),
                        Txb_CrtConcreto: ($('#Txb_CrtConcreto').val()),
                        Txb_ColorConcreto: ($('#Txb_ColorConcreto').val()),
                        tipo: "Get_Datos1",
                        task: "2",
                    },
                    success: function(response) {

                        $('#CodigoConcreto').html(response.CodigoF);
                        $('#DescripcionConcreto').html(response.DescpF);
                        $('#Txb_Nombre').val(response.CodigoF);
                        $('#Txb_Descripcion').val(response.DescpF);

                    },
                    error: function(respuesta) {

                        alert(JSON.stringify(respuesta));

                    }
                });
            });

            ///////////////////////////////////////////////////

            ////////////////////////////////////////////////////
            $('#Txb_CrtConcreto').on('change', function() {
                $.ajax({
                    url: "GetDatos.php",
                    type: "POST",
                    data: {

                        Txb_TipoConcreto: ($('#Txb_TipoConcreto').val()),
                        Txb_ResistenciaConcreto: ($('#Txb_ResistenciaConcreto').val()),
                        Txb_TMAgregado: ($('#Txb_TMAgregado').val()),
                        Txb_CrtConcreto: ($('#Txb_CrtConcreto').val()),
                        Txb_ColorConcreto: ($('#Txb_ColorConcreto').val()),
                        tipo: "Get_Datos1",
                        task: "2",
                    },
                    success: function(response) {

                        $('#CodigoConcreto').html(response.CodigoF);
                        $('#DescripcionConcreto').html(response.DescpF);
                        $('#Txb_Nombre').val(response.CodigoF);
                        $('#Txb_Descripcion').val(response.DescpF);
                    },
                    error: function(respuesta) {

                        alert(JSON.stringify(respuesta));

                    }
                });
            }); ////////////////////////////////////////////////////
            $('#Txb_ColorConcreto').on('change', function() {
                $.ajax({
                    url: "GetDatos.php",
                    type: "POST",
                    data: {

                        Txb_TipoConcreto: ($('#Txb_TipoConcreto').val()),
                        Txb_ResistenciaConcreto: ($('#Txb_ResistenciaConcreto').val()),
                        Txb_TMAgregado: ($('#Txb_TMAgregado').val()),
                        Txb_CrtConcreto: ($('#Txb_CrtConcreto').val()),
                        Txb_ColorConcreto: ($('#Txb_ColorConcreto').val()),
                        tipo: "Get_Datos1",
                        task: "2",
                    },
                    success: function(response) {

                        $('#CodigoConcreto').html(response.CodigoF);
                        $('#DescripcionConcreto').html(response.DescpF);
                        $('#Txb_Nombre').val(response.CodigoF);
                        $('#Txb_Descripcion').val(response.DescpF);
                    },
                    error: function(respuesta) {
                        alert(JSON.stringify(respuesta));
                    }
                });
            });

        });
    });
</script>
<script src="ajax_crear.js"> </script>

</body>

</html>