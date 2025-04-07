<?php
require_once('functions.php');

if(!isset($_GET['id'])) die("Geen ID opgegeven");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(updateRecord($_POST)){
        header("Location: index.php?success=1");
        exit();
    } else {
        echo "<script>alert('Fout bij wijzigen!')</script>";
    }
}

$item = getRecord($_GET['id']);
if(!$item) die("Item niet gevonden");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Wijzig Item</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Wijzig Bestelitem</h2>
    <form method="POST">
        <input type="hidden" name="item_id" value="<?= $item['item_id'] ?>">
        
        <label>Bestelling ID:</label>
        <input type="number" name="bestelling_id" value="<?= $item['bestelling_id'] ?>" required><br>
        
        <label>Auto ID:</label>
        <input type="number" name="auto_id" value="<?= $item['auto_id'] ?>" required><br>
        
        <label>Aantal:</label>
        <input type="number" name="aantal" value="<?= $item['aantal'] ?>" required><br>
        
        <label>Prijs per stuk:</label>
        <input type="number" step="0.01" name="prijs_per_stuk" value="<?= $item['prijs_per_stuk'] ?>" required><br>
        
        <input type="submit" value="Opslaan">
    </form>
    <a href="index.php">Terug</a>
</body>
</html>