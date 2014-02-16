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
    $uusiostos = new Ostos();
    $uusiostos->setMaara($maara);
    $uusiostos->setPaikkavaraus($_POST['varaus']);
    $uusiostos->setTilattu("TRUE");
    $uusiostos->setTuote($id);

    //Virheellinen syöte
    if (!$uusiostos->onkoKelvollinen() || $_POST['varaus'] == '-- valitse lento --') {
        $virheet = $uusiostos->getVirheet();

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
    
    //Ei saa olla samalle paikkavaraukselle useampia tilauksia samasta tuotteesta.
    if ($uusiostos->onkoKannassa()) {
        $_SESSION['ilmoitus'] = "Sinulla on jo tilaus kyseisestä tuotteesta kyseiselle lennolle.";

        naytaNakyma('views/tuotesivu.php', array(
            'asiakas' => true,
            'sivuID' => 0,
            'tuote' => $ostos,
            'maara' => $maara,
            'kategoriat' => $kategoriat,
            'paikkavaraukset' => $paikkavaraukset
        ));
    } else {
        $uusiostos->setTilattu("FALSE");
        if ($uusiostos->onkoKannassa()) {
            $uusiMaara = $maara + Ostos::getOstos($_POST['varaus'], $id, "FALSE")->getMaara();
            $uusiostos->setMaara($uusiMaara);
            $uusiostos->paivita();
            $_SESSION['ilmoitus'] = "Ostos päivitetty";
        } else {
            $uusiostos->lisaaKantaan();
            $_SESSION['ilmoitus'] = "Ostos lisätty.";
        }
    }

    header('Location: etusivu.php');
} else {
    //Näkymä ensimmäisellä avauskerralla
    naytaNakyma('views/tuotesivu.php', array(
        'asiakas' => true,
        'sivuID' => 0,
        'tuote' => $ostos,
        'maara' => $maara,
        'kategoriat' => $kategoriat,
        'paikkavaraukset' => $paikkavaraukset
    ));
}