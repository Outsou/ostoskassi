<title>Tuotteet</title>

<a href="tuotelisays.php">Lisää tuote</a> <br><br>

<table class="table">
	<tr>
		<th>ID</th>
		<th>Nimi</th>		
		<th></th>
	</tr>
        
        <?php foreach ($data->tuotteet as $ostos): ?>
        <tr>
            <td><?php echo $ostos->getTuotenumero(); ?></td>
            <td><?php echo htmlspecialchars($ostos->getNimi()); ?></td>
            <td><a href="tuotemuokkaus.php?id=<?php echo $ostos->getTuotenumero() ?>">Muokkaa</a></td>
        </tr>
        <?php endforeach; ?>
</table>
