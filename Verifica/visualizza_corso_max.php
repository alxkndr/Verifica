<?php

require 'pdo.php';

?>

<!DOCTYPE html>
<html>
<head>
    <title>Corso con più iscritti</title>
</head>
<body>
    <h1>Corso con più iscritti</h1>
    <?php
    $query = "
        SELECT c.nome_corso, COUNT(ic.id_membro) AS iscritti
        FROM Corsi c
        LEFT JOIN Iscrizioni_Corsi ic ON c.id_corso = ic.id_corso
        GROUP BY c.id_corso
        ORDER BY iscritti DESC
    ";
    $result = $pdo->query($query)->fetch();

    if ($result) {
        echo "<p>Il corso con più iscritti è: <strong>{$result['nome_corso']}</strong> con <strong>{$result['iscritti']}</strong> iscritti.</p>";
    } else {
        echo "<p>Nessun corso trovato.</p>";
    }
    ?>

