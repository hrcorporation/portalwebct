<?php
include '../../../../layout/validar_session4.php';
include '../../../../layout/head/head4.php';
include 'sidebar.php';
//include '../../../include/model/tablas/conexionPDO.php'; 

require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';

$php_clases = new php_clases();
$t1_terceros = new t1_terceros();
$t3_clientes = new t3_clientes();
$t5_obras = new t5_obras();
$op = new oportunidad_negocio();
$visita_clientes = new visitas_clientes();

$id = $php_clases->HR_Crypt($_GET['id'], 2);
$datos = $t1_terceros->search_tercero_custom_id($id);

while ($fila = $datos->fetch(PDO::FETCH_ASSOC)) {
    $nit = $fila['ct1_NumeroIdentificacion'];
    $razon_social = $fila['ct1_RazonSocial'];
    $naturaleza = $fila['ct1_naturaleza'];
    $dv = $fila['ct1_dv'];
    $nombre1 = $fila['ct1_Nombre1'];
    $nombre2 = $fila['ct1_Nombre2'];
    $apellido1 = $fila['ct1_Apellido1'];
    $apellido2 = $fila['ct1_Apellido2'];
    $tipo_documento = $fila['ct1_TipoIdentificacion'];
    $telefono = $fila['ct1_Telefono'];
    $celular = $fila['ct1_Celular'];
    $email = $fila['ct1_CorreoElectronico'];

    $tipo_documento = $fila['ct1_TipoIdentificacion'];
}
$datos_cliente_int = $t3_clientes->get_datos_cliente($id);

foreach ($datos_cliente_int as $key) {
    $forma_pago = $key['ct3_ModalidadPago'];
    $cupo_cliente = $key['ct3_Cupo'];
    $tipo_cliente = $key['ct3_TipoCliente'];
    $saldo_cliente = $key['ct3_SaldoCartera'];
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>CLIENTE</h1>
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
                <h3 class="card-title">EDITAR CLIENTE</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div id="contenido">
                    <form method="POST" name="F_editar" id="F_editar">
                        <input type="hidden" name="id_cliente" id="id_cliente" value="<?php echo $id; ?>" />
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Tipo Cliente</label>
                                    <select name="tipo_cliente" id="tipo_cliente" class="form-control select2">
                                        <?php echo $op->select_tipo_cliente($tipo_cliente) ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label> Forma de Pago</label>
                                    <?php
                                    switch ($forma_pago) {
                                        case 1:
                                            $op_forma_pago = "<option value='1' selected> Credito </option>";
                                            break;
                                        case 2:
                                            $op_forma_pago = "<option value='2' selected> Anticipado</option>";
                                            break;
                                        default:
                                            $op_forma_pago = "<option disabled selected> No se ha especificado la forma de pago </option>";
                                            break;
                                    }
                                    ?>
                                    <select class="form-control select2" style="width: 100%;" name="txt_forma_pago" id="txt_forma_pago">
                                        <?php print $op_forma_pago; ?>
                                        <option value="1"> Credito </option>
                                        <option value="2"> Pago Anticipado </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group" style=" text-align:center">
                                    <?php
                                    switch ($naturaleza) {
                                        case 'PN':
                                    ?>
                                            <label>Naturaleza (*)</label>
                                            <div class="form-group clearfix">
                                                <div class="icheck-primary d-inline">
                                                    <input type="radio" id="r_PJ" value="PJ" name="r_naturaleza" value="PJ">
                                                    <label for="r_PJ"> Persona Juridica </label>
                                                </div>
                                                <div class="icheck-primary d-inline">
                                                    <input type="radio" id="r_PN" value="PN" name="r_naturaleza" value="PN" checked="checked">
                                                    <label for="r_PN"> Persona Natural </label>
                                                </div>
                                            </div>
                                        <?php
                                            break;
                                        case 'PJ':
                                        ?>
                                            <label>Naturaleza (*)</label>
                                            <div class="form-group clearfix">
                                                <div class="icheck-primary d-inline">
                                                    <input type="radio" id="r_PJ" value="PJ" name="r_naturaleza" value="PJ" checked="checked">
                                                    <label for="r_PJ"> Persona Juridica </label>
                                                </div>
                                                <div class="icheck-primary d-inline">
                                                    <input type="radio" id="r_PN" value="PN" name="r_naturaleza" value="PN">
                                                    <label for="r_PN"> Persona Natural </label>
                                                </div>
                                            </div>
                                        <?php
                                            break;
                                        default:
                                        ?>
                                            <label>Naturaleza (*)</label>
                                            <div class="form-group clearfix">
                                                <div class="icheck-primary d-inline">
                                                    <input type="radio" id="r_PJ" value="PJ" name="r_naturaleza">
                                                    <label for="r_PJ"> Persona Juridica </label>
                                                </div>
                                                <div class="icheck-primary d-inline">
                                                    <input type="radio" id="r_PN" value="PN" name="r_naturaleza">
                                                    <label for="r_PN"> Persona Natural </label>
                                                </div>
                                            </div>
                                    <?php
                                            break;
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <?php
                                switch ($tipo_documento) {
                                    case 1:
                                        $op_tipo_doc = "<option value='1' selected> Nit </option>";
                                        break;
                                    case 2:
                                        $op_tipo_doc = "<option value='2' selected> Cedula Ciudadania</option>";
                                        break;
                                    default:
                                        $op_tipo_doc = "<option disabled selected> No se ha especificado Tipo Documento </option>";
                                        break;
                                }
                                ?>
                                <label> Tipo Documento (*)</label>
                                <select class="form-control select2" style="width: 100%;" name="tbx_tipoDocumento" id="tbx_tipoDocumento" required>

                                    <?php print_r($op_tipo_doc); ?>
                                    <option disabled>Seleccionar </option>

                                    <option value="1">Nit</option>
                                    <option value="2">Cedula Ciudadania</option>
                                </select>
                            </div>
                            <div class="col-5">
                                <div class="form-group">
                                    <label>Numero de documento (*)</label>
                                    <input type="number" name="tbx_NumeroDocumento" id="tbx_NumeroDocumento" class="form-control" placeholder="" value="<?php print_r($nit); ?>" />
                                </div>
                            </div>
                            <div id="boxPJ1">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>dv </label>
                                        <input type="number" name="tbx_dv" id="tbx_dv" class="form-control" max="9" placeholder="" value="<?php print_r($dv); ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div id="boxPJ2">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label> Razon social (*)</label>
                                        <input type="text" name="tbx_RazonSocial" id="tbx_RazonSocial" class="form-control" placeholder="" value="<?php print_r($razon_social); ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="boxPN1">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label> Primer Nombre (*)</label>
                                        <input type="text" name="tbx_pnombre1" id="tbx_pnombre1" class="form-control" placeholder="" value="<?php print_r($nombre1); ?>" />
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label> Segundo Nombre</label>
                                        <input type="text" name="tbx_pnombre2" id="tbx_pnombre2" class="form-control" placeholder="" value="<?php print_r($nombre2); ?>" />
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label> Primer Apellido (*)</label>
                                        <input type="text" name="tbx_papellido1" id="tbx_papellido1" class="form-control" placeholder="" value="<?php print_r($apellido1); ?>" />
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label> Segundo Apellido</label>
                                        <input type="text" name="tbx_papellido2" id="tbx_papellido2" class="form-control" placeholder="" value="<?php print_r($apellido2); ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label> E- Mail </label>
                                    <input type="text" name="tbx_email" id="tbx_email" class="form-control" placeholder="" value="<?php print_r($email); ?> " />
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label> Telefono </label>
                                    <input type="text" name="tbx_telefono" id="tbx_telefono" class="form-control" placeholder="" value="<?php print_r($telefono); ?>" />
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label> Celular </label>
                                    <input type="text" name="tbx_celular" id="tbx_celular" class="form-control" data-inputmask="'alias': 'numeric', 'groupSeparator': ',' , 'digits': 2, 'digitsOptional': false, 'prefix': '$ ', 'placeholder': '0'" data-mask>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row" id="blq_cupo">
                            <div class="col">
                                <div class="form-group">
                                    <label>Cupo Cliente</label>
                                    <input type='text' class='form-control ' name='txt_cupo' onkeyup='format(this)' value="<?php print_r($cupo_cliente) ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="container">
                                <div class="row ">
                                    <div class="col align-self-center">
                                        <button class="btn btn-block btn-info swalDefaultSuccess" type="submit"> ACTUALIZAR CLIENTE </button>
                                    </div>
                                    <div class="col align-self-center">
                                        <button class="btn btn-block btn-info swalDefaultSuccess" type="submit"> ADICIONAR VISITAS CLIENTES </button>
                                    </div>
                                </div>
                                <br><br>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-footer"></div>
        </div>
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Listado Visitas</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#crear_visita">
                            Crear Visita
                        </button>
                    </div>
                </div>
                <div id="contenido">
                    <table name="table_visitas" id="table_visitas">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Fecha</th>
                                <th>Objetivo visita </th>
                                <th>Observacion</th>
                                <th>Detalle</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->
        <div class="modal fade" id="crear_visita">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Crear Visita</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form name="form_add_visita" id="form_add_visita" method="post">
                            <input type="hidden" name="id_cliente" id="id_clente" value="<?php echo intval($id) ?>">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="fecha_vist">Fecha</label>
                                        <input type="date" name="fecha_vist" id="fecha_vist" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="result_visit">Objetivo de la visita</label>
                                        <select class="select2 form-control" name="objetivo_visita" id="objetivo_visita">
                                            <?= $visita_clientes->select_tipo_visita() ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="result_visit">Nombre obra</label>
                                        <select id="txt_obra" name="txt_obra" class="form-control select2">
                                            <?php echo $t5_obras->option_obra($id); ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="obs_visit">Observaciones</label>
                                        <input type="text" name="obs_visit" id="obs_visit" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!--- Modal Editar Visita -->
        <div class="modal fade" id="edit_visita">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Ver Visita</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form name="form_edit_visita" id="form_edit_visita" method="post">
                            <input type="hidden" name="id_visita" id="id_visita" />
                            <input type="hidden" name="id_clente_edit" id="id_clente_edit" value="<?php echo intval($_GET['id']) ?>">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="edit_fecha_vist">Fecha</label>
                                        <input type="date" name="edit_fecha_vist" id="edit_fecha_vist" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="edit_result_visit">Objetivo de la visita</label>
                                        <select class="select2 form-control" name="edit_result_visit" id="edit_result_visit">
                                            <?= $visita_clientes->select_tipo_visita() ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="result_visit">Nombre obra</label>
                                        <select id="txt_obra_editar" name="txt_obra_editar" class="form-control select2">
                                            <?php echo $t5_obras->option_obra($id); ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="edit_obs_visit">Observaciones</label>
                                        <input type="text" name="edit_obs_visit" id="edit_obs_visit" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Actualizar</button>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <button type="button" id="btn_eliminar_visitas" class="btn btn-danger">Eliminar</button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- fin -->

    </section>
    <!-- /.content -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include '../../../../layout/footer/footer4.php' ?>

<script>
    $("#form_add_visita").on('submit', (function(e) {
        e.preventDefault();
        $.ajax({
            url: "php_addvisita.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                console.log(data);
                const datos_errores = Object.values(data.errores);
                console.log(datos_errores);
                if (data.estado) {
                    toastr.success('visita creada exitosamente');
                } else {
                    for (let index = 0; index < datos_errores.length; index++) {
                        toastr.warning(data.errores[index]);
                    }
                }
                $('#crear_visita').modal('toggle');
            },
            error: function(respuesta) {
                alert(JSON.stringify(respuesta));
            },
        });
    }));

    function datatable_visitas(id_cliente) {
        var table = $('#table_visitas').DataTable({
            //"processing": true,
            //"scrollX": true,

            "ajax": {
                "url": "datatable_visitas.php",
                'data': {
                    'id_cliente': id_cliente,
                },
                'type': 'post',
                "dataSrc": ""
            },
            "order": [
                [0, 'desc']
            ],

            "columns": [{
                    "data": "id"
                },
                {
                    "data": "fecha"
                },
                {
                    "data": "tipo_visita"
                },
                {
                    "data": "observaciones"
                },
                {
                    "data": null,
                    "defaultContent": "<button class='btn btn-warning btn-sm' data-toggle='modal' data-target='#edit_visita'> Editar </button> "
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
    if ($.fn.dataTable.isDataTable('#table_visitas')) {
        table_visitas = $('#table_visitas').DataTable();
        table_visitas.destroy();
    }
    var id_cliente = <?php echo intval($id); ?>;
    table_visitas = datatable_visitas(id_cliente);
    setInterval(function() {
        table_visitas.ajax.reload(null, false);
    }, 5000);


    $("#btn_eliminar_visitas").on('click', function() {
        var id_visita = $("#id_visita").val();
        $.ajax({
            url: "php_eliminar_visita.php",
            type: "POST",
            data: {
                'id_visita': id_visita,
            },

            success: function(data) {
                console.log(data);
                $("#edit_visita").modal('hide');
                toastr.success("Visita eliminada Exitosamente");
            },
            error: function(respuesta) {
                alert(JSON.stringify(respuesta));
            },
        });
    });

    $('#table_visitas tbody').on('click', 'button', function() {
        var data = table_visitas.row($(this).parents('tr')).data();
        var id = data['id'];
        console.log(data['tipo_visita']);

        $('#id_visita').val(data['id']);
        $('#edit_fecha_vist').val(data['fecha']);
        $('#edit_obs_visit').val(data['observaciones']);
        $('#edit_result_visit').val(data['id_tipo_visita']);
        $('#txt_obra_editar').val(data['id_obra']);

        //var resultado = data['resultado'];


        //$("#edit_result_visit option[value='']").prop("selected", 'selected');
        //$('#edit_result_visit').val(data['resultado']);


    });

    $("#form_edit_visita").on('submit', (function(e) {
        e.preventDefault();
        $.ajax({
            url: "php_edit_visita.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                console.log(data);
                const datos_errores = Object.values(data.errores);
                console.log(datos_errores);
                if (data.estado) {
                    toastr.success('visita Editada exitosamente');
                } else {
                    for (let index = 0; index < datos_errores.length; index++) {
                        toastr.warning(data.errores[index]);
                    }
                }
                $('#edit_visita').modal('toggle');
            },
            error: function(respuesta) {
                alert(JSON.stringify(respuesta));
            },
        });
    }));

    $(document).ready(function() {
        $("#boxPN1").hide();
        $("#boxPJ2").show();
        $("#boxPJ1").show();

        $("#txt_forma_pago").change(function() {
            var forma_pago = $("#txt_forma_pago").val();

            if (forma_pago == 2) {
                $("#txt_cupo").val(0);
                $("#blq_cupo").hide();

            }
            if (forma_pago == 1) {
                $("#blq_cupo").show();
            }
        });

        $("#r_PN").change(function() {
            $("#boxPJ2").hide();
            $("#tbx_pnombre1").val();
            $("#tbx_pnombre2").val();
            $("#tbx_papellido1").val();
            $("#tbx_papellido2").val();
            $("#tbx_RazonSocial").val();
            $("#boxPN1").show();
            $("#boxPJ1").hide();
        });

        $("#r_PJ").change(function() {
            $("#boxPN1").hide();
            $("#boxPJ1").show();
            var apellido1 = $("#tbx_papellido1").val();
            var apellido2 = $("#tbx_papellido2").val();
            var nombre1 = $("#tbx_pnombre1").val();
            var nombre2 = $("#tbx_pnombre2").val();

            $("#tbx_pnombre1").val();
            $("#tbx_pnombre2").val();
            $("#tbx_papellido1").val();
            $("#tbx_papellido2").val();
            $("#tbx_RazonSocial").val(apellido1 + ' ' + apellido2 + ' ' + nombre1 + ' ' + nombre2);
            $("#boxPJ2").show();
        });
    })
</script>

<script type="text/javascript">
    function format(input) {
        var num = input.value.replace(/\./g, '');
        if (!isNaN(num)) {
            num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g, '$1.');
            num = num.split('').reverse().join('').replace(/^[\.]/, '');
            input.value = num;
            document.getElementById("h2valor").innerHTML = "$ " + num;
        } else {
            input.value = input.value.replace(/[^\d\.]*/g, '');
        }
    }
</script>

<script src="ajax_editar.js"></script>

</body>

</html>