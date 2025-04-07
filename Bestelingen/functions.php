<?php
// auteur: Rojvan
// functie: algemene functies tbv hergebruik

include_once "config.php";

function connectDb() {
    try {
        $conn = new PDO(
            "mysql:host=" . SERVERNAME . ";dbname=" . DATABASE,
            USERNAME,
            PASSWORD
        );
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $conn;
    } catch(PDOException $e) {
        die("Verbindingsfout: " . $e->getMessage());
    }
}

function crudMain() {
    echo "
    <h1>CRUD Bestellingen</h1>
    <nav>
        <a href='insert.php' class='nav-link active' >Nieuwe Bestelling</a>
        <a href='bestelling_items/index.php' class='nav-link active'>Items</a>
        
    </nav><br>";

    $result = getData("bestellingen");
    printCrudTabel($result);
}

function getData($table) {
    $conn = connectDb();
    $stmt = $conn->prepare("SELECT * FROM $table");
    $stmt->execute();
    return $stmt->fetchAll();
}

 // selecteer de rij van de opgeven id uit de table bestellingen
 function getRecord($bestelling_id) {
    $conn = connectDb();
    $sql = "SELECT * FROM bestellingen WHERE bestelling_id = :bestelling_id";
    $query = $conn->prepare($sql);
    $query->execute([':bestelling_id' => $bestelling_id]);
    return $query->fetch();
}


// Function 'printCrudTabel' print een HTML-table met data uit $result 
// en een wzg- en -verwijder-knop.
function printCrudTabel($result){
    // Zet de hele table in een variable en print hem 1 keer 
    $table = "<table>";

    // Print header table

    // haal de kolommen uit de eerste rij [0] van het array $result mbv array_keys
    $headers = array_keys($result[0]);
    $table .= "<tr>";
    foreach($headers as $header){
        $table .= "<th>" . $header . "</th>";   
    }
    // Voeg actie kopregel toe
    $table .= "<th colspan=2>Actie</th>";
    $table .= "</th>";

    // print elke rij
    foreach ($result as $row) {
        
        $table .= "<tr>";
        // print elke kolom
        foreach ($row as $cell) {
            $table .= "<td>" . $cell . "</td>";  
        }
        
        // Wijzig knopje
        // Wijzig knop
        $table .= "<td>
        <form method='get' action='update.php'>
            <input type='hidden' name='bestelling_id' value='" . $row['bestelling_id'] . "'>
            <button type='submit'>Wijzig</button>
        </form>
        </td>";

        // Verwijder knop
        // Delete knop (gebruik POST + hidden input)
        $table .= "<td>
        <form method='post' action='delete.php'>
            <input type='hidden' name='bestelling_id' value='" . $row['bestelling_id'] . "'>
            <button type='submit'>Verwijder</button>
        </form>
        </td>";

        $table .= "</tr>";
    }
    $table.= "</table>";

    echo $table;
}

function updateRecord($data) {
    $conn = connectDb();
    $sql = "UPDATE bestellingen SET 
            klant_id = :klant_id,
            status = :status,
            betaalmethode = :betaalmethode,
            betaald = :betaald,
            totaal_bedrag = :totaal_bedrag 
            WHERE bestelling_id = :bestelling_id";
    $stmt = $conn->prepare($sql);
    return $stmt->execute($data);
}

function insertRecord($post) {
    try {
        $conn = connectDb();
        $sql = "INSERT INTO bestellingen 
                (klant_id, datum, status, betaalmethode, betaald, totaal_bedrag) 
                VALUES 
                (:klant_id,  NOW(), :status, :betaalmethode, :betaald, :totaal_bedrag)";
        
        $stmt = $conn->prepare($sql);
        return $stmt->execute([
            ':klant_id'       => $post['klant_id'],
            ':status'         => $post['status'],
            ':betaalmethode' => $post['betaalmethode'],
            ':betaald'       => $post['betaald'],
            ':totaal_bedrag'  => $post['totaal_bedrag']
        ]);
        
    } catch(PDOException $e) {
        error_log("Insert error: " . $e->getMessage());
        return false;
    }
}

function deleteRecord($bestelling_id) {
    try {
        $conn = connectDb();
        $sql = "DELETE FROM bestellingen WHERE bestelling_id = :bestelling_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':bestelling_id', $bestelling_id, PDO::PARAM_INT);
        return $stmt->execute();
    } catch(PDOException $e) {
        error_log("Delete error: " . $e->getMessage());
        return false;
    }
}
?>
