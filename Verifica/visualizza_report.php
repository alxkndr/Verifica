<?php
require 'pdo.php';

$query = "
    SELECT i.nome AS istruttore, c.nome_corso, m.nome, m.cognome
    FROM Corsi c
    JOIN Istruttori i ON c.id_istruttore = i.id_istruttore
    LEFT JOIN Iscrizioni_Corsi ic ON c.id_corso = ic.id_corso
    LEFT JOIN Membri m ON ic.id_membro = m.id_membro
    ORDER BY i.nome, c.nome_corso, m.cognome, m.nome
";
$results = $pdo->query($query)->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Report Corsi</title>
</head>
<body>
    <h1>Report Corsi</h1>
    <table>
        <tr>
            <th>Istruttore</th>
            <th>Corso</th>
            <th>Iscritto</th>
        </tr>
        <?php foreach ($results as $row) {
            echo "<tr>
                <td>{$row['istruttore']}</td>
                <td>{$row['nome_corso']}</td>
                <td>{$row['nome']} {$row['cognome']}</td>
            </tr>";
        } ?>
    </table>
</body>
</html>