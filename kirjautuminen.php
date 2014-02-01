<?php

require_once 'libs/common.php';

if (empty($_POST["kayttajanimi"]) || empty($_POST["salasana"])) {
    /* Käytetään omassa kirjastotiedostossa määriteltyä näkymännäyttöfunktioita */
    naytaNakyma("views/kirjautumislomake.php");
}

$kayttaja = $_POST["kayttajanimi"];
$salasana = $_POST["salasana"];

/* Tarkistetaan onko parametrina saatu oikeat tunnukset */
if ("otto" == $kayttaja && "1234" == $salasana) {
    /* Jos tunnus on oikea, ohjataan käyttäjä sopivalla HTTP-otsakkeella kissalistaan. */
    header('Location: etusivu.php');
} else {
    /* Väärän tunnuksen syöttänyt saa eteensä kirjautumislomakkeen. */
    naytaNakyma("views/kirjautumislomake.php", array(
    /* Välitetään näkymälle tieto siitä, kuka yritti kirjautumista */
    'kayttaja' => $kayttaja,
    'virhe' => "Kirjautuminen epäonnistui! Antamasi tunnus tai salasana on väärä."
  ));
}