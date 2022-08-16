<?php include '../../../../layout/validar_session4.php' ?>
<?php include '../../../../layout/head/head4.php'; ?>
<?php include 'sidebar.php';
$clslistaprecio = new clslistaprecio();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Exportar</h1>
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
                <form id="form-informe-op" name="form-informe-op" method="GET" action="excel.php">
                    <div id="contenido">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Codigo del listado de precios</label>
                                    <select name="codigo" id="codigo" class="form-control select2 ">
                                        <?= $clslistaprecio->select_pedidos_id(); ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h5>Seleccionar el cliente y obra</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Nombre del cliente</label>
                                    <select name="id_cliente" id="id_cliente" class="form-control select2 ">
                                        <?= $clslistaprecio->option_cliente_edit(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Nombre de la obra</label>
                                    <select name="id_obra" id="id_obra" class="form-control select2 ">

                                    </select>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-2">
                                <button class="btn btn-block bg-gradient-success"> <i class="fas fa-file-excel"></i> Exportar </button>
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

<?php include '../../../../layout/footer/footer4.php' ?>

<script>
    $(function() {
        $(".progress").hide();
        $('.select2').select2();
    });

    $(document).ready(function() {
        $("#id_cliente").change(function() {
            $.ajax({
                url: "../create/load_data.php",
                type: "POST",
                data: {
                    'task': 1,
                    'id_cliente': $('#id_cliente').val()
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

    $("#codigo").change(function() {
        var producto = $("#codigo").val();
        console.log(producto);
        if (producto >= 1) {
            $("#id_cliente").attr('disabled', true);
            $("#id_obra").attr('disabled', true);
        } else {
            $("#id_cliente").attr('disabled', false);
            $("#id_obra").attr('disabled', false);
        }
    });

    $("#id_cliente").change(function() {
        var cliente = $("#id_cliente").val();
        console.log(cliente);
        if (cliente >= 1) {
            $("#codigo").attr('disabled', true);
        } else {
            $("#codigo").attr('disabled', false);
        }
    });
</script>

</body>

</html>