<?php include '../../../layout/validar_session_cliente3.php' ?>
<?php include '../../../layout/head/headcliente3.php' ?>
<?php include 'sidebar.php' ?>
<?php $clsProgramacion = new clsProgramacion(); ?>
<?php $intIdUsuario = $_SESSION['id_usuario']; ?>
<?php $id = $_GET['programacion']?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
                        <strong> <?php echo $_SESSION['nombre_usuario']; ?> </strong> Bienvenido al <strong style="color:#ac4661">PORTAL DE CLIENTES</strong>
                    </h1>
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
    <input type="hidden" name="txtNombre" id="txtNombre" class="form-control" style="width: 100%;" value="<?= $id ?>" />
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">PORTAL DE CLIENTES</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="txtCliente" class="col-sm-2 form-label h4">Cliente</label>
                            <?php echo $clsProgramacion->option_cliente_edit_cliente($intIdUsuario); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <div id="id_obra">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <div id="txtObra">
                                <?php echo $clsProgramacion->option_obra_edit_uno($intIdUsuario, $id) ?>
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

<!-- Modal -->
<!-- /.modal-dialog -->
<?php include '../../../layout/footer/footercliente3.php' ?>
<script>
    $(function() {
        $('.select2').select2();
        var cliente = $("#txtCliente").val();
        if (cliente != null) {
            $("#txtObra").hide();
        }
    });
    $(document).ready(function() {
        $("#txtCliente").change(function() {
            $("#txtObra").hide();
            $.ajax({
                url: "load_data.php",
                type: "POST",
                data: {
                    'task': 1,
                    'id_cliente': $('#txtCliente').val(),
                    'nombre': $('#txtNombre').val()
                },
                dataType: 'json',
                success: function(data) {
                    $('#id_obra').html(data.obras);
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        });
    });
</script>
</body>

</html>