<title>Ostokset</title>

<table class="table">
    <tr>
        <th>Nimi</th>
        <th>Hinta yhteensä/€</th>
        <th>Määrä</th>
        <th>Lennon varausnumero</th>
        <th></th>
    </tr>
    <?php foreach ($data->ostokset as $ostos): ?>
        <tr>
            <td><?php echo $ostos->getTuote()->getNimi(); ?></td>
            <?php $hinta = $ostos->getOstos()->getMaara() * $ostos->getTuote()->getHinta() ?>
            <td><?php echo $hinta; ?></td>  
            <td><?php echo $ostos->getOstos()->getMaara() ?></td>
            <td><?php echo $ostos->getOstos()->getPaikkavaraus() ?></td>
            <td>
                <form action ="ostoskassi.php" method="POST">
                    <input type="hidden" name="varaus" value="<?php echo $ostos->getOstos()->getPaikkavaraus() ?>">
                    <input type="hidden" name="tuote" value="<?php echo $ostos->getOstos()->getTuote() ?>">
                    <button type="submit" class="btn btn-default" value="1" name="poista">Poista</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>

</table>