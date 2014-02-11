<?php

class Tuote {

    private $tuotenumero;
    private $nimi;
    private $kuvaus;
    private $hinta;
    private $kategoria;
    private $kuva;
    private $virheet = array();

    public function __construct($tuotenumero, $nimi, $kuvaus, $hinta, $kategoria) {
        $this->tuotenumero = $tuotenumero;
        $this->nimi = $nimi;
        $this->kuvaus = $kuvaus;
        $this->hinta = $hinta;
        $this->kategoria = $kategoria;
    }

    public static function getTuote($id) {
        $sql = "SELECT tuotenumero, nimi, kuvaus, hinta, kategoria, kuva from tuotteet where tuotenumero = ? LIMIT 1";
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
            $tuote->kuva = $tulos->kuva;

            return $tuote;
        }
    }

    public function getVirheet() {
        return $this->virheet;
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

    public function getKuva() {
        return $this->kuva;
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

    public function setTuotenumero($uusituotenumero) {
        $this->tuotenumero = $uusituotenumero;
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

    public function setKuva($uusikuva) {
        $this->kuva = $uusikuva;
        $allowedExts = array("png");
        $temp = explode(".", $uusikuva["name"]);
        $extension = end($temp);
        if ((($uusikuva["type"] == "image/png")) && ($uusikuva["size"] < 20000) && in_array($extension, $allowedExts)) {
            if ($uusikuva["error"] > 0) {
                $this->virheet['kuva'] = $uusikuva["error"];
            }
        } else {
            $this->virheet['kuva'] = "Väärä tiedostotyyppi kuvalle!";
        }
    }

    public function onkoKelvollinen() {
        return empty($this->virheet);
    }

    public function lisaaKantaan() {
        $sql = "INSERT INTO tuotteet (nimi, kuvaus, hinta, kategoria) VALUES (?,?,?,?) RETURNING tuotenumero";
        require_once 'libs/tietokantayhteys.php';
        $kysely = getTietokantayhteys()->prepare($sql);
        $ok = $kysely->execute(array($this->getNimi(), $this->getKuvaus(), $this->getHinta(), $this->getKategoria()));

        if ($ok) {
            $this->tuotenumero = $kysely->fetchColumn();
            $this->paivitaKuva();
        }
        return $ok;
    }

    public function poistaTuote() {
        $sql = "DELETE FROM tuotteet where tuotenumero = ?";
        require_once 'libs/tietokantayhteys.php';
        $kysely = getTietokantayhteys()->prepare($sql);
        $ok = $kysely->execute(array($this->tuotenumero));
        return $ok;
    }

    public function paivita() {
        $sql = "UPDATE tuotteet SET nimi = ?, hinta = ?, kuvaus = ?, kategoria = ? WHERE tuotenumero = $this->tuotenumero";
        require_once 'libs/tietokantayhteys.php';
        $kysely = getTietokantayhteys()->prepare($sql);
        $ok = $kysely->execute(array($this->nimi, $this->hinta, $this->kuvaus, $this->kategoria));
        return $ok;
    }

    public function paivitaKuva() {
        if (!empty($this->kuva)) {
            $temp = explode(".", $this->kuva["name"]);
            $extension = end($temp);
            $polku = "upload/" . $this->tuotenumero . "." . $extension;
            
            if (!move_uploaded_file($this->kuva["tmp_name"], $polku)) {
                $this->virheet['kuva'] = "Uploadaus epäonnistui!";
            } else {
                chmod($polku, 0644);
                $sql = "UPDATE tuotteet SET kuva = ? WHERE tuotenumero = $this->tuotenumero";
                require_once 'libs/tietokantayhteys.php';
                $kysely = getTietokantayhteys()->prepare($sql);
                $ok = $kysely->execute(array($polku));
                return $ok;
            }
        }
        return false;
    }

}
