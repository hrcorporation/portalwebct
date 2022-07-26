<?php include '../../../layout/validar_session3.php' ?>
<?php include '../../../layout/head/head3.php'; ?>
<?php include 'sidebar.php' ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>CONSIGNACION</h1>
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
        $ClsConsignacion = new clsConsignacion();
        $id = $_GET['id'];
        $datos = $ClsConsignacion->fntGetConsignacionesPorid($id);

        if (is_array($datos)) {
            foreach ($datos as $dato) {
                $estado = $dato['estado'];
                $fecha_consignacion = $dato['fecha_consignacion'];
                $id_banco = $dato['id_banco'];
                $valor = $dato['valor'];
                $id_cliente = $dato['id_cliente'];
                $observaciones = $dato['observaciones'];
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
                    <form id="form_editar_consignacion" name="form_editar_consignacion" method="post">
                        <input type="hidden" name="id" id="id" value="<?= $id ?>">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="txtFechaConsignacionEditar" class="form-label">Fecha consignacion:</label>
                                        <input type="date" name="txtFechaConsignacionEditar" id="txtFechaConsignacionEditar" class="form-control" style="width: 100%;" value="<?= $fecha_consignacion ?>" />
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="cbxBancoEditar" class="form-label">Banco:</label>
                                        <select name="cbxBancoEditar" id="cbxBancoEditar" class="form-control select2" style="width: 100%;">
                                            <?= $ClsConsignacion->fntOptionBancosObj($id_banco); ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="txtValorEditar" class="form-label">Valor:</label>
                                        <input name="txtValorEditar" id="txtValorEditar" class="form-control" style="width: 100%;" value="<?= $valor ?>" onkeyup="format(this)" />
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="form-group">
                                        <label for="cbxEstadoEditar" class="form-label">Estado:</label>
                                        <select name="cbxEstadoEditar" id="cbxEstadoEditar" class="form-control select2" style="width: 100%;">
                                            <?= $ClsConsignacion->fntOptionEstadosObj($estado); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="form-group">
                                        <label for="cbxClienteEditar" class="form-label">Cliente:</label>
                                        <select name="cbxClienteEditar" id="cbxClienteEditar" class="form-control select2" style="width: 100%;">
                                            <?= $ClsConsignacion->fntOptionClienteEditObj($id_cliente); ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="txtObservacionesEditar" class="form-label">Observaciones o comentarios:</label>
                                        <input name="txtObservacionesEditar" id="txtObservacionesEditar" class="form-control" style="width: 100%;" value="<?=$observaciones?>"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" id="btnCrear"> Guardar </button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"> No </button>
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
        function format(input) {
            var num = input.value.replace(/\./g, '');
            if (!isNaN(num)) {
                num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g, '$1.');
                num = num.split('').reverse().join('').replace(/^[\.]/, '');
                input.value = num;
            } else {
                input.value = input.value.replace(/[^\d\.]*/g, '');
            }
        }

        $("#form_editar_consignacion").on('submit', (function(e) {
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
    });
</script>