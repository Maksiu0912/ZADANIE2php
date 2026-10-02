<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Dziennik ocen</title>
</head>

<body>

    <h2>Dodaj ocenę</h2>

    <form method="POST" action="">

        <label for="uczen">Imię i nazwisko ucznia:</label>
        <input type="text" id="uczen" name="uczen" required>

        <br><br>

        <label for="ocena">Ocena:</label>
        <select id="ocena" name="ocena" required>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
        </select>

        <br><br>

        <label for="przedmiot">Przedmiot:</label>
        <input type="text" id="przedmiot" name="przedmiot" required>

        <br><br>

        <button type="submit" name="zapisz">Zapisz ocenę</button>

    </form>


<?php

if (isset($_POST["zapisz"])) {

    $uczen = trim($_POST["uczen"]);
    $przedmiot = trim($_POST["przedmiot"]);
    $ocena = $_POST["ocena"];

    if ($uczen != "" && $przedmiot != "") {

        $wpis = $uczen . " | " . $przedmiot . " | ocena: " . $ocena . "\n";

        
        $plik = fopen("oceny.txt", "a");

        if ($plik) {
            fwrite($plik, $wpis);
            fclose($plik);
        }
    }
}

?>


<h2>Zapisane oceny</h2>

<?php

if (file_exists("oceny.txt")) {

    $plik = fopen("oceny.txt", "r");

    if ($plik) {

        while (!feof($plik)) {

            $wpis = fgets($plik);

            if ($wpis !== false && trim($wpis) != "") {
                echo htmlspecialchars($wpis) . "<br>";
            }
        }

        fclose($plik);
    }

} else {

    echo "Brak zapisanych ocen.";

}

?>

</body>
</html>
