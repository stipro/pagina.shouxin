<?php
require('./library/rotation.php');

class PDF extends PDF_Rotate
{

    function Header()
    {
        // Logo
        $this->Image('./assets/img/isotipo-shouxin.png', 10, 8, 33);
        // Arial bold 15
        $this->SetFont('Arial', 'B', 15);
        // Movernos a la derecha
        $this->Cell(80);
        // Título
        $this->Cell(30, 10, utf8_decode('Actos de Corrupción'), 0, 0, 'C');
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

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);
$pdf->SetTitle(utf8_decode('Acto de Corrupción'));
$txt = "FPDF is a PHP class which allows to generate PDF files with pure PHP, that is to say " .
    "without using the PDFlib library. F from FPDF stands for Free: you may use it for any " .
    "kind of usage and modify it to suit your needs.\n\n";
for ($i = 0; $i < 25; $i++)
    $pdf->MultiCell(0, 5, $txt, 0, 'J');
$pdf->Output();
