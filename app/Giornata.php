<?php
namespace App;

class Giornata
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