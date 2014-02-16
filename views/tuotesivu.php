<title>Tuote</title>
<img src="<?php echo $data->tuote->getKuva(); ?>" width="256" height="256" style="float: right">
<div>
    <label for="inputNimi">Nimi:</label><br>
    <?php echo htmlspecialchars($data->tuote->getNimi()); ?>
</div>
<div>
    <br><label for="inputKategoria">Kategoria:</label><br>
    <?php echo $data->tuote->getKategoria(); ?>
</div>
<div>
    <br><label for="inputHinta">Hinta:</label><br>
    <?php echo htmlspecialchars($data->tuote->getHinta()); ?>
</div>
<div>
    <br><label for="inputKuvaus">Kuvaus:</label><br>
    <?php echo htmlspecialchars($data->tuote->getKuvaus()); ?>
</div>

<br><br>

<form action="tuote.php?id=<?php echo $data->tuote->getTuotenumero() ?>" method="POST">
    <div class="row">
        <div class="col-lg-2">
            <div class="input-group">
                <label>Määrä:</label>
                <input type="number" class="form-numberfield" value="<?php echo $data->maara ?>" required name="maara">
            </div><!-- /input-group -->
        </div>
        <div class="col-lg-2">
            <div class="input-group">
                <label>Yhteensä: </label> <br>
                <?php echo $data->maara * $data->tuote->getHinta() ?>€
            </div><!-- /input-group -->
        </div>
        <div class="col-lg-2">
            <div class="input-group">
                <label>Lennon varausnumero:</label>
                <select class="selectpicker" name="varaus">
                    <?php
                    echo "<option>-- valitse lento --</option>";
                    foreach ($data->paikkavaraukset as $paikkavaraus) {
                        $varausnumero = htmlspecialchars($paikkavaraus->getVarausnumero());
                        echo "<option>$varausnumero</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
    </div><!-- /.row -->
    <br>
    <button type="submit" class="btn btn-default">Päivitä</button>
    <button type="submit" class="btn btn-default" name="lisaa">Lisää kassiin</button>
</form>

