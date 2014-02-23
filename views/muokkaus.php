<title>Muokkaus</title>
<?php if (!empty($data->tuote)): ?>
    <img src="<?php echo $data->tuote->getKuva(); ?>" width="256" height="256" style="float: right">
<?php endif; ?>
<?php
if ($data->muokkaus == 1) {
    $action = "tuotemuokkaus.php?id=" . $data->tuote->getTuotenumero();
} else {
    $action = "tuotelisays.php";
}
?>
<form role="form" action="<?php echo $action ?>" method="POST" enctype="multipart/form-data">
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
        <select class="selectpicker" required name="kategoria">
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
        <input type="file" id="file" name="file">
    </div>
    <button type="submit" class="btn btn-default">Tallenna</button>
    <button type="button" class="btn btn-default" onclick="parent.location = 'tt_tuotteet.php'">Peruuta</button>
</form>
<?php if ($data->muokkaus == 1): ?>
    <form role="form" action="tuotemuokkaus.php?id=<?php echo $data->tuote->getTuotenumero(); ?>" method="POST">
        <button type="submit" class="btn btn-default" value="1" required name="poista">Poista</button>
    </form>
<?php endif; ?>