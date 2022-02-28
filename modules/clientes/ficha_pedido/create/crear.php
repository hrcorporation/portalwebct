<?php include '../../../../layout/validar_session4.php' ?>
<?php include '../../../../layout/head/head4.php'; ?>
<?php include 'sidebar.php' ?>

<?php require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php'; ?>

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
                <h3 class="card-title">Ficha de Pedido</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div id="contenido">
                    <form method="POST" name="F_crear" id="F_crear">

                        <!-- Cliente -->
                        <div class="card card-warning">
                            <div class="card-header">
                                <h5 class="card-tittle">CLIENTE</h5>
                            </div>
                            <div class="card-body">
                                <!--  Seccion Cliente -->
                                <div class="row">
                                    <div class="col-1">
                                        <div class="form-group">
                                            <label> Fecha :</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <input type="date" class="form-control" name="cliente_fecha" id="cliente_fecha" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-1">
                                        <div class="form-group">
                                            <label>Nombre:</label>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="cliente_nombre" id="cliente_nombre" placeholder="Nombre">
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <div class="form-group">
                                            <label>C.C.N°:</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <input type="number" class="form-control" name="planmaestroCC1" id="planmaestroCC1" placeholder="123456789">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label>Direccion de Obra:</label>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="clienteDireccionObra" id="clienteDireccionObra" placeholder="Direccion">
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <div class="form-group">
                                            <label>TEL:</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <input type="number" class="form-control" name="clienteTelefono1" id="clienteTelefono1" placeholder="123456789">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Direccion de Entrega Factura:</label>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="clienteDireccionEntregaFactura" id="clienteDireccionEntregaFactura" placeholder="Direccion">
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <div class="form-group">
                                            <label>TEL:</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <input type="number" class="form-control" name="clienteTelefono2" id="clienteTelefono2" placeholder="123456789">
                                        </div>
                                    </div>
                                </div>
                                <!--  Fin Seccion Cliente  -->
                            </div>
                        </div>
                        <!-- ============================================== -->
                        <!---  Plan Maestro -->
                        <div class="card card-info">
                            <div class="card-header">
                                <h5 class="card-tittle">PLAN MAESTRO</h5>
                            </div>
                            <div class="card-body">
                                <!--  Seccion Plan Maestro -->
                                <div class="row">
                                    <div class="col-1">
                                        <div class="form-group">
                                            <label> Fecha : </label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <input type="date" class="form-control" name="planmaestroFecha" id="planmaestroFecha" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-1">
                                        <div class="form-group">
                                            <label>Nombre:</label>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="planmaestroNombre" id="planmaestroNombre" placeholder="Nombre">
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <div class="form-group">
                                            <label>C.C.N° :</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <input type="number" class="form-control" name="planmaestroCC2" id="planmaestroCC2" placeholder="123456789">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label>Direccion:</label>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="planmaestroDireccion" id="planmaestroDireccion" placeholder="Direccion">
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <div class="form-group">
                                            <label>TEL:</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <input type="number" class="form-control" name="planmaestroTel" id="planmaestroTel" placeholder="123456789">
                                        </div>
                                    </div>
                                </div>
                                <!--  Fin Seccion Plan maestro  -->
                            </div>
                        </div>
                        <!-- ============================================== -->
                        <div class="card card-info">
                            <div class="card-header">
                                <h5 class="card-tittle">DATOS CONCRETOS</h5>
                            </div>
                            <div class="card-body">
                                <!-- Seccion Datos concreto -->
                                <div class="row">
                                    <div class="col-1">
                                        <div class="form-group">
                                            <label> Tipo de Concreto: </label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="planmaestroTipoConcreto" id="planmaestroTipoConcreto" placeholder="Tipo de concreto" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Precio m3 con iva incluido:</label>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="form-group">
                                            <input type="number" class="form-control" name="planmaestroPrecioIva" id="planmaestroPrecioIva" placeholder="99999.00">
                                        </div>
                                    </div>

                                    <div class="col-1">
                                        <div class="form-group">
                                            <label>Valor Total:</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <input type="number" class="form-control" name="planmaestroValorTotal" id="planmaestroValorTotal" placeholder="99999.00">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label>Abono:</label>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="form-group">
                                            <input type="number" class="form-control" name="planmaestroAbono" id="planmaestroAbono" placeholder="99999.00">
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <div class="form-group">
                                            <label>Saldo:</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <input type="number" class="form-control" name="planmaestroSalario" id="planmaestroSalario" placeholder="99999.00">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label>Válidez:</label>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="planmaestroValidez" id="planmaestroValidez" placeholder="Validez">
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <div class="form-group">
                                            <label>Oferta:</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <input type="number" class="form-control" name="planmaestroOferta" id="planmaestroOferta" placeholder="99999.00">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <h5>BANCOLOMBIA CUENTA CORRIENTE 06838753842</h5>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <h5>COLPATRIA CUENTA CORRIENTE 5751006804</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Fin Seccion Datos concreto -->
                        </div>
                        <!-- ============================================== -->
                        <div class="card card-info">
                            <div class="card-header">
                                <h5 class="card-tittle">MODIFICACION</h5>
                            </div>
                            <div class="card-body">
                                <!-- Seccion Modificacion -->
                                <div class="row">
                                    <div class="col-1">
                                        <div class="form-group">
                                            <label> Fecha: </label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <input type="date" class="form-control" name="planmaestroFecha" id="planmaestroFxecha" />
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <div class="form-group">
                                            <label> Hora: </label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <input type="time" class="form-control" name="planmaestroHora" id="planmaestroHora" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-1">
                                        <div class="form-group">
                                            <label>Otros:</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="otros" id="otros" placeholder="Otros">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Fin Seccion Modificacion -->
                        </div>
                        <!-- ============================================== -->
                        <div class="card card-info">
                            <div class="card-header">
                                <h5 class="card-tittle">DATOS DE LA ESTRUCTURA</h5>
                            </div>
                            <div class="card-body">
                                <!-- Seccion Datos de la estructura -->
                                <div class="row">
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label> Tipo de estructura: </label>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="form-group">
                                            <select class="form-control" id="tipoEstructura" name="tipoEstructura">
                                                <option> Placa</option>
                                                <option> Muro</option>
                                                <option> Piscina</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col"></div>
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label> Requiere Medicion: </label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-check" id="medicion">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Si
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                                            <label class="form-check-label" for="flexRadioDefault2">
                                                No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label>Tipo de placa:</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <select class="form-control" id="tipoPlaca" name="tipoPlaca">
                                                <option> Maciza</option>
                                                <option> Aligerada</option>
                                                <option> Calceton</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label>Fecha Programada:</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <input type="date" class="form-control" name="fechaProgramada" id="fechaProgramada">
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label>Hora Programada:</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <input type="time" class="form-control" name="horaProgramada" id="horaProgramada">
                                        </div>
                                    </div>
                                    <!-- Fin Seccion Datos de la estructura -->
                                </div>
                            </div>
                        </div>
                        <div class="card card-info">
                            <div class="card-header">
                                <h5 class="card-tittle">Placa Superior Torta</h5>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="text-center font-weight-bold">Area Inicial</h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-1 font-weight-bold">Largo 1:</div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <input type="number" class="form-control" placeholder="Largo" id="largo1" name="largo1">
                                            </div>
                                        </div>
                                        <div class="col-1 font-weight-bold">Ancho 1:</div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <input type="number" class="form-control" placeholder="Ancho" id="ancho1" name="ancho1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-1 font-weight-bold">Largo 2:</div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <input type="number" class="form-control" placeholder="Largo" id="largo2" name="largo2">
                                            </div>
                                        </div>
                                        <div class="col-1 font-weight-bold">Ancho 2:</div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <input type="number" class="form-control" placeholder="Ancho" id="ancho2" name="ancho2">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-1 font-weight-bold">Largo 3:</div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <input type="number" class="form-control" placeholder="Largo" id="largo3" name="largo3">
                                            </div>
                                        </div>
                                        <div class="col-1 font-weight-bold">Ancho 3:</div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <input type="number" class="form-control" placeholder="Ancho" id="ancho3" name="ancho3">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-1 font-weight-bold">Promedio largo:</div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <input type="number" class="form-control" placeholder="Promedio largo" id="promedioAlto" name="promedioAlto">
                                            </div>
                                        </div>
                                        <div class="col-1 font-weight-bold">Promedio ancho:</div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <input type="number" class="form-control" placeholder="Promedio ancho" id="promedioAncho" name="promedioAncho">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr size="4px" width="98.8%" noshade="noshade" align="center" />
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="text-center font-weight-bold">Vacios</h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-2 font-weight-bold">Escalera:</div>
                                        <div class="col-3">
                                            <div class="form-group font-weight-bold">
                                                Largo
                                                <input type="number" class="form-control" placeholder="Largo" id="largoMt1" name="largoMt1">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group font-weight-bold">
                                                mt * Ancho
                                                <input type="number" class="form-control" placeholder="Ancho" id="anchoMt1" name="anchoMt1">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group font-weight-bold">
                                                = mt<sup>2</sup>
                                                <input type="number" class="form-control" placeholder="mt2" id="metrosCuadrados1" name="metrosCuadrados1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-2 font-weight-bold">Patio:</div>
                                        <div class="col-3">
                                            <div class="form-group font-weight-bold">
                                                Largo
                                                <input type="number" class="form-control" placeholder="Largo
                                                " id="largoMt2" name="largoMt2">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group font-weight-bold">
                                                mt * Ancho
                                                <input type="number" class="form-control" placeholder="Ancho" id="anchoMt2" name="anchoMt2">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group font-weight-bold">
                                                = mt<sup>2</sup>
                                                <input type="number" class="form-control" placeholder="mt2" id="metrosCuadrados2" name="metrosCuadrados2">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-2 font-weight-bold">Patio:</div>
                                        <div class="col-3">
                                            <div class="form-group font-weight-bold">
                                                Largo
                                                <input type="number" class="form-control" placeholder="Largo" id="largoMt3" name="largoMt3">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group font-weight-bold">
                                                mt * Ancho
                                                <input type="number" class="form-control" placeholder="Ancho" id="anchoMt3" name="anchoMt3">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group font-weight-bold">
                                                = mt<sup>2</sup>
                                                <input type="number" class="form-control" placeholder="mt2" id="metrosCuadrados3" name="metrosCuadrados3">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-2 font-weight-bold">Tragaluz:</div>
                                        <div class="col-3">
                                            <div class="form-group font-weight-bold">
                                                Largo
                                                <input type="number" class="form-control" placeholder="Largo" id="largoMt4" name="largoMt4">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group font-weight-bold">
                                                mt * Ancho
                                                <input type="number" class="form-control" placeholder="Ancho" id="anchoMt4" name="anchoMt4">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group font-weight-bold">
                                                = mt<sup>2</sup>
                                                <input type="number" class="form-control" placeholder="mt2" id="metrosCuadrados4" name="metrosCuadrados4">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-11 font-weight-bold">
                                            <p class="text-center">Largo * Ancho * Altura = mt<sup>3</sup></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <hr size="2px" width="100%" noshade="noshade" align="right" />
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="text-center font-weight-bold">Promedio Largo * Ancho (Area inicial)</h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-2 font-weight-bold">Totales:</div>
                                        <div class="col-8">
                                            <div class="form-group font-weight-bold">
                                                <input type="number" class="form-control" placeholder="Totales" id="totales" name="totales">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="text-center font-weight-bold">Suma valores vacios (Vacios)</h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-2 font-weight-bold">Totales:</div>
                                        <div class="col-8">
                                            <div class="form-group font-weight-bold">
                                                <input type="number" class="form-control" placeholder="Totales" id="totalSumaVacios" name="totalSumaVacios">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr size="2px" width="100%" noshade="noshade" align="right" />
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-3 font-weight-bold">Area total (Area inicial-vacios):</div>
                                        <div class="col-2">
                                            <div class="form-group font-weight-bold">
                                                <input type="number" class="form-control" placeholder="Area total" id="areaTotal" name="areaTotal">
                                            </div>
                                        </div>
                                        <div class="col-1 font-weight-bold">Espesor:</div>
                                        <div class="col-1">
                                            <div class="form-group font-weight-bold">
                                                <input type="number" class="form-control" placeholder="00.00" id="espesor" name="espesor">
                                            </div>
                                        </div>
                                        <div class="col-2 font-weight-bold">Placa superior parcial:</div>
                                        <div class="col-2">
                                            <div class="form-group font-weight-bold">
                                                <input type="text" class="form-control" placeholder="Placa" id="placaSuperiorParcial" name="placaSuperiorParcial">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-11 font-weight-bold">
                                            <p class="text-center">Area total * Espesor = Placa superior parcial</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-2 font-weight-bold">Placa superior parcial:</div>
                                        <div class="col-3">
                                            <div class="form-group font-weight-bold">
                                                <input type="text" class="form-control" placeholder="Placa" id="placaSuperiorParcial" name="placaSuperiorParcial">
                                            </div>
                                        </div>
                                        <div class="col-2 font-weight-bold">1.5 de desperdicio:</div>
                                        <div class="col-3">
                                            <div class="form-group font-weight-bold">
                                                <input type="number" class="form-control" placeholder="Desperdicio" id="desperdicio" name="desperdicio">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-11 font-weight-bold">
                                            <p class="text-center">Placa superior parcial * 1.5 de desperdicio = Placa superior o torta</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-info">
                            <div class="card-header">
                                <h5 class="card-tittle">Vigas y vigetas</h5>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-1 font-weight-bold">Cantidad:</div>
                                        <div class="col-1">
                                            <div class="form-group font-weight-bold">
                                                <input type="text" class="form-control" placeholder="Cantidad" id="cantidad1" name="cantidad1">
                                            </div>
                                        </div>
                                        <div class="col-1 font-weight-bold">Largo:</div>
                                        <div class="col-1">
                                            <div class="form-group font-weight-bold">
                                                <input type="text" class="form-control" placeholder="Largo" name="largo1" id="largo1">
                                            </div>
                                        </div>
                                        <div class="col-1 font-weight-bold">Ancho:</div>
                                        <div class="col-1">
                                            <div class="form-group font-weight-bold">
                                                <input type="text" class="form-control" placeholder="Ancho" id="ancho1" name="ancho1">
                                            </div>
                                        </div>
                                        <div class="col-1 font-weight-bold">Altura:</div>
                                        <div class="col-1">
                                            <div class="form-group font-weight-bold">
                                                <input type="text" class="form-control" placeholder="Altura" id="altura1" name="altura1">
                                            </div>
                                        </div>
                                        <div class="col-1 font-weight-bold">mt:</div>
                                        <div class="col-1">
                                            <div class="form-group font-weight-bold">
                                                <input type="text" class="form-control" placeholder="mt2" id="metros1" name="metros1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-11 font-weight-bold">
                                            <p class="text-center">Largo * Ancho * Altura = mt<sup>3</sup></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-1 font-weight-bold">Cantidad:</div>
                                        <div class="col-1">
                                            <div class="form-group font-weight-bold">
                                                <input type="number" class="form-control" placeholder="Cantidad" id="cantidad2" name="cantidad2">
                                            </div>
                                        </div>
                                        <div class="col-1 font-weight-bold">Largo:</div>
                                        <div class="col-1">
                                            <div class="form-group font-weight-bold">
                                                <input type="number" class="form-control" placeholder="Largo" id="largo2" name="largo2">
                                            </div>
                                        </div>
                                        <div class="col-1 font-weight-bold">Ancho:</div>
                                        <div class="col-1">
                                            <div class="form-group font-weight-bold">
                                                <input type="number" class="form-control" placeholder="Ancho" id="ancho2" name="ancho2">
                                            </div>
                                        </div>
                                        <div class="col-1 font-weight-bold">Altura:</div>
                                        <div class="col-1">
                                            <div class="form-group font-weight-bold">
                                                <input type="number" class="form-control" placeholder="Altura" id="altura2" name="altura2">
                                            </div>
                                        </div>
                                        <div class="col-1 font-weight-bold">mt:</div>
                                        <div class="col-1">
                                            <div class="form-group font-weight-bold">
                                                <input type="number" class="form-control" placeholder="mt2" id="metros2" name="metros2">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-11 font-weight-bold">
                                            <p class="text-center">Largo * Ancho * Altura = mt<sup>3</sup></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-1 font-weight-bold">Cantidad:</div>
                                        <div class="col-1">
                                            <div class="form-group font-weight-bold">
                                                <input type="number" class="form-control" placeholder="Cantidad" id="cantidad3" name="cantidad3">
                                            </div>
                                        </div>
                                        <div class="col-1 font-weight-bold">Largo:</div>
                                        <div class="col-1">
                                            <div class="form-group font-weight-bold">
                                                <input type="number" class="form-control" placeholder="Largo" id="largo3" name="largo3">
                                            </div>
                                        </div>
                                        <div class="col-1 font-weight-bold">Ancho:</div>
                                        <div class="col-1">
                                            <div class="form-group font-weight-bold">
                                                <input type="number" class="form-control" placeholder="Ancho" id="ancho3" name="ancho3">
                                            </div>
                                        </div>
                                        <div class="col-1 font-weight-bold">Altura:</div>
                                        <div class="col-1">
                                            <div class="form-group font-weight-bold">
                                                <input type="number" class="form-control" placeholder="Altura" id="altura3" name="altura3">
                                            </div>
                                        </div>
                                        <div class="col-1 font-weight-bold">mt:</div>
                                        <div class="col-1">
                                            <div class="form-group font-weight-bold">
                                                <input type="number" class="form-control" placeholder="mt2" id="metros3" name="metros3">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-11 font-weight-bold">
                                            <p class="text-center">Largo * Ancho * Altura = mt<sup>3</sup></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-1 font-weight-bold">Cantidad:</div>
                                        <div class="col-1">
                                            <div class="form-group font-weight-bold">
                                                <input type="number" class="form-control" placeholder="Cantidad" id="cantidad4" name="cantidad4">
                                            </div>
                                        </div>
                                        <div class="col-1 font-weight-bold">Largo:</div>
                                        <div class="col-1">
                                            <div class="form-group font-weight-bold">
                                                <input type="number" class="form-control" placeholder="Largo" id="largo4" name="largo4">
                                            </div>
                                        </div>
                                        <div class="col-1 font-weight-bold">Ancho:</div>
                                        <div class="col-1">
                                            <div class="form-group font-weight-bold">
                                                <input type="number" class="form-control" placeholder="Ancho" id="ancho4" name="ancho4">
                                            </div>
                                        </div>
                                        <div class="col-1 font-weight-bold">Altura:</div>
                                        <div class="col-1">
                                            <div class="form-group font-weight-bold">
                                                <input type="number" class="form-control" placeholder="Altura" id="altura4" name="altura4">
                                            </div>
                                        </div>
                                        <div class="col-1 font-weight-bold">mt:</div>
                                        <div class="col-1">
                                            <div class="form-group font-weight-bold">
                                                <input type="number" class="form-control" placeholder="mt2" id="metros4" name="metros4">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-11 font-weight-bold">
                                            <p class="text-center">Largo * Ancho * Altura = mt<sup>3</sup></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-1 font-weight-bold">Cantidad:</div>
                                        <div class="col-1">
                                            <div class="form-group font-weight-bold">
                                                <input type="number" class="form-control" placeholder="Cantidad" id="cantidad5" name="cantidad5">
                                            </div>
                                        </div>
                                        <div class="col-1 font-weight-bold">Largo:</div>
                                        <div class="col-1">
                                            <div class="form-group font-weight-bold">
                                                <input type="number" class="form-control" placeholder="Largo" id="largo5" name="largo5">
                                            </div>
                                        </div>
                                        <div class="col-1 font-weight-bold">Ancho:</div>
                                        <div class="col-1">
                                            <div class="form-group font-weight-bold">
                                                <input type="number" class="form-control" placeholder="Ancho" id="ancho5" name="ancho5">
                                            </div>
                                        </div>
                                        <div class="col-1 font-weight-bold">Altura:</div>
                                        <div class="col-1">
                                            <div class="form-group font-weight-bold">
                                                <input type="number" class="form-control" placeholder="Altura" id="altura5" name="altura5">
                                            </div>
                                        </div>
                                        <div class="col-1 font-weight-bold">mt:</div>
                                        <div class="col-1">
                                            <div class="form-group font-weight-bold">
                                                <input type="number" class="form-control" placeholder="mt2" id="metros5" name="metros5">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-11 font-weight-bold">
                                            <p class="text-center">Largo * Ancho * Altura = mt<sup>3</sup></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-1 font-weight-bold">Cantidad:</div>
                                        <div class="col-1">
                                            <div class="form-group font-weight-bold">
                                                <input type="number" class="form-control" placeholder="Cantidad" id="cantidad6" name="cantidad6">
                                            </div>
                                        </div>
                                        <div class="col-1 font-weight-bold">Largo:</div>
                                        <div class="col-1">
                                            <div class="form-group font-weight-bold">
                                                <input type="number" class="form-control" placeholder="Largo" id="largo6" name="largo6">
                                            </div>
                                        </div>
                                        <div class="col-1 font-weight-bold">Ancho:</div>
                                        <div class="col-1">
                                            <div class="form-group font-weight-bold">
                                                <input type="number" class="form-control" placeholder="Ancho" id="ancho6" name="ancho6">
                                            </div>
                                        </div>
                                        <div class="col-1 font-weight-bold">Altura:</div>
                                        <div class="col-1">
                                            <div class="form-group font-weight-bold">
                                                <input type="number" class="form-control" placeholder="Altura" id="altura6" name="altura6">
                                            </div>
                                        </div>
                                        <div class="col-1 font-weight-bold">mt:</div>
                                        <div class="col-1">
                                            <div class="form-group font-weight-bold">
                                                <input type="number" class="form-control" placeholder="mt2" id="metros6" name="metros6">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-11 font-weight-bold">
                                            <p class="text-center">Largo * Ancho * Altura = mt<sup>3</sup></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr size="2px" width="100%" noshade="noshade" align="right" />
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-4 font-weight-bold">Totales viguetas longitudinales:</div>
                                        <div class="col-4">
                                            <div class="form-group font-weight-bold">
                                                <input type="number" class="form-control" placeholder="Total" id="TotalViguetasLongitudinales" name="TotalViguetasLongitudinales">
                                            </div>
                                        </div>
                                        <div class="col-4 font-weight-bold">mt<sup>3</sup></div>
                                    </div>
                                </div>
                            </div>
                            <hr size="2px" width="100%" noshade="noshade" align="right" />
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-4 font-weight-bold">Totales viguetas transversales:</div>
                                        <div class="col-4">
                                            <div class="form-group font-weight-bold">
                                                <input type="number" class="form-control" placeholder="Total" id="TotalViguetasTransversales" name="TotalViguetasTransversales">
                                            </div>
                                        </div>
                                        <div class="col-4 font-weight-bold">mt<sup>3</sup></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-info">
                            <div class="card-header">
                                <h5 class="card-tittle">Escalera</h5>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-2 font-weight-bold">Escalera: </div>
                                        <div class="col-5">
                                            <div class="form-group font-weight-bold">
                                                <input type="number" class="form-control" placeholder="mt3" id="Escaleras" name="Escaleras">
                                            </div>
                                        </div>
                                        <div class="col-4 font-weight-bold">mt<sup>3</sup> escalera</div>
                                    </div>
                                </div>
                            </div>
                            <hr size="2px" width="100%" noshade="noshade" align="right" />
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-2 font-weight-bold">Total placa :</div>
                                        <div class="col-4">
                                            <div class="form-group font-weight-bold">
                                                <input type="number" class="form-control" placeholder="mt3" id="TotalPlaca" name="TotalPlaca">
                                            </div>
                                        </div>
                                        <div class="col-4 font-weight-bold">mt<sup>3</sup></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-info">
                            <div class="card-header">
                                <h5 class="card-tittle">NOTA PARA EL CLIENTE</h5>
                            </div>
                            <div class="card-body">
                                <!-- Seccion Datos de la estructura -->
                                <div class="row">
                                    <ul>
                                        <li>CONCRETOLIMA S.A, garantiza el producto por asentamiento y resistencia.</li>
                                        <li>CONCRETOLIMA S.A no se hace responsable por fisuras, por contracción, ya que es responsabilidad del cliente la colocación, vibrado, acabado y curado del concreto para que no se presenten hormigueos y deficiencia de resistencia. </li>
                                        <li>El cliente se compromete a colocar la placa superior o torta sobre un espesor de <input type="number" class="form-control" placeholder="cm" style="width:150px; height:30px" id="Centimetros" name="Centimetros"> cms, con los cuales se ha hecho el respectivo calculo de volumen de esta placa o estructura. CONCRETOLIMA S.A., no se hace responsable por volúmenes que se coloquen por encima de esta medida.</li>
                                        <li>Para el momento de la colocación del concreto en la obra, el cliente deberá proveer un bulto de cemento y dos canecados de arena para el mortero de purga de la bomba.</li>
                                        <li>La manipulación de la Bomba estacionariay sus accesorios (tubería, abrazaderas, codos, etc.), solo compete a personal autorizado por CONCRETOLIMA S.A., por lo tanto no nos hacemos responsables por afectación a personal ajeno a la empresa que manipulen sin autorización dichos accesorios.</li>
                                        <li>El cliente debe garantizar la seguridad de la Bomba Estacionaria, tubería y accesorios ante siniestros tales como: robo o sabotaje cuando esta deba dejarse en las instalaciones de la obra.</li>
                                        <li>La Norma aplicable al productoes la NSR 10 CAPITULO "C".</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card card-info">
                            <div class="card-header">
                                <h5 class="card-tittle">OBSERVACIONES</h5>
                            </div>
                            <div class="card-body">
                                <!-- Seccion Datos de las observaciones -->
                                <div class="row">
                                    <textarea rows="5" type="text" class="form-control" placeholder="Observaciones" size="5" id="Observaciones" name="Observaciones">Observaciones</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="card card-info">
                            <div class="card-header">
                                <h5 class="card-tittle">FIRMAS</h5>
                            </div>
                            <div class="card-body">
                                <!-- Seccion Datos de las firmas -->
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-3 font-weight-bold">FIRMA CLIENTE:</div>
                                        <div class="col-3">
                                            <div class="form-group font-weight-bold">
                                                <input type="text" class="form-control" placeholder="FIRMA" id="FirmaCliente" name="FirmaCliente">
                                            </div>
                                        </div>
                                        <div class="col-3 font-weight-bold">FIRMA VENDEDOR CONCRETOLIMA:</div>
                                        <div class="col-3">
                                            <div class="form-group font-weight-bold">
                                                <input type="text" class="form-control" placeholder="FIRMA" id="FirmaVendedor" name="FirmaVendedor">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---  Datos Concreto -->
                        <div class="row">
                            <div class="container">
                                <div class="row ">
                                    <div class="col align-self-center">
                                        <button class="btn btn-block btn-info swalDefaultSuccess" type="submit"> CREAR CLIENTE </button>
                                    </div>
                                </div>
                                <br><br>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-footer">

            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include '../../../../layout/footer/footer4.php' ?>

<script>
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

        $("#r_PJ").change(function() {

            $("#boxPJ2").hide();
            $("#tbx_pnombre1").val();
            $("#tbx_pnombre2").val();
            $("#tbx_papellido1").val();
            $("#tbx_papellido2").val();
            $("#tbx_RazonSocial").val(' ');
            $("#boxPN1").show();
            $("#boxPJ1").hide();
        });

        $("#r_PN").change(function() {
            $("#boxPN1").hide();
            $("#boxPJ1").show();

            var apellido1 = $("#tbx_papellido1").val();
            var apellido2 = $("#tbx_papellido2").val();
            var nombre1 = $("#tbx_pnombre1").val();
            var nombre2 = $("#tbx_pnombre2").val();

            $("#tbx_pnombre1").val('');
            $("#tbx_pnombre2").val('');
            $("#tbx_papellido1").val('');
            $("#tbx_papellido2").val('');

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

<script src="ajax_crear2.js"></script>

</body>

</html>