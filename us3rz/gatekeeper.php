<?php
/**
 * MYCITADEL // SOVEREIGN MEDIA PROXY v1.1
 * Sector: Subterranean Vault Proxy
 * Logic: Absolute pathing to prevent Errno 150/Pathing failures.
 */

require_once __DIR__ . '/../../private/citadel_config.php';
if (session_status() === PHP_SESSION_NONE) { session_start(); }

// 1. SESSION SHIELD
if (!isset($_SESSION['citizen_id'])) {
    header("HTTP/1.1 403 Forbidden");
    exit;
}

// 2. INPUT SANITIZATION
$type = $_GET['type'] ?? '4v474rz'; 
$id   = (int)($_GET['id'] ?? 0);

// 3. ABSOLUTE SERVER PATHING
// We use the absolute path you provided in your 'ls' output
$base_path = "/home/valhhfkf/mycitadel.lol/us3rz/m3d14/" . $type . "/";
$extensions = ['png', 'jpg', 'jpeg', 'gif', 'webp'];
$found_file = null;

// 4. PROBE FOR CITIZEN-SPECIFIC MEDIA
foreach ($extensions as $ext) {
    $temp_path = $base_path . $id . "." . $ext;
    if (file_exists($temp_path)) {
        $found_file = $temp_path;
        break;
    }
}

// 5. FALLBACK TO YOUR VERIFIED DEFAULTS
if (!$found_file) {
    // Ensuring we match your 'ls' output filenames exactly
    $default_name = ($type === '4v474rz') ? "default_avatar.png" : "default_banner.png";
    $found_file = $base_path . $default_name;
}

// 6. FINAL VERIFICATION & STREAM
if (file_exists($found_file)) {
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime_type = finfo_file($finfo, $found_file);
    finfo_close($finfo);

    header("Content-Type: " . $mime_type);
    header("Content-Length: " . filesize($found_file));
    header("Cache-Control: public, max-age=86400"); // Cache for 24h
    readfile($found_file);
} else {
    // If even the default is missing, the Citadel is breached.
    header("HTTP/1.1 404 Not Found");
}
exit;