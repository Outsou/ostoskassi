<?php

require_once 'libs/common.php';
require_once './libs/models/paikkavaraus.php';
require_once './libs/models/ostos.php';
require_once './libs/models/tuote.php';
require_once './libs/ostosJaTuote.php';
require_once './libs/models/kategoria.php';

if (!onKirjautunut()) {
    header('Location: kirjautuminen.php');
}

//Ostoksen poisto
if ($_POST['poista'] == 1) {
    $poistettava = new Ostos();
    $poistettava->setPaikkavaraus($_POST['varaus']);
    $poistettava->setTilattu("FALSE");
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
        if ($ostos->getTilattu() != 1) {
            $ostokset[] = new Ostostuote($ostos, Tuote::getTuote($ostos->getTuote()));
        }
    }
}

//Tilaa-nappia painettu
if ($_POST['tilaus'] == 1) {
    foreach ($ostokset as $paivitettavaostos) {
        $ostos = new Ostos();
        $ostos->setMaara($paivitettavaostos->getOstos()->getMaara());
        $ostos->setPaikkavaraus($paivitettavaostos->getOstos()->getPaikkavaraus());
        $ostos->setTuote($paivitettavaostos->getOstos()->getTuote());
        $ostos->setTilattu("FALSE");
        $ostos->poistaOstos();

        $ostos->setTilattu("TRUE");
        $ostos->lisaaKantaan();
    }
    $_SESSION['ilmoitus'] = "Tilaus suoritettu.";
    header('Location: etusivu.php');
    exit();
}

if (empty($ostokset)) {
    $_SESSION['ilmoitus'] = "Ei ostoksia";

    naytaNakyma('views/ostosLista.php', array(
        'sivuID' => 2,
        'asiakas' => true,
        'kategoriat' => $kategoriat
    ));
} else {
    naytaNakyma('views/ostosLista.php', array(
        'sivuID' => 2,
        'asiakas' => true,
        'ostokset' => $ostokset,
        'kategoriat' => $kategoriat
    ));
}