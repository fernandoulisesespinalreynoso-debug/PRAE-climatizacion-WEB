<?php
$admin_title = 'Administrar servicios';
$services = require __DIR__ . '/../data/services.php';
require __DIR__ . '/includes/admin-header.php';
?>
<div class="card">
    <h3>Agregar servicio</h3>
    <p class="notice">Formulario preparado para editar servicios, imágenes y explicaciones.</p>
    <form class="form-grid" id="admin-form">
        <div class="field"><label>Título</label><input placeholder="Ej.: Mantenimiento preventivo"></div>
        <div class="field"><label>Icono</label><input placeholder="Ej.: 🔧"></div>
        <div class="field field--full"><label>Imagen / URL</label><input placeholder="https://..."></div>
        <div class="field field--full"><label>Descripción</label><textarea rows="4"></textarea></div>
        <button class="btn" type="button">Guardar servicio</button>
    </form>
</div>
<div class="table-wrap" style="margin-top:18px"><table><thead><tr><th>Servicio</th><th>Descripción</th><th>Acciones</th></tr></thead><tbody><?php foreach ($services as $s): ?><tr><td><?= htmlspecialchars($s['title']) ?></td><td><?= htmlspecialchars($s['description']) ?></td><td><button class="btn btn--light">Editar</button> <button class="btn btn--light">Eliminar</button></td></tr><?php endforeach; ?></tbody></table></div>
<?php require __DIR__ . '/includes/admin-footer.php'; ?>
