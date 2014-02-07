<title>Muokkaus</title>
<img src="pics/mp3.png" alt="Smiley face" width="256" height="256" style="float: right">
<form role="form">
    <div class="form-group">
        <label for="inputNimi">Nimi:</label>
        <input type="text" class="form-control" id="inputName" value="<?php echo $data->tuote->getNimi(); ?>">
    </div>
    <div class="form-group">
        <label for="inputKategoria">Kategoria:</label><br>
        <select class="selectpicker">
            <option><?php echo $data->tuote->getKategoria(); ?></option>
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
        <input type="number" class="form-control" id="inputName" value="<?php echo $data->tuote->getHinta(); ?>">
    </div>
    <div class="form-group">
        <label for="inputKuvaus">Kuvaus:</label>
        <input type="text" class="form-control" id="inputDescription" value="<?php echo $data->tuote->getKuvaus(); ?>">
    </div>
    <div class="form-group">
        <label for="exampleInputFile">Valitse kuva:</label>
        <input type="file" id="inputImage">
    </div>
    <button type="submit" class="btn btn-default">Tallenna</button>
    <button type="submit" class="btn btn-default">Peruuta</button>
    <button type="submit" class="btn btn-default">Poista</button>
</form>


