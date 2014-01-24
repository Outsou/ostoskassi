<?php
require_once 'libs/tietokantayhteys.php';
require_once "libs/models/kayttaja.php";
$kysely = getTietokantayhteys()->prepare("SELECT * FROM asiakkaat;");
$kysely->execute();

$tulokset = array();
foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
    $kayttaja = new Kayttaja($tulos->asiakasnumero, $tulos->nimi, $tulos->osoite, $tulos->puhelinnumero);
    //$array[] = $muuttuja; lisää muuttujan arrayn perään. 
    //Se vastaa melko suoraan ArrayList:in add-metodia.
    $tulokset[] = $kayttaja;
}
?>
<!DOCTYPE HTML>
<html>
    <head><title>Otsikko</title></head>
    <body>
        <h1>Listaelementtitesti</h1>
        <ul>
            <?php foreach ($tulokset as $asia): ?>
            <li>Nimi: <?php echo $asia->getName(); ?><br> Asiakasnumero: <?php echo $asia->getAsiakasnumero(); ?></li>
            <?php endforeach; ?>
        </ul>
    </body>
</html>