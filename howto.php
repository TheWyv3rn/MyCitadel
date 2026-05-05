<?php
/**
 * PROJECT: MY CITADEL
 * MODULE: HOW-TO / FIELD MANUAL (YEAR 3056 UI)
 */

declare(strict_types=1);
require_once __DIR__ . '/includes/header.php';
?>
<div id="particles-js" style="position: fixed; width: 100%; height: 100%; top: 0; left: 0; z-index: -1; pointer-events: none;"></div>

<div class="container py-5">
    <header class="mb-5 animate__animated animate__fadeIn">
        <h1 class="glowing-title display-4 stencil-text"><?php echo __t('howto', 'title'); ?></h1>
        <div class="data-stream d-inline-block">
            <i class="fas fa-book-dead"></i> <?php echo __t('howto', 'subtitle'); ?>
        </div>
    </header>

    <div class="row">
        <div class="col-lg-3 mb-4">
            <div class="citadel-card p-2 sticky-top" style="top: 100px; z-index: 10;">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <button class="nav-link active btn-cyber text-start mb-2" data-bs-toggle="pill" data-bs-target="#reg" type="button">
                        <i class="fas fa-user-plus mr-2"></i> <?php echo __t('howto', 'reg'); ?>
                    </button>
                    <button class="nav-link btn-cyber text-start mb-2" data-bs-toggle="pill" data-bs-target="#profile" type="button">
                        <i class="fas fa-id-card mr-2"></i> <?php echo __t('howto', 'prof'); ?>
                    </button>
                    <button class="nav-link btn-cyber text-start mb-2" data-bs-toggle="pill" data-bs-target="#social" type="button">
                        <i class="fas fa-users mr-2"></i> <?php echo __t('howto', 'social'); ?>
                    </button>
                    <button class="nav-link btn-cyber text-start mb-2" data-bs-toggle="pill" data-bs-target="#points" type="button">
                        <i class="fas fa-award mr-2"></i> <?php echo __t('howto', 'rep'); ?>
                    </button>
                    <button class="nav-link btn-cyber text-start" data-bs-toggle="pill" data-bs-target="#vdp" type="button">
                        <i class="fas fa-code-branch mr-2"></i> <?php echo __t('howto', 'vdp'); ?>
                    </button>
                </div>
            </div>
        </div>

        <div class="col-lg-9">
            <div class="tab-content animate__animated animate__fadeInRight" id="v-pills-tabContent">
                
                <div class="tab-pane fade show active" id="reg" role="tabpanel">
                    <div class="citadel-card mb-4">
                        <h2 class="text-neon-blue stencil-text mb-4"><i class="fas fa-fingerprint"></i> <?php echo __t('howto', 'reg_h'); ?></h2>
                        <ul class="list-unstyled text-secondary">
                            <li class="mb-3"><i class="fas fa-check text-alien-green mr-2"></i> <?php echo __t('howto', 'reg_p1'); ?></li>
                            <li class="mb-3"><i class="fas fa-shield-alt text-neon-blue mr-2"></i> <?php echo __t('howto', 'reg_p2'); ?></li>
                        </ul>
                        <div class="alert bg-black border-neon-blue text-neon-blue small font-mono">
                            <i class="fas fa-microchip"></i> <?php echo __t('howto', 'reg_p3'); ?>
                        </div>
                        <hr class="border-secondary opacity-25">
                        <h3 class="h5 text-white"><?php echo __t('howto', 'login_h'); ?></h3>
                        <p class="text-danger small italic"><i class="fas fa-exclamation-triangle"></i> <?php echo __t('howto', 'login_p'); ?></p>
                    </div>
                </div>

                <div class="tab-pane fade" id="profile" role="tabpanel">
                    <div class="citadel-card mb-4 border-alien-green">
                        <h2 class="text-alien-green stencil-text mb-4"><i class="fas fa-address-card"></i> <?php echo __t('howto', 'profile_h'); ?></h2>
                        <p class="text-secondary"><?php echo __t('howto', 'profile_p'); ?></p>
                        <div class="row g-2 mt-3">
                            <div class="col-6 col-md-3 text-center">
                                <div class="p-3 bg-dark border border-secondary rounded">
                                    <i class="fas fa-camera fa-2x mb-2 text-neon-blue"></i>
                                    <div class="small text-white"><?php echo __t('howto', 'avatar'); ?></div>
                                </div>
                            </div>
                            <div class="col-6 col-md-3 text-center">
                                <div class="p-3 bg-dark border border-secondary rounded">
                                    <i class="fas fa-edit fa-2x mb-2 text-alien-green"></i>
                                    <div class="small text-white"><?php echo __t('howto', 'mkdl'); ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="citadel-card border-space-purple">
                        <h3 class="text-space-purple stencil-text mb-3"><?php echo __t('howto', 'dash_h'); ?></h3>
                        <p class="text-secondary"><?php echo __t('howto', 'dash_p'); ?></p>
                    </div>
                </div>

                <div class="tab-pane fade" id="social" role="tabpanel">
                    <div class="citadel-card mb-4">
                        <h2 class="text-neon-blue stencil-text mb-4"><i class="fas fa-rss"></i> <?php echo __t('howto', 'feed_h'); ?></h2>
                        <p class="text-secondary"><?php echo __t('howto', 'feed_p'); ?></p>
                        <hr class="border-secondary opacity-25">
                        <h3 class="h5 text-white"><?php echo __t('howto', 'citizens_h'); ?></h3>
                        <p class="text-secondary"><?php echo __t('howto', 'citizens_p'); ?></p>
                        <div class="alert bg-dark border-danger text-danger small">
                            <i class="fas fa-shredder"></i> <?php echo __t('howto', 'sever_connection'); ?>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="points" role="tabpanel">
                    <div class="citadel-card mb-4">
                        <h2 class="text-alien-green stencil-text mb-4"><i class="fas fa-star"></i> <?php echo __t('howto', 'points_h'); ?></h2>
                        <p class="text-secondary mb-4"><?php echo __t('howto', 'points_p'); ?></p>
                        
                        <div class="table-responsive">
                            <table class="table table-dark table-borderless font-mono small">
                                <thead>
                                    <tr class="border-bottom border-alien-green">
                                        <th><?php echo __t('howto', 'at'); ?></th>
                                        <th><?php echo __t('howto', 'iv'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr><td><?php echo __t('howto', 'ld'); ?></td><td>+1 / -1</td></tr>
                                    <tr class="text-alien-green"><td><?php echo __t('howto', 'lds'); ?></td><td>+5</td></tr>
                                    <tr class="text-danger"><td><?php echo __t('howto', 'lds1'); ?></td><td>-5</td></tr>
                                    <tr><td><?php echo __t('howto', 'comment'); ?></td><td>+2</td></tr>
                                    <tr><td><?php echo __t('howto', 'connection'); ?></td><td>+10</td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="vdp" role="tabpanel">
                    <div class="citadel-card">
                        <h2 class="text-space-purple stencil-text mb-4"><i class="fas fa-bug"></i> <?php echo __t('howto', 'coders_h'); ?></h2>
                        <p class="text-secondary"><?php echo __t('howto', 'coders_p'); ?></p>
                        <div class="mt-4">
                            <a href="https://github.com/TheWyv3rn/MyCitadel" target="_blank" class="btn-cyber me-3">
                                <i class="fab fa-github"></i> <?php echo __t('howto', 'git'); ?>
                            </a>
                            <a href="mailto:security@mycitadel.lol" class="btn-cyber border-space-purple text-space-purple">
                                <i class="fas fa-envelope"></i> <?php echo __t('howto', 'sec'); ?>
                            </a>
                        </div>
                        <div class="mt-4 row g-3 text-center">
                            <div class="col-md-3 small text-secondary"><?php echo __t('howto', 'ho'); ?></div>
                            <div class="col-md-3 small text-secondary"><?php echo __t('howto', 'bc'); ?></div>
                            <div class="col-md-3 small text-secondary"><?php echo __t('howto', 'it'); ?></div>
                            <div class="col-md-3 small text-secondary"><?php echo __t('howto', 'yh'); ?></div>
                        </div>
                    </div>
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
    /* Tab Transitions */
    .nav-pills .nav-link { 
        border-radius: 0; 
        border: 1px solid transparent; 
        color: var(--text-secondary);
    }
    .nav-pills .nav-link.active { 
        background: rgba(0, 242, 255, 0.1) !important; 
        border-color: var(--neon-blue) !important; 
        color: var(--neon-blue) !important;
    }
    .btn-cyber:hover { border-color: var(--alien-green); color: var(--alien-green); }
    
    .table td { padding: 1rem 0; border-bottom: 1px solid rgba(255,255,255,0.05); }
</style>

<?php require_once __DIR__ . '/includes/footer.php'; ?>