<?php
/**
 * MyCitadel - Intelligence Dossier (Deep Intel)
 * Security Clearance: Public / Citizen
 * Architecture: Interactive Dossier / HUD-Visualizer
 */
require_once __DIR__ . '/../private/citadel_config.php';
$page_title = __t('about', 'page_title');
require_once __DIR__ . '/1nclud3z/h34d3r.php';
?>

<div id="particles-js" class="position-fixed w-100 h-100" style="z-index: 1; pointer-events: none;"></div>

<div class="container position-relative py-5" style="z-index: 2;">

    <!-- ============================================================
         SECTION 1: HEADER / HERO
    ============================================================ -->
    <header class="text-center mb-5 animate__animated animate__fadeInDown">
        <div class="telemetry-box d-inline-block px-4 mb-3">
            <span class="text-danger fw-bold"><?php echo __t('about', 'header_warning_label'); ?></span>
            <span class="text-glow"><?php echo __t('about', 'header_warning_value'); ?></span>
        </div>
        <h1 class="display-3 fw-bold citadel-brand mt-3"><?php echo __t('about', 'intel_title'); ?></h1>
        <p class="text-muted font-data fst-italic mt-2">"<?php echo __t('about', 'hero_quote'); ?>"</p>
        <div class="border-bottom border-primary mx-auto mt-3" style="width: 100px; border-width: 4px !important;"></div>
    </header>

    <!-- ============================================================
         SECTION 2: MISSION + LIVE CHART
    ============================================================ -->
    <div class="row g-4 align-items-center mb-5">
        <div class="col-lg-6 animate__animated animate__fadeInLeft">
            <div class="hud-panel p-4 mb-4">
                <h3 class="text-primary mb-3">
                    <i class="fas fa-microchip me-2"></i><?php echo __t('about', 'core_tech_title'); ?>
                </h3>
                <p class="text-secondary"><?php echo __t('about', 'core_tech_desc'); ?></p>
            </div>
            <div class="hud-panel p-4">
                <h3 class="text-primary mb-3">
                    <i class="fas fa-fingerprint me-2"></i><?php echo __t('about', 'privacy_first_title'); ?>
                </h3>
                <p class="text-secondary"><?php echo __t('about', 'privacy_first_desc'); ?></p>
            </div>
        </div>
        <div class="col-lg-6 animate__animated animate__fadeInRight">
            <div class="hud-panel p-4">
                <div class="d-flex justify-content-between mb-3">
                    <small class="text-primary"><?php echo __t('about', 'chart_label_reliability'); ?></small>
                    <small class="text-success"><?php echo __t('about', 'chart_label_nominal'); ?></small>
                </div>
                <div id="aboutRadarChart"></div>
            </div>
        </div>
    </div>

    <!-- ============================================================
         SECTION 3: THREE PILLARS
    ============================================================ -->
    <div class="row g-4 mb-5">
        <div class="col-md-4 animate__animated animate__fadeInUp" style="animation-delay: 0.1s">
            <div class="hud-panel p-4 text-center h-100"
                 data-tippy-content="<?php echo htmlspecialchars(__t('about', 'pillar_global_tip')); ?>">
                <i class="fas fa-globe-americas text-primary fa-3x mb-3"></i>
                <h4 class="text-light"><?php echo __t('about', 'pillar_global_title'); ?></h4>
                <p class="small text-muted"><?php echo __t('about', 'pillar_global_desc'); ?></p>
            </div>
        </div>
        <div class="col-md-4 animate__animated animate__fadeInUp" style="animation-delay: 0.2s">
            <div class="hud-panel p-4 text-center h-100"
                 data-tippy-content="<?php echo htmlspecialchars(__t('about', 'pillar_safety_tip')); ?>">
                <i class="fas fa-user-shield text-primary fa-3x mb-3"></i>
                <h4 class="text-light"><?php echo __t('about', 'pillar_safety_title'); ?></h4>
                <p class="small text-muted"><?php echo __t('about', 'pillar_safety_desc'); ?></p>
            </div>
        </div>
        <div class="col-md-4 animate__animated animate__fadeInUp" style="animation-delay: 0.3s">
            <div class="hud-panel p-4 text-center h-100"
                 data-tippy-content="<?php echo htmlspecialchars(__t('about', 'pillar_open_tip')); ?>">
                <i class="fas fa-code-branch text-primary fa-3x mb-3"></i>
                <h4 class="text-light"><?php echo __t('about', 'pillar_open_title'); ?></h4>
                <p class="small text-muted"><?php echo __t('about', 'pillar_open_desc'); ?></p>
            </div>
        </div>
    </div>

    <!-- ============================================================
         SECTION 4: NEAR ZERO-KNOWLEDGE + GLOBAL NODES
    ============================================================ -->
    <div class="row g-4 mb-5">
        <div class="col-lg-6 animate__animated animate__fadeInLeft">
            <div class="hud-panel p-4 h-100">
                <h4 class="text-primary mb-3 font-header">
                    <i class="fas fa-lock me-2"></i><?php echo __t('about', 'nzk_title'); ?>
                </h4>
                <p class="text-secondary small"><?php echo __t('about', 'nzk_desc'); ?></p>
                <hr class="border-secondary">
                <p class="text-secondary small"><?php echo __t('about', 'nzk_compliance_note'); ?></p>
                <div class="telemetry-box mt-3">
                    <small class="text-glow"><?php echo __t('about', 'nzk_status'); ?></small>
                </div>
            </div>
        </div>
        <div class="col-lg-6 animate__animated animate__fadeInRight">
            <div class="hud-panel p-4 h-100">
                <h4 class="text-primary mb-3 font-header">
                    <i class="fas fa-network-wired me-2"></i><?php echo __t('about', 'global_nodes_title'); ?>
                </h4>
                <p class="text-secondary small"><?php echo __t('about', 'global_nodes_desc'); ?></p>
                <div class="d-flex flex-wrap gap-2 mt-3">
                    <span class="badge bg-dark border border-primary" data-tippy-content="Plains Cree / ᓀᐦᐃᔭᐍᐏᐣ">CREE</span>
                    <span class="badge bg-dark border border-primary" data-tippy-content="中文">ZH</span>
                    <span class="badge bg-dark border border-primary" data-tippy-content="हिन्दी">HI</span>
                    <span class="badge bg-dark border border-primary" data-tippy-content="Español">ES</span>
                    <span class="badge bg-dark border border-primary" data-tippy-content="Français">FR</span>
                    <span class="badge bg-dark border border-primary" data-tippy-content="العربية">AR</span>
                    <span class="badge bg-dark border border-primary" data-tippy-content="বাংলা">BN</span>
                    <span class="badge bg-dark border border-primary" data-tippy-content="Português">PT</span>
                    <span class="badge bg-dark border border-primary" data-tippy-content="Русский">RU</span>
                    <span class="badge bg-dark border border-primary" data-tippy-content="日本語">JA</span>
                    <span class="badge bg-dark border border-primary" data-tippy-content="ਪੰਜਾਬੀ">PA</span>
                    <span class="badge bg-dark border border-primary" data-tippy-content="Deutsch">DE</span>
                    <span class="badge bg-dark border border-primary" data-tippy-content="Basa Jawa">JV</span>
                    <span class="badge bg-dark border border-primary" data-tippy-content="Türkçe">TR</span>
                    <span class="badge bg-dark border border-primary" data-tippy-content="Tiếng Việt">VI</span>
                    <span class="badge bg-dark border border-primary" data-tippy-content="Italiano">IT</span>
                    <span class="badge bg-dark border border-primary" data-tippy-content="فارسی">FA</span>
                    <span class="badge bg-dark border border-primary" data-tippy-content="Kiswahili">SW</span>
                    <span class="badge bg-dark border border-primary" data-tippy-content="Nederlands">NL</span>
                    <span class="badge bg-dark border border-primary" data-tippy-content="Polski">PL</span>
                    <span class="badge bg-dark border border-primary" data-tippy-content="Українська">UK</span>
                    <span class="badge bg-dark border border-primary" data-tippy-content="English">EN</span>
                </div>
                <div class="telemetry-box mt-3">
                    <small class="text-glow"><?php echo __t('about', 'global_nodes_status'); ?></small>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================================
         SECTION 5: WHO IS A CITIZEN OF THE CITADEL?
    ============================================================ -->
    <section class="mb-5 animate__animated animate__fadeIn">
        <div class="hud-panel p-4">
            <h3 class="text-primary mb-4 text-center">
                <i class="fas fa-id-badge me-2"></i><?php echo __t('about', 'citizen_title'); ?>
            </h3>
            <p class="text-secondary text-center mb-4"><?php echo __t('about', 'citizen_intro'); ?></p>
            <div class="row g-4">
                <div class="col-md-3 text-center">
                    <div class="hud-panel p-3 h-100">
                        <i class="fas fa-user-plus text-primary fa-2x mb-2"></i>
                        <h6 class="text-light"><?php echo __t('about', 'citizen_step1_title'); ?></h6>
                        <p class="small text-muted"><?php echo __t('about', 'citizen_step1_desc'); ?></p>
                    </div>
                </div>
                <div class="col-md-3 text-center">
                    <div class="hud-panel p-3 h-100">
                        <i class="fas fa-handshake text-primary fa-2x mb-2"></i>
                        <h6 class="text-light"><?php echo __t('about', 'citizen_step2_title'); ?></h6>
                        <p class="small text-muted"><?php echo __t('about', 'citizen_step2_desc'); ?></p>
                    </div>
                </div>
                <div class="col-md-3 text-center">
                    <div class="hud-panel p-3 h-100">
                        <i class="fas fa-door-open text-primary fa-2x mb-2"></i>
                        <h6 class="text-light"><?php echo __t('about', 'citizen_step3_title'); ?></h6>
                        <p class="small text-muted"><?php echo __t('about', 'citizen_step3_desc'); ?></p>
                    </div>
                </div>
                <div class="col-md-3 text-center">
                    <div class="hud-panel p-3 h-100">
                        <i class="fas fa-user-shield text-primary fa-2x mb-2"></i>
                        <h6 class="text-light"><?php echo __t('about', 'citizen_step4_title'); ?></h6>
                        <p class="small text-muted"><?php echo __t('about', 'citizen_step4_desc'); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================================
         SECTION 6: THE COMPETITIVE GAP (MAIN TABLE)
    ============================================================ -->
    <section class="mb-5 animate__animated animate__fadeIn">
        <div class="hud-panel p-4">
            <h3 class="text-primary mb-2 text-center">
                <i class="fas fa-balance-scale me-2"></i><?php echo __t('about', 'gap_title'); ?>
            </h3>
            <p class="text-muted text-center small mb-4"><?php echo __t('about', 'gap_subtitle'); ?></p>
            <div class="table-responsive">
                <table class="table table-dark table-hover border-secondary small align-middle" id="comparisonTable">
                    <thead>
                        <tr class="text-primary border-bottom border-primary">
                            <th><?php echo __t('about', 'table_col_feature'); ?></th>
                            <th><i class="fab fa-facebook me-1"></i><?php echo __t('about', 'table_col_fb'); ?></th>
                            <th><i class="fab fa-twitter me-1"></i><?php echo __t('about', 'table_col_x'); ?></th>
                            <th><i class="fab fa-instagram me-1"></i><?php echo __t('about', 'table_col_ig'); ?></th>
                            <th><i class="fab fa-reddit me-1"></i><?php echo __t('about', 'table_col_reddit'); ?></th>
                            <th><i class="fab fa-linkedin me-1"></i><?php echo __t('about', 'table_col_li'); ?></th>
                            <th class="text-glow"><i class="fas fa-fort-awesome me-1"></i><?php echo __t('about', 'table_col_citadel'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr data-tippy-content="<?php echo htmlspecialchars(__t('about', 'tip_data_harvest')); ?>">
                            <td class="text-light fw-bold"><?php echo __t('about', 'row_data_harvest'); ?></td>
                            <td class="text-danger"><i class="fas fa-times-circle me-1"></i><?php echo __t('about', 'val_harvest_aggressive'); ?></td>
                            <td class="text-danger"><i class="fas fa-times-circle me-1"></i><?php echo __t('about', 'val_harvest_aggressive'); ?></td>
                            <td class="text-danger"><i class="fas fa-times-circle me-1"></i><?php echo __t('about', 'val_harvest_aggressive'); ?></td>
                            <td class="text-warning"><i class="fas fa-exclamation-circle me-1"></i><?php echo __t('about', 'val_harvest_moderate'); ?></td>
                            <td class="text-danger"><i class="fas fa-times-circle me-1"></i><?php echo __t('about', 'val_harvest_aggressive'); ?></td>
                            <td class="text-success"><i class="fas fa-check-circle me-1"></i><?php echo __t('about', 'val_harvest_zero'); ?></td>
                        </tr>
                        <tr data-tippy-content="<?php echo htmlspecialchars(__t('about', 'tip_geo_track')); ?>">
                            <td class="text-light fw-bold"><?php echo __t('about', 'row_geo_track'); ?></td>
                            <td class="text-danger"><i class="fas fa-times-circle me-1"></i><?php echo __t('about', 'val_geo_realtime'); ?></td>
                            <td class="text-danger"><i class="fas fa-times-circle me-1"></i><?php echo __t('about', 'val_geo_realtime'); ?></td>
                            <td class="text-danger"><i class="fas fa-times-circle me-1"></i><?php echo __t('about', 'val_geo_realtime'); ?></td>
                            <td class="text-warning"><i class="fas fa-exclamation-circle me-1"></i><?php echo __t('about', 'val_geo_partial'); ?></td>
                            <td class="text-danger"><i class="fas fa-times-circle me-1"></i><?php echo __t('about', 'val_geo_realtime'); ?></td>
                            <td class="text-success"><i class="fas fa-check-circle me-1"></i><?php echo __t('about', 'val_geo_none'); ?></td>
                        </tr>
                        <tr data-tippy-content="<?php echo htmlspecialchars(__t('about', 'tip_encryption')); ?>">
                            <td class="text-light fw-bold"><?php echo __t('about', 'row_encryption'); ?></td>
                            <td class="text-warning"><i class="fas fa-exclamation-circle me-1"></i><?php echo __t('about', 'val_enc_transit'); ?></td>
                            <td class="text-warning"><i class="fas fa-exclamation-circle me-1"></i><?php echo __t('about', 'val_enc_transit'); ?></td>
                            <td class="text-warning"><i class="fas fa-exclamation-circle me-1"></i><?php echo __t('about', 'val_enc_transit'); ?></td>
                            <td class="text-warning"><i class="fas fa-exclamation-circle me-1"></i><?php echo __t('about', 'val_enc_transit'); ?></td>
                            <td class="text-warning"><i class="fas fa-exclamation-circle me-1"></i><?php echo __t('about', 'val_enc_transit'); ?></td>
                            <td class="text-success"><i class="fas fa-check-circle me-1"></i><?php echo __t('about', 'val_enc_nearzk'); ?></td>
                        </tr>
                        <tr data-tippy-content="<?php echo htmlspecialchars(__t('about', 'tip_govt')); ?>">
                            <td class="text-light fw-bold"><?php echo __t('about', 'row_govt'); ?></td>
                            <td class="text-danger"><i class="fas fa-times-circle me-1"></i><?php echo __t('about', 'val_govt_backdoor'); ?></td>
                            <td class="text-danger"><i class="fas fa-times-circle me-1"></i><?php echo __t('about', 'val_govt_backdoor'); ?></td>
                            <td class="text-danger"><i class="fas fa-times-circle me-1"></i><?php echo __t('about', 'val_govt_backdoor'); ?></td>
                            <td class="text-warning"><i class="fas fa-exclamation-circle me-1"></i><?php echo __t('about', 'val_govt_partial'); ?></td>
                            <td class="text-danger"><i class="fas fa-times-circle me-1"></i><?php echo __t('about', 'val_govt_backdoor'); ?></td>
                            <td class="text-success"><i class="fas fa-check-circle me-1"></i><?php echo __t('about', 'val_govt_shield'); ?></td>
                        </tr>
                        <tr data-tippy-content="<?php echo htmlspecialchars(__t('about', 'tip_cookies')); ?>">
                            <td class="text-light fw-bold"><?php echo __t('about', 'row_cookies'); ?></td>
                            <td class="text-danger"><i class="fas fa-times-circle me-1"></i><?php echo __t('about', 'val_cookie_3p'); ?></td>
                            <td class="text-danger"><i class="fas fa-times-circle me-1"></i><?php echo __t('about', 'val_cookie_3p'); ?></td>
                            <td class="text-danger"><i class="fas fa-times-circle me-1"></i><?php echo __t('about', 'val_cookie_3p'); ?></td>
                            <td class="text-warning"><i class="fas fa-exclamation-circle me-1"></i><?php echo __t('about', 'val_cookie_minimal'); ?></td>
                            <td class="text-danger"><i class="fas fa-times-circle me-1"></i><?php echo __t('about', 'val_cookie_3p'); ?></td>
                            <td class="text-success"><i class="fas fa-check-circle me-1"></i><?php echo __t('about', 'val_cookie_ghost'); ?></td>
                        </tr>
                        <tr data-tippy-content="<?php echo htmlspecialchars(__t('about', 'tip_ads')); ?>">
                            <td class="text-light fw-bold"><?php echo __t('about', 'row_ads'); ?></td>
                            <td class="text-danger"><i class="fas fa-times-circle me-1"></i><?php echo __t('about', 'val_ads_ai_psych'); ?></td>
                            <td class="text-danger"><i class="fas fa-times-circle me-1"></i><?php echo __t('about', 'val_ads_ai_psych'); ?></td>
                            <td class="text-danger"><i class="fas fa-times-circle me-1"></i><?php echo __t('about', 'val_ads_ai_psych'); ?></td>
                            <td class="text-danger"><i class="fas fa-times-circle me-1"></i><?php echo __t('about', 'val_ads_targeted'); ?></td>
                            <td class="text-danger"><i class="fas fa-times-circle me-1"></i><?php echo __t('about', 'val_ads_ai_psych'); ?></td>
                            <td class="text-success"><i class="fas fa-check-circle me-1"></i><?php echo __t('about', 'val_ads_none'); ?></td>
                        </tr>
                        <tr data-tippy-content="<?php echo htmlspecialchars(__t('about', 'tip_psych')); ?>">
                            <td class="text-light fw-bold"><?php echo __t('about', 'row_psych'); ?></td>
                            <td class="text-danger"><i class="fas fa-times-circle me-1"></i><?php echo __t('about', 'val_psych_deep'); ?></td>
                            <td class="text-danger"><i class="fas fa-times-circle me-1"></i><?php echo __t('about', 'val_psych_deep'); ?></td>
                            <td class="text-danger"><i class="fas fa-times-circle me-1"></i><?php echo __t('about', 'val_psych_deep'); ?></td>
                            <td class="text-warning"><i class="fas fa-exclamation-circle me-1"></i><?php echo __t('about', 'val_psych_moderate'); ?></td>
                            <td class="text-danger"><i class="fas fa-times-circle me-1"></i><?php echo __t('about', 'val_psych_deep'); ?></td>
                            <td class="text-success"><i class="fas fa-check-circle me-1"></i><?php echo __t('about', 'val_psych_zero'); ?></td>
                        </tr>
                        <tr data-tippy-content="<?php echo htmlspecialchars(__t('about', 'tip_assets')); ?>">
                            <td class="text-light fw-bold"><?php echo __t('about', 'row_assets'); ?></td>
                            <td class="text-warning"><i class="fas fa-exclamation-circle me-1"></i><?php echo __t('about', 'val_assets_bloated'); ?></td>
                            <td class="text-warning"><i class="fas fa-exclamation-circle me-1"></i><?php echo __t('about', 'val_assets_bloated'); ?></td>
                            <td class="text-warning"><i class="fas fa-exclamation-circle me-1"></i><?php echo __t('about', 'val_assets_bloated'); ?></td>
                            <td class="text-warning"><i class="fas fa-exclamation-circle me-1"></i><?php echo __t('about', 'val_assets_moderate'); ?></td>
                            <td class="text-warning"><i class="fas fa-exclamation-circle me-1"></i><?php echo __t('about', 'val_assets_bloated'); ?></td>
                            <td class="text-success"><i class="fas fa-check-circle me-1"></i><?php echo __t('about', 'val_assets_internal'); ?></td>
                        </tr>
                        <tr data-tippy-content="<?php echo htmlspecialchars(__t('about', 'tip_payment')); ?>">
                            <td class="text-light fw-bold"><?php echo __t('about', 'row_payment'); ?></td>
                            <td class="text-warning"><i class="fas fa-exclamation-circle me-1"></i><?php echo __t('about', 'val_payment_identity'); ?></td>
                            <td class="text-warning"><i class="fas fa-exclamation-circle me-1"></i><?php echo __t('about', 'val_payment_identity'); ?></td>
                            <td class="text-warning"><i class="fas fa-exclamation-circle me-1"></i><?php echo __t('about', 'val_payment_identity'); ?></td>
                            <td class="text-success"><i class="fas fa-check-circle me-1"></i><?php echo __t('about', 'val_payment_free'); ?></td>
                            <td class="text-warning"><i class="fas fa-exclamation-circle me-1"></i><?php echo __t('about', 'val_payment_identity'); ?></td>
                            <td class="text-primary"><i class="fas fa-check-circle me-1"></i><?php echo __t('about', 'val_payment_transparent'); ?></td>
                        </tr>
                        <tr data-tippy-content="<?php echo htmlspecialchars(__t('about', 'tip_ai')); ?>">
                            <td class="text-light fw-bold"><?php echo __t('about', 'row_ai'); ?></td>
                            <td class="text-danger"><i class="fas fa-times-circle me-1"></i><?php echo __t('about', 'val_ai_censor'); ?></td>
                            <td class="text-danger"><i class="fas fa-times-circle me-1"></i><?php echo __t('about', 'val_ai_censor'); ?></td>
                            <td class="text-danger"><i class="fas fa-times-circle me-1"></i><?php echo __t('about', 'val_ai_censor'); ?></td>
                            <td class="text-warning"><i class="fas fa-exclamation-circle me-1"></i><?php echo __t('about', 'val_ai_partial'); ?></td>
                            <td class="text-warning"><i class="fas fa-exclamation-circle me-1"></i><?php echo __t('about', 'val_ai_partial'); ?></td>
                            <td class="text-primary"><i class="fas fa-check-circle me-1"></i><?php echo __t('about', 'val_ai_preflight'); ?></td>
                        </tr>
                        <tr data-tippy-content="<?php echo htmlspecialchars(__t('about', 'tip_govt_agency')); ?>">
                            <td class="text-light fw-bold"><?php echo __t('about', 'row_govt_agency'); ?></td>
                            <td class="text-danger"><i class="fas fa-times-circle me-1"></i><?php echo __t('about', 'val_agency_nsa_cia'); ?></td>
                            <td class="text-danger"><i class="fas fa-times-circle me-1"></i><?php echo __t('about', 'val_agency_fbi_doj'); ?></td>
                            <td class="text-danger"><i class="fas fa-times-circle me-1"></i><?php echo __t('about', 'val_agency_nsa_cia'); ?></td>
                            <td class="text-warning"><i class="fas fa-exclamation-circle me-1"></i><?php echo __t('about', 'val_agency_subpoena'); ?></td>
                            <td class="text-danger"><i class="fas fa-times-circle me-1"></i><?php echo __t('about', 'val_agency_dhs_sec'); ?></td>
                            <td class="text-success"><i class="fas fa-check-circle me-1"></i><?php echo __t('about', 'val_agency_none'); ?></td>
                        </tr>
                        <tr data-tippy-content="<?php echo htmlspecialchars(__t('about', 'tip_data_sold')); ?>">
                            <td class="text-light fw-bold"><?php echo __t('about', 'row_data_sold'); ?></td>
                            <td class="text-danger"><i class="fas fa-times-circle me-1"></i><?php echo __t('about', 'val_sold_yes'); ?></td>
                            <td class="text-danger"><i class="fas fa-times-circle me-1"></i><?php echo __t('about', 'val_sold_yes'); ?></td>
                            <td class="text-danger"><i class="fas fa-times-circle me-1"></i><?php echo __t('about', 'val_sold_yes'); ?></td>
                            <td class="text-warning"><i class="fas fa-exclamation-circle me-1"></i><?php echo __t('about', 'val_sold_partial'); ?></td>
                            <td class="text-danger"><i class="fas fa-times-circle me-1"></i><?php echo __t('about', 'val_sold_yes'); ?></td>
                            <td class="text-success"><i class="fas fa-check-circle me-1"></i><?php echo __t('about', 'val_sold_never'); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="text-center mt-3">
                <small class="text-muted fst-italic"><?php echo __t('about', 'table_disclaimer'); ?></small>
            </div>
        </div>
    </section>

    <!-- ============================================================
         SECTION 7: LIVE COMPARISON CHART
    ============================================================ -->
    <section class="mb-5 animate__animated animate__fadeIn">
        <div class="hud-panel p-4">
            <h3 class="text-primary mb-2 text-center">
                <i class="fas fa-chart-radar me-2"></i><?php echo __t('about', 'chart_compare_title'); ?>
            </h3>
            <p class="text-muted text-center small mb-4"><?php echo __t('about', 'chart_compare_subtitle'); ?></p>
            <div id="competitorRadarChart"></div>
        </div>
    </section>

    <!-- ============================================================
         SECTION 8: TIER CARDS
    ============================================================ -->
    <section class="mb-5">
        <h3 class="text-primary mb-4 text-center animate__animated animate__fadeInDown">
            <i class="fas fa-layer-group me-2"></i><?php echo __t('about', 'tiers_title'); ?>
        </h3>
        <p class="text-muted text-center mb-4 fst-italic small">"<?php echo __t('about', 'tiers_quote'); ?>"</p>
        <div class="row g-4">
            <div class="col-md-6 animate__animated animate__fadeInLeft">
                <div class="hud-panel p-4 h-100 border-primary">
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-user text-primary fa-2x me-3"></i>
                        <h2 class="citadel-brand mb-0"><?php echo __t('about', 'tier_free_name'); ?></h2>
                    </div>
                    <ul class="list-unstyled mt-3 small">
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i><?php echo __t('about', 'tier_free_feat1'); ?></li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i><?php echo __t('about', 'tier_free_feat2'); ?></li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i><?php echo __t('about', 'tier_free_feat3'); ?></li>
                        <li class="mb-2"><i class="fas fa-times text-danger me-2"></i><?php echo __t('about', 'tier_free_limit1'); ?></li>
                        <li class="mb-2"><i class="fas fa-times text-danger me-2"></i><?php echo __t('about', 'tier_free_limit2'); ?></li>
                    </ul>
                    <div class="text-center mt-4">
                        <span class="h2 text-glow">$0</span>
                        <small class="text-muted"> / <?php echo __t('about', 'tier_free_period'); ?></small>
                    </div>
                    <div class="text-center mt-3">
                        <a href="/register" class="btn btn-outline-primary w-100 hud-bevel"><?php echo __t('common', 'btn_register'); ?></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 animate__animated animate__fadeInRight">
                <div class="hud-panel p-4 h-100 border-glow" style="background: linear-gradient(45deg, #0a0a0a, #111) !important;">
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-crown text-primary fa-2x me-3"></i>
                        <h2 class="citadel-brand text-primary mb-0"><?php echo __t('about', 'tier_elite_name'); ?></h2>
                    </div>
                    <ul class="list-unstyled mt-3 small">
                        <li class="mb-2"><i class="fas fa-check text-primary me-2"></i><?php echo __t('about', 'tier_elite_feat1'); ?></li>
                        <li class="mb-2"><i class="fas fa-check text-primary me-2"></i><?php echo __t('about', 'tier_elite_feat2'); ?></li>
                        <li class="mb-2"><i class="fas fa-check text-primary me-2"></i><?php echo __t('about', 'tier_elite_feat3'); ?></li>
                        <li class="mb-2"><i class="fas fa-check text-primary me-2"></i><?php echo __t('about', 'tier_elite_feat4'); ?></li>
                        <li class="mb-2"><i class="fas fa-check text-primary me-2"></i><?php echo __t('about', 'tier_elite_feat5'); ?></li>
                    </ul>
                    <div class="text-center mt-4">
                        <span class="h2 text-primary">$15</span>
                        <small class="text-muted"> / <?php echo __t('about', 'tier_elite_period_month'); ?></small>
                        <div class="mt-1 small text-primary">
                            $144 / <?php echo __t('about', 'tier_elite_period_annual'); ?>
                            <span class="badge bg-primary ms-1"><?php echo __t('about', 'tier_elite_save'); ?></span>
                        </div>
                    </div>
                    <p class="text-muted small text-center mt-2">
                        <i class="fab fa-stripe me-1"></i><?php echo __t('about', 'tier_stripe_note'); ?>
                    </p>
                    <div class="text-center mt-2">
                        <a href="/register?tier=elite" class="btn btn-primary w-100 hud-bevel"><?php echo __t('about', 'tier_elite_cta'); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================================
         SECTION 9: INTERNAL HOSTING PHILOSOPHY
    ============================================================ -->
    <section class="mb-5 animate__animated animate__fadeIn">
        <div class="hud-panel p-4">
            <h3 class="text-primary mb-3 text-center">
                <i class="fas fa-server me-2"></i><?php echo __t('about', 'hosting_title'); ?>
            </h3>
            <p class="text-secondary text-center mb-4"><?php echo __t('about', 'hosting_desc'); ?></p>
            <div class="row g-3 text-center">
                <div class="col-md-3">
                    <div class="hud-panel p-3">
                        <i class="fas fa-bolt text-primary fa-2x mb-2"></i>
                        <h6 class="text-light"><?php echo __t('about', 'hosting_feat1_title'); ?></h6>
                        <p class="small text-muted"><?php echo __t('about', 'hosting_feat1_desc'); ?></p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="hud-panel p-3">
                        <i class="fas fa-shield-alt text-primary fa-2x mb-2"></i>
                        <h6 class="text-light"><?php echo __t('about', 'hosting_feat2_title'); ?></h6>
                        <p class="small text-muted"><?php echo __t('about', 'hosting_feat2_desc'); ?></p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="hud-panel p-3">
                        <i class="fab fa-stripe text-primary fa-2x mb-2"></i>
                        <h6 class="text-light"><?php echo __t('about', 'hosting_feat3_title'); ?></h6>
                        <p class="small text-muted"><?php echo __t('about', 'hosting_feat3_desc'); ?></p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="hud-panel p-3">
                        <i class="fas fa-robot text-primary fa-2x mb-2"></i>
                        <h6 class="text-light"><?php echo __t('about', 'hosting_feat4_title'); ?></h6>
                        <p class="small text-muted"><?php echo __t('about', 'hosting_feat4_desc'); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================================
         SECTION 10: SECURITY RESEARCH PROGRAM
    ============================================================ -->
    <section class="hud-panel p-5 text-center mb-5 border-warning animate__animated animate__fadeIn">
        <h3 class="text-warning font-header mb-3">
            <i class="fas fa-bug me-2"></i><?php echo __t('about', 'bugbounty_title'); ?>
        </h3>
        <p class="text-secondary mb-2"><?php echo __t('about', 'bugbounty_desc'); ?></p>
        <p class="text-muted small mb-4 fst-italic"><?php echo __t('about', 'bugbounty_note'); ?></p>
        <div class="d-flex justify-content-center gap-4 flex-wrap mb-4">
            <a href="https://hackerone.com" target="_blank" class="text-muted text-decoration-none"
               data-tippy-content="<?php echo htmlspecialchars(__t('about', 'tip_hackerone')); ?>">
                <i class="fab fa-hacker-news fa-2x me-1"></i><br>
                <small>HackerOne</small>
            </a>
            <a href="https://bugcrowd.com" target="_blank" class="text-muted text-decoration-none"
               data-tippy-content="<?php echo htmlspecialchars(__t('about', 'tip_bugcrowd')); ?>">
                <i class="fas fa-bug fa-2x me-1"></i><br>
                <small>BugCrowd</small>
            </a>
            <a href="https://intigriti.com" target="_blank" class="text-muted text-decoration-none"
               data-tippy-content="<?php echo htmlspecialchars(__t('about', 'tip_intigriti')); ?>">
                <i class="fas fa-shield-alt fa-2x me-1"></i><br>
                <small>Intigriti</small>
            </a>
            <a href="https://yeswehack.com" target="_blank" class="text-muted text-decoration-none"
               data-tippy-content="<?php echo htmlspecialchars(__t('about', 'tip_yeswehack')); ?>">
                <i class="fas fa-user-secret fa-2x me-1"></i><br>
                <small>YesWeHack</small>
            </a>
        </div>
        <div class="telemetry-box d-inline-block px-4">
            <small class="text-warning"><?php echo __t('about', 'bugbounty_status'); ?></small>
        </div>
    </section>

    <!-- ============================================================
         SECTION 11: CTA
    ============================================================ -->
    <section class="hud-panel p-5 text-center mb-5 animate__animated animate__pulse animate__infinite animate__slow">
        <h2 class="citadel-brand mb-3"><?php echo __t('about', 'cta_title'); ?></h2>
        <p class="text-muted mb-4"><?php echo __t('about', 'cta_desc'); ?></p>
        <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
            <a href="/register" class="btn btn-primary btn-lg px-5 hud-bevel">
                <?php echo __t('common', 'btn_register'); ?>
            </a>
            <a href="/compliance" class="btn btn-outline-secondary btn-lg px-5">
                <?php echo __t('nav', 'compliance'); ?>
            </a>
        </div>
    </section>

</div><!-- /container -->

<?php
$load_assets = ['particles', 'charts', 'forms'];
require_once __DIR__ . '/1nclud3z/f0073r.php';
?>

<script>
document.addEventListener('DOMContentLoaded', () => {

    // ── 1. TIPPY TOOLTIPS on all data-tippy-content elements ──────────────
    if (typeof tippy !== 'undefined') {
        tippy('[data-tippy-content]', {
            theme: 'translucent',
            placement: 'top',
            arrow: true,
            animation: 'shift-away',
            delay: [100, 0],
        });
    }

    // ── 2. SYSTEM INTEGRITY RADIAL CHART (ApexCharts) ────────────────────
    if (typeof ApexCharts !== 'undefined' && document.querySelector('#aboutRadarChart')) {
        new ApexCharts(document.querySelector('#aboutRadarChart'), {
            series: [99, 100, 98, 100],
            chart: {
                height: 320,
                type: 'radialBar',
                background: 'transparent',
                toolbar: { show: false }
            },
            plotOptions: {
                radialBar: {
                    offsetY: 0,
                    startAngle: -135,
                    endAngle: 135,
                    hollow: { size: '30%' },
                    track: { background: '#1a1a2e', strokeWidth: '100%' },
                    dataLabels: {
                        name: { fontSize: '13px', color: '#00d4ff', offsetY: -10 },
                        value: { fontSize: '14px', color: '#ffffff', offsetY: 5 },
                        total: {
                            show: true,
                            label: 'INTEGRITY',
                            color: '#00d4ff',
                            fontSize: '12px',
                            formatter: () => '99.99%'
                        }
                    }
                }
            },
            colors: ['#00d4ff', '#39ff14', '#7d41ff', '#00d4ff'],
            labels: ['<?php echo __t('about', 'chart_label_enc'); ?>', '<?php echo __t('about', 'chart_label_anon'); ?>', '<?php echo __t('about', 'chart_label_uptime'); ?>', '<?php echo __t('about', 'chart_label_sec'); ?>'],
            theme: { mode: 'dark' }
        }).render();
    }

    // ── 3. COMPETITOR RADAR CHART (ApexCharts) ────────────────────────────
    if (typeof ApexCharts !== 'undefined' && document.querySelector('#competitorRadarChart')) {
        new ApexCharts(document.querySelector('#competitorRadarChart'), {
            series: [
                { name: 'Facebook',    data: [10, 5,  5,  5,  5,  10, 10, 5 ] },
                { name: 'Twitter/X',   data: [10, 10, 5,  5,  10, 10, 5,  5 ] },
                { name: 'Instagram',   data: [10, 5,  5,  5,  5,  10, 10, 5 ] },
                { name: 'LinkedIn',    data: [8,  8,  5,  5,  8,  8,  8,  5 ] },
                { name: 'MyCitadel',   data: [100,100,100,100,100,100,100,100] },
            ],
            chart: {
                height: 380,
                type: 'radar',
                background: 'transparent',
                toolbar: { show: false },
                dropShadow: { enabled: true, blur: 1, left: 1, top: 1 }
            },
            stroke: { width: 2 },
            fill: { opacity: 0.15 },
            markers: { size: 3 },
            colors: ['#ff4444', '#ff9900', '#cc44ff', '#4499ff', '#00d4ff'],
            xaxis: {
                categories: [
                    '<?php echo __t('about', 'radar_privacy'); ?>',
                    '<?php echo __t('about', 'radar_encryption'); ?>',
                    '<?php echo __t('about', 'radar_no_ads'); ?>',
                    '<?php echo __t('about', 'radar_no_tracking'); ?>',
                    '<?php echo __t('about', 'radar_no_harvest'); ?>',
                    '<?php echo __t('about', 'radar_no_govt'); ?>',
                    '<?php echo __t('about', 'radar_speed'); ?>',
                    '<?php echo __t('about', 'radar_transparency'); ?>',
                ]
            },
            yaxis: { show: false },
            theme: { mode: 'dark' },
            legend: {
                show: true,
                position: 'bottom',
                labels: { colors: '#aaa' }
            }
        }).render();
    }

    // ── 4. SCROLL REVEAL via IntersectionObserver ─────────────────────────
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate__animated', 'animate__fadeInUp');
                entry.target.style.opacity = '1';
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.hud-panel').forEach(el => {
        el.style.opacity = '0';
        observer.observe(el);
    });

    // ── 5. TABLE ROW HOVER TOAST (Toastify) ──────────────────────────────
    if (typeof Toastify !== 'undefined') {
        document.querySelectorAll('#comparisonTable tbody tr').forEach(row => {
            row.addEventListener('click', () => {
                const feature = row.querySelector('td')?.innerText;
                if (feature) {
                    Toastify({
                        text: `🔍 ${feature}`,
                        duration: 2000,
                        gravity: 'bottom',
                        position: 'right',
                        style: {
                            background: 'linear-gradient(to right, #0a0a1a, #00d4ff22)',
                            border: '1px solid #00d4ff44',
                            color: '#00d4ff',
                            fontSize: '12px',
                            fontFamily: 'monospace'
                        }
                    }).showToast();
                }
            });
        });
    }

    // ── 6. BOOT SEQUENCE TOAST ────────────────────────────────────────────
    if (typeof Toastify !== 'undefined') {
        setTimeout(() => {
            Toastify({
                text: '[ INTEL_DOSSIER ] <?php echo addslashes(__t('about', 'toast_loaded')); ?>',
                duration: 3500,
                gravity: 'top',
                position: 'right',
                style: {
                    background: 'linear-gradient(to right, #0a0a1a, #00d4ff22)',
                    border: '1px solid #00d4ff44',
                    color: '#00d4ff',
                    fontSize: '12px',
                    fontFamily: 'monospace'
                }
            }).showToast();
        }, 800);
    }

});
</script>