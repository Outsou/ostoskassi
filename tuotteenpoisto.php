<?php
require_once './libs/common.php';
require_once './libs/models/tuote.php';

if (!onKirjautunutTyontekija()) {
    header('Location: kirjautuminen_tt.php');
}

$id = (int) $_GET['id'];

$ok = Tuote::poistaTuote($id);

if ($ok) {
    $_SESSION['ilmoitus'] = "Tuote poistettu onnistuneesti.";
    header('Location: tt_tuotteet.php');
}
else {
    $_SESSION['ilmoitus'] = "Tuotteen poisto ei onnistunut.";
    header('Location: tt_tuotteet.php');
}