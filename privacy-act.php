<?php
/**
 * MyCitadel - Citizen Privacy Act of 2026
 * Sector: Privacy Enforcement & NZK Documentation
 * Version: 1.0.0 // GOLD_STANDARD
 */

require_once __DIR__ . '/../private/citadel_config.php';

$page_title = __t('nav', 'privacy_act');
require_once __DIR__ . '/1nclud3z/h34d3r.php'; 
?>

<!-- HUD Background -->
<div id="particles-js" class="position-fixed w-100 h-100" style="z-index: 1; pointer-events: none;"></div>

<div class="container position-relative py-5" style="z-index: 2; background-color: rgba(0,0,0,0.8);">
    
    <!-- HEADER: THE SOCIAL CONTRACT -->
    <header class="text-center mb-5 animate__animated animate__fadeIn">
        <div class="telemetry-box d-inline-block px-4 mb-3 border-info">
            <span class="text-info fw-bold">[ <?php echo __t('privacy', 'protocol_label'); ?>: ]</span> 
            <span class="text-glow text-uppercase"><?php echo __t('privacy', 'nzk_enforced'); ?></span>
        </div>
        <h1 class="display-4 fw-bold citadel-brand mt-2"><?php echo __t('privacy', 'title'); ?></h1>
        <p class="text-muted font-data uppercase tracking-widest"><?php echo __t('privacy', 'subtitle'); ?></p>
        <div class="d-flex justify-content-center gap-2 mt-4">
            <span class="badge bg-info text-black px-3 font-mono">ACT_ID: MC-PRIV-2026-ZK</span>
            <span class="badge border border-info text-info px-3 font-mono">STATUS: IMMUTABLE</span>
        </div>
    </header>

    <!-- ARTICLE I: THE NZK MANDATE -->
    <section class="hud-panel p-5 mb-5 border-info shadow-glow animate__animated animate__fadeInLeft">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h2 class="text-info font-header mb-4">ARTICLE_I: <?php echo __t('privacy', 'art_1_title'); ?></h2>
                <p class="lead text-light mb-4">
                    <?php echo __t('privacy', 'art_1_lead'); ?>
                </p>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="p-3 bg-dark border border-secondary rounded h-100">
                            <h6 class="text-info uppercase font-data small">XChaCha20-Poly1305</h6>
                            <p class="x-small text-muted mb-0"><?php echo __t('privacy', 'art_1_tech_1'); ?></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 bg-dark border border-secondary rounded h-100">
                            <h6 class="text-info uppercase font-data small">Edge_Decryption</h6>
                            <p class="x-small text-muted mb-0"><?php echo __t('privacy', 'art_1_tech_2'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 d-none d-lg-block text-center">
                <i class="fas fa-key text-info fa-8x opacity-25"></i>
            </div>
        </div>
    </section>

    <!-- ARTICLE II: THE ANTI-SURVEILLANCE SHIELD -->
    <div class="row g-4 mb-5">
        <div class="col-lg-6 animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
            <div class="hud-panel p-4 h-100 border-primary">
                <h4 class="text-primary font-header mb-3"><i class="fas fa-user-secret me-2"></i>ARTICLE_II: <?php echo __t('privacy', 'art_2_title'); ?></h4>
                <p class="small text-muted mb-4"><?php echo __t('privacy', 'art_2_text'); ?></p>
                <div class="d-flex flex-wrap gap-2">
                    <span class="badge bg-danger-subtle text-danger border border-danger">NO_GOOGLE_ANALYTICS</span>
                    <span class="badge bg-danger-subtle text-danger border border-danger">NO_META_PIXELS</span>
                    <span class="badge bg-danger-subtle text-danger border border-danger">NO_TRACKING_COOKIES</span>
                    <span class="badge bg-success-subtle text-success border border-success">INTERNAL_HOSTING_ONLY</span>
                </div>
            </div>
        </div>
        <div class="col-lg-6 animate__animated animate__fadeInUp" style="animation-delay: 0.4s;">
            <div class="hud-panel p-4 h-100 border-warning">
                <h4 class="text-warning font-header mb-3"><i class="fas fa-trash-alt me-2"></i>ARTICLE_III: <?php echo __t('privacy', 'art_3_title'); ?></h4>
                <p class="small text-muted mb-4"><?php echo __t('privacy', 'art_3_text'); ?></p>
                <div class="telemetry-box bg-dark p-2 text-center">
                    <span class="text-warning font-mono x-small">RETENTION_POLICY: 0_DAYS_POST_LIQUIDATION</span>
                </div>
            </div>
        </div>
    </div>

    <!-- ARTICLE IV: THE CITIZEN'S BILL OF RIGHTS -->
    <section class="hud-panel p-5 mb-5 border-light animate__animated animate__fadeInUp">
        <h3 class="text-light font-header mb-5 border-bottom border-secondary pb-3">ARTICLE_IV: <?php echo __t('privacy', 'art_4_title'); ?></h3>
        <div class="row g-4">
            <?php 
            $rights = ['access', 'portability', 'destruction', 'anonymity'];
            foreach($rights as $right): ?>
            <div class="col-md-6 col-lg-3">
                <div class="text-center">
                    <div class="h3 text-info mb-3"><i class="fas fa-check-double"></i></div>
                    <h6 class="text-uppercase text-glow font-data small"><?php echo __t('privacy', "right_{$right}_title"); ?></h6>
                    <p class="x-small text-muted"><?php echo __t('privacy', "right_{$right}_desc"); ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- FOOTER: THE OATH -->
    <footer class="text-center animate__animated animate__fadeIn">
        <div class="telemetry-box d-inline-block px-5 py-3">
            <p class="mb-0 text-muted italic small">
                <?php echo __t('privacy', 'mayoral_oath'); ?>
            </p>
            <div class="mt-2 font-mono text-primary x-small">
                SIGNED: <?php echo hash('sha256', 'CITADEL_PRIVACY_VERIFIED_2026'); ?>
            </div>
        </div>
    </footer>

</div>

<?php 
$load_assets = ['particles'];
require_once __DIR__ . '/1nclud3z/f0073r.php'; 
?>