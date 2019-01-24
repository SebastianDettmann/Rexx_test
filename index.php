<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Formular Zeitraum für Kundenumsätze</title>
</head>
<body>
    <header>
        <h1 align="center">Formular für die Erfassung von Kundenumsätzen in einem bestimmten Zeitraum</h1>
        <hr />
    </header>
    <section>
        <div align="center">
            <p>Bitte geben Sie Start- und Enddatum ein. Anschließend wird eine csv Datei mit relevanten Kundendaten für diesen Zeitraum erstellt.</p>
            <hr />
            <form method="post" action="create_csv.php">
                <label for="start">Startdatum</label>
                <input type="date" name="start" id="start" required>
                <label for="start">Enddatum</label>
                <input type="date" name="end" id="start" required>
                <input type="submit">
            </form>
        </div>
    </section>
</body>
</html>
