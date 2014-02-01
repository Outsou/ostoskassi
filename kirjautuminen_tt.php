<?php

require_once 'libs/common.php';
require_once 'libs/models/tyontekija.php';

if (empty($_POST["kayttajanimi"]) || empty($_POST["salasana"])) {
    /* Käytetään omassa kirjastotiedostossa määriteltyä näkymännäyttöfunktioita */
    naytaNakyma("views/kirjautumislomake.php", array(
            'asiakas' => false
            ));
}

$kayttaja = $_POST["kayttajanimi"];
$salasana = $_POST["salasana"];

session_start();
/* Tarkistetaan onko parametrina saatu oikeat tunnukset */
$kirjautuja = Tyontekija::getTyontekijaTunnuksilla($kayttaja, $salasana);
if ($kirjautuja != null) {
    /* Jos tunnus on oikea, ohjataan käyttäjä sopivalla HTTP-otsakkeella kissalistaan. */
    $_SESSION['kirjautunut_tt'] = $kirjautuja->getTunnusnumero();
    header('Location: tt_tuotteet.php');
} else {
    /* Väärän tunnuksen syöttänyt saa eteensä kirjautumislomakkeen. */
    naytaNakyma("views/kirjautumislomake.php", array(
        /* Välitetään näkymälle tieto siitä, kuka yritti kirjautumista */
        'kayttaja' => $kayttaja,
        'virhe' => "Kirjautuminen epäonnistui! Antamasi tunnus tai salasana on väärä.",
        'asiakas' => false
    ));
}