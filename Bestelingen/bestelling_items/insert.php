<?php
require_once('functions.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (insertRecord($_POST)) {
        header("Location: index.php?success=1");
        exit();
    } else {
        echo "<script>alert('Toevoegen mislukt!')</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Nieuw Item</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Nieuw Bestelitem</h2>
    
    <form method="POST">
        <label>Bestelling ID:</label>
        <input type="number" name="bestelling_id" required><br>

        <label>Auto ID:</label>
        <input type="number" name="auto_id" required><br>

        <label>Aantal:</label>
        <input type="number" name="aantal" required><br>

        <label>Prijs per stuk (€):</label>
        <input type="number" step="0.01" name="prijs_per_stuk" required><br>

        <input type="submit" value="Toevoegen">
    </form>
    
    <a href="index.php">Terug naar overzicht</a>
</body>
</html>