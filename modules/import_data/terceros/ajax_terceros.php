<?php
session_start();
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

$php_estado = false;
$php_result = "saludo desde el servidor";

$php_fechatime = "" . date("Y-m-d H:i:s");
$image = htmlspecialchars($_FILES['file_terceros']['name']);
$ruta = htmlspecialchars($_FILES['file_terceros']['tmp_name']);

$php_fileexten = strrchr($_FILES['file_terceros']['name'], ".");
$php_serial = strtoupper(substr(hash('sha1', $_FILES['file_terceros']['name'] . $php_fechatime), 0, 40)) . $php_fileexten;

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
            $arraymeses = [1 => "Jan", 2 => "Feb", 3 => "Mar", 4 => "Apr", 5 => "May", 6 => "Jun", 7 => "Jul", 8 => "Aug", 9 => "Sep", 10 => "Oct", 11 => "Nov", 12 => "Dec"];
            // fechar
            if (strlen($row[93]) == 8) {
                $fechaDias = substr($row[93], 0, -7);
                $fechaMes = array_search(substr($row[93], 2, -3), $arraymeses);
                $ano = strftime("%Y");
                $anoactual = substr($ano, 0, -2);
                $fecha_ano = substr($row[93], -2);
            } elseif (strlen($row[93]) == 9) {
                $fechaDias = substr($row[93], 0, -7);
                $fechaMes = array_search(substr($row[93], 3, -3), $arraymeses);
                $ano = strftime("%Y");
                $anoactual = substr($ano, 0, -2);
                $fecha_ano = substr($row[93], -2);
            } elseif (strlen($row[93]) == 7) {
                $fechaDias = "00";
                $fechaMes = "00";
                $fecha_ano = "00";
                $anoactual = "00";
            }
            // ultventa
            if (strlen($row[114]) == 8) {
                $fechaDias1 = substr($row[114], 0, -7);
                $fechaMes1 = (array_search(substr($row[114], 2, -3), $arraymeses));
                $ano1 = strftime("%Y");
                $anoactual = substr($ano, 0, -2);
                $fecha_ano1 = substr($row[114], -2);
            } elseif (strlen($row[114]) == 9) {
                $fechaDias1 = substr($row[114], 0, -7);
                $fechaMes1 = array_search(substr($row[114], 3, -3), $arraymeses);
                $ano1 = strftime("%Y");
                $anoactual1 = substr($ano, 0, -2);
                $fecha_ano1 = substr($row[114], -2);
            } elseif (strlen($row[114]) == 7) {
                $fechaDias1 = "00";
                $fechaMes1 = "00";
                $fecha_ano1 = "00";
                $anoactual1 = "00";
            }
            $fechanueva1 = $anoactual . $fecha_ano . "/" . $fechaMes . "/" . $fechaDias;
            $fechanueva2 = $anoactual1 . $fecha_ano1 . "/" . $fechaMes1 . "/" . $fechaDias1;
            $new_array['nit'] = $row[0];
            $new_array['digver'] = $row[1];
            $new_array['claseid'] = $row[2];
            $new_array['codigo'] = $row[3];
            $new_array['nombre'] = preg_replace('/[@\.\;\%\$\%]+/', '', $row[4]);
            $new_array['nombrec'] = preg_replace('/[@\.\;\%\$\%]+/', '', $row[5]);
            $new_array['nombre1'] = preg_replace('/[@\.\;\%\$\%]+/', '', $row[6]);
            $new_array['nombre2'] = $row[7];
            $new_array['apellido1'] = $row[8];
            $new_array['apellido2'] = $row[9];
            $new_array['perjuridic'] = $row[10];
            $new_array['inactivo'] = $row[11];
            $new_array['dir'] = preg_replace('/[@\.\;\%\$\%\&]+/', '', $row[12]);
            $new_array['dir2'] = $row[13];
            $new_array['tel'] = $row[14];
            $new_array['telmovil'] = $row[15];
            $new_array['fax'] = $row[16];
            $new_array['email'] = $row[17];
            $new_array['email2'] = $row[18];
            $new_array['ciudad'] = $row[19];
            $new_array['pais'] = $row[20];
            $new_array['barrio'] = $row[21];
            $new_array['escliente'] = $row[22];
            $new_array['especliente'] = $row[23];
            $new_array['esproveedor'] = $row[24];
            $new_array['esvendedor'] = $row[25];
            $new_array['esasociado'] = $row[26];
            $new_array['exasociado'] = $row[27];
            $new_array['esempleado'] = $row[28];
            $new_array['escobrador'] = $row[29];
            $new_array['escomision'] = $row[30];
            $new_array['escodeudor'] = $row[31];
            $new_array['estranspor'] = $row[32];
            $new_array['esingotter'] = $row[33];
            $new_array['esvehiculo'] = $row[34];
            $new_array['esbanco'] = $row[35];
            $new_array['esoficial'] = $row[36];
            $new_array['esuniofi'] = $row[37];
            $new_array['espatronal'] = $row[38];
            $new_array['esssalud'] = $row[39];
            $new_array['esriesgo'] = $row[40];
            $new_array['escaja'] = $row[41];
            $new_array['espension'] = $row[42];
            $new_array['escesantia'] = $row[43];
            $new_array['esbenefi'] = $row[44];
            $new_array['esasegura'] = $row[45];
            $new_array['vendedor'] = $row[46];
            $new_array['cobrador'] = $row[47];
            $new_array['propieta'] = $row[48];
            $new_array['agnete'] = $row[49];
            $new_array['banco'] = $row[50];
            $new_array['grupo'] = $row[51];
            $new_array['subgrupo'] = $row[52];
            $new_array['claseter'] = $row[53];
            $new_array['codpostal'] = $row[54];
            $new_array['zona'] = $row[55];
            $new_array['cupo'] = $row[56];
            $new_array['cupo2'] = $row[57];
            $new_array['califica'] = $row[58];
            $new_array['regimen'] = $row[59];
            $new_array['regiment'] = $row[60];
            $new_array['retefte'] = $row[61];
            $new_array['rettodo'] = $row[62];
            $new_array['noretecre'] = $row[63];
            $new_array['granconte'] = $row[64];
            $new_array['autorete'] = $row[65];
            $new_array['reteica'] = $row[66];
            $new_array['tarica'] = $row[67];
            $new_array['noiva'] = $row[68];
            $new_array['actiecon'] = $row[69];
            $new_array['conpub'] = $row[70];
            $new_array['encargado'] = $row[71];
            $new_array['replegar'] = $row[72];
            $new_array['nacio'] = $row[73];
            $new_array['precio'] = $row[74];
            $new_array['fpago'] = $row[75];
            $new_array['condpago'] = $row[76];
            $new_array['nodatacred'] = $row[77];
            $new_array['passcli'] = $row[78];
            $new_array['plazomax'] = $row[79];
            $new_array['plazo'] = $row[80];
            $new_array['plazo2'] = $row[81];
            $new_array['plazo3'] = $row[82];
            $new_array['pdtocli'] = $row[83];
            $new_array['pdtocli2'] = $row[84];
            $new_array['pdtocli3'] = $row[85];
            $new_array['tdtocli'] = $row[86];
            $new_array['tdtocli2'] = $row[87];
            $new_array['tdtocli3'] = $row[88];
            $new_array['pdtocond'] = $row[89];
            $new_array['pdtocond2'] = $row[90];
            $new_array['pdtocond3'] = $row[91];
            $new_array['usuario1'] = preg_replace('/[@\.\;\%\$\%\&]+/', '', $row[92]);
            $new_array['fechar'] = $fechanueva1;
            $new_array['fupdateu'] = preg_replace('/[@\;\%\$\%\&]+/', '', $row[94]);
            $fecha = date_create($row[95]);
            $fecha_d_m_y = date_format($fecha, 'Y/m/d H:i:s');
            $new_array['fupdate'] = $fecha_d_m_y;
            $new_array['cuentab'] = $row[96];
            $new_array['cuentabac'] = $row[97];
            $new_array['codsocial'] = $row[98];
            $new_array['codseps'] = $row[99];
            $new_array['codafp'] = $row[100];
            $new_array['codarp'] = $row[101];
            $new_array['codccf'] = $row[102];
            $new_array['trecipro'] = $row[103];
            $new_array['latitud'] = $row[104];
            $new_array['longitud'] = $row[105];
            $new_array['usuario2'] = $row[106];
            $new_array['diaconv'] = $row[107];
            $new_array['conveniop'] = $row[108];
            $new_array['porcaiua'] = $row[109];
            $new_array['porcaiui'] = $row[110];
            $new_array['porcariuu'] = $row[111];
            $new_array['nodesctos'] = $row[112];
            $new_array['foto'] = $row[113];
            $new_array['ultventa'] = $fechanueva2;
            $new_array['pfinancia'] = $row[115];
            $new_array['declara'] = $row[116];
            $new_array['codpub2'] = $row[117];
            $new_array['prvtas'] = $row[118];
            $new_array['transporte'] = $row[119];
            $new_array['nit2'] = $row[120];
            $new_array['ccostos'] = $row[121];
            $new_array['scostos'] = $row[122];
            $new_array['lugarnac'] = $row[123];
            $new_array['difcobro'] = $row[124];
            $new_array['reteiva'] = $row[125];
            $new_array['valdiasm'] = $row[126];
            $new_array['nobomberil'] = $row[127];
            $new_array['bodega'] = $row[128];
            /** variable final para guardar en la base de datos $new_array */
            $new_arrayf[] = $new_array;
        }
    }
}

if ($php_result = $cls_importdata->insert_terceros($new_arrayf)) {
    $php_estado = true;
}

$datos = array(
    'estado' => $php_estado,
    'result' => $php_result,
    'dataload' => $new_arrayf
);

echo json_encode($datos, JSON_FORCE_OBJECT);
