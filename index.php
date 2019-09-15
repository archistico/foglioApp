<?php
require 'vendor/autoload.php';

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

$pdf = new App\Pdf($app->appuntamenti);
$pdf->Screen();
//$pdf->ViewPdf();

/*

        $settimana = new \App\Settimana($params['data']);
        $listaGiorni = new \App\ListaGiorni();
        //$listaGiorni->Add(new \App\Giorno($settimana->lunedi->format('d/m/Y'), 'Lunedì'));
        $listaGiorni->Add(new \App\Giorno($settimana->martedi->format('d/m/Y'), 'Martedì'));
        $listaGiorni->Add(new \App\Giorno($settimana->mercoledi->format('d/m/Y'), 'Mercoledì'));
        $listaGiorni->Add(new \App\Giorno($settimana->giovedi->format('d/m/Y'), 'Giovedì'));
        //$listaGiorni->Add(new \App\Giorno($settimana->venerdi->format('d/m/Y'), 'Venerdì'));
        $listaOrari = new \App\ListaOrari();
        $listaOrari->Add(new \App\Orario('Lunedì', '8:00', '', false));
        $listaOrari->Add(new \App\Orario('Lunedì', '8:15', '', false));
        $listaOrari->Add(new \App\Orario('Lunedì', '8:30', '', false));
        $listaOrari->Add(new \App\Orario('Lunedì', '8:45', '', false));
        $listaOrari->Add(new \App\Orario('Lunedì', '9:00', '', false));
        $listaOrari->Add(new \App\Orario('Lunedì', '9:15', '', false));
        $listaOrari->Add(new \App\Orario('Lunedì', '9:30', '', false));
        $listaOrari->Add(new \App\Orario('Mercoledì', '11:30', 'Chatillon', true));
        $listaOrari->Add(new \App\Orario('Mercoledì', '11:45', 'Chatillon', true));
        $listaOrari->Add(new \App\Orario('Mercoledì', '12:00', 'Chatillon', true));
        
        // Data Orario Persona Nota Fatto Assente Annullato
        $listaAppuntamenti = new \App\ListaAppuntamenti();
        $db = new \DB\SQL('sqlite:db/database.sqlite');
        $sql = "SELECT * FROM appuntamenti WHERE annullato = 0 AND fatto = 0 AND assente = 0";
        $appuntamentiDB = $db->exec($sql);
        foreach ($appuntamentiDB as $appuntamentoDB) {
            $str = jdtojulian($appuntamentoDB['data']);
            $dmy = \DateTime::createFromFormat('m/d/Y', $str)->format('d/m/Y');
            $listaAppuntamenti->Add(new \App\Appuntamento($dmy, $appuntamentoDB['ora'], $appuntamentoDB['persona'], $appuntamentoDB['note'], $appuntamentoDB['annullato'], $appuntamentoDB['assente'], $appuntamentoDB['fatto'], $appuntamentoDB['inizio']));
        }
        $tabella = new Tabella($listaGiorni, $listaOrari, $listaAppuntamenti);
        $f3->set('tabella', $tabella->ToArray());
        $f3->set('lunedi', $settimana->lunedi->format('d-m-Y'));
        $f3->set('domenica', $settimana->domenica->format('d-m-Y'));
        $f3->set('lunediPrecedente', $settimana->lunediPrecedente->format('d-m-Y'));
        $f3->set('lunediSuccessivo', $settimana->lunediSuccessivo->format('d-m-Y'));
        $f3->set('titolo', 'Appuntamenti');
        $f3->set('script', 'appuntamenti.js');
        $f3->set('contenuto', 'appuntamenti.htm');
        echo \Template::instance()->render('templates/base.htm');
*/