<?php
/**
 * MyCitadel - High-Tech HUD Operations
 * Security Level: Zero-Retention / AI-PreFlight Active
 */

require_once __DIR__ . '/../private/citadel_config.php';

$page_title = __t('index', 'hero_title');
$no_index = true; // Security: Keep the Citadel off public crawlers

// Load Header (which pulls in our HUD CSS and Vendors)
require_once __DIR__ . '/1nclud3z/h34d3r.php'; 
?>

<div id="particles-js" class="position-fixed w-100 h-100" style="z-index: 1; pointer-events: none;"></div>

<div class="container position-relative" style="z-index: 2;">
    
    <section class="min-vh-100 d-flex align-items-center">
        <div class="w-100">
            <div class="row align-items-center">
                <div class="col-lg-6 text-start animate__animated animate__fadeInLeft">
                    <div class="telemetry-box mb-3">
                        <span class="text-primary fw-bold"><?php echo __t('index', 'status'); ?></span> 
                        <span class="animate__animated animate__flash animate__infinite"><?php echo __t('index', 'encryption_active'); ?></span>
                    </div>
                    <h1 class="display-2 fw-bold mb-4 text-glow">
                        <?php echo __t('index', 'hero_title'); ?>
                    </h1>
                    <p class="lead text-secondary mb-5 max-width-500">
                        <?php echo __t('index', 'hero_subtitle'); ?>
                    </p>
                    <div class="d-flex gap-3">
                        <button class="btn btn-primary btn-lg hud-bevel" onclick="citadelAlert('<?php echo __t('common', 'alert_handshake'); ?>')">
                            <?php echo __t('common', 'btn_get_started'); ?>
                        </button>
                        <a href="/vault" class="btn btn-outline-secondary btn-lg">
                            <?php echo __t('common', 'btn_explore_vault'); ?>
                        </a>
                    </div>
                </div>
                
                <div class="col-lg-6 d-none d-lg-block animate__animated animate__fadeInRight">
                    <div class="hud-panel p-4">
                        <div class="d-flex justify-content-between mb-3 border-bottom border-secondary pb-2">
                            <small class="text-primary"><?php echo __t('index', 'pre_flight'); ?></small>
                            <small class="text-muted"><?php echo __t('index', 'scanning'); ?></small>
                        </div>
                        <canvas id="citadelTrafficChart" style="max-height: 250px;"></canvas>
                        <div class="mt-4 small text-muted font-data">
                            <div id="ai-log">
                                <p><?php echo __t('index', 'local_vault'); ?></p>
                                <p><?php echo __t('index', 'zero_retention'); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="row g-4">
            <div class="col-md-12 text-center mb-5">
                <h2 class="citadel-brand"><?php echo __t('index', 'policy_title'); ?></h2>
                <p class="text-danger fw-bold animate__animated animate__pulse animate__infinite">
                    <?php echo __t('index', 'policy_warning'); ?>
                </p>
            </div>
            
            <div class="col-md-4">
                <div class="hud-panel p-4 text-center">
                    <i class="fas fa-brain text-primary mb-3 fa-2x"></i>
                    <h5 class="text-light"><?php echo __t('index', 'ai_guard_title'); ?></h5>
                    <p class="small text-muted"><?php echo __t('index', 'ai_guard_desc'); ?></p>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="hud-panel p-4 text-center border-danger">
                    <i class="fas fa-skull-crossbones text-danger mb-3 fa-2x"></i>
                    <h5 class="text-danger"><?php echo __t('index', 'purge_title'); ?></h5>
                    <p class="small text-muted"><?php echo __t('index', 'purge_desc'); ?></p>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="hud-panel p-4 text-center">
                    <i class="fas fa-ghost text-primary mb-3 fa-2x"></i>
                    <h5 class="text-light"><?php echo __t('index', 'anonymity_title'); ?></h5>
                    <p class="small text-muted"><?php echo __t('index', 'anonymity_desc'); ?></p>
                </div>
            </div>
        </div>
    </section>

</div>

<?php 
// Load heavy artillery for the dashboard
$load_assets = ['particles', 'charts', 'security', 'forms'];
require_once __DIR__ . '/1nclud3z/f0073r.php'; 
?>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const ctx = document.getElementById('citadelTrafficChart');
    if(ctx) {
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['00h', '04h', '08h', '12h', '16h', '20h'],
                datasets: [{
                    label: 'Anomalies Detected',
                    data: [12, 19, 3, 5, 2, 3],
                    borderColor: '#00d4ff',
                    backgroundColor: 'rgba(0, 212, 255, 0.1)',
                    borderWidth: 1,
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                plugins: { legend: { display: false } },
                scales: { y: { display: false }, x: { grid: { display: false } } }
            }
        });
    }

    // SIMULATED AI PRE-FLIGHT LOGIC
    window.preFlightScan = (inputData) => {
        const forbidden = [/hateful_regex/i, /criminal_regex/i]; // Targeted local patterns
        const isClean = !forbidden.some(regex => regex.test(inputData));
        
        if (!isClean) {
            citadelAlert("CRITICAL: CONTENT VIOLATION DETECTED. INFRACTION LOGGED.");
            return false;
        }
        return true;
    };
});
</script>
<script>
    // URL Parameter Sanitization Handshake
    if (window.history.replaceState) {
        // This removes the ?lang=xx from the URL bar after the page loads
        const cleanUrl = window.location.protocol + "//" + window.location.host + window.location.pathname;
        window.history.replaceState({path: cleanUrl}, '', cleanUrl);
    }
</script>