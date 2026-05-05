<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

require 'pdo.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $iscritto_name = $_POST['iscritto_name'];
    $corso_id = $_POST['corso_id'];
    $istruttore_id = $_POST['istruttore_id'];

    $stmt = $pdo->prepare("INSERT INTO students (name, corso_id, istruttore_id) VALUES (?, ?, ?)");
    $stmt->execute([$iscritto_name, $corso_id, $istruttore_id]);

    echo "Iscritto aggiunto";
}