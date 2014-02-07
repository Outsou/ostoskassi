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

        <h1 style="float: left">SiipiLomat OY</h1> <br><br>
        <a style="float: right" href="uloskirjautuminen_tt.php">Kirjaudu ulos</a> <br>

        <hr>

        <?php if ($data->sivuID != 0): ?>
            <!--Side navigation bar-->
            <ul class="nav affix">
                <li class="active"><a href="tt_tuotteet.php"> Tuotteet</a></li>
                <li class="active"><a href="tt_lennot.php"> Lennot</a></li>
            </ul>
        <?php endif; ?>

        <!--Site content-->
        <div class="container">
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
            <?php require $sivu; ?>
        </div>
    </body>
</html>
