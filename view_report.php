<?php
require_once 'includes/init.php';
require_once 'includes/db.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: rapports.php");
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM rapports WHERE id = ?");
$stmt->execute([$id]);
$rapport = $stmt->fetch();

if (!$rapport) {
    header("Location: rapports.php");
    exit();
}
?>

<main class="view-rapport-container">
    <h2><?= htmlspecialchars($rapport['titre']) ?></h2>
    <p><strong>Date :</strong> <?= htmlspecialchars($rapport['date_rapport']) ?></p>
    <p><strong>Description :</strong> <?= htmlspecialchars($rapport['description']) ?></p>
    <a href="rapports.php" class="btn">Retour à la liste des rapports</a>
</main>

<?php include 'includes/footer.php'; ?>
