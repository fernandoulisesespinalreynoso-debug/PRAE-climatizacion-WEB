<?php
$page_title = 'Servicios | PRAE Refrigeración';
$page_desc = 'Servicios de reparación, mantenimiento, instalación residencial y asesoría antes de comprar.';
$services = require __DIR__ . '/data/services.php';
require __DIR__ . '/includes/header.php';
?>
<section class="hero">
    <div class="hero-bg"></div>
    <div class="container">
        <div class="hero-content">
            <div class="hero-badge">Servicio técnico residencial</div>
            <h1>Servicios<br><em>PRAE</em></h1>
            <p>Reparación, mantenimiento, instalación y orientación para tomar mejores decisiones antes de comprar piezas o equipos.</p>
        </div>
    </div>
</section>
<section class="section section-soft">
    <div class="container">
        <div class="section-header">
            <div class="tag">Qué hacemos</div>
            <h2>Soluciones claras</h2>
            <p>Cada servicio tiene una explicación sencilla para que el cliente entienda qué necesita y cuándo conviene solicitar asistencia.</p>
        </div>
        <div class="grid grid-2">
            <?php foreach ($services as $service): ?>
                <article class="card service-card">
                    <img src="<?= e($service['image']) ?>" alt="<?= e($service['title']) ?>">
                    <div>
                        <span class="badge"><?= e($service['icon']) ?> Servicio</span>
                        <h3><?= e($service['title']) ?></h3>
                        <p><?= e($service['description']) ?></p>
                        <a class="btn btn-small" href="<?= e(whatsapp_link('18093039156', 'Hola PRAE, quiero información sobre: ' . $service['title'])) ?>" target="_blank" rel="noopener">Consultar</a>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<section class="section">
    <div class="container">
        <div class="section-header">
            <div class="tag">Proceso</div>
            <h2>Cómo se atiende</h2>
        </div>
        <div class="timeline">
            <div class="timeline__item"><h3>1. Diagnóstico</h3><p>Se identifica la necesidad real del cliente, el tipo de equipo y la posible falla.</p></div>
            <div class="timeline__item"><h3>2. Recomendación clara</h3><p>Se explica qué conviene hacer antes de comprar una pieza o contratar un servicio.</p></div>
            <div class="timeline__item"><h3>3. Cotización por WhatsApp</h3><p>El cliente envía los datos y recibe orientación para avanzar con confianza.</p></div>
        </div>
    </div>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
