<?php
require_once 'includes/db.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: infractions.php");
    exit();
}

$stmt = $pdo->prepare("DELETE FROM infraction WHERE id_infraction = ?");
$stmt->execute([$id]);

header("Location: infractions.php");
exit();
