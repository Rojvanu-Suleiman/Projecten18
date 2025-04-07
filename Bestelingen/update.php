<?php
require_once('functions.php');

if (isset($_POST['btn_wzg'])) {
    $data = [
        ':bestelling_id' => $_POST['bestelling_id'],
        ':klant_id' => $_POST['klant_id'],
        ':status' => $_POST['status'],
        ':betaalmethode' => $_POST['betaalmethode'],
        ':betaald' => isset($_POST['betaald']) ? 1 : 0,
        ':totaal_bedrag' => $_POST['totaal_bedrag']
    ];

    if (updateRecord($data)) {
        header("Location: index.php?success=2"); // Redirect na succes
        exit();
    }
}

if (isset($_GET['bestelling_id'])) {
    $bestelling_id = $_GET['bestelling_id'];
    $row = getRecord($bestelling_id);
?>
<form method="post">
    <input type="hidden" name="bestelling_id" value="<?= $row['bestelling_id'] ?>">
    
    <label>Klant ID:</label>
    <input type="number" name="klant_id" value="<?= $row['klant_id'] ?>" required><br>
    
    <label>Status:</label>
    <select name="status">
        <?php foreach(['Nieuw','In behandeling','Voltooid'] as $optie): ?>
            <option <?= ($row['status'] == $optie) ? 'selected' : '' ?>><?= $optie ?></option>
        <?php endforeach; ?>
    </select><br>
    
    <label>Betaalmethode:</label>
    <select name="betaalmethode">
        <?php foreach(['iDEAL','Creditcard','Bankoverschrijving'] as $methode): ?>
            <option <?= ($row['betaalmethode'] == $methode) ? 'selected' : '' ?>><?= $methode ?></option>
        <?php endforeach; ?>
    </select><br>
    
    <label>Betaald:</label>
    <input type="checkbox" name="betaald" <?= $row['betaald'] ? 'checked' : '' ?>><br>
    
    <label>Totaal bedrag:</label>
    <input type="number" step="0.01" name="totaal_bedrag" value="<?= $row['totaal_bedrag'] ?>" required><br>
    
    <input type="submit" name="btn_wzg" value="Wijzig">
</form>
<a href='index.php'>Terug</a>
<?php } ?>