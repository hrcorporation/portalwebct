<?php
session_start();
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';



$php_estado = false;
$php_result = "saludo desde el servidor";

$php_fechatime = "" . date("Y-m-d H:i:s");
$image = htmlspecialchars($_FILES['file_tipo_documento']['name']);
$ruta = htmlspecialchars($_FILES['file_tipo_documento']['tmp_name']);

$php_fileexten = strrchr($_FILES['file_tipo_documento']['name'], ".");
$php_serial = strtoupper(substr(hash('sha1', $_FILES['file_tipo_documento']['name'] . $php_fechatime), 0, 40)) . $php_fileexten;


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
            $new_array['codigo'] = $row[0];
            $new_array['clase_doc'] = $row[1];
            $new_array['grupo_td'] = $row[2];
            $new_array['libro'] = $row[3];
            $new_array['nombre'] = $row[4];
            $new_array['consec'] = $row[5];
            $new_array['consec_manu'] = $row[6];
            $new_array['conse_nume'] = $row[7];
            $new_array['cero_sconse'] = $row[8];
            $new_array['cambiar'] = $row[9];
            $new_array['inactivo'] = $row[10];
            $new_array['imppos'] = $row[11];
            $new_array['imppos_alt'] = $row[12];
            $new_array['impsermov'] = $row[13];
            $new_array['impper'] = $row[14];
            $new_array['impperx'] = $row[15];
            $new_array['noimp'] = $row[16];
            $new_array['modalidad'] = $row[17];
            $new_array['prfrel'] = $row[18];
            $new_array['prefijo'] = $row[19];
            $new_array['fech_resol'] = $row[20];
            $new_array['resol_dian'] = $row[21];
            $new_array['desde'] = $row[22];
            $new_array['hasta'] = $row[23];
            $new_array['eanref_pago'] = $row[24];
            $new_array['vres_vence'] = $row[25];
            $new_array['vrescon'] = $row[26];
            $new_array['noiva'] = $row[27];
            $new_array['encabe1'] = $row[28];
            $new_array['encabe2'] = $row[29];
            $new_array['encabe3'] = $row[30];
            $new_array['encabe4'] = $row[31];
            $new_array['encabe5'] = $row[32];
            $new_array['det_pie1'] = $row[33];
            $new_array['det_pie2'] = $row[34];
            $new_array['det_pie3'] = $row[35];
            $new_array['det_pie4'] = $row[36];
            $new_array['det_pie5'] = $row[37];
            $new_array['fpago'] = $row[38];
            $new_array['impnom'] = $row[39];
            $new_array['impdivs'] = $row[40];
            $new_array['precio'] = $row[41];
            $new_array['pre_coniva'] = $row[42];
            $new_array['no_desctos'] = $row[43];
            $new_array['iva_consu'] = $row[44];
            $new_array['maxitems'] = $row[45];
            $new_array['maxitemsx'] = $row[46];
            $new_array['c_costo'] = $row[47];
            $new_array['su_costo'] = $row[48];
            $new_array['c_coxitem'] = $row[49];
            $new_array['impuespec'] = $row[50];
            $new_array['bodega'] = $row[51];
            $new_array['bodega2'] = $row[52];
            $new_array['forbodega'] = $row[53];
            $new_array['conseevent'] = $row[54];
            $new_array['dataevent'] = $row[55];
            $new_array['idsred'] = $row[56];
            $new_array['usuper'] = $row[57];
            $new_array['usuper2'] = $row[58];
            $new_array['usuper3'] = $row[59];
            $new_array['usuper4'] = $row[60];
            $new_array['maneserv'] = $row[61];
            $new_array['ctarete'] = $row[62];
            $new_array['open_cajon'] = $row[63];
            $new_array['utiref1'] = $row[64];
            $new_array['utiref2'] = $row[65];
            $new_array['utiref3'] = $row[66];
            $new_array['utiref4'] = $row[67];
            $new_array['cta1'] = $row[68];
            $new_array['cta2'] = $row[69];
            $new_array['cta3'] = $row[70];
            $new_array['cta4'] = $row[71];
            $new_array['cta5'] = $row[72];
            $new_array['cta6'] = $row[73];
            $new_array['cta7'] = $row[74];
            $new_array['cta8'] = $row[75];
            $new_array['cta9'] = $row[76];
            $new_array['cta10'] = $row[77];
            $new_array['ncta1'] = $row[78];
            $new_array['ncta2'] = $row[79];
            $new_array['ncta3'] = $row[80];
            $new_array['ncta4'] = $row[81];
            $new_array['ncta5'] = $row[82];
            $new_array['ncta6'] = $row[83];
            $new_array['ncta7'] = $row[84];
            $new_array['ncta8'] = $row[85];
            $new_array['ncta9'] = $row[86];
            $new_array['ncta10'] = $row[87];
            $new_array['externo'] = $row[88];
            $new_array['lprefij'] = $row[89];
            $new_array['modo'] = $row[90];
            $new_array['noimpnit'] = $row[91];
            $new_array['impposval'] = $row[92];
            $new_array['impitagru'] = $row[93];
            $new_array['impitagrux'] = $row[94];
            $new_array['impobli'] = $row[95];
            $new_array['inveperio'] = $row[96];
            $new_array['porfpago'] = $row[97];
            $new_array['bodega_item'] = $row[98];
            $new_array['recostea'] = $row[99];
            $new_array['vendedor'] = $row[100];
            $new_array['ctaretev'] = $row[101];
            $new_array['ctaretem'] = $row[102];
            $new_array['ctaretes'] = $row[103];
            $new_array['ctaretec'] = $row[104];
            $new_array['retiva'] = $row[105];
            $new_array['noitdocu'] = $row[106];
            $new_array['contabtr'] = $row[107];
            $new_array['pda'] = $row[108];
            $new_array['aiu'] = $row[109];
            $new_array['esentrada'] = $row[110];
            $new_array['esbaja'] = $row[111];
            $new_array['estransfer'] = $row[112];
            $new_array['esresponsa'] = $row[113];
            $new_array['contaimport'] = $row[114];
            $new_array['dias_plazo'] = $row[115];
            $new_array['ver_colter'] = $row[116];
            $new_array['ver_colref'] = $row[117];
            $new_array['nsalconsec'] = $row[118];
            $new_array['imp_copias'] = $row[119];
            $new_array['for_vende'] = $row[120];
            $new_array['lretfte'] = $row[121];
            $new_array['lretcre'] = $row[122];
            $new_array['lretiva'] = $row[123];
            $new_array['lretica'] = $row[124];
            $new_array['solo_fechoy'] = $row[125];
            $new_array['depend'] = $row[126];
            $new_array['momod_costo'] = $row[127];
            $new_array['trasla'] = $row[128];
            $new_array['traslasuc'] = $row[129];
            $new_array['vrletras'] = $row[130];
            $new_array['sermov'] = $row[131];
            $new_array['smconsecl'] = $row[132];
            $new_array['olectura'] = $row[133];
            $new_array['noconsolid'] = $row[134];
            $new_array['notainv'] = $row[135];
            $new_array['creeuti'] = $row[136];
            $new_array['columniif'] = $row[137];
            $new_array['ctareteiva'] = $row[138];
            $new_array['imprimeniif'] = $row[139];
            $new_array['espcdesc'] = $row[140];
            $new_array['meses_hab'] = $row[141];
            $new_array['anexo_obli'] = $row[142];
            $new_array['cambios'] = $row[143];
            $new_array['anop'] = $row[144];
            $new_array['impitdagr'] = $row[145];
            $new_array['fe_nomline'] = $row[146];
            $new_array['fe_nnotify'] = $row[147];
            $new_array['fe_csfe'] = $row[148];
            $new_array['fe_version'] = $row[149];
            $new_array['fe_exporta'] = $row[150];
            $new_array['fe_xmldtos'] = $row[151];
            $new_array['fe_salud'] = $row[152];
            $new_array['fe_saludti'] = $row[153];
            $new_array['causadev'] = $row[154];
            $new_array['refinven'] = $row[155];
            $new_array['nodtos'] = $row[156];
            $new_array['ver_refpro'] = $row[157];
            $new_array['tpexclrede'] = $row[158];
            $new_array['sermovfe'] = $row[159];
            $new_array['grupoper'] = $row[160];
            $new_array['refcompon'] = $row[161];
            $new_array['autoica'] = $row[162];
            $new_array['ver_periodo'] = $row[163];
            $new_array['valnega'] = $row[164];
            $new_array['no_importa'] = $row[165];
            $fecha = new DateTime($row[166]);
            $fecha_d_m_y = $fecha->format('Y/m/d');

            $new_array['fecha_corte'] = $fecha_d_m_y;

            /** variable final para guardar en la base de datos $new_array */
            $new_arrayf[] = $new_array;
        }
    }
}

if ($php_result = $cls_importdata->insert_tipo_documento($new_arrayf)) {
    $php_estado = true;
}



$datos = array(
    'estado' => $php_estado,
    'result' => $php_result,
    'dataload' => $new_arrayf
);


echo json_encode($datos, JSON_FORCE_OBJECT);
