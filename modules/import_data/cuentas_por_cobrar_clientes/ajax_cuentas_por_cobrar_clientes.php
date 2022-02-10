<?php
session_start();
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';



$php_estado = false;
$php_result = "saludo desde el servidor";

$php_fechatime = "" . date("Y-m-d H:i:s");
$image = htmlspecialchars($_FILES['file_cuentas_por_cobrar_clientes']['name']);
$ruta = htmlspecialchars($_FILES['file_cuentas_por_cobrar_clientes']['tmp_name']);

$php_fileexten = strrchr($_FILES['file_cuentas_por_cobrar_clientes']['name'], ".");
$php_serial = strtoupper(substr(hash('sha1', $_FILES['file_cuentas_por_cobrar_clientes']['name'] . $php_fechatime), 0, 40)) . $php_fileexten;


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
            $new_array['nit'] = $row[0];
            $new_array['suc_pto'] = $row[1];
            $new_array['codigo'] = $row[2];
            $new_array['nombre'] = $row[3];
            $new_array['nom_comerc'] = $row[4];
            $new_array['telefono'] = $row[5];
            $new_array['celular'] = $row[6];
            $new_array['direccion'] = $row[7];
            $new_array['fecha'] = $row[8];
            $new_array['vence'] = $row[9];
            $new_array['saldo'] = $row[10];
            $new_array['sin_vencer'] = $row[11];
            $new_array['periodo_1_30'] = $row[12];
            $new_array['periodo_31_60'] = $row[13];
            $new_array['periodo_61_90'] = $row[14];
            $new_array['periodo_91_120'] = $row[15];
            $new_array['periodo_121_360'] = $row[16];
            $new_array['periodo_mas_361'] = $row[17];
            $new_array['meses_vencidos'] = $row[18];
            $new_array['plazo'] = $row[19];
            $new_array['mora'] = $row[20];
            $new_array['numero_externo'] = $row[21];
            $new_array['zona'] = $row[22];
            $new_array['fax'] = $row[23];
            $new_array['anticipos'] = $row[24];
            $new_array['cupo'] = $row[25];
            $new_array['fecha_ultimo_pago'] = $row[26];
            $new_array['observaciones'] = $row[27];
            $new_array['fecha_corte'] = $row[28];
            $fecha = new DateTime($row[29]);
            $fecha_d_m_y = $fecha->format('Y/m/d');

            $new_array['fecha_corte'] = $fecha_d_m_y;

            /** variable final para guardar en la base de datos $new_array */
            $new_arrayf[] = $new_array;
        }
    }
}

if ($php_result = $cls_importdata->insert_cuentas_por_cobrar_clientes($new_arrayf)) {
    $php_estado = true;
}



$datos = array(
    'estado' => $php_estado,
    'result' => $php_result,
    'dataload' => $new_arrayf
);


echo json_encode($datos, JSON_FORCE_OBJECT);
