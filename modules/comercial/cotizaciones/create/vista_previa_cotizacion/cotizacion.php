<?php
require '../../../../../vendor/autoload.php';
require '../../../../../librerias/autoload.php';
require '../../../../../modelos/autoload.php';
require_once '../../../../../plugins/fpdf184/fpdf.php';

$php_clases = new php_clases();
//require_once 'estructura_remi.php';


//require_once 'datos_cotizacion.php';


//$pdf = new FPDF('P','mm','letter',true);
//$pdf->AddPage('portrait', array(215.9 , 140), 0);

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

require('rotation.php');

class PDF extends PDF_Rotate
{

    function MultiCellBlt($w, $h, $blt, $txt, $border=0, $align='J', $fill=false)
{
	//Get bullet width including margins
	$blt_width = $this->GetStringWidth($blt)+$this->cMargin*2;

	//Save x
	$bak_x = $this->x;

	//Output bullet
	$this->Cell($blt_width,$h,$blt,0,'',$fill);

	//Output text
	$this->MultiCell($w-$blt_width,$h,$txt,$border,$align,$fill);

	//Restore x
	$this->x = $bak_x;
}

    // Cabecera de página
    function Header()
    {
        // Logo
        $this->Image('logo.jpeg', 10, 8, 20);
        $this->Image('sello_calidad.jpg', 180, 8, 20);

    }

    // Pie de página
    function Footer()
    {
        $this->Image('pie_pagina.jpg', 5, 260, 205);
    }
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$pdf = new PDF();
$pdf->AddPage('PORTRAIT', 'letter');
$pdf->SetFont('Arial');
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/**
 * ========================================================================================================
 * ENCABEZADO
 * ========================================================================================================
 */

/**
 * Fecha del Documento 
 */
$fecha_documento = 'Ibagué, 30 de Diciembre de 2021 ';
$pdf->SetFont('Arial', '', 11);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFillColor(225, 225, 225);
$pdf->SetXY(10, 50);
$pdf->Cell(70, 5, utf8_decode($fecha_documento), 0, 1, 'L');

/**
 * 
 */
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFillColor(225, 225, 225);
$pdf->SetXY(10, 57);
$pdf->Cell(70, 5, utf8_decode('Señores'), 0, 1, 'L');

/**
 * 
 */
$nombre_cliente = 'RUA GROUP S.A.S';
$pdf->SetFont('Arial', 'B', 11);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFillColor(225, 225, 225);
$pdf->SetXY(10, 62);
$pdf->Cell(70, 5, utf8_decode($nombre_cliente), 0, 1, 'L');


/**
 * 
 */
$persona_dirigida_oferta = 'Alberto de la Hoz ';
$pdf->SetFont('Arial', 'B', 11);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFillColor(225, 225, 225);
$pdf->SetXY(10, 67);
$pdf->Cell(70, 5,'Atn. Arq.' .utf8_decode($persona_dirigida_oferta), 0, 1, 'L');

$ciudad = 'Ciudad';
$pdf->SetFont('Arial', '', 11);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFillColor(225, 225, 225);
$pdf->SetXY(10, 72);
$pdf->Cell(70, 5, utf8_decode('Ciudad'), 0, 1, 'L');


/**
 * ========================================================================================================
 * FIN ENCABEZADO CARTA
 * ========================================================================================================
 */


 /**
 * ========================================================================================================
 * ASUNTO
 * ========================================================================================================
 */
$asunto = 'Oferta Mercantil Número PAGM-2021-12-30 para el suministro de productos y servicios año 2022,';
$pdf->SetFont('Arial', '', 11);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFillColor(225, 225, 225);
$pdf->SetXY(10, 82);
$pdf->Cell(70, 15, utf8_decode($asunto), 1, 1, 'L');

 /**
 * ========================================================================================================
 * FIN ASUNTO
 * ========================================================================================================
 */


  /**
 * ========================================================================================================
 * INTRODUCCION
 * ========================================================================================================
 */
$parrafo1 = 'Nos permitimos presentarle nuestra oferta de suministro de concreto para su Proyecto en Gualanday Tolima para el año 2021, bajo el compromiso de CONCRE TOLIMA Concretol de prestar un servicio caracterizado por el cumplimiento y calidad en nuestros productos respaldada por la certificación ISO 9001:2015.';

$parrafo2 = 'En la actualidad CONCRE TOLIMA S.A cuenta con asesoría técnica, equipo de trabajo capacitado, con 3 plantas dosificadoras de 40 M3/Hr, 5 bombas estacionarías y 1 autobomba de concreto, 29 camiones mezcladores, equipo de laboratorio para fallo de cilindros y viguetas certificados, y reserva de agua de 200.000 litros permanentemente para una producción aproximada de 300 M3 día por planta. ';

$titulo1 = 'UBICACIÓN ESTRATÉGICA';

$parrafo3 = 'CONCRETOLIMA se consolida como el productor número uno de concretos en la ciudad de Ibagué, es así que la ubicación de nuestras dos plantas en la Avenida Mirolindo, nos permite poder abarcar los perímetros de mayor desarrollo constructivo en la ciudad.';

$subtitulo1 = 'Primera – Objeto de la oferta.';

$vinetas_1 = ['Realizar la producción de concreto, para todas las mezclas que la obra necesite durante la construcción (mano de obra y maquinaria).','Producir concreto a escala de obra, según los diseños de mezclas establecidos.','Control de materias primas. ','Supervisor del proceso completo de producción.','Análisis estadístico del concreto.'
];

$subtitulo2 = 'SUMINISTRO';

$parrafo4 = 'En el evento de aceptación de la presente oferta mercantil, CONCRETOL se obliga a suministrar los Concretos y servicios, en el lugar de la Obra y durante la duración de la presente oferta.  ';

$titulo2 = 'PRECIO DE LA MEZCLA Y LAS ADICIONES SIN IVA 2022';

$pdf->SetFont('Arial', '', 11);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFillColor(225, 225, 225);
$pdf->SetXY(10, 100);
$pdf->MultiCell(200, 5, utf8_decode($parrafo1), 0, 'L', false);
$pdf->ln(1);
$pdf->MultiCell(200, 5, utf8_decode($parrafo2), 0, 'L', false);
$pdf->ln(10);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(200, 5, utf8_decode($titulo1), 0, 5, 'C', false);
$pdf->ln(5);
$pdf->SetFont('Arial', '', 11);
$pdf->MultiCell(200, 5, utf8_decode($parrafo3), 0, 'L', false);
$pdf->ln(5);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(200, 5, utf8_decode($subtitulo1), 0, 5, 'L', false);
$pdf->ln(5);
$pdf->SetFont('Arial', '', 11);
$n= 1;
foreach ($vinetas_1 as $key1) {
    $n++;
    $pdf->MultiCellBlt(200,5,"$n.",utf8_decode($key1));
}
$pdf->ln(5);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(200, 5, utf8_decode($subtitulo2), 0, 5, 'L', false);

$pdf->ln(5);
$pdf->SetFont('Arial', '', 11);
$pdf->MultiCell(200, 5, utf8_decode($parrafo4), 0, 'L', false);

$pdf->ln(15);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(200, 5, utf8_decode($titulo2), 0, 5, 'C', false);
$pdf->ln(5);



//  

 /**
 * ========================================================================================================
 * FIN ASUNTO
 * ========================================================================================================
 */





$pdf->Output();