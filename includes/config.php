<?php
/**
 * PROJECT: MY CITADEL
 * MODULE: CORE CONFIGURATION
 * DESCRIPTION: Path resolution and session initialization.
 */

declare(strict_types=1);

if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params(['lifetime' => 0, 'path' => '/', 'secure' => true, 'httponly' => true, 'samesite' => 'Strict']);
    session_start();
}

// Detect Subdirectory (e.g., /mycitadel)
$base_dir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
if ($base_dir === '/' || $base_dir === '\\') { $base_dir = ''; }
// Remove trailing slashes if they exist
$base_dir = rtrim($base_dir, '/');

define('SITE_URL', $base_dir);
define('BASE_PATH', dirname(__DIR__));
define('ASSETS_URL', SITE_URL . '/assets');
define('VENDOR_URL', ASSETS_URL . '/vendor');

// Load Modules in Order
require_once __DIR__ . '/translation.php';
require_once __DIR__ . '/cookies.php';

function set_security_headers(): void {
    header("X-Content-Type-Options: nosniff");
    header("X-Frame-Options: DENY");
    header("X-XSS-Protection: 1; mode=block");
}

function get_page_metadata(string $filename): array {
    $base = ['title' => 'MyCitadel | Secure Network', 'desc' => 'Near Zero Knowledge social platform.', 'keys' => 'privacy, encryption, secure'];
    $pages = ['index.php' => ['title' => 'MyCitadel - Secure Entry']];
    return array_merge($base, $pages[$filename] ?? []);
}