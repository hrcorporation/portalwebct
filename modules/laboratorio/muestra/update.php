<?php include '../../../layout/validar_session3.php' ?>
<?php include '../../../layout/head/head3.php'; ?>
<?php include 'sidebar.php' ?>

<?php require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php'; ?>


<?php
$firephp = FirePHP::getInstance(true);
$PDO = new conexionPDO();
$con = $PDO->connect();
$usuarios = new usuarios();
$permisos = new permisos();

// Roles
$rol_user = $usuarios->buscar_roles($_SESSION['id_usuario']);
$modulo_remisiones = array(1, 8, 15, 17, 20, 29, 22, 26);
$modulo_remisiones =  $permisos->habilitar($modulo_remisiones, $rol_user);

$id_muestra = intval($_GET['id']);
if ($modulo_remisiones) {
    $modelo_laboratorio = new modelo_laboratorio();
} else {
    $data = null;
    print('<script> window.location = "../index.php"</script>');
}

if($array_data = $modelo_laboratorio::data_id_muestra($con,$id_muestra))
{
    if(is_array($array_data))
    {
        
        foreach ($array_data as $fila) {
            $id_remision = intval($fila['id_remision']);
            $fecha = $fila['fecha'];
            $hora = $fila['hora'];
            $cantidad = $fila['cantidad'];
            $cod_remision = $fila['cod_remision'];
            $id_mixer = $fila['id_mixer'];
            $placa = $fila['placa'];
            $id_cliente = $fila['id_cliente'];
            $nombre_cliente = $fila['nombre_cliente'];
            $id_obra = $fila['id_obra'];
            $nombre_obra = $fila['nombre_obra'];
            $id_producto = $fila['id_producto'];
            $descripcion_producto = $fila['cod_producto']." - ".$fila['descripcion_producto'];
            $cementante = $fila['cementante'];
            $m3_muestra = $fila['m3_muestra'];
            $asentamiento = $fila['asentamieto'];
            $temperatura = $fila['temperarura'];
            $aire = $fila['aire'];
            $rendimiento_volumetrico = $fila['rend_volumetrico'];
        }
    }
}
   
$firephp->fb($array_data  ,FirePHP::LOG);


?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
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
                <h3 class="card-title"> Editar Muestra </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>

                </div>
            </div>
            <div class="card-body">
                <div id="contenido">

                    <form id="form_editar_muestra" name="form_editar_muestra" method="post">
                        <input id="id_muestra" name="id_muestra" type="hidden">
                        
                        <div class="row">
                            <div class="col-2">
                                <div class="form-group">
                                    <label>Fecha</label>
                                    <input type="text" class="form-control" id="fecha_remision" name="fecha_remision" readonly="true" value="<?php echo $fecha ?>">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label>Hora</label>
                                    <input type="text" class="form-control" id="hora" name="hora" readonly="true" value="<?php echo $hora ?>">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label>Codigo Remision</label>
                                    <input type="text" class="form-control" id="cod_remision" name="cod_remision" readonly="true" value="<?php echo $cod_remision ?>">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label>Mixer</label>
                                    <input type="hidden" name="id_mixer" id="id_mixer">
                                    <input type="text" class="form-control" id="placa_mixer" name="placa_mixer" readonly="true" value="<?php echo $placa ?>">
                                </div>
                            </div>
                            <div class="col-1">
                                <div class="form-group">
                                    <label>Cantidad</label>

                                    <input type="text" class="form-control" id="cantidad" name="cantidad" readonly="true" value="<?php echo $cantidad ?>">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Tipo de Muestra </label>
                                    <select name="tipo_muestra" id="tipo_muestra" class="select2 form-control">
                                        <option value="1">Cilindro</option>
                                        <option value="2">Viga</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <h5>Cliente</h5>
                                    <input type="hidden" name="id_cliente" id="id_cliente" class="form-control" >
                                    <input type="text" name="cliente" id="cliente" class="form-control" value="<?php echo $nombre_cliente ?>" readonly="true">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <h5>Obra</h5>
                                    <input type="hidden" name="id_obra" id="id_obra" class="form-control" >
                                    <input type="text" name="obra" id="obra" class="form-control" readonly="true" value="<?php echo $nombre_obra ?>">
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <h5>producto</h5>
                                    <input type="hidden" name="id_producto" id="id_producto" class="form-control">
                                    <input type="text" name="producto" id="producto" class="form-control" readonly="true"  value="<?php echo $descripcion_producto ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <div class="form-group clearfix">
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" value="1" name="check_habilitar" id="check_habilitar" ?>
                                            <label for="check_habilitar">
                                                Seleccione para editar
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Cementante</label>
                                    <input type="text" name="cementante" id="cementante" class="form-control" value="<?php echo $cementante ?>" />
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>m3 Muestra</label>
                                    <input type="text" name="m3" id="m3" class="form-control" value="<?php echo $m3_muestra ?>" />
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Asentamiento</label>
                                    <input type="text" name="asentamiento" id="asentamiento" class="form-control" value="<?php echo $asentamiento; ?> " />
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Temperatura</label>
                                    <input type="text" name="temperatura" id="temperatura" class="form-control" value="<?php echo $temperatura; ?>" />
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Aire</label>
                                    <input type="text" name="aire" id="aire" class="form-control" value="<?php echo $aire ?>" />
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Rend Volumetrico</label>
                                    <input type="text" name="rend_volumetrico" id="rend_volumetrico" class="form-control" value="<?php echo $rendimiento_volumetrico ?>" />
                                </div>
                            </div>
                        </div>
                        
                    </form>
                    <hr>
                    <br>

                    <!-- Button trigger modal -->

                    <div class="row">
                        <div class="col">
                            <table id="t_resultado" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>N</th>
                                        <th>Fecha</th>
                                        <th>Hora</th>
                                        <th>Resultado 1</th>
                                        <th>Resultado 2</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfooter>
                                    <tr>
                                    <th>N</th>
                                        <th>Fecha</th>
                                        <th>Hora</th>
                                        <th>Resultado 1</th>
                                        <th>Resultado 2</th>
                                        
                                    </tr>
                                </tfooter>
                            </table>
                        </div>
                    </div>

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

        // Declarar funcion destruir tabla
        function destruir_tabla(){
            var table = $('#t_resultado').DataTable({
            });
            table.destroy();
        }

        function data_table(id_remision) {
         
            var table = $('#t_resultado').DataTable({
                //"processing": true,
                //"scrollX": true,

                "ajax": {
                    "url": "datatable_result_muestra.php",
                    'data': {
                        'id_remision': id_remision,
                    },
                    'type': 'post',
                    "dataSrc": ""
                },
                "order": [
                    [0, 'desc']
                ],

                "columns": [{
                        "data": "id_muestra"
                    },
                    {
                        "data": "fecha"
                    },
                    {
                        "data": "hora"
                    },
                    {
                        "data": "resultado1"
                    },
                    {
                        "data": "resultado2"
                    },

                ],
                'paging': false,
                'searching': false
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

            table.ajax.reload();
            return table;
        }

        var id_remision = <?php echo $id_remision; ?>;
        table = data_table(id_remision);
        
        
        setInterval(function() {
            table.ajax.reload(null, false);
        }, 5000);


    });
</script>
<script>
    $(document).ready(function() {
        $('.select2').select2();

    });

    $(document).ready(function() {
        $("#form_insert_data").hide();
        $("#form_crear_muestra").on('submit', (function(e) {
            e.preventDefault();
            $.ajax({
                url: "php_crear_muestra.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {

                    const datos_errores = Object.values(data.errores);
                    const datos_msg = Object.values(data.msg);
                    console.log(data.estado);
                    console.log(datos_errores);
                    console.log(datos_msg);
                    if (data.estado) {
                        for (let indexh = 0; indexh < datos_msg.length; indexh++) {
                            toastr.success(data.msg[indexh]);
                        }
                        $("#form_insert_data").show();
                        $("#btn_crear_muestra").hide();
                        $("#id_muestra").val(data.id_muestra);
                        $("#asentamiento").val(data.asentamiento);
                        $("#temperatura").val(data.temperatura);




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

        // Crear 2
        $("#form_insert_data").on('submit', (function(e) {
            e.preventDefault();
            $.ajax({
                url: "php_insert_data_muestra.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {

                    const datos_errores = Object.values(data.errores);
                    const datos_msg = Object.values(data.msg);
                    console.log(data.estado);
                    console.log(datos_errores);
                    console.log(datos_msg);
                    if (data.estado) {
                        for (let indexh = 0; indexh < datos_msg.length; indexh++) {
                            toastr.success(data.msg[indexh]);
                        }
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