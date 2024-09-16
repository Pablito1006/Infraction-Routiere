<?php
require_once 'init.php';
start_secure_session();

// Maintenant, démarrez la session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Régénérer l'ID de session après le démarrage de la session
session_regenerate_id(true);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle ?? 'Yollo'; ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="<?php echo $bodyClass ?? ''; ?>">
    <?php if (isset($_SESSION['user_id'])): ?>
    <header class="main-header">
        <h1><a href="dashboard.php" style="text-decoration: none; color: white;">TurboTraffic</a></h1>
        <nav>
            <ul>
                <li><a href="dashboard.php">Accueil</a></li>
                <li><a href="gestion.php">Gestion</a></li>
                <li><a href="rapport.php">Rapports</a></li>
                <li><a href="logout.php">Déconnexion</a></li>
            </ul>
        </nav>
    </header>
    <?php endif; ?>