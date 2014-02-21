<?php

class Paikkavaraus {

    private $varausnumero;
    private $lento;
    private $paikka;
    private $varaaja;

    public function __construct($varausnumero, $lento, $paikka, $varaaja) {
        $this->varausnumero = $varausnumero;
        $this->lento = $lento;
        $this->paikka = $paikka;
        $this->varaaja = $varaaja;
    }

    public static function getVaraukset($asiakasnumero) {
        $sql = "SELECT varausnumero, lento, paikka from paikkavaraukset where varaaja = ?";
        require_once 'libs/tietokantayhteys.php';
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($asiakasnumero));

        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $varaus = new Paikkavaraus($tulos->varausnumero, $tulos->lento, $tulos->paikka, $tulos->varaaja);
            $tulokset[] = $varaus;
        }

        return $tulokset;
    }

    public static function getVarauksetLennolle($lento) {
        $sql = "SELECT varausnumero, varaaja, paikka from paikkavaraukset where lento = ?";
        require_once 'libs/tietokantayhteys.php';
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($lento));

        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $varaus = new Paikkavaraus($tulos->varausnumero, $tulos->lento, $tulos->paikka, $tulos->varaaja);
            $tulokset[] = $varaus;
        }

        return $tulokset;
    }

    public static function getLennot() {
        $sql = "SELECT lento from paikkavaraukset";
        require_once 'libs/tietokantayhteys.php';
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();

        $lennot = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $lennot[] = $tulos->lento;
        }

        $tulos = array_unique($lennot);

        return $tulos;
    }

    public function getVarausnumero() {
        return $this->varausnumero;
    }

    public function getLento() {
        return $this->lento;
    }

    public function getPaikka() {
        return $this->paikka;
    }

}
