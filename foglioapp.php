<?php
require 'vendor/autoload.php';
DEFINE('BR', "<br>");
DEFINE('PRE1', "<pre>");
DEFINE('PRE2', "</pre>");

if (isset($_GET['data'])) {
    $data = DateTime::createFromFormat('Y-m-d', $_GET['data']);
} else {
    $data = new DateTime();
}

if (isset($_GET['dott'])) {
    $dott = strtolower($_GET['dott']);
} else {
    $dott = "rollandin";
}

switch ($dott) {
    case "rollandin":
        $orari = new App\Orari();
        $orari->OrarioByArray(8, 19, ["00", "15", "30", "40", "50"]);
        
        $app = new App\Settimana($orari);
        $app
            ->AddGiornata("Lu", "St-Vincent", "17:00", "19:00", ["17:00" => "---", "18:00" => "---", "18:40" => "---", "18:50" => "---"])
            ->AddGiornata("Ma", "St-Vincent", "9:00", "13:00", ["9:00" => "---", "10:00" => "---", "10:15" => "---", "11:00" => "---", "12:00" => "---", "12:40" => "---", "12:50" => "---"])
            ->AddGiornata("Me", "Chatillon", "9:00", "13:00", ["9:00" => "---", "10:00" => "---", "10:15" => "---", "10:30" => "Lumiere", "11:00" => "---", "12:00" => "---", "12:40" => "---", "12:50" => "Lumiere"])
            ->AddGiornata("Gi", "St-Vincent", "9:00", "13:00", ["9:00" => "---", "10:00" => "---", "10:15" => "---", "11:00" => "---", "12:00" => "---", "12:40" => "---", "12:50" => "---"])
            ->AddGiornata("Ve", "Pontey", "17:00", "19:00", ["17:00" => "---", "18:00" => "---", "18:40" => "---", "18:50" => "---"]);

        $pdf = new App\Pdf($app->appuntamenti, 1, $data, "Dott.ssa Rollandin Christine - 340.84.45.333");
        break;
    case "cavurina":
        $orari = new App\Orari();
        $orari->OrarioByArray(8, 19, ["00", "15", "30", "40", "50"]);
        
        $app = new App\Settimana($orari);
        $app->AddGiornata("Lu", "St-Vincent", "15:30", "19:00", ["17:15" => "---", "18:50" => "---"])
            ->AddGiornata("Ma", "St-Vincent", "15:30", "19:00", ["17:15" => "---", "18:50" => "---"])
            ->AddGiornata("Me", "St-Vincent", "9:30", "12:30", ["10:30" => "---", "12:15" => "---"])
            ->AddGiornata("Gi", "St-Vincent", "10:00", "12:00", ["11:00" => "---", "11:50" => "---"])
            ->AddGiornata("Ve", "St-Vincent", "9:30", "12:30", ["10:30" => "---", "12:15" => "---"]);

        $pdf = new App\Pdf($app->appuntamenti, 1, $data, "Dott.ssa Cavurina Rosanna - 0166.51.23.28 - 338.89.20.536 - 348.16.86.019");
        break;
}

$pdf->ViewPdf();
//$pdf->Screen();
