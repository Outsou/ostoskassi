<!DOCTYPE html>
<html>
    <head>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/bootstrap-theme.css" rel="stylesheet">
        <link href="css/main.css" rel="stylesheet">

        <title>Etusivu</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
    </head>
    <body>

        <h1>SiipiLomat OY</h1>
        <!--If sivuID is null, don't make elements-->
        <?php if ($data->sivuID != NULL): ?>
            <a style="float: right" href="uloskirjautuminen.php">Kirjaudu ulos</a>

            <!--Top navigation tabs-->
            <ul class="nav nav-tabs">
                <?php if ($data->sivuID == 1): ?>
                    <li class="active"><a href="etusivu.php">Etusivu</a></li>
                    <li><a href="ostoskassi.php">Ostoskassi</a></li>
                    <li><a href="ateriat.php">Ateriat</a></li>
                <?php endif; ?>
                <?php if ($data->sivuID == 2): ?>
                    <li><a href="etusivu.php">Etusivu</a></li>
                    <li class="active"><a href="ostoskassi.php">Ostoskassi</a></li>
                    <li><a href="ateriat.php">Ateriat</a></li>
                <?php endif; ?>
                <?php if ($data->sivuID == 3): ?>
                    <li><a href="etusivu.php">Etusivu</a></li>
                    <li><a href="ostoskassi.php">Ostoskassi</a></li>
                    <li class="active"><a href="ateriat.php">Ateriat</a></li>
                <?php endif; ?>
            </ul>

            <!--Side navigation bar-->
            <ul class="nav affix">
                <li class ="h4"><br>Tuotealueet:</li>
                <li class="active"><a href="#dropdowns"> Elektroniikka</a></li>
                <li class="active"><a href="#buttonGroups"> Lahjat</a></li>
                <li class="active"><a href="#buttonGroups"> Lelut</a></li>
            </ul> 
        <?php endif; ?>

        <!--Site content-->
        <div class="container">
            <?php if (!empty($data->virhe)): ?>
                <div class="alert alert-danger"><?php echo $data->virhe; ?></div>
            <?php endif; ?>
            <?php require $sivu; ?>
        </div>
    </body>
</html>
