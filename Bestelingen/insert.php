<?php
require_once('functions.php');
echo "<h1>Nieuwe Bestelling Toevoegen</h1>";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn_ins'])) {
    // Verwerk checkbox voor betaald (0 of 1)
    $_POST['betaald'] = isset($_POST['betaald']) ? 1 : 0;
    
    if (insertRecord($_POST)) {
        header("Location: index.php?success=insert");
        exit();
    } else {
        echo '<div class="alert-error">Toevoegen mislukt!</div>';
    }
}
?>

<form method="post">
    <label>Klant ID:</label>
    <input type="number" name="klant_id" required><br>

    <label>Status:</label>
    <select name="status" required>
        <option value="Nieuw">Nieuw</option>
        <option value="In behandeling">In behandeling</option>
        <option value="Voltooid">Voltooid</option>
    </select><br>

    <label>Betaalmethode:</label>
    <select name="betaalmethode" required>
        <option value="iDEAL">iDEAL</option>
        <option value="Creditcard">Creditcard</option>
        <option value="Bankoverschrijving">Bankoverschrijving</option>
    </select><br>

    <label>Betaald:</label>
    <input type="checkbox" name="betaald"><br>

    <label>Totaal bedrag (€):</label>
    <input type="number" step="0.01" name="totaal_bedrag" required><br>

    <input type="submit" name="btn_ins" value="Toevoegen">
</form>
<a href='index.php'>Terug naar overzicht</a>