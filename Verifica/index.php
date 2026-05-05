<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

//pagina principale con link alle funzionalità
?>
<!DOCTYPE html>
<html>
<head>
    <title>Longo Gym - Pagina Principale</title>
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
    }
    h1 {
        color: #333;
    }
    ul {
        list-style-type: none;
        padding: 0;
    }
    li {
        margin: 10px 0;
    }
    a {
        text-decoration: none;
        color: #007BFF;
    }
    a:hover {
        text-decoration: underline;
    }
    </style>
<body>
    <h1>Longo Gym</h1>
    <p>Seleziona una delle seguenti funzionalità:</p>
    <ul>
        <li><a href="inserisci_iscritto.php">Aggiungi un nuovo iscritto</a></li>
        <li><a href="visualizza_corso_max.php">Visualizza il corso con più iscritti</a></li>
        <li><a href="elenca_iscritti.php">Elenca iscritti e cambia corso</a></li>
        <li><a href="visualizza_report.php">Visualizza il report dei corsi</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</body>
</html>