<?php

class Tuote {

    private $tuotenumero;
    private $nimi;
    private $kuvaus;
    private $hinta;
    private $kategoria;
    private $virheet = array();

    public function __construct($tuotenumero, $nimi, $kuvaus, $hinta, $kategoria) {
        $this->tuotenumero = $tuotenumero;
        $this->nimi = $nimi;
        $this->kuvaus = $kuvaus;
        $this->hinta = $hinta;
        $this->kategoria = $kategoria;
    }

    public static function getTuote($id) {
        $sql = "SELECT tuotenumero, nimi, kuvaus, hinta, kategoria from tuotteet where tuotenumero = ? LIMIT 1";
        require_once 'libs/tietokantayhteys.php';
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($id));

        $tulos = $kysely->fetchObject();
        if ($tulos == null) {
            return null;
        } else {
            $tuote = new Tuote();
            $tuote->tuotenumero = $tulos->tuotenumero;
            $tuote->nimi = $tulos->nimi;
            $tuote->kuvaus = $tulos->kuvaus;
            $tuote->hinta = $tulos->hinta;
            $tuote->kategoria = $tulos->kategoria;

            return $tuote;
        }
    }

    public function getTuotenumero() {
        return $this->tuotenumero;
    }

    public function getNimi() {
        return $this->nimi;
    }

    public function getHinta() {
        return $this->hinta;
    }

    public function getKuvaus() {
        return $this->kuvaus;
    }

    public function getKategoria() {
        return $this->kategoria;
    }

    public function setNimi($uusinimi) {
        $this->nimi = $uusinimi;

        if (trim($this->nimi) == '') {
            $this->virheet['nimi'] = "Nimi ei saa olla tyhjä.";
        } else {
            unset($this->virheet['nimi']);
        }
    }

    public function setKuvaus($uusikuvaus) {
        $this->kuvaus = $uusikuvaus;
    }

    public function setHinta($uusihinta) {
        $this->hinta = $uusihinta;

        if ($this->hinta <= 0) {
            $this->virheet['hinta'] = "Hinnan pitää olla suurempi kuin 0.";
        } else {
            unset($this->virheet['hinta']);
        }
    }

    public function setKategoria($uusikategoria) {
        $this->kategoria = $uusikategoria;

        if (Kategoria::etsiKategoria($this->kategoria) == NULL) {
            $this->virheet['kategoria'] = "Kategoriaa ei löytynyt tietokannasta";
        } else {
            unset($this->virheet['kategoria']);
        }
    }

    public function onkoKelvollinen() {
        return empty($this->virheet);
    }

    public function lisaaKantaan() {
        $sql = "INSERT INTO tuotteet (nimi, kuvaus, hinta, kategoria) VALUES (?,?,?,?)";
        require_once 'libs/tietokantayhteys.php';
        $kysely = getTietokantayhteys()->prepare($sql);
        $ok = $kysely->execute(array($this->getNimi(), $this->getKuvaus(), $this->getHinta(), $this->getKategoria()));
        if ($ok) {
            $this->tuotenumero = $kysely->fetchColumn();
        }
        return $ok;
    }

}
