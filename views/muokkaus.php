<title>Muokkaus</title>
<img src="pics/mp3.png" alt="Smiley face" width="256" height="256" style="float: right">
<form role="form" action="tuotemuokkaus.php?id=<?php echo $data->tuote->getTuotenumero(); ?>" method="POST">
    <div class="form-group">
        <label for="inputNimi">Nimi:</label>
        <input type="text" class="form-control" id="inputName" value="<?php echo htmlspecialchars($data->tuote->getNimi()); ?>" required name="nimi">
    </div>
    <div class="form-group">
        <label for="inputKategoria">Kategoria:</label><br>
        <select class="selectpicker" required name="kategoria">
            <option><?php echo htmlspecialchars($data->tuote->getKategoria()); ?></option>
            <?php foreach ($data->kategoriat as $kategoria): ?>
                <?php
                $nimi = $kategoria->getNimi();
                if ($nimi != $data->tuote->getKategoria()) {
                    echo "<option>$nimi</option>";
                }
                ?>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="inputHinta">Hinta:</label>
        <input type="number" class="form-control" id="inputName" value="<?php echo htmlspecialchars($data->tuote->getHinta()); ?>" required name="hinta">
    </div>
    <div class="form-group">
        <label for="inputKuvaus">Kuvaus:</label>
        <input type="text" class="form-control" id="inputDescription" value="<?php echo htmlspecialchars($data->tuote->getKuvaus()); ?>" required name="kuvaus">
    </div>
    <div class="form-group">
        <label for="exampleInputFile">Valitse kuva:</label>
        <input type="file" id="inputImage">
    </div>
    <button type="submit" class="btn btn-default">Tallenna</button>
    <button type="button" class="btn btn-default" onclick="parent.location='tt_tuotteet.php'">Peruuta</button>
    </form>
<form role="form" action="tuotemuokkaus.php?id=<?php echo $data->tuote->getTuotenumero(); ?>" method="POST">
    <button type="submit" class="btn btn-default" value="1" required name="poista">Poista</button>
</form>


