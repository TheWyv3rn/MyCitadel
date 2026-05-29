<?php
/**
 * PROJECT: MY CITADEL (NEAR-ZERO-KNOWLEDGE SOCIAL ECOSYSTEM)
 * COMPONENT: CORE HEADER & SECURITY BOOTSTRAPPER
 * VERSION: 1.2.0
 * DESCRIPTION: Handles secure sessions, automated security headers, 
 * smart sub-directory isolation routing, and RTL/LTR internationalization.
 */

// ----------------==================================================
// 1. HARDENED SESSION & SECURITY HEADERS
// ----------------==================================================
if (session_status() === PHP_SESSION_NONE) {
    ini_set('session.cookie_httponly', 1);  
    ini_set('session.use_only_cookies', 1);  
    ini_set('session.cookie_samesite', 'Strict'); 
    
    if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') {
        ini_set('session.cookie_secure', 1);
    }
    session_start();
}

// HTTP Defensive Security Headers
header("X-Frame-Options: DENY"); 
header("X-Content-Type-Options: nosniff"); 
header("X-XSS-Protection: 1; mode=block"); 
header("Referrer-Policy: strict-origin-when-cross-origin"); 

// Adjusted Content Security Policy (CSP)
$csp_policy = "default-src 'self'; " .
              "script-src 'self' 'unsafe-inline' 'unsafe-eval' blob:; " . 
              "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; " .
              "font-src 'self' data: https://fonts.gstatic.com; " .
              "img-src 'self' data: blob:; " .
              "connect-src 'self';";
header("Content-Security-Policy: " . $csp_policy);

// ----------------==================================================
// 2. DYNAMIC PATH ROUTING (DIRECTORIZATION FIX)
// --------------------------------==================================
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
$host = $_SERVER['HTTP_HOST'];

// Smart Subdirectory Resolver: Computes the variance between document root and app root
$docRoot = str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']);
$appRoot = str_replace('\\', '/', realpath(__DIR__ . '/..'));
$subDir  = trim(str_replace($docRoot, '', $appRoot), '/');

// Absolute base URL that perfectly preserves subdirectories if they exist
define('SITE_ROOT_URL', $protocol . $host . '/' . ($subDir ? $subDir . '/' : ''));

// ----------------==================================================
// 3. CORE SUBSYSTEM & GLOBAL LOCALE LOADING
// --------------------------------==================================
require_once __DIR__ . '/cookies.php';

// Include the localized dictionary module if accessible
if (file_exists(__DIR__ . '/../assets/language_module.php')) {
    require_once __DIR__ . '/../assets/language_module.php';
} else {
    // Structural Fallback: Syncs signature precisely with the JSON lazy-loader engine
    if (!function_exists('__t')) {
        function __t($section, $key) {
            $fallbacks = [
                'home'             => 'Home Portal', 
                'about'            => 'System Intel', 
                'privacy_data'     => 'Privacy & Data',
                'terms_conditions' => 'Terms of Protocol', 
                'security_act'     => 'Security & Privacy Act',
                'nzk_ops'          => 'Near Zero-Knowledge', 
                'login'            => 'Login', 
                'register'         => 'Register Terminal',
                'lang_select'      => 'Interface Lang'
            ];
            return $fallbacks[$key] ?? "[{$key}]";
        }
    }
}

// Extract the active persistent language locale state now locked into the session context
$current_lang = $_SESSION['lang'] ?? 'en';

// Define layout metrics for bidirectional text flow targets (Arabic & Urdu)
$rtl_languages = ['ar', 'ur']; 
$text_direction = in_array($current_lang, $rtl_languages) ? 'rtl' : 'ltr';

// ----------------==================================================
// 4. DYNAMIC SEO & META HOOKS
// --------------------------------==================================
$seo_title    = isset($page_title) ? htmlspecialchars($page_title) . " | My Citadel" : "My Citadel | Near-Zero-Knowledge Ecosystem";
$seo_desc     = isset($page_desc) ? htmlspecialchars($page_desc) : "The ultimate encrypted, trackers-free, decentralized-focused social media network.";
$seo_keywords = isset($page_keywords) ? htmlspecialchars($page_keywords) : "privacy, encrypted social media, zero knowledge";
?>
<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars($current_lang); ?>" dir="<?php echo $text_direction; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title><?php echo $seo_title; ?></title>
    <meta name="description" content="<?php echo $seo_desc; ?>">
    <meta name="keywords" content="<?php echo $seo_keywords; ?>">
    <meta name="author" content="The Wyvern & Valhalla Security Labs">
    
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php echo $seo_title; ?>">
    <meta property="og:description" content="<?php echo $seo_desc; ?>">
    <meta property="og:url" content="<?php echo $protocol . $host . $_SERVER['REQUEST_URI']; ?>">
    <meta property="og:site_name" content="My Citadel">

    <!-- Forces relative file tracking assets to stream out of the site root directory mapping boundary -->
    <base href="<?php echo SITE_ROOT_URL; ?>">

    <!-- Main Stylesheet Infrastructure -->
    <link rel="stylesheet" href="assets/css/main.css">
    
    <!-- Vendor Engine Assets -->
    <link rel="stylesheet" href="assets/vendor/fontawesome-free-5.15.4-web/css/all.min.css">
    <link rel="stylesheet" href="assets/vendor/animate.css-main/animate.min.css">
</head>
<body class="citadel-hud-body">
    
    <div id="particles-js"></div>

    <div class="citadel-main-viewport">