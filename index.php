<?php
/**
 * PROJECT: MY CITADEL (NEAR-ZERO-KNOWLEDGE SOCIAL ECOSYSTEM)
 * COMPONENT: MAIN INDEX PORTAL
 * VERSION: 1.0.0
 * DESCRIPTION: Central operations terminal featuring multi-color prism particles,
 * an interactive client-side cryptographic decoder matrix, and dynamic server metrics.
 */

// 1. Hook Page-Specific Metadata for the Header SEO Engine
$page_title = "Mainframe Core";
$page_desc = "Welcome to the Citadel. Secure your digital sovereignty via client-side multi-layer XChaCha20 encryption matrices.";
$page_keywords = "citadel core, quantum safe social, private network, zero telemetry";

// 2. Pull in Infrastructure Anchors
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/nav.php';

// 3. Server-Side Operational Functions (PHP Intel Compilation)
function getSystemUptime() {
    if (is_readable('/proc/uptime')) {
        $uptimeData = explode(' ', file_get_contents('/proc/uptime'));
        $days = floor($uptimeData[0] / 86400);
        $hours = floor(($uptimeData[0] % 86400) / 3600);
        return "{$days}D : {$hours}H Operational";
    }
    return "Continuous Mainnet Runtime";
}
?>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        if (typeof particlesJS !== 'undefined') {
            particlesJS('particles-js', {
                "particles": {
                    "number": { 
                        "value": 90, /* Slightly higher count for dense matrix clusters */
                        "density": { "enable": true, "value_area": 900 } 
                    },
                    // Prism Palette: Red, Green, Blue, Purple, Pink, Orange, Yellow
                    "color": { 
                        "value": ["#ff003c", "#39ff14", "#00f2ff", "#7b2ff7", "#ff00ea", "#ff9f00", "#ffff00"] 
                    },
                    // Structural Shift: Transforming particles into Hexagons
                    "shape": { 
                        "type": "polygon",
                        "stroke": { "width": 1, "color": "rgba(0, 242, 255, 0.2)" },
                        "polygon": { "nb_sides": 6 } 
                    },
                    "opacity": { 
                        "value": 0.4, 
                        "random": true,
                        "anim": { "enable": true, "speed": 1, "opacity_min": 0.1, "sync": false }
                    },
                    "size": { 
                        "value": 5, /* Slightly larger to appreciate the hexagon structure */
                        "random": true,
                        "anim": { "enable": false }
                    },
                    // The Matrix Interconnection Grid
                    "line_linked": { 
                        "enable": true, 
                        "distance": 140, 
                        "color": "#00f2ff", /* Electric Cyan mesh grid lines */
                        "opacity": 0.22,    /* More pronounced line visibility */
                        "width": 1.5 
                    },
                    "move": { 
                        "enable": true, 
                        "speed": 2.5,        /* Steady, algorithmic flow speed */
                        "direction": "none", 
                        "random": false, 
                        "straight": false, 
                        "out_mode": "out",
                        "attract": { "enable": true, "rotateX": 600, "rotateY": 1200 }
                    }
                },
                "interactivity": { 
                    "detect_on": "canvas", 
                    "events": { 
                        "onhover": { "enable": true, "mode": "grab" }, /* Mouse draws grid lines closer */
                        "onclick": { "enable": true, "mode": "push" }
                    },
                    "modes": {
                        "grab": { "distance": 180, "line_linked": { "opacity": 0.6 } },
                        "push": { "particles_nb": 3 }
                    }
                },
                "retina_detect": true
            });
        }
    });
</script>

<main class="container" style="margin-top: 8rem; margin-bottom: 5rem;">
    
    <section class="hero-deployment-zone flex-center" style="flex-direction: column; text-align: center; margin-bottom: 5rem;">
        <h1 class="glowing-title stencil-text animate-float" style="font-size: 4.5rem; letter-spacing: 5px;">
            <?php echo __t('index', 'hero_banner_title'); ?>
        </h1>
        <p class="font-mono text-blue" style="max-width: 700px; margin: 1.5rem auto; font-size: 1.2rem;">
            >> <?php echo __t('index', 'load_network'); ?> <br>
            <span class="text-green"><?php echo __t('index', 'sys_load'); ?></span> | <span class="text-purple">[<?php echo __t('index', 'node'); ?>: <?php echo getSystemUptime(); ?>]</span>
        </p>
        <div style="margin-top: 1.5rem;">
            <a href="auth/register.php" class="btn-cyber" style="margin-right: 1.5rem;">
                <i class="fas fa-key"></i> <?php echo __t('index', 'register_button'); ?>
            </a>
            <a href="about.php" class="glitch-link font-mono" style="font-size: 0.9rem;">
                <?php echo __t('index', 'manifest_button'); ?>
            </a>
        </div>
    </section>

    <section class="grid" style="grid-template-columns: 1fr; margin-bottom: 5rem;">
        <div class="citadel-card" style="border-left: 4px solid var(--alien-green);">
            <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid var(--void-border); padding-bottom: 1rem; margin-bottom: 1.5rem;">
                <h3 class="font-mono text-green" style="margin: 0;"><i class="fas fa-compress-arrows-alt"></i> <?php echo __t('index', 'cipher_sandbox'); ?></h3>
                <span class="data-stream font-mono" style="font-size: 0.75rem;"><?php echo __t('index', 'cipher_version'); ?></span>
            </div>
            <p style="font-size: 1rem; margin-bottom: 1.5rem;">
                <?php echo __t('index', 'cipher_description'); ?>
            </p>
            
            <div class="sandbox-io-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                <div>
                    <label class="font-mono text-blue" style="font-size: 0.8rem; display: block; margin-bottom: 0.5rem;"><?php echo __t('index', 'cipher_input'); ?></label>
                    <textarea id="cryptoSandboxInput" rows="4" style="width: 100%; background: rgba(0,0,0,0.5); border: 1px solid var(--void-border); border-radius: var(--radius-sm); color: #fff; padding: 1rem; font-family: var(--font-mono); resize: none; outline: none;" placeholder="<?php echo __t('index', 'input_placeholder'); ?>"></textarea>
                </div>
                <div>
                    <label class="font-mono text-purple" style="font-size: 0.8rem; display: block; margin-bottom: 0.5rem;"><?php echo __t('index', 'cipher_output'); ?></label>
                    <div id="cryptoSandboxOutput" class="font-mono" style="width: 100%; height: 115px; background: rgba(5,5,10,0.8); border: 1px dashed var(--glitch-red); border-radius: var(--radius-sm); color: var(--glitch-red); padding: 1rem; overflow-y: auto; font-size: 0.85rem; word-break: break-all;">
                        <?php echo __t('index', 'awaiting_input'); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="grid" style="grid-template-columns: repeat(3, 1fr);">
        
        <div class="citadel-card" style="border-top: 1px solid var(--neon-blue);">
            <h3 class="stencil-text text-blue"><i class="fas fa-user-ninja"></i> <?php echo __t('index', 'anonymit_title'); ?></h3>
            <p style="font-size: 0.95rem; margin-top: 1rem;">
                <?php echo __t('index', 'anonymity_description'); ?>
            </p>
        </div>

        <div class="citadel-card" style="border-top: 1px solid var(--space-purple);">
            <h3 class="stencil-text text-purple"><i class="fas fa-brain"></i> <?php echo __t('index', 'nzk_title'); ?></h3>
            <p style="font-size: 0.95rem; margin-top: 1rem;">
                <?php echo __t('index', 'nzk_description'); ?>
            </p>
        </div>

        <div class="citadel-card" style="border-top: 1px solid var(--alien-green);">
            <h3 class="stencil-text text-green"><i class="fas fa-cookie-bite"></i> <?php echo __t('index', 'mesh_title'); ?></h3>
            <p style="font-size: 0.95rem; margin-top: 1rem;">
                <?php echo __t('index', 'mesh_description'); ?>
            </p>
        </div>

        <div class="citadel-card" style="border-top: 1px solid var(--neon-blue);">
            <h3 class="stencil-text text-blue"><i class="fas fa-language"></i> <?php echo __t('index', 'multi_title'); ?></h3>
            <p style="font-size: 0.95rem; margin-top: 1rem;">
                <?php echo __t('index', 'multi_description'); ?>
            </p>
        </div>

        <div class="citadel-card" style="border-top: 1px solid var(--space-purple);">
            <h3 class="stencil-text text-purple"><i class="fas fa-users"></i> <?php echo __t('index', 'usr_title'); ?></h3>
            <p style="font-size: 0.95rem; margin-top: 1rem;">
                <?php echo __t('index', 'usr_description'); ?>
            </p>
        </div>     

        <div class="citadel-card" style="border-top: 1px solid var(--alien-green);">
            <h3 class="stencil-text text-green"><i class="fas fa-dragon"></i> <?php echo __t('index', 'data_title'); ?></h3>
            <p style="font-size: 0.95rem; margin-top: 1rem;">
                <?php echo __t('index', 'data_description'); ?>
            </p>
        </div>        

    </section>
</main>

<script>
    const CitadelSandboxEngine = (function() {
        'use strict';

        const inputArea = document.getElementById('cryptoSandboxInput');
        const outputBox = document.getElementById('cryptoSandboxOutput');

        if (!inputArea || !outputBox) return;

        // Realistic stream obfuscator to mimic real-time high-speed block ciphers
        function structuralScramble(text) {
            if (!text) return "Awaiting input sequence authorization...";
            
            // Base64 manipulation mixed with specialized character byte transformations
            let baseArray = btoa(unescape(encodeURIComponent(text)));
            let outputStream = "";
            
            for (let i = 0; i < baseArray.length; i++) {
                // Instantly inject variable hex entropy blocks based on index location values
                if (i % 3 === 0) {
                    outputStream += `[0x${baseArray.charCodeAt(i).toString(16).toUpperCase()}]`;
                } else {
                    outputStream += baseArray.charAt(i);
                }
            }
            return outputStream;
        }

        inputArea.addEventListener('input', function() {
            outputBox.textContent = structuralScramble(inputArea.value);
            
            // Swap visual borders to show active cryptographic mutation matches
            if (inputArea.value.length > 0) {
                outputBox.style.borderColor = "var(--alien-green)";
                outputBox.style.color = "var(--alien-green)";
            } else {
                outputBox.style.borderColor = "var(--glitch-red)";
                outputBox.style.color = "var(--glitch-red)";
            }
        });

    })();
</script>

<?php
// 4. Render Layout Closure Terminal Footer Elements
require_once __DIR__ . '/includes/footer.php';
?>