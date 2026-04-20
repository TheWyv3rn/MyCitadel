<?php
/**
 * MyCitadel - High-Performance Secure Header
 * Architecture: Handshake -> Cookie Logic -> Dynamic Meta -> Asset Injection
 */

// 1. Load the Cookie engine (as we planned)
// 1. SESSION & COOKIE HANDSHAKE (First priority)
require_once __DIR__ . '/c00k13z.php';



// 3. ASSET DEFINITIONS
define('ASSET_PATH', '/4ss37z/v3nd0r/');
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>" class="h-100">
<head>
    <link rel="preconnect" href="<?php echo $_SERVER['HTTP_HOST']; ?>">
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <title><?php echo $page_title ?? 'MyCitadel'; ?> | Security Operations</title>
    <meta name="description" content="<?php echo $meta_desc ?? 'Secure multi-lingual vault and research platform.'; ?>">
    <meta name="keywords" content="<?php echo $meta_keys ?? 'cybersecurity, bug bounty, cree, japanese, encryption'; ?>">
    
    <?php if (isset($no_index) && $no_index): ?>
    <meta name="robots" content="noindex, nofollow">
    <?php endif; ?>

    <link rel="stylesheet" href="<?php echo ASSET_PATH; ?>b007str4p/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo ASSET_PATH; ?>animate.css-main/animate.min.css">
    <link rel="stylesheet" href="<?php echo ASSET_PATH; ?>f0n7_4w3s0m3/css/all.min.css">
    <link rel="stylesheet" href="<?php echo ASSET_PATH; ?>toastify-js-master/src/toastify.css">
    <link rel="stylesheet" href="/4ss37z/css/m41n.css">

    <style>
        @font-face { font-family: 'BJCree'; src: url('<?php echo ASSET_PATH; ?>f0n7z/BJCree-Regular.ttf'); font-display: swap; }
        @font-face { font-family: 'SairaStencil'; src: url('<?php echo ASSET_PATH; ?>f0n7z/SairaStencil-Regular.ttf'); font-display: swap; }
        
        :root {
            --citadel-blue: #00d4ff;
            --citadel-dark: #0a0a0a;
        }

        body { 
            font-family: 'Roboto Mono', 'BJCree', 'MS Gothic', monospace; 
            background-color: var(--citadel-dark);
            color: #e0e0e0;
            overflow-x: hidden;
        }

        .citadel-header-glow {
            box-shadow: 0 4px 15px rgba(0, 212, 255, 0.1);
        }
    </style>

    <script src="<?php echo ASSET_PATH; ?>DOMPurify/dist/purify.min.js"></script>
</head>
<body class="d-flex flex-column h-100 animate__animated animate__fadeIn">

<?php 
// Automatically pull in the Nav logic
if (file_exists(__DIR__ . '/n4v.php')) {
    include_once __DIR__ . '/n4v.php'; 
}
?>

<main class="flex-shrink-0 py-3">