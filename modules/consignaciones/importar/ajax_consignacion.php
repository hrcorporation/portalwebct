<?php
session_start();
header('Content-Type: application/json');
require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

$php_estado = false;
$php_result = "saludo desde el servidor";
$php_fechatime = "" . date("Y-m-d H:i:s");

$image = htmlspecialchars($_FILES['importar_consignaciones']['name']);
$ruta = htmlspecialchars($_FILES['importar_consignaciones']['tmp_name']);
$php_fileexten = strrchr($_FILES['importar_consignaciones']['name'], ".");
$php_serial = strtoupper(substr(hash('sha1', $_FILES['importar_consignaciones']['name'] . $php_fechatime), 0, 40)) . $php_fileexten;
$carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/internal/load_data/';
$php_tempfoto = ('/internal/load_data/' . $php_serial);
$php_movefile = move_uploaded_file($ruta, $carpeta_destino . $php_serial);
$inputFileName = $_SERVER['DOCUMENT_ROOT'] . $php_tempfoto;
$ClsConsignacion = new clsConsignacion();
// Clase para Escoger celdas Especificas
class MyReadFilter implements \PhpOffice\PhpSpreadsheet\Reader\IReadFilter
{
    public function readCell($column, $row, $worksheetName = '')
    {
        // Read title row and rows 20 - 30
        if ($row > 1) { // comenzamos desde 1 para omitir el titulo de las comulnas ubicadas en la fila 1(excel)
            return true;
        }
        return false;
    }
}
//$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
/**  identifica el tipo de archivo $inputFileName  **/
$inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
/**  Crear un nuevo lector $reader para el tipo de archivo  **/
$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
// inicializar la Clase leer excel
$reader->setReadFilter(new MyReadFilter());
/**  Cargar $inputFileName al objeto $Spreadsheet **/
$spreadsheet = $reader->load($inputFileName);
// Recorremos las Celdas del archivo Tomando como referencia que el excel el numero de celdas comienza desde 0
$array_reg = $spreadsheet->getActiveSheet()->toArray();
if (is_array($array_reg)) {
    foreach ($array_reg as $row) {
        if (!is_null($row[0])) {
            //id del usuario
            $intIdUsuario = $_SESSION['id_usuario'];
            //Nombre del usuario mediante el parametro del id del usuario
            $strNombreUsuario = $ClsConsignacion->fntGetNombreClienteObj($intIdUsuario);
            $dtmFecha = $row[0];
            $strNombreBanco = $row[1];
            $intIdBanco = $ClsConsignacion->fntGetIdBancoObj($strNombreBanco);
            $dblValor = $row[2];
            $strNombreCliente = $row[3];
            if (isset($strNombreCliente)) {
                $intIdCliente = $ClsConsignacion->fntGetIdClienteObj($strNombreCliente);
                $intEstado = 2;
            } else {
                $intEstado = 1;
                $intIdCliente = 0;
            }
            $strObservacion = $row[4];
            ///////////////////////////////////////////////////////////////////////////////////////////////////////////
            if ($php_result = $ClsConsignacion->fntCrearConsignacionPorImportarObj($intEstado, $dtmFecha, $intIdBanco, $strNombreBanco, $dblValor, $intIdCliente, $strNombreCliente, $strObservacion, $intIdUsuario, $strNombreUsuario)) {
                $php_estado = true;
            } else {
                $php_result = "El formato ingresado no es el correcto";
            }
        }
    }
}
$datos = array(
    'estado' => $php_estado,
    'result' => $php_result
);
echo json_encode($datos, JSON_FORCE_OBJECT);
