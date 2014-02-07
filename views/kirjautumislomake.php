<!DOCTYPE html>
<html>
    <head>
        <title>Muistilista</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <title>Kirjautuminen</title>

        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/bootstrap-theme.css" rel="stylesheet">
        <link href="css/main.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <?php
            if ($data->asiakas) {
                echo '<form class="form-signin" action="kirjautuminen.php" method="POST">';
            } else {
                echo '<form class="form-signin" action="kirjautuminen_tt.php" method="POST">';
            }
            ?>
            <h2 class = "form-signin-heading">Kirjaudu sisään</h2>
            <input type = "text" class = "form-control" placeholder = "Käyttäjänimi" required autofocus name = "kayttajanimi" value = "<?php echo $data->kayttaja; ?>" />
            <input type = "password" class = "form-control" placeholder = "Salasana" required name = "salasana" />
            <button class = "btn btn-lg btn-primary btn-block" type = "submit">Kirjaudu sisään</button>
            <br>
            <a href = "salasana">Salasana unohtui?</a>
        </div>
    </body>
</html>