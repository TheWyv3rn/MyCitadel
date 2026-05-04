</main> <?php
        // PHP Telemetry Calculations
        $gen_time = isset($start_time) ? round((microtime(true) - $start_time) * 1000, 2) . ' ms' : 'SECURE';
        $mem_usage = round(memory_get_usage() / 1024, 1) . ' KB';
        $server_os = php_uname('s'); // e.g., Linux
    ?>

    <footer class="container" style="margin-top: 5rem; margin-bottom: 2rem;">
        <div class="cyber-panel p-4">
            <div class="row align-items-center text-center text-md-start">
                
                <div class="col-md-4 mb-3 mb-md-0" style="font-family: var(--font-terminal); font-size: 0.85rem; color: #00ff00;">
                    <div class="mb-1"><i class="fas fa-server me-2 text-muted"></i> OS: <?php echo $server_os; ?>_NODE</div>
                    <div class="mb-1"><i class="fas fa-memory me-2 text-muted"></i> MEM: <?php echo $mem_usage; ?></div>
                    <div><i class="fas fa-bolt me-2 text-muted"></i> GEN: <?php echo $gen_time; ?></div>
                </div>

                <div class="col-md-4 text-center mb-3 mb-md-0">
                    <p class="mb-2" style="font-family: var(--font-terminal); color: var(--hud-cyan); font-size: 1rem; text-shadow: 0 0 5px var(--hud-cyan-glow);">
                        <i class="fas fa-shield-alt"></i> <span class="glitch-hover" data-text="// NODE SECURED //">// NODE SECURED //</span> <i class="fas fa-shield-alt"></i><br>
                        <span style="font-size: 0.8rem; color: #a0b0c0;">ZERO ADS • ZERO TRACKING • XChaCha20</span>
                    </p>
                    
                    <div style="font-family: var(--font-body); font-size: 0.85rem;">
                        <a href="policies.php" class="footer-link">Privacy Policy</a> <span class="text-muted mx-1">|</span> 
                        <a href="vdp.php" class="footer-link text-warning">Bug Bounty</a> <span class="text-muted mx-1">|</span>
                        <a href="https://github.com/TheWyv3rn/MyCitadel" target="_blank" class="footer-link">Source Code</a>
                    </div>
                    
                    <div class="mt-2" style="font-family: var(--font-body); font-size: 0.75rem; color: #666;">
                        &copy; <?php echo date("Y"); ?> Brogan Cole Gallagher (TheWyv3rn) | MyCitadel Operations
                    </div>
                </div>

                <div class="col-md-4 text-center text-md-end" style="font-family: var(--font-terminal); font-size: 0.85rem; color: var(--hud-cyan);">
                    <div class="mb-1">
                        <i class="fas fa-satellite-dish me-2"></i> UPLINK: <span id="live-ping" style="color: #00ff00;">12ms</span>
                    </div>
                    <div class="mb-1">
                        <i class="fas fa-globe me-2"></i> NET: IPv4/IPv6 SECURE
                    </div>
                    <div>
                        <i class="fas fa-clock me-2"></i> SYS_TIME: <span id="live-clock">00:00:00 UTC</span>
                    </div>
                </div>

            </div>
        </div>
    </footer>

    <!-- ==========================================
         BACK-END JS OPERATIONS & VENDORS
         (Loaded at the bottom for optimized page speed)
    =========================================== -->

    <!-- 1. Core Framework -->
    <script src="assets/vendor/bootstrap-5.2.3-dist/js/bootstrap.bundle.min.js"></script>

    <!-- 2. UI, Animation, & Data Visualization -->
    <!-- Particles.js for the Cyber Background -->
    <script src="assets/vendor/particles.js-master/particles.min.js"></script>
    <!-- Toastify for sleek, non-intrusive notifications -->
    <script src="assets/vendor/toastify-js-master/src/toastify.js"></script>
    <!-- Tippy.js for advanced tooltips -->
    <script src="assets/vendor/tippyjs-master/headless/tippy.umd.min.js"></script>
    <!-- Choices.js for customized, techy select boxes -->
    <script src="assets/vendor/Choices-main/public/assets/scripts/choices.min.js"></script>
    <!-- ApexCharts for rendering Reputation/Influence data -->
    <script src="assets/vendor/apexcharts.js-main/dist/apexcharts.min.js"></script>

    <!-- 3. Security, Input, & Cryptography Prep -->
    <!-- DOMPurify to sanitize ALL user input against XSS -->
    <script src="assets/vendor/DOMPurify-main/dist/purify.min.js"></script>
    <!-- zxcvbn for client-side password strength estimation -->
    <script src="assets/vendor/zxcvbn-master/dist/zxcvbn.js"></script>
    <!-- EasyMDE for Markdown editing (Forum/Posts) -->
    <script src="assets/vendor/easy-markdown-editor-master/dist/easymde.min.js"></script>

    <!-- ==========================================
         GLOBAL SYSTEM INITIALIZATION
    =========================================== -->
   <style>
        /* Footer Link Hover States */
        .footer-link { color: #a0b0c0; text-transform: uppercase; transition: all 0.2s; }
        .footer-link:hover { color: var(--hud-cyan); text-shadow: 0 0 8px var(--hud-cyan-glow); letter-spacing: 1px; }
        .footer-link.text-warning { color: var(--blood-red) !important; }
        .footer-link.text-warning:hover { color: var(--rune-orange) !important; text-shadow: 0 0 8px var(--rune-orange-glow); }
        
        /* The Cyber Glitch Text Effect */
        .glitch-hover { cursor: crosshair; transition: all 0.1s; display: inline-block; }
        .glitch-hover:hover { color: #fff; text-shadow: 2px 0 var(--rune-orange), -2px 0 var(--hud-cyan); animation: glitch 0.2s linear infinite; }
        @keyframes glitch {
            0% { transform: translate(0) }
            20% { transform: translate(-2px, 1px) }
            40% { transform: translate(-1px, -1px) }
            60% { transform: translate(2px, 1px) }
            80% { transform: translate(1px, -1px) }
            100% { transform: translate(0) }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // 1. LIVE SYSTEM CLOCK (UTC for hacker credibility)
            function updateClock() {
                const now = new Date();
                const timeString = now.toISOString().substring(11, 19) + ' UTC';
                document.getElementById('live-clock').textContent = timeString;
            }
            setInterval(updateClock, 1000);
            updateClock();

            // 2. SIMULATED NETWORK LATENCY (Bounces between 8ms and 24ms)
            function updatePing() {
                const pingElement = document.getElementById('live-ping');
                const randomPing = Math.floor(Math.random() * (24 - 8 + 1) + 8);
                pingElement.textContent = randomPing + 'ms';
                
                // Change color if ping "spikes"
                if (randomPing > 20) {
                    pingElement.style.color = 'var(--rune-orange)';
                } else {
                    pingElement.style.color = '#00ff00';
                }
            }
            setInterval(updatePing, 2500); // Updates every 2.5 seconds

            // 3. SYSTEM BOOT TOAST NOTIFICATION
            if (typeof Toastify !== 'undefined') {
                Toastify({
                    text: "> UPLINK ESTABLISHED. WELCOME, CITIZEN.",
                    duration: 3500,
                    gravity: "bottom",
                    position: "right",
                    style: {
                        background: "rgba(15, 18, 25, 0.95)",
                        color: "#00f0ff",
                        borderLeft: "4px solid #00f0ff",
                        fontFamily: "'Share Tech Mono', monospace",
                        boxShadow: "0 0 10px rgba(0, 240, 255, 0.2)"
                    }
                }).showToast();
            }
        });
    </script>
</body>
</html>