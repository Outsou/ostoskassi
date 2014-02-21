<?php

require_once 'libs/common.php';
require_once './libs/models/paikkavaraus.php';

if (!onKirjautunutTyontekija()) {
    header('Location: tt_kirjautuminen.php');
    exit();
}

$lennot = Paikkavaraus::getLennot();
asort($lennot);

if (count($lennot) > 0) {
    naytaNakyma('views/tt_lentoLista.php', array(
        'asiakas' => false,
        'sivuID' => 2,
        'lennot' => $lennot
    ));
} else {
    naytaNakyma('views/tt_lentoLista.php', array(
        'asiakas' => false,
        'sivuID' => 2,
        'virhe' => "Ei löytynyt yhtään lentoa."
    ));
}
