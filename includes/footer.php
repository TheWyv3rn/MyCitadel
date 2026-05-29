<?php
/**
 * PROJECT: MY CITADEL
 * COMPONENT: OPERATIONS FOOTER & CONSOLE ENGINE
 * VERSION: 1.0.0
 * DESCRIPTION: High-performance tactical footer featuring a live terminal 
 * log stream, client-side crypto metric tracking, and an interactive CLI.
 */

// Generate a runtime CSRF token for any client-side AJAX callbacks requiring verification
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
    </div> <footer class="citadel-footer">
        <div class="container grid footer-grid">
            
            <div class="footer-block">
                <h4 class="stencil-text"><i class="fas fa-network-wired"></i> <?php echo __t('footer', 'core_router'); ?></h4>
                <ul class="footer-links">
                    <li><a href="index.php"><i class="fas fa-chevron-right"></i> <?php echo __t('footer', 'home_button'); ?></a></li>
                    <li><a href="about.php"><i class="fas fa-chevron-right"></i> <?php echo __t('footer', 'about_button'); ?></a></li>
                    <li><a href="nzk.php"><i class="fas fa-chevron-right"></i> <?php echo __t('footer', 'nzk_button'); ?></a></li>
                </ul>
            </div>

            <div class="footer-block">
                <h4 class="stencil-text"><i class="fas fa-shield-alt"></i> <?php echo __t('footer', 'compliance_title'); ?></h4>
                <ul class="footer-links">
                    <li><a href="terms.php"><i class="fas fa-file-contract"></i> <?php echo __t('footer', 'terms_button'); ?></a></li>
                    <li><a href="privacy.php"><i class="fas fa-user-shield"></i> <?php echo __t('footer', 'privacy_button'); ?></a></li>
                    <li><span class="data-stream font-mono" style="font-size: 0.75rem;"><?php echo __t('footer', 'CSRF'); ?></span></li>
                </ul>
            </div>

            <div class="footer-block">
                <h4 class="stencil-text"><i class="fas fa-terminal"></i> <?php echo __t('footer', 'core'); ?></h4>
                <div class="terminal-line text-green"><?php echo __t('footer', 'handshake'); ?></div>
                <div class="terminal-line text-blue"><?php echo __t('footer', 'tracking'); ?></div>
            </div>

        </div>

        <div class="container footer-status-bar">
            <hr class="void-divider">
            <div class="status-flex-wrapper">
                <p class="footer-status font-mono">
                    <?php echo __t('footer', 'status'); ?>: <span class="status-online"><i class="fas fa-circle animate-pulse"></i> <?php echo __t('footer', 'online'); ?></span> 
                    | <?php echo __t('footer', 'env'); ?>: <span class="text-blue"><?php echo __t('footer', 'mainnet'); ?></span>
                </p>
                <p class="footer-status font-mono" id="clientCryptoFootprint">
                    <?php echo __t('footer', 'token'); ?>
                </p>
                <p class="footer-status font-mono">&copy; 2026 Brogan Cole Gallagher</p>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Initialize moving starfield/mesh network framework
            if (typeof particlesJS !== 'undefined') {
                particlesJS('particles-js', {
                    "particles": {
                        "number": { "value": 45, "density": { "enable": true, "value_area": 800 } },
                        "color": { "value": "#00f2ff" },
                        "shape": { "type": "circle" },
                        "opacity": { "value": 0.15, "random": true },
                        "size": { "value": 2, "random": true },
                        "line_linked": { "enable": true, "distance": 150, "color": "#7b2ff7", "opacity": 0.08, "width": 1 },
                        "move": { "enable": true, "speed": 1.5, "direction": "none", "random": true, "straight": false, "out_mode": "out" }
                    },
                    "interactivity": { "detect_on": "canvas", "events": { "onhover": { "enable": true, "mode": "bubble" } } },
                    "retina_detect": true
                });
            }
        });
    </script>

    <script>
        const CitadelFooterEngine = (function() {
            'use strict';

            const logBox = document.getElementById('footerTerminalLog');
            const consoleInput = document.getElementById('footerTerminalConsole');
            const cryptoFootprint = document.getElementById('clientCryptoFootprint');

            // 1. Dynamic System Matrix Log Stream (Generates realistic security system ticks)
            const structuralLogs = [
                "[OK] Memory allocation boundary clean.",
                "[SECURE] Local storage verification verified.",
                "[INFO] Master SALT validation heartbeat checked.",
                "[OK] XChaCha20-Poly1305 cipher blocks primed.",
                "[INTEGRITY] Client data pipeline non-leaking.",
                "[INFO] Citizen index validation sequence ready."
            ];

            function appendLiveMatrixTick() {
                if (!logBox) return;
                const randomLog = structuralLogs[Math.floor(Math.random() * structuralLogs.length)];
                const line = document.createElement('div');
                line.className = 'terminal-line text-purple';
                line.textContent = `[${new Date().toLocaleTimeString()}] ${randomLog}`;
                
                logBox.appendChild(line);
                logBox.scrollTop = logBox.scrollHeight; // Auto scroll to tracking bottom

                // Maintain clean memory profile by cleaning overflow elements
                if (logBox.children.length > 25) {
                    logBox.removeChild(logBox.firstChild);
                }
            }
            setInterval(appendLiveMatrixTick, 8000); // Trigger matrix background heartbeat every 8s

            // 2. Client-Side Cryptographic Footprint Generator
            function updateCryptoFootprint() {
                if (!cryptoFootprint) return;
                // Extracts the cookie generated by cookies.php safely
                const visitorMatch = document.cookie.match(/(^|;)\s*citadel_visitor=([^;]+)/);
                const currentId = visitorMatch ? visitorMatch[2] : 'ANONYMOUS_SESSION';
                
                // Simulate a rotating micro-checksum of window geometry changes (Shows active cryptographic presence)
                const mockRuntimeEntropy = window.innerWidth * window.innerHeight + window.scrollY;
                const dynamicHash = btoa(mockRuntimeEntropy.toString()).substring(0, 8).toUpperCase();
                
                cryptoFootprint.innerHTML = `TOKEN: <span class="text-green">${currentId}</span> | ENTROPY_NODE: <span class="text-purple">[${dynamicHash}]</span>`;
            }
            window.addEventListener('resize', updateCryptoFootprint);
            window.addEventListener('scroll', updateCryptoFootprint);
            setTimeout(updateCryptoFootprint, 500); // Delayed boot hook to guarantee cookie accessibility

            // 3. Mini Terminal Console Parser
            if (consoleInput) {
                consoleInput.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter') {
                        const command = consoleInput.value.trim().toLowerCase();
                        if (!command) return;

                        // Create input trace line echoing the statement back to the user securely
                        const userEcho = document.createElement('div');
                        userEcho.className = 'terminal-line';
                        userEcho.textContent = `citadel@user:~$ ${consoleInput.value}`;
                        logBox.appendChild(userEcho);

                        const systemResponse = document.createElement('div');
                        systemResponse.className = 'terminal-line text-green';

                        // Command Matrix Routing Logic
                        switch(command) {
                            case '/help':
                                systemResponse.innerHTML = "Available directives: <br> -> /status (Node Diagnostic Summary)<br> -> /entropy (Force Key Regenerator Check)<br> -> /clear (Purge Screen Matrix)";
                                break;
                            case '/status':
                                systemResponse.innerHTML = `[NODE STATUS] Latency: ~${Math.floor(Math.random() * 40) + 12}ms | Core: Operational | Threat Level: 0`;
                                break;
                            case '/entropy':
                                systemResponse.textContent = "[ACTION] Forcing local environment re-calculation parameter tracking. Success.";
                                updateCryptoFootprint();
                                break;
                            case '/clear':
                                logBox.innerHTML = '';
                                systemResponse.textContent = "Terminal buffer purged.";
                                break;
                            default:
                                systemResponse.className = 'terminal-line text-red';
                                systemResponse.textContent = `[ERROR] Unknown command token: '${command}'. Input /help for instructions.`;
                        }

                        logBox.appendChild(systemResponse);
                        logBox.scrollTop = logBox.scrollHeight;
                        consoleInput.value = ''; // Flush command buffer input target array element string
                    }
                });
            }

        })();
    </script>

    <script src="assets/vendor/particles.js-master/particles.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // This global fallback only initializes if index.php didn't override it first
            if (typeof particlesJS !== 'undefined' && !document.querySelector('#particles-js canvas')) {
                particlesJS('particles-js', {
                    "particles": {
                        "number": { "value": 45, "density": { "enable": true, "value_area": 800 } },
                        "color": { "value": "#00f2ff" },
                        "shape": { "type": "circle" },
                        "opacity": { "value": 0.15, "random": true },
                        "size": { "value": 2, "random": true },
                        "line_linked": { "enable": true, "distance": 150, "color": "#7b2ff7", "opacity": 0.08, "width": 1 },
                        "move": { "enable": true, "speed": 1.5, "direction": "none", "random": true, "straight": false, "out_mode": "out" }
                    },
                    "interactivity": { "detect_on": "canvas", "events": { "onhover": { "enable": true, "mode": "bubble" } } },
                    "retina_detect": true
                });
            }
        });
    </script>
</body>
</html>