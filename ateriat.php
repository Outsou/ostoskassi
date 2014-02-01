<?php

require_once 'libs/common.php';

if (!onKirjautunut())
{
    header('Location: kirjautuminen.php');
}

naytaNakyma('views/ateriaLista.php', array(
    'sivuID' => 3,
    'asiakas' => true
));