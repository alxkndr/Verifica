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
    <title>Home - Gestione Palestra</title>
</head>
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