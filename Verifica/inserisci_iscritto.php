<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}
//pagina per inserire un nuovo iscritto e associarlo a un corso
require 'pdo.php';

$corsi = $pdo->query("SELECT id_corso, nome_corso FROM Corsi")->fetchAll();

$istruttori = $pdo->query("SELECT id_istruttore, CONCAT(nome, ' ', cognome) AS nome_completo FROM Istruttori")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $id_corso = $_POST['id_corso'];

    $stmt = $pdo->prepare("INSERT INTO Membri (nome, cognome) VALUES (?, ?)");
    $stmt->execute([$nome, $cognome]);

    $id_membro = $pdo->lastInsertId();

    $stmt = $pdo->prepare("INSERT INTO Iscrizioni_Corsi (id_corso, id_membro, data_iscrizione) VALUES (?, ?, NOW())");
    $stmt->execute([$id_corso, $id_membro]);

    echo "<p>Iscritto aggiunt</p>";
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Aggiungi Iscritto</title>
</head>
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
        <select name="id_corso" required>
            <option value="">Seleziona un corso</option>
            <?php foreach ($corsi as $corso): ?>
                <option value="<?= $corso['id_corso'] ?>"><?= htmlspecialchars($corso['nome_corso']) ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <label>Istruttore:</label>
        <select name="id_istruttore" disabled>
            <option value="">L'istruttore è associato al corso</option>
            <?php foreach ($istruttori as $istruttore): ?>
                <option value="<?= $istruttore['id_istruttore'] ?>"><?= htmlspecialchars($istruttore['nome_completo']) ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <button type="submit">Aggiungi Iscritto</button>
    </form>
</body>
</html>