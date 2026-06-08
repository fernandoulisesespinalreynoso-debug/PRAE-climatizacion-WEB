<?php
$admin_title = 'Administrar trabajos realizados';
$works = require __DIR__ . '/../data/works.php';
require __DIR__ . '/includes/admin-header.php';
?>
<div class="card">
    <h3>Agregar trabajo realizado</h3>
    <p class="notice">Preparado para subir imagen o colocar URL de video cuando se conecte el backend final.</p>
    <form class="form-grid">
        <div class="field"><label>Título</label><input placeholder="Ej.: Mantenimiento de aire residencial"></div>
        <div class="field"><label>Tipo</label><select><option>Aire acondicionado</option><option>Nevera</option><option>Refrigerador</option><option>Mantenimiento</option></select></div>
        <div class="field field--full"><label>Imagen / URL</label><input placeholder="https://..."></div>
        <div class="field field--full"><label>Video / URL</label><input placeholder="https://..."></div>
        <div class="field field--full"><label>Descripción</label><textarea rows="4"></textarea></div>
        <button class="btn" type="button">Guardar trabajo</button>
    </form>
</div>
<div class="table-wrap" style="margin-top:18px"><table><thead><tr><th>Trabajo</th><th>Video</th><th>Descripción</th><th>Acciones</th></tr></thead><tbody><?php foreach ($works as $w): ?><tr><td><?= htmlspecialchars($w['title']) ?></td><td><?= $w['video'] ? 'Agregado' : 'Pendiente' ?></td><td><?= htmlspecialchars($w['description']) ?></td><td><button class="btn btn--light">Editar</button> <button class="btn btn--light">Eliminar</button></td></tr><?php endforeach; ?></tbody></table></div>
<?php require __DIR__ . '/includes/admin-footer.php'; ?>
