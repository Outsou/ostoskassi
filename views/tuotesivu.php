<title>Tuote</title>
<img src="<?php echo $data->tuote->getKuva(); ?>" width="256" height="256" style="float: right">
<div>
    <label for="inputNimi">Nimi:</label>
    <?php echo htmlspecialchars($data->tuote->getNimi()); ?>
</div>
<div>
    <label for="inputKategoria">Kategoria:</label><br>
    <?php echo $data->tuote->getKategoria(); ?>
</div>
<div>
    <label for="inputHinta">Hinta:</label>
    <?php echo htmlspecialchars($data->tuote->getHinta()); ?>
</div>
<div>
    <label for="inputKuvaus">Kuvaus:</label>
    <?php echo htmlspecialchars($data->tuote->getKuvaus()); ?>
</div>
<button type="submit" class="btn btn-default">Tallenna</button>
<button type="button" class="btn btn-default" onclick="parent.location = 'tt_tuotteet.php'">Peruuta</button>
