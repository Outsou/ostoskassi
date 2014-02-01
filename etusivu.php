<?php

require_once 'libs/common.php';

session_start();
if (isset($_SESSION['kirjautunut'])) {
    $asiakasnumero = $_SESSION['kirjautunut'];
}

naytaNakyma('views/tuoteLista.php', array(
    'sivuID' => 1,
    'asiakasnumero' => $asiakasnumero,
    'asiakas' => true
));
