<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

require 'pdo.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $id_corso = $_POST['id_corso'];

    $stmt = $pdo->prepare("INSERT INTO Membri (nome, cognome) VALUES (?, ?)");
    $stmt->execute([$nome, $cognome]);

    $id_membro = $pdo->lastInsertId();
    $stmt = $pdo->prepare("INSERT INTO Iscrizioni_Corsi (id_corso, id_membro, data_iscrizione) VALUES (?, ?, NOW())");
    $stmt->execute([$id_corso, $id_membro]);

    echo "Iscritto aggiunto";
}

$corsi = $pdo->query("SELECT id_corso, nome_corso FROM Corsi")->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Aggiungi Iscritto</title>
</head>
<body>
    <form method="POST">
        <label>Nome:</label>
        <input type="text" name="nome" required>
        <label>Cognome:</label>
        <input type="text" name="cognome" required>
        <label>Corso:</label>
        <select name="id_corso">
            <?php foreach ($corsi as $corso) {
                echo "<option value='{$corso['id_corso']}'>{$corso['nome_corso']}</option>";
            } ?>
        </select>
        <button type="submit">Aggiungi</button>
    </form>
</body>
</html>