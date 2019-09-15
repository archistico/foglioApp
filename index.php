<?php
require 'vendor/autoload.php';

class Giorno
{
    private $giorno;
    private $mese;
    private $anno;

    private $giorno_settimana;
    private $giorno_settimana_numerico;
    private $mese_nome;

    public function __construct(DateTime $data)
    {
        $this->giorno = $data->format("d");
        $this->mese = $data->format("m");
        $this->anno = $data->format("Y");
        $this->giorno_settimana_numerico = $data->format("w");

        switch ($this->giorno_settimana_numerico) {
            case 0:$this->giorno_settimana = "Do";
                break;
            case 1:$this->giorno_settimana = "Lu";
                break;
            case 2:$this->giorno_settimana = "Ma";
                break;
            case 3:$this->giorno_settimana = "Me";
                break;
            case 4:$this->giorno_settimana = "Gi";
                break;
            case 5:$this->giorno_settimana = "Ve";
                break;
            case 6:$this->giorno_settimana = "Sa";
                break;
        }
    }

    private function getEasterDate($year = false)
    {
        if ($year === false) {
            $year = date("Y");
        }
        $easterDays = easter_days($year);
        $march21 = date($year . '-03-21');
        return DateTime::createFromFormat('d-m-Y', date('d-m-Y', strtotime("$march21 + $easterDays days")));
    }

    public function isHoliday()
    {
        if ($this->giorno_settimana == "Do" || $this->giorno_settimana == "Sa") {
            return true;
        }

        $pasqua = $this->getEasterDate($this->anno);

        if ($this->giorno == $pasqua->format('d') && $this->mese == $pasqua->format('m')) {
            return true;
        }

        $pasquetta = $pasqua->add(new DateInterval('P1D'));

        if ($this->giorno == $pasquetta->format('d') && $this->mese == $pasquetta->format('m')) {
            return true;
        }

        if ($this->giorno == "01" && $this->mese == "01") {
            return true;
        }

        if ($this->giorno == "06" && $this->mese == "01") {
            return true;
        }

        if ($this->giorno == "25" && $this->mese == "04") {
            return true;
        }

        if ($this->giorno == "01" && $this->mese == "05") {
            return true;
        }

        if ($this->giorno == "02" && $this->mese == "06") {
            return true;
        }

        if ($this->giorno == "15" && $this->mese == "08") {
            return true;
        }

        if ($this->giorno == "01" && $this->mese == "11") {
            return true;
        }

        if ($this->giorno == "08" && $this->mese == "12") {
            return true;
        }

        if ($this->giorno == "25" && $this->mese == "12") {
            return true;
        }

        if ($this->giorno == "26" && $this->mese == "12") {
            return true;
        }

        return false;
    }

    public function getDay()
    {
        return $this->giorno;
    }

    public function getMonth()
    {
        return $this->mese;
    }

    public static function getMonthName(int $month)
    {
        switch ($month) {
            case 1:return 'Gennaio';
            case 2:return 'Febbraio';
            case 3:return 'Marzo';
            case 4:return 'Aprile';
            case 5:return 'Maggio';
            case 6:return 'Giugno';
            case 7:return 'Luglio';
            case 8:return 'Agosto';
            case 9:return 'Settembre';
            case 10:return 'Ottobre';
            case 11:return 'Novembre';
            case 12:return 'Dicembre';
        }
    }

    public function getYear()
    {
        return $this->anno;
    }

    public function getDayOfWeek()
    {
        return $this->giorno_settimana;
    }
}

class Calendario
{

    private $year;
    private $days;

    public function __construct(int $year)
    {
        $this->year = $year;
        $this->days = array();
        foreach ($this->loadDays() as $d) {
            $this->days[] = new Giorno($d);
        }
    }

    private function loadDays()
    {
        $datesArray = array();

        for ($m = 1; $m <= 12; $m++) {
            $number_days = cal_days_in_month(0, $m, $this->year);
            for ($d = 1; $d <= $number_days; $d++) {
                $datesArray[] = DateTime::createFromFormat("Y-n-j", "{$this->year}-$m-$d");
            }
        }
        return $datesArray;
    }

    public function getDays()
    {
        return $this->days;
    }

    public function getMonth(int $m)
    {
        $days = array();
        foreach ($this->days as $d) {
            if (((int) $d->getMonth()) < 10) {
                $mese = "0" . $d->getMonth();
            } else {
                $mese = $d->getMonth();
            }
            if ($mese == $m) {
                $days[] = $d;
            }
        }
        return $days;
    }
}

class Orari
{

    public $orari;

    public function __construct()
    {
        $this->orari = array();
    }

    public function AddOrario(string $orario): self
    {
        $this->orari[] = $orario;
        return $this;
    }

    public function getOrari(): array
    {
        return $this->orari;
    }
}

class Appuntamento
{
    public $giorno;
    public $ora;
    public $ambulatorio;

    public function __construct($giorno, $ora, $ambulatorio)
    {
        $this->giorno = $giorno;
        $this->ora = $ora;
        $this->ambulatorio = $ambulatorio;
    }

    public function getGiorno()
    {
        return $this->giorno;
    }

    public function setGiorno($giorno)
    {
        $this->giorno = $giorno;

        return $this;
    }

    public function getOra()
    {
        return $this->ora;
    }

    public function setOra($ora)
    {
        $this->ora = $ora;

        return $this;
    }

    public function getAmbulatorio()
    {
        return $this->ambulatorio;
    }

    public function setAmbulatorio($ambulatorio)
    {
        $this->ambulatorio = $ambulatorio;

        return $this;
    }
}

class Appuntamenti
{
    public $orari;
    public $appuntamenti;

    public function __construct($orari)
    {
        $this->orari = $orari;
        $this->appuntamenti = array();
    }

    public function AddAppuntamenti(string $giorno, string $ambulatorio, string $inizio, string $fine): self
    {
        // cerca appuntamenti in cui > inizio e < fine
        $iniziato = false;

        if (array_key_exists($giorno, $this->appuntamenti)) {
            $app = $this->appuntamenti[$giorno];
        } else {
            $app = array();
        }

        foreach ($this->orari->getOrari() as $o) {
            if ($o == $inizio) {
                $iniziato = true;
            }

            if ($o == $fine) {
                $iniziato = false;
            }

            if ($iniziato) {
                $app[] = new Appuntamento($giorno, $o, $ambulatorio);
            }
        }

        $this->appuntamenti[$giorno] = $app;

        return $this;
    }
}

class Pdf
{
    private $app;

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function ViewPdf()
    {
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

        for ($c = 0; $c < $numberColumns; $c++) {
            $xColumn = $margin + $c * ($columnWidth + $gutter);
            $yColumn = $margin + $header;
            $pdf->SetFillColor(196);
            $pdf->Rect($xColumn,$yColumn,$columnWidth,$columnHeight,'F');
            
            $pdf->SetFont('Arial', 'B', $textTitleColumnHeight);
            $pdf->Text($xColumn, $yColumn, "**********");

            
        }

        $pdf->Output();
    }
}

$suddivisione_oraria = ["00", "15", "30", "45"];

$orari = new Orari();
for ($c = 8; $c <= 19; $c++) {
    foreach ($suddivisione_oraria as $s) {
        $orari->AddOrario("{$c}:{$s}");
    }
}

$app = new Appuntamenti($orari);

$app->AddAppuntamenti("Ma", "St-Vincent", "9:00", "13:00")
    ->AddAppuntamenti("Me", "Chatillon", "9:00", "13:00")
    ->AddAppuntamenti("Me", "Pontey", "14:00", "17:00")
    ->AddAppuntamenti("Gi", "St-Vincent", "9:00", "13:00");

$pdf = new Pdf($app->appuntamenti);
$pdf->ViewPdf();
