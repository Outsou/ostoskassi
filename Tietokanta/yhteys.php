<?php
function annaYhteys() {
  static $yhteys = null; //Muuttuja, jonka sisältö säilyy annaYhteys-kutsujen välillä.

  if ($yhteys === null) { 
    //Tämä koodi suoritetaan vain kerran, sillä seuraavilla 
    //funktion suorituskerroilla $yhteys-muuttujassa on sisältöä.
    $yhteys = new PDO('pgsql:');
    $yhteys->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  }

  return $yhteys;
}

//Funktiota voi käyttää näin
$kysely = annaYhteys()->prepare("SELECT * FROM asiakkaat");
$kysely->execute();
$assosiaatiotaulu = $kysely->fetch();
echo $assosiaatiotaulu['nimi'];
?>