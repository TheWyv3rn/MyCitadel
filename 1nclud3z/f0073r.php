<?php
/**
 * MyCitadel - Operations Footer (Scoped Edition)
 * Dynamic Resource Management & Security Sanitization
 */
?>
    </main> 
    
    <footer class="footer mt-auto py-4 bg-black border-top border-secondary">
        <div class="container text-center">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <h5 class="citadel-brand text-primary">MYCITADEL</h5>
                    <p class="small text-muted"><?php echo __t('footer', 'tagline'); ?></p>
                </div>
                
                <div class="col-md-4 mb-3">
                    <ul class="list-unstyled">
                        <li>
                            <a href="/security" class="text-decoration-none text-secondary small">
                                <?php echo __t('footer', 'link_security'); ?>
                            </a>
                        </li>
                        <li>
                            <a href="/api" class="text-decoration-none text-secondary small">
                                <?php echo __t('footer', 'link_api'); ?>
                            </a>
                        </li>
                    </ul>
                </div>
                
                <div class="col-md-4 mb-3">
                    <span class="text-muted small">
                        &copy; <?php echo date("Y"); ?> <?php echo __t('footer', 'copyright'); ?>
                    </span>
                    <div class="mt-2">
                        <a href="https://github.com/TheWyv3rn/MyCitadel" target="_blank" class="text-secondary mx-2"><i class="fab fa-github"></i></a>
                        <a href="mailto:info@mycitadel.lol" class="text-secondary mx-2"><i class="fas fa-envelope"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="<?php echo ASSET_PATH; ?>b007str4p/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo ASSET_PATH; ?>DOMPurify/dist/purify.min.js"></script>

    <?php if (isset($load_assets) && is_array($load_assets)): ?>
        
        <?php if (in_array('charts', $load_assets)): ?>
            <script src="<?php echo ASSET_PATH; ?>ch4r7js/chart.umd.min.js"></script>
            <script src="<?php echo ASSET_PATH; ?>apexcharts-main/dist/apexcharts.min.js"></script>
        <?php endif; ?>

        <?php if (in_array('particles', $load_assets)): ?>
            <script src="<?php echo ASSET_PATH; ?>particles.js-master/particles.min.js"></script>
        <?php endif; ?>

        <?php if (in_array('security', $load_assets)): ?>
            <script src="<?php echo ASSET_PATH; ?>zxcvbn-master/dist/zxcvbn.js"></script>
            <script src="<?php echo ASSET_PATH; ?>toastify-js-master/src/toastify.js"></script>
        <?php endif; ?>

        <?php if (in_array('forms', $load_assets)): ?>
            <script src="<?php echo ASSET_PATH; ?>Choices-main/public/assets/scripts/choices.min.js"></script>
            <script src="<?php echo ASSET_PATH; ?>tippyjs-master/dist/tippy-bundle.umd.min.js"></script>
        <?php endif; ?>

    <?php endif; ?>

    <script>
        /**
         * Citadel Client-Side Handshake
         */
        
        // 1. Initialize DOMPurify for global use
        const clean = (dirty) => DOMPurify.sanitize(dirty);

        // 2. Tippy.js Initialization
        if (typeof tippy !== 'undefined') {
            tippy('[data-tippy-content]', {
                theme: 'citadel',
                animation: 'shift-away'
            });
        }

        // 3. Particles.js Logic
        if (typeof particlesJS !== 'undefined' && document.getElementById('particles-js')) {
            particlesJS.load('particles-js', '<?php echo ASSET_PATH; ?>particles.js-master/demo/particles.json');
        }

        // 4. Global Toast Helper (using localized strings)
        window.citadelAlert = (msg) => {
            if (typeof Toastify !== 'undefined') {
                Toastify({
                    text: msg,
                    duration: 3000,
                    gravity: "top",
                    position: "right",
                    style: { background: "#00d4ff" }
                }).showToast();
            }
        };
    </script>
</body>
</html>