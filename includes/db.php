<?php
$host = 'localhost';
$db = 'infraction_db'; // nom de la Base des Données
$user = 'root'; // ou votre nom d'utilisateur
$pass = ''; // ou votre mot de passe

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
    exit;
}