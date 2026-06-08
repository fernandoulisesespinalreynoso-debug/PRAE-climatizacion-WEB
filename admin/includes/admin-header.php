<?php
require_once __DIR__ . '/auth.php';
require_admin();
$page = basename($_SERVER['PHP_SELF']);
$title = $admin_title ?? 'Panel de administración';
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
    <aside class="sidebar">
        <a class="sidebar__brand" href="dashboard.php"><img src="../assets/img/logo-prae-header.png" alt="PRAE"><span>PRAE Admin</span></a>
        <a class="<?= $page === 'dashboard.php' ? 'active' : '' ?>" href="dashboard.php">Panel principal</a>
        <a class="<?= $page === 'productos.php' ? 'active' : '' ?>" href="productos.php">Productos</a>
        <a class="<?= $page === 'ofertas.php' ? 'active' : '' ?>" href="ofertas.php">Ofertas</a>
        <a class="<?= $page === 'servicios.php' ? 'active' : '' ?>" href="servicios.php">Servicios</a>
        <a class="<?= $page === 'trabajos.php' ? 'active' : '' ?>" href="trabajos.php">Trabajos</a>
        <a class="<?= $page === 'configuracion.php' ? 'active' : '' ?>" href="configuracion.php">Configuración</a>
        <a href="../index.php">Ver página</a>
        <a href="logout.php">Cerrar sesión</a>
    </aside>
    <main class="admin-main">
        <div class="admin-top">
            <div><h1><?= htmlspecialchars($title) ?></h1><p>Frontend preparado para conexión futura a base de datos.</p></div>
            <a class="btn btn--light" href="../index.php">Ver sitio</a>
        </div>
