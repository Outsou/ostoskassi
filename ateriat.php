<?php

require_once 'libs/common.php';
require_once './libs/models/paikkavaraus.php';
require_once './libs/models/kategoria.php';
require_once './libs/models/../models/ateria.php';

if (!onKirjautunut()) {
    header('Location: kirjautuminen.php');
}

$paikkavaraukset = Paikkavaraus::getVaraukset(1);
$kategoriat = Kategoria::getKategoriat();

if (!empty($_POST['tallenna'])) {
    $uusiateriapyynto = new Ateria();
    $uusiateriapyynto->setVegaani($_POST['vegaani']);
    $uusiateriapyynto->setKasvis($_POST['kasvis']);
    $uusiateriapyynto->setMuu($_POST['muu']);
    $uusiateriapyynto->setPaikkavaraus($_POST['tallenna']);

    $uusiateriapyynto->paivita();

    $ateriatiedot = Ateria::getAteriatiedot($_POST['tallenna']);

    $_SESSION['ilmoitus'] = "Tiedot päivitetty.";
    
    naytaNakyma('views/ateriaLista.php', array(
        'sivuID' => 3,
        'asiakas' => true,
        'kategoriat' => $kategoriat,
        'varaus' => $_POST['tallenna'],
        'paikkavaraukset' => $paikkavaraukset,
        'ateriatiedot' => $ateriatiedot
    ));
}
if (!empty($_POST['varaus'])) {

    $ateriatiedot = Ateria::getAteriatiedot($_POST['varaus']);

    naytaNakyma('views/ateriaLista.php', array(
        'sivuID' => 3,
        'asiakas' => true,
        'kategoriat' => $kategoriat,
        'varaus' => $_POST['varaus'],
        'paikkavaraukset' => $paikkavaraukset,
        'ateriatiedot' => $ateriatiedot
    ));
} else {
    if (empty($paikkavaraukset)) {
        naytaNakyma('views/ateriaLista.php', array(
            'sivuID' => 3,
            'asiakas' => true,
            'virhe' => "Ei varattuja lentoja.",
            'kategoriat' => $kategoriat
        ));
    } else {
        naytaNakyma('views/ateriaLista.php', array(
            'sivuID' => 3,
            'asiakas' => true,
            'kategoriat' => $kategoriat,
            'paikkavaraukset' => $paikkavaraukset
        ));
    }
}