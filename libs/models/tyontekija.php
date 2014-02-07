<?php

class Tyontekija {

    private $tunnusnumero;
    private $nimi;
    private $kayttajanimi;
    private $salasana;

    public function __construct($tunnusnumero, $nimi, $kayttajanimi, $salasana) {
        $this->tunnusnumero = $tunnusnumero;
        $this->nimi = $nimi;
        $this->kayttajanimi = $kayttajanimi;
        $this->salasana = $salasana;
    }

    /* Etsitään kannasta käyttäjätunnuksella ja salasanalla käyttäjäriviä */

    public static function getTyontekijaTunnuksilla($tyontekija, $salasana) {
        $sql = "SELECT tunnusnumero, kayttajanimi, salasana from tyontekijat where kayttajanimi = ? AND salasana = ? LIMIT 1";
        require_once 'libs/tietokantayhteys.php';
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($tyontekija, $salasana));

        $tulos = $kysely->fetchObject();
        if ($tulos == null) {
            return null;
        } else {
            $tyontekija = new Tyontekija();
            $tyontekija->tunnusnumero = $tulos->tunnusnumero;
            $tyontekija->kayttajanimi = $tulos->kayttajanimi;
            $tyontekija->salasana = $tulos->salasana;

            return $tyontekija;
        }
    }

    /* Tähän gettereitä ja settereitä */

    public function getNimi() {
        return $this->nimi;
    }

    public function getTunnusnumero() {
        return $this->tunnusnumero;
    }

}
