<?php
/**
 * PROJECT: MY CITADEL
 * MODULE: SYSTEM INTELLIGENCE FOOTER (SIF)
 * VERSION: 1.2.0 (PHP 8.2+)
 * DESCRIPTION: Provides real-time telemetry, server intel, and encryption integrity checks.
 * Closes the global structure initiated in header.php.
 */

declare(strict_types=1);

/**
 * Server Intel Logic
 * Captures core telemetry for the dashboard readout.
 */
$mem_usage = round(memory_get_usage(true) / 1024 / 1024, 2);
$sys_load  = sys_getloadavg();
$uptime    = @shell_exec('uptime -p') ?: 'Uptime Unavailable';
$sodium_status = extension_loaded('sodium') ? 'SODIUM_V' . SODIUM_LIBRARY_VERSION : 'ENCRYPTION_DISABLED';

// Database Integrity Mock (Replace with actual connection check)
$db_status = defined('DB_CONNECTED') ? 'INTEGRITY_VERIFIED' : 'CORE_OFFLINE';
?>
    </main> <!-- Closing <main> from header.php -->

    <!-- [CITADEL SYSTEM INTELLIGENCE FOOTER] -->
    <footer class="citadel-footer mt-auto py-5 border-top border-neon">
        <div class="container">
            <div class="row g-4">
                
                <!-- Column 1: System Identification -->
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

                <!-- Column 2: Server Telemetry -->
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

                <!-- Column 3: Integrity & Links -->
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
                        * <a href="/vdp.php" class="glitch-link mr-3 small"><?php echo __t('footer', 'vdp'); ?></a><br/>
                        * <a href="/policies.php" class="glitch-link small"><?php echo __t('footer', 'prt'); ?></a>
                    </div>
                </div>

            </div>

            <!-- Bottom Bar -->
            <div class="text-center mt-5 pt-4 border-top border-dark opacity-50">
                <p class="small text-secondary mb-0">
                    &copy; <?php echo date('Y'); ?> <span class="stencil-text"><?php echo __t('footer', 'mc'); ?></span> // <?php echo __t('footer', 'nzk'); ?>
                </p>
            </div>
        </div>
    </footer>

    <!-- [VENDOR JAVASCRIPT ASSETS] -->
    <!-- Bootstrap Bundle with Popper -->
    <script src="assets/vendor/bootstrap-5.2.3-dist/js/bootstrap.bundle.min.js"></script>
    <!-- Toastify for Notifications -->
    <script src="assets/vendor/toastify-js-master/src/toastify.js"></script>
    <!-- ApexCharts Core -->
    <script src="assets/vendor/apexcharts.js-main/dist/apexcharts.min.js"></script>
    
    <!-- [CITADEL SENTRY & HEARTBEAT] -->
    <script src="assets/js/main.js"></script>
    
    <script>
        /**
         * Real-time UI Heartbeat
         * Monitors memory and interaction client-side.
         */
        document.addEventListener('DOMContentLoaded', () => {
            // Trigger Fade-in
            setTimeout(() => document.body.classList.add('loaded'), 100);

            // Periodic Integrity Check
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