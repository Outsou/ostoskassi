<?php

class Kayttaja {

    private $asiakasnumero;
    private $nimi;
    private $osoite;
    private $sahkoposti;
    private $kayttajanimi;
    private $salasana;

    public function __construct($asiakasnumero, $nimi, $osoite, $sahkoposti, $kayttajanimi, $salasana) {
        $this->asiakasnumero = $asiakasnumero;
        $this->nimi = $nimi;
        $this->osoite = $osoite;
        $this->sahkoposti = $sahkoposti;
        $this->kayttajanimi = $kayttajanimi;
        $this->salasana = $salasana;
    }

    /* Etsitään kannasta käyttäjätunnuksella ja salasanalla käyttäjäriviä */

    public static function getKayttajaTunnuksilla($kayttaja, $salasana) {
        $sql = "SELECT asiakasnumero, kayttajanimi, salasana from asiakkaat where kayttajanimi = ? AND salasana = ? LIMIT 1";
        require_once 'libs/tietokantayhteys.php';
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($kayttaja, $salasana));

        $tulos = $kysely->fetchObject();
        if ($tulos == null) {
            return null;
        } else {
            $kayttaja = new Kayttaja();
            $kayttaja->asiakasnumero = $tulos->asiakasnumero;
            $kayttaja->kayttajanimi = $tulos->kayttajanimi;
            $kayttaja->salasana = $tulos->salasana;

            return $kayttaja;
        }
    }

    /* Tähän gettereitä ja settereitä */

    public function getNimi() {
        return $this->nimi;
    }

    public function getAsiakasnumero() {
        return $this->asiakasnumero;
    }

}
