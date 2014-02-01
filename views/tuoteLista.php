<h1>Koe</h1>
<ul>
    <?php
    echo 'kirjautunut = ' + $data->asiakasnumero;
    ?>
    <br>
    <?php
    if (onKirjautunut()) {
        echo 'kirjautunut';
    } else {
        echo 'ei kirjautunut';
    }
    ?>
</ul>