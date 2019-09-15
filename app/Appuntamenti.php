<?php
namespace App;

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