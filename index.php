<?php
/**
 * PROJECT: MY CITADEL
 * MODULE: INDEX GATEWAY (COMMAND CENTER)
 * VERSION: 1.2.0 (PHP 8.2+ Highly Optimized)
 * DESCRIPTION: The primary landing interface. Integrates particles.js, 
 * multi-lingual hero sections, and real-time security status.
 */

declare(strict_types=1);

// 1. Initialize the Gateway (Meta, Tracking, i18n, Vendor CSS)
require_once __DIR__ . '/includes/header.php';

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
?>

<!-- [PARTICLES BACKGROUND CONTAINER] -->
<div id="particles-js" style="position: fixed; width: 100%; height: 100%; top: 0; left: 0; z-index: -1; pointer-events: none;"></div>

<div class="container position-relative">
    
    <!-- [HERO SECTION: THE INITIALIZATION] -->
    <section class="row align-items-center min-vh-100 py-5">
        <div class="col-lg-7 col-md-12 animate__animated animate__fadeInLeft">
            
            <div class="mb-4">
                <span class="data-stream stencil-text" style="font-size: 0.8rem;">
                    <i class="fas fa-terminal"></i> <?php echo __t('index', 'session'); ?>: <?php echo $tracking_data['esid']; ?>
                </span>
            </div>

            <h1 class="glowing-title display-2 stencil-text mb-3">
                <?php echo __t('index', 'hero1'); ?>
            </h1>
            
            <p class="lead text-secondary mb-5 border-left border-neon-blue pl-4" style="max-width: 600px;">
                <?php echo __t('index', 'sub_hero'); ?>
                <br>
                <span class="text-alien-green small italic mt-2 d-block">
                    // <?php echo __t('global', 'online_status'); ?>
                </span>
            </p>

            <div class="d-flex flex-wrap gap-4 align-items-center">
                <a href="register.php" class="btn-cyber btn-lg px-5">
                    <i class="fas fa-fingerprint mr-2"></i> <?php echo __t('index', 'cta'); ?>
                </a>
                
                <a href="about.php" class="glitch-link text-uppercase font-weight-bold ml-lg-3">
                    <i class="fas fa-project-diagram mr-2"></i> <?php echo __t('index', 'viewProtocols'); ?>
                </a>
            </div>

            <div class="mt-5 d-flex align-items-center animate__animated animate__fadeInUp animate__delay-1s">
                <div class="mr-4 text-center">
                    <h4 class="text-neon-blue mb-0"><?php echo __t('index', '256'); ?></h4>
                    <small class="text-secondary uppercase"><?php echo __t('index', 'encryption'); ?></small>
                </div>
                <div class="mr-4 text-center border-left border-dark pl-4">
                    <h4 class="text-alien-green mb-0"><?php echo __t('index', 'zkp'); ?></h4>
                    <small class="text-secondary uppercase"><?php echo __t('index', 'protocol'); ?></small>
                </div>
                <div class="text-center border-left border-dark pl-4">
                    <h4 class="text-space-purple mb-0">100%</h4>
                    <small class="text-secondary uppercase"><?php echo __t('index', 'sovereign'); ?></small>
                </div>
            </div>
        </div>

        <!-- [RIGHT COLUMN: THE CORE VISUAL] -->
        <div class="col-lg-5 d-none d-lg-block text-center animate__animated animate__zoomIn">
            <div class="position-relative">
                <!-- Floating Logo/Image with Neon Ring -->
                <div class="citadel-orb-container">
                    <img src="citadel.jpeg" alt="Citadel Core" class="img-fluid rounded-circle shadow-lg animate-float" style="border: 4px solid var(--neon-blue); padding: 10px; background: rgba(0, 242, 255, 0.1);">
                    <div class="rotating-ring"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- [FEATURE SECTION: THE TRIAD] -->
    <section class="row g-4 pb-5">
        <div class="col-md-4 animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
            <div class="citadel-card h-100">
                <div class="icon-box mb-3 text-neon-blue">
                    <i class="fas fa-user-shield fa-2x"></i>
                </div>
                <h3 class="stencil-text h5"><?php echo __t('index', 'pf'); ?></h3>
                <p class="text-secondary small">
                    <?php echo __t('index', 'pfd'); ?>
                </p>
                <div class="mt-3">
                    <span class="badge bg-dark text-neon-blue border border-neon-blue"><?php echo __t('index', 'enc'); ?></span>
                </div>
            </div>
        </div>

        <div class="col-md-4 animate__animated animate__fadeInUp" style="animation-delay: 0.4s;">
            <div class="citadel-card h-100">
                <div class="icon-box mb-3 text-alien-green">
                    <i class="fas fa-lock fa-2x"></i>
                </div>
                <h3 class="stencil-text h5"><?php echo __t('index', 'cszkp'); ?></h3>
                <p class="text-secondary small">
                    <?php echo __t('index', 'cszkpd'); ?>
                </p>
                <div class="mt-3">
                    <span class="badge bg-dark text-alien-green border border-alien-green"><?php echo __t('index', 'sa'); ?></span>
                </div>
            </div>
        </div>

        <div class="col-md-4 animate__animated animate__fadeInUp" style="animation-delay: 0.6s;">
            <div class="citadel-card h-100">
                <div class="icon-box mb-3 text-space-purple">
                    <i class="fas fa-satellite fa-2x"></i>
                </div>
                <h3 class="stencil-text h5"><?php echo __t('index', 'dr'); ?></h3>
                <p class="text-secondary small">
                    <?php echo __t('index', 'drd'); ?>
                </p>
                <div class="mt-3">
                    <span class="badge bg-dark text-space-purple border border-space-purple"><?php echo __t('index', 'pr'); ?></span>
                </div>
            </div>
        </div>
    </section>

</div>

<!-- [PARTICLES INITIALIZATION] -->
<script src="assets/vendor/particles.js-master/particles.min.js"></script>
<script>
    /* Citadel Particles Config */
    particlesJS('particles-js', {
        "particles": {
            "number": { "value": 80, "density": { "enable": true, "value_area": 800 } },
            "color": { "value": "#00f2ff" },
            "shape": { "type": "circle" },
            "opacity": { "value": 0.2, "random": false },
            "size": { "value": 3, "random": true },
            "line_linked": { "enable": true, "distance": 150, "color": "#00f2ff", "opacity": 0.1, "width": 1 },
            "move": { "enable": true, "speed": 2, "direction": "none", "random": false, "straight": false, "out_mode": "out", "bounce": false }
        },
        "interactivity": {
            "detect_on": "canvas",
            "events": { "onhover": { "enable": true, "mode": "grab" }, "onclick": { "enable": true, "mode": "push" }, "resize": true }
        },
        "retina_detect": true
    });
</script>

<style>
    /* Page-Specific Cyberpunk Visuals */
    .citadel-orb-container {
        position: relative;
        display: inline-block;
    }
    .rotating-ring {
        position: absolute;
        top: -10px;
        left: -10px;
        right: -10px;
        bottom: -10px;
        border: 2px dashed var(--neon-blue);
        border-radius: 50%;
        animation: spin 20s linear infinite;
        opacity: 0.3;
    }
    @keyframes spin { 100% { transform: rotate(360deg); } }
    
    .border-neon-blue { border-color: var(--neon-blue) !important; }
    .min-vh-75 { min-height: 75vh; }
    .pl-4 { padding-left: 1.5rem !important; }
</style>

<?php
// 2. Finalize with System Intelligence Dashboard (Footer)
require_once __DIR__ . '/includes/footer.php';
?>