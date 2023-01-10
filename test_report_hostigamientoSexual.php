<?php
require('./library/test_rotation.php');
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
        $this->Cell(30, 10, utf8_decode('Denuncias o queja por acto de hostigamiento sexual'), 0, 0, 'C');
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
$pdf->SetTitle(utf8_decode('Denuncias o queja por acto de hostigamiento sexual'));

// Agregar una etiqueta y un campo de texto para el nombre
$pdf->SetFont('Arial', 'B', 6);
$pdf->Cell(190, 5, utf8_decode(''), 0, 0);
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

$pdf->SetFillColor(191, 191, 191);
$pdf->SetFont('Arial', 'B', 6);
$pdf->Cell(190, 5, utf8_decode('DATOS DE LA VICTIMA DE ACTOS DE HOSTIGAMIENTO SEXUAL'), 1, 0, 'L', 1, '', 0);
$pdf->Ln();

$pdf->Cell(190, 2, '', 0, 0);

// Nombres y Apellidos
$pdf->Ln();
$pdf->SetFont('Arial', '', 6);
$pdf->Cell(30, 5, utf8_decode('Nombres y Apellidos'), 0, 0, 'L');
$pdf->Cell(70, 4, utf8_decode(''), 1, 0);

// Documento de identidad
$pdf->Cell(25, 5, utf8_decode('Documento de identidad'), 0, 0, 'L');
$pdf->Cell(60, 4, utf8_decode(''), 1, 0);

$pdf->Ln();
$pdf->Cell(190, 2, utf8_decode(''), 0, 0);

// Correo electrónico
$pdf->Ln();
$pdf->SetFont('Arial', '', 6);
$pdf->Cell(30, 5, utf8_decode('Domicilio'), 0, 0, 'L');
$pdf->Cell(155, 4, utf8_decode(''), 1, 0);
$pdf->Ln();
$pdf->Cell(190, 2, '', 0, 0);
$pdf->Ln();

// Celular
$pdf->Cell(30, 5, utf8_decode('Teléfono'), 0, 0, 'L');
$pdf->Cell(20, 4, utf8_decode(''), 1, 0);

$pdf->Cell(15, 5, utf8_decode('Fijo'), 0, 0, 'C');
$pdf->Cell(20, 4, utf8_decode(''), 1, 0);

$pdf->Cell(15, 5, utf8_decode('Celular'), 0, 0, 'C');
$pdf->Cell(20, 4, utf8_decode(''), 1, 0);

$pdf->Cell(25, 5, utf8_decode('Correo Electronico'), 0, 0, 'C');
$pdf->Cell(40, 4, utf8_decode(''), 1, 0);


$pdf->Ln();
$pdf->Cell(190, 2, '', 0, 0);

// Organización
$pdf->Ln();
$pdf->SetFont('Arial', '', 6);
//$pdf->Cell(30, 5, utf8_decode('Cargo o servicio o modalidad formativa que desempeña'), 0, 0, 'L');
$pdf->Multicell(30, 2,utf8_decode("Cargo o servicio o modalidad\nformativa que desempeña"), 0,'L', false); 
$pdf->SetY(67);
$pdf->SetX(40);
$pdf->Cell(63, 4, utf8_decode(''), 1, 0);
$pdf->Cell(30, 4, utf8_decode('Dirección, Oficina o Área'), 0, 0, 'C');
$pdf->Cell(62, 4, utf8_decode(''), 1, 0);

$pdf->Ln();
$pdf->Cell(190, 2, '', 0, 0);

$pdf->Ln();
$pdf->SetFillColor(191, 191, 191);
$pdf->SetFont('Arial', 'B', 6);
$pdf->Cell(190, 5, utf8_decode('DATOS DE LA PERSONA CONTRA QUIEN SE FORMULA LA QUEJA O DENUNCIA'), 1, 0, 'L', 1, '', 0);
$pdf->Ln();

// Nombres y Apellidos
$pdf->SetFont('Arial', '', 6);
$pdf->Cell(30, 5, utf8_decode('Nombres y Apellidos'), 0, 0, 'L');
$pdf->Cell(70, 4, utf8_decode(''), 1, 0);

$pdf->Cell(30, 5, utf8_decode('Cargo o servicio o modalidad formativa que desempeña'), 0, 0, 'L');
$pdf->Cell(70, 4, utf8_decode(''), 1, 0);

$pdf->Ln();
$pdf->SetFillColor(191, 191, 191);
$pdf->SetFont('Arial', 'B', 6);
$pdf->Cell(190, 5, utf8_decode('DATOS DE PERSONA QUE FORMULAR LA QUEJA O DENUNCIA (EN CASO DE QUE LA VICTIMA NO ES LA QUE FORMULA LA DENUNCIA)'), 1, 0, 'L', 1, '', 0);
$pdf->Ln();

$pdf->Ln();
$pdf->SetFillColor(191, 191, 191);
$pdf->SetFont('Arial', 'B', 6);
$pdf->Cell(190, 5, utf8_decode('DETALLE DE LOS HECHOS MATERIA DE LA QUEJA O DENUNCIA (PRECISANDO CIRCUNSTANCIAS, FECHA O PERIODO, LUGAR/ES, AUTOR/ES, PARTÍCIPES, CONSECUENCIAS LABORALES, SOCIALES, O PSICOLÓGOS, ENTRE OTROS)'), 1, 0, 'L', 1, '', 0);
$pdf->Ln();

$pdf->Ln();
$pdf->SetFillColor(191, 191, 191);
$pdf->SetFont('Arial', 'B', 6);
$pdf->Cell(190, 5, utf8_decode('MEDIOS PROBATORIOS OFRECIDOS O RECABADOS QUE PERMITAN LA VERIFICACIÓN DE LOS ACTOS DE HOSTIGAMIENTO SEXUAL DENUNCIADOS'), 1, 0, 'L', 1, '', 0);
$pdf->Ln();

$pdf->Ln();
$pdf->SetFillColor(191, 191, 191);
$pdf->SetFont('Arial', 'B', 6);
$pdf->Cell(190, 5, utf8_decode('MEDIDAS DE PROTECCIÓN PARA LA VICTIMA'), 1, 0, 'L', 1, '', 0);
$pdf->Ln();

$pdf->Output();
