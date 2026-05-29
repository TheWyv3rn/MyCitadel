<?php
/**
 * PROJECT: MY CITADEL (NEAR-ZERO-KNOWLEDGE SOCIAL ECOSYSTEM)
 * COMPONENT: SYSTEM IDENTITY MANIFEST (ABOUT)
 * VERSION: 1.2.0
 * DESCRIPTION: Fully air-gapped, highly detailed, prestigious manifest mapping system 
 * architecture and lore. Runs strictly off local static fonts and assets.
 */

// 1. Hook Page-Specific Metadata for the Global Header SEO Engine
$page_title = "System Manifest & Architecture";
$page_desc = "Explore the genesis, operational mechanics, and Near Zero-Knowledge architectural framework of the Citadel Network.";
$page_keywords = "citadel manifest, valhalla security labs, NZK architecture, privacy engineering, local fonts";

// 2. Pull in Global Infrastructure Anchors (Handles Sessions, CSP, Cookies, Language Matrices, Nav)
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/nav.php';

// 3. Server-Side Operational Telemetry (Shared with index parity calculations)
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

<style>
    @font-face {
        font-family: 'Cinzel Local';
        src: url('fonts/Cinzel-Regular.ttf') format('truetype');
        font-weight: 400;
        font-style: normal;
    }
    @font-face {
        font-family: 'Cinzel Local';
        src: url('fonts/Cinzel-SemiBold.ttf') format('truetype');
        font-weight: 600;
        font-style: normal;
    }
    @font-face {
        font-family: 'Cinzel Local';
        src: url('fonts/Cinzel-Bold.ttf') format('truetype');
        font-weight: 700;
        font-style: normal;
    }

    /* Target descriptive paragraphs with pristine local typography rules */
    .manifest-body p, .paragraph-text {
        font-family: 'Cinzel Local', serif;
        letter-spacing: 1px;
        line-height: 1.85;
        color: #cbd5e1;
        text-align: justify;
    }

    /* Synchronize local color variable rules to avoid fallback clipping */
    :root {
        --local-pulse: rgba(57, 255, 20, 0.4);
    }

    /* Core Cyber-Pulse Typography Effects */
    @keyframes core-cyber-pulse {
        0%, 100% { text-shadow: 0 0 8px var(--alien-green); }
        50% { text-shadow: 0 0 20px var(--alien-green), 0 0 30px var(--alien-green); }
    }
    .glitch-title-static {
        animation: core-cyber-pulse 5s infinite ease-in-out;
    }

    /* CRT Overlay Layer Constrained to Main Frame Workspace */
    .crt-mainframe {
        position: relative;
    }
    .crt-mainframe::before {
        content: " ";
        display: block;
        position: absolute;
        top: 0; left: 0; bottom: 0; right: 0;
        background: linear-gradient(rgba(18, 16, 16, 0) 50%, rgba(0, 0, 0, 0.3) 50%), 
                    linear-gradient(90deg, rgba(255, 0, 0, 0.05), rgba(0, 255, 0, 0.02), rgba(0, 0, 255, 0.05));
        z-index: 10;
        background-size: 100% 4px, 6px 100%;
        pointer-events: none;
        opacity: 0.5;
    }

    /* Interactive Architectural Vector Engine Style Parameters */
    .pipeline-visualization {
        width: 100%;
        background: rgba(3, 7, 10, 0.9);
        border: 1px solid var(--void-border);
        border-radius: var(--radius-sm);
        padding: 30px;
        margin-top: 2rem;
        box-shadow: inset 0 0 20px rgba(0, 0, 0, 0.8);
    }
    .flow-node {
        fill: #050d0a;
        stroke: var(--alien-green);
        stroke-width: 1.5;
        transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .flow-node:hover {
        fill: rgba(57, 255, 20, 0.12);
        stroke: #fff;
        box-shadow: 0 0 15px var(--alien-green);
        cursor: crosshair;
    }
    .flow-line {
        stroke: var(--alien-green);
        stroke-width: 2;
        stroke-dasharray: 10, 5;
        animation: matrix-pipeline-flow 25s linear infinite;
    }
    @keyframes matrix-pipeline-flow {
        to { stroke-dashoffset: -500; }
    }
    .node-text {
        fill: #ffffff;
        font-family: var(--font-mono);
        font-size: 12px;
        text-anchor: middle;
        letter-spacing: 1px;
    }
</style>

<main class="container manifest-body crt-mainframe" style="margin-top: 8rem; margin-bottom: 5rem;">
    
    <section class="hero-deployment-zone flex-center" style="flex-direction: column; text-align: center; margin-bottom: 5rem;">
        <h1 class="glowing-title stencil-text animate-float glitch-title-static" style="font-size: 4.5rem; letter-spacing: 5px; color: #fff;">
            <?php echo __t('about', 'hero_title'); ?>
        </h1>
        <p class="font-mono text-blue" style="max-width: 750px; margin: 1.5rem auto; font-size: 1.2rem;">
            >> <?php echo __t('about', 'manifest_intel'); ?> <br>
            <span id="runtime-clock" class="text-green">[<?php echo __t('about', 'clock'); ?>]</span> | 
            <span class="text-purple">[<?php echo __t('about', 'core'); ?>: <?php echo getSystemUptime(); ?>]</span>
        </p>
    </section>

    <div class="grid" style="grid-template-columns: 1fr; gap: 2.5rem; margin-bottom: 3rem;">
        
        <div class="citadel-card" style="border-left: 4px solid var(--alien-green); position: relative; z-index: 20;">
            <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid var(--void-border); padding-bottom: 1rem; margin-bottom: 1.5rem;">
                <h3 class="font-mono text-green" style="margin: 0;">
                    <i class="fas fa-history"></i> <?php echo __t('about', 'history_core_title'); ?>
                </h3>
                <span class="data-stream font-mono" style="font-size: 0.75rem; color: var(--text-muted);">
                    <?php echo __t('about', 'matrix'); ?>
                </span>
            </div>
            <p>
                <?php echo __t('about', 'history_description_p1'); ?>
            </p>
            <p style="margin-top: 1.5rem;">
                <?php echo __t('about', 'history_description_p2'); ?>
            </p>
        </div>

        <div class="grid" style="grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 2.5rem; margin-bottom: 1rem;">
            
            <div class="citadel-card" style="border-top: 1px solid var(--neon-blue); position: relative; z-index: 20;">
                <h3 class="stencil-text text-blue" style="margin-bottom: 0.25rem;">
                    <i class="fas fa-user-shield"></i> <?php echo __t('about', 'architect_title'); ?>
                </h3>
                <div style="font-size: 0.75rem; color: var(--text-muted); margin-bottom: 1.5rem;" class="font-mono">
                    <?php echo __t('about', 'brogan'); ?>
                </div>
                <p style="font-size: 1rem;">
                    <?php echo __t('about', 'architect_meta_p1'); ?>
                </p>
                <p style="margin-top: 1.2rem; font-size: 1rem;">
                    <?php echo __t('about', 'architect_meta_p2'); ?>
                </p>
                <p style="margin-top: 1.2rem; font-size: 1rem;">
                    <?php echo __t('about', 'architect_meta_p3'); ?>
                </p>
            </div>

            <div class="citadel-card" style="border-top: 1px solid var(--glitch-red); border-bottom: 1px solid var(--glitch-red); position: relative; z-index: 20; background: rgba(8, 3, 4, 0.85);">
                <h3 class="stencil-text text-red" style="color: var(--glitch-red) !important; margin-bottom: 0.25rem;">
                    <i class="fas fa-eye-slash"></i> <?php echo __t('about', 'anti_surveillance_title'); ?>
                </h3>
                <div style="font-size: 0.75rem; color: var(--glitch-red); margin-bottom: 1.5rem;" class="font-mono">
                    <?php echo __t('about', 'protect'); ?>
                </div>
                <p style="font-size: 1rem;">
                    <?php echo __t('about', 'anti_surveillance_p1'); ?>
                </p>
                <p style="margin-top: 1.2rem; font-size: 1rem;">
                    <?php echo __t('about', 'anti_surveillance_p2'); ?>
                </p>
            </div>

        </div>

        <div class="citadel-card" style="border-left: 4px solid var(--space-purple); position: relative; z-index: 20;">
            <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid var(--void-border); padding-bottom: 1rem; margin-bottom: 1.5rem;">
                <h3 class="stencil-text text-purple" style="color: var(--space-purple) !important; margin: 0;">
                    <i class="fas fa-network-wired"></i> <?php echo __t('about', 'operational_pipeline_title'); ?>
                </h3>
                <span class="data-stream font-mono" style="font-size: 0.75rem; color: var(--text-muted);">
                    <?php echo __t('about', 'nzk_title'); ?>
                </span>
            </div>
            
            <p>
                <?php echo __t('about', 'pipeline_description'); ?>
            </p>

            <div class="pipeline-visualization">
                <svg viewBox="0 0 800 180" width="100%" height="100%">
                    <line x1="100" y1="90" x2="300" y2="90" class="flow-line" />
                    <line x1="300" y1="90" x2="500" y2="90" class="flow-line" style="stroke: var(--space-purple);" />
                    <line x1="500" y1="90" x2="700" y2="90" class="flow-line" style="stroke: var(--glitch-red);" />

                    <g transform="translate(100, 90)">
                        <circle r="38" class="flow-node" style="stroke: var(--alien-green);" />
                        <text y="-5" class="node-text" style="fill: var(--alien-green);"><?php echo __t('about', 'client_sandbox'); ?></text>
                        <text y="15" class="node-text" style="font-size: 9px; color: #FFF"><?php echo __t('about', 'client_algo'); ?></text>
                    </g>

                    <g transform="translate(300, 90)">
                        <circle r="38" class="flow-node" style="stroke: var(--neon-blue);" />
                        <text y="-5" class="node-text" style="fill: var(--neon-blue);"><?php echo __t('about', 'transit'); ?></text>
                        <text y="15" class="node-text" style="font-size: 9px; color: #FFF"><?php echo __t('about', 'env'); ?></text>
                    </g>

                    <g transform="translate(500, 90)">
                        <circle r="38" class="flow-node" style="stroke: var(--space-purple);" />
                        <text y="-5" class="node-text" style="fill: var(--space-purple);"><?php echo __t('about', 'php'); ?></text>
                        <text y="15" class="node-text" style="font-size: 9px; color: #FFF"><?php echo __t('about', 'atomic'); ?></text>
                    </g>

                    <g transform="translate(700, 90)">
                        <circle r="38" class="flow-node" style="stroke: var(--glitch-red);" />
                        <text y="-5" class="node-text" style="fill: var(--glitch-red);"><?php echo __t('about', 'storage'); ?></text>
                        <text y="15" class="node-text" style="font-size: 9px; color: #FFF;"><?php echo __t('about', 'storage1'); ?></text>
                    </g>
                </svg>
            </div>

            <p style="margin-top: 2rem;">
                <?php echo __t('about', 'pipeline_deep_technical_details'); ?>
            </p>
        </div>

    </div>
</main>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        'use strict';

        // High-Precision Realtime Clock System
        const clockContainer = document.getElementById('runtime-clock');
        
        function updateSystemClock() {
            if (!clockContainer) return;
            const currentTime = new Date();
            const formattedISO = currentTime.toISOString().replace('T', ' ').substring(0, 19) + ' UTC';
            clockContainer.textContent = '[SYSTEM CLOCK: ' + formattedISO + ']';
        }

        setInterval(updateSystemClock, 1000);
        updateSystemClock();
    });
</script>

<?php
// 4. Render Layout Closure Terminal Footer Elements
require_once __DIR__ . '/includes/footer.php';
?>