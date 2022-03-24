<?php

require '../../../../vendor/autoload.php';

require '../../../../librerias/autoload.php';

require '../../../../modelos/autoload.php';

require '../../../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Helper\Sample;

use PhpOffice\PhpSpreadsheet\IOFactory;

use PhpOffice\PhpSpreadsheet\Spreadsheet;

use PhpOffice\PhpSpreadsheet\Style\Border;

use PhpOffice\PhpSpreadsheet\Style\Fill;

use PhpOffice\PhpSpreadsheet\Style\Style;

$php_clases = new php_clases();

$informes = new informes();

$tiempo_remi = new tiempo_remi();

$abc1 = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');

$abc2 = array('AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ');

if (isset($_GET['txt_fecha_ini']) && isset($_GET['txt_fecha_fin'])) {
    $fecha_ini = $_GET['txt_fecha_ini'];
    $fecha_fin = $_GET['txt_fecha_fin'];

    $datos = $informes->informe_dasa($fecha_ini, $fecha_fin);

    $spreadsheet = new Spreadsheet();
    // Set document properties

    $spreadsheet->getProperties()->setCreator('PORTAL CONCRETOL')

        ->setLastModifiedBy('PORTAL CONCRETOL')

        ->setTitle('Informe de dasa')

        ->setSubject('Informe de dasa')

        ->setDescription('Informe de dasa')

        ->setKeywords('')

        ->setCategory('');

    $spreadsheet->setActiveSheetIndex(0)

        ->setCellValue('A1', 'DOCUMENTO')

        ->setCellValue('B1', 'FECHA')

        ->setCellValue('C1', 'CLIENTE')

        ->setCellValue('D1', 'DEPENDENCIA');

    // ->setCellValue('E1', 'LINEA DE DESPACHO')

    // ->setCellValue('F1', 'NUMERO IDENTIFICACION')

    // ->setCellValue('G1', 'CLIENTE')

    // ->setCellValue('H1', 'OBRA')

    // ->setCellValue('I1', 'PLACA DELA MIXER')

    // ->setCellValue('J1', 'IDENTIFICACION CONDUCTOR')

    // ->setCellValue('K1', 'CONDUCTOR')

    // ->setCellValue('L1', 'SELLO DE SEGURIDAD')

    // ->setCellValue('M1', 'CODIGO DEL PRODUCTO')

    // ->setCellValue('N1', 'PRODUCTO')

    // ->setCellValue('O1', 'METROS CUBICOS')

    // ->setCellValue('P1', 'ASENTAMENTO')

    // ->setCellValue('Q1', 'HORA REMISION')

    // ->setCellValue('R1', 'HORA DE SALIDA MIXER DE PLANTA')

    // ->setCellValue('S1', 'HORA DE LLEGADA MIXER A OBRA')

    // ->setCellValue('T1', 'HORA DE INICIO DE DESCARGUE')

    // ->setCellValue('U1', 'HORA DE TERMINACION DE DESCARGUE')

    // ->setCellValue('V1', 'HORA DE LLEGADA MIXER EN PLANTA')

    // ->setCellValue('W1', 'DESPACHADOR')

    // ->setCellValue('X1', 'FIRMA CLIENTE')

    // ->setCellValue('Y1', 'FECHA FIRMA')

    // ->setCellValue('Z1', 'OBSERVACIONES')

    // ->setCellValue('AA1', 'CICLO VIAJE')

    // ->setCellValue('AB1', 'CICLO PLANTA')

    // ->setCellValue('AC1', 'CICLO TRANSPORTE')

    // ->setCellValue('AD1', 'CICLO DESCARGUE')

    // ->setCellValue('AE1', 'CICLO ESPERA EN OBRA')

    // ->setCellValue('AF1', 'CICLO OBRA')

    // ->setCellValue('AG1', 'BOMBA')

    // ->setCellValue('AH1', 'OPERARIO DE BOMBA')

    // ->setCellValue('AI1', 'AUXILIAR BOMBA')

    // ->setCellValue('AJ1', 'NOVEDADES')

    // ->setCellValue('AK1', '')

    // ->setCellValue('AL1', '')

    // ->setCellValue('AM1', '')

    // ->setCellValue('AN1', '');

    $x = 2;

    if (is_array($datos)) {

        foreach ($datos as $fila) {

            $documento = $fila['documento'];

            $fecha = $fila['fecha'];

            $cliente = $fila['cliente'];

            $dependencia = $fila['dependencia'];

            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $x, $documento)
                ->setCellValue('B' . $x,  $fecha)
                ->setCellValue('C' . $x, $cliente)
                ->setCellValue('D' . $x,  $dependencia);
            $x++;
        }
    }

    // Rename worksheet

    $spreadsheet->getActiveSheet()->setTitle('Dasa');

    $spreadsheet->getActiveSheet()

        ->getColumnDimension('A')

        ->setAutoSize(true);

    $spreadsheet->getActiveSheet()

        ->getColumnDimension('B')

        ->setAutoSize(true);

    $spreadsheet->getActiveSheet()

        ->getColumnDimension('C')

        ->setAutoSize(true);

    $spreadsheet->getActiveSheet()

        ->getColumnDimension('D')

        ->setAutoSize(true);

    $spreadsheet->getActiveSheet()

        ->getColumnDimension('E')

        ->setAutoSize(true);

    $spreadsheet->getActiveSheet()

        ->getColumnDimension('F')

        ->setAutoSize(true);

    $spreadsheet->getActiveSheet()

        ->getColumnDimension('G')

        ->setAutoSize(true);

    $spreadsheet->getActiveSheet()

        ->getColumnDimension('H')

        ->setAutoSize(true);

    $spreadsheet->getActiveSheet()

        ->getColumnDimension('I')

        ->setAutoSize(true);

    $spreadsheet->getActiveSheet()

        ->getColumnDimension('J')

        ->setAutoSize(true);

    $spreadsheet->getActiveSheet()

        ->getColumnDimension('K')

        ->setAutoSize(true);

    $spreadsheet->getActiveSheet()

        ->getColumnDimension('L')

        ->setAutoSize(true);

    $spreadsheet->getActiveSheet()

        ->getColumnDimension('M')

        ->setAutoSize(true);

    $spreadsheet->getActiveSheet()

        ->getColumnDimension('N')

        ->setAutoSize(true);

    $spreadsheet->getActiveSheet()

        ->getColumnDimension('O')

        ->setAutoSize(true);

    $spreadsheet->getActiveSheet()

        ->getColumnDimension('P')

        ->setAutoSize(true);

    $spreadsheet->getActiveSheet()

        ->getColumnDimension('Q')

        ->setAutoSize(true);

    $spreadsheet->getActiveSheet()

        ->getColumnDimension('R')

        ->setAutoSize(true);

    $spreadsheet->getActiveSheet()

        ->getColumnDimension('S')

        ->setAutoSize(true);

    $spreadsheet->getActiveSheet()

        ->getColumnDimension('T')

        ->setAutoSize(true);

    $spreadsheet->getActiveSheet()

        ->getColumnDimension('U')

        ->setAutoSize(true);

    $spreadsheet->getActiveSheet()

        ->getColumnDimension('V')

        ->setAutoSize(true);

    $spreadsheet->getActiveSheet()

        ->getColumnDimension('W')

        ->setAutoSize(true);

    $spreadsheet->getActiveSheet()

        ->getColumnDimension('X')

        ->setAutoSize(true);

    $spreadsheet->getActiveSheet()

        ->getColumnDimension('Y')

        ->setAutoSize(true);

    $spreadsheet->getActiveSheet()

        ->getColumnDimension('Z')

        ->setAutoSize(true);

    $spreadsheet->getActiveSheet()

        ->getColumnDimension('AA')

        ->setAutoSize(true);

    $spreadsheet->getActiveSheet()

        ->getColumnDimension('AB')

        ->setAutoSize(true);

    $spreadsheet->getActiveSheet()

        ->getColumnDimension('AC')

        ->setAutoSize(true);

    $spreadsheet->getActiveSheet()

        ->getColumnDimension('AD')

        ->setAutoSize(true);

    $spreadsheet->getActiveSheet()

        ->getColumnDimension('AE')

        ->setAutoSize(true);

    $spreadsheet->getActiveSheet()

        ->getColumnDimension('AF')

        ->setAutoSize(true);

    $spreadsheet->getActiveSheet()

        ->getColumnDimension('AG')

        ->setAutoSize(true);

    $spreadsheet->getActiveSheet()

        ->getColumnDimension('AH')

        ->setAutoSize(true);

    $spreadsheet->getActiveSheet()

        ->getColumnDimension('AI')

        ->setAutoSize(true);

    $styleArray = [
        'font' => [
            'bold' => true,
        ],
        'fill' => [

            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,

            'startColor' => [
                'argb' => 'DE9D24',
            ],
            'endColor' => [
                'argb' => 'DE9D24',
            ],
        ],
    ];
    $spreadsheet->getActiveSheet()->getStyle('Y17')->getNumberFormat()->applyFromArray(
        [
            'formatCode' => PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_DATE_TIME6
        ]
    );
    $spreadsheet->getActiveSheet()->getStyle('A1:AJ1')->applyFromArray($styleArray);

    // Set active sheet index to the first sheet, so Excel opens this as the first sheet

    $spreadsheet->setActiveSheetIndex(0);

    // Redirect output to a client’s web browser (Xlsx)

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

    header('Content-Disposition: attachment;filename="Dasa.xlsx"');

    header('Cache-Control: max-age=0');

    // If you're serving to IE 9, then the following may be needed

    header('Cache-Control: max-age=1');

    // If you're serving to IE over SSL, then the following may be needed

    // header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past

    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified

    header('Cache-Control: cache, must-revalidate'); // HTTP/1.1

    header('Pragma: public'); // HTTP/1.0

    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');

    $writer->save('php://output');

    exit;
} else {
    header('location: index.php');
}
