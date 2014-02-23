<title>Lento</title>

Lento: <?php echo $data->lento ?>

<table class="table">
    <tr>
        <th>Paikka</th>
        <th>Tuotenumero</th>
        <th>Tuote</th>
        <th>Määrä</th>
    </tr>

    <?php foreach ($data->tilaukset as $tilaus): ?>
        <tr>
            <td><?php echo htmlspecialchars($tilaus->getPaikkavaraus()->getPaikka()) ?></td>
            <td><?php echo htmlspecialchars($tilaus->getTuote()->getTuotenumero()) ?></td>
            <td><?php echo htmlspecialchars($tilaus->getTuote()->getNimi()) ?></td>
            <td><?php echo htmlspecialchars($tilaus->getOstos()->getMaara()) ?></td>
        </tr>
    <?php endforeach; ?>
</table>