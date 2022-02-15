<?php
session_start();
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';



$php_estado = false;
$php_result = "saludo desde el servidor";

$php_fechatime = "" . date("Y-m-d H:i:s");
$image = htmlspecialchars($_FILES['file_venta']['name']);
$ruta = htmlspecialchars($_FILES['file_venta']['tmp_name']);

$php_fileexten = strrchr($_FILES['file_venta']['name'], ".");
$php_serial = strtoupper(substr(hash('sha1', $_FILES['file_venta']['name'] . $php_fechatime), 0, 40)) . $php_fileexten;


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
            $arraymeses = [1 => "Ene", 2 => "Feb", 3 => "Mar", 4 => "Abr", 5 => "May", 6 => "Jun", 7 => "Jul", 8 => "Ago", 9 => "Sep", 10 => "Oct", 11 => "Nov", 12 => "Dic"];

            if (strlen($row[7]) == 10) {
                $fechadias = substr($row[7], 4, -5);
                $fecha_mes = array_search(substr($row[7], 0, -7), $arraymeses);
            } elseif (strlen($row[7]) == 11) {
                $fechadias = substr($row[7], 4, -5);
                $fecha_mes = array_search(substr($row[7], 0, -8), $arraymeses);
            }
            $fecha_ano = substr($row[7], -4);
            $fechanueva = $fecha_ano . "/" . $fecha_mes . "/" . $fechadias;
            $new_array['venta_devolucion'] = $row[0];
            $new_array['tipo_comprobante'] = $row[1];
            $new_array['numero'] = $row[2];
            $new_array['numero_externo'] = $row[3];
            $new_array['anio'] = $row[4];
            $new_array['mes'] = $row[5];
            $new_array['dia'] = $row[6];
            $new_array['fecha'] = $fechanueva;
            $new_array['cliente'] = $row[8];
            $new_array['razon_social'] = $row[9];
            $new_array['persona_juridica'] = $row[10];
            $new_array['nombre_comercial'] = $row[11];
            $new_array['cod_tercero'] = $row[12];
            $new_array['suc_pto'] = $row[13];
            $new_array['grupo_cliente'] = $row[14];
            $new_array['subgrupo_cliente'] = $row[15];
            $new_array['codigo_vendedor'] = $row[16];
            $new_array['identificador_vendedor'] = $row[17];
            $new_array['vendedor'] = $row[18];
            $new_array['anexo_1'] = $row[19];
            $new_array['anexo_2'] = $row[20];
            $new_array['anexo_3'] = $row[21];
            $new_array['referencia'] = $row[22];
            $new_array['referencia2'] = $row[23];
            $new_array['servicio'] = $row[24];
            $new_array['codigo_barras'] = $row[25];
            $new_array['referencia_proveedor'] = $row[26];
            $new_array['detalle_comprobante'] = $row[27];
            $new_array['detalle_item'] = $row[28];
            $new_array['informacion_adicional_item'] = $row[29];
            $new_array['unidad'] = $row[30];
            $new_array['linea'] = $row[31];
            $new_array['marca'] = $row[32];
            $new_array['grupo'] = $row[33];
            $new_array['subgrupo'] = $row[34];
            $new_array['grupo_produccion'] = $row[35];
            $new_array['grupo_servicio'] = $row[36];
            $new_array['serial'] = $row[37];
            $new_array['cantidad_venta'] = $row[38];
            $new_array['cantidad_factor_1'] = $row[39];
            $new_array['cantidad_factor_2'] = $row[40];
            $new_array['unidad_ensamble'] = $row[41];
            $new_array['cajas'] = $row[42];
            $new_array['cantidad_devolucion'] = $row[43];
            $new_array['peso'] = $row[44];
            $new_array['valor_unidad_venta'] = $row[45];
            $new_array['valor_total_venta'] = $row[46];
            $new_array['precio_sugerido'] = $row[47];
            $new_array['porcentaje_iva'] = $row[48];
            $new_array['valor_iva'] = $row[49];
            $new_array['valor_impoconsumo'] = $row[50];
            $new_array['costo_unitario'] = $row[51];
            $new_array['costo_total'] = $row[52];
            $new_array['utilidad'] = $row[53];
            $new_array['porcentaje_utilidad'] = $row[54];
            $new_array['porcentaje_rentabilidad'] = $row[55];
            $new_array['valor_fletes'] = $row[56];
            $new_array['valor_fletes_catalogo_articulo'] = $row[57];
            $new_array['valor_descuento_comercial'] = $row[58];
            $new_array['porcentaje_descuento_comercial'] = $row[59];
            $new_array['porcentaje_descuento_especial'] = $row[60];
            $new_array['valor_descuento_financiero'] = $row[61];
            $new_array['porcentaje_descuento_financiero'] = $row[62];
            $new_array['ciudad'] = $row[63];
            $new_array['departamento'] = $row[64];
            $new_array['zona'] = $row[65];
            $new_array['dia_vencimiento'] = $row[66];
            $new_array['mes_vencimiento'] = $row[67];
            $new_array['anio_vencimiento'] = $row[68];
            $new_array['codigo_linea_credito'] = $row[69];
            $new_array['linea_credito'] = $row[70];
            $new_array['dias_plazo'] = $row[71];
            $new_array['dia_pago'] = $row[72];
            $new_array['mes_pago'] = $row[73];
            $new_array['anio_pago'] = $row[74];
            $new_array['dias_pago'] = $row[75];
            $new_array['forma_pago'] = $row[76];
            $new_array['precio'] = $row[77];
            $new_array['referencia_pago_1'] = $row[78];
            $new_array['referencia_pago_2'] = $row[79];
            $new_array['referencia_pago_3'] = $row[80];
            $new_array['referencia_pago_4'] = $row[81];
            $new_array['descripcion_item'] = $row[82];
            $new_array['numero_lote'] = $row[83];
            $new_array['talla_identificador'] = $row[84];
            $new_array['talla'] = $row[85];
            $new_array['direccion'] = $row[86];
            $new_array['telefono'] = $row[87];
            $new_array['bodega'] = $row[88];
            $new_array['bodega_item'] = $row[89];
            $new_array['proyecto'] = $row[90];
            $new_array['centro_costos'] = $row[91];
            $new_array['nit'] = $row[92];
            $new_array['dig_verificacion'] = $row[93];
            $new_array['tipo_id'] = $row[94];
            $new_array['cod_suc'] = $row[95];
            $new_array['semana_anio'] = $row[96];
            $new_array['semana_mes'] = $row[97];
            $new_array['codigo_departamento'] = $row[98];
            $new_array['codigo_ciudad'] = $row[99];
            $new_array['primer_nombre'] = $row[100];
            $new_array['segundo_nombre'] = $row[101];
            $new_array['primer_apellido'] = $row[102];
            $new_array['segundo_apellido'] = $row[103];
            $new_array['telefonos'] = $row[104];
            $new_array['telefono_movil'] = $row[105];
            $new_array['email'] = $row[106];
            $new_array['cliente_inactivo'] = $row[107];
            $new_array['dia_semana'] = $row[108];
            $new_array['barrio'] = $row[109];
            $new_array['usuario_elaboro'] = $row[110];
            $new_array['agente_comercial'] = $row[111];
            $new_array['regimen_ventas'] = $row[112];
            $new_array['declaracion_renta'] = $row[113];
            $new_array['agente_retenedor'] = $row[114];
            $new_array['auto_retenedor'] = $row[115];
            $new_array['no_aplica_impuesto_cree'] = $row[116];
            $new_array['agente_retenedor_ica'] = $row[117];
            $new_array['causas_devolucion'] = $row[118];
            $new_array['base_calculo_interes_fac_lote'] = $row[119];
            $new_array['porcentaje_interes_fact_lote'] = $row[120];
            $new_array['hora_elaboracion_factura'] = $row[121];
            $new_array['fecha_ingreso'] = $row[122];
            $new_array['estado_subtercero'] = $row[123];
            $new_array['ficha_catastral'] = $row[124];
            $new_array['num_medidor'] = $row[125];
            $new_array['centro_costos_item'] = $row[126];
            $new_array['subcentro_costos_item'] = $row[127];
            $new_array['tercero_item'] = $row[128];
            $new_array['tarifa_iva_catalogo_servicio_articulo'] = $row[129];
            $new_array['porcentaje_iva_catalogo_servicio_articulo'] = $row[130];
            $new_array['nombre_tarifa_iva_aplicada'] = $row[131];
            $new_array['direccion_area'] = $row[132];
            $new_array['telefono_area'] = $row[133];
            $new_array['fax_area'] = $row[134];
            $new_array['ciudad_area'] = $row[135];
            $new_array['email_area'] = $row[136];
            $new_array['email_fe_area'] = $row[137];
            $new_array['barrio_area'] = $row[138];
            $new_array['afecta'] = $row[139];
            $new_array['cantidad_parcial_entregada'] = $row[140];
            /** variable final para guardar en la base de datos $new_array */
            $new_arrayf[] = $new_array;
        }
    }
}

if ($php_result = $cls_importdata->insert_venta($new_arrayf)) {
    $php_estado = true;
}



$datos = array(
    'estado' => $php_estado,
    'result' => $php_result,
    'dataload' => $new_arrayf
);


echo json_encode($datos, JSON_FORCE_OBJECT);
