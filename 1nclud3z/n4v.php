<?php
/**
 * MyCitadel - Tactical Navigation v5.5 (Global HUD Edition)
 * Security: Fail-Safe Language Handshake & Responsive Grid
 */

// 1. DYNAMIC ACTIVE STATE
if (!function_exists('is_active')) {
    function is_active($page) {
        $current = basename($_SERVER['PHP_SELF']);
        return ($current == $page) ? 'active border-bottom border-primary text-primary' : '';
    }
}

// 2. THE GLOBAL POWER 15 (Top 15 most used + Cree)
$languages = [
    'en' => ['name' => 'English', 'flag' => '🇺🇸'],
    'cr' => ['name' => 'Cree', 'flag' => '🪶'],
    'zh' => ['name' => '中文', 'flag' => '🇨🇳'],
    'hi' => ['name' => 'हिन्दी', 'flag' => '🇮🇳'],
    'es' => ['name' => 'Español', 'flag' => '🇪🇸'],
    'fr' => ['name' => 'Français', 'flag' => '🇫🇷'],
    'ar' => ['name' => 'العربية', 'flag' => '🇸🇦'],
    'bn' => ['name' => 'বাংলা', 'flag' => '🇧🇩'],
    'pt' => ['name' => 'Português', 'flag' => '🇧🇷'],
    'ru' => ['name' => 'Русский', 'flag' => '🇷🇺'],
    'ja' => ['name' => '日本語', 'flag' => '🇯🇵'],
    'pa' => ['name' => 'ਪੰਜਾਬੀ', 'flag' => '🇵🇰'],
    'de' => ['name' => 'Deutsch', 'flag' => '🇩🇪'],
    'jv' => ['name' => 'Basa Jawa', 'flag' => '🇮🇩'],
    'tr' => ['name' => 'Türkçe',       'flag' => '🇹🇷'],
    'vi' => ['name' => 'Tiếng Việt',   'flag' => '🇻🇳'],
    'it' => ['name' => 'Italiano',     'flag' => '🇮🇹'],
    'fa' => ['name' => 'فارسی',        'flag' => '🇮🇷'],
    'sw' => ['name' => 'Kiswahili',    'flag' => '🇰🇪'],
    'nl' => ['name' => 'Nederlands',   'flag' => '🇳🇱'],
    'pl' => ['name' => 'Polski',       'flag' => '🇵🇱'],
    'uk' => ['name' => 'Українська',   'flag' => '🇺🇦']
];

// 3. FAIL-SAFE LANGUAGE SELECTION (Fixes your Undefined Key error)
$current_lang = $_SESSION['lang'] ?? $_COOKIE['citadel_lang'] ?? 'en';

// If the selected lang isn't in our array (corruption check), fallback to 'en'
if (!array_key_exists($current_lang, $languages)) {
    $current_lang = 'en';
}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-black sticky-top border-bottom border-secondary shadow-lg">
    <div class="container-fluid px-lg-5">
        <a class="navbar-brand citadel-brand d-flex align-items-center" href="/">
            <i class="fas fa-chess-rook text-primary me-2 animate__animated animate__pulse animate__infinite"></i>
            <span class="fw-bold text-uppercase tracking-wider">MyCitadel</span>
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#citadelNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="citadelNavbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item">
                    <a class="nav-link px-3 <?php echo is_active('index.php'); ?>" href="/">
                        <?php echo __t('nav', 'home'); ?>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link px-3 <?php echo is_active('about.php'); ?>" href="/about">
                        <?php echo __t('nav', 'about'); ?>
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle px-3" href="#" id="legalDropdown" data-bs-toggle="dropdown">
                        <?php echo __t('nav', 'legal_sector'); ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark border-primary bg-black animate__animated animate__fadeIn">
                        <li><a class="dropdown-item small" href="/compliance"><?php echo __t('nav', 'compliance'); ?></a></li>
                        <li><a class="dropdown-item small" href="/laws"><?php echo __t('nav', 'laws'); ?></a></li>
                        <li><a class="dropdown-item small" href="/privacy-act"><?php echo __t('nav', 'privacy_act'); ?></a></li>
                    </ul>
                </li>
                
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item">
                        <a class="nav-link px-3 <?php echo is_active('dashboard.php'); ?>" href="/dashboard">
                            <?php echo __t('nav', 'dashboard'); ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3 <?php echo is_active('vault.php'); ?>" href="/vault">
                            <?php echo __t('nav', 'vault'); ?>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>

            <div class="d-flex align-items-center flex-column flex-lg-row">
                
                <div class="dropdown me-lg-3 my-2 my-lg-0 w-100">
                    <button class="btn btn-dark btn-sm dropdown-toggle border-primary w-100" type="button" data-bs-toggle="dropdown">
                        <span class="me-1"><?php echo $languages[$current_lang]['flag']; ?></span>
                        <span class="d-none d-xl-inline"><?php echo $languages[$current_lang]['name']; ?></span>
                        <span class="d-inline d-xl-none"><?php echo strtoupper($current_lang); ?></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark border-primary bg-black p-2 shadow-glow" style="min-width: 320px;">
                        <div class="row g-1">
                            <?php foreach ($languages as $code => $info): ?>
                                <div class="col-6">
                                    <li>
                                        <a class="dropdown-item small py-2 <?php echo ($current_lang == $code) ? 'text-primary active' : ''; ?>" href="?lang=<?php echo $code; ?>">
                                            <span class="me-2"><?php echo $info['flag']; ?></span> <?php echo $info['name']; ?>
                                        </a>
                                    </li>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </ul>
                </div>

                <?php if (isset($_SESSION['user_id'])): ?>
                    <div class="dropdown w-100">
                        <button class="btn btn-primary btn-sm dropdown-toggle px-3 w-100 hud-bevel" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-shield me-2"></i><?php echo $_SESSION['username']; ?>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark border-primary bg-black">
                            <li><a class="dropdown-item small" href="/settings"><?php echo __t('nav', 'settings'); ?></a></li>
                            <li><hr class="dropdown-divider border-secondary"></li>
                            <li><a class="dropdown-item small text-danger" href="/logout"><?php echo __t('nav', 'logout'); ?></a></li>
                        </ul>
                    </div>
                <?php else: ?>
                    <div class="d-flex w-100 gap-2">
                        <a href="/login" class="btn btn-outline-primary btn-sm px-3 flex-grow-1"><?php echo __t('common', 'btn_login'); ?></a>
                        <a href="/register" class="btn btn-primary btn-sm px-3 flex-grow-1"><?php echo __t('common', 'btn_register'); ?></a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>