<!DOCTYPE html>
<html>
    <head>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/bootstrap-theme.css" rel="stylesheet">
        <link href="css/main.css" rel="stylesheet">

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
    </head>
    <body>

        <h1>SiipiLomat OY</h1>
        <a style="float: right" href="uloskirjautuminen.php">Kirjaudu ulos</a>

        <!--Top navigation tabs-->
        <ul class="nav nav-tabs">
            <?php if ($data->sivuID == 0): ?>
                <li><a href="etusivu.php">Etusivu</a></li>
                <li><a href="ostoskassi.php">Ostoskassi</a></li>
                <li><a href="ateriat.php">Ateriat</a></li>
                <li><a href="tilaukset.php">Tilaukset</a></li>
            <?php endif; ?>
            <?php if ($data->sivuID == 1): ?>
                <li class="active"><a href="etusivu.php">Etusivu</a></li>
                <li><a href="ostoskassi.php">Ostoskassi</a></li>
                <li><a href="ateriat.php">Ateriat</a></li>
                <li><a href="tilaukset.php">Tilaukset</a></li>
            <?php endif; ?>
            <?php if ($data->sivuID == 2): ?>
                <li><a href="etusivu.php">Etusivu</a></li>
                <li class="active"><a href="ostoskassi.php">Ostoskassi</a></li>
                <li><a href="ateriat.php">Ateriat</a></li>
                <li><a href="tilaukset.php">Tilaukset</a></li>
            <?php endif; ?>
            <?php if ($data->sivuID == 3): ?>
                <li><a href="etusivu.php">Etusivu</a></li>
                <li><a href="ostoskassi.php">Ostoskassi</a></li>
                <li class="active"><a href="ateriat.php">Ateriat</a></li>
                <li><a href="tilaukset.php">Tilaukset</a></li>
            <?php endif; ?>
            <?php if ($data->sivuID == 4): ?>
                <li><a href="etusivu.php">Etusivu</a></li>
                <li><a href="ostoskassi.php">Ostoskassi</a></li>
                <li><a href="ateriat.php">Ateriat</a></li>
                <li class="active"><a href="tilaukset.php">Tilaukset</a></li>
            <?php endif; ?>
        </ul>

        <!--Side navigation bar-->
        <ul class="nav affix">
            <li class ="h4"><br>Tuotealueet:</li>
            <li><a href="etusivu.php"> kaikki</a></li>
            <?php foreach ($data->kategoriat as $kategoria): ?>
                <li><a href="etusivu.php?kategoria=<?php echo $kategoria->getNimi(); ?>"> <?php echo $kategoria->getNimi(); ?></a></li>
            <?php endforeach; ?>
        </ul> 

        <!--Site content-->        
        <div class="container">
            <br>
            <?php if (!empty($_SESSION['ilmoitus'])): ?>
                <div class="alert alert-danger">
                    <?php echo $_SESSION['ilmoitus']; ?>
                </div>
                <?php
                unset($_SESSION['ilmoitus']);
                ?>
            <?php endif; ?>

            <?php if (!empty($data->virhe)): ?>
                <div class="alert alert-danger"><?php echo $data->virhe; ?></div>
            <?php endif; ?>
            <?php if (!empty($data->virheet)): ?>
                <?php foreach ($data->virheet as $virhe): ?>
                    <div class="alert alert-danger"><?php echo $virhe; ?></div>
                <?php endforeach; ?>
            <?php endif; ?>
            <?php require $sivu; ?>
        </div>
    </body>
</html>
