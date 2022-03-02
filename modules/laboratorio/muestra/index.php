<?php include '../../../layout/validar_session3.php' ?>
<?php include '../../../layout/head/head3.php'; ?>
<?php include 'sidebar.php' ?>

<?php require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php'; ?>

<?php









?>

<!-- Content Wrapper. Contains page conted   v}nt -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Muestra</h1>
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



                <h3 class="card-title"> Tabla Muestras </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>

                </div>
            </div>
            <div class="card-body">
                <div id="contenido">

                   <table id="t_muestras" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>N</th>
                            <th>fecha</th>
                            <th>hora</th>
                            <th>Remision</th>
                            <th>Cliente</th>
                            <th>Obra</th>
                            <th>Producto</th>
                            <th>Detalle</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                   </table>


                </div>
                <!-- </form> -->
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">

        </div>
</div>

</section>
</div>



<?php include '../../../layout/footer/footer3.php' ?>

<script>
    $(document).ready(function() {
        var n = 1;
        var table = $('#t_muestras').DataTable({
            //"processing": true,
            //"scrollX": true,
            "ajax": {
                "url": "data_table_muestras.php",
                "dataSrc": ""
            },

            "order": [
                [0, 'desc']
            ],
  
            "columns": [
                {
                    "data": "id_muestra"
                },
                {
                    "data": "fecha"
                },
                {
                    "data": "hora"
                },
                {
                    "data": "cod_remision"
                },
                {
                    "data": "nombre_cliente"
                },
                {
                    "data": "nombre_obra"
                },
                {
                    "data": "id_producto"
                }, 
                {
                    "data": null,
                    "defaultContent": "<button class='btn btn-warning btn-sm'> <i class='fas fa-eye'></i> </button>"
                }
               
            ],
            //"scrollX": true,

        });

        table.on('order.dt search.dt', function() {
            table.column(0, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();
        $('#t_muestras tbody').on('click', 'button', function() {
            var data = table.row($(this).parents('tr')).data();
            var id = data['id_muestra'];
            window.location = "/update.php?id=" + id;
        });

        setInterval(function() {
            table.ajax.reload(null, false);
        }, 10000);


    });
</script>

<script>
    $(document).ready(function() {
        $('.select2').select2();

    });
    $(document).ready(function() {
        $("#form_subir_plano").on('submit', (function(e) {
            e.preventDefault();

            $.ajax({
                url: "php_subir.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {

                    const datos_errores = Object.values(data.errores);
                    console.log(datos_errores);
                    if (data.estado) {
                        toastr.success('exitoso');

                    } else {
                        for (let index = 0; index < datos_errores.length; index++) {

                            toastr.warning(data.errores[index]);
                        }
                    }
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        }));
    });
</script>

</body>

</html>