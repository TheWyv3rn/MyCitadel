<?php
/**
 * PROJECT: MY CITADEL
 * MODULE: SYSTEM INTELLIGENCE FOOTER (SIF)
 * VERSION: 1.2.1
 * DESCRIPTION: Provides real-time telemetry and handles global script loading via absolute paths.
 */

declare(strict_types=1);

$mem_usage = round(memory_get_usage(true) / 1024 / 1024, 2);
$sys_load  = sys_getloadavg();
$uptime    = @shell_exec('uptime -p') ?: 'Uptime Unavailable';
$sodium_status = extension_loaded('sodium') ? 'SODIUM_V' . SODIUM_LIBRARY_VERSION : 'ENCRYPTION_DISABLED';

// Database status check
$db_status = 'CORE_OFFLINE';
try {
    if (citadel_db()) { $db_status = 'INTEGRITY_VERIFIED'; }
} catch (Exception $e) {}
?>
    </main>

    <footer class="citadel-footer mt-auto py-5 border-top border-neon">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6 animate__animated animate__fadeIn">
                    <h5 class="stencil-text text-neon-blue mb-4">
                        <i class="fas fa-microchip"></i> <?php echo __t('footer', 'ci'); ?>
                    </h5>
                    <ul class="list-unstyled footer-status small">
                        <li class="mb-2">
                            <span class="text-secondary"><?php echo __t('footer', 'esid'); ?>:</span> 
                            <span class="data-stream text-white"><?php echo $tracking_data['esid'] ?? 'UNSET'; ?></span>
                        </li>
                        <li class="mb-2">
                            <span class="text-secondary"><?php echo __t('footer', 'ap'); ?>:</span> 
                            <span class="text-neon-blue"><?php echo $tracking_data['masked_ip'] ?? '0.0.x.x'; ?></span>
                        </li>
                        <li class="mb-2">
                            <span class="text-secondary"><?php echo __t('footer', 'ce'); ?>:</span> 
                            <span class="text-alien-green"><?php echo $sodium_status; ?></span>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-6 animate__animated animate__fadeIn" style="animation-delay: 0.1s;">
                    <h5 class="stencil-text text-neon-blue mb-4">
                        <i class="fas fa-server"></i> <?php echo __t('footer', 'nt'); ?>
                    </h5>
                    <ul class="list-unstyled footer-status small">
                        <li class="mb-2">
                            <span class="text-secondary"><?php echo __t('footer', 'ml'); ?>:</span> 
                            <span class="text-white"><?php echo $mem_usage; ?> MB</span>
                        </li>
                        <li class="mb-2">
                            <span class="text-secondary"><?php echo __t('footer', 'cl'); ?>:</span> 
                            <span class="text-white"><?php echo $sys_load[0]; ?>% / 5m</span>
                        </li>
                        <li class="mb-2">
                            <span class="text-secondary"><?php echo __t('footer', 'su'); ?>:</span> 
                            <span class="text-white italic"><?php echo trim($uptime); ?></span>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-12 animate__animated animate__fadeIn" style="animation-delay: 0.2s;">
                    <h5 class="stencil-text text-neon-blue mb-4">
                        <i class="fas fa-database"></i> <?php echo __t('footer', 'core_i'); ?>
                    </h5>
                    <div class="mb-4">
                        <span class="data-stream <?php echo ($db_status === 'INTEGRITY_VERIFIED') ? 'text-alien-green' : 'text-danger'; ?>">
                            <i class="fas fa-shield-virus"></i> <?php echo $db_status; ?>
                        </span>
                    </div>
                    <div class="footer-links">
                        * <a href="<?php echo SITE_URL; ?>/vdp.php" class="glitch-link mr-3 small"><?php echo __t('footer', 'vdp'); ?></a><br/>
                        * <a href="<?php echo SITE_URL; ?>/policies.php" class="glitch-link small"><?php echo __t('footer', 'prt'); ?></a>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5 pt-4 border-top border-dark opacity-50">
                <p class="small text-secondary mb-0">
                    &copy; <?php echo date('Y'); ?> <span class="stencil-text"><?php echo __t('footer', 'mc'); ?></span> // <?php echo __t('footer', 'nzk'); ?>
                </p>
            </div>
        </div>
    </footer>

    <!-- [VENDOR JAVASCRIPT ASSETS - ABSOLUTE PATHING] -->
    <script src="<?php echo VENDOR_URL; ?>/bootstrap-5.2.3-dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo VENDOR_URL; ?>/toastify-js-master/src/toastify.js"></script>
    <script src="<?php echo VENDOR_URL; ?>/apexcharts.js-main/dist/apexcharts.min.js"></script>
    
    <!-- [CITADEL SENTRY & HEARTBEAT] -->
    <script src="<?php echo ASSETS_URL; ?>/js/main.js?v=<?php echo filemtime(BASE_PATH . '/assets/js/main.js'); ?>"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            setTimeout(() => document.body.classList.add('loaded'), 100);
            setInterval(() => {
                const perf = window.performance.memory;
                if (perf && perf.usedJSHeapSize > 100 * 1024 * 1024) {
                    console.warn("[CITADEL]: High memory usage detected.");
                }
            }, 5000);
        });
    </script>
</body>
</html>