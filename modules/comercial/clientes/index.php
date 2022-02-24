<?php include '../../../layout/validar_session3.php' ?>
<?php include '../../../layout/head/head3.php'; ?>
<?php include 'sidebar.php' ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>CLIENTES</h1>
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

        <?php
        /**
         * Validacion de Usuario
         */
        if (is_array($array_rol_user =  $login->get_rol_tercero($_SESSION['id_usuario']))) :

            $modulos = array(1, 8, 12, 13, 14, 20, 22, 26, 27); // Array de roles para habilitar roles
            if ($login->validar_rol_user($modulos, $array_rol_user)) : // Validacion para habilitar el usuario
                $t1_terceros = new t1_terceros();
                /**
                 * Card Body
                 */
        ?>
                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tabla de Clientes</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                        </div>
                    </div>
                    <div class="card-body">

                        <div id="contenido">


                            <table id="t_cliente" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>N</th>
                                        <th>Nit</th>
                                        <th>Nombre / Razon Social</th>
                                        <th>Estado</th>
                                        <th>Detalle</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    $datos = $t1_terceros->select_clientes();
                                    while ($fila = $datos->fetch(PDO::FETCH_ASSOC)) {
                                        $i++;
                                        $id = $fila['ct1_IdTerceros'];
                                        $nit = $fila['ct1_NumeroIdentificacion'];
                                        $razon_social = $fila['ct1_RazonSocial'];
                                        $Estado = $fila['ct1_Estado'];

                                        if ($Estado == 1) {
                                            $s_clase = " badge-success ";
                                            $status = "Aprobado";
                                        }
                                        if ($Estado == 0) {
                                            $s_clase = " badge-info ";
                                            $status = "";
                                        }
                                        if ($Estado == 3) {
                                            $s_clase = " badge-warning ";
                                            $status = "Pendiente ";
                                        }
                                        if ($Estado == 2) {
                                            $s_clase = " badge-danger";
                                            $status = "Desabilitado";
                                        }

                                    ?>
                                        <tr>
                                            <td><?php echo $i;  ?></td>
                                            <td><?php echo $nit; ?></td>
                                            <td><?php echo $razon_social; ?></td>
                                            <td><span class='badge <?php echo $s_clase; ?> float-right'><?php echo $status ?></span>
                                            </td>
                                            <td class="project-actions">
                                                <a class="btn btn-warning btn-sm" href="update/editar.php?id='<?php echo $php_clases->HR_Crypt($id, 1); ?>"><i class="fas fa-edit"></i></a>
                                            </td>



                                        </tr>


                                    <?php
                                    }

                                    ?>
                                </tbody>
                                <tfooter>
                                    <tr>
                                        <th>N</th>
                                        <th>Nit</th>
                                        <th>Nombre / Razon Social</th>
                                        <th>Estado</th>
                                        <th>Detalle</th>
                                    </tr>
                                </tfooter>
                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                    </div>
                    <!-- /.card-footer-->
                </div>
                <!-- /.card -->

            <?php
            else :
            ?>
                <div class="callout callout-warning">
                    <h5>No posee permisos en este modulo</h5>
                </div>
        <?php
            endif;
        else :
            header('location : ../../cerrar.php');
        endif;

        ?>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include '../../../layout/footer/footer3.php' ?>

<script>
    $(document).ready(function() {
        $('#t_cliente').DataTable({});
    });
</script>

</body>

</html>