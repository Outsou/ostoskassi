<?php

require_once 'libs/common.php';
require_once 'libs/tietokantayhteys.php';
require_once 'libs/models/tuote.php';
require_once 'libs/models/kategoria.php';

if (!onKirjautunutTyontekija()) {
    header('Location: kirjautuminen_tt.php');
}

$id = (int) $_GET['id'];
$kategoriat = Kategoria::getKategoriat();

if (empty($_POST["nimi"]) || (empty($_POST["hinta"]) && $_POST["hinta"] != 0) || empty($_POST["kuvaus"])) {
    $tuote = Tuote::getTuote($id);

    if ($_POST['poista'] === '1') {
        $ok = $tuote->poistaTuote();
        if ($ok) {
            $_SESSION['ilmoitus'] = "Tuote poistettu onnistuneesti.";
        } else {
            $_SESSION['ilmoitus'] = "Tuotteen poisto epäonnistui.";
        }
        header('Location: tt_tuotteet.php');
    } else {
        if ($tuote != NULL) {
            naytaNakyma('views/muokkaus.php', array(
                'asiakas' => false,
                'tuote' => $tuote,
                'kategoriat' => $kategoriat
            ));
        } else {
            naytaNakyma('views/muokkaus.php', array(
                'asiakas' => false,
                'virhe' => "Tuotetta ei löytynyt!"
            ));
        }
    }
}

$muokattutuote = new Tuote();
$muokattutuote->setTuotenumero($id);
$muokattutuote->setNimi($_POST["nimi"]);
$muokattutuote->setHinta($_POST["hinta"]);
$muokattutuote->setKuvaus($_POST["kuvaus"]);
$muokattutuote->setKategoria($_POST["kategoria"]);

if (!empty($_FILES['file']['name'])) {
    $muokattutuote->setKuva($_FILES['file']);
}

if (!$muokattutuote->onkoKelvollinen()) {
    $virheet = $muokattutuote->getVirheet();

    naytaNakyma('views/muokkaus.php', array(
        'asiakas' => false,
        'tuote' => $muokattutuote,
        'kategoriat' => $kategoriat,
        'virheet' => $virheet
    ));
} else {
    $ok = $muokattutuote->paivita();
    if ($ok) {
        $_SESSION['ilmoitus'] = "Tuote päivitetty onnistuneesti.";
    } else {
        $_SESSION['ilmoitus'] = "Tuotteen päivitys epäonnistui.";
    }
    if (!empty($_FILES['file']['name'])) {
        $ok = $muokattutuote->paivitaKuva();
        if ($ok) {
            $_SESSION['ilmoitus2'] = "Kuva päivitetty onnistuneesti.";
        } else {
            $_SESSION['ilmoitus2'] = "Kuvan päivitys epäonnistui.";
        }
    }
    header('Location: tt_tuotteet.php');
}
