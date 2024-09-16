<?php
require_once 'includes/init.php';
require_once 'includes/csrf.php';
$pageTitle = "Créer une Infraction";
$bodyClass = "create-infraction-page";
include 'includes/header.php';
require_once 'includes/db.php';
$csrf_token = generateCSRFToken(); // Générer un nouveau jeton CSRF

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!verifyCSRFToken($_POST['csrf_token'])) {
        die("Erreur de validation CSRF");
    }
    // Traitement du formulaire
    $date_infraction = $_POST['date_infraction'];
    $type_infraction = $_POST['type_infraction'];
    $montant_amende = $_POST['montant_amende'];
    $id_personne = $_POST['id_personne'];
    $id_vehicule = $_POST['id_vehicule'];

    $stmt = $pdo->prepare("INSERT INTO infraction (date_infraction, type_infraction, montant_amende, id_personne, id_vehicule) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$date_infraction, $type_infraction, $montant_amende, $id_personne, $id_vehicule]);

    header("Location: infractions.php");
    exit();
}

// Récupérer la liste des personnes et des véhicules pour les menus déroulants
$personnes = $pdo->query("SELECT * FROM personne ORDER BY nom, prenom")->fetchAll();
$vehicules = $pdo->query("SELECT * FROM vehicule ORDER BY plaque_immat")->fetchAll();
?>
<main class="create-infraction-container">
    <h2>Créer une Nouvelle Infraction</h2>
    <form action="create_infraction.php" method="POST" class="infraction-form">
        <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
        <div class="form-group">
            <label for="date_infraction">Date de l'infraction</label>
            <input type="date" id="date_infraction" name="date_infraction" class="form-input" required>
        </div>
        <div class="form-group">
            <label for="type_infraction">Type d'infraction</label>
            <input type="text" id="type_infraction" name="type_infraction" class="form-input" required>
        </div>
        <div class="form-group">
            <label for="montant_amende">Montant de l'amende</label>
            <input type="number" id="montant_amende" name="montant_amende" class="form-input" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="id_personne">Personne</label>
            <select id="id_personne" name="id_personne" class="form-input" required>
                <?php foreach ($personnes as $personne): ?>
                    <option value="<?= $personne['id_personne'] ?>"><?= htmlspecialchars($personne['nom'] . ' ' . $personne['prenom']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="id_vehicule">Véhicule</label>
            <select id="id_vehicule" name="id_vehicule" class="form-input" required>
                <?php foreach ($vehicules as $vehicule): ?>
                    <option value="<?= $vehicule['id_vehicule'] ?>"><?= htmlspecialchars($vehicule['plaque_immat'] . ' - ' . $vehicule['marque'] . ' ' . $vehicule['modele']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn-submit">Créer l'Infraction</button>
    </form>
</main>

<?php include 'includes/footer.php'; ?>

