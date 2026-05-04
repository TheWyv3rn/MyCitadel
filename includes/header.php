<?php
// Dynamic SEO & Meta Configuration with Fallbacks
$siteName = "MyCitadel";
$pageTitle = isset($pageTitle) ? "$pageTitle | $siteName" : "$siteName | Zero-Knowledge Operations";
$pageDescription = isset($pageDescription) ? $pageDescription : "A privacy-first, near zero-knowledge social media platform engineered for absolute security.";
$pageKeywords = isset($pageKeywords) ? $pageKeywords : "zero-knowledge, privacy, social media, cybersecurity, encryption, MyCitadel";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <!-- Responsive & Adaptive Viewport Control -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- Dynamic SEO Meta Tags -->
    <meta name="description" content="<?php echo htmlspecialchars($pageDescription); ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars($pageKeywords); ?>">
    <meta name="author" content="TheWyv3rn | MyCitadel Operations">
    
    <!-- Open Graph (Social Media Embedding) Meta Tags -->
    <meta property="og:title" content="<?php echo htmlspecialchars($pageTitle); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($pageDescription); ?>">
    <meta property="og:type" content="website">

    <!-- Dynamic Page Title -->
    <title><?php echo htmlspecialchars($pageTitle); ?></title>
    
    <!-- ==========================================
         VENDOR INTEGRATIONS 
         (Loaded in strict order for dependencies)
    =========================================== -->
    <!-- Bootstrap 5.2.3 (Core Grid & Responsive Framework) -->
    <link rel="stylesheet" href="assets/vendor/bootstrap-5.2.3-dist/css/bootstrap.min.css">
    
    <!-- Animate.css (Micro-interactions & loading animations) -->
    <link rel="stylesheet" href="assets/vendor/animate.css-main/animate.min.css">
    
    <!-- FontAwesome 5.15.4 (Iconography) -->
    <link rel="stylesheet" href="assets/vendor/fontawesome-free-5.15.4-web/css/all.min.css">
    
    <!-- ==========================================
         CUSTOM STYLES
         (Loaded last to override vendor defaults)
    =========================================== -->
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>

    <!-- Dynamic Navigation System Injection -->
    <?php include_once 'includes/nav.php'; ?>

    <!-- Start Main Content Container -->
    <main class="container" style="min-height: 60vh;">