<?php

switch ($rol_user) {
    case 1:
    case 12:
    case 13:

?>
        <div class="col-4" id="">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>Lista de Precios</H3>
                </div>
                <div class="icon">
                    <i class="fas fa-truck-moving"></i>
                </div>
                <a class="small-box-footer" href="PrecioProducto/">
                    Ir <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

<?php
        break;
}
?>
<?php
switch ($rol_user) {
    case 1:
?>
        <div class="col-4" id="">
            <div class="small-box bg-info">
                <div class="ribbon-wrapper ribbon-lg">
                    <div class="ribbon bg-warning">
                        proximamente
                    </div>
                </div>
                <div class="inner">
                    <h3>Recaudos</H3>
                </div>
                <div class="icon">
                    <i class="fas fa-money-bill"></i>
                </div>
                <a class="small-box-footer" href="#">
                    Ir <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

<?php
        break;
}
?>


<?php
//////////////////////////////////////////////////
switch ($rol_user) {
    case 1:
    case 8:
        //case 20:

?>
        <div class="col-4" id="">
            <div class="small-box bg-info">
                <div class="ribbon-wrapper ribbon-lg">
                    <div class="ribbon bg-warning">
                        proximamente
                    </div>
                </div>
                <div class="inner">
                    <h3>Cotizaciones</H3>
                </div>
                <div class="icon">

                    <i class="fas fa-truck-moving"></i>
                </div>
                <a class="small-box-footer" href="cotizaciones/">
                    Ir <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

<?php
        break;
}
//////////////////////////////////////////////////
?>

<?php
//////////////////////////////////////////////////
switch ($rol_user) {
    case 1:
    case 5:

        //case 20:

?>
        <div class="col-4" id="">
            <div class="small-box bg-info">
                <div class="ribbon-wrapper ribbon-lg">
                    <div class="ribbon bg-warning">
                        proximamente
                    </div>
                </div>
                <div class="inner">
                    <h3>Votaciones</H3>
                </div>
                <div class="icon">

                    <i class="fas fa-truck-moving"></i>
                </div>
                <a class="small-box-footer" href="votaciones/">
                    Ir <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

<?php
        break;
}
//////////////////////////////////////////////////
?>