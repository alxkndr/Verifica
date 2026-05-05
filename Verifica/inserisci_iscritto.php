<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

require 'pdo.php';

$corsi = $pdo->query("
    SELECT c.id_corso, c.nome_corso, i.nome AS nome_istruttore, i.cognome AS cognome_istruttore
    FROM Corsi c
    JOIN Istruttori i ON c.id_istruttore = i.id_istruttore
")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $id_corso = $_POST['id_corso'];

    $stmt = $pdo->prepare("INSERT INTO Membri (nome, cognome) VALUES (?, ?)");
    $stmt->execute([$nome, $cognome]);

    $id_membro = $pdo->lastInsertId();

    $stmt = $pdo->prepare("INSERT INTO Iscrizioni_Corsi (id_corso, id_membro, data_iscrizione) VALUES (?, ?, NOW())");
    $stmt->execute([$id_corso, $id_membro]);

    echo "<p>Iscritto aggiunto con successo!</p>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Aggiungi Iscritto</title>
    <script>
        function aggiornaIstruttore() {
            const corsi = <?= json_encode($corsi) ?>;
            const corsoSelezionato = document.querySelector('select[name="id_corso"]').value;
            const istruttoreField = document.getElementById('istruttore');

            const corso = corsi.find(corso => corso.id_corso == corsoSelezionato);
            if (corso) {
                istruttoreField.textContent = corso.nome_istruttore + ' ' + corso.cognome_istruttore;
            } else {
                istruttoreField.textContent = 'Seleziona un corso';
            }
        }
    </script>
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
    }
    </style>
<body>
    <h1>Aggiungi un nuovo iscritto</h1>
    <form method="POST">
        <label>Nome:</label>
        <input type="text" name="nome" required>
        <br>
        <label>Cognome:</label>
        <input type="text" name="cognome" required>
        <br>
        <label>Corso:</label>
        <select name="id_corso" onchange="aggiornaIstruttore()" required>
            <option value="">Seleziona un corso</option>
            <?php foreach ($corsi as $corso): ?>
                <option value="<?= $corso['id_corso'] ?>"><?= htmlspecialchars($corso['nome_corso']) ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <label>Istruttore:</label>
        <span id="istruttore">Seleziona un corso</span>
        <br>
        <button type="submit">Aggiungi Iscritto</button>
    </form>
</body>
</html>