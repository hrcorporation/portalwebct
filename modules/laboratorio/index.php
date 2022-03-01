<?php include '../../layout/validar_session2.php' ?>
<?php include '../../layout/head/head2.php'; ?>
<?php include 'sidebar.php' ?>



<?php
// Cargar Clases clases

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <!-- TITULO DE LA PAGINA -->
                    <h1>Muestras</h1>
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
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                            class="fas fa-expand"></i></button>
                </div>
            </div>
            <div class="card-body">
                <!-- Tabla de Muestras -->
                <table id="t_muestras" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>N</th>
                            <th>Nmuestra</th>
                            <th>Concreto</th>
                            <th>N Muestras</th>
                            <th>std</th>
                            <th style="width:100px">Detalle</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfooter>
                        <tr>
                            <th>N</th>
                            <th>Nmuestra</th>
                            <th>Concreto</th>
                            <th>N Muestras</th>
                            <th>std</th>
                            <th style="width:100px">Detalle</th>
                        </tr>
                    </tfooter>
                </table>
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

<!-- Se importa los scripts de la pagina -->
<?php include '../../layout/footer/footer2.php' ?>


<script>
$(document).ready(function() {
    var n = 1;
    // DataTable de Muestras
    var table = $('#t_muestras').DataTable({
        //"processing": true,
        //"scrollX": true,
        "ajax": {
            // archivo php para importar la data
            "url": "datatable_muestras.php",
            "dataSrc": ""
        },

        "order": [
            [0, 'desc']
        ],
        "columns": [
            // los datos que se importan debe tener el mismo nombre que el objeto
            {
                "data": "id"
            },
            {
                "data": "id"
            },
            {
                "data": "id"
            },
            {
                "data": "id"
            },
            {
                "data": "id"
            },
            {
                "data": null,
                "defaultContent": "<button class='btn btn-warning btn-sm btn_editar'> <i class='fas fa-edit'></i> </button>"
            }
        ],
        //"scrollX": true,

    });

    // se Ordena la tabla.
    table.on('order.dt search.dt', function() {
        table.column(0, {
            search: 'applied',
            order: 'applied'
        }).nodes().each(function(cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();

    /**
     * Definimos la accion del boton al hacer clic.
     * button y la clase btn_editar que se ubica en el html que insertamos 
     */
    $('#t_muestras tbody').on('click', 'button.btn_editar', function() {
        /**
         * Al hacer clic en la fila traemos los datos de esa fila
         */
        var data = table.row($(this).parents('tr')).data();
        var id = data['id']; // obtenemos el id
        // la accion de Rederigir al editar.
        window.location = "update/editar.php?id=" + id;
    });

    // Funcion que se repite cada milesima de segundo
    setInterval(function() {
        // Recargar datosd de la tabla
        table.ajax.reload(null, false);
    }, 10000);



});
</script>
</body>

</html>