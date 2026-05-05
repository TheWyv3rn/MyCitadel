<?php
/**
 * PROJECT: MY CITADEL
 * MODULE: CITIZEN DASHBOARD (STABILITY PATCH)
 */

declare(strict_types=1);

// 1. Core Handshake
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/auth/gatekeeper.php';
require_once __DIR__ . '/../includes/header.php';

// Safe extraction of telemetry data
$user_ip = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';

/**
 * SECURITY PATCH: PHP 8.1+ Stability
 * Ensures htmlspecialchars receives a string, preventing 500 errors on null values.
 */
$alias = htmlspecialchars((string)($me['alias'] ?? 'Unknown_Citizen'));
$rank  = (!empty($me['is_premium'])) ? 'ELITE_CITIZEN' : 'STANDARD_CITIZEN';
?>

<div class="container py-5">
    
    <!-- [DASHBOARD HEADER] -->
    <header class="row align-items-center mb-5 animate__animated animate__fadeIn">
        <div class="col-md-8">
            <h1 class="glowing-title stencil-text h2">
                <i class="fas fa-terminal text-neon-blue"></i> <?php echo __t('dash', 'welcome'); ?>, <?php echo $alias; ?>
            </h1>
            <div class="data-stream d-inline-block border-alien-green text-alien-green mt-2">
                <i class="fas fa-shield-alt"></i> <?php echo $rank; ?> // <?php echo __t('dash', 'status'); ?>
            </div>
        </div>
        <div class="col-md-4 text-md-end mt-3 mt-md-0">
            <a href="../logout.php" class="btn-cyber border-danger text-danger">
                <i class="fas fa-power-off"></i> <?php echo __t('dash', 'lgt'); ?>
            </a>
        </div>
    </header>

    <!-- [CORE TELEMETRY CARDS] -->
    <div class="row g-4 mb-5">
        <!-- Reputation -->
        <div class="col-md-4">
            <div class="citadel-card border-neon-blue">
                <h3 class="stencil-text h6 text-secondary"><?php echo __t('dash', 'rep_h'); ?></h3>
                <div class="display-5 text-white stencil-text"><?php echo number_format((int)($me['reputation'] ?? 0)); ?></div>
            </div>
        </div>

        <!-- Influence -->
        <div class="col-md-4">
            <div class="citadel-card border-alien-green">
                <h3 class="stencil-text h6 text-secondary"><?php echo __t('dash', 'inf_h'); ?></h3>
                <div class="display-5 text-white stencil-text"><?php echo number_format((int)($me['influence'] ?? 0)); ?></div>
            </div>
        </div>

        <!-- System Security Binding -->
        <div class="col-md-4">
            <div class="citadel-card border-space-purple">
                <h3 class="stencil-text h6 text-secondary"><?php echo __t('dash', 'neural'); ?></h3>
                <div class="text-white font-mono small text-truncate">ID: <?php echo session_id(); ?></div>
                <p class="x-small text-secondary mt-2">// <?php echo __t('dash', 'ip'); ?>: <?php echo $user_ip; ?></p>
            </div>
        </div>
    </div>

    <!-- [ACTIVITY STREAM] -->
    <div class="row">
        <div class="col-12">
            <div class="citadel-card bg-black p-5 text-center">
                <h2 class="stencil-text text-neon-blue h4"><?php echo __t('dash', 'feed_h'); ?></h2>
                <p class="text-secondary font-mono small"><?php echo __t('dash', 'offline'); ?></p>
                <div class="mt-3">
                    <span class="badge bg-dark border border-neon-blue text-neon-blue p-2">
                        <i class="fas fa-sync fa-spin"></i> <?php echo __t('dash', 'p2p'); ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>