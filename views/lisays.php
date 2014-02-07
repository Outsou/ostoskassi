<title>Lisays</title>
<form role="form" action="tuotelisays.php" method="POST">
    <div class="form-group">
        <label for="inputNimi">Nimi:</label>
        <input type="text" class="form-control" id="inputName" placeholder="nimi" required name="nimi">
    </div>
    <div class="form-group">
        <label for="inputKategoria">Kategoria:</label><br>
        <select class="selectpicker" required name="kategoria">
            <?php foreach ($data->kategoriat as $kategoria): ?>
                <?php
                $nimi = $kategoria->getNimi();
                    echo "<option>$nimi</option>";
                ?>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="inputHinta">Hinta:</label>
        <input type="number" class="form-control" id="inputName" placeholder="hinta" required name="hinta">
    </div>
    <div class="form-group">
        <label for="inputKuvaus">Kuvaus:</label>
        <input type="text" class="form-control" id="inputDescription" placeholder="kuvaus" required name="kuvaus">
    </div>
    <div class="form-group">
        <label for="exampleInputFile">Valitse kuva:</label>
        <input type="file" id="inputImage">
    </div>
    <button type="submit" class="btn btn-default">Tallenna</button>
    <button type="submit" class="btn btn-default">Peruuta</button>
</form>
