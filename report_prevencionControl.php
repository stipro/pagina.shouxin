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
        $this->Cell(30, 10, utf8_decode('Prevención y Control del Sistema Anticorrupción'), 0, 0, 'C');
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
$pdf->SetTitle(utf8_decode('Prevención y Control del Sistema Anticorrupción'));

// Agregar una etiqueta y un campo de texto para el nombre
$pdf->SetFont('Arial', 'B', 6);
$pdf->Cell(190, 5, utf8_decode('REGISTRO DE PREVENCION Y CONTROL DEL SISTEMA DE ANTICORRUPCION'), 0, 0);
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
$pdf->Cell(190, 5, utf8_decode('6.1. ¿Dentro de las funciones que le fueron asignados y desempeña para Shouxin, se relaciona con funcionarios públicos?'), 0, 0, 'L');
$pdf->Ln();

$pdf->Cell(15, 5, 'Si', 0, 0);
$pdf->SetFont('ZapfDingbats', '', 6);
$pdf->Cell(5, 5, '3', 1, 0);
$pdf->SetFont('Arial', '', 6);
$pdf->Cell(15, 5, 'No', 0, 0);
$pdf->SetFont('ZapfDingbats', '', 6);
$pdf->Cell(5, 5, '', 1, 0);

$pdf->SetFont('Arial', '', 6);
$pdf->Cell(100, 5, utf8_decode('*Si ha respondido "si", proporcione detalles en el recuadro inferior que permitan a la Empresa evaluar la situación.'), 0, 0, 'L', 0, '', 0);
$pdf->Ln();
$pdf->Cell(190, 2, '', 0, 0);

$pdf->Ln();
$pdf->Cell(190, 5, utf8_decode('6.2. ¿Alguna de sus familiares directos, familiares colaterales y/o allegados es funcionario público y este mantiene alguna relación con Shouxin en el cumplimiento de sus funciones?'), 0, 0, 'L');

$pdf->Ln();
$pdf->Cell(15, 5, 'Si', 0, 0);
$pdf->SetFont('ZapfDingbats', '', 6);
$pdf->Cell(5, 5, '3', 1, 0);
$pdf->SetFont('Arial', '', 6);
$pdf->Cell(15, 5, 'No', 0, 0);
$pdf->SetFont('ZapfDingbats', '', 6);
$pdf->Cell(5, 5, '', 1, 0);

$pdf->SetFont('Arial', '', 6);
$pdf->Cell(100, 5, utf8_decode('*Si ha respondido "si", proporcione detalles en el recuadro inferior que permitan a la Empresa evaluar la situación.'), 0, 0, 'L', 0, '', 0);
$pdf->Ln();
$pdf->Cell(190, 2, '', 0, 0);

$pdf->Ln();
$pdf->Cell(190, 5, utf8_decode('6.3. ¿Usted ha liberado contratos con proveedores que tienen relación directa con funcionarios públicos para el cumplimiento del servicio contratado?'), 0, 0, 'L');

$pdf->Ln();
$pdf->Cell(15, 5, 'Si', 0, 0);
$pdf->SetFont('ZapfDingbats', '', 6);
$pdf->Cell(5, 5, '3', 1, 0);
$pdf->SetFont('Arial', '', 6);
$pdf->Cell(15, 5, 'No', 0, 0);
$pdf->SetFont('ZapfDingbats', '', 6);
$pdf->Cell(5, 5, '', 1, 0);

$pdf->SetFont('Arial', '', 6);
$pdf->Cell(100, 5, utf8_decode('*Si ha respondido "si", proporcione detalles en el recuadro inferior que permitan a la Empresa evaluar la situación.'), 0, 0, 'L', 0, '', 0);
$pdf->Ln();
$pdf->Cell(190, 2, '', 0, 0);

$pdf->Ln();
$pdf->Cell(190, 5, utf8_decode('6.4. ¿Tiene conocimiento de algún ofrecimiento o solicitud de soborno a funcionarios públicos o personal de Shouxin, para el desarrollo o favoricimiento de algún proceso en nuestra Empresa?'), 0, 0, 'L');

$pdf->Ln();
$pdf->Cell(15, 5, 'Si', 0, 0);
$pdf->SetFont('ZapfDingbats', '', 6);
$pdf->Cell(5, 5, '3', 1, 0);
$pdf->SetFont('Arial', '', 6);
$pdf->Cell(15, 5, 'No', 0, 0);
$pdf->SetFont('ZapfDingbats', '', 6);
$pdf->Cell(5, 5, '', 1, 0);

$pdf->SetFont('Arial', '', 6);
$pdf->Cell(100, 5, utf8_decode('*Si ha respondido "si", proporcione detalles en el recuadro inferior que permitan a la Empresa evaluar la situación.'), 0, 0, 'L', 0, '', 0);
$pdf->Ln();
$pdf->Cell(190, 2, '', 0, 0);

$pdf->Ln();
$pdf->Cell(190, 5, utf8_decode('6.5. ¿Alguno de sus familiares directos, familiares colaterales y/o allegados tienen alguna relación comercial y/o profesional con Shouxin? (bien sea como proveedores, clientes o colaboradores directos)'), 0, 0, 'L');

$pdf->Ln();
$pdf->Cell(15, 5, 'Si', 0, 0);
$pdf->SetFont('ZapfDingbats', '', 6);
$pdf->Cell(5, 5, '3', 1, 0);
$pdf->SetFont('Arial', '', 6);
$pdf->Cell(15, 5, 'No', 0, 0);
$pdf->SetFont('ZapfDingbats', '', 6);
$pdf->Cell(5, 5, '', 1, 0);

$pdf->SetFont('Arial', '', 6);
$pdf->Cell(100, 5, utf8_decode('*Si ha respondido "si", proporcione detalles en el recuadro inferior que permitan a la Empresa evaluar la situación.'), 0, 0, 'L', 0, '', 0);
$pdf->Ln();
$pdf->Cell(190, 2, '', 0, 0);

$pdf->Ln();
$pdf->Cell(190, 5, utf8_decode('6.6. ¿Usted ha liderado contratos con proveedores que son familiares directos, familiares colaterales o allegados a usted? '), 0, 0, 'L');

$pdf->Ln();
$pdf->Cell(15, 5, 'Si', 0, 0);
$pdf->SetFont('ZapfDingbats', '', 6);
$pdf->Cell(5, 5, '3', 1, 0);
$pdf->SetFont('Arial', '', 6);
$pdf->Cell(15, 5, 'No', 0, 0);
$pdf->SetFont('ZapfDingbats', '', 6);
$pdf->Cell(5, 5, '', 1, 0);

$pdf->SetFont('Arial', '', 6);
$pdf->Cell(100, 5, utf8_decode('*Si ha respondido "si", proporcione detalles en el recuadro inferior que permitan a la Empresa evaluar la situación.'), 0, 0, 'L', 0, '', 0);
$pdf->Ln();
$pdf->Cell(190, 2, '', 0, 0);

$pdf->Ln();
$pdf->Cell(190, 5, utf8_decode('6.7. ¿Usted o alguno de sus familiares directos, familiares colaterales y/o allegados tiene participación accionaria en las campañías de los proveedores o clientes de Shouxin?'), 0, 0, 'L');

$pdf->Ln();
$pdf->Cell(15, 5, 'Si', 0, 0);
$pdf->SetFont('ZapfDingbats', '', 6);
$pdf->Cell(5, 5, '3', 1, 0);
$pdf->SetFont('Arial', '', 6);
$pdf->Cell(15, 5, 'No', 0, 0);
$pdf->SetFont('ZapfDingbats', '', 6);
$pdf->Cell(5, 5, '', 1, 0);

$pdf->SetFont('Arial', '', 6);
$pdf->Cell(100, 5, utf8_decode('*Si ha respondido "si", proporcione detalles en el recuadro inferior que permitan a la Empresa evaluar la situación.'), 0, 0, 'L', 0, '', 0);
$pdf->Ln();
$pdf->Cell(190, 2, '', 0, 0);

$pdf->Ln();
$pdf->Cell(190, 5, utf8_decode('6.8. ¿Alguno de sus familiares directos, familiares colaterales y/o allegados trabajan en empresas del sector Minero que son competencia directo de Shouxin?'), 0, 0, 'L');

$pdf->Ln();
$pdf->Cell(15, 5, 'Si', 0, 0);
$pdf->SetFont('ZapfDingbats', '', 6);
$pdf->Cell(5, 5, '3', 1, 0);
$pdf->SetFont('Arial', '', 6);
$pdf->Cell(15, 5, 'No', 0, 0);
$pdf->SetFont('ZapfDingbats', '', 6);
$pdf->Cell(5, 5, '', 1, 0);

$pdf->SetFont('Arial', '', 6);
$pdf->Cell(100, 5, utf8_decode('*Si ha respondido "si", proporcione detalles en el recuadro inferior que permitan a la Empresa evaluar la situación.'), 0, 0, 'L', 0, '', 0);
$pdf->Ln();
$pdf->Cell(190, 2, '', 0, 0);

$pdf->Ln();
$pdf->Cell(190, 5, utf8_decode('6.9. ¿Cree usted que hay alguna otra situación no incluida en las preguntas precedentes, que van en contra de los lineamientos de ética y conducta de la Empresa, que se deberia investigar y evaluar?'), 0, 0, 'L');

$pdf->Ln();
$pdf->Cell(15, 5, 'Si', 0, 0);
$pdf->SetFont('ZapfDingbats', '', 6);
$pdf->Cell(5, 5, '3', 1, 0);
$pdf->SetFont('Arial', '', 6);
$pdf->Cell(15, 5, 'No', 0, 0);
$pdf->SetFont('ZapfDingbats', '', 6);
$pdf->Cell(5, 5, '', 1, 0);

$pdf->SetFont('Arial', '', 6);
$pdf->Cell(100, 5, utf8_decode('*Si ha respondido "si", proporcione detalles en el recuadro inferior que permitan a la Empresa evaluar la situación.'), 0, 0, 'L', 0, '', 0);
$pdf->Ln();
$pdf->Cell(190, 2, '', 0, 0);

$pdf->Ln();
$pdf->SetFillColor(191, 191, 191);
$pdf->SetFont('Arial', 'B', 6);
$pdf->Cell(190, 5, utf8_decode('DATOS DE PERSONALES'), 1, 0, 'L', 1, '', 0);


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

// Nombre y apellido
$pdf->Ln();
$pdf->SetFont('Arial', '', 6);
$pdf->Cell(30, 5, utf8_decode('Nombre y apellido'), 0, 0, 'L');
$pdf->Cell(70, 4, utf8_decode(''), 1, 0);

// DNI
$pdf->Cell(25, 5, utf8_decode('DNI'), 0, 0, 'L');
$pdf->Cell(60, 4, utf8_decode(''), 1, 0);

$pdf->Ln();
$pdf->Cell(190, 2, utf8_decode(''), 0, 0);

// Telefono
$pdf->Ln();
$pdf->SetFont('Arial', '', 6);
$pdf->Cell(30, 5, utf8_decode('Telefono'), 0, 0, 'L');
$pdf->Cell(70, 4, utf8_decode(''), 1, 0);

// Dirección
$pdf->Cell(25, 5, utf8_decode('Dirección'), 0, 0, 'L');
$pdf->Cell(60, 4, utf8_decode(''), 1, 0);

$pdf->Ln();
$pdf->Cell(190, 2, '', 0, 0);

// Correo
$pdf->Ln();
$pdf->SetFont('Arial', '', 6);
$pdf->Cell(30, 5, utf8_decode('Correo'), 0, 0, 'L');
$pdf->Cell(70, 4, utf8_decode(''), 1, 0);

$pdf->Output();
