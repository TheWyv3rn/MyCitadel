<?php
/**
 * PROJECT: MY CITADEL
 * COMPONENT: HUD NAVIGATION SYSTEM
 * VERSION: 1.1.0
 * DESCRIPTION: Symmetric three-point navigation dock featuring a compact, 
 * dual-column CSS grid dropdown matrix for all 15 global target languages.
 */

// Simulated login check - Balanced against roadmap state indicators
$isLoggedIn = false; 
$currentAlias = "Citizen_Wyvern"; 

// Mapping matrix for current active locale display flag elements
$flag_map = [
    'en' => '🇺🇸', 'zh' => '🇨🇳', 'hi' => '🇮🇳', 'es' => '🇪🇸', 'fr' => '🇫🇷',
    'ar' => '🇸🇦', 'bn' => '🇧🇩', 'pt' => '🇧🇷', 'ru' => '🇷🇺', 'ur' => '🇵🇰',
    'id' => '🇮🇩', 'de' => '🇩🇪', 'ja' => '🇯🇵', 'tr' => '🇹🇷', 'vi' => '🇻🇳', 'ko' => '🇰🇷'
];
$active_lang = $_SESSION['lang'] ?? 'en';
$current_flag = $flag_map[$active_lang] ?? '🌐';
?>

<nav class="citadel-nav">
    <div class="container nav-wrapper">
        
        <!-- ==========================================
           LEFT FLANK: ROUTING MATRIX
           ========================================== -->
        <div class="nav-flank nav-left">
            <ul class="nav-menu-list">
                <li>
                    <a href="index.php" class="nav-link active">
                        <i class="fas fa-terminal data-stream"></i> <?php echo __t('nav', 'home'); ?>
                    </a>
                </li>
                <li>
                    <a href="about.php" class="nav-link">
                        <?php echo __t('nav', 'about'); ?>
                    </a>
                </li>
                <li class="cyber-dropdown">
                    <span class="nav-link dropdown-trigger">
                        <?php echo __t('nav', 'privacy_data'); ?> <i class="fas fa-caret-down nav-accent-icon"></i>
                    </span>
                    <ul class="dropdown-terminal-panel">
                        <li>
                            <a href="legal/terms.php">
                                <i class="fas fa-file-contract"></i> <?php echo __t('nav', 'terms_conditions'); ?>
                            </a>
                        </li>
                        <li>
                            <a href="legal/privacy.php">
                                <i class="fas fa-shield-alt"></i> <?php echo __t('nav', 'security_act'); ?>
                            </a>
                        </li>
                        <li>
                            <a href="operations/nzk.php">
                                <i class="fas fa-user-secret"></i> <?php echo __t('nav', 'nzk_ops'); ?>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>

        <!-- ==========================================
           CORE BRAND IDENTITY
           ========================================== -->
        <div class="nav-core">
            <a href="index.php" class="nav-brand glowing-title stencil-text">
                <i class="fas fa-user-shield"></i> <?php echo __t('nav', 'comp'); ?>
            </a>
        </div>

        <!-- ==========================================
           RIGHT FLANK: USER AUTH & DUAL-COLUMN LOCALE MATRIX
           ========================================== -->
        <div class="nav-flank nav-right">
            
            <!-- GLOBAL MULTI-COLOCALE MATRIX SELECTOR -->
            <div class="cyber-dropdown" style="margin-right: 1.5rem;">
                <span class="nav-link dropdown-trigger" style="cursor: pointer; display: flex; align-items: center; gap: 0.5rem;">
                    <span><?php echo $current_flag; ?></span>
                    <span class="font-mono"><?php echo strtoupper($active_lang); ?></span> 
                    <i class="fas fa-caret-down nav-accent-icon" style="font-size: 0.8rem;"></i>
                </span>
                
                <!-- Expanded Matrix Panel utilizing CSS Grid mapping -->
                <ul class="dropdown-terminal-panel" style="
                    min-width: 340px; 
                    display: grid; 
                    grid-template-columns: repeat(2, 1fr); 
                    gap: 0.4rem; 
                    padding: 0.8rem;
                ">
                    <li><a href="?set_lang=en">🇺🇸 <span class="text-blue">[EN]</span> English</a></li>
                    <li><a href="?set_lang=zh">🇨🇳 <span class="text-green">[ZH]</span> 简体中文</a></li>
                    <li><a href="?set_lang=hi">🇮🇳 <span class="text-purple">[HI]</span> हिन्दी</a></li>
                    <li><a href="?set_lang=es">🇪🇸 <span class="text-purple">[ES]</span> Español</a></li>
                    <li><a href="?set_lang=fr">🇫🇷 <span class="text-blue">[FR]</span> Français</a></li>
                    <li><a href="?set_lang=ar">🇸🇦 <span class="text-green">[AR]</span> العربية</a></li>
                    <li><a href="?set_lang=bn">🇧🇩 <span class="text-purple">[BN]</span> বাংলা</a></li>
                    <li><a href="?set_lang=pt">🇧🇷 <span class="text-blue">[PT]</span> Português</a></li>
                    <li><a href="?set_lang=ru">🇷🇺 <span class="text-blue">[RU]</span> Русский</a></li>
                    <li><a href="?set_lang=ur">🇵🇰 <span class="text-green">[UR]</span> اردو</a></li>
                    <li><a href="?set_lang=id">🇮🇩 <span class="text-purple">[ID]</span> Indonésia</a></li>
                    <li><a href="?set_lang=de">🇩🇪 <span class="text-blue">[DE]</span> Deutsch</a></li>
                    <li><a href="?set_lang=ja">🇯🇵 <span class="text-green">[JA]</span> 日本語</a></li>
                    <li><a href="?set_lang=tr">🇹🇷 <span class="text-purple">[TR]</span> Türkçe</a></li>
                    <li><a href="?set_lang=vi">🇻🇳 <span class="text-blue">[VI]</span> Tiếng Việt</a></li>
                    <li><a href="?set_lang=ko">🇰🇷 <span class="text-green">[KO]</span> 한국어</a></li>
                </ul>
            </div>

            <?php if ($isLoggedIn): ?>
                <div class="auth-active-cluster">
                    <div class="notification-comms-hub">
                        <i class="fas fa-bell alert-bell-icon"></i>
                        <span class="alert-ping-dot"></span>
                    </div>
                    <div class="cyber-dropdown">
                        <span class="nav-link dropdown-trigger alias-display">
                            [<?php echo htmlspecialchars($currentAlias); ?>]
                        </span>
                    </div>
                </div>
            <?php else: ?>
                <div class="auth-guest-cluster">
                    <a href="auth/login.php" class="nav-link login-trigger">
                        <?php echo __t('nav', 'login'); ?>
                    </a>
                    <span class="matrix-divider">|</span>
                    <a href="auth/register.php" class="btn-cyber register-trigger">
                        <i class="fas fa-id-card"></i> <?php echo __t('nav', 'register'); ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>

    </div>
</nav>