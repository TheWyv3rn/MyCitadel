<?php
/**
 * PROJECT: MY CITADEL
 * MODULE: MASTER CORE (DB & CRYPTO)
 * VERSION: 2.0.2
 * DESCRIPTION: Central hub for DB connectivity and XChaCha20-Poly1305 logic.
 * FIX: Implemented Static Path Resolution for subdirectory support.
 */

declare(strict_types=1);

// 1. Session & Path Security
if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params([
        'lifetime' => 0, 
        'path' => '/', 
        'secure' => true, 
        'httponly' => true, 
        'samesite' => 'Strict'
    ]);
    session_start();
}

// 2. [RELIABLE PATH RESOLUTION]
// We calculate the root relative to this file, not the calling script.
$project_root = str_replace('\\', '/', dirname(__DIR__));
$doc_root     = str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']);
$base_url     = str_replace($doc_root, '', $project_root);

// Format the Web URL correctly
$base_url = '/' . ltrim($base_url, '/');
$base_url = rtrim($base_url, '/');

define('SITE_URL', $base_url);
define('BASE_PATH', $project_root);
define('ASSETS_URL', SITE_URL . '/assets');
define('VENDOR_URL', ASSETS_URL . '/vendor');

// 3. Database Credentials
define('DB_HOST', 'localhost');
define('DB_NAME', 'citadel_core');
define('DB_USER', 'citadel_admin'); 
define('DB_PASS', '3190H4ck3r2026'); 

// 4. System-Level Cryptography (The Pepper)
define('CITADEL_MASTER_KEY', 'f6516f91a9d0a42147daf28cb954cf8457e3afb68787a7469e035b2d4ed27854'); 

/**
 * DATABASE HANDSHAKE (PDO Singleton)
 */
function citadel_db(): PDO {
    static $pdo = null;
    if ($pdo === null) {
        try {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
            $pdo = new PDO($dsn, DB_USER, DB_PASS, [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            die("[CRITICAL_FAILURE]: DATABASE_UNREACHABLE");
        }
    }
    return $pdo;
}

/**
 * ENCRYPTION: XChaCha20-Poly1305
 */
function citadel_encrypt(string $plaintext, string $key = CITADEL_MASTER_KEY): string {
    if (!extension_loaded('sodium')) { die("[SYSTEM_ERROR]: LIBSODIUM_MISSING"); }
    $nonce = random_bytes(SODIUM_CRYPTO_AEAD_XCHACHA20POLY1305_IETF_NPUBBYTES);
    $ciphertext = sodium_crypto_aead_xchacha20poly1305_ietf_encrypt($plaintext, '', $nonce, hex2bin($key));
    return base64_encode($nonce . $ciphertext);
}

/**
 * DECRYPTION: XChaCha20-Poly1305
 */
function citadel_decrypt(string $encrypted_data, string $key = CITADEL_MASTER_KEY): ?string {
    if (!extension_loaded('sodium')) { return null; }
    $decoded = base64_decode($encrypted_data);
    $nonce_len = SODIUM_CRYPTO_AEAD_XCHACHA20POLY1305_IETF_NPUBBYTES;
    $nonce = substr($decoded, 0, $nonce_len);
    $ciphertext = substr($decoded, $nonce_len);
    $plaintext = sodium_crypto_aead_xchacha20poly1305_ietf_decrypt($ciphertext, '', $nonce, hex2bin($key));
    return ($plaintext !== false) ? $plaintext : null;
}

// 5. Load Supporting Modules
require_once __DIR__ . '/translation.php';
require_once __DIR__ . '/cookies.php';

/**
 * Security Headers
 */
function set_security_headers(): void {
    header("X-Content-Type-Options: nosniff");
    header("X-Frame-Options: DENY");
    header("X-XSS-Protection: 1; mode=block");
    header("Content-Security-Policy: default-src 'self' https://cdn.jsdelivr.net; script-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net; style-src 'self' 'unsafe-inline'; img-src 'self' data:;");
}

/**
 * Metadata Registry
 */
function get_page_metadata(string $filename): array {
    $base = ['title' => 'MyCitadel', 'desc' => 'Near Zero-Knowledge Network', 'keys' => 'privacy, security, encrypted'];
    return $base;
}