<?php
include_once "config.php";

function connectDb() {
    $servername = SERVERNAME;
    $username = USERNAME;
    $password = PASSWORD;
    $dbname = DATABASE;
   
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $conn;
    } 
    catch(PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}

function crudMain() {
    echo "<h1>CRUD Bestelitems</h1>
          <a href='insert.php'>Nieuw item toevoegen</a><br><br>";
    
    $result = getData(CRUD_TABLE);
    printCrudTabel($result);
}

function getData($table) {
    $conn = connectDb();
    $stmt = $conn->prepare("SELECT * FROM $table");
    $stmt->execute();
    return $stmt->fetchAll();
}

function getRecord($id) {
    $conn = connectDb();
    $stmt = $conn->prepare("SELECT * FROM bestellingen_items WHERE item_id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function printCrudTabel($result) {
    echo "<table>";
    echo "<tr><th>Item ID</th><th>Bestelling ID</th><th>Auto ID</th><th>Aantal</th><th>Prijs/stuk</th><th colspan='2'>Acties</th></tr>";
    
    foreach ($result as $row) {
        echo "<tr>
                <td>{$row['item_id']}</td>
                <td>{$row['bestelling_id']}</td>
                <td>{$row['auto_id']}</td>
                <td>{$row['aantal']}</td>
                <td>€" . number_format($row['prijs_per_stuk'], 2) . "</td>
                <td><a href='update.php?id={$row['item_id']}'>Wijzig</a></td>
                <td><a href='delete.php?id={$row['item_id']}'>Verwijder</a></td>
              </tr>";
    }
    echo "</table>";
}

function updateRecord($data) {
    $conn = connectDb();
    $stmt = $conn->prepare("UPDATE bestellingen_items SET 
                            bestelling_id = :bestelling_id, 
                            auto_id = :auto_id, 
                            aantal = :aantal, 
                            prijs_per_stuk = :prijs_per_stuk 
                            WHERE item_id = :item_id");
    return $stmt->execute([
        ':bestelling_id' => $data['bestelling_id'],
        ':auto_id' => $data['auto_id'],
        ':aantal' => $data['aantal'],
        ':prijs_per_stuk' => $data['prijs_per_stuk'],
        ':item_id' => $data['item_id']
    ]);
}

function insertRecord($data) {
    $conn = connectDb();
    
    // Verwijder eventuele item_id uit de data
    unset($data['item_id']);
    
    $stmt = $conn->prepare("INSERT INTO bestellingen_items 
                            (bestelling_id, auto_id, aantal, prijs_per_stuk) 
                            VALUES (:bestelling_id, :auto_id, :aantal, :prijs_per_stuk)");
    return $stmt->execute([
        ':bestelling_id' => $data['bestelling_id'],
        ':auto_id' => $data['auto_id'],
        ':aantal' => $data['aantal'],
        ':prijs_per_stuk' => $data['prijs_per_stuk']
    ]);
}

function deleteRecord($id) {
    $conn = connectDb();
    $stmt = $conn->prepare("DELETE FROM bestellingen_items WHERE item_id = :id");
    return $stmt->execute([':id' => $id]);
}
?>