<?php
require_once 'includes/init.php';
require_once 'includes/csrf.php';
$pageTitle = "Ajouter un Propriétaire";
$bodyClass = "create-proprietaire-page";
include 'includes/header.php';
require_once 'includes/db.php';
$csrf_token = generateCSRFToken(); // Générer un nouveau jeton CSRF
?>

<main class="create-proprietaire-container">
    <h2>Ajouter un Nouveau Propriétaire</h2>
    <form action="create_proprietaire.php" method="POST" class="proprietaire-form">
        <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" id="nom" name="nom" class="form-input" required>
        </div>
        <div class="form-group">
            <label for="prenom">Prénom</label>
            <input type="text" id="prenom" name="prenom" class="form-input" required>
        </div>
        <div class="form-group">
            <label for="sexe">Sexe</label>
            <select id="sexe" name="sexe" class="form-input" required>
                <option value="Masculin">Masculin</option>
                <option value="Féminin">Féminin</option>
            </select>
        </div>
        <div class="form-group">
            <label for="adresse">Adresse</label>
            <input type="text" id="adresse" name="adresse" class="form-input" required>
        </div>
        <div class="form-group">
            <label for="num_tel">Numéro de téléphone</label>
            <input type="text" id="num_tel" name="num_tel" class="form-input" required>
        </div>
        <button type="submit" class="btn-submit">Ajouter le Propriétaire</button>
    </form>
</main>

<?php include 'includes/footer.php'; ?>
