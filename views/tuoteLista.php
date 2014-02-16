<title>Tuotteet</title>

<table class="table">
    <tr>
        <th>Nimi</th>
        <th>Hinta/€</th>
        <th>Kategoria</th>
    </tr>

    <?php foreach ($data->tuotteet as $ostos): ?>
        <?php if ((!empty($data->kategoria) && $ostos->getKategoria() == $data->kategoria) || empty($data->kategoria)): ?>
            <tr>
                <td><a href="tuote.php?id=<?php echo $ostos->getTuotenumero() ?>"><?php echo htmlspecialchars($ostos->getNimi()); ?></a></td>
                <td><?php echo htmlspecialchars($ostos->getHinta()); ?></td>
                <td><?php echo htmlspecialchars($ostos->getKategoria()); ?></td>
            </tr>
        <?php endif; ?>
    <?php endforeach; ?>
</table>
