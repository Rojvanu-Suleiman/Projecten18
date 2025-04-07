<!DOCTYPE html>
<html>
<head>
    <title>Bestelitems Beheer</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    require_once('functions.php');
    crudMain();
    
    if(isset($_GET['success'])){
        echo "<script>alert('Operatie geslaagd!')</script>";
    }
    if(isset($_GET['deleted'])){
        echo "<script>alert('Item verwijderd!')</script>";
    }
    ?>
</body>
</html>