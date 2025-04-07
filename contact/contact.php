<?php
include 'db.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $naam = isset($_POST['name']) ? trim($_POST['name']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $onderwerp = isset($_POST['subject']) ? trim($_POST['subject']) : '';
    $bericht = isset($_POST['message']) ? trim($_POST['message']) : '';

    if (empty($naam) || empty($email) || empty($onderwerp) || empty($bericht)) {
        echo "<p style='color:red; text-align:center;'>❌ Alle velden zijn verplicht.</p>";
    } else {
    
        $volledige_tekst = "Onderwerp: $onderwerp\n\nBericht:\n$bericht";

        $stmt = $conn->prepare("INSERT INTO contactberichten (naam, email, bericht) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $naam, $email, $volledige_tekst);

        if ($stmt->execute()) {
            echo "<p style='color:green; text-align:center;'>✅ Bericht succesvol verzonden!</p>";
            exit();
        } else {
            echo "<p style='color:red; text-align:center;'>❌ Fout bij opslaan: " . $stmt->error . "</p>";
        }

        $stmt->close();
    }
}
?>
