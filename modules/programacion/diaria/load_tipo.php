<?php
session_start();
header('Content-Type: application/json');
require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';
//Se crea un objeto de la clase programacionSemanal
$objProgramacionDiaria = new ClsProgramacionDiaria();
$boolPhpEstado = false;
if ($objSelectTipoUno = $objProgramacionDiaria->fntOptionTipoDescargueConcretolObj()) {
    $boolPhpEstado = true;
}
if ($objSelectTipoDos = $objProgramacionDiaria->fntOptionTipoDescargueObj()) {
    $boolPhpEstado = true;
}
$datos = array(
    'estado' => $boolPhpEstado,
    'select_tipo_uno' => $objSelectTipoUno,
    'select_tipo_dos' => $objSelectTipoDos
);
echo json_encode($datos, JSON_FORCE_OBJECT);
