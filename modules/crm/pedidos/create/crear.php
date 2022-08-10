<?php include '../../../../layout/validar_session4.php' ?>
<?php include '../../../../layout/head/head4.php'; ?>
<?php include 'sidebar.php' ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>REGISTRAR PEDIDO</h1>
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
    <section class="content">
        <?php
        //Se llaman los modelos de las clases de pedidos y oportunidad de negocio.
        $pedidos = new pedidos();
        $oportunidad_negocio = new oportunidad_negocio();
        ?>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">CREAR PEDIDO</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="progress">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 0.5%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"> <span class=" text_progresbar">0% </span>
                    </div>
                </div>
                <div id="contenido">
                    <!-- INICIO DEL FORMULARIO -->
                    <form name="form_crear_pedido" id="form_crear_pedido" method="post" content="width=device-width, initial-scale=1">
                        <div class="row">
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>NOMBRE DEL CLIENTE:</label>
                                    <select name="id_cliente" id="id_cliente" class="form-control select2" required="true">
                                        <?= $pedidos->option_cliente_edit(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>NOMBRE DE LA OBRA:</label>
                                    <select name="id_obra" id="id_obra" class="form-control select2" required="true">

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>FECHA DE VENCIMIENTO:</label>
                                    <input type="date" name="fecha_vencimiento" id="fecha_vencimiento" class="form-control" required="true"/>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>ASESORA COMERCIAL:</label>
                                    <select name="asesora_comercial" id="asesora_comercial" class="form-control select2" required="true">
                                        <?php echo $oportunidad_negocio->select_comercial() ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-block btn-success"><i class="fas fa-save"></i> Guardar</button>
                                </div>
                            </div>
                        </div>
                        <!-- BOTON DE GUARDAR -->
                    </form>
                    <!-- FIN DEL FORMULARIO -->
                </div>
            </div>
        </div>
        <!-- Default box -->
    </section>
</div>
<?php include '../../../../layout/footer/footer4.php' ?>

<script>
    $(function() {
        $(".progress").hide();
        $('.select2').select2();
    });
    //Listar las obras que estan relacionadas con el cliente seleccionado actualmente.
    $(document).ready(function() {
        $("#id_cliente").change(function() {
            $.ajax({
                url: "load_data.php",
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
    //Crear el pedido y lo redirige a otra vista donde se agregan los productos, bombas u otros servicios.
    $(document).ready(function(e) {
        $("#form_crear_pedido").on('submit', (function(e) {
            e.preventDefault();
            $.ajax({
                url: "php_crear.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    console.log(data);
                    if (data.estado) {
                        toastr.success('Se ha guardado correctamente');
                        window.location = '../editar/editar.php?id=' + data.id;
                    } else {
                        toastr.warning(data.errores);
                    }
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        }));
    });
</script>