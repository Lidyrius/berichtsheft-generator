<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="./css/app.css">
        <title>Berichtsheft Builder</title>
    </head>
    <body>
        <div class="wrapper">
            <form class="main-form" action="/get-doc.php">
                <label for="beginning">Anfangsdatum (Montag!)</label>
                <input type="date" name="beginning" id="beginning" required>
                <label for="ending">Enddatum</label>
                <input type="date" name="ending" id="ending" required>
                <label for="week">Start Nr (Woche)</label>
                <input type="text" name="week" id="week" required>
                <br>
                <button type="submit" name="button" id="button">
                    Berichtsheft erstellen
                </button>
            </form>
        </div>
        <form class="grid-form" action="/get-grid.php">
            <button type="submit" name="button" id="button">
                Template mit Grid
            </button>
        </form>
    </body>
</html>