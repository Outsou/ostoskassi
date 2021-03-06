<?php

require_once 'libs/common.php';
require_once 'libs/models/kategoria.php';
require_once 'libs/models/tuote.php';

if (!onKirjautunutTyontekija()) {
    header('Location: tt_kirjautuminen.php');
    exit();
}

$kategoriat = Kategoria::getKategoriat();

if (empty($_POST["nimi"]) || (empty($_POST["hinta"]) && $_POST["hinta"] != 0) || empty($_POST["kuvaus"])) {
    naytaNakyma('views/muokkaus.php', array(
        'asiakas' => false,
        'kategoriat' => $kategoriat
    ));
}

$uusituote = new Tuote();
$uusituote->setNimi($_POST["nimi"]);
$uusituote->setHinta($_POST["hinta"]);
$uusituote->setKuvaus($_POST["kuvaus"]);
$uusituote->setKategoria($_POST["kategoria"]);

if (!empty($_FILES["file"]['name'])) {
    $uusituote->setKuva($_FILES["file"]);
}

if ($uusituote->onkoKelvollinen()) {
    $ok = $uusituote->lisaaKantaan();
    if ($ok) {
        $_SESSION['ilmoitus'] = "Tuote lisätty onnistuneesti.";
        header('Location: tt_tuotteet.php');
    }
} else {
    $virheet = $uusituote->getVirheet();

    //Virheet voidaan nyt välittää näkymälle syötettyjen tietojen kera
    naytaNakyma("views/muokkaus.php", array(
        'tuote' => $uusituote,
        'virheet' => $virheet,
        'asiakas' => FALSE,
        'kategoriat' => $kategoriat
    ));
}


