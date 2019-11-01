<?php
namespace App;

class Settimana
{
    public $orari;
    public $appuntamenti;

    public function __construct($orari)
    {
        $this->orari = $orari;
        $this->appuntamenti = array();
    }

    public function AddGiornata(string $giorno, string $ambulatorio, string $inizio, string $fine, array $vuoti): self
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
                $v = array_key_exists($o, $vuoti)?$vuoti[$o]:"";
                $app[] = new Giornata($giorno, $o, $ambulatorio, $v);
            }
        }

        $this->appuntamenti[$giorno] = $app;

        return $this;
    }
}