<?php

require_once 'libs/common.php';
require_once 'libs/models/tuote.php';
require_once './libs/models/kategoria.php';
require_once './libs/models/paikkavaraus.php';
require_once './libs/models/ostos.php';

$id = (int) $_GET['id'];
$ostos = Tuote::getTuote($id);
$kategoriat = Kategoria::getKategoriat();
$paikkavaraukset = Paikkavaraus::getVaraukset($_SESSION['kirjautunut']);


if (isset($_POST['maara'])) {
    $maara = $_POST['maara'];
} else {
    $maara = 1;
}

if (isset($_POST['lisaa'])) {
    $ostos = new Ostos();
    $ostos->setMaara($maara);
    $ostos->setPaikkavaraus($_POST['varaus']);
    $ostos->setTilattu("FALSE");
    $ostos->setTuote($id);

    if (!$ostos->onkoKelvollinen() || $_POST['varaus'] == '-- valitse lento --') {
        $virheet = $ostos->getVirheet();

        if ($_POST['varaus'] == '-- valitse lento --') {
            $virheet[] = "Valitse lento.";
        }

        naytaNakyma('views/tuotesivu.php', array(
            'asiakas' => true,
            'sivuID' => 0,
            'tuote' => $ostos,
            'maara' => $maara,
            'kategoriat' => $kategoriat,
            'paikkavaraukset' => $paikkavaraukset,
            'virheet' => $virheet
        ));
    }
    if ($ostos->onkoKannassa()) {
        $uusiMaara = $maara + Ostos::getOstos($_POST['varaus'], $id, "FALSE")->getMaara();
        $ostos->setMaara($uusiMaara);
        $ostos->paivita();
        $_SESSION['ilmoitus'] = "Ostos päivitetty";
    } else {
        $ostos->lisaaKantaan();
        $_SESSION['ilmoitus'] = "Ostos lisätty.";
    }
    
    header('Location: etusivu.php');
} else {
    naytaNakyma('views/tuotesivu.php', array(
        'asiakas' => true,
        'sivuID' => 0,
        'tuote' => $ostos,
        'maara' => $maara,
        'kategoriat' => $kategoriat,
        'paikkavaraukset' => $paikkavaraukset
    ));
}