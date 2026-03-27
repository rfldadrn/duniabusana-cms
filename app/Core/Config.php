<?php

define('BASE_URL', '');
// define('ALTERNATE_BASE_URL', '/Template_App/new/public');
define('ALTERNATE_BASE_URL', 
    isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 
        'https://' : 
        'http://' . $_SERVER['HTTP_HOST']);
define('BASE_PATH','/app/public');
define('DB_HOST', 'localhost');
define('DB_NAME', 'db_template');
define('DB_USER', 'admindubus');
define('DB_PASS', 'dubus1999');
define('APP_NAME', 'Template Management Systems');
define('APP_TITLE', 'Template Apps');
define('APP_VERSION', '1.0.0');
define('ITEMS_PER_PAGE', 10);
define('SESSION_TIMEOUT', 1800); // 30 minutes
define('ENABLE_DEBUG', true);
define('LOG_FILE_PATH', __DIR__ . '/../../logs/app.log');
define('DEFAULT_LANGUAGE', 'en');
define('SUPPORTED_LANGUAGES', ['en', 'id', 'es']);
define('TIMEZONE', 'Asia/Jakarta');
date_default_timezone_set(TIMEZONE);
define('PASSWORD_SALT', 's3cr3tS@ltV@lu3');
define('MAX_UPLOAD_SIZE', 2 * 1024 * 1024); // 2 MB
define('ALLOWED_FILE_TYPES', ['image/jpeg', 'image/png', 'application/pdf']);
define('CACHE_ENABLED', true);
define('CACHE_DURATION', 300); // 5 minutes
define('API_RATE_LIMIT', 100); // requests per hour
define('EMAIL_FROM_ADDRESS', 'no-reply@template_app.com');
define('EMAIL_FROM_NAME', 'Template Management System');
define('SMTP_HOST', 'smtp.template_app.com');
define('SMTP_PORT', 587);
define('SMTP_USER', 'smtp_user');
define('SMTP_PASS', 'smtp_password');
define('RECAPTCHA_SITE_KEY', 'your_site_key_here');
define('RECAPTCHA_SECRET_KEY', 'your_secret_key_here');
define('MAINTENANCE_MODE', false);
define('MAINTENANCE_MESSAGE', 'The site is currently under maintenance. Please check back later.');
define('PASSWORD_DEFAULT_APP', 'userapp123');
?>
