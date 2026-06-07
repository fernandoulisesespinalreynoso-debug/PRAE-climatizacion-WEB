<?php
$site = require __DIR__ . '/../config/site.php';
require_once __DIR__ . '/functions.php';
$page_title = $page_title ?? $site['brand'];
$page_desc = $page_desc ?? 'Venta de piezas, servicios de refrigeración, climatización residencial y asesoría para técnicos.';
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($page_title) ?></title>
    <meta name="description" content="<?= e($page_desc) ?>">
    <meta name="keywords" content="<?= e($site['seo_keywords']) ?>">
    <meta name="theme-color" content="#0B4F9C">
    <link rel="icon" type="image/png" href="assets/img/favicon.png">
    <link rel="apple-touch-icon" href="assets/img/app-icon.png">
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body data-whatsapp="<?= e($site['whatsapp']) ?>">
    <header class="site-header" id="top">
        <div class="top-strip">
            <div class="container top-strip__inner">
                <span>Especialistas en refrigeración residencial</span>
                <span class="top-strip__right">Piezas • Servicios • Asesoría para técnicos</span>
            </div>
        </div>
        <nav class="navbar" aria-label="Menú principal">
            <div class="container navbar__inner">
                <a class="brand" href="index.php" aria-label="Ir al inicio">
                    <img src="assets/img/logo-prae-header.png" alt="Logo PRAE Refrigeración">
                </a>
                <button class="nav-toggle" type="button" aria-controls="main-menu" aria-expanded="false">
                    <span></span><span></span><span></span>
                    <strong>Menú</strong>
                </button>
                <ul class="main-menu" id="main-menu">
                    <li><a class="<?= is_active('productos.php') ?>" href="productos.php">Productos</a></li>
                    <li><a class="<?= is_active('ofertas.php') ?>" href="ofertas.php">Ofertas</a></li>
                    <li><a class="<?= is_active('servicios.php') ?>" href="servicios.php">Servicios</a></li>
                    <li><a class="<?= is_active('trabajos.php') ?>" href="trabajos.php">Trabajos</a></li>
                    <li><a class="<?= is_active('consejos.php') ?>" href="consejos.php">Consejos</a></li>
                    <li><a class="<?= is_active('ayuda.php') ?>" href="ayuda.php">Ayuda</a></li>
                    <li><a class="<?= is_active('sobre-nosotros.php') ?>" href="sobre-nosotros.php">Nosotros</a></li>
                    <li><a class="<?= is_active('contacto.php') ?>" href="contacto.php">Contacto</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <main>
