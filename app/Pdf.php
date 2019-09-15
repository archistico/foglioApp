<?php
namespace App;

class Pdf
{
    private $app;
    private $numberDays;
    private $data;

    public function __construct($app, $numberDays, $data)
    {
        $this->app = $app;
        $this->numberDays = $numberDays;
        $this->data = $data;
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
        $numberDays = $this->numberDays;
        $width = $pageWidth - 2 * $margin;
        $height = $pageHeight - 2 * $margin;
        $numberColumns = $numberDayInWeek * $numberDays;
        $columnWidth = ($width - ($numberColumns - 1) * $gutter) / $numberColumns;
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

        $t = $this->data;
        $corrispondenza = array();

        for ($c = 0; $c < $numberDays; $c++) {
            if ($c != 0) {
                $t->add(new \DateInterval('P1D'));
            }
            $set = new CalcoloSettimana($t);
            $corrispondenza[] = ["Lu", $set->lunedi];
            $corrispondenza[] = ["Ma", $set->martedi];
            $corrispondenza[] = ["Me", $set->mercoledi];
            $corrispondenza[] = ["Gi", $set->giovedi];
            $corrispondenza[] = ["Ve", $set->venerdi];
            $corrispondenza[] = ["Sa", $set->sabato];
            $corrispondenza[] = ["Do", $set->domenica];
        }

        echo $text . BR;

        $giorni = array();
        for ($c = 0; $c < $numberDays; $c++) {
            foreach (array_keys($this->app) as $g) {
                $giorni[] = $g;
            }
        }

        //echo PRE1.var_dump($this->app).PRE2;
        // echo PRE1 . print_r($this->app) . PRE2;

        for ($c = 0; $c < $numberColumns; $c++) {

            $data_stringa = "";

            for ($i = 0; $i < count($corrispondenza); $i++) {
                if ($giorni[$c] == $corrispondenza[$i][0]) {
                    $data_stringa = $corrispondenza[$i][1]->format('d-m-Y');
                    $corrispondenza[$i][0] = null;
                    $corrispondenza[$i][1] = null;
                    break;
                }
            }

            echo $giorni[$c] . " - " . $data_stringa . BR;

            foreach ($this->app as $k => $v) {
                if($k == $giorni[$c]) {
                    $t_amb_prec = "";
                    foreach($v as $ora) {
                        $t_ora = $ora->getOra();
                        $t_amb = $ora->getAmbulatorio();
                        if($t_amb_prec != $t_amb) {
                            $t_amb_prec = $t_amb;
                            echo $t_amb.BR;    
                        }
                        echo $t_ora.BR;
                    }
                }

            }

            //echo PRE1.print_r($this->app).PRE2;
            echo BR; 
        }
    }
}
