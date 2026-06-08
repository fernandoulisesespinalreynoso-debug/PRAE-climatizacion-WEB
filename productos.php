<?php
$page_title = 'Productos | PRAE Refrigeración';
$page_desc = 'Catálogo de productos por categorías para técnicos de refrigeración y clientes residenciales.';
$products = require __DIR__ . '/data/products.php';
$categories = array_values(array_unique(array_map(fn($p) => $p['category'], $products)));
require __DIR__ . '/includes/header.php';
?>
<section class="hero">
    <div class="hero-bg"></div>
    <div class="container">
        <div class="hero-content">
            <div class="hero-badge">Catálogo PRAE</div>
            <h1>Productos<br><em>por categoría</em></h1>
            <p>Productos organizados para técnicos: piezas de aires acondicionados, neveras, refrigerantes, herramientas y repuestos residenciales.</p>
        </div>
    </div>
</section>
<section class="section">
    <div class="container">
        <div class="product-toolbar">
            <div class="filter-buttons">
                <button class="filter-btn active" data-filter="Todos" type="button">Todos</button>
                <?php foreach ($categories as $cat): ?>
                    <button class="filter-btn" data-filter="<?= e($cat) ?>" type="button"><?= e($cat) ?></button>
                <?php endforeach; ?>
            </div>
            <input class="search-input" type="search" placeholder="Buscar producto o categoría..." data-product-search>
        </div>
        <div class="grid grid-3">
            <?php foreach ($products as $product): ?>
                <article class="card product-card" data-product-card data-category="<?= e($product['category']) ?>" data-name="<?= e($product['name']) ?>">
                    <div class="product-card__image"><img src="<?= e($product['image']) ?>" alt="<?= e($product['name']) ?>"></div>
                    <div class="card-body">
                        <div class="product-card__meta">
                            <span class="badge"><?= e($product['category']) ?></span>
                            <span class="badge <?= $product['available'] ? 'badge-success' : 'badge-danger' ?>"><?= $product['available'] ? 'Disponible' : 'No disponible' ?></span>
                        </div>
                        <h3><?= e($product['name']) ?></h3>
                        <p><?= e($product['description']) ?></p>
                        <div class="product-card__footer">
                            <span class="price"><?= e(money_rd($product['price'])) ?></span>
                            <button class="btn btn-small" type="button" data-quote-product="<?= e($product['name']) ?>">Cotizar</button>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<div class="modal" id="quote-modal" aria-hidden="true">
    <div class="modal__content">
        <div class="modal__head"><h3>Cotizar producto</h3><button class="modal__close" type="button" data-close-modal>×</button></div>
        <form id="modal-quote-form" class="form-grid">
            <div class="field field-full"><label>Producto</label><input id="quote-product" name="product"></div>
            <div class="field"><label>Cantidad</label><input name="quantity" type="number" value="1" min="1"></div>
            <div class="field"><label>Modelo del equipo</label><input name="model" placeholder="Marca / modelo / BTU"></div>
            <div class="field field-full"><label>Detalle</label><textarea name="notes" rows="4" placeholder="Describe lo que necesitas o la falla del equipo"></textarea></div>
            <div class="field field-full"><button class="btn-primary" type="submit">Enviar por WhatsApp</button></div>
        </form>
    </div>
</div>
<?php require __DIR__ . '/includes/footer.php'; ?>
