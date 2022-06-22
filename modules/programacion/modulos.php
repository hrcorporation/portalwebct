<?php
switch ($rol_user) {
    case 1:
    case 15:
    case 16:
?>
        <div class="col-4" id="">
            <div class="small-box bg-info">

                <div class="inner">
                    <h3>Prog. Semanal</H3>
                </div>
                <div class="icon">

                    <i class="fas fa-calendar-day"></i>
                </div>
                <a class="small-box-footer" href="semanal/index.php">
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
    case 15:
    case 16:
?>
        <div class="col-4" id="">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>Prog. Diaria</H3>
                </div>
                <div class="icon">
                    <i class="fas fa-calendar-day"></i>
                </div>
                <a class="small-box-footer" href="diaria/index.php">
                    Ir <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
<?php
        break;
}
/////////////////////////////////////////////////////////7777
?>