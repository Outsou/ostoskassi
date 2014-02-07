<?php

class Kategoria {

    private $nimi;

    public function __construct($nimi) {
        $this->nimi = $nimi;
    }

    public static function getKategoriat() {
        require_once 'libs/tietokantayhteys.php';
        $kysely = getTietokantayhteys()->prepare("SELECT * FROM tuoteryhmat;");
        $kysely->execute();

        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $kategoria = new Kategoria($tulos->nimi);
            $tulokset[] = $kategoria;
        }
        return $tulokset;
    }

    public static function etsiKategoria($kategoria) {
        $sql = "SELECT nimi from tuoteryhmat where nimi = ? LIMIT 1";
        require_once 'libs/tietokantayhteys.php';
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($kategoria));

        $tulos = $kysely->fetchObject();
        if ($tulos == null) {
            return null;
        } else {
            $etsittyKategoria = new Kategoria($kategoria);
            return $etsittyKategoria;
        }
    }

    public function getNimi() {
        return $this->nimi;
    }

}
