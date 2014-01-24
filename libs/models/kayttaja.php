<?php

class Kayttaja {

    private $asiakasnumero;
    private $nimi;
    private $osoite;
    private $puhelinnumero;

    public function __construct($asiakasnumero, $nimi, $osoite, $puhelinnumero) {
        $this->asiakasnumero = $asiakasnumero;
        $this->nimi = $nimi;
        $this->osoite = $osoite;
        $this->puhelinnumero = $puhelinnumero;
    }

    public function getName() {
        return $this->nimi;
    }

    public function getAsiakasnumero() {
        return $this->asiakasnumero;
    }

    /* Tähän gettereitä ja settereitä */
}
