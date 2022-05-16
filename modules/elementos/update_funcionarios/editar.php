<?php include '../../../layout/validar_session3.php' ?>
<?php include '../../../layout/head/head3.php'; ?>
<?php include 'sidebar.php' ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>EDITAR ELEMENTO</h1>
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
        $elementos = new elementos();
        $id = $_GET['id'];
        $datos = $elementos->get_funcionarios_id($id);

        if (is_array($datos)) {
            foreach ($datos as $dato) {
                $numero_identificacion = $dato['numero_identificacion'];
                $nombre_funcionario = $dato['nombre_funcionario'];
                $id_cargo = $dato['id_cargo'];
                $id_area = $dato['id_area'];
            }
        }
        ?>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">EDITAR ELEMENTOS</h3>
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
                    <form name="form_editar_funcionario" id="form_editar_funcionario" method="post" content="width=device-width, initial-scale=1">
                        <input type="hidden" name="id" id="id" value="<?= $id ?>">
                        <div class="row">
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Numero de identificacion</label>
                                    <input type="text" name="identificacion" id="identificacion" class="form-control" value="<?= $numero_identificacion ?>" />
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Nombre del funcionario</label>
                                    <input type="text" name="nombre_funcionario" id="nombre_funcionario" class="form-control" value="<?= $nombre_funcionario ?>" />
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Area</label>
                                    <select name="area" id="area" class="form-control select2 ">
                                        <?= $elementos->option_area($id_area); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Cargo</label>
                                    <select name="cargo" id="cargo" class="form-control select2 ">
                                        <?= $elementos->option_cargo($id_cargo); ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-block btn-success">Guardar</button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <button type="button" class="btn btn-block btn-danger" id="btn-eliminar">Eliminar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Default box -->
    </section>
</div>
<?php include '../../../layout/footer/footer3.php' ?>

<script>
    $(function() {
        $(".progress").hide();
        $('.select2').select2();
    });

    $(document).ready(function(e) {
        $("#form_editar_funcionario").on('submit', (function(e) {
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

        $("#btn-eliminar").click(function() {
            var id = <?php echo $id ?>;
            Swal.fire({
                title: 'Esta Seguro(a) de Eliminar el funcionario', // mensaje de la alerta
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
                                    'El elemento epp fue eliminada correctamente'
                                )
                                window.location = '../create_funcionario/crear.php'
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