<?php
$page_title = 'Ayuda | PRAE Refrigeración';
$page_desc = 'Preguntas frecuentes y comentarios de clientes para PRAE Refrigeración.';
require __DIR__ . '/includes/header.php';
?>
<section class="hero">
    <div class="hero-bg"></div>
    <div class="container">
        <div class="hero-content">
            <div class="hero-badge">Centro de ayuda</div>
            <h1>Ayuda<br><em>y comentarios</em></h1>
            <p>Preguntas frecuentes, orientación de compra y espacio para comentarios de clientes.</p>
        </div>
    </div>
</section>
<section class="section section-soft">
    <div class="container">
        <div class="grid grid-2">
            <div class="faq">
                <details open><summary>¿Puedo cotizar por WhatsApp?</summary><p>Sí. Los botones de productos, servicios y ofertas abren WhatsApp con un mensaje preparado.</p></details>
                <details><summary>¿Los productos tienen disponibilidad?</summary><p>Sí. Cada producto muestra si está disponible o no disponible.</p></details>
                <details><summary>¿La página funciona en celular?</summary><p>Sí. El diseño se adapta a teléfonos, tablets y computadoras.</p></details>
                <details><summary>¿Se puede administrar el catálogo?</summary><p>La interfaz del admin está preparada. La conexión real se hará cuando se agregue la base de datos.</p></details>
            </div>
            <div>
                <form class="testimonial-form" id="comment-form">
                    <h3>Deja un comentario</h3>
                    <div class="field"><label>Nombre</label><input name="name" placeholder="Tu nombre"></div>
                    <div class="field"><label>Comentario</label><textarea name="comment" rows="4" placeholder="Escribe tu experiencia o pregunta"></textarea></div>
                    <br><button class="btn-primary" type="submit">Publicar comentario</button>
                </form>
                <div class="comments-grid" id="comments-list"></div>
            </div>
        </div>
    </div>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
