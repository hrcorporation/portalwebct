<?php
session_start();
header('Content-Type: application/json');

require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';

$php_estado = false;
$php_result = "saludo desde el servidor";

$php_fechatime = "" . date("Y-m-d H:i:s");
$image = htmlspecialchars($_FILES['file_biometrico']['name']);
$ruta = htmlspecialchars($_FILES['file_biometrico']['tmp_name']);

$php_fileexten = strrchr($_FILES['file_biometrico']['name'], ".");
$php_serial = strtoupper(substr(hash('sha1', $_FILES['file_biometrico']['name'] . $php_fechatime), 0, 40)) . $php_fileexten;

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
            $fecha = new DateTime($row[0]);
            $fecha_d_m_y = $fecha->format('Y/m/d');
            $new_array['fecha'] = $fecha_d_m_y;
            $new_array['numero_nomina'] = $row[1];
            $new_array['nombre'] = $row[2];
            $new_array['entrada_1'] = $row[3];
            $new_array['salida_1'] = $row[4];
            $new_array['entrada_2'] = $row[5];
            $new_array['salida_2'] = $row[6];
            $new_array['entrada_3'] = $row[7];
            $new_array['salida_3'] = $row[8];
            $new_array['h_normales'] = $row[9];
            $new_array['h_ausencias'] = $row[10];
            $new_array['h_extra'] = $row[11];
            $new_array['noc'] = $row[12];
            if (is_array($datos = $cls_importdata->select_get_id_terceros($row[1]))) {
                foreach ($datos as $fila) {
                    $new_array['id_empleado'] = $fila['id'];
                    $new_array['rol_empleado'] = $fila['rol'];
                }
            } else {
                $new_array['id_empleado'] = null;
                $new_array['rol_empleado'] = null;
            }
            /** variable final para guardar en la base de datos $new_array */
            $new_arrayf[] = $new_array;
        }
    }
}

if ($php_result = $cls_importdata->insert_biometrico($new_arrayf)) {
    $php_estado = true;
}

$datos = array(
    'estado' => $php_estado,
    'result' => $php_result,
    'dataload' => $new_arrayf
);

echo json_encode($datos, JSON_FORCE_OBJECT);
