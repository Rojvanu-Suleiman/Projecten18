<?php
require_once('functions.php');

if(isset($_GET['id'])){
    if(deleteRecord($_GET['id'])){
        header("Location: index.php?deleted=1");
    } else {
        echo "<script>alert('Verwijderen mislukt!')</script>";
    }
}
?>