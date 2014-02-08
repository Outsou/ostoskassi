<title>Lisays</title>
<form role="form" action="tuotelisays.php" method="POST">
    <div class="form-group">
        <label for="inputNimi">Nimi:</label>
        <?php if (!empty($data->tuote)): ?>
            <input type="text" class="form-control" id="inputName" value="<?php echo htmlspecialchars($data->tuote->getNimi()); ?>" required name="nimi">
        <?php else: ?>
            <input type="text" class="form-control" id="inputName" placeholder="nimi" required name="nimi">
        <?php endif; ?>
    </div>
    <div class="form-group">
        <label for="inputKategoria">Kategoria:</label><br>
        <select class="selectpicker" required name="kategoria" >
            <?php if (!empty($data->tuote)): ?>
                <option><?php echo $data->tuote->getKategoria(); ?></option>
            <?php endif; ?>
            <?php foreach ($data->kategoriat as $kategoria): ?>
                <?php
                $nimi = $kategoria->getNimi();
                if (!(!empty($data->tuote) && $nimi === $data->tuote->getKategoria()))
                    echo "<option>$nimi</option>";
                ?>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="inputHinta">Hinta:</label>
        <?php if (!empty($data->tuote)): ?>
            <input type="number" class="form-control" id="inputHinta" value="<?php echo htmlspecialchars($data->tuote->getHinta()); ?>" required name="hinta">
        <?php else: ?>
            <input type="number" class="form-control" id="inputHinta" placeholder="hinta" required name="hinta">
        <?php endif; ?>
    </div>
    <div class="form-group">
        <label for="inputKuvaus">Kuvaus:</label>
        <?php if (!empty($data->tuote)): ?>
        <input type="text" class="form-control" id="inputDescription" value="<?php echo htmlspecialchars($data->tuote->getKuvaus()); ?>" required name="kuvaus">
        <?php else: ?>
            <input type="text" class="form-control" id="inputDescription" placeholder="kuvaus" required name="kuvaus">
        <?php endif; ?>
    </div>
    <div class="form-group">
        <label for="exampleInputFile">Valitse kuva:</label>
        <input type="file" id="inputImage">
    </div>
    <button type="submit" class="btn btn-default">Tallenna</button>
    <button type="button" class="btn btn-default" onclick="parent.location='tt_tuotteet.php'">Peruuta</button>
</form>
