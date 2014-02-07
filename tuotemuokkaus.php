<?php

require_once 'libs/common.php';
require_once 'libs/tietokantayhteys.php';
require_once 'libs/models/tuote.php';
require_once 'libs/models/kategoria.php';

if (!onKirjautunutTyontekija()) {
    header('Location: kirjautuminen_tt.php');
}

$id = (int) $_GET['id'];
$kategoriat = Kategoria::getKategoriat();
$tuote = Tuote::getTuote($id);

if ($tuote != NULL) {
    naytaNakyma('views/muokkaus.php', array(
        'asiakas' => false,
        'tuote' => $tuote,
        'kategoriat' => $kategoriat
    ));
} else {
        naytaNakyma('views/muokkaus.php', array(
        'asiakas' => false,
        'virhe' => "Tuotetta ei löytynyt!"
    ));
}