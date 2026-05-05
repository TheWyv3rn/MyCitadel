<?php
/**
 * PROJECT: MY CITADEL
 * MODULE: GLOBAL i18n ENGINE (V2.0)
 * DESCRIPTION: Supports 18 global languages with RTL detection and dynamic JSON loading.
 * AUTHOR: THE WYVERN & GEMINI
 */

declare(strict_types=1);

/**
 * The Master Language Matrix
 * Returns an array of supported ISO codes and their corresponding flags.
 */
function get_citadel_languages(): array {
    return [
        'en' => '🇺🇸', // English
        'zh' => '🇨🇳', // Mandarin Chinese
        'es' => '🇪🇸', // Spanish
        'ar' => '🇸🇦', // Arabic (RTL)
        'ru' => '🇷🇺', // Russian
        'hi' => '🇮🇳', // Hindi
        'bn' => '🇧🇩', // Bengali
        'pt' => '🇵🇹', // Portuguese
        'ja' => '🇯🇵', // Japanese
        'fr' => '🇫🇷', // French
        'de' => '🇩🇪', // German
        'ko' => '🇰🇷', // Korean
        'it' => '🇮🇹', // Italian
        'tr' => '🇹🇷', // Turkish
        'vi' => '🇻🇳', // Vietnamese
        'pl' => '🇵🇱', // Polish
        'id' => '🇮🇩', // Indonesian
        'nl' => '🇳🇱'  // Dutch
    ];
}

/**
 * RTL Detection Logic
 * Determines if the UI direction should flip for Right-to-Left scripts.
 */
function is_rtl(string $lang): bool {
    $rtl_langs = ['ar', 'fa', 'he', 'ur'];
    return in_array($lang, $rtl_langs);
}

/**
 * Load Active JSON Strings
 * Fetches data from /includes/lang/{code}.json with a secure fallback.
 */
function load_citadel_strings(string $lang): array {
    $safe_lang = preg_replace('/[^a-z]/', '', strtolower($lang));
    $base_path = defined('BASE_PATH') ? BASE_PATH : dirname(__DIR__, 1);
    
    $file_path = $base_path . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'lang' . DIRECTORY_SEPARATOR . "{$safe_lang}.json";
    $fallback_path = $base_path . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'lang' . DIRECTORY_SEPARATOR . "en.json";

    if (file_exists($file_path)) {
        $json = file_get_contents($file_path);
    } elseif (file_exists($fallback_path)) {
        $json = file_get_contents($fallback_path);
    } else {
        return [];
    }

    return json_decode($json, true) ?? [];
}

/**
 * Handle Language Switch Request
 * Detects ?lang= request and persists to session.
 */
if (isset($_GET['lang'])) {
    $available = get_citadel_languages();
    $request_lang = preg_replace('/[^a-z]/', '', strtolower($_GET['lang']));

    if (array_key_exists($request_lang, $available)) {
        $_SESSION['citadel_lang'] = $request_lang;
        
        // Clean the URL and redirect
        $clean_url = strtok($_SERVER['REQUEST_URI'], '?');
        if (!headers_sent()) {
            header("Location: $clean_url", true, 302);
            exit;
        }
    }
}

// Prepare Global Telemetry & Strings for the request
$active_lang     = $_SESSION['citadel_lang'] ?? 'en';
$citadel_strings = load_citadel_strings($active_lang);
$citadel_flags   = get_citadel_languages();
$is_rtl_mode     = is_rtl($active_lang);

/**
 * The Global Translation Helper (__t)
 * Accesses the loaded JSON strings with tiered fallback logic.
 */
if (!function_exists('__t')) {
    function __t(string $page, string $key): string {
        global $citadel_strings;
        
        if (!is_array($citadel_strings)) {
            return "[[SYS_ERR: INTEL_NOT_LOADED]]";
        }

        // Tiered lookup: Page Specific -> Global -> Missing Tag
        return $citadel_strings[$page][$key] ?? $citadel_strings['global'][$key] ?? "[[MISSING_{$key}]]";
    }
}