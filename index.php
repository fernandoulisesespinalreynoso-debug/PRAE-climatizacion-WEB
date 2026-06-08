<?php
$page_title = 'PRAE Refrigeración | Piezas, servicios y climatización residencial';
$page_desc = 'PRAE Refrigeración: productos, servicios, ofertas, trabajos realizados y asesoría para técnicos de refrigeración.';
$products = require __DIR__ . '/data/products.php';
$services = require __DIR__ . '/data/services.php';
$offers = require __DIR__ . '/data/offers.php';
$tips = require __DIR__ . '/data/tips.php';
$site = require __DIR__ . '/config/site.php';
require __DIR__ . '/includes/header.php';
$categories = [
    ['Aires acondicionados','AA','Piezas y accesorios'],
    ['Neveras','NV','Repuestos residenciales'],
    ['Refrigerantes','RF','Gases y consumibles'],
    ['Herramientas','HT','Equipos para técnicos'],
    ['Refrigeradores','RG','Equipos y piezas'],
    ['Piezas eléctricas','PE','Capacitores y tarjetas'],
    ['Mantenimiento','MT','Productos de limpieza'],
    ['General','GN','Otros productos'],
];
?>
<section class="hero">
    <div class="hero-bg"></div>
    <div class="container">
        <div class="hero-content">
            <div class="hero-badge">Refrigeración en Santo Domingo</div>
            <h1>PRAE<br><em>Refrigeración</em></h1>
            <p>Venta de piezas, reparación, mantenimiento y asesoría para técnicos y clientes residenciales que buscan soluciones claras antes de comprar.</p>
            <div class="hero-btns">
                <a href="productos.php" class="btn-primary">Ver catálogo</a>
                <a href="ofertas.php" class="btn-outline">Ver ofertas</a>
            </div>
        </div>
        <div class="hero-stats">
            <div class="stat"><div class="stat-num">12</div><div class="stat-label">Años</div></div>
            <div class="stat"><div class="stat-num">24h</div><div class="stat-label">Respuesta WA</div></div>
            <div class="stat"><div class="stat-num">100%</div><div class="stat-label">Residencial</div></div>
        </div>
    </div>
</section>

<section id="categorias" class="section">
    <div class="section-header">
        <div class="tag">Nuestro catálogo</div>
        <h2>Compra por categoría</h2>
        <p>Categorías principales preparadas para conectar luego con inventario de Excel o base de datos.</p>
    </div>
    <div class="marquee-wrap categories-marquee" aria-label="Categorías destacadas" data-carousel-viewport="categorias">
        <button class="carousel-arrow carousel-arrow-left" type="button" aria-label="Ver categorías anteriores" data-carousel-target="categorias" data-carousel-dir="-1">‹</button>
        <button class="carousel-arrow carousel-arrow-right" type="button" aria-label="Ver más categorías" data-carousel-target="categorias" data-carousel-dir="1">›</button>
        <div class="carousel-scroller">
            <div class="categories">
                <?php foreach (array_merge($categories, $categories) as $cat): ?>
                    <a href="productos.php?categoria=<?= urlencode($cat[0]) ?>" class="cat-card">
                        <span class="cat-icon"><?= e($cat[1]) ?></span>
                        <div class="cat-name"><?= e($cat[0]) ?></div>
                        <div class="cat-count"><?= e($cat[2]) ?></div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<section class="ofertas-section" id="ofertas">
    <div class="section-header">
        <div class="tag">Ofertas disponibles</div>
        <h2>Ofertas destacadas</h2>
        <p>Espacio para promociones con imagen, descripción, fecha de inicio y fecha de finalización.</p>
    </div>
    <div class="ofertas-marquee" data-carousel-viewport="ofertas">
        <button class="carousel-arrow carousel-arrow-left" type="button" aria-label="Ver ofertas anteriores" data-carousel-target="ofertas" data-carousel-dir="-1">‹</button>
        <button class="carousel-arrow carousel-arrow-right" type="button" aria-label="Ver más ofertas" data-carousel-target="ofertas" data-carousel-dir="1">›</button>
        <div class="carousel-scroller">
            <div class="ofertas-track">
                <?php foreach (array_merge($offers, $offers) as $offer): ?>
                    <article class="oferta-card">
                        <div class="oferta-img">
                            <img src="<?= e($offer['image']) ?>" alt="<?= e($offer['title']) ?>">
                            <span class="badge-oferta"><?= e($offer['badge']) ?></span>
                        </div>
                        <div class="oferta-body">
                            <div class="oferta-nombre"><?= e($offer['title']) ?></div>
                            <div class="oferta-desc"><?= e($offer['description']) ?></div>
                            <div class="date-line"><span>Inicio: <?= e($offer['starts']) ?></span><span>Fin: <?= e($offer['ends']) ?></span></div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<section class="section section-soft">
    <div class="container">
        <div class="section-header">
            <div class="tag">Servicios</div>
            <h2>Soluciones residenciales</h2>
            <p>Servicios explicados de forma sencilla para que el cliente sepa qué necesita antes de comprar o reparar.</p>
        </div>
        <div class="grid grid-2">
            <?php foreach ($services as $service): ?>
                <article class="card service-card">
                    <img src="<?= e($service['image']) ?>" alt="<?= e($service['title']) ?>">
                    <div>
                        <span class="badge"><?= e($service['icon']) ?> Servicio</span>
                        <h3><?= e($service['title']) ?></h3>
                        <p><?= e($service['description']) ?></p>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="quote-box">
            <div>
                <span class="badge">Cotizador rápido</span>
                <h2>Consulta por WhatsApp con datos claros.</h2>
                <p>Formulario preparado para orientar la cotización y enviar la solicitud por WhatsApp. Luego puede conectarse a base de datos e inventario.</p>
            </div>
            <form class="quote-form" id="quick-quote-form">
                <div class="form-grid">
                    <div class="field field-full"><label>Producto o servicio</label><input name="item" placeholder="Ej.: capacitor, mantenimiento, compresor"></div>
                    <div class="field"><label>Tipo</label><select name="type"><option>Producto</option><option>Servicio</option></select></div>
                    <div class="field"><label>Cantidad</label><input name="quantity" type="number" min="1" value="1"></div>
                    <div class="field"><label>Precio base estimado</label><input name="base_price" type="number" min="0" step="0.01" placeholder="Opcional"></div>
                    <div class="field"><label>Urgencia</label><select name="urgency"><option>Normal</option><option>Urgente</option></select></div>
                    <div class="field field-full"><label>Comentario</label><textarea name="notes" rows="3" placeholder="Modelo del equipo, falla, marca o detalle técnico"></textarea></div>
                </div>
                <div class="quote-result" id="quote-result"></div>
                <button class="btn-primary" type="submit">Enviar por WhatsApp</button>
            </form>
        </div>
    </div>
</section>

<section class="section section-soft">
    <div class="container">
        <div class="section-header">
            <div class="tag">Consejos y ayuda</div>
            <h2>Contenido para técnicos y clientes</h2>
        </div>
        <div class="tips-list">
            <?php foreach ($tips as $tip): ?>
                <article class="tip-item">
                    <span class="tip-item__icon">💡</span>
                    <div><span class="badge"><?= e($tip['tag']) ?></span><h3><?= e($tip['title']) ?></h3><p><?= e($tip['description']) ?></p></div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
