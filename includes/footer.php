<?php
$site = $site ?? require __DIR__ . '/../config/site.php';
require_once __DIR__ . '/functions.php';
$waMessage = 'Hola PRAE, quiero recibir asistencia sobre refrigeración y climatización.';
?>
    </main>
    <footer class="footer">
        <div class="container footer__grid">
            <div>
                <a class="footer__brand" href="index.php">
                    <img src="assets/img/logo-prae-header.png" alt="Logo PRAE Refrigeración">
                    <span>PRAE Refrigeración</span>
                </a>
                <p><?= e($site['slogan']) ?>.</p>
                <div class="footer__socials" aria-label="Redes sociales">
                    <a href="<?= e($site['socials']['tiktok']) ?>" aria-label="TikTok">TikTok</a>
                    <a href="<?= e($site['socials']['facebook']) ?>" aria-label="Facebook">Facebook</a>
                    <a href="<?= e(whatsapp_link($site['whatsapp'], $waMessage)) ?>" aria-label="WhatsApp" target="_blank" rel="noopener">WhatsApp</a>
                </div>
            </div>
            <div>
                <h3>Catálogo</h3>
                <a href="productos.php?categoria=Aires%20acondicionados">Aires acondicionados</a>
                <a href="productos.php?categoria=Neveras">Neveras</a>
                <a href="productos.php?categoria=Refrigerantes">Refrigerantes</a>
                <a href="productos.php?categoria=Herramientas">Herramientas</a>
            </div>
            <div>
                <h3>Servicios</h3>
                <a href="servicios.php">Reparación</a>
                <a href="servicios.php">Mantenimiento</a>
                <a href="servicios.php">Instalación residencial</a>
                <a href="servicios.php">Asesoría antes de comprar</a>
            </div>
            <div>
                <h3>Contacto</h3>
                <p class="muted">Información pendiente de completar.</p>
                <p class="muted">Aquí se colocará ubicación, correo, horario y redes cuando lo confirmes.</p>
                <a class="footer-admin" href="admin/login.php">Acceso admin</a>
            </div>
        </div>
        <div class="footer__bottom">
            <div class="container">
                <span>© <?= date('Y') ?> PRAE Refrigeración y Climatización Espinal.</span>
                <span>Frontend preparado para XAMPP y futura base de datos.</span>
            </div>
        </div>
    </footer>

    <a class="float-wa" href="<?= e(whatsapp_link($site['whatsapp'], $waMessage)) ?>" target="_blank" rel="noopener" aria-label="Escribir por WhatsApp">
        <svg viewBox="0 0 32 32" aria-hidden="true" focusable="false"><path d="M16.04 3C9.42 3 4.03 8.32 4.03 14.86c0 2.1.56 4.14 1.62 5.93L4 29l8.42-1.6a12.2 12.2 0 0 0 5.62 1.36c6.62 0 12.01-5.32 12.01-11.87C30.05 8.32 22.66 3 16.04 3Zm0 21.7c-1.7 0-3.36-.45-4.82-1.31l-.35-.2-3.12.6.61-3.02-.23-.38a9.65 9.65 0 0 1-1.5-5.13c0-5.04 4.21-9.14 9.4-9.14s9.4 4.1 9.4 9.14-4.21 9.44-9.4 9.44Zm5.15-6.87c-.28-.14-1.66-.8-1.92-.9-.26-.09-.45-.14-.64.14-.19.28-.73.9-.9 1.09-.17.19-.33.21-.61.07-.28-.14-1.18-.43-2.24-1.36-.83-.73-1.38-1.63-1.54-1.91-.16-.28-.02-.43.12-.57.13-.13.28-.33.42-.49.14-.16.19-.28.28-.47.09-.19.05-.35-.02-.49-.07-.14-.64-1.51-.88-2.07-.23-.54-.47-.47-.64-.48h-.55c-.19 0-.49.07-.75.35-.26.28-.99.95-.99 2.32 0 1.37 1.02 2.69 1.16 2.88.14.19 2.01 3.01 4.87 4.22.68.29 1.21.46 1.62.59.68.21 1.3.18 1.79.11.55-.08 1.66-.67 1.9-1.31.23-.64.23-1.19.16-1.31-.07-.12-.26-.19-.54-.33Z"/></svg>
    </a>
    <button class="scroll-top" type="button" aria-label="Subir al inicio">↑</button>

    <script src="assets/js/main.js"></script>
</body>
</html>
