<?php
$page_title = 'Sobre nosotros | PRAE Refrigeración';
$page_desc = 'Historia, enfoque y valores de PRAE Refrigeración y Climatización Espinal.';
$site = require __DIR__ . '/config/site.php';
require __DIR__ . '/includes/header.php';
?>
<section class="hero">
    <div class="hero-bg"></div>
    <div class="container">
        <div class="hero-content">
            <div class="hero-badge">Nuestra empresa</div>
            <h1>Sobre<br><em>PRAE</em></h1>
            <p><?= e($site['slogan']) ?>. Una empresa enfocada en confort, servicio y orientación clara.</p>
        </div>
    </div>
</section>
<section class="section">
    <div class="container">
        <div class="grid grid-2">
            <article class="about-panel">
                <span class="badge">12 años de experiencia</span>
                <h2><?= e($site['brand']) ?></h2>
                <p>PRAE Refrigeración y Climatización Espinal se dedica a la venta de piezas, servicios de reparación, mantenimiento y asesoramiento para que el cliente tome mejores decisiones antes de comprar o reparar.</p>
            </article>
            <article class="about-panel">
                <span class="badge">Enfoque moderno</span>
                <h2>Experiencia clara y fácil de usar</h2>
                <p>La página fue organizada con navegación simple, diseño azul y blanco, enfoque móvil, productos por categorías, ofertas, servicios, trabajos, consejos, ayuda y administración.</p>
            </article>
        </div>
    </div>
</section>
<section class="section section-soft">
    <div class="container">
        <div class="section-header"><div class="tag">Valores de marca</div><h2>Confianza, orientación y buen servicio</h2></div>
        <div class="grid grid-3">
            <article class="cat-card" style="min-width:0;width:100%"><span class="cat-icon">🤝</span><div class="cat-name">Cercanía</div><div class="cat-count">Atención clara</div></article>
            <article class="cat-card" style="min-width:0;width:100%"><span class="cat-icon">🧠</span><div class="cat-name">Asesoría</div><div class="cat-count">Compra segura</div></article>
            <article class="cat-card" style="min-width:0;width:100%"><span class="cat-icon">❄</span><div class="cat-name">Confort</div><div class="cat-count">Clientes tranquilos</div></article>
        </div>
    </div>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
