<?php

require_once 'libs/common.php';

if (!onKirjautunutTyontekija())
{
    header('Location: tt_kirjautuminen.php');
}

naytaNakyma('views/tt_tuoteLista.php', array(
    'asiakas' => false,
    'sivuID' => 2
));