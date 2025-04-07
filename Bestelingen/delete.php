<?php
include 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['bestelling_id'])) {
    $bestelling_id = $_POST['bestelling_id'];
    
    if (deleteRecord($bestelling_id)) {
        header("Location: index.php?success=delete");
    } else {
        header("Location: index.php?error=delete_failed");
    }
    exit();
} else {
    header("Location: index.php");
    exit();
}
?>
