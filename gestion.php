<?php
$pageTitle = "Gestion des Infractions, Véhicules et Utilisateurs";
$bodyClass = "infractions-page";
include 'includes/header.php';
require_once 'includes/db.php';

// Fonction pour récupérer les infractions
function getInfractions($pdo) {
    $stmt = $pdo->query("SELECT i.*, p.nom, p.prenom, v.plaque_immat 
                         FROM infraction i 
                         JOIN personne p ON i.id_personne = p.id_personne 
                         JOIN vehicule v ON i.id_vehicule = v.id_vehicule 
                         ORDER BY i.date_infraction DESC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Fonction pour récupérer les véhicules
function getVehicules($pdo) {
    $stmt = $pdo->query("SELECT * FROM vehicule ORDER BY plaque_immat");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Fonction pour récupérer les utilisateurs
function getUsers($pdo) {
    $stmt = $pdo->query("SELECT * FROM users ORDER BY email");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$infractions = getInfractions($pdo);
$vehicules = getVehicules($pdo);
$users = getUsers($pdo);
?>

<main class="infractions-container">
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

    <div class="box">
        <h2>Gestion des Utilisateurs</h2>
        <a href="admin/create_user.php" class="btn">Ajouter un Utilisateur</a>
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
</main>

<?php include 'includes/footer.php'; ?>
