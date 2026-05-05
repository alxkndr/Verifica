<?php
$host = 'localhost';
$dbname = 'longo_gym'; //nome del mio database
$username = 'root';
$password = '';

//connessione al database con PDO

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>