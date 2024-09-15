<?php
require_once 'includes/init.php';
require_once 'includes/db.php';

$id = $_GET['id'] ?? null;

if ($id) {
    // Préparer la requête pour supprimer le rapport
    $stmt = $pdo->prepare("DELETE FROM rapports WHERE id = ?");
    $stmt->execute([$id]);

    // Rediriger vers la page des rapports après la suppression
    header("Location: rapport.php");
    exit();
} else {
    // Si l'ID n'est pas fourni, rediriger vers la page des rapports
    header("Location: rapport.php");
    exit();
}
?>
