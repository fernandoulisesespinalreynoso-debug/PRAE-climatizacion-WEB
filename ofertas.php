<?php
$page_title = 'Ofertas | PRAE Refrigeración';
$page_desc = 'Ofertas destacadas con imagen, fecha de inicio y fecha de finalización.';
$offers = require __DIR__ . '/data/offers.php';
require __DIR__ . '/includes/header.php';
?>
<section class="hero">
    <div class="hero-bg"></div>
    <div class="container">
        <div class="hero-content">
            <div class="hero-badge">Promociones PRAE</div>
            <h1>Ofertas<br><em>destacadas</em></h1>
            <p>Promociones visibles con imagen, descripción, fecha de inicio y finalización para comunicar oportunidades de compra.</p>
        </div>
    </div>
</section>
<section class="ofertas-section">
    <div class="section-header">
        <div class="tag">Ofertas disponiblesss</div>
        <h2>Ofertas activas</h2>
    </div>
    <div class="container">
        <div class="grid grid-3">
            <?php foreach ($offers as $offer): ?>
                <article class="oferta-card" style="width:auto;min-width:0">
                    <div class="oferta-img"><img src="<?= e($offer['image']) ?>" alt="<?= e($offer['title']) ?>"><span class="badge-oferta"><?= e($offer['badge']) ?></span></div>
                    <div class="oferta-body">
                        <div class="oferta-nombre"><?= e($offer['title']) ?></div>
                        <div class="oferta-desc"><?= e($offer['description']) ?></div>
                        <div class="date-line"><span>Inicia: <?= e($offer['starts']) ?></span><span>Finaliza: <?= e($offer['ends']) ?></span></div>
                        <br><a class="btn-light btn-small" href="<?= e(whatsapp_link('18093039156', 'Hola PRAE, quiero información sobre la oferta: ' . $offer['title'])) ?>" target="_blank" rel="noopener">Preguntar oferta</a>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
