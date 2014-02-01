<?php

//Avataan istunto
session_start();

//Poistetaan istunnosta merkintä kirjautuneesta käyttäjästä -> Kirjaudutaan ulos
unset($_SESSION["kirjautunut_tt"]);

//Yleensä kannattaa ulkos kirjautumisen jälkeen ohjata käyttäjä kirjautumissivulle
header('Location: kirjautuminen_tt.php');
