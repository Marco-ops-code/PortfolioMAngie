<?php
/**
 * Configuration globale — Site artiste Angela Volcimus Louis
 */

declare(strict_types=1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

define('SITE_NAME', 'Angela Volcimus Louis');
define('SITE_SHORT', 'Angela');
define('SITE_TAGLINE', 'La voix entre soul, classique et gospel');
define('SITE_EMAIL', 'booking@angelavolcimuslouis.art');
define('SITE_EMAIL_PRESS', 'press@angelavolcimuslouis.art');
define('SITE_URL', ''); // ex: https://angelavolcimuslouis.art (laisser vide en local)

define('DB_HOST', 'localhost');
define('DB_NAME', 'angela_music');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');

define('ADMIN_USER', 'admin');
// Mot de passe par défaut : Angela2026! — à changer en production
define('ADMIN_PASS_PLAIN', 'Angela2026!');

date_default_timezone_set('Europe/Brussels');
