<?php
$page_title = 'Trabajos realizados | PRAE Refrigeración';
$page_desc = 'Galería de trabajos realizados y espacios para videos de servicios técnicos.';
$works = require __DIR__ . '/data/works.php';
require __DIR__ . '/includes/header.php';
?>
<section class="hero">
    <div class="hero-bg"></div>
    <div class="container">
        <div class="hero-content">
            <div class="hero-badge">Evidencia de servicio</div>
            <h1>Trabajos<br><em>realizados</em></h1>
            <p>Sección preparada para publicar imágenes y videos de mantenimientos, reparaciones e instalaciones residenciales.</p>
        </div>
    </div>
</section>
<section class="section section-soft">
    <div class="container">
        <div class="section-header">
            <div class="tag">Galería</div>
            <h2>Servicios con videos</h2>
            <p>Los videos pueden integrarse luego desde URL, carga manual o base de datos.</p>
        </div>
        <div class="grid grid-3">
            <?php foreach ($works as $work): ?>
                <article class="card work-card">
                    <img src="<?= e($work['image']) ?>" alt="<?= e($work['title']) ?>">
                    <div class="card-body">
                        <span class="badge">Trabajo realizado</span>
                        <h3><?= e($work['title']) ?></h3>
                        <p><?= e($work['description']) ?></p>
                        <div class="video-placeholder">Video pendiente<br>Colocar aquí el enlace o archivo</div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
