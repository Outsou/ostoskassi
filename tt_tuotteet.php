<?php

require_once 'libs/common.php';
require_once 'libs/tietokantayhteys.php';
require_once 'libs/models/tuote.php';

if (!onKirjautunutTyontekija()) {
    header('Location: tt_kirjautuminen.php');
    exit();
}

$kysely = getTietokantayhteys()->prepare("SELECT * FROM tuotteet ORDER BY nimi;");
$kysely->execute();

$tuotteet = array();
foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
    $ostos = new Tuote($tulos->tuotenumero, $tulos->nimi, $tulos->kuvaus, $tulos->hinta, $tulos->kategoria);
    $tuotteet[] = $ostos;
}

if (count($tuotteet) > 0) {
    /* Tuotteita on olemassa vähintään yksi */
    naytaNakyma('views/tt_tuoteLista.php', array(
        'asiakas' => false,
        'tuotteet' => $tuotteet,
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
    