<title>Tuotteet</title>

<a href="tuotelisays.php">Lisää tuote</a> <br><br>

<table class="table">
	<tr>
		<th>ID</th>
		<th>Nimi</th>		
		<th></th>
	</tr>
        
        <?php foreach ($data->tuotteet as $tuote): ?>
        <tr>
            <td><?php echo $tuote->getTuotenumero(); ?></td>
            <td><?php echo htmlspecialchars($tuote->getNimi()); ?></td>
            <td><a href="tuotemuokkaus.php?id=<?php echo $tuote->getTuotenumero() ?>">Muokkaa</a></td>
        </tr>
        <?php endforeach; ?>
</table>
