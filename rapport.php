<?php
$pageTitle = "Rapports - TurboTraffic";
$bodyClass = "rapports-page";
include 'includes/header.php';
require_once 'includes/db.php';

// Fonction pour récupérer les rapports
function getRapports($pdo) {
    $stmt = $pdo->query("SELECT * FROM rapports ORDER BY date_rapport DESC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$rapports = getRapports($pdo);
?>

<main class="rapports-container">
    <h2>Rapports</h2>
    <a href="generate_report.php" class="btn">Générer un Rapport PDF</a>
    <table class="table rapports-table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Titre</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rapports as $rapport): ?>
            <tr>
                <td><?= htmlspecialchars($rapport['date_rapport']) ?></td>
                <td><?= htmlspecialchars($rapport['titre']) ?></td>
                <td><?= htmlspecialchars($rapport['description']) ?></td>
                <td>
                    <a href="view_report.php?id=<?= $rapport['id'] ?>" class="btn">Voir</a>
                    <a href="delete_report.php?id=<?= $rapport['id'] ?>" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce rapport ?');">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>

<?php include 'includes/footer.php'; ?>
