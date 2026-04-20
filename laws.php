<?php
/**
 * MyCitadel - Sovereign Laws (Terms of Service)
 * Sector: Legislative Authority v1.1
 * Tone: Mayoral / Authoritative / Protective
 */

require_once __DIR__ . '/../private/citadel_config.php';

$page_title = __t('nav', 'laws');
require_once __DIR__ . '/1nclud3z/h34d3r.php'; 
?>

<!-- HUD Background -->
<div id="particles-js" class="position-fixed w-100 h-100" style="z-index: 1; pointer-events: none;"></div>

<div class="container position-relative py-5" style="z-index: 2; background-color: rgba(0,0,0,0.7);">
    
    <!-- HEADER: MAYORAL DECREE -->
    <header class="text-center mb-5 animate__animated animate__fadeIn">
        <div class="telemetry-box d-inline-block px-4 mb-3 border-primary">
            <span class="text-primary fw-bold">[ <?php echo __t('laws', 'status_label'); ?>: ]</span> 
            <span class="text-glow text-uppercase"><?php echo __t('laws', 'status_active'); ?></span>
        </div>
        <h1 class="display-4 fw-bold citadel-brand mt-2"><?php echo __t('laws', 'title'); ?></h1>
        <p class="text-muted font-data uppercase tracking-widest"><?php echo __t('laws', 'subtitle'); ?></p>
        <div class="d-flex justify-content-center gap-2 mt-4">
            <span class="badge bg-primary text-black px-3 font-mono"><?php echo __t('laws', 'law_id'); ?></span>
            <span class="badge border border-primary text-primary px-3 font-mono"><?php echo __t('laws', 'law_version'); ?></span>
        </div>
    </header>

    <!-- THE SOCIAL CONTRACT (PREAMBLE) -->
    <div class="hud-panel p-5 mb-5 border-primary animate__animated animate__fadeInUp shadow-glow">
        <div class="row align-items-center">
            <div class="col-lg-1 text-center d-none d-lg-block">
                <i class="fas fa-scroll text-primary fa-3x"></i>
            </div>
            <div class="col-lg-11">
                <h4 class="text-primary font-header mb-3"><?php echo __t('laws', 'preamble_title'); ?></h4>
                <p class="lead italic text-light mb-0">
                    <?php echo __t('laws', 'preamble_text'); ?>
                </p>
            </div>
        </div>
    </div>

    <!-- TIER 1: THE MAJOR DIRECTIVES (PURGE-LEVEL) -->
    <section class="mb-5">
        <div class="d-flex align-items-center mb-4">
            <div class="h3 text-danger font-header border-bottom border-danger pb-2 flex-grow-1">
                <span class="badge bg-danger text-black me-2">LEVEL_01</span> <?php echo __t('laws', 'major_laws_header'); ?>
            </div>
        </div>
        <div class="row g-4">
            <?php for($i=1; $i<=3; $i++): ?>
            <div class="col-lg-4">
                <div class="hud-panel p-4 h-100 border-danger bg-danger-subtle-10 hover-lift">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h5 class="text-danger uppercase font-data"><?php echo __t('laws', 'directives'); ?><?php echo $i; ?></h5>
                        <i class="fas fa-skull-crossbones text-danger"></i>
                    </div>
                    <h6 class="text-white mb-2"><?php echo __t('laws', "major_law_{$i}_title"); ?></h6>
                    <p class="small text-muted mb-0"><?php echo __t('laws', "major_law_{$i}_desc"); ?></p>
                </div>
            </div>
            <?php endfor; ?>
        </div>
    </section>

    <!-- THE SENTINEL: AI ENFORCEMENT -->
    <section class="hud-panel p-5 mb-5 border-info animate__animated animate__pulse animate__infinite animate__slow" style="--animate-duration: 6s;">
        <div class="row align-items-center">
            <div class="col-lg-3 text-center mb-4 mb-lg-0">
                <div class="position-relative d-inline-block">
                    <i class="fas fa-robot text-info fa-6x"></i>
                    <div class="position-absolute top-50 start-50 translate-middle">
                        <div class="spinner-grow text-info" role="status" style="width: 5rem; height: 5rem; opacity: 0.3;"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <h3 class="text-info font-header mb-3"><?php echo __t('laws', 'ai_sentinel_title'); ?></h3>
                <div class="telemetry-box p-3 mb-4 bg-dark border-info">
                    <div class="row font-mono x-small">
                        <div class="col-md-6 text-info">
                            > <?php echo __t('laws', 'scan_method'); ?><br>
                            > <?php echo __t('laws', 'targets'); ?>
                        </div>
                        <div class="col-md-6 text-info text-md-end">
                            > <?php echo __t('laws', 'privacy_stance'); ?><br>
                            > <?php echo __t('laws', 'latency'); ?> < 15ms
                        </div>
                    </div>
                </div>
                <p class="text-light">
                    <?php echo __t('laws', 'ai_sentinel_desc'); ?>
                </p>
                <div class="row mt-4 g-3">
                    <div class="col-md-6">
                        <div class="p-3 border border-warning rounded d-flex align-items-center">
                            <i class="fas fa-bolt text-warning me-3"></i>
                            <div>
                                <div class="text-warning fw-bold small"><?php echo __t('laws', 'infraction'); ?></div>
                                <div class="text-white x-small"><?php echo __t('laws', 'total_purge'); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 border border-danger rounded d-flex align-items-center">
                            <i class="fas fa-fire text-danger me-3"></i>
                            <div>
                                <div class="text-danger fw-bold small"><?php echo __t('laws', 'account_purge'); ?></div>
                                <div class="text-white x-small"><?php echo __t('laws', 'account_liquidation'); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- TIER 2: COMMUNITY CONDUCT (THE AGORA) -->
    <section class="mb-5">
        <div class="h3 text-primary font-header border-bottom border-secondary pb-2 mb-4">
            <span class="badge bg-primary text-black me-2"><?php echo __t('laws', 'lvl2'); ?></span> <?php echo __t('laws', 'secondary_laws_header'); ?>
        </div>
        <div class="row g-4">
            <?php for($i=1; $i<=3; $i++): ?>
            <div class="col-md-4">
                <div class="hud-panel p-4 h-100 hover-lift border-primary">
                    <h6 class="text-primary font-data uppercase mb-3"><?php echo __t('laws', "sec_law_{$i}_title"); ?></h6>
                    <p class="small text-muted mb-0"><?php echo __t('laws', "sec_law_{$i}_desc"); ?></p>
                </div>
            </div>
            <?php endfor; ?>
        </div>
    </section>

    <!-- PRECAUTIONS & FAIR WARNING -->
    <div class="row g-4 mb-5">
        <div class="col-lg-6">
            <div class="hud-panel p-4 border-warning h-100">
                <h5 class="text-warning mb-3 uppercase font-header"><i class="fas fa-exclamation-triangle me-2"></i><?php echo __t('laws', 'precaution_header'); ?></h5>
                <ul class="list-unstyled small text-muted">
                    <li class="mb-3 d-flex">
                        <i class="fas fa-caret-right text-warning me-2 mt-1"></i>
                        <span><?php echo __t('laws', 'precaution_1'); ?></span>
                    </li>
                    <li class="mb-3 d-flex">
                        <i class="fas fa-caret-right text-warning me-2 mt-1"></i>
                        <span><?php echo __t('laws', 'precaution_2'); ?></span>
                    </li>
                    <li class="d-flex">
                        <i class="fas fa-caret-right text-warning me-2 mt-1"></i>
                        <span><?php echo __t('laws', 'precaution_3'); ?></span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="hud-panel p-4 border-info h-100 bg-info-subtle-10">
                <h5 class="text-info mb-3 uppercase font-header"><i class="fas fa-balance-scale me-2"></i><?php echo __t('laws', 'fair_warning_header'); ?></h5>
                <p class="small text-light italic">
                    <?php echo __t('laws', 'fair_warning_text'); ?>
                </p>
                <div class="telemetry-box mt-3 text-center p-2 x-small font-mono text-info">
                    <?php echo __t('laws', 'decree_hash'); ?>: <?php echo hash('crc32b', 'SOVEREIGN_CITADEL_LAW_v1.1'); ?>
                </div>
            </div>
        </div>
    </div>

</div>

<?php 
$load_assets = ['particles'];
require_once __DIR__ . '/1nclud3z/f0073r.php'; 
?>