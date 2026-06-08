<?php
$admin_title = 'Configuración del sitio';
$site = require __DIR__ . '/../config/site.php';
require __DIR__ . '/includes/admin-header.php';
?>
<div class="card">
    <h3>Información general</h3>
    <p class="notice">Aquí luego se editará el contacto, redes sociales, logo, horario, ubicación y textos principales.</p>
    <form class="form-grid" id="admin-form">
        <div class="field"><label>Nombre de la empresa</label><input value="<?= htmlspecialchars($site['brand']) ?>"></div>
        <div class="field"><label>Eslogan</label><input value="<?= htmlspecialchars($site['slogan']) ?>"></div>
        <div class="field"><label>WhatsApp</label><input value="<?= htmlspecialchars($site['whatsapp']) ?>"></div>
        <div class="field"><label>Correo</label><input placeholder="Pendiente de confirmar"></div>
        <div class="field field--full"><label>Ubicación</label><input placeholder="Pendiente de confirmar"></div>
        <div class="field"><label>Facebook</label><input placeholder="URL de Facebook"></div>
        <div class="field"><label>TikTok</label><input placeholder="URL de TikTok"></div>
        <div class="field field--full"><label>SEO / Palabras clave</label><textarea rows="4"><?= htmlspecialchars($site['seo_keywords']) ?></textarea></div>
        <button class="btn" type="button">Guardar configuración</button>
    </form>
</div>
<?php require __DIR__ . '/includes/admin-footer.php'; ?>
