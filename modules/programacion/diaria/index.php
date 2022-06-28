<?php include '../../../layout/validar_session3.php'; ?>
<?php include '../../../layout/head/head3.php'; ?>
<?php include 'sidebar.php'; ?>
<?php $programacionDiaria = new ClsProgramacionDiaria(); //Se crea un objeto de la clase programacion 
?>
<?php $intCantidadProgramacionSinConfirmar = $programacionDiaria->fntContarProgramacionesSinConfirmarFuncionarioObj(); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>PROGRAMACION DIARIA</h1>
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
                <h3 class="card-title">VER PROGRAMACIONES DIARIAS</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="col-1">
                    <div class="form-group">
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <div class="form-group">
                            <span style="position: absolute; right: 20%; top: 40%" class="badge bg-secondary"><?= $intCantidadProgramacionSinConfirmar ?> - Sin Confirmar</span>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label class="form-label">Linea de despacho</label>
                            <select name="cbxFrecuencia" id="cbxFrecuencia" class="form-control select2" style="width: 100%;">
                                <?= $programacionDiaria->fntOptionLineaDespachoObj() ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                        </div>
                    </div>
                </div>
                <div id='calendar'></div>
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
<?php include 'modal_crear_programacion.php' ?>
<?php include 'modal_editar_programacion.php' ?>
<?php include 'modal_confirmar_programacion.php' ?>
<?php include 'modal_informativo.php' ?>

<!-- /.modal-dialog -->

<?php include '../../../layout/footer/footer3.php' ?>

<script src="calendar.js">
</script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
    $('#cbxCliente').on('change', function() {
        //Ajax 
        var formData = new FormData();
        formData.append('task', 2);
        formData.append('cliente', $("#cbxCliente").val());
        $.ajax({
            url: "load_data.php", // URL
            type: "POST", // Metodo HTTP
            //data: formData,
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $("#cbxObra").html(data.select_obra)
            },
            error: function(respuesta) {
                alert(JSON.stringify(respuesta));
            },
        });
    });

    $('#cbxClienteEditar').on('change', function() {
        //Ajax 
        var formData = new FormData();
        formData.append('task', 2);
        formData.append('cliente', $("#cbxClienteEditar").val());
        $.ajax({
            url: "load_data.php", // URL
            type: "POST", // Metodo HTTP
            //data: formData,
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $("#cbxObraEditar").html(data.select_obra)
            },
            error: function(respuesta) {
                alert(JSON.stringify(respuesta));
            },
        });
    });

    $("#form_crear_programacion").on('submit', (function(e) {
        e.preventDefault();
        $.ajax({
            url: "php_crear_prog_diaria.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                console.log(data);
                if (data.estado) {
                    toastr.success('Se ha guardado correctamente');
                } else {
                    toastr.warning(data.errores);
                }
            },
            error: function(respuesta) {
                alert(JSON.stringify(respuesta));
            },
        });
    }));

    $("#form_mostrar_programacion").on('submit', (function(e) {
        e.preventDefault();
        $.ajax({
            url: "php_editar_prog_diaria.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                console.log(data);
                if (data.estado) {
                    toastr.success('Se ha guardado correctamente');
                } else {
                    toastr.warning(data.errores);
                }
            },
            error: function(respuesta) {
                alert(JSON.stringify(respuesta));
            },
        });
    }));
</script>
</body>

</html>