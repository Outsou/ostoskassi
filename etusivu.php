<?php

require_once 'libs/common.php';
require_once 'libs/tietokantayhteys.php';
require_once 'libs/models/tuote.php';
require_once 'libs/models/kategoria.php';

session_start();
if (isset($_SESSION['kirjautunut'])) {
    $asiakasnumero = $_SESSION['kirjautunut'];
}

$kysely = getTietokantayhteys()->prepare("SELECT * FROM tuotteet ORDER BY nimi;");
$kysely->execute();

$tulokset = array();
foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
    $tuote = new Tuote($tulos->tuotenumero, $tulos->nimi, $tulos->kuvaus, $tulos->hinta, $tulos->kategoria);
    $tulokset[] = $tuote;
}

$kategoriat = Kategoria::getKategoriat();

if (count($tulokset) > 0) {
    /* Tuotteita on olemassa vähintään yksi */
    naytaNakyma('views/tuoteLista.php', array(
        'asiakas' => true,
        'tuotteet' => $tulokset,
        'sivuID' => 1,
        'asiakasnumero' => $asiakasnumero,
        'kategoriat' => $kategoriat,
        'kategoria' => $_GET['kategoria']
    ));
} else {
    /* Ei yhtään tuotetta, heitetään virheilmoitus */
    naytaNakyma("views/tuoteLista.php", array(
        'virhe' => "Ei löytynyt yhtään tuotetta!",
        'asiakas' => true,
        'sivuID' => 1,
        'asiakasnumero' => $asiakasnumero,
        'kategoriat' => $kategoriat
    ));
}