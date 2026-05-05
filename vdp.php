<?php
/**
 * PROJECT: MY CITADEL
 * MODULE: VDP / BUG BOUNTY CENTER
 * VERSION: 1.0.0
 * DESCRIPTION: Handles Rules of Engagement, Scope, and Hall of Fame.
 */

declare(strict_types=1);
require_once __DIR__ . '/includes/header.php';

/**
 * HALL OF FAME DATA REGISTRY
 * To add a new hacker, simply append a new associative array to this list.
 */
$hall_of_fame = [
    ['name' => 'IT Ninja', 'discovery' => 'SQLi',  'points' => 150,   'platform' => 'Direct', 'date' => '03/15/2026'],
    ['name' => 'IT Ninja', 'discovery' => 'IDOR',  'points' => 75,    'platform' => 'Direct', 'date' => '03/17/2026'],
    ['name' => 'IT Ninja', 'discovery' => 'XSS',   'points' => 200,   'platform' => 'Direct', 'date' => '03/17/2026'],
    ['name' => 'IT Ninja', 'discovery' => 'RCE',   'points' => 1500,  'platform' => 'Direct', 'date' => '04/02/2026'],
];

// Sub-domains list
$scope = [
    'ai.mycitadel.lol',
    'kryptos.mycitadel.lol',
    'mycitadel.lol',
    'www.mycitadel.lol'
];
?>
<div id="particles-js" style="position: fixed; width: 100%; height: 100%; top: 0; left: 0; z-index: -1; pointer-events: none;"></div>

<div class="container py-5">
    
    <header class="mb-5 animate__animated animate__fadeIn">
        <h1 class="glowing-title display-4 stencil-text"><?php echo __t('vdp', 'title'); ?></h1>
        <div class="data-stream d-inline-block">
            <i class="fas fa-user-secret"></i> <?php echo __t('vdp', 'subtitle'); ?>
        </div>
        <p class="text-secondary mt-4 lead" style="max-width: 800px;">
            <?php echo __t('vdp', 'intro'); ?>
        </p>
    </header>

    <div class="row g-4">
        <div class="col-lg-8 animate__animated animate__fadeInLeft">
            <div class="citadel-card h-100">
                <h2 class="text-neon-blue stencil-text mb-4">
                    <i class="fas fa-gavel"></i> <?php echo __t('vdp', 'rules_h'); ?>
                </h2>
                <p class="text-white small mb-3"><?php echo __t('vdp', 'rules_p1'); ?></p>
                
                <div class="alert bg-black border-danger text-danger font-mono small">
                    <i class="fas fa-exclamation-triangle"></i> <?php echo __t('vdp', 'rules_p2'); ?>
                </div>

                <hr class="border-secondary opacity-25 my-4">

                <h3 class="text-space-purple h5 stencil-text mb-3"><?php echo __t('vdp', 'contact_h'); ?></h3>
                <p class="text-secondary"><?php echo __t('vdp', 'contact_p'); ?></p>
            </div>
        </div>

        <div class="col-lg-4 animate__animated animate__fadeInRight">
            <div class="citadel-card h-100 border-alien-green">
                <h2 class="text-alien-green stencil-text mb-4">
                    <i class="fas fa-crosshairs"></i> <?php echo __t('vdp', 'scope_h'); ?>
                </h2>
                <ul class="list-unstyled font-mono small">
                    <?php foreach($scope as $domain): ?>
                        <li class="mb-3 p-2 bg-black border-left border-alien-green">
                            <span class="text-secondary"><?php echo __t('vdp', 'target'); ?>:</span> 
                            <span class="text-white"><?php echo $domain; ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

        <div class="col-12 animate__animated animate__fadeInUp" style="animation-delay: 0.3s;">
            <div class="citadel-card">
                <h2 class="text-neon-blue stencil-text mb-4 text-center">
                    <i class="fas fa-trophy"></i> <?php echo __t('vdp', 'hof_h'); ?>
                </h2>
                
                <div class="table-responsive">
                    <table class="table table-dark table-hover citadel-table mb-0">
                        <thead>
                            <tr class="border-bottom border-neon-blue font-stencil text-neon-blue">
                                <th><?php echo __t('vdp', 'hof_th_name'); ?></th>
                                <th><?php echo __t('vdp', 'hof_th_disc'); ?></th>
                                <th><?php echo __t('vdp', 'hof_th_pts'); ?></th>
                                <th><?php echo __t('vdp', 'hof_th_plat'); ?></th>
                                <th><?php echo __t('vdp', 'hof_th_date'); ?></th>
                            </tr>
                        </thead>
                        <tbody class="font-mono small">
                            <?php foreach($hall_of_fame as $entry): ?>
                                <tr>
                                    <td class="text-white fw-bold"><?php echo htmlspecialchars($entry['name']); ?></td>
                                    <td><span class="badge bg-dark border border-danger text-danger"><?php echo htmlspecialchars($entry['discovery']); ?></span></td>
                                    <td class="text-alien-green">+<?php echo number_format($entry['points']); ?></td>
                                    <td class="text-secondary"><?php echo htmlspecialchars($entry['platform']); ?></td>
                                    <td class="text-secondary"><?php echo $entry['date']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
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
    /* Table Enhancements */
    .citadel-table tbody tr {
        transition: background 0.3s ease;
        border-bottom: 1px solid rgba(0, 242, 255, 0.05);
    }
    .citadel-table tbody tr:hover {
        background: rgba(0, 242, 255, 0.05) !important;
    }
    .citadel-table td, .citadel-table th {
        padding: 1.2rem 1rem;
        vertical-align: middle;
    }
    
    /* Animation for the data stream */
    .data-stream {
        background: rgba(57, 255, 20, 0.1);
        color: var(--alien-green);
        padding: 0.5rem 1rem;
        border-radius: 4px;
        font-family: var(--font-mono);
        letter-spacing: 1px;
    }
</style>

<?php require_once __DIR__ . '/includes/footer.php'; ?>