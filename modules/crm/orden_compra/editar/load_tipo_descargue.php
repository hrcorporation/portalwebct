<?php
session_start();
header('Content-Type: application/json');
require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';
//Se crea un objeto de la clase programacionSemanal
$clsProgramacionSemanal = new clsProgramacionSemanal();
$boolPhpEstado = false;
//Si el checkbox esta activado se lista dos tipos de descargue
if ($objSelectTipoUno = $clsProgramacionSemanal->fntOptionTipoDescargueConcretolObj()) {
    $boolPhpEstado = true;
}
//Si el checkbox esta deactivado se lista los cuatro tipos de descargue
if ($objSelectTipoDos = $clsProgramacionSemanal->fntOptionTipoDescargueObj()) {
    $boolPhpEstado = true;
}
$datos = array(
    'estado' => $boolPhpEstado,
    'select_tipo_uno' => $objSelectTipoUno,
    'select_tipo_dos' => $objSelectTipoDos
);
echo json_encode($datos, JSON_FORCE_OBJECT);