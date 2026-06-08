<?php
$admin_title = 'Panel principal';
$products = require __DIR__ . '/../data/products.php';
$offers = require __DIR__ . '/../data/offers.php';
$services = require __DIR__ . '/../data/services.php';
require __DIR__ . '/includes/admin-header.php';
?>
<div class="grid grid--3">
    <div class="card stat"><h3>Productos</h3><strong><?= count($products) ?></strong><p>Catálogo por categorías.</p></div>
    <div class="card stat"><h3>Servicios</h3><strong><?= count($services) ?></strong><p>Servicios con explicación e imagen.</p></div>
    <div class="card stat"><h3>Ofertas</h3><strong><?= count($offers) ?></strong><p>Con fechas y destacado.</p></div>
</div>
<div class="card" style="margin-top:18px">
    <h3>Estado del proyecto</h3>
    <p class="notice">Esta versión no usa base de datos. Los módulos del admin son pantallas preparadas para el CRUD real cuando se integren los diagramas y la base de datos.</p>
</div>
<?php require __DIR__ . '/includes/admin-footer.php'; ?>
