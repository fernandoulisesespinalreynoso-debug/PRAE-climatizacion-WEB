<?php
$admin_title = 'Administrar productos';
$products = require __DIR__ . '/../data/products.php';
require __DIR__ . '/includes/admin-header.php';
?>
<div class="card">
    <h3>Agregar / editar producto</h3>
    <p class="notice">Formulario visual listo para conectar a base de datos. Por ahora no guarda cambios.</p>
    <form class="form-grid">
        <div class="field"><label>Nombre del producto</label><input placeholder="Ej.: Compresor para nevera"></div>
        <div class="field"><label>Categoría</label><select><option>Aires acondicionados</option><option>Neveras</option><option>Refrigeradores</option><option>Herramientas</option><option>Refrigerantes</option></select></div>
        <div class="field"><label>Precio</label><input type="number" placeholder="Opcional"></div>
        <div class="field"><label>Disponibilidad</label><select><option>Disponible</option><option>No disponible</option></select></div>
        <div class="field field--full"><label>URL de imagen</label><input placeholder="https://..."></div>
        <div class="field field--full"><label>Descripción</label><textarea rows="4" placeholder="Descripción breve del producto"></textarea></div>
        <button class="btn" type="button">Guardar producto</button>
    </form>
</div>
<div class="table-wrap" style="margin-top:18px">
<table>
    <thead><tr><th>Producto</th><th>Categoría</th><th>Precio</th><th>Estado</th><th>Acciones</th></tr></thead>
    <tbody>
    <?php foreach ($products as $p): ?>
        <tr><td><?= htmlspecialchars($p['name']) ?></td><td><?= htmlspecialchars($p['category']) ?></td><td><?= $p['price'] ? 'RD$'.number_format($p['price'],2) : 'Consultar' ?></td><td><?= $p['available'] ? 'Disponible' : 'No disponible' ?></td><td><button class="btn btn--light">Editar</button> <button class="btn btn--light">Eliminar</button></td></tr>
    <?php endforeach; ?>
    </tbody>
</table>
</div>
<?php require __DIR__ . '/includes/admin-footer.php'; ?>
