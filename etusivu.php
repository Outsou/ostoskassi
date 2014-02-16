<?php

require_once 'libs/common.php';
require_once 'libs/models/tuote.php';
require_once 'libs/models/kategoria.php';

session_start();
if (isset($_SESSION['kirjautunut'])) {
    $asiakasnumero = $_SESSION['kirjautunut'];
}

$tuotteet = Tuote::getKaikkiTuotteet();
$kategoriat = Kategoria::getKategoriat();

if (count($tuotteet) > 0) {
    /* Tuotteita on olemassa vähintään yksi */
    naytaNakyma('views/tuoteLista.php', array(
        'asiakas' => true,
        'tuotteet' => $tuotteet,
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