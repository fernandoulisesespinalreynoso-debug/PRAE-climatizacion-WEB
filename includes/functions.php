<?php
function e($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

function is_active($file) {
    return basename($_SERVER['PHP_SELF']) === $file ? 'active' : '';
}

function money_rd($amount) {
    if ($amount === null || $amount === '') {
        return 'Consultar';
    }
    return 'RD$' . number_format((float)$amount, 2, '.', ',');
}

function whatsapp_link($phone, $message) {
    return 'https://wa.me/' . preg_replace('/\D+/', '', $phone) . '?text=' . rawurlencode($message);
}
