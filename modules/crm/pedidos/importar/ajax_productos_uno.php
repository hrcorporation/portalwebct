<?php
session_start();
header('Content-Type: application/json');

require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';

$php_estado = false;
$php_result = "saludo desde el servidor";

$php_fechatime = "" . date("Y-m-d H:i:s");
$image = htmlspecialchars($_FILES['file_productos']['name']);
$ruta = htmlspecialchars($_FILES['file_productos']['tmp_name']);

$php_fileexten = strrchr($_FILES['file_productos']['name'], ".");
$php_serial = strtoupper(substr(hash('sha1', $_FILES['file_productos']['name'] . $php_fechatime), 0, 40)) . $php_fileexten;

$carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/internal/load_data/';
$php_tempfoto = ('/internal/load_data/' . $php_serial);
$php_movefile = move_uploaded_file($ruta, $carpeta_destino . $php_serial);

$inputFileName = $_SERVER['DOCUMENT_ROOT'] . $php_tempfoto;

$cls_importdata = new cls_importdata();
$pedidos = new pedidos();

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
    $php_result = $pedidos->editar_status_productos();
    foreach ($array_reg as $row) {
        if (!is_null($row[0])) {
            $new_array['status'] = 1;
            $new_array['fecha_subida'] = date('Y-m-d');
            $fecha_subida = date('Y-m-d');
            $new_array['id_producto'] = $pedidos->get_id_producto($row[0]);
            $id_producto = $pedidos->get_id_producto($row[0]);
            $new_array['codigo_producto'] = $row[0];
            $codigo_producto = $row[0];
            $new_array['nombre_producto'] = $pedidos->get_nombre_producto_por_cod($row[0]);
            $nombre_producto = $pedidos->get_nombre_producto_por_cod($row[0]);
            $new_array['precio'] = $row[1];
            $precio = $row[1];
            $row[0];
            $codigo_producto = $row[0];
            $new_array['nombre_producto'] = $pedidos->get_nombre_producto_por_cod($row[0]);
            $nombre_producto = $pedidos->get_nombre_producto_por_cod($row[0]);
            $new_array['precio'] = $row[1];
            $precio = $row[1];
            /** variable final para guardar en la base de datos $new_array */
            $new_arrayf[] = $new_array;

            if ($pedidos->validar_existencias_productos($pedidos->get_id_producto($row[0]))) {
                if ($php_result = $pedidos->insert_precio_productos($fecha_subida, $id_producto, $codigo_producto, $nombre_producto, $precio)) {
                    $php_estado = true;
                }
            }
        }
    }
}

$datos = array(
    'estado' => $php_estado,
    'result' => $php_result,
    'dataload' => $new_arrayf
);

echo json_encode($datos, JSON_FORCE_OBJECT);