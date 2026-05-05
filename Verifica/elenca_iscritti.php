<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

require 'pdo.php';

$query = "
    SELECT ic.id_iscrizione, m.id_membro, m.nome AS nome_membro, m.cognome AS cognome_membro, 
           c.nome_corso, c.id_corso
    FROM Iscrizioni_Corsi ic
    JOIN Membri m ON ic.id_membro = m.id_membro
    JOIN Corsi c ON ic.id_corso = c.id_corso
    ORDER BY m.cognome, m.nome
";
$iscritti = $pdo->query($query)->fetchAll();

$corsi = $pdo->query("SELECT id_corso, nome_corso FROM Corsi")->fetchAll();

//gestione de cambio corso

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_iscrizione'], $_POST['id_corso'])) {
    $id_iscrizione = $_POST['id_iscrizione'];
    $id_corso = $_POST['id_corso'];

    $stmt = $pdo->prepare("UPDATE Iscrizioni_Corsi SET id_corso = ? WHERE id_iscrizione = ?");
    $stmt->execute([$id_corso, $id_iscrizione]);

    echo "<p>Corso aggiornato con successo!</p>";
    
    header('Location: elenca_iscritti.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Elenco Iscritti</title>
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
    }
    table {
        width: 100%;
    }
    th, td {
        padding: 10px;
        text-align: left;
    }
    th {
        background-color: white;
    }
    form {
        margin: 0;
    }
    select {
        padding: 5px;
    }
    button {
        padding: 5px 10px;
        background-color: black;
        color: white;
        border: none;
    }
    </style>
<body>
    <h1>Elenco Iscritti</h1>
    <table border=3>
        <tr>
            <th>Nome</th>
            <th>Cognome</th>
            <th>Corso Attuale</th>
            <th>Cambia Corso</th>
        </tr>
        <?php foreach ($iscritti as $iscritto): ?>
        <tr>
            <td><?= htmlspecialchars($iscritto['nome_membro']) ?></td>
            <td><?= htmlspecialchars($iscritto['cognome_membro']) ?></td>
            <td><?= htmlspecialchars($iscritto['nome_corso']) ?></td>
            <td>
                <form method="POST" style="display: inline;">
                    <input type="hidden" name="id_iscrizione" value="<?= $iscritto['id_iscrizione'] ?>">
                    <select name="id_corso" required>
                        <?php foreach ($corsi as $corso): ?>
                            <option value="<?= $corso['id_corso'] ?>" <?= $corso['id_corso'] == $iscritto['id_corso'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($corso['nome_corso']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit">Cambia</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>