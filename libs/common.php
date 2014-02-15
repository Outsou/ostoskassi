<?php

session_start();

function naytaNakyma($sivu, $data = array()) {
    $data = (object) $data;
    if ($data-> asiakas != null && $data->asiakas) {
        require 'views/pohja.php';
    }
    else
    {
       require 'views/tt_pohja.php'; 
    }
    exit();
}

function onKirjautunut() {
    session_start();
    return isset($_SESSION['kirjautunut']);
}

function onKirjautunutTyontekija() {
    session_start();
    return isset($_SESSION['kirjautunut_tt']);
}
