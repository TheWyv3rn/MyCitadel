<?php
/**
 * PROJECT: MY CITADEL
 * MODULE: REGISTRATION GATE
 */

declare(strict_types=1);
require_once __DIR__ . '/includes/config.php';
set_security_headers();
require_once __DIR__ . '/includes/header.php';
?>
<!-- [PARTICLES BACKGROUND CONTAINER] -->
<div id="particles-js" style="position: fixed; width: 100%; height: 100%; top: 0; left: 0; z-index: -1; pointer-events: none;"></div>

<div class="container py-5 d-flex justify-content-center">
    <div class="citadel-card mt-5 animate__animated animate__zoomIn" style="max-width: 500px; width: 100%;">
        <div class="text-center mb-4">
            <h1 class="stencil-text text-neon-blue h2"><?php echo __t('auth', 'reg_title'); ?></h1>
            <p class="text-secondary x-small font-mono"><?php echo __t('auth', 'reg_sub'); ?></p>
        </div>

        <form id="regForm" action="includes/auth/process_register.php" method="POST" class="needs-validation" novalidate>
            <!-- Alias Field -->
            <div class="mb-4 position-relative">
                <label class="form-label text-white small font-mono"><?php echo __t('auth', 'alias'); ?></label>
                <div class="input-group">
                    <span class="input-group-text bg-black border-neon-blue text-neon-blue"><i class="fas fa-user-shield"></i></span>
                    <input type="text" id="alias" name="alias" class="form-control bg-black text-white border-neon-blue" required autocomplete="off">
                </div>
                <div id="aliasFeedback" class="x-small mt-1"></div>
            </div>

            <!-- Email Field -->
            <div class="mb-4">
                <label class="form-label text-white small font-mono"><?php echo __t('auth', 'email'); ?></label>
                <div class="input-group">
                    <span class="input-group-text bg-black border-neon-blue text-neon-blue"><i class="fas fa-envelope"></i></span>
                    <input type="email" id="email" name="email" class="form-control bg-black text-white border-neon-blue" required>
                </div>
            </div>

            <!-- Password Grid -->
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label class="form-label text-white small font-mono"><?php echo __t('auth', 'pass'); ?></label>
                    <input type="password" id="password" class="form-control bg-black text-white border-neon-blue" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label text-white small font-mono"><?php echo __t('auth', 'pass_confirm'); ?></label>
                    <input type="password" id="password_confirm" class="form-control bg-black text-white border-neon-blue" required>
                </div>
                <div class="col-12">
                    <p class="text-secondary x-small mb-0 italic"><i class="fas fa-info-circle"></i> <?php echo __t('auth', 'pass_req'); ?></p>
                </div>
            </div>

            <!-- Conduct Agreement -->
            <div class="mb-4 form-check">
                <input type="checkbox" class="form-check-input bg-black border-neon-blue" id="agree" required>
                <label class="form-check-label text-secondary x-small" for="agree"><?php echo __t('auth', 'agree'); ?></label>
            </div>

            <!-- Hidden Fields for Scrambled Data -->
            <input type="hidden" id="scrambled_email" name="scrambled_email">
            <input type="hidden" id="scrambled_pass" name="scrambled_pass">

            <button type="submit" class="btn-cyber w-100 py-3 stencil-text">
                <i class="fas fa-save"></i> <?php echo __t('auth', 'submit'); ?>
            </button>
            
            <div class="text-center mt-4">
                <a href="login.php" class="text-neon-blue x-small text-decoration-none font-mono">
                    <?php echo __t('auth', 'login_link'); ?>
                </a>
            </div>
        </form>
    </div>
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
    input:focus { 
        box-shadow: 0 0 10px var(--neon-blue) !important;
        border-color: var(--neon-blue) !important;
    }
    .valid-alias { color: var(--alien-green); }
    .invalid-alias { color: var(--danger-red); }
</style>

<?php require_once __DIR__ . '/includes/footer.php'; ?>