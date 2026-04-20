<?php
/**
 * MyCitadel - Compliance Command Center
 * Sector: SOC2 / SOC3 / IEEE Audit Interface
 */

require_once __DIR__ . '/../private/citadel_config.php';

$page_title = __t('nav', 'compliance');
require_once __DIR__ . '/1nclud3z/h34d3r.php'; 
?>

<div id="particles-js" class="position-fixed w-100 h-100" style="z-index: 1; pointer-events: none;"></div>

<div class="container position-relative py-5" style="z-index: 2;">
    
    <header class="text-center mb-5 animate__animated animate__fadeIn">
        <div class="telemetry-box d-inline-block px-4">
            <span class="text-primary fw-bold">[ AUDIT_MODE: ]</span> 
            <span class="text-glow">GLOBAL_COMPLIANCE_LINK_ESTABLISHED</span>
        </div>
        <h1 class="display-4 fw-bold citadel-brand mt-3"><?php echo __t('compliance', 'title'); ?></h1>
        <p class="text-muted small font-data uppercase tracking-widest"><?php echo __t('compliance', 'cert_id'); ?>: MC-2026-ZK-77</p>
    </header>

    <div class="row g-4 mb-5">
        <div class="col-lg-8 animate__animated animate__fadeInLeft">
            <div class="hud-panel p-4 h-100">
                <h3 class="text-primary mb-4 font-header"><i class="fas fa-microscope me-2"></i><?php echo __t('compliance', 'live_monitor'); ?></h3>
                <div id="complianceRadarChart"></div>
            </div>
        </div>
        <div class="col-lg-4 animate__animated animate__fadeInRight">
            <div class="hud-panel p-4 h-100 border-primary">
                <h4 class="text-primary mb-3 font-header"><?php echo __t('compliance', 'report_vault'); ?></h4>
                <div class="d-grid gap-2">
                    <div class="telemetry-box d-flex justify-content-between align-items-center">
                        <span class="small">SOC2_TYPE_II.PDF</span>
                        <span class="badge bg-primary text-black">RESTRICTED</span>
                    </div>
                    <div class="telemetry-box d-flex justify-content-between align-items-center">
                        <span class="small">SOC3_PUBLIC.PDF</span>
                        <span class="text-success small">DOWNLOADABLE</span>
                    </div>
                    <div class="telemetry-box d-flex justify-content-between align-items-center">
                        <span class="small">IEEE_2700.1_STMT.PDF</span>
                        <span class="text-success small">DOWNLOADABLE</span>
                    </div>
                </div>
                <hr class="border-secondary mt-4">
                <p class="small text-muted italic"><?php echo __t('compliance', 'auditor_note'); ?></p>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <?php 
        $pillars = ['security', 'availability', 'integrity', 'confidentiality', 'privacy'];
        foreach($pillars as $pillar): ?>
        <div class="col-md-4 col-lg">
            <div class="hud-panel p-3 text-center border-glow">
                <div class="text-primary mb-2 h4"><i class="fas fa-shield-check"></i></div>
                <h6 class="text-uppercase tracking-tighter text-glow"><?php echo __t('compliance', "pillar_{$pillar}"); ?></h6>
                <div class="small text-success">NOMINAL</div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <section class="hud-panel p-4 mb-5 animate__animated animate__fadeInUp">
        <h3 class="text-primary mb-4 border-bottom border-secondary pb-2"><?php echo __t('compliance', 'tech_audit_title'); ?></h3>
        <div class="row">
            <div class="col-md-6 mb-3">
                <h5 class="text-light font-data text-uppercase"><i class="fas fa-key me-2 text-primary"></i><?php echo __t('compliance', 'encryption_title'); ?></h5>
                <p class="small text-muted"><?php echo __t('compliance', 'encryption_desc'); ?></p>
            </div>
            <div class="col-md-6 mb-3">
                <h5 class="text-light font-data text-uppercase"><i class="fas fa-terminal me-2 text-primary"></i><?php echo __t('compliance', 'access_title'); ?></h5>
                <p class="small text-muted"><?php echo __t('compliance', 'access_desc'); ?></p>
            </div>
            <div class="col-md-6 mb-3">
                <h5 class="text-light font-data text-uppercase"><i class="fas fa-history me-2 text-primary"></i><?php echo __t('compliance', 'change_mgmt_title'); ?></h5>
                <p class="small text-muted"><?php echo __t('compliance', 'change_mgmt_desc'); ?></p>
            </div>
            <div class="col-md-6 mb-3">
                <h5 class="text-light font-data text-uppercase"><i class="fas fa-user-lock me-2 text-primary"></i><?php echo __t('compliance', 'privacy_control_title'); ?></h5>
                <p class="small text-muted"><?php echo __t('compliance', 'privacy_control_desc'); ?></p>
            </div>
        </div>
    </section>

</div>

<?php 
$load_assets = ['particles', 'charts'];
require_once __DIR__ . '/1nclud3z/f0073r.php'; 
?>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // Compliance Radar Chart - Visualizing Trust Services Criteria
    var options = {
        series: [{
            name: 'Citadel Operations',
            data: [98, 95, 100, 99, 100],
        }],
        chart: { height: 350, type: 'radar', background: 'transparent', toolbar: { show: false } },
        colors: ['#00d4ff'],
        xaxis: {
            categories: ['Security', 'Availability', 'Processing Integrity', 'Confidentiality', 'Privacy'],
            labels: { style: { colors: ["#fff", "#fff", "#fff", "#fff", "#fff"] } }
        },
        yaxis: { show: false },
        fill: { opacity: 0.2, colors: ['#00d4ff'] },
        stroke: { show: true, width: 2, colors: ['#00d4ff'] },
        markers: { size: 4, colors: ['#00d4ff'] }
    };

    var chart = new ApexCharts(document.querySelector("#complianceRadarChart"), options);
    chart.render();
});
</script>