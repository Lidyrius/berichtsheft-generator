<?php
use setasign\Fpdi\Fpdi;

include('FPDF/fpdf.php');
include('FPDI/autoload.php');
include('GRID/grid.php');



$data = $_GET;

$beginning = $data["beginning"];
$ending = $data["ending"];
$week = $data["week"]+1;

$pdf = new PDF_Grid();

addPage($week, strtotime($beginning), strtotime($ending), false, $pdf);

function addPage($week, $timestamp, $ending, $sameweek = false, $pdf){
    if ($timestamp <= $ending) {
        if (date("N", $timestamp) < 6 && $sameweek == false) {
            //echo "Wochentag: Ja | ".date("D", $timestamp)." | ".$week."<br>";
            writePDF($week, $timestamp, $pdf);
            addPage($week,$timestamp+86400, $ending, true, $pdf);
        } else {
            //echo "Schon gedruckt <br>";
            if (date("N", $timestamp) == 7) {
                addPage($week+1,$timestamp+86400, $ending, false,$pdf);
            } else {
                addPage($week,$timestamp+86400, $ending, true, $pdf);
            }
        }
    } else {
        $pdf->Output("d","Berichtsheft.pdf");
    }
}

function writePDF($week, $timestamp, $pdf) {

    //Variables for the PDF Header
    $monday = date("d.m.Y", $timestamp);
    $friday = date("d.m.Y", $timestamp+345600);
    $year = date("Y", $timestamp);

    //Contents
    $contents = [];
    $f_contents = file("liste.txt");

    //Random number generator for the amount of Contents
    $rng = rand(3, 5);

    for ($i = 0; $i < $rng; $i++) {
        $line = getUniqueLine($contents, $f_contents);
        $contents[$i] = $line;
    }

    //make the Array unique
    $contents = array_unique($contents);
    foreach ($contents as $key => $value) {
        if ($value == null) {
            unset($contents[$key]);
        }
    }
    $contents = array_values($contents);




    $pdf->AddPage();


    try {
        $pdf->setSourceFile('templatedoc.pdf');
    } catch (\setasign\Fpdi\PdfParser\PdfParserException $e) {
    }

    $tplIdx = $pdf->importPage(1);

    $pdf->useTemplate($tplIdx, 0, 0,);

    $pdf->SetFont('Arial');
    $pdf->SetFontSize(11.5);
    $pdf->SetTextColor(0,0,0);

    //Week
    $pdf->SetXY(77,39.85);
    $pdf->Write(0, $week);

    //Monday
    $pdf->SetXY(89.3,39.85);
    $pdf->Write(0, $monday);

    //Friday
    $pdf->SetXY(123.7,39.85);
    $pdf->Write(0, $friday);

    //Year
    $pdf->SetXY(180.6,39.85);
    $pdf->Write(0, $year);

    foreach ($contents as $key => $value) {
        //Content Bullet Point
        $pdf->SetXY(23.1,72.1+($key*5.6));
        $pdf->SetFontSize(20.5);
        $pdf->Write(0, "\x95");

        //Content
        $pdf->SetFontSize(11.5);
        $pdf->SetXY(29.45,71.52 + ($key*5.7));
        $pdf->Write(0, utf8_decode($value));
    }
}

function getUniqueLine($array, $file) {
    $line = $file[rand(0, count($file) - 1)];
    if (in_array($line, $array)){
        getUniqueLine($array, $file);
        //echo "Schon vorhanden <br>";
    } else {
        return $file[rand(0, count($file) - 1)];
    }
}


