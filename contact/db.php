<?php
$servername = "localhost";
$username = "root";  
$password = "";      
$database = "autowebshop"; 
$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("FOUT: Kan geen verbinding maken met de database. " . $conn->connect_error);
}

?>

