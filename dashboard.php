<?php
require_once 'includes/init.php';
start_secure_session();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
$pageTitle = "Tableau de bord - Yollo";
$bodyClass = "dashboard-page";
include 'includes/header.php';
require_once 'includes/db.php';

// Vérification de la session
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Calcul des statistiques
$totalInfractions = $pdo->query("SELECT COUNT(*) FROM infraction")->fetchColumn();

$currentMonth = date('Y-m-01');
$infractionsDuMois = $pdo->query("SELECT COUNT(*) FROM infraction WHERE date_infraction >= '$currentMonth'")->fetchColumn();

$amendesPercues = $pdo->query("SELECT SUM(montant_amende) FROM infraction")->fetchColumn();
?>

<main class="dashboard-main">
    <h1>Tableau de bord</h1>
    <section class="dashboard-summary">
        <div class="summary-cards">
            <div class="card">
                <h3>Total des infractions</h3>
                <p><?= number_format($totalInfractions) ?></p>
            </div>
            <div class="card">
                <h3>Infractions du mois</h3>
                <p><?= number_format($infractionsDuMois) ?></p>
            </div>
            <div class="card">
                <h3>Amendes perçues</h3>
                <p><?= number_format($amendesPercues, 2) ?> $</p>
            </div>
        </div>
    </section>
    <!-- Ajoutez d'autres sections du dashboard ici -->
</main>

<?php include 'includes/footer.php'; ?>
</body>
</html>
