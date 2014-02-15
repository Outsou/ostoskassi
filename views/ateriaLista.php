<title>Ateriat</title>
<?php if (!empty($data->paikkavaraukset)): ?>
    <form role="form" action="ateriat.php" method="POST">
        <select class="selectpicker" onchange="this.form.submit()" name="varaus">
            <?php
            echo "<option>-- valitse lento --</option>";
            foreach ($data->paikkavaraukset as $paikkavaraus) {
                $varausnumero = htmlspecialchars($paikkavaraus->getVarausnumero());
                echo "<option>$varausnumero</option>";
            }
            ?>
        <?php endif; ?>
    </select>
    <noscript><input type="submit" value="Submit"></noscript>
</form>

<?php if (!empty($data->varaus)): ?>
    <br>
    <?php
    foreach ($data->paikkavaraukset as $paikkavaraus) {
        if ($paikkavaraus->getVarausnumero() == $data->varaus) {
            echo 'Varausnumero: ' . $data->varaus . '<br>';
            echo 'Lento: ' . $paikkavaraus->getLento() . '<br>';
            echo 'Paikka: ' . $paikkavaraus->getPaikka() . '<br><br>';
        }
    }
    ?>

    <form role="form" action="ateriat.php" method="POST">    
        <div class="form-group">
            <label for="inputKasvis">Kasvis:</label>
            <input type="checkbox" name="kasvis" <?php if ($data->ateriatiedot->getKasvis()) echo "checked" ?>>
        </div>
        <div class="form-group">
            <label for="inputVegaani">Vegaani:</label>
            <input type="checkbox" name="vegaani" <?php if ($data->ateriatiedot->getVegaani()) echo "checked" ?>>
        </div>
        <div class="form-group">
            <label for="inputKuvaus">Muuta:</label>
            <input type="text" class="form-control" id="inputDescription" value="<?php echo htmlspecialchars($data->ateriatiedot->getMuu()) ?>" name="muu">
        </div>
        <button type="submit" class="btn btn-default" name="tallenna" value="<?php echo $data->varaus ?>">Tallenna</button>
    </form>
<?php endif; ?>
