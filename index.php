<?php
require 'vendor/autoload.php';
DEFINE('BR', "<br>");
DEFINE('PRE1', "<pre>");
DEFINE('PRE2', "</pre>");

if(isset($_GET['data'])) {
    $data = DateTime::createFromFormat('Y-m-d', $_GET['data']);
} else {
    $data = new DateTime;
}

$suddivisione_oraria = ["00", "15", "30", "45"];
$orari = new App\Orari();
for ($c = 8; $c <= 19; $c++) {
    foreach ($suddivisione_oraria as $s) {
        $orari->AddOrario("{$c}:{$s}");
    }
}

$app = new App\Settimana($orari);

$app->AddGiornata("Ma", "St-Vincent", "9:00", "13:00")
    ->AddGiornata("Me", "Chatillon", "9:00", "13:00")
    ->AddGiornata("Me", "Pontey", "14:00", "17:00")
    ->AddGiornata("Gi", "St-Vincent", "9:00", "13:00");

//echo PRE1.var_dump($corrispondenza).PRE2;

$pdf = new App\Pdf($app->appuntamenti, 2, $data);
$pdf->Screen();
//$pdf->ViewPdf();

