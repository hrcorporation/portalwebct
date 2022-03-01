<?php include '../../../../layout/validar_session4.php' ?>
<?php include '../../../../layout/head/head4.php'; ?>
<?php include 'sidebar.php' ?>

<?php require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php'; ?>

<?php
//Se crea un objeto de la clase cls_importdata
$cls_importdata = new cls_importdata();
//Se crea un objeto de la clase php_clases
$php_clases = new php_clases();
//Se genera el id
$id = $_GET['id'];
//Se le asigna una variable al objeto de cls_importdata y se llama una funcion llamada select_get_biometrico_id la cual necesita un parametro que es el id que se llamo anteriormente
$datos_biometrico = $cls_importdata->select_get_biometrico_id($id);
//Se hace una validacion si la variable datos_biometrico es un arreglo o no
if (is_array($datos_biometrico)) {
    foreach ($datos_biometrico as $key) {
        $fecha = $key['fecha'];
        $cedula = $key['numero_nomina'];
        $nombre = $key['nombre'];
        $h_llegada1 = $key['entrada_1'];
        $h_salida1 = $key['salida_1'];
    }
} else {
    echo "no es un array";
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Biometrico</h1>
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
                <h3 class="card-title">Modificar datos del usuario <b><?php echo $nombre; ?></b> del biometrico</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div id="contenido">
                    <!-- Inicio del formulario -->
                    <form method="POST" name="FormModificarDatosBiometrico" id="FormModificarDatosBiometrico">
                        <input type="hidden" name="txt_id" id="txt_id" value="<?php echo $id ?>">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Nombre: </label>
                                    <input type="text" class="form-control" id="txt_nombre" name="txt_nombre" value="<?php echo $nombre ?>" disabled>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Cedula: </label>
                                    <input type="number" class="form-control" id="txt_cedula" name="txt_nombre" value="<?php echo $cedula ?>" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Fecha: </label>
                                    <input type="date" class="form-control" id="txt_fecha" name="txt_fecha" value="<?php echo $fecha ?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label> Hora llegada 1: </label>
                                    <input type="time" class="form-control" id="txt_h_llegada1" name="txt_h_llegada1" value="<?php echo $h_llegada1 ?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label> Hora salida 1: </label>
                                    <input type="time" class="form-control" id="txt_h_salida1" name="txt_h_salida1" value="<?php echo $h_salida1 ?>">
                                </div>
                            </div>
                        </div>
                        <div class="container">
                            <div class="row" style="text-align:center">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <button type="button" id="btn-eliminar" name="btn-eliminar" class="btn btn-block btn-danger">Eliminar</button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-block btn-success">Guardar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- Fin del formulario -->
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
    $(document).ready(function(e) {
        //Esta funcion ayuda a modificar los datos de la tabla caracteristica del concreto mediante el id del formulario FormModificarCaracteristicasConcreto
        $("#FormModificarDatosBiometrico").on('submit', (function(e) {
            e.preventDefault();
            $.ajax({
                url: "php_editar.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    console.log(data);
                    if (data.estado) {
                        toastr.success('exitoso');

                    } else {
                        toastr.warning(data.errores);
                    }
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        }));
        //Esta funcion ayuda a eliminar los datos de la tabla caracteristica del concreto mediante el id del boton btn-eliminar
        // Funcion en el boton Eliminar
        $("#btn-eliminar").click(function() {
            // definimos variable id para poder eliminar
            var id = <?php echo $id ?>;
            // alerta
            Swal.fire({
                title: 'Esta Seguro(a) de Eliminar la Caracteristica del concreto', // mensaje de la alerta
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'No', // text boton
                confirmButtonText: 'Si Eliminar'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "php_eliminar.php",
                        type: "POST",
                        data: {
                            task: 1,
                            id: id,
                        },
                        success: function(response) {
                            if (response.estado) {
                                Swal.fire(
                                    'La Caracteristica del Concreto fue eliminada correctamente',
                                    'success'
                                )
                                window.location = '../index.php'
                            } else {
                                console.log("error");

                            }
                        },
                        error: function(respuesta) {
                            alert(JSON.stringify(respuesta));
                        },
                    });
                }
            })
        });
    });
</script>
</body>

</html>