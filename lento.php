<?php

require_once './libs/common.php';
require_once './libs/models/paikkavaraus.php';
require_once './libs/ostosJaTuote.php';
require_once './libs/models/ostos.php';
require './libs/models/tuote.php';

if (!onKirjautunutTyontekija()) {
    header('Location: tt_kirjautuminen.php');
    exit();
}

if (isset($_GET['lento'])) {
    $lento = $_GET['lento'];
    $varaukset = Paikkavaraus::getVarauksetLennolle($lento);
    $tilaukset = array();

    foreach ($varaukset as $varaus) {
        $ostokset = Ostos::getOstoksetVarausnumerolla($varaus->getVarausnumero());
        foreach ($ostokset as $ostos) {
            if ($ostos->getTilattu()) {
                $tilaukset[] = new Ostostuote($ostos, Tuote::getTuote($ostos->getTuote()), $varaus);
            }
        }
    }

    if (count($tilaukset) > 0) {
        naytaNakyma('views/lentosivu.php', array(
            'asiakas' => false,
            'sivuID' => 2,
            'tilaukset' => $tilaukset,
            'lento' => $lento
        ));
    } else {
        naytaNakyma('views/lentosivu.php', array(
            'asiakas' => false,
            'sivuID' => 2,
            'virhe' => "Lennolle ei löytynyt tilauksia.",
            'lento' => $lento
        ));
    }
} else {
    naytaNakyma('views/lentosivu.php', array(
        'asiakas' => false,
        'sivuID' => 2,
        'virhe' => "Lentoa ei asetettu Get-muuttujassa.",
        'lento' => $lento
    ));
}