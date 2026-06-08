<?php
require_once __DIR__ . '/../../config/database.php';

if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params([
        'httponly' => true,
        'secure' => !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
        'samesite' => 'Lax',
    ]);
    session_start();
}

function admin_logged_in(): bool {
    return !empty($_SESSION['prae_admin_id']);
}

function authenticate_admin(string $usuario, string $contrasena): bool {
    if ($usuario === '' || $contrasena === '') {
        return false;
    }

    $statement = db()->prepare(
        'SELECT id, usuario, nombre, correo, contrasena_hash
         FROM admins
         WHERE usuario = :usuario AND activo = 1
         LIMIT 1'
    );
    $statement->execute(['usuario' => $usuario]);
    $admin = $statement->fetch();

    if (!$admin || !password_verify($contrasena, $admin['contrasena_hash'])) {
        return false;
    }

    if (password_needs_rehash($admin['contrasena_hash'], PASSWORD_DEFAULT)) {
        $newHash = password_hash($contrasena, PASSWORD_DEFAULT);
        $updateHash = db()->prepare(
            'UPDATE admins SET contrasena_hash = :contrasena_hash WHERE id = :id'
        );
        $updateHash->execute([
            'contrasena_hash' => $newHash,
            'id' => $admin['id'],
        ]);
    }

    session_regenerate_id(true);
    $_SESSION['prae_admin_id'] = (int) $admin['id'];
    $_SESSION['prae_admin_usuario'] = $admin['usuario'];
    $_SESSION['prae_admin_nombre'] = $admin['nombre'];

    $updateAccess = db()->prepare(
        'UPDATE admins SET ultimo_acceso = CURRENT_TIMESTAMP WHERE id = :id'
    );
    $updateAccess->execute(['id' => $admin['id']]);

    return true;
}

function require_admin(): void {
    if (!admin_logged_in()) {
        header('Location: login.php');
        exit;
    }
}
