<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
const ADMIN_USER = 'admin';
const ADMIN_PASS = 'prae2026';

function admin_logged_in(): bool {
    return !empty($_SESSION['prae_admin']);
}

function require_admin(): void {
    if (!admin_logged_in()) {
        header('Location: login.php');
        exit;
    }
}
