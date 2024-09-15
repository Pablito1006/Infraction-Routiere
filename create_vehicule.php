<?php
require_once 'includes/init.php';
start_secure_session();

require_once 'includes/csrf.php';

$pageTitle = "Ajouter un Véhicule";
$bodyClass = "create-vehicule-page";
include 'includes/header.php';
require_once 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!verifyCSRFToken($_POST['csrf_token'])) {
        die("Erreur de validation CSRF");
    }
    $plaque_immat = $_POST['plaque_immat'];
    $marque = $_POST['marque'];
    $modele = $_POST['modele'];
    $annee = $_POST['annee'];
    $couleur = $_POST['couleur'];

    $stmt = $pdo->prepare("INSERT INTO vehicule (plaque_immat, marque, modele, annee, couleur) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$plaque_immat, $marque, $modele, $annee, $couleur]);

    header("Location: vehicules.php");
    exit();
}
?>

<main>
<div class="form-container">
    <h2>Ajouter un Nouveau Véhicule</h2>
    <form action="create_vehicule.php" method="POST">
        <div class="form-group">
            <label for="plaque_immat">Plaque d'immatriculation</label>
            <input type="text" id="plaque_immat" name="plaque_immat" required>
        </div>
        <div class="form-group">
            <label for="marque">Marque</label>
            <input type="text" id="marque" name="marque" required>
        </div>
        <div class="form-group">
            <label for="modele">Modèle</label>
            <input type="text" id="modele" name="modele" required>
        </div>
        <div class="form-group">
            <label for="annee">Année</label>
            <input type="number" id="annee" name="annee" required>
        </div>
        <div class="form-group">
            <label for="couleur">Couleur</label>
            <input type="text" id="couleur" name="couleur" required>
        </div>
        <button type="submit" class="btn-submit">Ajouter le Véhicule</button>
    </form>
</div>
</main>

<?php include 'includes/footer.php'; ?>
