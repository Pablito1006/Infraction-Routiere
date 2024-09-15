<?php
// Définir les paramètres de session avant de démarrer la session
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_secure', 1); // Si vous utilisez HTTPS

// Fonction pour démarrer la session de manière sécurisée
function start_secure_session() {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    session_regenerate_id(true);
}
