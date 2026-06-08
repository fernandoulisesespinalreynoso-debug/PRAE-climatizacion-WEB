<?php
$admin_title = 'Administrar ofertas';
$offers = require __DIR__ . '/../data/offers.php';
require __DIR__ . '/includes/admin-header.php';
?>
<div class="card">
    <h3>Crear oferta</h3>
    <p class="notice">Preparado para ofertas con imagen, inicio, finalización y opción de destacar en inicio.</p>
    <form class="form-grid" id="admin-form">
        <div class="field"><label>Título</label><input placeholder="Nombre de la oferta"></div>
        <div class="field"><label>Etiqueta</label><input placeholder="Destacada, combo, técnicos..."></div>
        <div class="field"><label>Fecha de inicio</label><input type="date"></div>
        <div class="field"><label>Fecha de finalización</label><input type="date"></div>
        <div class="field field--full"><label>Imagen / URL</label><input placeholder="https://..."></div>
        <div class="field field--full"><label>Descripción</label><textarea rows="4"></textarea></div>
        <button class="btn" type="button">Guardar oferta</button>
    </form>
</div>
<div class="table-wrap" style="margin-top:18px"><table><thead><tr><th>Oferta</th><th>Etiqueta</th><th>Inicio</th><th>Fin</th><th>Acciones</th></tr></thead><tbody><?php foreach ($offers as $o): ?><tr><td><?= htmlspecialchars($o['title']) ?></td><td><?= htmlspecialchars($o['badge']) ?></td><td><?= htmlspecialchars($o['starts']) ?></td><td><?= htmlspecialchars($o['ends']) ?></td><td><button class="btn btn--light">Editar</button> <button class="btn btn--light">Eliminar</button></td></tr><?php endforeach; ?></tbody></table></div>
<?php require __DIR__ . '/includes/admin-footer.php'; ?>
