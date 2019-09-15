<?php
namespace App;

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