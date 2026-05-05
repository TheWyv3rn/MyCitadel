<?php
/**
 * PROJECT: MY CITADEL
 * MODULE: ULTIMATE RESPONSIVE NAVIGATION
 * VERSION: 2.1.0
 * DESCRIPTION: High-performance, mobile-first navigation with full icon integration and i18n support.
 */
global $citadel_flags, $active_lang; 
?>
<nav class="navbar navbar-expand-lg citadel-nav">
    <div class="container">
        <!-- Brand Identity -->
        <a href="<?php echo SITE_URL; ?>/" class="navbar-brand nav-brand d-flex align-items-center">
            <i class="fas fa-microchip mr-2 animate__animated animate__pulse animate__infinite text-neon-blue"></i> 
            <span class="stencil-text ml-2"><?php echo __t('global', 'site_name'); ?></span>
        </a>

        <!-- Mobile Toggle (Hamburger) -->
        <button class="navbar-toggler border-neon-blue" type="button" data-bs-toggle="collapse" data-bs-target="#citadelNavbar" aria-controls="citadelNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars text-neon-blue"></i>
        </button>

        <!-- Navigation Links & Controls -->
        <div class="collapse navbar-collapse" id="citadelNavbar">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a href="<?php echo SITE_URL; ?>/index.php" class="nav-link">
                        <i class="fas fa-home mr-1"></i> <?php echo __t('nav', 'system'); ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo SITE_URL; ?>/about.php" class="nav-link">
                        <i class="fas fa-info-circle mr-1"></i> <?php echo __t('nav', 'about') ?: 'About'; ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo SITE_URL; ?>/howto.php" class="nav-link">
                        <i class="fas fa-book mr-1"></i> <?php echo __t('nav', 'howto') ?: 'HowTo'; ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo SITE_URL; ?>/vdp.php" class="nav-link">
                        <i class="fas fa-user-secret mr-1"></i> <?php echo __t('nav', 'vdp') ?: 'VDP'; ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo SITE_URL; ?>/policies.php" class="nav-link">
                        <i class="fas fa-file-contract mr-1"></i> <?php echo __t('nav', 'policies') ?: 'Policies'; ?>
                    </a>
                </li>
            </ul>

            <div class="nav-controls d-flex align-items-center flex-column flex-lg-row">
                <!-- Language Switcher -->
                <div class="dropdown mb-3 mb-lg-0 mr-lg-3">
                    <button class="btn-cyber dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo $citadel_flags[$active_lang] ?? '🌐'; ?> <span class="d-lg-none ml-2">Language</span>
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

                <!-- Authentication Entry -->
                <a href="<?php echo SITE_URL; ?>/login.php" class="btn-cyber w-100 w-lg-auto">
                    <i class="fas fa-sign-in-alt mr-2"></i> <?php echo __t('nav', 'auth'); ?>
                </a>
            </div>
        </div>
    </div>
</nav>

<style>
/* Responsive Navigation Tweaks */
.citadel-nav .nav-link {
    font-family: var(--font-main);
    text-transform: uppercase;
    font-size: 0.85rem;
    letter-spacing: 1px;
    padding: 0.5rem 1rem !important;
    transition: var(--transition-fast);
}

.citadel-nav .nav-link:hover {
    color: var(--neon-blue) !important;
    text-shadow: 0 0 8px var(--neon-blue);
}

@media (max-width: 991.98px) {
    .navbar-collapse {
        background: var(--void-surface);
        backdrop-filter: var(--glass-blur);
        padding: 2rem;
        border-radius: var(--radius-md);
        margin-top: 1rem;
        border: 1px solid var(--void-border);
    }
    
    .nav-item {
        border-bottom: 1px solid rgba(0, 242, 255, 0.05);
        padding: 0.5rem 0;
    }
    
    .nav-controls {
        margin-top: 1.5rem;
        width: 100%;
    }
}
</style>