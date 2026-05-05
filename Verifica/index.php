<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Longo Gym</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .logout-btn {
            float: right;
            background-color: #f44336;
            color: white;
            padding: 8px 15px;
            text-decoration: none;
            border-radius: 3px;
        }
        .logout-btn:hover {
            background-color: #da190b;
        }
        .user-info {
            float: right;
            margin-right: 20px;
            color: #666;
            line-height: 36px;
        }
    </style>
</head>
<body>
    <div style="overflow: auto; margin-bottom: 20px;">
        <div class="user-info">Benvenuto, <?php echo htmlspecialchars($_SESSION['username']); ?></div>
        <a href="?logout=true" class="logout-btn">Logout</a>
    </div>
    
    <h1>Gestione Longo Gym</h1>
    <ul>
        <h3>
            <li><a href="inserisci_iscritto.php">Insersci un nuovo iscritto ad un corso in cui insegna un istruttore, entrambi scelti da menù a tendina</a></li>
            <li><a href="visualizza_corso_max.php">Visualizza, per ogni istruttore, il corso con il maggior numero di iscritti, purchè abbia almeno 5 iscritti</a></li>
            <li><a href="elenca_iscritti.php">Elenca tutti gli iscritti ad un corso e aggiungi accanto un tasto "cambia corso", il cambio avverrà scegliendo il nuovo corso da menù a tendina</a></li>
            <li><a href="visualizza_report.php">Visualizza un report in cui vengono visualizzati tutti i corsi tenuti da tutti gli istruttopri elencati, in ordine alfabetico di istruttore e corso e per ogni corso i dati relativi agli iscritti ordinati per nome e cognome
            </a></li>
        </h3>
    </ul>
</body>
</html>