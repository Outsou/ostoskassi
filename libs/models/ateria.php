<?php

class Ateria {

    private $vegaani;
    private $kasvis;
    private $muu;
    private $paikkavaraus;

    public function __construct($vegaani, $kasvis, $muu, $paikkavaraus) {
        $this->vegaani = $vegaani;
        $this->kasvis = $kasvis;
        $this->muu = $muu;
        $this->paikkavaraus = $paikkavaraus;
    }

    public static function getAteriatiedot($varausnumero) {
        $sql = "SELECT vegaani, kasvis, muu from ateriapyynnot where paikkavaraus = ? LIMIT 1";
        require_once 'libs/tietokantayhteys.php';
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($varausnumero));

        $tulos = $kysely->fetchObject();
        if ($tulos == null) {
            return null;
        } else {
            $ateria = new Ateria();
            $ateria->vegaani = $tulos->vegaani;
            $ateria->kasvis = $tulos->kasvis;
            $ateria->muu = $tulos->muu;
            return $ateria;
        }
    }

    public function paivita() {
        $sql = "UPDATE ateriapyynnot SET vegaani = ?, kasvis = ?, muu = ? WHERE paikkavaraus = $this->paikkavaraus";
        require_once 'libs/tietokantayhteys.php';
        $kysely = getTietokantayhteys()->prepare($sql);
        $ok = $kysely->execute(array($this->vegaani, $this->kasvis, $this->muu));
        return $ok;
    }

    public function getVegaani() {
        return $this->vegaani;
    }

    public function getKasvis() {
        return $this->kasvis;
    }

    public function getMuu() {
        return $this->muu;
    }

    public function setVegaani($vegaani) {
        $this->vegaani = $vegaani;
    }

    public function setKasvis($kasvis) {
        $this->kasvis = $kasvis;
    }

    public function setMuu($muu) {
        $this->muu = $muu;
    }

    public function setPaikkavaraus($varausnumero) {
        $this->paikkavaraus = $varausnumero;
    }

}
