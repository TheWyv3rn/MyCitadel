<?php
/**
 * PROJECT: MY CITADEL
 * COMPONENT: DYNAMIC JSON TRANSLATION ENGINE
 * VERSION: 1.1.0
 * DESCRIPTION: Manages multi-lingual data streams via sandboxed JSON configuration files.
 * Protects against LFI directory traversal via input regex verification.
 */

// 1. CHRONICLE OF THE 15 STRATEGIC GLOBAL TARGET LOCALES (ISO 639-1)
// en (English), zh (Mandarin), hi (Hindi), es (Spanish), fr (French), 
// ar (Arabic), bn (Bengali), pt (Portuguese), ru (Russian), ur (Urdu), 
// id (Indonesian), de (German), ja (Japanese), tr (Turkish), vi (Vietnamese)
$allowed_locales = ['en', 'zh', 'hi', 'es', 'fr', 'ar', 'bn', 'pt', 'ru', 'ur', 'id', 'de', 'ja', 'tr', 'vi'];
$default_locale  = 'en';

// 2. INTERCEPT AND SANITIZE USER METRIC ALTERATIONS
if (isset($_GET['set_lang'])) {
    $requested_lang = strtolower(trim($_GET['set_lang']));
    
    // Hardened Cryptographic Input Sandbox validation
    if (preg_match('/^[a-z]{2}$/', $requested_lang) && in_array($requested_lang, $allowed_locales)) {
        $_SESSION['lang'] = $requested_lang;
    }
    
    // Utilize the pre-computed absolute SITE_ROOT_URL from header.php if available
    $redirect_target = defined('SITE_ROOT_URL') ? SITE_ROOT_URL : './';
    
    // FAIL-SAFE REDIRECTION MATRIX
    if (!headers_sent()) {
        // Mode A: Clean server-side header jump
        header("Location: " . $redirect_target);
        exit();
    } else {
        // Mode B: Client-side layout thread bypass (Prevents the White Screen of Death)
        echo '<script type="text/javascript">window.location.href="' . htmlspecialchars($redirect_target) . '";</script>';
        echo '<noscript><meta http-equiv="refresh" content="0;url=' . htmlspecialchars($redirect_target) . '" /></noscript>';
        exit();
    }
}

// 3. RETRIEVE CURRENT ACTIVE LANGUAGE SECTOR
$current_locale = $_SESSION['lang'] ?? $default_locale;

// Define absolute pathing boundaries for file interaction arrays
$lang_dir = __DIR__ . '/lang/';

// 4. MEMORY STORAGE ENGINE - LAZY LOAD DICTIONARIES ON DEMAND
$active_dictionary  = [];
$fallback_dictionary = [];

/**
 * Helper function to safely fetch and decode JSON objects from storage bounds
 */
function loadLanguageFile($locale, $directory) {
    $target_file = $directory . $locale . '.json';
    if (file_exists($target_file) && is_readable($target_file)) {
        $json_data = file_get_contents($target_file);
        $decoded   = json_decode($json_data, true);
        return (json_last_error() === JSON_ERROR_NONE) ? $decoded : [];
    }
    return [];
}

// Load the target localized package matrix
$active_dictionary = loadLanguageFile($current_locale, $lang_dir);

// If the target asset package is corrupted or missing, fall back to core English parameters
if (empty($active_dictionary) && $current_locale !== 'en') {
    $active_dictionary = loadLanguageFile('en', $lang_dir);
}

// 5. GLOBAL TRANSLATION STRING HOOK
function __t($section, $key) {
    global $active_dictionary, $lang_dir, $fallback_dictionary;
    
    // Check primary active matrix index mapping target
    if (isset($active_dictionary[$section][$key])) {
        return $active_dictionary[$section][$key];
    }
    
    // Hard Fail-Safe: If key isn't found, lazy-load English file to look for a fallback string
    if (empty($fallback_dictionary)) {
        $fallback_dictionary = loadLanguageFile('en', $lang_dir);
    }
    
    if (isset($fallback_dictionary[$section][$key])) {
        return $fallback_dictionary[$section][$key];
    }
    
    // Return terminal logging notification token if totally missing across the board
    return "[MISSING_TOKEN: {$section}.{$key}]";
}