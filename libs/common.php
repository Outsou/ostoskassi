<?php

session_start();

function naytaNakyma($sivu, $data = array()) {
    $data = (object) $data;
    require 'views/pohja.php';
    exit();
}

function onKirjautunut() {
    session_start();
    return isset($_SESSION['kirjautunut']);
}
