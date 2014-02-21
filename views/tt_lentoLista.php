<title>Lennot</title>

<table class="table-striped">
    <tr>
        <th>Lento</th>
    </tr>

    <?php foreach ($data->lennot as $lento): ?>
        <tr>
            <td><a href="lento.php?lento=<?php echo $lento; ?>"><?php echo $lento; ?></a></td>
        </tr>
    <?php endforeach; ?>
</table>