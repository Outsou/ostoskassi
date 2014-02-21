<?php

class Ostostuote {

    private $ostos;
    private $tuote;
    private $paikkavaraus;

    public function __construct($ostos, $tuote, $paikkavaraus) {
        $this->ostos = $ostos;
        $this->tuote = $tuote;
        $this->paikkavaraus = $paikkavaraus;
    }

    public function getOstos() {
        return $this->ostos;
    }

    public function getTuote() {
        return $this->tuote;
    }

    public function getPaikkavaraus() {
        return $this->paikkavaraus;
    }

}
