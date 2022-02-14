<?php
session_start();
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';



$php_estado = false;
$php_result = "saludo desde el servidor";

$php_fechatime = "" . date("Y-m-d H:i:s");
$image = htmlspecialchars($_FILES['file_kardex']['name']);
$ruta = htmlspecialchars($_FILES['file_kardex']['tmp_name']);

$php_fileexten = strrchr($_FILES['file_kardex']['name'], ".");
$php_serial = strtoupper(substr(hash('sha1', $_FILES['file_kardex']['name'] . $php_fechatime), 0, 40)) . $php_fileexten;


$carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/internal/load_data/';
$php_tempfoto = ('/internal/load_data/' . $php_serial);
$php_movefile = move_uploaded_file($ruta, $carpeta_destino . $php_serial);


$inputFileName = $_SERVER['DOCUMENT_ROOT'] . $php_tempfoto;

$cls_importdata = new cls_importdata();


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
            $fechadias = "";
            $fecha_mes = "";
            $fecha_ano = "";
            $fechanueva = "";
            $arraymeses = [1 => "Ene", 2 => "Feb", 3 => "Mar", 4 => "Abr", 5 => "May", 6 => "Jun", 7 => "Jul", 8 => "Ago", 9 => "Sep", 10 => "Oct", 11 => "Nov", 12 => "Dic"];

            if (strlen($row[1]) === 15) {
                $fechadias = substr($row[1], 4, -9);
                $fecha_mes = array_search(substr($row[1], 0, -12), $arraymeses);
            }
            $fecha_ano = substr($row[1], -8);
            $fechanueva = $fecha_ano . "/" . $fecha_mes . "/" . $fechadias;
            $new_array['l'] = $row[0];
            $new_array['fecha'] = $fechanueva;
            $new_array['comprobante'] = $row[2];
            $new_array['entradas'] = $row[3];
            $new_array['salidas'] = $row[4];
            $new_array['saldo'] = str_replace(",","",$row[5]);
            $new_array['costo_aplicacion'] = str_replace(",","",$row[6]);
            $new_array['costo_promedio'] = str_replace(",","",$row[7]);
            $new_array['costo_total_saldo'] = str_replace(",","",$row[8]);
            $new_array['detalle1'] = $row[9];
            $new_array['numero_ext'] = $row[10];
            $new_array['bodega'] = $row[11];
            $new_array['tercero'] = $row[12];
            $new_array['nit'] = $row[13];
            $new_array['elaborado'] = $row[14];
            $new_array['referencia'] = $row[15];
            $new_array['detalle2'] = $row[16];
            $new_array['periodo'] = $row[17];
            $new_array['cuenta'] = $row[18];
            $new_array['unidad_medida'] = $row[19];
            /** variable final para guardar en la base de datos $new_array */
            $new_arrayf[] = $new_array;
        }
    }
}

if ($php_result = $cls_importdata->insert_kardex($new_arrayf)) {
    $php_estado = true;
}



$datos = array(
    'estado' => $php_estado,
    'result' => $php_result,
    'dataload' => $new_arrayf
);


echo json_encode($datos, JSON_FORCE_OBJECT);
