<title>Ostokset</title>

<table class="table">
    <tr>
        <th>Nimi</th>
        <th>Hinta yhteensä/€</th>
        <th>Määrä</th>
        <th>Lennon varausnumero</th>
        <th></th>
    </tr>
    <?php $yhteensa = 0; ?>
    <?php foreach ($data->ostokset as $ostos): ?>
        <tr>
            <td><?php echo $ostos->getTuote()->getNimi(); ?></td>
            <?php
            $hinta = $ostos->getOstos()->getMaara() * $ostos->getTuote()->getHinta();
            $yhteensa += $hinta;
            ?>
            <td><?php echo $hinta; ?></td>  
            <td><?php echo $ostos->getOstos()->getMaara() ?></td>
            <td><?php echo $ostos->getOstos()->getPaikkavaraus() ?></td>
            <td>
                <?php if ($data->tilatut): ?>
                    <form action ="tilaukset.php" method="POST">
                    <?php else: ?>
                        <form action ="ostoskassi.php" method="POST">
                        <?php endif; ?>

                        <input type="hidden" name="varaus" value="<?php echo $ostos->getOstos()->getPaikkavaraus() ?>">
                        <input type="hidden" name="tuote" value="<?php echo $ostos->getOstos()->getTuote() ?>">
                        <button type="submit" class="btn btn-default" value="1" name="poista">Poista</button>
                    </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
Yhteensä: <?php echo $yhteensa ?>€

<?php if (!$data->tilatut): ?>
    <?php if ($data->ostokset != null): ?>
        <form action="ostoskassi.php" method="POST">
            <button type="submit" class="btn btn-default" value="1" name="tilaus">Tilaa</button>
        </form>
    <?php endif; ?>
<?php endif; ?>