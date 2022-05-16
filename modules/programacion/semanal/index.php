<?php include '../../../layout/validar_session3.php' ?>
<?php include '../../../layout/head/head3.php'; ?>
<?php include 'sidebar.php' ?>

<!-- Content Wrapper. Contains page content -->

+
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>PROGRAMACION SEMANAL</h1>

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
                <h3 class="card-title">VER PROGRACIONES SEMANALES</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                </div>
            </div>
            <div class="card-body">
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
<?php include 'modal_crear_event.php' ?>
<?php include 'modal_mostrar_event.php' ?>

<!-- /.modal-dialog -->



<?php include '../../../layout/footer/footer3.php' ?>

<script src="calendar.js"> </script>
<script>
$(document).ready(function() {
    $.ajax({
            url: "load_select.php",
            type: "POST",
            data: {
                task : 1,
            },
            success: function(response) {
                console.log(response.estado);
                if (response.estado) {
                   
                } else {
                    toastr.warning("Error");
                }
            },
            error: function(respuesta) {
                alert(JSON.stringify(respuesta));
                
            },
        });
});
</script>
</body>

</html>