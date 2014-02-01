<?php

require_once 'libs/common.php';

if (!onKirjautunut())
{
    header('Location: kirjautuminen.php');
}

naytaNakyma('views/ostosLista.php', array(
    'sivuID' => 2,
    'asiakas' => true
));
