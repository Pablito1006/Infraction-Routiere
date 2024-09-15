<?php
session_start();
require_once 'includes/db.php'; // Fichier de configuration du serveur et de la BD
require_once 'includes/csrf.php'; // Mesure de securité pour empecher les injections SQL
require_once 'includes/login_attempts.php'; // Limmiter le nombre des tentatives de connexion

$csrf_token = generateCSRFToken(); // Générer un nouveau jeton CSRF

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!verifyCSRFToken($_POST['csrf_token'])) {
        die("Erreur de validation CSRF");
    }
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if (!checkLoginAttempts($email)) {
        die("Trop de tentatives de connexion. Veuillez réessayer plus tard.");
    }
    // Procédez à la vérification du mot de passe
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_role'] = $user['role']; 
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Email ou mot de passe incorrect.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Yollo</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="login-body">
    <div class="login-container">
        <h2>Connexion à Yollo</h2>
        <form action="login.php" method="POST" class="login-form">
            <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
            <div class="form-group">
                <label for="email">Adresse e-mail</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Se connecter</button>
        </form>
    </div>
</body>
</html>