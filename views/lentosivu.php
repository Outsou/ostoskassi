<title>Lento</title>

<table class="table">
    <tr>
        <th>Paikka</th>
        <th>Tuotenumero</th>
        <th>Tuote</th>
        <th>Määrä</th>
    </tr>

    <?php foreach ($data->tilaukset as $tilaus): ?>
        <tr>
            <td><?php echo $tilaus->getPaikkavaraus()->getPaikka() ?></td>
            <td><?php echo $tilaus->getTuote()->getTuotenumero() ?></td>
            <td><?php echo $tilaus->getTuote()->getNimi() ?></td>
            <td><?php echo $tilaus->getOstos()->getMaara() ?></td>
        </tr>
    <?php endforeach; ?>
</table>