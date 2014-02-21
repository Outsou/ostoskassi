<?php

require_once 'libs/common.php';
require_once './libs/models/paikkavaraus.php';
require_once './libs/models/ostos.php';
require_once './libs/models/tuote.php';
require_once './libs/ostosJaTuote.php';
require_once './libs/models/kategoria.php';

if (!onKirjautunut()) {
    header('Location: kirjautuminen.php');
    exit();
}

if ($_POST['poista'] == 1) {
    $poistettava = new Ostos();
    $poistettava->setPaikkavaraus($_POST['varaus']);
    $poistettava->setTilattu("TRUE");
    $poistettava->setTuote($_POST['tuote']);

    $poistettava->poistaOstos();
}

$ostokset = array();
$paikkavaraukset = Paikkavaraus::getVaraukset($_SESSION['kirjautunut']);
$kategoriat = Kategoria::getKategoriat();

//Tee lista ostoksista ja tuotteista
foreach ($paikkavaraukset as $varaus) {
    $tulokset = Ostos::getOstoksetVarausnumerolla($varaus->getVarausnumero());
    foreach ($tulokset as $ostos) {
        if ($ostos->getTilattu()) {
            $ostokset[] = new Ostostuote($ostos, Tuote::getTuote($ostos->getTuote()));
        }
    }
}

if (empty($ostokset)) {
    $_SESSION['ilmoitus'] = "Ei ostoksia";

    naytaNakyma('views/ostosLista.php', array(
        'sivuID' => 4,
        'asiakas' => true,
        'kategoriat' => $kategoriat,
        'tilatut' => TRUE
    ));
} else {
    naytaNakyma('views/ostosLista.php', array(
        'sivuID' => 4,
        'asiakas' => true,
        'ostokset' => $ostokset,
        'kategoriat' => $kategoriat,
        'tilatut' => TRUE
    ));
}