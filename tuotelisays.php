<?php

require_once 'libs/common.php';
require_once 'libs/models/kategoria.php';
require_once 'libs/models/tuote.php';

if (!onKirjautunutTyontekija()) {
    header('Location: kirjautuminen_tt.php');
}

$kategoriat = Kategoria::getKategoriat();

if (empty($_POST["nimi"]) || (empty($_POST["hinta"]) && $_POST["hinta"] != 0) || empty($_POST["kuvaus"])) {
    naytaNakyma('views/lisays.php', array(
        'asiakas' => false,
        'kategoriat' => $kategoriat
    ));
}

$uusituote = new Tuote();
$uusituote->setNimi($_POST["nimi"]);
$uusituote->setHinta($_POST["hinta"]);
$uusituote->setKuvaus($_POST["kuvaus"]);
$uusituote->setKategoria($_POST["kategoria"]);

/*
if (!empty($_FILES['file'])) {
    $uploaddir = 'upload/';
    $uploadfile = $uploaddir . basename($_FILES['file']['name']);
    $name = $_POST['name'];

    if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
        $uusituote->setKuva($uploadfile);
    } else {
        $virhe = "Kuvan lataaminen epäonnistui!";
    }
}

echo $uploadfile;

require_once 'libs/tietokantayhteys.php';
$data = bin2hex(file_get_contents($_GET['file']));
$query = "insert into tuotteet (nimi, kuva) values ('kuvatesti', ?)";
$kysely = getTietokantayhteys()->prepare($query);
$kysely->execute(array($data));

if ($virhe != NULL) {
    naytaNakyma("views/lisays.php", array(
        'tuote' => $uusituote,
        'virhe' => $virhe,
        'asiakas' => FALSE,
        'kategoriat' => $kategoriat
    ));
}
 */

if ($uusituote->onkoKelvollinen()) {
    $ok = $uusituote->lisaaKantaan();
    if ($ok) {
        $_SESSION['ilmoitus'] = "Tuote lisätty onnistuneesti.";
        header('Location: tt_tuotteet.php');
    }
} else {
    $virheet = $uusituote->getVirheet();

    //Virheet voidaan nyt välittää näkymälle syötettyjen tietojen kera
    naytaNakyma("views/lisays.php", array(
        'tuote' => $uusituote,
        'virheet' => $virheet,
        'asiakas' => FALSE,
        'kategoriat' => $kategoriat
    ));
}


