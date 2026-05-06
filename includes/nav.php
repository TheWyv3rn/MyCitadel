<?php
/**
 * PROJECT: MY CITADEL
 * MODULE: ULTIMATE RESPONSIVE NAVIGATION (STATE-AWARE)
 * VERSION: 2.2.0
 * DESCRIPTION: Handles conditional authentication UI and localized user dropdowns.
 */
global $citadel_flags, $active_lang; 

// Check if a session is active
$is_logged_in = isset($_SESSION['citizen_id']);
$alias = $is_logged_in ? htmlspecialchars($_SESSION['citizen_alias']) : '';
?>
<nav class="navbar navbar-expand-lg citadel-nav">
    <div class="container">
        <a href="<?php echo SITE_URL; ?>/" class="navbar-brand nav-brand d-flex align-items-center">
            <i class="fas fa-microchip mr-2 animate__animated animate__pulse animate__infinite text-neon-blue"></i> 
            <span class="stencil-text ml-2"><?php echo __t('global', 'site_name'); ?></span>
        </a>

        <button class="navbar-toggler border-neon-blue" type="button" data-bs-toggle="collapse" data-bs-target="#citadelNavbar" aria-controls="citadelNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars text-neon-blue"></i>
        </button>

        <div class="collapse navbar-collapse" id="citadelNavbar">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a href="<?php echo SITE_URL; ?>/index.php" class="nav-link">
                        <i class="fas fa-home mr-1"></i> <?php echo __t('nav', 'system'); ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo SITE_URL; ?>/about.php" class="nav-link">
                        <i class="fas fa-info-circle mr-1"></i> <?php echo __t('nav', 'about'); ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo SITE_URL; ?>/vdp.php" class="nav-link">
                        <i class="fas fa-user-secret mr-1"></i> <?php echo __t('nav', 'vdp'); ?>
                    </a>
                </li>
            </ul>

            <div class="nav-controls d-flex align-items-center flex-column flex-lg-row">
                <div class="dropdown mb-3 mb-lg-0 mr-lg-3">
                    <button class="btn-cyber dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo $citadel_flags[$active_lang] ?? '🌐'; ?>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark bg-black border-neon shadow-lg">
                        <?php foreach ($citadel_flags as $code => $flag): ?>
                            <li>
                                <a class="dropdown-item d-flex justify-content-between align-items-center" href="?lang=<?php echo $code; ?>">
                                    <span><?php echo $flag; ?> <?php echo strtoupper($code); ?></span>
                                    <?php if($active_lang === $code): ?>
                                        <i class="fas fa-check-circle text-alien-green small"></i>
                                    <?php endif; ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <?php if ($is_logged_in): ?>
                    <div class="dropdown w-100 w-lg-auto">
                        <button class="btn-cyber dropdown-toggle w-100" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle mr-2 text-alien-green"></i> <?php echo $alias; ?>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end bg-black border-neon shadow-lg">
                            <li>
                                <a class="dropdown-item" href="<?php echo SITE_URL; ?>/citizen/dashboard.php">
                                    <i class="fas fa-tachometer-alt mr-2 text-neon-blue"></i> <?php echo __t('nav', 'dash_h'); ?>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="<?php echo SITE_URL; ?>/citizen/feed.php">
                                    <i class="fas fa-stream mr-2 text-neon-blue"></i> <?php echo __t('nav', 'feed_h'); ?>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="<?php echo SITE_URL; ?>/citizen/comms.php">
                                    <i class="fas fa-comments mr-2 text-neon-blue"></i> <?php echo __t('nav', 'comms_h'); ?>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="<?php echo SITE_URL; ?>/citizen/directory.php">
                                    <i class="fas fa-users mr-2 text-neon-blue"></i> <?php echo __t('nav', 'cits_h'); ?>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex justify-content-between align-items-center" href="<?php echo SITE_URL; ?>/citizen/notifications.php">
                                    <span><i class="fas fa-bell mr-2 text-neon-blue"></i> <?php echo __t('nav', 'notif_h'); ?></span>
                                    <span class="badge bg-danger rounded-pill x-small">0</span>
                                </a>
                            </li>
                            <li><hr class="dropdown-divider border-secondary"></li>
                            <li>
                                <a class="dropdown-item text-danger" href="<?php echo SITE_URL; ?>/includes/auth/logout.php">
                                    <i class="fas fa-sign-out-alt mr-2"></i> <?php echo __t('nav', 'logout_h'); ?>
                                </a>
                            </li>
                        </ul>
                    </div>
                <?php else: ?>
                    <a href="<?php echo SITE_URL; ?>/login.php" class="btn-cyber w-100 w-lg-auto">
                        <i class="fas fa-sign-in-alt mr-2"></i> <?php echo __t('nav', 'auth'); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>

<style>
/* ... (Keep existing styles) ... */
.dropdown-item {
    font-size: 0.8rem;
    padding: 0.7rem 1.2rem;
    transition: all 0.2s ease;
}
.dropdown-item:hover {
    background: rgba(0, 242, 255, 0.1);
    color: var(--neon-blue);
    padding-left: 1.5rem;
}
.dropdown-menu-end {
    right: 0;
    left: auto;
}
</style>