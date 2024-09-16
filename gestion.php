<?php
$pageTitle = "Gestion des Infractions, Véhicules";
$bodyClass = "infractions-page";
require_once 'includes/init.php';
require_once 'includes/db.php';
include 'includes/header.php';

// Vérifiez si l'utilisateur est un admin
if ($_SESSION['user_role'] === 'admin') {
    // Récupérer les utilisateurs depuis la base de données
    $stmt = $pdo->prepare("SELECT * FROM users");
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC); // Récupérer tous les utilisateurs
    ?>
    
    <div class="box">
        <h2>Gestion des Utilisateurs</h2>
        <a href="create_user.php" class="btn">Ajouter un Utilisateur</a>
        <table class="table users-table">
            <thead>
                <tr>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td><?= htmlspecialchars($user['role']) ?></td>
                    <td>
                        <a href="edit_user.php?id=<?= $user['id'] ?>" class="btn">Modifier</a>
                        <a href="delete_user.php?id=<?= $user['id'] ?>" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">Supprimer</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php 
} // Fin de la vérification du rôle admin

// Récupérer les infractions depuis la base de données
$stmt = $pdo->prepare("SELECT * FROM infraction");
$stmt->execute();
$infractions = $stmt->fetchAll(PDO::FETCH_ASSOC); // Récupérer toutes les infractions
?>

<div class="box">
    <h2>Gestion des Infractions</h2>
    <a href="create_infraction.php" class="btn">Créer une Infraction</a>
    <table class="table infractions-table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Type</th>
                <th>Montant</th>
                <th>Personne</th>
                <th>Véhicule</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($infractions as $infraction): ?>
            <tr>
                <td><?= htmlspecialchars($infraction['date_infraction']) ?></td>
                <td><?= htmlspecialchars($infraction['type_infraction']) ?></td>
                <td><?= htmlspecialchars($infraction['montant_amende']) ?> $</td>
                <td><?= htmlspecialchars($infraction['nom'] . ' ' . $infraction['prenom']) ?></td>
                <td><?= htmlspecialchars($infraction['plaque_immat']) ?></td>
                <td>
                    <a href="edit_infraction.php?id=<?= $infraction['id_infraction'] ?>" class="btn">Modifier</a>
                    <a href="delete_infraction.php?id=<?= $infraction['id_infraction'] ?>" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette infraction ?');">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php
// Récupérer les véhicules depuis la base de données
$stmt = $pdo->prepare("SELECT * FROM vehicule");
$stmt->execute();
$vehicules = $stmt->fetchAll(PDO::FETCH_ASSOC); // Récupérer tous les véhicules
?>

<div class="box">
    <h2>Gestion des Véhicules</h2>
    <a href="create_vehicule.php" class="btn">Ajouter un Véhicule</a>
    <table class="table vehicules-table">
        <thead>
            <tr>
                <th>Plaque</th>
                <th>Marque</th>
                <th>Modèle</th>
                <th>Année</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($vehicules as $vehicule): ?>
            <tr>
                <td><?= htmlspecialchars($vehicule['plaque_immat']) ?></td>
                <td><?= htmlspecialchars($vehicule['marque']) ?></td>
                <td><?= htmlspecialchars($vehicule['modele']) ?></td>
                <td><?= htmlspecialchars($vehicule['annee']) ?></td>
                <td>
                    <a href="edit_vehicule.php?id=<?= $vehicule['id_vehicule'] ?>" class="btn">Modifier</a>
                    <a href="delete_vehicule.php?id=<?= $vehicule['id_vehicule'] ?>" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce véhicule ?');">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php
// Récupérer les propriétaires depuis la base de données
$stmt = $pdo->prepare("SELECT * FROM personne");
$stmt->execute();
$proprietaires = $stmt->fetchAll(PDO::FETCH_ASSOC); // Récupérer tous les propriétaires
?>

<div class="box">
    <h2>Gestion des Propriétaires</h2>
    <a href="create_proprietaire.php" class="btn">Ajouter un Propriétaire</a>
    <table class="table proprietaires-table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Sexe</th>
                <th>Adresse</th>
                <th>Numéro de téléphone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($proprietaires as $proprietaire): ?>
            <tr>
                <td><?= htmlspecialchars($proprietaire['nom']) ?></td>
                <td><?= htmlspecialchars($proprietaire['prenom']) ?></td>
                <td><?= htmlspecialchars($proprietaire['sexe']) ?></td>
                <td><?= htmlspecialchars($proprietaire['adresse']) ?></td>
                <td><?= htmlspecialchars($proprietaire['num_tel']) ?></td>
                <td>
                    <a href="edit_proprietaire.php?id=<?= $proprietaire['id_personne'] ?>" class="btn">Modifier</a>
                    <a href="delete_proprietaire.php?id=<?= $proprietaire['id_personne'] ?>" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce propriétaire ?');">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include 'includes/footer.php'; ?>
