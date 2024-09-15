<?php
require_once '../includes/init.php';
require_once '../includes/csrf.php';
$pageTitle = "Ajouter un Utilisateur";
$bodyClass = "create-user-page";
$csrf_token = generateCSRFToken(); // Générer un nouveau jeton CSRF

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!verifyCSRFToken($_POST['csrf_token'])) {
        die("Erreur de validation CSRF");
    }

    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $stmt = $pdo->prepare("INSERT INTO users (email, password, role) VALUES (?, ?, ?)");
    $stmt->execute([$email, $password, $role]);

    header("Location: gestion.php");
    exit();
}
?>

<div class="form-container">
    <h2>Ajouter un Nouvel Utilisateur</h2>
    <form action="create_user.php" method="POST">
        <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="role">Rôle</label>
            <select id="role" name="role" required>
                <option value="admin">Admin</option>
                <option value="agent">Agent</option>
            </select>
        </div>
        <button type="submit" class="btn-submit">Ajouter l'Utilisateur</button>
    </form>
</div>

<?php include '../includes/footer.php'; ?>