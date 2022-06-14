<?php

use setasign\Fpdi\Fpdi;

include('./FPDF/fpdf.php');
include('./FPDI/autoload.php');
include('./GRID/grid.php');


$pdf = new PDF_Grid();

$pdf->AddPage();


try {
    $pdf->setSourceFile('templatedoc.pdf');
} catch (\setasign\Fpdi\PdfParser\PdfParserException $e) {
}

$tplIdx = $pdf->importPage(1);

$pdf->useTemplate($tplIdx, 0, 0,);

$pdf->SetFont('Arial');
$pdf->SetFontSize(5);
$pdf->SetTextColor(0,0,0);

$XPos = 0;
$YPos = 0;
for ($y = 0; $y <= 270; $y++) {
    if ($y == $YPos) {
        for ($x = 0; $x <= 190; $x++) {
            if ($x == $XPos) {
                $pdf->SetXY($x, $y);
                $pdf->Write(0, $x."/".$y);
                $XPos = $XPos + 10;
            }
        }
    }
    if (fmod($y/10,1) == 0.0) {
        $YPos = $YPos + 10;
        $XPos = 0;
    }
}

$pdf->Output("d","gridtemplate.pdf");