<?php
/**
 * PROJECT: MY CITADEL
 * MODULE: MASTER GLOBAL HEADER (SECURITY-GRADE)
 * VERSION: 1.2.0 (PHP 8.2+)
 * DESCRIPTION: Integrates dynamic SEO, Vendor Assets, i18n, RTL support, and Behavioral Tracking.
 */

declare(strict_types=1);

// 1. Initialize Core Configuration (Includes Sessions, Translations, and Tracking)
require_once __DIR__ . '/config.php';

// 2. Set Active Security Headers (nosniff, XSS, Frame-Options)
set_security_headers();

// 3. Resolve Current Page Context for SEO & Active Nav States
$current_script = $_SERVER['PHP_SELF'];
$current_page   = basename($current_script);

// Handle nested directory tracking (e.g., users/dashboard.php)
if (strpos($current_script, '/users/') !== false) {
    $current_page = 'users/' . $current_page;
}

// 4. Fetch Dynamic Metadata Registry
$meta = get_page_metadata($current_page);

// 5. Access Global Tracking Data (Prepared in cookies.php)
global $tracking_data, $active_lang;

// 6. Determine Document Direction (RTL vs LTR)
$dir = is_rtl($active_lang) ? 'rtl' : 'ltr';
?>
<!DOCTYPE html>
<html lang="<?php echo $active_lang; ?>" dir="<?php echo $dir; ?>" class="no-js">
<head>
    <!-- [SYSTEM ENCODING & VIEWPORT CONTROL] -->
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Viewport locked to prevent UI shifting in high-tech layouts -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    
    <!-- [DYNAMIC SEO META TAGS] -->
    <title><?php echo htmlspecialchars($meta['title']); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($meta['desc']); ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars($meta['keys']); ?>">
    <meta name="author" content="TheWyv3rn">
    
    <!-- [CITADEL SESSION IDENTITY - ESID] -->
    <meta name="citadel-esid" content="<?php echo $tracking_data['esid']; ?>">
    <meta name="citadel-masked-ip" content="<?php echo $tracking_data['masked_ip']; ?>">

    <!-- [OPEN GRAPH / SOCIAL PREVIEWS] -->
    <meta property="og:title" content="<?php echo htmlspecialchars($meta['title']); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($meta['desc']); ?>">
    <meta property="og:image" content="<?php echo SITE_URL; ?>/citadel.jpeg">
    <meta property="og:url" content="<?php echo "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">
    <meta property="og:type" content="website">

    <!-- [FAVICONS & WEBAPP MANIFEST] -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo SITE_URL; ?>/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo SITE_URL; ?>/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo SITE_URL; ?>/favicon-16x16.png">
    <link rel="manifest" href="<?php echo SITE_URL; ?>/site.webmanifest">
    <meta name="theme-color" content="#050505">

    <!-- [DYNAMIC VENDOR CSS ASSET LOADING] -->
    <!-- Bootstrap 5 Selection (RTL vs Standard) -->
    <?php if ($dir === 'rtl'): ?>
        <link rel="stylesheet" href="<?php echo VENDOR_URL; ?>/bootstrap-5.2.3-dist/css/bootstrap.rtl.min.css">
    <?php else: ?>
        <link rel="stylesheet" href="<?php echo VENDOR_URL; ?>/bootstrap-5.2.3-dist/css/bootstrap.min.css">
    <?php endif; ?>

    <!-- Font Awesome 5.15.4 (Free Version) -->
    <link rel="stylesheet" href="<?php echo VENDOR_URL; ?>/fontawesome-free-5.15.4-web/css/all.min.css">
    <!-- Animate.css for entrance/glitch effects -->
    <link rel="stylesheet" href="<?php echo VENDOR_URL; ?>/animate.css-main/animate.min.css">
    <!-- Apex Charts (Visualization) -->
    <link rel="stylesheet" href="<?php echo VENDOR_URL; ?>/apexcharts.js-main/dist/apexcharts.css">
    <!-- Toastify (System Notifications) -->
    <link rel="stylesheet" href="<?php echo VENDOR_URL; ?>/toastify-js-master/src/toastify.css">
    
    <!-- [THE CITADEL CORE THEME] -->
    <!-- Appending filemtime ensures cache-busting during development -->
    <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>/css/main.css?v=<?php echo filemtime(BASE_PATH . '/assets/css/main.css'); ?>">    
    <!-- [CRITICAL PRE-LOADER] -->
    <style>
        /* Prevents Flash of Unstyled Content (FOUC) and ensures smooth entry */
        body { 
            opacity: 0; 
            transition: opacity 0.6s cubic-bezier(0.4, 0, 0.2, 1); 
            background: #050505 !important; 
            overflow-x: hidden;
        }
        body.loaded { opacity: 1; }
        
        /* Tampering Alert Overlay (Controlled by JS) */
        .tamper-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 0, 0, 0.1);
            z-index: 9999;
            pointer-events: none;
            border: 5px solid #ff003c;
        }
        body.tamper-detected .tamper-overlay { display: block; }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

    <!-- Security Overlay for Behavioral Detection -->
    <div class="tamper-overlay"></div>

    <!-- [GLOBAL NAVIGATION COMPONENT] -->
    <?php require_once __DIR__ . '/nav.php'; ?>

    <!-- [MAIN CONTENT WRAPPER] -->
    <!-- Spacing accounts for the fixed glassmorphism navbar -->
    <main class="flex-grow-1 pt-5 mt-5">