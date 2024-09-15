<?php
require_once 'db.php';

$email = 'admin@admin.com'; // Remplacez par l'email de l'admin
$password = 'admin'; // Remplacez par le mot de passe souhaité
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
$role = 'admin'; // Utilisation de 'admin' comme valeur pour le rôle

try {
    $stmt = $pdo->prepare("INSERT INTO users (email, password, role) VALUES (?, ?, ?)");
    $stmt->execute([$email, $hashedPassword, $role]);
    echo "Utilisateur admin créé avec succès.";
} catch (PDOException $e) {
    echo "Erreur lors de la création de l'admin : " . $e->getMessage();
}
