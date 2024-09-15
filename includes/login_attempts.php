<?php
function checkLoginAttempts($email) {
    if (!isset($_SESSION['login_attempts'][$email])) {
        $_SESSION['login_attempts'][$email] = ['count' => 0, 'time' => time()];
    }

    if (time() - $_SESSION['login_attempts'][$email]['time'] > 3600) {
        $_SESSION['login_attempts'][$email] = ['count' => 1, 'time' => time()];
        return true;
    }

    if ($_SESSION['login_attempts'][$email]['count'] >= 5) {
        return false;
    }

    $_SESSION['login_attempts'][$email]['count']++;
    return true;
}
