<?php include '../../../../layout/validar_session4.php' ?>
<?php include '../../../../layout/head/head4.php'; ?>
<?php include 'sidebar.php' ?>
<?php
$clsProgramacionSemanal = new clsProgramacionSemanal;
$pedidos = new pedidos();
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>REGISTRAR PROGRAMACION</h1>
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
        //Se llaman los modelos de las clases de programacion
        $id = $_GET['id_pedido'];
        $id_precio_producto = $_GET['id_producto'];
        $id_producto = $clsProgramacionSemanal->fntGetIdProductoObj($id_precio_producto);
        // SE LLAMA UNA FUNCION PARA OBTENER EL CLIENTE Y LA OBRA DEL PEDIDO
        $datos = $pedidos->get_nombre_cliente_obra($id);
        // SE VA LISTANDO MEDIANTE UN FOREACH
        foreach ($datos as $dato) {
            $nombre_cliente = $dato['nombre_cliente'];
            $nombre_obra = $dato['nombre_obra'];
            $id_cliente = $dato['id_cliente'];
            $id_obra = $dato['id_obra'];
        }
        ?>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">CREAR PROGRAMACION</h3>
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
                    <form name="form_crear_programacion" id="form_crear_programacion" method="post">
                        <input type="hidden" name="id" id="id" value="<?= $id ?>">
                        <input type="hidden" name="id_producto" id="id_producto" value="<?= $id_producto ?>">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Cliente:</label>
                                    <input type="hidden" name="txtCliente" id="txtCliente" class="form-control" style="width: 100%;" value="<?= $id_cliente ?>" />
                                    <br>
                                    <b><?= $nombre_cliente ?></b>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Obra:</label>
                                    <input type="hidden" name="txtObra" id="txtObra" class="form-control" style="width: 100%;" value="<?= $id_obra ?>" />
                                    <br>
                                    <b><?= $nombre_obra ?></b>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="txtElementos" class="form-label">Fecha fundida:</label>
                                    <input type="date" name="txtFechaFundida" id="txtFechaFundida" class="form-control" style="width: 100%;" />
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="txtcantidadmetros" class="form-label">Cantidad metros cubicos:</label>
                                    <input type="number" name="txtcantidadmetros" id="txtcantidadmetros" class="form-control" style="width: 100%;" />
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-group">
                                    <label for="txtFrecuencia" class="form-label">Frecuencia:</label>
                                    <select name="cbxFrecuencia" id="cbxFrecuencia" class="form-control select2" style="width: 100%;">
                                        <?= $clsProgramacionSemanal->fntOptionFrecuenciaEditObj(); ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <div class="form-check">
                                        <label class="form-label"></label>
                                        <br>
                                        <input class="form-check-input" type="checkbox" value="1" id="chkRequiereBomba" name="chkRequiereBomba">
                                        <label for="chkRequiereBomba" class="form-check-label" for="flexCheckDefault">
                                            <b>Requiere bomba de Concre Tolima</b>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="txtHoraBomba" class="form-label">Hora bomba sugerida por cliente:</label>
                                    <input type="time" name="txtHoraBomba" id="txtHoraBomba" class="form-control" style="width: 100%;" />
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <div class="form-check">
                                        <label class="form-label"></label>
                                        <br>
                                        <input class="form-check-input" type="checkbox" value="1" id="chkRequiereAjuste" name="chkRequiereAjuste">
                                        <label for="chkRequiereAjuste" class="form-check-label" for="flexCheckDefault">
                                            <b>Requiere ajuste</b>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="txtEspesorPlaca" class="form-label">Espesor de la placa:</label>
                                    <input type="number" name="txtEspesorPlaca" id="txtEspesorPlaca" class="form-control" style="width: 100%;" />
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <div class="form-check">
                                        <label class="form-label"></label>
                                        <br>
                                        <input class="form-check-input" type="checkbox" value="1" id="chkRequiereSiso" name="chkRequiereSiso">
                                        <label for="chkRequiereSiso" class="form-check-label" for="flexCheckDefault">
                                            <b>Requiere SISO</b>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Linea de despacho:</label>
                                    <select name="cbxlineadespacho" id="cbxlineadespacho" class="form-control select2" style="width: 100%;">
                                        <?= $clsProgramacionSemanal->fntOptionLineaDespachoObj() ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="txtHoraCargue" class="form-label">Hora de cargue:</label>
                                    <input type="time" name="txtHoraCargue" id="txtHoraCargue" class="form-control" style="width: 100%;" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="txtObservaciones" class="form-label">Observaciones:</label>
                                    <input type="text" name="txtObservaciones" id="txtObservaciones" class="form-control" style="width: 100%;" />
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" id="btnCrear"> Guardar </button>
                        </div>
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
    $("#form_crear_programacion").on('submit', (function(e) {
        e.preventDefault();
        $.ajax({
            url: "php_crear_programacion.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                console.log(data);
                if (data.estado) {
                    toastr.success('Se ha guardado correctamente la programacion');
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