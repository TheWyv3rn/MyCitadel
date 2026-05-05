<?php
/**
 * PROJECT: MY CITADEL
 * MODULE: ABOUT / DOSSIER (YEAR 3056 UI)
 * DESCRIPTION: High-tech technical overview of the platform and architects.
 */

declare(strict_types=1);
require_once __DIR__ . '/includes/header.php';
?>
<div id="particles-js" style="position: fixed; width: 100%; height: 100%; top: 0; left: 0; z-index: -1; pointer-events: none;"></div>

<div class="container py-5">
    
    <!-- [HERO Dossier Header] -->
    <header class="mb-5 animate__animated animate__fadeIn">
        <h1 class="glowing-title display-4 stencil-text"><?php echo __t('about', 'title'); ?></h1>
        <div class="data-stream d-inline-block">
            <i class="fas fa-satellite-dish"></i> <?php echo __t('about', 'bo'); ?>: <?php echo __t('about', 'vsl'); ?>
        </div>
    </header>

    <!-- [THE CHRONICLES SECTION] -->
    <section class="row mb-5 g-4">
        <div class="col-lg-8 animate__animated animate__fadeInLeft">
            <div class="citadel-card h-100">
                <h2 class="text-neon-blue stencil-text"><i class="fas fa-history"></i> <?php echo __t('about', 'history_h'); ?></h2>
                <p class="text-secondary mt-3 lead"><?php echo __t('about', 'history_p'); ?></p>
                <hr class="border-neon-blue opacity-25">
                <h3 class="h5 text-white"><?php echo __t('about', 'citizen_h'); ?></h3>
                <p class="text-secondary small"><?php echo __t('about', 'citizen_p'); ?></p>
            </div>
        </div>
        <div class="col-lg-4 animate__animated animate__fadeInRight">
            <div class="citadel-card h-100 bg-black">
                <h3 class="text-space-purple stencil-text h5"><i class="fas fa-chart-line"></i> <?php echo __t('about', 'stats_h'); ?></h3>
                <div id="privacyChart" style="min-height: 200px;"></div>
                <p class="small text-secondary mt-2 italic">// <?php echo __t('about', 'ldh'); ?></p>
            </div>
        </div>
    </section>

    <!-- [THE ARCHITECTS: PROFILE GRID] -->
    <h2 class="stencil-text text-center text-neon-blue mb-5"><?php echo __t('about', 'arch_h'); ?></h2>
    <section class="row g-4 mb-5">
        <!-- TheWyv3rn -->
        <div class="col-md-4 animate__animated animate__zoomIn">
            <div class="citadel-card text-center profile-card">
                <div class="profile-hex mx-auto mb-3">
                    <img src="citadel.jpeg" alt="Founder" class="img-fluid rounded-circle">
                </div>
                <h4 class="text-neon-blue"><?php echo __t('about', 'wyv3rn'); ?></h4>
                <div class="badge bg-dark border border-neon-blue mb-3"><?php echo __t('about', 'certs'); ?></div>
                <p class="small text-secondary"><?php echo __t('about', 'wyvern_bio'); ?></p>
            </div>
        </div>
        <!-- Valhalla Labs -->
        <div class="col-md-4 animate__animated animate__zoomIn" style="animation-delay: 0.2s;">
            <div class="citadel-card text-center profile-card border-alien-green">
                <div class="profile-hex mx-auto mb-3">
                    <i class="fas fa-shield-alt fa-4x text-alien-green py-3"></i>
                </div>
                <h4 class="text-alien-green"><?php echo __t('about', 'vslt'); ?></h4>
                <div class="badge bg-dark border border-alien-green mb-3"><?php echo __t('about', 'audit'); ?></div>
                <p class="small text-secondary"><?php echo __t('about', 'valhalla_p'); ?></p>
            </div>
        </div>
        <!-- IT Ninja -->
        <div class="col-md-4 animate__animated animate__zoomIn" style="animation-delay: 0.4s;">
            <div class="citadel-card text-center profile-card border-space-purple">
                <div class="profile-hex mx-auto mb-3" style="background: rgba(123, 47, 247, 0.1);">
                    <i class="fas fa-user-ninja fa-4x text-space-purple py-3"></i>
                </div>
                <h4 class="text-space-purple"><?php echo __t('about', 'itn'); ?></h4>
                <div class="badge bg-dark border border-space-purple mb-3"><?php echo __t('about', 'itnd'); ?></div>
                <p class="small text-secondary"><?php echo __t('about', 'ninja_p'); ?></p>
            </div>
        </div>
    </section>

    <!-- [TECHNICAL SECURITY MATRIX] -->
    <section class="mb-5 animate__animated animate__fadeInUp">
        <div class="citadel-card">
            <h2 class="stencil-text text-neon-blue mb-4"><i class="fas fa-microchip"></i> <?php echo __t('about', 'sec_h'); ?></h2>
            <div class="table-responsive">
                <table class="table table-dark table-borderless citadel-table">
                    <thead>
                        <tr class="border-bottom border-neon-blue">
                            <th><?php echo __t('about', 'protocol'); ?></th>
                            <th><?php echo __t('about', 'ls'); ?></th>
                            <th><?php echo __t('about', 'cs'); ?></th>
                            <th><?php echo __t('about', 'slvl'); ?></th>
                        </tr>
                    </thead>
                    <tbody class="small font-mono">
                        <tr>
                            <td><?php echo __t('about', 'protocol_d1'); ?></td>
                            <td class="text-danger"><?php echo __t('about', 'ls_d1'); ?></td>
                            <td class="text-alien-green"><?php echo __t('about', 'cs_d1'); ?></td>
                            <td><?php echo __t('about', 'critical'); ?></td>
                        </tr>
                        <tr>
                            <td><?php echo __t('about', 'protocol_d2'); ?></td>
                            <td class="text-warning"><?php echo __t('about', 'ls_d2'); ?></td>
                            <td class="text-alien-green"><?php echo __t('about', 'cs_d2'); ?></td>
                            <td><?php echo __t('about', 'ultra'); ?></td>
                        </tr>
                        <tr>
                            <td><?php echo __t('about', 'protocol_d3'); ?></td>
                            <td class="text-danger"><?php echo __t('about', 'ls_d3'); ?></td>
                            <td class="text-alien-green"><?php echo __t('about', 'cs_d3'); ?></td>
                            <td><?php echo __t('about', 'maximum'); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- [BENEFITS GRID] -->
    <section class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="citadel-card text-center">
                <i class="fas fa-ad fa-2x text-neon-blue mb-3"></i>
                <h5 class="stencil-text"><?php echo __t('about', 'benefit1_h'); ?></h5>
                <p class="small text-secondary"><?php echo __t('about', 'benefit1_p'); ?></p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="citadel-card text-center">
                <i class="fas fa-eye-slash fa-2x text-alien-green mb-3"></i>
                <h5 class="stencil-text"><?php echo __t('about', 'benefit2_h'); ?></h5>
                <p class="small text-secondary"><?php echo __t('about', 'benefit2_p'); ?></p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="citadel-card text-center">
                <i class="fas fa-box-open fa-2x text-space-purple mb-3"></i>
                <h5 class="stencil-text"><?php echo __t('about', 'benefit3_h'); ?></h5>
                <p class="small text-secondary"><?php echo __t('about', 'benefit3_p'); ?></p>
            </div>
        </div>
    </section>

</div>

<style>
    /* Profile Hexagon Aesthetic */
    .profile-hex {
        width: 120px;
        height: 120px;
        clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
        background: rgba(0, 242, 255, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        border: 2px solid var(--neon-blue);
    }
    
    .profile-card { transition: var(--transition-smooth); }
    .profile-card:hover { transform: scale(1.03); }

    /* Custom Table Styling */
    .citadel-table thead th { color: var(--neon-blue); font-family: var(--font-stencil); }
    .citadel-table tbody tr { border-bottom: 1px solid rgba(255, 255, 255, 0.05); }
    .citadel-table td { padding: 1rem 0.5rem; }
    
    .border-alien-green { border-color: var(--alien-green) !important; }
    .border-space-purple { border-color: var(--space-purple) !important; }
</style>
<script src="assets/vendor/particles.js-master/particles.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var options = {
        series: [{
            name: 'Surveillance Exposure',
            data: [100, 95, 110, 140, 160]
        }, {
            name: 'Citadel Sovereignty',
            data: [0, 50, 100, 150, 200]
        }],
        chart: {
            height: 250,
            type: 'area',
            toolbar: { show: false },
            background: 'transparent'
        },
        colors: ['#ff003c', '#00f2ff'],
        dataLabels: { enabled: false },
        stroke: { curve: 'smooth', width: 2 },
        theme: { mode: 'dark' },
        xaxis: { categories: ['2020', '2024', '2030', '2045', '3056'] },
        grid: { borderColor: 'rgba(255,255,255,0.05)' }
    };

    var chart = new ApexCharts(document.querySelector("#privacyChart"), options);
    chart.render();
});
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

<?php require_once __DIR__ . '/includes/footer.php'; ?>