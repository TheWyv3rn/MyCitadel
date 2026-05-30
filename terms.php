<?php
/**
 * PROJECT:    MY CITADEL (NEAR-ZERO-KNOWLEDGE SOCIAL ECOSYSTEM)
 * COMPONENT:  PROTOCOL TERMS, CITIZEN RIGHTS & SECURITY RESEARCH MANDATE
 * VERSION:    2.1.0
 * ARCHITECT:  THE WYVERN
 * DESCRIPTION: Full operational compliance matrix. Citizen rights, conduct code,
 *              anonymity hardening guide, VDP rules, and breach countermeasures.
 */

$page_title       = "Citadel Protocol // Citizen Rights & Compliance Matrix";
$page_desc        = "The full operational charter of MyCitadel. Understand your rights as a Citizen, how to protect your sovereignty, and our commitment to near-zero-knowledge privacy.";
$page_keywords    = "mycitadel terms of service, privacy policy, bug bounty, VDP, citizen rights, anonymous social network";
$page_last_updated = "2025-01-01"; // Update on each revision

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/nav.php';

// Generate a document integrity hash for display (educational — shows our audit model)
$doc_hash = strtoupper(hash('sha256', file_get_contents(__FILE__)));
$doc_version = "PROTO-TOS-2.1.0";
?>

<style>
    /* ── Page-Specific Styles ─────────────────────────────── */
    .tos-hero {
        text-align: center;
        padding: 6rem 0 4rem;
        position: relative;
    }
    .tos-hero::after {
        content: '';
        position: absolute;
        bottom: 0; left: 50%; transform: translateX(-50%);
        width: 60%; height: 1px;
        background: linear-gradient(90deg, transparent, var(--neon-blue), var(--space-purple), transparent);
    }

    /* Document integrity strip */
    .doc-integrity-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1rem;
        background: rgba(0,0,0,0.5);
        border: 1px solid var(--void-border);
        border-radius: var(--radius-md);
        padding: 0.75rem 1.5rem;
        margin-bottom: 3rem;
        font-family: var(--font-mono);
        font-size: 0.72rem;
        color: var(--text-secondary);
        letter-spacing: 0.06em;
    }
    .doc-integrity-bar .hash-val {
        color: var(--alien-green);
        word-break: break-all;
        font-size: 0.65rem;
    }

    /* Table of contents */
    .tos-toc {
        background: rgba(0, 242, 255, 0.03);
        border: 1px solid var(--void-border);
        border-radius: var(--radius-md);
        padding: 2rem;
        margin-bottom: 3rem;
    }
    .tos-toc h3 {
        font-family: var(--font-mono);
        font-size: 0.75rem;
        letter-spacing: 0.15em;
        color: var(--neon-blue);
        margin-bottom: 1.25rem;
        text-transform: uppercase;
    }
    .tos-toc ol {
        list-style: none;
        counter-reset: toc-counter;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 0.5rem 2rem;
    }
    .tos-toc ol li {
        counter-increment: toc-counter;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    .tos-toc ol li::before {
        content: counter(toc-counter, upper-roman);
        font-family: var(--font-mono);
        font-size: 0.65rem;
        color: var(--space-purple);
        min-width: 1.5rem;
    }
    .tos-toc ol li a {
        font-family: var(--font-mono);
        font-size: 0.8rem;
        color: var(--text-secondary);
        text-decoration: none;
        letter-spacing: 0.05em;
        transition: var(--transition-fast);
    }
    .tos-toc ol li a:hover { color: var(--neon-blue); }

    /* Section anchors */
    .tos-section {
        margin-bottom: 2.5rem;
        scroll-margin-top: 6rem;
    }
    .section-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid var(--void-border);
    }
    .section-number {
        font-family: var(--font-mono);
        font-size: 0.65rem;
        color: var(--text-secondary);
        letter-spacing: 0.12em;
        background: rgba(255,255,255,0.04);
        border: 1px solid var(--void-border);
        border-radius: var(--radius-sm);
        padding: 0.2rem 0.5rem;
        white-space: nowrap;
    }

    /* Rule lists */
    .rule-list {
        list-style: none;
        display: flex;
        flex-direction: column;
        gap: 0.85rem;
        margin: 1.25rem 0;
    }
    .rule-list li {
        display: flex;
        align-items: flex-start;
        gap: 0.85rem;
        font-size: 0.95rem;
        line-height: 1.65;
        color: var(--text-primary);
    }
    .rule-list li .rule-icon {
        flex-shrink: 0;
        width: 1.4rem;
        text-align: center;
        margin-top: 0.1rem;
    }
    .rule-list li .rule-body strong {
        display: block;
        font-family: var(--font-mono);
        font-size: 0.8rem;
        letter-spacing: 0.06em;
        margin-bottom: 0.2rem;
    }
    .rule-list.allowed li .rule-body strong { color: var(--alien-green); }
    .rule-list.forbidden li .rule-body strong { color: var(--glitch-red); }
    .rule-list.advisory li .rule-body strong { color: var(--neon-blue); }
    .rule-list.neutral li .rule-body strong  { color: #ff9f00; }

    /* Info callout boxes */
    .callout {
        display: flex;
        gap: 1rem;
        padding: 1.25rem 1.5rem;
        border-radius: var(--radius-md);
        margin: 1.5rem 0;
        font-size: 0.9rem;
        line-height: 1.7;
    }
    .callout-icon { font-size: 1.2rem; flex-shrink: 0; margin-top: 0.1rem; }
    .callout-blue   { background: rgba(0,242,255,0.05);  border-left: 3px solid var(--neon-blue); }
    .callout-green  { background: rgba(57,255,20,0.05);  border-left: 3px solid var(--alien-green); }
    .callout-red    { background: rgba(255,0,60,0.05);   border-left: 3px solid var(--glitch-red); }
    .callout-purple { background: rgba(123,47,247,0.05); border-left: 3px solid var(--space-purple); }
    .callout-orange { background: rgba(255,159,0,0.05);  border-left: 3px solid #ff9f00; }

    /* Severity badges */
    .severity-badge {
        display: inline-block;
        font-family: var(--font-mono);
        font-size: 0.6rem;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        padding: 0.15rem 0.5rem;
        border-radius: 2px;
        font-weight: 700;
        vertical-align: middle;
        margin-left: 0.5rem;
    }
    .sev-critical { background: rgba(255,0,60,0.2);   color: var(--glitch-red);   border: 1px solid rgba(255,0,60,0.4); }
    .sev-high     { background: rgba(255,159,0,0.2);  color: #ff9f00;             border: 1px solid rgba(255,159,0,0.4); }
    .sev-medium   { background: rgba(255,215,0,0.15); color: #ffd700;             border: 1px solid rgba(255,215,0,0.3); }
    .sev-low      { background: rgba(57,255,20,0.1);  color: var(--alien-green);  border: 1px solid rgba(57,255,20,0.3); }
    .sev-info     { background: rgba(0,242,255,0.1);  color: var(--neon-blue);    border: 1px solid rgba(0,242,255,0.25); }

    /* Report submission grid */
    .report-channels {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin: 1.5rem 0;
    }
    .report-channel-card {
        background: rgba(0,0,0,0.4);
        border: 1px solid var(--void-border);
        border-radius: var(--radius-md);
        padding: 1.25rem;
        text-align: center;
        transition: var(--transition-smooth);
        text-decoration: none;
    }
    .report-channel-card:hover {
        border-color: var(--alien-green);
        box-shadow: 0 0 20px rgba(57,255,20,0.1);
        transform: translateY(-3px);
    }
    .report-channel-card .channel-name {
        font-family: var(--font-mono);
        font-size: 0.8rem;
        letter-spacing: 0.1em;
        color: var(--alien-green);
        display: block;
        margin-top: 0.5rem;
    }
    .report-channel-card .channel-type {
        font-size: 0.7rem;
        color: var(--text-secondary);
        margin-top: 0.25rem;
        display: block;
    }

    /* Severity reward table */
    .reward-table {
        width: 100%;
        border-collapse: collapse;
        font-family: var(--font-mono);
        font-size: 0.82rem;
        margin: 1.5rem 0;
    }
    .reward-table thead th {
        text-align: left;
        color: var(--neon-blue);
        font-size: 0.7rem;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        padding: 0.75rem 1rem;
        border-bottom: 1px solid var(--void-border);
        background: rgba(0,242,255,0.04);
    }
    .reward-table tbody td {
        padding: 0.85rem 1rem;
        color: var(--text-primary);
        border-bottom: 1px solid rgba(255,255,255,0.04);
        vertical-align: top;
    }
    .reward-table tbody tr:hover td { background: rgba(0,242,255,0.03); }

    /* Acceptance footer */
    .acceptance-block {
        text-align: center;
        padding: 3rem 2rem;
        background: rgba(0,242,255,0.03);
        border: 1px solid var(--void-border);
        border-radius: var(--radius-md);
        margin-top: 3rem;
    }
    .last-updated {
        font-family: var(--font-mono);
        font-size: 0.72rem;
        color: var(--text-secondary);
        letter-spacing: 0.08em;
        margin-top: 1rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .tos-hero h1 { font-size: 2.2rem !important; }
        .doc-integrity-bar { flex-direction: column; align-items: flex-start; }
        .sandbox-io-grid { grid-template-columns: 1fr !important; }
        .report-channels { grid-template-columns: 1fr 1fr; }
    }
    @media (max-width: 480px) {
        .report-channels { grid-template-columns: 1fr; }
    }
</style>

<main class="container" style="margin-top: 8rem; margin-bottom: 6rem;">

    <!-- ═══════════════════════════════════════════════════════
         HERO
    ═══════════════════════════════════════════════════════ -->
    <header class="tos-hero">
        <p class="font-mono" style="font-size:0.72rem; letter-spacing:0.18em; color:var(--text-secondary); margin-bottom:1rem;">
            <?php echo __t('terms', 'pre_header'); ?> // <?php echo htmlspecialchars($doc_version); ?>
        </p>
        <h1 class="glowing-title stencil-text" style="font-size:3.2rem; letter-spacing:4px; margin-bottom:1.25rem;">
            <?php echo __t('terms', 'header'); ?>
        </h1>
        <p class="font-mono" style="max-width:680px; margin:0 auto; font-size:1rem; color:var(--text-secondary); line-height:1.8;">
            <?php echo __t('terms', 'header_desc'); ?>
            <strong style="color:var(--neon-blue);"><?php echo __t('terms', 'header_strong'); ?></strong>
        </p>
    </header>

    <!-- Document integrity strip -->
    <div class="doc-integrity-bar">
        <span><i class="fas fa-fingerprint" style="color:var(--neon-blue);margin-right:0.5rem;"></i> <?php echo __t('terms', 'doc_int'); ?></span>
        <span><?php echo __t('terms', 'version'); ?>: <span style="color:var(--neon-blue);"><?php echo htmlspecialchars($doc_version); ?></span></span>
        <span><?php echo __t('terms', 'revised'); ?>: <span style="color:var(--neon-blue);"><?php echo htmlspecialchars($page_last_updated); ?></span></span>
        <span>SHA-256: <span class="hash-val"><?php echo substr($doc_hash, 0, 48); ?></span></span>
        <span><i class="fas fa-check-circle" style="color:var(--alien-green);margin-right:0.4rem;"></i><?php echo __t('terms', 'signature'); ?></span>
    </div>

    <!-- ═══════════════════════════════════════════════════════
         TABLE OF CONTENTS
    ═══════════════════════════════════════════════════════ -->
    <div class="tos-toc">
        <h3><i class="fas fa-sitemap" style="margin-right:0.5rem;"></i> <?php echo __t('terms', 'doc_index'); ?></h3>
        <ol>
            <li><a href="#philosophy"><?php echo __t('terms', 'philosophy'); ?></a></li>
            <li><a href="#citizen-rights"><?php echo __t('terms', 'rights'); ?></a></li>
            <li><a href="#citizen-conduct"><?php echo __t('terms', 'code'); ?></a></li>
            <li><a href="#anonymity-guide"><?php echo __t('terms', 'anon'); ?></a></li>
            <li><a href="#data-architecture"><?php echo __t('terms', 'data'); ?></a></li>
            <li><a href="#content-policy"><?php echo __t('terms', 'policy'); ?></a></li>
            <li><a href="#ai-moderation"><?php echo __t('terms', 'ai'); ?></a></li>
            <li><a href="#premium"><?php echo __t('terms', 'premium'); ?></a></li>
            <li><a href="#vdp"><?php echo __t('terms', 'vdp'); ?></a></li>
            <li><a href="#breach"><?php echo __t('terms', 'breach'); ?></a></li>
            <li><a href="#legal"><?php echo __t('terms', 'legal'); ?></a></li>
            <li><a href="#updates"><?php echo __t('terms', 'updates'); ?></a></li>
        </ol>
    </div>


    <!-- ═══════════════════════════════════════════════════════
         I. PHILOSOPHY
    ═══════════════════════════════════════════════════════ -->
    <div id="philosophy" class="tos-section citadel-card" style="border-left:4px solid var(--space-purple);">
        <div class="section-header">
            <span class="section-number"><?php echo __t('terms', 'art1'); ?></span>
            <h2 style="margin:0; font-size:1.4rem;"><i class="fas fa-fist-raised" style="color:var(--space-purple);margin-right:0.75rem;"></i><?php echo __t('terms', 'art1_title'); ?></h2>
        </div>

        <p style="font-size:1.1rem; line-height:1.85; margin-bottom:1.5rem;">
            <?php echo __t('terms', 'art1_short_desc'); ?>
        </p>

        <blockquote style="border-left:4px solid var(--glitch-red); padding:1.5rem 2rem; background:rgba(255,0,60,0.05); border-radius:0 var(--radius-md) var(--radius-md) 0; margin:1.5rem 0;">
            <p style="font-family:var(--font-title); font-size:1.5rem; color:var(--glitch-red); letter-spacing:2px; text-transform:uppercase; margin:0;">
                "<?php echo __t('terms', 'slogan1'); ?><br>
                <strong><?php echo __t('terms', 'slogan2'); ?></strong>"
            </p>
        </blockquote>

        <p style="line-height:1.85; margin-bottom:1rem;">
            <?php echo __t('terms', 'art1_desc1'); ?>
        </p>
        <p style="line-height:1.85; margin-bottom:1rem;">
            <?php echo __t('terms', 'art1_desc2'); ?>
        </p>

        <div class="callout callout-blue">
            <span class="callout-icon"><i class="fas fa-info-circle" style="color:var(--neon-blue);"></i></span>
            <div>
                <strong style="font-family:var(--font-mono); font-size:0.8rem; color:var(--neon-blue); display:block; margin-bottom:0.4rem;"><?php echo __t('terms', 'guarantee'); ?></strong>
                <?php echo __t('terms', 'guarantee_desc'); ?>
            </div>
        </div>
    </div>


    <!-- ═══════════════════════════════════════════════════════
         II. CITIZEN RIGHTS
    ═══════════════════════════════════════════════════════ -->
    <div id="citizen-rights" class="tos-section citadel-card" style="border-left:4px solid var(--neon-blue);">
        <div class="section-header">
            <span class="section-number"><?php echo __t('terms', 'art2'); ?></span>
            <h2 style="margin:0; font-size:1.4rem;"><i class="fas fa-id-card-alt" style="color:var(--neon-blue);margin-right:0.75rem;"></i><?php echo __t('terms', 'art2_title'); ?></h2>
        </div>
        <p style="margin-bottom:1.25rem;">
            <?php echo __t('terms', 'art2_desc'); ?>
        </p>
        <ul class="rule-list allowed">
            <li>
                <span class="rule-icon"><i class="fas fa-check-circle" style="color:var(--alien-green);"></i></span>
                <div class="rule-body">
                    <strong><?php echo __t('terms', 'anon_right'); ?></strong>
                    <?php echo __t('terms', 'anon_desc'); ?>
                </div>
            </li>
            <li>
                <span class="rule-icon"><i class="fas fa-check-circle" style="color:var(--alien-green);"></i></span>
                <div class="rule-body">
                    <strong><?php echo __t('terms', 'sovereign'); ?></strong>
                    <?php echo __t('terms', 'sovereign_desc'); ?>
                </div>
            </li>
            <li>
                <span class="rule-icon"><i class="fas fa-check-circle" style="color:var(--alien-green);"></i></span>
                <div class="rule-body">
                    <strong><?php echo __t('terms', 'portability'); ?></strong>
                    <?php echo __t('terms', 'portability_desc'); ?>
                </div>
            </li>
            <li>
                <span class="rule-icon"><i class="fas fa-check-circle" style="color:var(--alien-green);"></i></span>
                <div class="rule-body">
                    <strong><?php echo __t('terms', 'delete'); ?></strong>
                    <?php echo __t('terms', 'delete_desc'); ?>
                </div>
            </li>
            <li>
                <span class="rule-icon"><i class="fas fa-check-circle" style="color:var(--alien-green);"></i></span>
                <div class="rule-body">
                    <strong><?php echo __t('terms', 'rtk'); ?></strong>
                    <?php echo __t('terms', 'rtk_desc'); ?>
                </div>
            </li>
            <li>
                <span class="rule-icon"><i class="fas fa-check-circle" style="color:var(--alien-green);"></i></span>
                <div class="rule-body">
                    <strong><?php echo __t('terms', 'appeal'); ?></strong>
                    <?php echo __t('terms', 'appeal_desc'); ?>
                </div>
            </li>
        </ul>
    </div>


    <!-- ═══════════════════════════════════════════════════════
         III. CITIZEN CONDUCT CODE
    ═══════════════════════════════════════════════════════ -->
    <div id="citizen-conduct" class="tos-section citadel-card" style="border-left:4px solid var(--alien-green);">
        <div class="section-header">
            <span class="section-number"><?php echo __t('terms', 'art3'); ?></span>
            <h2 style="margin:0; font-size:1.4rem;"><i class="fas fa-scroll" style="color:var(--alien-green);margin-right:0.75rem;"></i><?php echo __t('terms', 'art3_title'); ?></h2>
        </div>
        <p style="margin-bottom:1.25rem;">
            <?php echo __t('terms', 'art3_desc'); ?>
        </p>

        <h4 class="font-mono" style="color:var(--alien-green); font-size:0.85rem; letter-spacing:0.1em; margin-bottom:0.75rem;">
            <i class="fas fa-check-double"></i> <?php echo __t('terms', 'art3_sub_title'); ?>
        </h4>
        <ul class="rule-list allowed">
            <li>
                <span class="rule-icon"><i class="fas fa-check" style="color:var(--alien-green);"></i></span>
                <div class="rule-body">
                    <strong><?php echo __t('terms', 'express'); ?></strong>
                    <?php echo __t('terms', 'express_desc'); ?>
                </div>
            </li>
            <li>
                <span class="rule-icon"><i class="fas fa-check" style="color:var(--alien-green);"></i></span>
                <div class="rule-body">
                    <strong><?php echo __t('terms', 'connections'); ?></strong>
                    <?php echo __t('terms', 'connections_desc'); ?>
                </div>
            </li>
            <li>
                <span class="rule-icon"><i class="fas fa-check" style="color:var(--alien-green);"></i></span>
                <div class="rule-body">
                    <strong><?php echo __t('terms', 'comms'); ?></strong>
                    <?php echo __t('terms', 'comms_desc'); ?>
                </div>
            </li>
            <li>
                <span class="rule-icon"><i class="fas fa-check" style="color:var(--alien-green);"></i></span>
                <div class="rule-body">
                    <strong><?php echo __t('terms', 'reporting'); ?></strong>
                    <?php echo __t('terms', 'reporting_desc'); ?>
                </div>
            </li>
            <li>
                <span class="rule-icon"><i class="fas fa-check" style="color:var(--alien-green);"></i></span>
                <div class="rule-body">
                    <strong><?php echo __t('terms', 'multiaccount'); ?></strong>
                    <?php echo __t('terms', 'multiaccount_desc'); ?>
                </div>
            </li>
        </ul>

        <hr style="border:none; border-top:1px solid var(--void-border); margin:2rem 0;">

        <h4 class="font-mono" style="color:var(--glitch-red); font-size:0.85rem; letter-spacing:0.1em; margin-bottom:0.75rem;">
            <i class="fas fa-ban"></i> <?php echo __t('terms', 'no_title'); ?>
        </h4>
        <ul class="rule-list forbidden">
            <li>
                <span class="rule-icon"><i class="fas fa-times-circle" style="color:var(--glitch-red);"></i></span>
                <div class="rule-body">
                    <strong><?php echo __t('terms', 'speech'); ?></strong>
                    <?php echo __t('terms', 'speech_desc'); ?>
                </div>
            </li>
            <li>
                <span class="rule-icon"><i class="fas fa-times-circle" style="color:var(--glitch-red);"></i></span>
                <div class="rule-body">
                    <strong><?php echo __t('terms', 'child'); ?></strong>
                    <?php echo __t('terms', 'child_desc'); ?>
                </div>
            </li>
            <li>
                <span class="rule-icon"><i class="fas fa-times-circle" style="color:var(--glitch-red);"></i></span>
                <div class="rule-body">
                    <strong><?php echo __t('terms', 'terror'); ?></strong>
                    <?php echo __t('terms', 'terror_desc'); ?>
                </div>
            </li>
            <li>
                <span class="rule-icon"><i class="fas fa-times-circle" style="color:var(--glitch-red);"></i></span>
                <div class="rule-body">
                    <strong><?php echo __t('terms', 'fraud'); ?></strong>
                    <?php echo __t('terms', 'fraud_desc'); ?>
                </div>
            </li>
            <li>
                <span class="rule-icon"><i class="fas fa-times-circle" style="color:var(--glitch-red);"></i></span>
                <div class="rule-body">
                    <strong><?php echo __t('terms', 'spam'); ?></strong>
                    <?php echo __t('terms', 'spam_desc'); ?>
                </div>
            </li>
            <li>
                <span class="rule-icon"><i class="fas fa-times-circle" style="color:var(--glitch-red);"></i></span>
                <div class="rule-body">
                    <strong><?php echo __t('terms', 'attacks'); ?></strong>
                    <?php echo __t('terms', 'attacks_desc'); ?>
                </div>
            </li>
            <li>
                <span class="rule-icon"><i class="fas fa-times-circle" style="color:var(--glitch-red);"></i></span>
                <div class="rule-body">
                    <strong><?php echo __t('terms', 'sharing'); ?></strong>
                    <?php echo __t('terms', 'sharing_desc'); ?>
                </div>
            </li>
        </ul>
    </div>


    <!-- ═══════════════════════════════════════════════════════
         IV. ANONYMITY & SAFETY GUIDE
    ═══════════════════════════════════════════════════════ -->
    <div id="anonymity-guide" class="tos-section citadel-card" style="border-left:4px solid var(--space-purple);">
        <div class="section-header">
            <span class="section-number"><?php echo __t('terms', 'art4'); ?></span>
            <h2 style="margin:0; font-size:1.4rem;"><i class="fas fa-user-secret" style="color:var(--space-purple);margin-right:0.75rem;"></i><?php echo __t('terms', 'art4_title'); ?></h2>
        </div>
        <p style="margin-bottom:1.25rem;">
            <?php echo __t('terms', 'art4_desc'); ?>
        </p>

        <div class="callout callout-purple">
            <span class="callout-icon"><i class="fas fa-exclamation-circle" style="color:var(--space-purple);"></i></span>
            <div>
                <strong style="font-family:var(--font-mono); font-size:0.8rem; color:var(--space-purple); display:block; margin-bottom:0.4rem;"><?php echo __t('terms', 'art4_imp'); ?></strong>
                <?php echo __t('terms', 'art4_imp_desc'); ?>
            </div>
        </div>

        <h4 class="font-mono" style="color:var(--neon-blue); font-size:0.85rem; letter-spacing:0.1em; margin:1.5rem 0 0.75rem;">
            <i class="fas fa-shield-alt"></i> <?php echo __t('terms', 'security_title'); ?>
        </h4>
        <ul class="rule-list advisory">
            <li>
                <span class="rule-icon"><i class="fas fa-lock" style="color:var(--neon-blue);"></i></span>
                <div class="rule-body">
                    <strong><?php echo __t('terms', 'pwd'); ?></strong>
                    <?php echo __t('terms', 'pwd_desc'); ?>
                </div>
            </li>
            <li>
                <span class="rule-icon"><i class="fas fa-key" style="color:var(--neon-blue);"></i></span>
                <div class="rule-body">
                    <strong><?php echo __t('terms', 'tfa'); ?></strong>
                    <?php echo __t('terms', 'tfa_desc'); ?>
                </div>
            </li>
            <li>
                <span class="rule-icon"><i class="fas fa-at" style="color:var(--neon-blue);"></i></span>
                <div class="rule-body">
                    <strong><?php echo __t('terms', 'email'); ?></strong>
                    <?php echo __t('terms', 'email_desc'); ?>
                </div>
            </li>
            <li>
                <span class="rule-icon"><i class="fas fa-network-wired" style="color:var(--neon-blue);"></i></span>
                <div class="rule-body">
                    <strong><?php echo __t('terms', 'anonymity'); ?></strong>
                    <?php echo __t('terms', 'anonymity_desc'); ?>
                </div>
            </li>
            <li>
                <span class="rule-icon"><i class="fas fa-camera" style="color:var(--neon-blue);"></i></span>
                <div class="rule-body">
                    <strong><?php echo __t('terms', 'uploading'); ?></strong>
                    <?php echo __t('terms', 'uploading_desc'); ?>
                </div>
            </li>
            <li>
                <span class="rule-icon"><i class="fas fa-fingerprint" style="color:var(--neon-blue);"></i></span>
                <div class="rule-body">
                    <strong><?php echo __t('terms', 'fingerprinting'); ?></strong>
                    <?php echo __t('terms', 'fingerprinting_desc'); ?>
                </div>
            </li>
            <li>
                <span class="rule-icon"><i class="fas fa-sign-out-alt" style="color:var(--neon-blue);"></i></span>
                <div class="rule-body">
                    <strong><?php echo __t('terms', 'devices'); ?></strong>
                    <?php echo __t('terms', 'devices_desc'); ?>
                </div>
            </li>
        </ul>
    </div>


    <!-- ═══════════════════════════════════════════════════════
         V. DATA ARCHITECTURE
    ═══════════════════════════════════════════════════════ -->
    <div id="data-architecture" class="tos-section citadel-card" style="border-left:4px solid var(--neon-blue);">
        <div class="section-header">
            <span class="section-number"><?php echo __t('terms', 'art5'); ?></span>
            <h2 style="margin:0; font-size:1.4rem;"><i class="fas fa-database" style="color:var(--neon-blue);margin-right:0.75rem;"></i><?php echo __t('terms', 'art5_title'); ?></h2>
        </div>
        <p style="margin-bottom:1.25rem;">
            <?php echo __t('terms', 'art5_desc'); ?>
        </p>

        <h4 class="font-mono" style="color:var(--alien-green); font-size:0.82rem; letter-spacing:0.1em; margin-bottom:0.75rem;"><?php echo __t('terms', 'we_can_see'); ?></h4>
        <ul class="rule-list neutral">
            <li>
                <span class="rule-icon"><i class="fas fa-eye" style="color:#ff9f00;"></i></span>
                <div class="rule-body">
                    <strong><?php echo __t('terms', 'alias'); ?></strong>
                    <?php echo __t('terms', 'alias_desc'); ?>
                </div>
            </li>
            <li>
                <span class="rule-icon"><i class="fas fa-eye" style="color:#ff9f00;"></i></span>
                <div class="rule-body">
                    <strong><?php echo __t('terms', 'profile'); ?></strong>
                    <?php echo __t('terms', 'profile_desc'); ?>
                </div>
            </li>
            <li>
                <span class="rule-icon"><i class="fas fa-eye" style="color:#ff9f00;"></i></span>
                <div class="rule-body">
                    <strong><?php echo __t('terms', 'date'); ?></strong>
                    <?php echo __t('terms', 'date_desc'); ?>
                </div>
            </li>
            <li>
                <span class="rule-icon"><i class="fas fa-eye" style="color:#ff9f00;"></i></span>
                <div class="rule-body">
                    <strong><?php echo __t('terms', 'email_adr'); ?></strong>
                    <?php echo __t('terms', 'email_adr_desc'); ?>
                </div>
            </li>
        </ul>

        <hr style="border:none; border-top:1px solid var(--void-border); margin:1.75rem 0;">

        <h4 class="font-mono" style="color:var(--alien-green); font-size:0.82rem; letter-spacing:0.1em; margin-bottom:0.75rem;"><?php echo __t('terms', 'can_not_see'); ?></h4>
        <ul class="rule-list allowed">
            <li><span class="rule-icon"><i class="fas fa-lock" style="color:var(--alien-green);"></i></span><div class="rule-body"><strong><?php echo __t('terms', 'post'); ?></div></li>
            <li><span class="rule-icon"><i class="fas fa-lock" style="color:var(--alien-green);"></i></span><div class="rule-body"><strong><?php echo __t('terms', 'messages'); ?></div></li>
            <li><span class="rule-icon"><i class="fas fa-lock" style="color:var(--alien-green);"></i></span><div class="rule-body"><strong><?php echo __t('terms', 'media'); ?></div></li>
            <li><span class="rule-icon"><i class="fas fa-lock" style="color:var(--alien-green);"></i></span><div class="rule-body"><strong><?php echo __t('terms', 'profile_bio'); ?></div></li>
            <li><span class="rule-icon"><i class="fas fa-lock" style="color:var(--alien-green);"></i></span><div class="rule-body"><strong><?php echo __t('terms', 'comments'); ?></div></li>
        </ul>

        <div class="callout callout-blue" style="margin-top:1.5rem;">
            <span class="callout-icon"><i class="fas fa-gavel" style="color:var(--neon-blue);"></i></span>
            <div>
                <strong style="font-family:var(--font-mono); font-size:0.8rem; color:var(--neon-blue); display:block; margin-bottom:0.4rem;"><?php echo __t('terms', 'subpoena'); ?></strong>
                <?php echo __t('terms', 'subpoena_desc'); ?>
            </div>
        </div>
    </div>


    <!-- ═══════════════════════════════════════════════════════
         VI. CONTENT POLICY
    ═══════════════════════════════════════════════════════ -->
    <div id="content-policy" class="tos-section citadel-card" style="border-left:4px solid var(--alien-green);">
        <div class="section-header">
            <span class="section-number"><?php echo __t('terms', 'art6'); ?></span>
            <h2 style="margin:0; font-size:1.4rem;"><i class="fas fa-file-alt" style="color:var(--alien-green);margin-right:0.75rem;"></i><?php echo __t('terms', 'art6_title'); ?></h2>
        </div>
        <p style="margin-bottom:1.25rem;">
            <?php echo __t('terms', 'art6_desc'); ?>
        </p>

        <div class="callout callout-orange">
            <span class="callout-icon"><i class="fas fa-balance-scale" style="color:#ff9f00;"></i></span>
            <div>
                <strong style="font-family:var(--font-mono); font-size:0.8rem; color:#ff9f00; display:block; margin-bottom:0.4rem;"><?php echo __t('terms', 'mod'); ?></strong>
                <?php echo __t('terms', 'mod_desc'); ?>
            </div>
        </div>
    </div>


    <!-- ═══════════════════════════════════════════════════════
         VII. AI MODERATION & FRACTIONS
    ═══════════════════════════════════════════════════════ -->
    <div id="ai-moderation" class="tos-section citadel-card" style="border-left:4px solid var(--glitch-red);">
        <div class="section-header">
            <span class="section-number"><?php echo __t('terms', 'art7'); ?></span>
            <h2 style="margin:0; font-size:1.4rem;"><i class="fas fa-robot" style="color:var(--glitch-red);margin-right:0.75rem;"></i><?php echo __t('terms', 'ai_mod'); ?></h2>
        </div>
        <p style="margin-bottom:1.25rem;">
            <?php echo __t('terms', 'ai_mod_desc'); ?>
        </p>
        <ul class="rule-list neutral">
            <li>
                <span class="rule-icon" style="color:#ff9f00;"><strong>1</strong></span>
                <div class="rule-body">
                    <strong><?php echo __t('terms', 'first'); ?></strong>
                    <?php echo __t('terms', 'first_desc'); ?>
                </div>
            </li>
            <li>
                <span class="rule-icon" style="color:#ff9f00;"><strong>2</strong></span>
                <div class="rule-body">
                    <strong><?php echo __t('terms', 'second'); ?></strong>
                    <?php echo __t('terms', 'second_desc'); ?>
                </div>
            </li>
            <li>
                <span class="rule-icon" style="color:var(--glitch-red);"><strong>3</strong></span>
                <div class="rule-body">
                    <strong><?php echo __t('terms', 'third'); ?></strong>
                    <?php echo __t('terms', 'third_desc'); ?>
                </div>
            </li>
        </ul>

        <div class="callout callout-blue" style="margin-top:1rem;">
            <span class="callout-icon"><i class="fas fa-info-circle" style="color:var(--neon-blue);"></i></span>
            <div><?php echo __t('terms', 'fraction'); ?></div>
        </div>
    </div>


    <!-- ═══════════════════════════════════════════════════════
         VIII. TIERS & PAYMENTS
    ═══════════════════════════════════════════════════════ -->
    <div id="premium" class="tos-section citadel-card" style="border-left:4px solid var(--space-purple);">
        <div class="section-header">
            <span class="section-number"><?php echo __t('terms', 'art8'); ?></span>
            <h2 style="margin:0; font-size:1.4rem;"><i class="fas fa-crown" style="color:var(--space-purple);margin-right:0.75rem;"></i><?php echo __t('terms', 'tiers'); ?></h2>
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:1.5rem; margin-bottom:1.5rem;">
            <div style="border:1px solid var(--void-border); border-radius:var(--radius-md); padding:1.5rem; background:rgba(0,0,0,0.3);">
                <h4 class="font-mono" style="color:var(--text-secondary); font-size:0.8rem; letter-spacing:0.1em; margin-bottom:1rem;"><?php echo __t('terms', 'free'); ?></h4>
                <ul class="rule-list allowed" style="gap:0.6rem;">
                    <li><span class="rule-icon"><i class="fas fa-check" style="color:var(--alien-green); font-size:0.8rem;"></i></span><div class="rule-body" style="font-size:0.85rem;"><?php echo __t('terms', 'public'); ?></div></li>
                    <li><span class="rule-icon"><i class="fas fa-check" style="color:var(--alien-green); font-size:0.8rem;"></i></span><div class="rule-body" style="font-size:0.85rem;"><?php echo __t('terms', 'pcr'); ?></div></li>
                    <li><span class="rule-icon"><i class="fas fa-check" style="color:var(--alien-green); font-size:0.8rem;"></i></span><div class="rule-body" style="font-size:0.85rem;"><?php echo __t('terms', 'conns'); ?></div></li>
                    <li><span class="rule-icon"><i class="fas fa-check" style="color:var(--alien-green); font-size:0.8rem;"></i></span><div class="rule-body" style="font-size:0.85rem;"><?php echo __t('terms', 'enc_msg'); ?></div></li>
                    <li><span class="rule-icon"><i class="fas fa-check" style="color:var(--alien-green); font-size:0.8rem;"></i></span><div class="rule-body" style="font-size:0.85rem;"><?php echo __t('terms', 'rep'); ?></div></li>
                </ul>
            </div>
            <div style="border:1px solid var(--space-purple); border-radius:var(--radius-md); padding:1.5rem; background:rgba(123,47,247,0.05);">
                <h4 class="font-mono" style="color:var(--space-purple); font-size:0.8rem; letter-spacing:0.1em; margin-bottom:1rem;"><?php echo __t('terms', 'prem'); ?></h4>
                <ul class="rule-list allowed" style="gap:0.6rem;">
                    <li><span class="rule-icon"><i class="fas fa-check" style="color:var(--space-purple); font-size:0.8rem;"></i></span><div class="rule-body" style="font-size:0.85rem;"><?php echo __t('terms', 'free_inc'); ?></div></li>
                    <li><span class="rule-icon"><i class="fas fa-check" style="color:var(--space-purple); font-size:0.8rem;"></i></span><div class="rule-body" style="font-size:0.85rem;"><?php echo __t('terms', 'conns'); ?></div></li>
                    <li><span class="rule-icon"><i class="fas fa-check" style="color:var(--space-purple); font-size:0.8rem;"></i></span><div class="rule-body" style="font-size:0.85rem;"><?php echo __t('terms', 'media_storage'); ?></div></li>
                    <li><span class="rule-icon"><i class="fas fa-check" style="color:var(--space-purple); font-size:0.8rem;"></i></span><div class="rule-body" style="font-size:0.85rem;"><?php echo __t('terms', 'profile_badge'); ?></div></li>
                    <li><span class="rule-icon"><i class="fas fa-check" style="color:var(--space-purple); font-size:0.8rem;"></i></span><div class="rule-body" style="font-size:0.85rem;"><?php echo __t('terms', 'priority'); ?></div></li>
                    <li><span class="rule-icon"><i class="fas fa-check" style="color:var(--space-purple); font-size:0.8rem;"></i></span><div class="rule-body" style="font-size:0.85rem;"><?php echo __t('terms', 'analytics'); ?></div></li>
                </ul>
            </div>
        </div>

        <p style="font-size:0.9rem; line-height:1.7; color:var(--text-secondary);">
            <?php echo __t('terms', 'stripe_desc'); ?>
        </p>
    </div>


    <!-- ═══════════════════════════════════════════════════════
         IX. VDP & SECURITY RESEARCH
    ═══════════════════════════════════════════════════════ -->
    <div id="vdp" class="tos-section citadel-card" style="border-left:4px solid var(--alien-green);">
        <div class="section-header">
            <span class="section-number"><?php echo __t('terms', 'art9'); ?></span>
            <h2 style="margin:0; font-size:1.4rem;"><i class="fas fa-bug" style="color:var(--alien-green);margin-right:0.75rem;"></i><?php echo __t('terms', 'art9_title'); ?></h2>
        </div>

        <p style="margin-bottom:1rem;">
            <?php echo __t('terms', 'art9_desc'); ?>
        </p>

        <div class="callout callout-green">
            <span class="callout-icon"><i class="fas fa-check-double" style="color:var(--alien-green);"></i></span>
            <div>
                <strong style="font-family:var(--font-mono); font-size:0.8rem; color:var(--alien-green); display:block; margin-bottom:0.4rem;"><?php echo __t('terms', 'safe_harbor'); ?></strong>
                <?php echo __t('terms', 'safe_harbor_desc'); ?>
            </div>
        </div>

        <hr style="border:none; border-top:1px solid var(--void-border); margin:1.75rem 0;">

        <h4 class="font-mono" style="color:var(--alien-green); font-size:0.85rem; letter-spacing:0.1em; margin-bottom:0.75rem;">
            <i class="fas fa-crosshairs"></i> <?php echo __t('terms', 'in_scope'); ?>
        </h4>
        <ul class="rule-list allowed">
            <li>
                <span class="rule-icon"><i class="fas fa-check" style="color:var(--alien-green);"></i></span>
                <div class="rule-body">
                    <strong><?php echo __t('terms', 'audit'); ?></strong>
                    <?php echo __t('terms', 'audit_desc'); ?>
                </div>
            </li>
            <li>
                <span class="rule-icon"><i class="fas fa-check" style="color:var(--alien-green);"></i></span>
                <div class="rule-body">
                    <strong><?php echo __t('terms', 'auth'); ?></strong>
                    <?php echo __t('terms', 'auth_desc'); ?>
                </div>
            </li>
            <li>
                <span class="rule-icon"><i class="fas fa-check" style="color:var(--alien-green);"></i></span>
                <div class="rule-body">
                    <strong><?php echo __t('terms', 'injection'); ?></strong>
                    <?php echo __t('terms', 'injection_desc'); ?>
                </div>
            </li>
            <li>
                <span class="rule-icon"><i class="fas fa-check" style="color:var(--alien-green);"></i></span>
                <div class="rule-body">
                    <strong><?php echo __t('terms', 'access'); ?></strong>
                    <?php echo __t('terms', 'access_desc'); ?>
                </div>
            </li>
            <li>
                <span class="rule-icon"><i class="fas fa-check" style="color:var(--alien-green);"></i></span>
                <div class="rule-body">
                    <strong><?php echo __t('terms', 'web_root'); ?></strong>
                    <?php echo __t('terms', 'web_root_desc'); ?>
                </div>
            </li>
            <li>
                <span class="rule-icon"><i class="fas fa-check" style="color:var(--alien-green);"></i></span>
                <div class="rule-body">
                    <strong><?php echo __t('terms', 'ai_bypass'); ?></strong>
                    <?php echo __t('terms', 'ai_bypass_desc'); ?>
                </div>
            </li>
            <li>
                <span class="rule-icon"><i class="fas fa-check" style="color:var(--alien-green);"></i></span>
                <div class="rule-body">
                    <strong><?php echo __t('terms', 'tls'); ?></strong>
                    <?php echo __t('terms', 'tls_desc'); ?>
                </div>
            </li>
            <li>
                <span class="rule-icon"><i class="fas fa-check" style="color:var(--alien-green);"></i></span>
                <div class="rule-body">
                    <strong><?php echo __t('terms', 'rate'); ?></strong>
                    <?php echo __t('terms', 'rate_desc'); ?>
                </div>
            </li>
        </ul>

        <hr style="border:none; border-top:1px solid var(--void-border); margin:1.75rem 0;">

        <h4 class="font-mono" style="color:var(--glitch-red); font-size:0.85rem; letter-spacing:0.1em; margin-bottom:0.75rem;">
            <i class="fas fa-ban"></i> <?php echo __t('terms', 'out_of_scope'); ?>
        </h4>
        <ul class="rule-list forbidden">
            <li>
                <span class="rule-icon"><i class="fas fa-times-circle" style="color:var(--glitch-red);"></i></span>
                <div class="rule-body">
                    <strong><?php echo __t('terms', 'real_accounts'); ?></strong>
                    <?php echo __t('terms', 'real_accounts_desc'); ?>
                </div>
            </li>
            <li>
                <span class="rule-icon"><i class="fas fa-times-circle" style="color:var(--glitch-red);"></i></span>
                <div class="rule-body">
                    <strong><?php echo __t('terms', 'ddos'); ?></strong>
                    <?php echo __t('terms', 'ddos_desc'); ?>
                </div>
            </li>
            <li>
                <span class="rule-icon"><i class="fas fa-times-circle" style="color:var(--glitch-red);"></i></span>
                <div class="rule-body">
                    <strong><?php echo __t('terms', 'sec'); ?></strong>
                    <?php echo __t('terms', 'sec_desc'); ?>
                </div>
            </li>
            <li>
                <span class="rule-icon"><i class="fas fa-times-circle" style="color:var(--glitch-red);"></i></span>
                <div class="rule-body">
                    <strong><?php echo __t('terms', 'third_party'); ?></strong>
                    <?php echo __t('terms', 'third_party_desc'); ?>
                </div>
            </li>
            <li>
                <span class="rule-icon"><i class="fas fa-times-circle" style="color:var(--glitch-red);"></i></span>
                <div class="rule-body">
                    <strong><?php echo __t('terms', 'automated_scanners'); ?></strong>
                    <?php echo __t('terms', 'automated_scanners_desc'); ?>
                </div>
            </li>
            <li>
                <span class="rule-icon"><i class="fas fa-times-circle" style="color:var(--glitch-red);"></i></span>
                <div class="rule-body">
                    <strong><?php echo __t('terms', 'public_publishing'); ?></strong>
                    <?php echo __t('terms', 'public_publishing_desc'); ?>
                </div>
            </li>
        </ul>

        <hr style="border:none; border-top:1px solid var(--void-border); margin:1.75rem 0;">

        <h4 class="font-mono" style="color:var(--neon-blue); font-size:0.85rem; letter-spacing:0.1em; margin-bottom:0.75rem;">
            <i class="fas fa-paper-plane"></i> <?php echo __t('terms', 'submit_report'); ?>
        </h4>
        <p style="margin-bottom:1rem; font-size:0.9rem; line-height:1.75;">
            <?php echo __t('terms', 'submit_report_desc'); ?>
        </p>

        <div class="report-channels">
            <a href="https://hackerone.com/mycitadel" target="_blank" rel="noopener" class="report-channel-card">
                <i class="fas fa-shield-alt" style="font-size:1.5rem; color:var(--alien-green);"></i>
                <span class="channel-name"><?php echo __t('terms', 'hackerone'); ?></span>
                <span class="channel-type"><?php echo __t('terms', 'pplatform'); ?></span>
            </a>
            <a href="https://bugcrowd.com/mycitadel" target="_blank" rel="noopener" class="report-channel-card">
                <i class="fas fa-bug" style="font-size:1.5rem; color:var(--alien-green);"></i>
                <span class="channel-name"><?php echo __t('terms', 'bugcrowd'); ?></span>
                <span class="channel-type"><?php echo __t('terms', 'splatform'); ?></span>
            </a>
            <a href="https://www.intigriti.com/programs/mycitadel" target="_blank" rel="noopener" class="report-channel-card">
                <i class="fas fa-crosshairs" style="font-size:1.5rem; color:var(--alien-green);"></i>
                <span class="channel-name"><?php echo __t('terms', 'intigriti'); ?></span>
                <span class="channel-type"><?php echo __t('terms', 'tplatform'); ?></span>
            </a>
            <a href="https://www.yeswehack.com/programs/mycitadel" target="_blank" rel="noopener" class="report-channel-card">
                <i class="fas fa-dharmachakra" style="font-size:1.5rem; color:var(--alien-green);"></i>
                <span class="channel-name"><?php echo __t('terms', 'yeswehack'); ?></span>
                <span class="channel-type"><?php echo __t('terms', 'fplatform'); ?>
            </a>
            <a href="mailto:security@mycitadel.lol" class="report-channel-card">
                <i class="fas fa-envelope-open-text" style="font-size:1.5rem; color:var(--alien-green);"></i>
                <span class="channel-name"><?php echo __t('terms', 'sec_email'); ?></span>
                <span class="channel-type"><?php echo __t('terms', 'pgp_email'); ?></span>
            </a>
        </div>

        <hr style="border:none; border-top:1px solid var(--void-border); margin:1.75rem 0;">

        <h4 class="font-mono" style="color:#ff9f00; font-size:0.85rem; letter-spacing:0.1em; margin-bottom:0.75rem;">
            <i class="fas fa-trophy"></i> <?php echo __t('terms', 'rewards'); ?>
        </h4>
        <p style="font-size:0.88rem; color:var(--text-secondary); margin-bottom:1rem;">
            <?php echo __t('terms', 'rewards_desc'); ?>
        </p>

        <div style="overflow-x:auto; border-radius:var(--radius-md); border:1px solid var(--void-border);">
            <table class="reward-table">
                <thead>
                    <tr>
                        <th><?php echo __t('terms', 'severity'); ?></th>
                        <th><?php echo __t('terms', 'example'); ?></th>
                        <th><?php echo __t('terms', 'current_reward'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><span class="severity-badge sev-critical"><?php echo __t('terms', 'crit'); ?></span></td>
                        <td style="color:var(--text-secondary); font-size:0.8rem;"><?php echo __t('terms', 'crit_desc'); ?></td>
                        <td style="color:var(--alien-green);"><?php echo __t('terms', 'crit_points'); ?></td>
                    </tr>
                    <tr>
                        <td><span class="severity-badge sev-high"><?php echo __t('terms', 'high'); ?></span></td>
                        <td style="color:var(--text-secondary); font-size:0.8rem;"><?php echo __t('terms', 'high_desc'); ?></td>
                        <td style="color:var(--alien-green);"><?php echo __t('terms', 'high_points'); ?></td>
                    </tr>
                    <tr>
                        <td><span class="severity-badge sev-medium"><?php echo __t('terms', 'med'); ?></span></td>
                        <td style="color:var(--text-secondary); font-size:0.8rem;"><?php echo __t('terms', 'med_desc'); ?></td>
                        <td style="color:var(--alien-green);"><?php echo __t('terms', 'med_points'); ?></td>
                    </tr>
                    <tr>
                        <td><span class="severity-badge sev-low"><?php echo __t('terms', 'low'); ?></span></td>
                        <td style="color:var(--text-secondary); font-size:0.8rem;"><?php echo __t('terms', 'low_desc'); ?></td>
                        <td style="color:var(--alien-green);"><?php echo __t('terms', 'low_points'); ?></td>
                    </tr>
                    <tr>
                        <td><span class="severity-badge sev-info"><?php echo __t('terms', 'info'); ?></span></td>
                        <td style="color:var(--text-secondary); font-size:0.8rem;"><?php echo __t('terms', 'info_desc'); ?></td>
                        <td style="color:var(--alien-green);"><?php echo __t('terms', 'info_points'); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>


    <!-- ═══════════════════════════════════════════════════════
         X. BREACH RESPONSE
    ═══════════════════════════════════════════════════════ -->
    <div id="breach" class="tos-section citadel-card" style="border-left:4px solid var(--glitch-red);">
        <div class="section-header">
            <span class="section-number"><?php echo __t('terms', 'art10'); ?></span>
            <h2 style="margin:0; font-size:1.4rem;"><i class="fas fa-shield-virus" style="color:var(--glitch-red);margin-right:0.75rem;"></i><?php echo __t('terms', 'art10_title'); ?></h2>
        </div>
        <p style="margin-bottom:1.25rem;">
            <?php echo __t('terms', 'art10_desc'); ?>
        </p>
        <ul class="rule-list neutral">
            <li>
                <span class="rule-icon"><i class="fas fa-bell" style="color:#ff9f00;"></i></span>
                <div class="rule-body">
                    <strong><?php echo __t('terms', 'citizen_alert'); ?></strong>
                    <?php echo __t('terms', 'citizen_alert_desc'); ?>
                </div>
            </li>
            <li>
                <span class="rule-icon"><i class="fas fa-lock" style="color:#ff9f00;"></i></span>
                <div class="rule-body">
                    <strong><?php echo __t('terms', 'reauth'); ?></strong>
                    <?php echo __t('terms', 'reauth_desc'); ?>
                </div>
            </li>
            <li>
                <span class="rule-icon"><i class="fas fa-search" style="color:#ff9f00;"></i></span>
                <div class="rule-body">
                    <strong><?php echo __t('terms', 'post_incident'); ?></strong>
                    <?php echo __t('terms', 'post_incident_desc'); ?>
                </div>
            </li>
        </ul>

        <div class="callout callout-red" style="margin-top:1.25rem;">
            <span class="callout-icon"><i class="fas fa-exclamation-triangle" style="color:var(--glitch-red);"></i></span>
            <div>
                <strong style="font-family:var(--font-mono); font-size:0.8rem; color:var(--glitch-red); display:block; margin-bottom:0.4rem;"><?php echo __t('terms', 'unauth_access'); ?></strong>
                <?php echo __t('terms', 'unauth_access_desc'); ?>
            </div>
        </div>
    </div>


    <!-- ═══════════════════════════════════════════════════════
         XI. LEGAL & JURISDICTION
    ═══════════════════════════════════════════════════════ -->
    <div id="legal" class="tos-section citadel-card" style="border-left:4px solid var(--text-secondary);">
        <div class="section-header">
            <span class="section-number"><?php echo __t('terms', 'art11'); ?></span>
            <h2 style="margin:0; font-size:1.4rem;"><i class="fas fa-gavel" style="color:var(--text-secondary);margin-right:0.75rem;"></i><?php echo __t('terms', 'art11_title'); ?></h2>
        </div>
        <p style="font-size:0.9rem; line-height:1.8; color:var(--text-secondary); margin-bottom:1rem;">
            <?php echo __t('terms', 'art11_desc1'); ?>
        </p>
        <p style="font-size:0.9rem; line-height:1.8; color:var(--text-secondary);">
            <?php echo __t('terms', 'art11_desc2'); ?>
        </p>
    </div>


    <!-- ═══════════════════════════════════════════════════════
         XII. UPDATES
    ═══════════════════════════════════════════════════════ -->
    <div id="updates" class="tos-section citadel-card" style="border-left:4px solid var(--neon-blue);">
        <div class="section-header">
            <span class="section-number"><?php echo __t('terms', 'art12'); ?></span>
            <h2 style="margin:0; font-size:1.4rem;"><i class="fas fa-sync-alt" style="color:var(--neon-blue);margin-right:0.75rem;"></i><?php echo __t('terms', 'art12_title'); ?></h2>
        </div>
        <p style="font-size:0.9rem; line-height:1.8; color:var(--text-secondary);">
            <?php echo __t('terms', 'art12_desc'); ?>
        </p>
    </div>


    <!-- ═══════════════════════════════════════════════════════
         ACCEPTANCE FOOTER
    ═══════════════════════════════════════════════════════ -->
    <div class="acceptance-block">
        <i class="fas fa-shield-alt" style="font-size:2.5rem; color:var(--neon-blue); margin-bottom:1.25rem; display:block;"></i>
        <h3 class="stencil-text glowing-title" style="font-size:1.6rem; letter-spacing:3px; margin-bottom:1rem;">
            <?php echo __t('terms', 'claim'); ?>
        </h3>
        <p style="max-width:560px; margin:0 auto 1.75rem; font-size:0.95rem; color:var(--text-secondary); line-height:1.8;">
            <?php echo __t('terms', 'claim_desc'); ?>
        </p>
        <div style="display:flex; gap:1.5rem; justify-content:center; flex-wrap:wrap;">
            <a href="register.php" class="btn-cyber">
                <i class="fas fa-key"></i> <?php echo __t('terms', 'initialize'); ?>
            </a>
            <a href="login.php" class="btn-cyber" style="border-color:var(--space-purple); color:var(--space-purple);">
                <i class="fas fa-sign-in-alt"></i> <?php echo __t('terms', 'login'); ?>
            </a>
        </div>
        <p class="last-updated">
            <?php echo __t('terms', 'prot_version'); ?>: <?php echo htmlspecialchars($doc_version); ?> &nbsp;//&nbsp;
            <?php echo __t('terms', 'last_mod'); ?>: <?php echo htmlspecialchars($page_last_updated); ?> &nbsp;//&nbsp;
            <?php echo __t('terms', 'doc'); ?>: <?php echo substr($doc_hash, 0, 16); ?>...
        </p>
    </div>

</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>