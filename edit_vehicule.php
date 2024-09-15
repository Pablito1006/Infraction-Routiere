<?php
require_once 'includes/init.php';
start_secure_session(); 

require_once 'includes/csrf.php';

$pageTitle = "Modifier un Véhicule";
$bodyClass = "edit-vehicule-page";
include 'includes/header.php';
require_once 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!verifyCSRFToken($_POST['csrf_token'])) {
        die("Erreur de validation CSRF");
    }
    $id = $_POST['id'];
    $plaque_immat = $_POST['plaque_immat'];
    $marque = $_POST['marque'];
    $modele = $_POST['modele'];
    $annee = $_POST['annee'];
    $couleur = $_POST['couleur'];

    $stmt = $pdo->prepare("UPDATE vehicule SET plaque_immat = ?, marque = ?, modele = ?, annee = ?, couleur = ? WHERE id_vehicule = ?");
    $stmt->execute([$plaque_immat, $marque, $modele, $annee, $couleur, $id]);

    header("Location: vehicules.php");
    exit();
}

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: vehicules.php");
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM vehicule WHERE id_vehicule = ?");
$stmt->execute([$id]);
$vehicule = $stmt->fetch();
?>

<div class="form-container">
    <h2>Modifier le Véhicule</h2>
    <form action="edit_vehicule.php" method="POST">
        <input type="hidden" name="id" value="<?= $vehicule['id_vehicule'] ?>">
        <div class="form-group">
            <label for="plaque_immat">Plaque d'immatriculation</label>
            <input type="text" id="plaque_immat" name="plaque_immat" value="<?= htmlspecialchars($vehicule['plaque_immat']) ?>" required>
        </div>
        <div class="form-group">
            <label for="marque">Marque</label>
            <input type="text" id="marque" name="marque" value="<?= htmlspecialchars($vehicule['marque']) ?>" required>
        </div>
        <div class="form-group">
            <label for="modele">Modèle</label>
            <input type="text" id="modele" name="modele" value="<?= htmlspecialchars($vehicule['modele']) ?>" required>
        </div>
        <div class="form-group">
            <label for="annee">Année</label>
            <input type="number" id="annee" name="annee" value="<?= $vehicule['annee'] ?>" required>
        </div>
        <div class="form-group">
            <label for="couleur">Couleur</label>
            <input type="text" id="couleur" name="couleur" value="<?= htmlspecialchars($vehicule['couleur']) ?>" required>
        </div>
        <button type="submit" class="btn-submit">Mettre à jour le Véhicule</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>