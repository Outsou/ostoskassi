<?php

require_once 'libs/common.php';

if (!onKirjautunutTyontekija())
{
    header('Location: kirjautuminen_tt.php');
}

naytaNakyma('views/tuoteLista_tt.php', array(
    'asiakas' => false,
    'sivuID' => 1
));
