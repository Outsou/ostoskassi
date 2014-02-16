<?php

class Ostos {

    private $maara;
    private $paikkavaraus;
    private $tilattu;
    private $tuote;
    private $virheet = array();

    public function __construct($maara, $paikkavaraus, $tilattu, $tuote) {
        $this->maara = $maara;
        $this->paikkavaraus = $paikkavaraus;
        $this->tilattu = $tilattu;
        $this->tuote = $tuote;
    }

    public static function getOstos($paikkavaraus, $tuote, $tilattu) {
        $sql = "SELECT * from ostokset where paikkavaraus = ? AND tuote = ? AND tilattu = ? LIMIT 1";
        require_once 'libs/tietokantayhteys.php';
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($paikkavaraus, $tuote, $tilattu));

        $tulos = $kysely->fetchObject();
        if ($tulos == null) {
            return null;
        } else {
            $ostos = new Ostos();
            $ostos->maara = $tulos->maara;
            $ostos->paikkavaraus = $tulos->paikkavaraus;
            $ostos->tilattu = $tulos->tilattu;
            $ostos->tuote = $tulos->tuote;

            return $ostos;
        }
    }

    public static function getOstoksetVarausnumerolla($varausnumero) {
        $sql = "SELECT * from ostokset where paikkavaraus = ?";
        require_once 'libs/tietokantayhteys.php';
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($varausnumero));

        $tulokset = array();

        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $ostos = new Ostos($tulos->maara, $tulos->paikkavaraus, $tulos->tilattu, $tulos->tuote);
            $tulokset[] = $ostos;
        }

        return $tulokset;
    }

    public function lisaaKantaan() {
        $sql = "INSERT INTO ostokset (maara, paikkavaraus, tilattu, tuote) VALUES (?,?,?,?)";
        require_once 'libs/tietokantayhteys.php';
        $kysely = getTietokantayhteys()->prepare($sql);
        $ok = $kysely->execute(array($this->maara, $this->paikkavaraus, $this->tilattu, $this->tuote));

        return $ok;
    }

    public function onkoKannassa() {
        $sql = "SELECT * from ostokset where paikkavaraus = ? AND tuote = ? AND tilattu = ? LIMIT 1";
        require_once 'libs/tietokantayhteys.php';
        $kysely = getTietokantayhteys()->prepare($sql);

        $ok = $kysely->execute(array($this->paikkavaraus, $this->tuote, $this->tilattu));
        $tulos = null;

        if ($ok) {
            $tulos = $kysely->fetchObject();
        }

        if ($tulos == null) {
            return false;
        }
        return true;
    }

    public function paivita() {
        $sql = "UPDATE ostokset SET maara = ?, tilattu = ? WHERE  paikkavaraus = ? AND tuote = ? AND tilattu = ?";
        require_once 'libs/tietokantayhteys.php';
        $kysely = getTietokantayhteys()->prepare($sql);
        $ok = $kysely->execute(array($this->maara, $this->tilattu, $this->paikkavaraus, $this->tuote, $this->tilattu));
        return $ok;
    }

    public function poistaOstos() {
        $sql = "DELETE FROM ostokset where paikkavaraus = ? AND tuote = ? AND tilattu = ?";
        require_once 'libs/tietokantayhteys.php';
        $kysely = getTietokantayhteys()->prepare($sql);
        $ok = $kysely->execute(array($this->paikkavaraus, $this->tuote, $this->tilattu));
        return $ok;
    }

    public function onkoKelvollinen() {
        return empty($this->virheet);
    }

    public function setMaara($uusimaara) {
        $this->maara = $uusimaara;

        if ($this->maara <= 0) {
            $this->virheet['maara'] = "Määrän pitää olla suurempi kuin 0.";
        } else {
            unset($this->virheet['maara']);
        }
    }

    public function setPaikkavaraus($uusipaikkavaraus) {
        $this->paikkavaraus = $uusipaikkavaraus;
    }

    public function setTilattu($onkoTilattu) {
        $this->tilattu = $onkoTilattu;
    }

    public function setTuote($uusiTuotenumero) {
        $this->tuote = $uusiTuotenumero;
    }

    public function getMaara() {
        return $this->maara;
    }

    public function getPaikkavaraus() {
        return $this->paikkavaraus;
    }

    public function getTilattu() {
        return $this->tilattu;
    }

    public function getTuote() {
        return $this->tuote;
    }

    public function getVirheet() {
        return $this->virheet;
    }

}
