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
        ->setCellValue('A1', 'FECHA Y HORA')
        ->setCellValue('B1', 'PLACA DASA')
        ->setCellValue('C1', 'PRODUCTO')
        ->setCellValue('D1', 'CANTIDAD')
        ->setCellValue('E1', 'PPU')
        ->setCellValue('F1', 'TOTAL PRODUCTO')
        ->setCellValue('G1', 'TOTAL DOCUMENTO')
        ->setCellValue('H1', 'PLACA GPS')
        ->setCellValue('I1', 'KM')
        ->setCellValue('J1', 'HORAS VIAJE')
        ->setCellValue('K1', 'RALENTI')
        ->setCellValue('L1', 'HORAS ENCENDIDO');
    $x = 2;

    if (is_array($datos)) {
        foreach ($datos as $fila) {
            $fecha = $fila['fecha_hora'];
            $placa = $fila['placa'];
            $producto = $fila['producto'];
            $cantidad = $fila['cantidad'];
            $ppu = $fila['ppu'];
            $total_producto = $fila['total_producto'];
            $total_documento = $fila['total_documento'];
            $UnitName1 = $fila['UnitName1'];
            $MilesDriven = $fila['MilesDriven'];
            $Textbox3 = $fila['Textbox3'];
            $Textbox6 = $fila['Textbox6'];
            $Textbox11 = $fila['Textbox11'];

            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $x, $fecha)
                ->setCellValue('B' . $x,  $placa)
                ->setCellValue('C' . $x, $producto)
                ->setCellValue('D' . $x,  $cantidad)
                ->setCellValue('E' . $x,  $ppu)
                ->setCellValue('F' . $x,  $total_producto)
                ->setCellValue('G' . $x,  $total_documento)
                ->setCellValue('H' . $x,  $UnitName1)
                ->setCellValue('I' . $x,  $MilesDriven)
                ->setCellValue('J' . $x,  $Textbox3)
                ->setCellValue('K' . $x,  $Textbox6)
                ->setCellValue('L' . $x,  $Textbox11);
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
