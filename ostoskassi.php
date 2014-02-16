<?php

require_once 'libs/common.php';
require_once './libs/models/paikkavaraus.php';
require_once './libs/models/ostos.php';
require_once './libs/models/tuote.php';
require_once './libs/ostosJaTuote.php';

if (!onKirjautunut()) {
    header('Location: kirjautuminen.php');
}

if ($_POST['poista'] == 1) {
    $poistettava = new Ostos();
    $poistettava->setPaikkavaraus($_POST['varaus']);
    $poistettava->setTilattu("FALSE");
    $poistettava->setTuote($_POST['tuote']);
    
    $poistettava->poistaOstos();
}

$ostokset = array();
$paikkavaraukset = Paikkavaraus::getVaraukset($_SESSION['kirjautunut']);

foreach ($paikkavaraukset as $varaus) {
    $tulokset = Ostos::getOstoksetVarausnumerolla($varaus->getVarausnumero());
    foreach ($tulokset as $ostos) {
        if ($ostos->getTilattu() != 1) {
            $ostokset[] = new Ostostuote($ostos, Tuote::getTuote($ostos->getTuote()));
        }
    }
}

if (empty($ostokset)) {
    $_SESSION['ilmoitus'] = "Ei ostoksia";

    naytaNakyma('views/ostosLista.php', array(
        'sivuID' => 2,
        'asiakas' => true
    ));
} else { 
    naytaNakyma('views/ostosLista.php', array(
        'sivuID' => 2,
        'asiakas' => true,
        'ostokset' => $ostokset
    ));
}