<?php
require 'vendor/autoload.php';

$suddivisione_oraria = ["00", "15", "30", "45"];

$orari = new App\Orari();
for ($c = 8; $c <= 19; $c++) {
    foreach ($suddivisione_oraria as $s) {
        $orari->AddOrario("{$c}:{$s}");
    }
}

$app = new App\Appuntamenti($orari);

$app->AddAppuntamenti("Ma", "St-Vincent", "9:00", "13:00")
    ->AddAppuntamenti("Me", "Chatillon", "9:00", "13:00")
    ->AddAppuntamenti("Me", "Pontey", "14:00", "17:00")
    ->AddAppuntamenti("Gi", "St-Vincent", "9:00", "13:00");

$pdf = new App\Pdf($app->appuntamenti);
$pdf->Screen();
//$pdf->ViewPdf();
