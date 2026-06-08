<?php
require_once __DIR__ . '/includes/auth.php';
$error = '';
if (admin_logged_in()) {
    header('Location: dashboard.php');
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = trim($_POST['user'] ?? '');
    $pass = $_POST['password'] ?? '';

    try {
        if (authenticate_admin($user, $pass)) {
            header('Location: dashboard.php');
            exit;
        }
        $error = 'Usuario o contraseña incorrectos.';
    } catch (PDOException $exception) {
        error_log('Error de conexión con la base de datos: ' . $exception->getMessage());
        $error = 'No se pudo conectar con la base de datos. Verifica que MySQL esté iniciado.';
    }
}
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin | PRAE</title>
    <link rel="stylesheet" href="assets/css/admin.css">
</head>
<body class="login-page">
    <form class="login-card" method="post">
        <img src="../assets/img/logo-prae-header.png" alt="Logo PRAE">
        <h1>Panel PRAE</h1>
        <p>Acceso visual preparado para XAMPP.</p>
        <?php if ($error): ?><div class="alert"><?= htmlspecialchars($error) ?></div><?php endif; ?>
        <div class="field"><label>Usuario</label><input name="user" value="admin" autocomplete="username"></div>
        <div class="field"><label>Contraseña</label><input name="password" type="password" placeholder="Contraseña" autocomplete="current-password"></div>
        <button class="btn" type="submit">Entrar</button>
        <p class="notice">Acceso conectado a la tabla <strong>admins</strong>.</p>
    </form>
</body>
</html>
