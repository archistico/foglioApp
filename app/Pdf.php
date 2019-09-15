<?php
namespace App;

DEFINE(BR, "<br>");

class Pdf
{
    private $app;

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function ViewPdf()
    {
        /*
        $pdf = new FPDF();

        $pageWidth = 297;
        $pageHeight = 210;
        $margin = 7;
        $gutter = 2;
        $header = 10;

        $numberDayInWeek = count($this->app);
        $numberDays = 2;
        $width = $pageWidth - 2 * $margin;
        $height = $pageHeight - 2 * $margin;
        $numberColumns = $numberDayInWeek*$numberDays;
        $columnWidth = ($width - ($numberColumns-1) * $gutter) / $numberColumns;
        $columnHeight = $height - $header;
        $rowMargin = 1;
        $numberRows = 31;
        $rowHeight = ($columnHeight - 1 * $rowMargin) / $numberRows;
        $rowPadding = 0.5;
        $rowWidthNumber = 5;
        $textNumberHeight = 3;
        $textTitleHeight = 16;
        $textTitleColumnHeight = 11;
        $textRowHeight = 10;

        $pdf->AddPage('L', [$pageWidth, $pageHeight]);
        $pdf->SetMargins($margin, $margin, $margin);

        $pdf->SetFont('Arial', 'B', $textTitleHeight);
        $text = "Appuntamenti Rollandin";
        $textWidth = strlen($text) * 1;
        $pdf->Text($margin + $width / 2 - $textWidth, $margin + $header / 2, $text);

        $giorni = array();
        for($c = 0; $c < $numberDays; $c++) {
            foreach(array_keys($this->app) as $g) {
                $giorni[] = $g;
            }
        }

        for ($c = 0; $c < $numberColumns; $c++) {
            $xColumn = $margin + $c * ($columnWidth + $gutter);
            $yColumn = $margin + $header;
            $pdf->SetFillColor(196);
            $pdf->Rect($xColumn,$yColumn,$columnWidth,$columnHeight,'F');
            
            $pdf->SetFont('Arial', 'B', $textTitleColumnHeight);
            $pdf->Text($xColumn, $yColumn, $giorni[$c]);

            
        }

        $pdf->Output();
        */
    }

    public function Screen()
    {
        $pageWidth = 297;
        $pageHeight = 210;
        $margin = 7;
        $gutter = 2;
        $header = 10;

        $numberDayInWeek = count($this->app);
        $numberDays = 2;
        $width = $pageWidth - 2 * $margin;
        $height = $pageHeight - 2 * $margin;
        $numberColumns = $numberDayInWeek*$numberDays;
        $columnWidth = ($width - ($numberColumns-1) * $gutter) / $numberColumns;
        $columnHeight = $height - $header;
        $rowMargin = 1;
        $numberRows = 31;
        $rowHeight = ($columnHeight - 1 * $rowMargin) / $numberRows;
        $rowPadding = 0.5;
        $rowWidthNumber = 5;
        $textNumberHeight = 3;
        $textTitleHeight = 16;
        $textTitleColumnHeight = 11;
        $textRowHeight = 10;

        $text = "Appuntamenti Rollandin";
        $textWidth = strlen($text) * 1;
        
        echo $text.BR;

        $giorni = array();
        for($c = 0; $c < $numberDays; $c++) {
            foreach(array_keys($this->app) as $g) {
                $giorni[] = $g;
            }
        }

        for ($c = 0; $c < $numberColumns; $c++) {
            echo $giorni[$c].BR;

            
        }
    }
}