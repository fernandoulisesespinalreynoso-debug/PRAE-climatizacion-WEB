<?php
require_once __DIR__ . '/auth.php';
require_admin();
$page = basename($_SERVER['PHP_SELF']);
$title = $admin_title ?? 'Panel de administración';
$primary_actions = [
    'productos.php' => ['label' => '+ Nuevo producto', 'href' => '#admin-form'],
    'ofertas.php' => ['label' => '+ Nueva oferta', 'href' => '#admin-form'],
    'servicios.php' => ['label' => '+ Nuevo servicio', 'href' => '#admin-form'],
    'trabajos.php' => ['label' => '+ Nuevo trabajo', 'href' => '#admin-form'],
];
$primary_action = $primary_actions[$page] ?? ['label' => 'Ver sitio', 'href' => '../index.php'];
$nav_items = [
    'dashboard.php' => 'Panel',
    'productos.php' => 'Productos',
    'ofertas.php' => 'Ofertas',
    'servicios.php' => 'Servicios',
    'trabajos.php' => 'Trabajos',
    'configuracion.php' => 'Configuración',
];
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($title) ?> | PRAE Admin</title>
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <link rel="stylesheet" href="assets/css/admin.css">
</head>
<body>
<div class="admin-shell">
    <header class="admin-bar">
        <a class="admin-brand" href="dashboard.php" aria-label="Ir al panel principal">
            <img src="../assets/img/logo-prae-header.png" alt="PRAE">
            <span><strong>PRAE</strong> Administración</span>
        </a>
        <div class="admin-actions">
            <a class="btn btn--primary" href="<?= htmlspecialchars($primary_action['href']) ?>"><?= htmlspecialchars($primary_action['label']) ?></a>
            <a class="btn btn--ghost" href="../index.php">Ver página</a>
            <a class="btn btn--ghost" href="logout.php">Cerrar sesión</a>
        </div>
    </header>
    <main class="admin-main">
        <nav class="admin-tabs" aria-label="Secciones de administración">
            <?php foreach ($nav_items as $href => $label): ?>
                <a class="<?= $page === $href ? 'active' : '' ?>" href="<?= htmlspecialchars($href) ?>"><?= htmlspecialchars($label) ?></a>
            <?php endforeach; ?>
        </nav>
        <section class="admin-top">
            <div>
                <span class="admin-kicker">Panel PRAE</span>
                <h1><?= htmlspecialchars($title) ?></h1>
                <p>Frontend preparado para conexión futura a base de datos.</p>
            </div>
        </section>
