<?php
require_once 'includes/init.php';
start_secure_session();

$pageTitle = "Modifier une Infraction";
$bodyClass = "edit-infraction-page";
include 'includes/header.php';
require_once 'includes/db.php';
require_once 'includes/csrf.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!verifyCSRFToken($_POST['csrf_token'])) {
        die("Erreur de validation CSRF");
    }
    $id = $_POST['id'];
    $date_infraction = $_POST['date_infraction'];
    $type_infraction = $_POST['type_infraction'];
    $montant_amende = $_POST['montant_amende'];
    $id_personne = $_POST['id_personne'];
    $id_vehicule = $_POST['id_vehicule'];

    $stmt = $pdo->prepare("UPDATE infraction SET date_infraction = ?, type_infraction = ?, montant_amende = ?, id_personne = ?, id_vehicule = ? WHERE id_infraction = ?");
    $stmt->execute([$date_infraction, $type_infraction, $montant_amende, $id_personne, $id_vehicule, $id]);

    header("Location: infractions.php");
    exit();
}

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: infractions.php");
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM infraction WHERE id_infraction = ?");
$stmt->execute([$id]);
$infraction = $stmt->fetch();

$personnes = $pdo->query("SELECT * FROM personne ORDER BY nom, prenom")->fetchAll();
$vehicules = $pdo->query("SELECT * FROM vehicule ORDER BY plaque_immat")->fetchAll();
?>

<div class="form-container">
    <h2>Modifier l'Infraction</h2>
    <form action="edit_infraction.php" method="POST">
        <input type="hidden" name="id" value="<?= $infraction['id_infraction'] ?>">
        <div class="form-group">
            <label for="date_infraction">Date de l'infraction</label>
            <input type="date" id="date_infraction" name="date_infraction" value="<?= $infraction['date_infraction'] ?>" required>
        </div>
        <div class="form-group">
            <label for="type_infraction">Type d'infraction</label>
            <input type="text" id="type_infraction" name="type_infraction" value="<?= htmlspecialchars($infraction['type_infraction']) ?>" required>
        </div>
        <div class="form-group">
            <label for="montant_amende">Montant de l'amende</label>
            <input type="number" id="montant_amende" name="montant_amende" step="0.01" value="<?= $infraction['montant_amende'] ?>" required>
        </div>
        <div class="form-group">
            <label for="id_personne">Personne</label>
            <select id="id_personne" name="id_personne" required>
                <?php foreach ($personnes as $personne): ?>
                    <option value="<?= $personne['id_personne'] ?>" <?= $personne['id_personne'] == $infraction['id_personne'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($personne['nom'] . ' ' . $personne['prenom']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="id_vehicule">Véhicule</label>
            <select id="id_vehicule" name="id_vehicule" required>
                <?php foreach ($vehicules as $vehicule): ?>
                    <option value="<?= $vehicule['id_vehicule'] ?>" <?= $vehicule['id_vehicule'] == $infraction['id_vehicule'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($vehicule['plaque_immat'] . ' - ' . $vehicule['marque'] . ' ' . $vehicule['modele']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn-submit">Mettre à jour l'Infraction</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
