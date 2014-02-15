<?php

require_once 'libs/common.php';
require_once 'libs/tietokantayhteys.php';
require_once 'libs/models/tuote.php';
require_once 'libs/models/kategoria.php';

$id = (int) $_GET['id'];
$kategoriat = Kategoria::getKategoriat();

naytaNakyma('views/tuotesivu.php', array(
    'asiakas' => true,
    'tuotteet' => $tulokset,
    'sivuID' => 1,
    'asiakasnumero' => $asiakasnumero,
    'kategoriat' => $kategoriat
));
