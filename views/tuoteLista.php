<title>Tuotteet</title>

<table class="table">
    <tr>
        <th>Nimi</th>
        <th>Hinta/€</th>
        <th>Kategoria</th>
        <th></th>
    </tr>

    <?php foreach ($data->tuotteet as $tuote): ?>
        <?php if ((!empty($data->kategoria) && $tuote->getKategoria() == $data->kategoria) || empty($data->kategoria)): ?>
            <tr>
                <td><?php echo htmlspecialchars($tuote->getNimi()); ?></td>
                <td><?php echo htmlspecialchars($tuote->getHinta()); ?></td>
                <td><?php echo htmlspecialchars($tuote->getKategoria()); ?></td>
                <td><a href="">Lisää kassiin</a></td>
            </tr>
        <?php endif; ?>
    <?php endforeach; ?>
</table>
