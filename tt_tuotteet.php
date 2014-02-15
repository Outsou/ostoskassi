<?php

require_once 'libs/common.php';
require_once 'libs/tietokantayhteys.php';
require_once 'libs/models/tuote.php';

if (!onKirjautunutTyontekija()) {
    header('Location: tt_kirjautuminen.php');
}

$kysely = getTietokantayhteys()->prepare("SELECT * FROM tuotteet ORDER BY nimi;");
$kysely->execute();

$tulokset = array();
foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
    $tuote = new Tuote($tulos->tuotenumero, $tulos->nimi, $tulos->kuvaus, $tulos->hinta, $tulos->kategoria);
    $tulokset[] = $tuote;
}

if (count($tulokset) > 0) {
    /* Tuotteita on olemassa vähintään yksi */
    naytaNakyma('views/tt_tuoteLista.php', array(
        'asiakas' => false,
        'tuotteet' => $tulokset,
        'sivuID' => 1
    ));
} else {
    /* Ei yhtään tuotetta, heitetään virheilmoitus */
    naytaNakyma("views/tt_tuoteLista.php", array(
        'virhe' => "Ei löytynyt yhtään tuotetta!",
        'asiakas' => false,
        'sivuID' => 1
    ));
}
    