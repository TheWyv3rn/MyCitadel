<?php
/**
 * PROJECT: MY CITADEL
 * MODULE: POLICIES / ZERO TOLERANCE
 */

declare(strict_types=1);
require_once __DIR__ . '/includes/header.php';
?>
<div id="particles-js" style="position: fixed; width: 100%; height: 100%; top: 0; left: 0; z-index: -1; pointer-events: none;"></div>

<div class="container py-5">
    
    <header class="mb-5 animate__animated animate__fadeIn">
        <h1 class="glowing-title display-4 stencil-text"><?php echo __t('policies', 'title'); ?></h1>
        <div class="data-stream d-inline-block border-danger text-danger">
            <i class="fas fa-gavel"></i> <?php echo __t('policies', 'subtitle'); ?>
        </div>
    </header>

    <div class="row g-4">
        <div class="col-lg-6 animate__animated animate__fadeInLeft">
            <div class="citadel-card h-100 border-danger">
                <h2 class="text-danger stencil-text mb-4">
                    <i class="fas fa-ban"></i> <?php echo __t('policies', 'zero_h'); ?>
                </h2>
                <ul class="list-unstyled">
                    <?php for($i=1; $i<=5; $i++): ?>
                        <li class="mb-3 p-3 bg-black border-left border-danger text-white font-mono small">
                            <i class="fas fa-skull-crossbones text-danger mr-2"></i> 
                            <?php echo __t('policies', 'zero_p'.$i); ?>
                        </li>
                    <?php endfor; ?>
                </ul>
            </div>
        </div>

        <div class="col-lg-6 animate__animated animate__fadeInRight">
            <div class="citadel-card h-100 border-neon-blue">
                <h2 class="text-neon-blue stencil-text mb-4">
                    <i class="fas fa-eye"></i> <?php echo __t('policies', 'kryptos_h'); ?>
                </h2>
                <p class="text-secondary mb-4"><?php echo __t('policies', 'kryptos_p'); ?></p>
                <div class="bg-dark p-3 rounded border border-neon-blue text-center">
                    <code class="text-neon-blue"><?php echo __t('policies', 'ai'); ?></code>
                </div>
            </div>
        </div>

        <div class="col-12 animate__animated animate__fadeInUp">
            <div class="citadel-card bg-black border-danger p-5 text-center shadow-red">
                <h2 class="text-danger display-6 stencil-text mb-3">
                    <i class="fas fa-ghost"></i> <?php echo __t('policies', 'ghost_h'); ?>
                </h2>
                <p class="text-white lead mx-auto" style="max-width: 800px;">
                    <?php echo __t('policies', 'ghost_p'); ?>
                </p>
                <div class="d-flex justify-content-center gap-4 mt-4">
                    <div class="strike-box"><?php echo __t('policies', 'strike'); ?> 1</div>
                    <div class="strike-box"><?php echo __t('policies', 'strike'); ?> 2</div>
                    <div class="strike-box bg-danger text-black fw-bold"><?php echo __t('policies', 'strike'); ?> 3</div>
                </div>
            </div>
        </div>

        <div class="col-md-6 animate__animated animate__fadeInUp">
            <div class="citadel-card h-100">
                <h3 class="text-space-purple stencil-text mb-3">
                    <i class="fas fa-users-cog"></i> <?php echo __t('policies', 'multi_h'); ?>
                </h3>
                <p class="text-secondary small"><?php echo __t('policies', 'multi_p'); ?></p>
                <div class="p-2 bg-dark border border-secondary rounded font-mono x-small mt-3">
                    <span class="text-neon-blue">EX:</span> <?php echo __t('policies', 'ho_itn'); ?>
                </div>
            </div>
        </div>

        <div class="col-md-6 animate__animated animate__fadeInUp">
            <div class="citadel-card h-100 border-alien-green">
                <h3 class="text-alien-green stencil-text mb-3">
                    <i class="fas fa-user-shield"></i> <?php echo __t('policies', 'oversight_h'); ?>
                </h3>
                <p class="text-secondary small"><?php echo __t('policies', 'oversight_p'); ?></p>
                <p class="text-alien-green font-mono x-small mb-0 mt-2">
                    <i class="fas fa-envelope"></i> <?php echo __t('policies', 'email'); ?>
                </p>
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
    .shadow-red { box-shadow: 0 0 30px rgba(255, 0, 60, 0.2); }
    .strike-box {
        padding: 10px 20px;
        border: 2px solid var(--void-border);
        font-family: var(--font-mono);
        color: var(--text-secondary);
    }
    .x-small { font-size: 0.75rem; }
</style>

<?php require_once __DIR__ . '/includes/footer.php'; ?>