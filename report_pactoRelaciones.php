<?php
require('./library/rotation.php');
date_default_timezone_set('America/Lima');

class PDF extends PDF_Rotate
{

    function Header()
    {
        // Logo
        $this->Image('./assets/img/isotipo-shouxin.png', 10, 8, 15);
        // Arial bold 15
        $this->SetFont('Arial', 'B', 7);
        // Movernos a la derecha
        $this->Cell(80);
        // Título
        $this->Cell(30, 10, utf8_decode('Cumplimiento de Pactos de Relaciónes'), 0, 0, 'C');
        // Salto de línea
        $this->Ln(20);
        //Put the watermark
        $this->SetFont('Arial', 'B', 50);
        $this->SetTextColor(255, 192, 203);
        $this->RotatedText(80, 150, 'S h o u x i n', 45);
    }

    function RotatedText($x, $y, $txt, $angle)
    {
        //Text rotated around its origin
        $this->Rotate($angle, $x, $y);
        $this->Text($x, $y, $txt);
        $this->Rotate(0);
    }
}

function a_romano($integer, $upcase = true)
{
    $table = array(
        'M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100,
        'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9,
        'V' => 5, 'IV' => 4, 'I' => 1
    );
    $return = '';
    while ($integer > 0) {
        foreach ($table as $rom => $arb) {
            if ($integer >= $arb) {
                $integer -= $arb;
                $return .= $rom;
                break;
            }
        }
    }
    return $return;
}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 7);
$pdf->SetTitle(utf8_decode('Cumplimiento de Pactos de Relaciónes'));

// Agregar una etiqueta y un campo de texto para el nombre
$pdf->SetFont('Arial', 'B', 6);
$pdf->Cell(190, 5, utf8_decode('REGISTRO DE CUMPLIEMTO DE PACTOS DE RELACIÓNES'), 0, 0);
$pdf->Ln();
$pdf->SetFont('Arial', '', 6);
$pdf->Cell(25, 5, utf8_decode(''), 0, 0, 'L');


$pdf->SetY(35.5);
$pdf->SetX(35);
$pdf->Cell(10, 4, '', 0, 0, 'C');
$pdf->Cell(10, 4, '', 0, 0, 'C');
$pdf->Cell(10, 4, '', 0, 0, 'C');

$pdf->Ln();
$pdf->SetY(35);
$pdf->SetX(150);
$pdf->Cell(25, 5, utf8_decode('N° de Registro'), 0, 0, 'L');
$pdf->Cell(25, 5, utf8_decode(''), 1, 0, 'L');

$pdf->SetY(35);
$pdf->SetX(10);
$pdf->Ln();
$pdf->Cell(190, 2, '', 0, 0);
$pdf->Ln();
/* $pdf->Cell(25, 5, utf8_decode('¿Denuncia anónima?'), 0, 0, 'L');
$pdf->Ln();
$pdf->SetY(42);
$pdf->SetX(35);

$pdf->Cell(15, 5, 'Si', 0, 0);
$pdf->SetFont('ZapfDingbats', '', 6);
$pdf->Cell(5, 5, '3', 1, 0);
$pdf->SetFont('Arial', '', 6);
$pdf->Cell(15, 5, 'No', 0, 0);
$pdf->SetFont('ZapfDingbats', '', 6);
$pdf->Cell(5, 5, '', 1, 0);

$pdf->SetFont('Arial', '', 6);
$pdf->Cell(100, 5, utf8_decode('*En caso de denuncias anónimas no dan lugar al otorgamiento de medidas de protección'), 0, 0, 'L', 0, '', 0);
$pdf->Ln();
$pdf->Cell(190, 2, '', 0, 0);
$pdf->Ln(); */
$pdf->SetFillColor(191, 191, 191);
$pdf->SetFont('Arial', 'B', 6);
$pdf->Cell(190, 5, utf8_decode('DATOS DE PACTO'), 1, 0, 'L', 1, '', 0);
/* // Tipo de documento
$pdf->Ln();
$pdf->SetFont('Arial', '', 6);
$pdf->Cell(25, 5, utf8_decode('Tipo de documento'), 1, 0, 'L');
$pdf->Cell(15, 5, 'DNI', 1, 0);
$pdf->SetFont('ZapfDingbats', '', 6);
$pdf->Cell(5, 5, '4', 1, 0);
$pdf->SetFont('Arial', '', 6);
$pdf->Cell(15, 5, 'CE', 1, 0);
$pdf->SetFont('ZapfDingbats', '', 6);
$pdf->Cell(5, 5, '', 1, 0);
$pdf->SetFont('Arial', '', 6);
$pdf->Cell(15, 5, 'RUC', 1, 0);
$pdf->SetFont('ZapfDingbats', '', 6);
$pdf->Cell(5, 5, '', 1, 0);
$pdf->SetFont('Arial', '', 6);
$pdf->Cell(15, 5, 'OTROS', 1, 0);
$pdf->SetFont('ZapfDingbats', '', 6);
$pdf->Cell(5, 5, '', 1, 0);

// Numero de documento
$pdf->SetFont('Arial', '', 6);
$pdf->Cell(18, 5, utf8_decode('N° Documento'), 1, 0, 'C');
$pdf->SetFont('Arial', '', 6);
$pdf->Cell(18, 5, utf8_decode('75898835'), 1, 0, 'L'); */
$pdf->Ln();
$pdf->Cell(190, 2, '', 0, 0);

// Nombres
$pdf->Ln();
$pdf->SetFont('Arial', '', 6);
$pdf->Cell(30, 5, utf8_decode('Nombres'), 0, 0, 'L');
$pdf->Cell(70, 4, utf8_decode(''), 1, 0);

// Dirección
$pdf->Cell(25, 5, utf8_decode('Dirección'), 0, 0, 'L');
$pdf->Cell(60, 4, utf8_decode(''), 1, 0);

$pdf->Ln();
$pdf->Cell(190, 2, utf8_decode(''), 0, 0);

// Correo electrónico
$pdf->Ln();
$pdf->SetFont('Arial', '', 6);
$pdf->Cell(30, 5, utf8_decode('Correo electrónico'), 0, 0, 'L');
$pdf->Cell(70, 4, utf8_decode(''), 1, 0);

// Celular
$pdf->Cell(25, 5, utf8_decode('Celular'), 0, 0, 'L');
$pdf->Cell(60, 4, utf8_decode(''), 1, 0);

$pdf->Ln();
$pdf->Cell(190, 2, '', 0, 0);

// Organización
$pdf->Ln();
$pdf->SetFont('Arial', '', 6);
$pdf->Cell(30, 5, utf8_decode('Organización que representa'), 0, 0, 'L');
$pdf->Cell(70, 4, utf8_decode(''), 1, 0);

// Acompañantes
$pdf->Cell(25, 5, utf8_decode('Acompañantes'), 0, 0, 'L');
$pdf->Cell(60, 4, utf8_decode(''), 1, 0);
$pdf->Ln();
$pdf->Cell(190, 2, '', 0, 0);

// Frases Mencionadas
$pdf->Ln();
$pdf->SetFont('Arial', '', 6);
$pdf->Cell(30, 5, utf8_decode('Frases Mencionadas'), 0, 0, 'L');
$pdf->Cell(70, 4, utf8_decode(''), 1, 0);

// Personas Referidas
$pdf->Cell(25, 5, utf8_decode('Personas Referidas'), 0, 0, 'L');
$pdf->Cell(60, 4, utf8_decode(''), 1, 0);
$pdf->Ln();
$pdf->Cell(190, 2, '', 0, 0);

// Sucesos en el Tiempo
$pdf->Ln();
$pdf->SetFont('Arial', '', 6);
$pdf->Cell(30, 5, utf8_decode('Sucesos en el Tiempo'), 0, 0, 'L');
$pdf->Cell(70, 4, utf8_decode(''), 1, 0);

$pdf->Output();
