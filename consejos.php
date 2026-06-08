<?php
$page_title = 'Consejos | PRAE Refrigeración';
$page_desc = 'Consejos prácticos para técnicos y clientes sobre refrigeración, mantenimiento y compra segura.';
$tips = require __DIR__ . '/data/tips.php';
require __DIR__ . '/includes/header.php';
?>
<section class="hero">
    <div class="hero-bg"></div>
    <div class="container">
        <div class="hero-content">
            <div class="hero-badge">Contenido útil</div>
            <h1>Consejos<br><em>técnicos</em></h1>
            <p>Contenido educativo para posicionamiento SEO y para orientar al cliente antes de comprar o solicitar servicio.</p>
        </div>
    </div>
</section>
<section class="section">
    <div class="container">
        <div class="section-header">
            <div class="tag">Aprende antes de comprar</div>
            <h2>Guías rápidas</h2>
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
<section class="section section-soft">
    <div class="container">
        <div class="about-panel">
            <h2>Idea SEO para la próxima etapa</h2>
            <p>Cuando se conecte la base de datos, cada consejo puede tener URL propia, palabras clave y contenido enfocado en búsquedas como “refrigeración”, “piezas de aire acondicionado” o “mantenimiento de nevera”.</p>
        </div>
    </div>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
