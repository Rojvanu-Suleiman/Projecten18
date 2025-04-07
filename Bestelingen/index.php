<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoSphere - Bestellingen Beheer</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="header">
        <h1 class="title">Auto Webshop</h1>
        <nav class="navbar">
            <a href="http://localhost/bla-main/Home/homepage.html" class="nav-link">Home</a>
            <a href="http://localhost/bla-main/Bestelingen/" class="nav-link">Bestellingen</a>
            <a href="http://localhost/bla-main/Auto_pagina/Auto's/" class="nav-link">Autos</a>
            <a href="http://localhost/bla-main/contact/contact.html" class="nav-link">Contact</a>
            <a href="http://localhost/bla-main/log%20in/login.html" class="nav-link">Log in</a>
        </nav>
    </header>
    
    <main class="main">
        <div class="content">
            <?php
            // Initialisatie
            include 'functions.php';

            // Main
            // Aanroep functie 
            crudMain();
            ?>
        </div>
    </main>
   
    </footer>
</body>
</html>