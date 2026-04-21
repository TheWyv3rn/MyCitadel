<?php
/**
 * MyCitadel - Tactical Navigation HUD v5.8 (Sovereign Force Edition)
 * Path: 1nclud3z/n4v.php
 * Logic: Synchronized with Citizen Session Registry (citizen_id & citizen_alias)
 */

// 1. ABSOLUTE GLOBAL ENFORCEMENT
global $lang, $lang_data;

// 2. RECOVERY PROTOCOL
if (!isset($lang) || empty($lang)) {
    $lang = $_SESSION['lang'] ?? $_COOKIE['citadel_lang'] ?? 'en';
}

if (!isset($lang_data) || empty($lang_data)) {
    // Relative path adjustment to ensure translation loading
    $recoveryPath = __DIR__ . "/../../private/lang/{$lang}.json";
    if (file_exists($recoveryPath)) {
        $lang_data = json_decode(file_get_contents($recoveryPath), true);
    }
}

// 3. DYNAMIC ACTIVE STATE
if (!function_exists('is_active')) {
    function is_active($page) {
        $current = basename($_SERVER['PHP_SELF'], ".php");
        return ($current == $page) ? 'active-node text-primary' : '';
    }
}

// 4. LANGUAGE REGISTRY (24 Nodes)
$languages = [
    'en'  => ['name' => 'English', 'flag' => '🇺🇸'],
    'cr'  => ['name' => 'Cree', 'flag' => '🪶'],
    'zh'  => ['name' => '中文', 'flag' => '🇨🇳'],
    'cmn' => ['name' => 'Mandarin', 'flag' => '🇨🇳'],
    'ko'  => ['name' => '한국어', 'flag' => '🇰🇷'],
    'hi'  => ['name' => 'हिन्दी', 'flag' => '🇮🇳'],
    'es'  => ['name' => 'Español', 'flag' => '🇪🇸'],
    'fr'  => ['name' => 'Français', 'flag' => '🇫🇷'],
    'ar'  => ['name' => 'العربية', 'flag' => '🇸🇦'],
    'bn'  => ['name' => 'বাংলা', 'flag' => '🇧🇩'],
    'pt'  => ['name' => 'Português', 'flag' => '🇧🇷'],
    'ru'  => ['name' => 'Русский', 'flag' => '🇷🇺'],
    'ja'  => ['name' => '日本語', 'flag' => '🇯🇵'],
    'pa'  => ['name' => 'ਪੰਜਾਬੀ', 'flag' => '🇵🇰'],
    'de'  => ['name' => 'Deutsch', 'flag' => '🇩🇪'],
    'jv'  => ['name' => 'Basa Jawa', 'flag' => '🇮🇩'],
    'tr'  => ['name' => 'Türkçe', 'flag' => '🇹🇷'],
    'vi'  => ['name' => 'Tiếng Việt', 'flag' => '🇻🇳'],
    'it'  => ['name' => 'Italiano', 'flag' => '🇮🇹'],
    'fa'  => ['name' => 'فارسی', 'flag' => '🇮🇷'],
    'sw'  => ['name' => 'Kiswahili', 'flag' => '🇰🇪'],
    'nl'  => ['name' => 'Nederlands', 'flag' => '🇳🇱'],
    'pl'  => ['name' => 'Polski', 'flag' => '🇵🇱'],
    'uk'  => ['name' => 'Українська', 'flag' => '🇺🇦']
];

// 5. SOVEREIGN TRANSLATION HELPER
if (!function_exists('__t')) {
    function __t($scope, $key) {
        global $lang_data;
        return $lang_data[$scope][$key] ?? ($lang_data['common'][$key] ?? "!!{$scope}.{$key}!!");
    }
}

/**
 * FIXED SESSION MAPPING
 * Syncing with login_uplink.php keys
 */
$is_logged_in = isset($_SESSION['citizen_id']);
$citizen_alias = $_SESSION['citizen_alias'] ?? 'Unknown Citizen';
$has_notifications = $is_logged_in && (isset($_SESSION['new_intel']) && $_SESSION['new_intel'] === true);
?>

<style>
    .citadel-nav {
        background: rgba(0, 0, 0, 0.95) !important;
        border-bottom: 2px solid #bc13fe !important;
        box-shadow: 0 0 20px rgba(188, 19, 254, 0.2);
        font-family: 'SourceCodePro', monospace;
    }

    .citadel-brand {
        font-family: 'Orbitron', sans-serif;
        letter-spacing: 2px;
        text-shadow: 0 0 10px #bc13fe;
    }

    .nav-link {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s ease;
        border-bottom: 2px solid transparent;
    }

    .nav-link:hover, .active-node {
        color: #39ff14 !important;
        text-shadow: 0 0 8px rgba(57, 255, 20, 0.5);
    }

    .active-node {
        border-bottom: 2px solid #39ff14 !important;
    }

    .dropdown-menu-citadel {
        background: #000 !important;
        border: 1px solid #bc13fe !important;
        box-shadow: 0 0 30px rgba(188, 19, 254, 0.3);
        border-radius: 0;
        margin-top: 10px !important;
    }

    .dropdown-item-citadel {
        color: #bc13fe !important;
        font-size: 0.7rem;
        text-transform: uppercase;
        padding: 10px 20px;
        transition: all 0.2s ease;
        border-bottom: 1px solid rgba(188, 19, 254, 0.1);
    }

    .dropdown-item-citadel:hover {
        background: #bc13fe !important;
        color: #000 !important;
    }

    .sentinel-bell {
        position: relative;
        cursor: pointer;
        font-size: 1.1rem;
        color: #bc13fe;
        transition: 0.3s;
    }

    .sentinel-bell:hover { color: #39ff14; }

    .notification-glow {
        position: absolute;
        top: -2px;
        right: -2px;
        width: 8px;
        height: 8px;
        background: #39ff14;
        border-radius: 50%;
        box-shadow: 0 0 10px #39ff14;
        animation: sentinel-pulse 1.5s infinite;
    }

    @keyframes sentinel-pulse {
        0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(57, 255, 20, 0.7); }
        70% { transform: scale(1); box-shadow: 0 0 0 10px rgba(57, 255, 20, 0); }
        100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(57, 255, 20, 0); }
    }

    .hud-btn {
        font-family: 'Orbitron', sans-serif;
        font-size: 0.65rem;
        letter-spacing: 1px;
        border-radius: 0;
    }

    .user-alias-btn {
        border: 1px solid #bc13fe;
        color: #bc13fe;
        background: transparent;
    }

    .lang-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 5px;
        padding: 10px;
        min-width: 280px;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-dark citadel-nav sticky-top">
    <div class="container-fluid px-lg-5">
        
        <a class="navbar-brand citadel-brand d-flex align-items-center" href="/">
            <i class="fas fa-chess-rook text-primary me-2 animate__animated animate__pulse animate__infinite"></i>
            <span class="fw-black text-white">MYCITADEL</span>
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#citadelNavMain">
            <span class="fas fa-bars text-primary"></span>
        </button>

        <div class="collapse navbar-collapse" id="citadelNavMain">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item">
                    <a class="nav-link px-3 <?php echo is_active('index'); ?>" href="/index.php">
                        <?php echo __t('nav', 'home'); ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 <?php echo is_active('about'); ?>" href="/about.php">
                        <?php echo __t('nav', 'about'); ?>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle px-3" href="#" data-bs-toggle="dropdown">
                        <?php echo __t('nav', 'legal_sector'); ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-citadel animate__animated animate__fadeIn">
                        <li><a class="dropdown-item dropdown-item-citadel" href="/compliance.php"><?php echo __t('nav', 'compliance'); ?></a></li>
                        <li><a class="dropdown-item dropdown-item-citadel" href="/laws.php"><?php echo __t('nav', 'laws'); ?></a></li>
                        <li><a class="dropdown-item dropdown-item-citadel" href="/privacy-act.php"><?php echo __t('nav', 'privacy_act'); ?></a></li>
                    </ul>
                </li>
            </ul>

            <div class="d-flex align-items-center flex-column flex-lg-row">
                <!-- LANGUAGE HUD -->
                <div class="dropdown me-lg-4 my-2 my-lg-0 w-100">
                    <button class="btn btn-dark btn-sm dropdown-toggle border-primary w-100 hud-btn" type="button" data-bs-toggle="dropdown">
                        <span><?php echo $languages[$lang]['flag'] ?? '🌐'; ?></span>
                        <span class="ms-2"><?php echo strtoupper($lang); ?></span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-citadel p-0">
                        <div class="lang-grid">
                            <?php foreach ($languages as $code => $info): ?>
                                <a class="dropdown-item dropdown-item-citadel p-2 d-flex align-items-center <?php echo ($lang == $code) ? 'bg-primary text-black' : ''; ?>" href="?lang=<?php echo $code; ?>">
                                    <span class="me-2"><?php echo $info['flag']; ?></span>
                                    <span style="font-size: 0.6rem;"><?php echo $info['name']; ?></span>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <?php if ($is_logged_in): ?>
                    <!-- LOGGED IN HUD -->
                    <div class="d-flex align-items-center w-100 justify-content-between justify-content-lg-end">
                        
                        <!-- NOTIFICATION SENTINEL BELL -->
                        <a href="/us3rz/notifications.php" class="sentinel-bell me-4" title="Intelligence Feed">
                            <i class="fas fa-bell"></i>
                            <?php if ($has_notifications): ?>
                                <span class="notification-glow"></span>
                            <?php endif; ?>
                        </a>

                        <!-- USER ALIAS DROPDOWN -->
                        <div class="dropdown">
                            <button class="btn user-alias-btn dropdown-toggle px-4 hud-btn" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user-astronaut me-2"></i><?php echo htmlspecialchars($citizen_alias); ?>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-citadel animate__animated animate__fadeIn">
                                <li><a class="dropdown-item dropdown-item-citadel" href="/us3rz/dashboard.php"><i class="fas fa-tachometer-alt me-2"></i><?php echo __t('nav', 'dashboard'); ?></a></li>
                                <li><a class="dropdown-item dropdown-item-citadel" href="/us3rz/nexus.php"><i class="fas fa-users me-2"></i><?php echo __t('nav', 'nexus'); ?></a></li>
                                <li><a class="dropdown-item dropdown-item-citadel" href="/us3rz/comms.php"><i class="fas fa-comments me-2"></i><?php echo __t('nav', 'comms'); ?></a></li>
                                <li><a class="dropdown-item dropdown-item-citadel" href="/us3rz/edit-profile.php"><i class="fas fa-user-edit me-2"></i><?php echo __t('nav', 'edit'); ?></a></li>
                                <li><hr class="dropdown-divider border-secondary mx-2"></li>
                                <li><a class="dropdown-item dropdown-item-citadel text-danger" href="/logout.php"><i class="fas fa-power-off me-2"></i><?php echo __t('nav', 'logout'); ?></a></li>
                            </ul>
                        </div>
                    </div>
                <?php else: ?>
                    <!-- LOGGED OUT ACTIONS -->
                    <div class="d-flex w-100 gap-2">
                        <a href="/login.php" class="btn btn-outline-primary btn-sm px-4 hud-btn flex-grow-1">
                            <?php echo __t('common', 'btn_login'); ?>
                        </a>
                        <a href="/register.php" class="btn btn-primary btn-sm px-4 hud-btn flex-grow-1 text-black">
                            <?php echo __t('common', 'btn_register'); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>