<?php
require_once 'includes/db.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: vehicules.php");
    exit();
}

$stmt = $pdo->prepare("DELETE FROM vehicule WHERE id_vehicule = ?");
$stmt->execute([$id]);

header("Location: vehicules.php");
exit();
