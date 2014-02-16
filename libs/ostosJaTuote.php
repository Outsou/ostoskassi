<?php

class Ostostuote {
    private $ostos;
    private $tuote;
    
    public function __construct($ostos, $tuote) {
        $this->ostos = $ostos;
        $this->tuote = $tuote;
    }
    
    public function getOstos() {
        return $this->ostos;
    }
    
    public function getTuote() {
        return $this->tuote;
    }
}