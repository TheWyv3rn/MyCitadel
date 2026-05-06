<?php
/**
 * PROJECT: MY CITADEL
 * MODULE: SOVEREIGN DASHBOARD (INTELLIGENCE CORE)
 * VERSION: 2.1.1
 * DESCRIPTION: Heavy-duty stat driven interface with full dossier integration.
 * FIX: Resolved TypeError in badge translation by accessing global strings directly.
 */

declare(strict_types=1);

// 1. Core Handshake
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/auth/gatekeeper.php'; // Ensures initial session check
require_once __DIR__ . '/../includes/header.php';

$db = citadel_db();
$my_id = (int)$_SESSION['citizen_id'];

/**
 * 2. DEEP DATA FETCH
 * We re-fetch the full citizen record to ensure all 70+ new columns are available.
 * (The Gatekeeper only fetches a partial record for speed).
 */
$stmt_me = $db->prepare("SELECT * FROM citizens WHERE id = ? LIMIT 1");
$stmt_me->execute([$my_id]);
$me = $stmt_me->fetch();

if (!$me) {
    // Session exists but record is missing? Emergency disconnect.
    header("Location: ../logout.php");
    exit;
}

/**
 * 3. NETWORK ANALYTICS
 * Fetching collective stats for "Global Standing" calculations.
 */
$global_stats = $db->query("SELECT AVG(reputation) as avg_rep, AVG(influence) as avg_inf, COUNT(id) as total_citizens FROM citizens")->fetch();
$avg_rep = (float)($global_stats['avg_rep'] ?? 0);
$avg_inf = (float)($global_stats['avg_inf'] ?? 0);
$total_pop = (int)($global_stats['total_citizens'] ?? 1);

// User Badges (Joined with the master registry)
$stmt_badges = $db->prepare("
    SELECT b.*, cb.awarded_at 
    FROM badges b 
    LEFT JOIN citizen_badges cb ON b.id = cb.badge_db_id AND cb.citizen_id = ?
    ORDER BY b.badge_category, b.id ASC
");
$stmt_badges->execute([$my_id]);
$all_badges = $stmt_badges->fetchAll();

/**
 * 4. MEDIA & ASSET RESOLUTION
 */
// Define absolute fallbacks
$default_avatar = SITE_URL . '/citizen/media/avatars/default_avatar.png';
$default_banner = SITE_URL . '/citizen/media/banners/default_banner.png';

// Avatar Resolution
// We check if the path exists AND if it's not the old "default.png" string
if (!empty($me['avatar_path']) && strpos($me['avatar_path'], 'default.png') === false) {
    $avatar = SITE_URL . '/' . ltrim($me['avatar_path'], '/');
} else {
    $avatar = $default_avatar;
}

// Banner Resolution
if (!empty($me['banner_path']) && strpos($me['banner_path'], 'default.png') === false) {
    $banner = SITE_URL . '/' . ltrim($me['banner_path'], '/');
} else {
    $banner = $default_banner;
}
$is_premium = (bool)($me['is_premium'] ?? false);

// Rank Calculation Logic
$rep = (int)$me['reputation'];
if ($rep >= 5000) $rank_title = "OVERSEER";
elseif ($rep >= 1000) $rank_title = "VETERAN";
elseif ($rep >= 100) $rank_title = "CITIZEN";
else $rank_title = "NEWBORN";

// Access global strings for nested badge data
global $citadel_strings;
?>
<!-- [PARTICLES BACKGROUND CONTAINER] -->
<div id="particles-js" style="position: fixed; width: 100%; height: 100%; top: 0; left: 0; z-index: -1; pointer-events: none;"></div>

<!-- [DASHBOARD STYLES] -->
<style>
    :root {
        --premium-gold: #ffcc00;
        --premium-glow: rgba(255, 204, 0, 0.4);
    }
    .profile-hero {
        height: 350px;
        background: linear-gradient(to bottom, rgba(0,0,0,0) 0%, rgba(5,5,5,1) 100%), url('<?php echo $banner; ?>') center/cover no-repeat;
        position: relative;
        border-bottom: 1px solid rgba(0, 242, 255, 0.2);
    }
    .premium-hero {
        border-bottom: 2px solid var(--premium-gold);
        box-shadow: inset 0 0 50px rgba(255, 204, 0, 0.1);
    }
    .avatar-wrapper {
        position: absolute;
        bottom: -50px;
        left: 50px;
        z-index: 10;
        text-align: center;
    }
    .avatar-frame {
        width: 160px;
        height: 160px;
        border-radius: 20px; /* Modern squircle */
        border: 4px solid var(--void-bg);
        box-shadow: 0 0 30px rgba(0,0,0,0.8);
        object-fit: cover;
        background: var(--void-surface);
        transition: transform 0.3s ease;
    }
    .avatar-frame:hover { transform: scale(1.05) rotate(2deg); }
    .premium-avatar { border-color: var(--premium-gold) !important; box-shadow: 0 0 25px var(--premium-glow) !important; }
    
    .badge-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(50px, 1fr));
        gap: 12px;
    }
    .citadel-badge {
        width: 50px;
        height: 50px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        transition: all 0.3s ease;
        background: rgba(255,255,255,0.03);
        border: 1px solid rgba(255,255,255,0.05);
    }
    .badge-unearned { filter: grayscale(1); opacity: 0.15; cursor: not-allowed; }
    .badge-earned { cursor: pointer; border-color: rgba(255,255,255,0.2); }
    .badge-earned:hover { transform: translateY(-5px); background: rgba(255,255,255,0.1); }
    
    .stat-card { background: rgba(0,0,0,0.4); backdrop-filter: blur(10px); }
    .stat-label { text-transform: uppercase; font-size: 0.7rem; letter-spacing: 2px; color: var(--text-secondary); }
    .stat-value { font-family: 'Orbitron', sans-serif; font-weight: 700; color: #fff; }
</style>

<div class="container-fluid px-0 mb-5">
    
    <!-- [HERO SECTION] -->
    <div class="profile-hero <?php echo $is_premium ? 'premium-hero' : ''; ?> animate__animated animate__fadeIn">
        <?php if ($is_premium): ?>
            <div class="position-absolute top-0 end-0 m-4">
                <div class="premium-tag animate__animated animate__pulse animate__infinite">
                    <i class="fas fa-crown"></i> <?php echo __t('dash', 'elite'); ?>
                </div>
            </div>
        <?php endif; ?>

        <div class="avatar-wrapper animate__animated animate__fadeInUp">
            <img src="<?php echo $avatar; ?>" class="avatar-frame <?php echo $is_premium ? 'premium-avatar' : ''; ?>" alt="Identity">
            <div class="mt-3">
                <span class="badge bg-dark border border-neon-blue text-neon-blue stencil-text px-3 py-2">
                    <?php echo $rank_title; ?>
                </span>
            </div>
        </div>
    </div>

    <div class="container" style="margin-top: 80px;">
        <div class="row">
            <div class="col-lg-8">
                <!-- Profile Identity Header -->
                <div class="mb-5 animate__animated animate__fadeInLeft">
                    <h1 class="display-4 text-white stencil-text mb-1"><?php echo htmlspecialchars((string)$me['alias']); ?></h1>
                    <div class="d-flex flex-wrap gap-3 mb-4 font-mono small text-secondary">
                        <span><i class="fas fa-fingerprint text-neon-blue"></i> <?php echo __t('dash', 'esit'); ?>: <?php echo str_pad((string)$me['id'], 6, '0', STR_PAD_LEFT); ?></span>
                        <span><i class="fas fa-calendar-alt"></i> <?php echo __t('dash', 'est'); ?>: <?php echo date('M Y', strtotime((string)$me['created_at'])); ?></span>
                        <?php if(!empty($me['city'])): ?>
                            <span><i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($me['city']); ?>, <?php echo htmlspecialchars($me['country'] ?? ''); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="citadel-card stat-card border-0 p-4">
                        <p class="lead text-light opacity-75 mb-0">
                            "<?php echo htmlspecialchars((string)($me['short_bio'] ?: __t('dash', 'na'))); ?>"
                        </p>
                    </div>
                </div>

                <!-- Telemetry Metrics -->
                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <div class="citadel-card border-neon-blue h-100">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="stat-label"><?php echo __t('dash', 'rep_h'); ?></span>
                                <i class="fas fa-award text-neon-blue"></i>
                            </div>
                            <div class="h2 stat-value mb-2"><?php echo number_format((int)$me['reputation']); ?></div>
                            <div class="progress mb-2" style="height: 6px; background: rgba(0,0,0,0.5);">
                                <?php 
                                    $rep_percent = ($avg_rep > 0) ? min(100, ($me['reputation'] / ($avg_rep * 2)) * 100) : 0;
                                ?>
                                <div class="progress-bar bg-neon-blue shadow-neon" style="width: <?php echo $rep_percent; ?>%"></div>
                            </div>
                            <div class="d-flex justify-content-between x-small text-muted font-mono">
                                <span><?php echo __t('dash', 'ntw_avg'); ?></span>
                                <span><?php echo round($avg_rep, 1); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="citadel-card border-alien-green h-100">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="stat-label"><?php echo __t('dash', 'inf_h'); ?></span>
                                <i class="fas fa-bolt text-alien-green"></i>
                            </div>
                            <div class="h2 stat-value mb-2"><?php echo number_format((int)$me['influence']); ?></div>
                            <div class="progress mb-2" style="height: 6px; background: rgba(0,0,0,0.5);">
                                <?php 
                                    $inf_percent = ($avg_inf > 0) ? min(100, ($me['influence'] / ($avg_inf * 2)) * 100) : 0;
                                ?>
                                <div class="progress-bar bg-alien-green shadow-alien" style="width: <?php echo $inf_percent; ?>%"></div>
                            </div>
                            <div class="d-flex justify-content-between x-small text-muted font-mono">
                                <span><?php echo __t('dash', 'ntw_avg'); ?></span>
                                <span><?php echo round($avg_inf, 1); ?></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Neural Activity Visualizer -->
                <div class="citadel-card bg-black border-dark mb-4 p-4">
                    <h5 class="stencil-text text-white mb-4"><i class="fas fa-chart-area text-space-purple mr-2"></i> <?php echo __t('dash', 'nai'); ?></h5>
                    <div id="activityChart" style="min-height: 350px;"></div>
                </div>
            </div>

            <!-- RIGHT COLUMN: BADGES & SYSTEM STATUS -->
            <div class="col-lg-4">
                <!-- Badge Vault -->
                <div class="citadel-card mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h6 class="stencil-text text-white m-0"><?php echo __t('dash', 'badge_title'); ?></h6>
                        <span class="badge bg-dark text-neon-blue border border-neon-blue"><?php 
                            $earned_count = count(array_filter($all_badges, fn($b) => $b['awarded_at'] !== null));
                            echo $earned_count; ?>/73</span>
                    </div>
                    
                    <div class="badge-grid">
                        <?php foreach($all_badges as $badge): 
                            $is_earned = $badge['awarded_at'] !== null;
                            $color = $badge['badge_color'];
                            $glow = $is_earned ? "filter: drop-shadow(0 0 5px $color);" : "";
                            $status_class = $is_earned ? "badge-earned" : "badge-unearned";
                            
                            // Manual lookup to avoid __t() TypeError with nested arrays
                            $b_id = $badge['badge_id'];
                            $b_name = $citadel_strings['badges'][$b_id]['name'] ?? $b_id;
                            $b_desc = $citadel_strings['badges'][$b_id]['desc'] ?? 'Data fragment missing.';
                        ?>
                            <div class="citadel-badge <?php echo $status_class; ?>" 
                                 style="<?php echo $glow; ?> color: <?php echo $is_earned ? $color : '#444'; ?>;"
                                 data-bs-toggle="tooltip" 
                                 data-bs-html="true"
                                 data-bs-placement="top"
                                 title="<strong><?php echo htmlspecialchars($b_name); ?></strong><br><small><?php echo htmlspecialchars($b_desc); ?></small>">
                                <i class="<?php echo $badge['badge_icon']; ?>"></i>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Connectivity Stats -->
                <div class="citadel-card border-secondary mb-4">
                    <h6 class="stencil-text text-secondary mb-3"><?php echo __t('dash', 'connection'); ?></h6>
                    <div class="font-mono small text-light">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted"><?php echo __t('dash', 'direct'); ?>:</span>
                            <span class="text-neon-blue">0</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted"><?php echo __t('dash', 'group'); ?>:</span>
                            <span class="text-neon-blue">0</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted"><?php echo __t('dash', 'comments'); ?>:</span>
                            <span class="text-alien-green">0</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .premium-tag {
        background: linear-gradient(45deg, #000, #222);
        border: 1px solid var(--premium-gold);
        color: var(--premium-gold);
        padding: 8px 15px;
        font-family: var(--font-stencil);
        font-size: 0.75rem;
        box-shadow: 0 0 15px var(--premium-glow);
        letter-spacing: 1px;
    }
    .shadow-neon { box-shadow: 0 0 10px var(--neon-blue); }
    .shadow-alien { box-shadow: 0 0 10px var(--alien-green); }
</style>
<!-- [PARTICLES INITIALIZATION] -->
<script src="../assets/vendor/particles.js-master/particles.min.js"></script>
<script>
    /* Citadel Particles Config */
    particlesJS('particles-js', {
        "particles": {
            "number": { "value": 80, "density": { "enable": true, "value_area": 800 } },
            "color": { "value": "#00f2ff" },
            "shape": { "type": "circle" },
            "opacity": { "value": 0.2, "random": false },
            "size": { "value": 3, "random": true },
            "line_linked": { "enable": true, "distance": 150, "color": "#00f2ff", "opacity": 0.1, "width": 1 },
            "move": { "enable": true, "speed": 2, "direction": "none", "random": false, "straight": false, "out_mode": "out", "bounce": false }
        },
        "interactivity": {
            "detect_on": "canvas",
            "events": { "onhover": { "enable": true, "mode": "grab" }, "onclick": { "enable": true, "mode": "push" }, "resize": true }
        },
        "retina_detect": true
    });
</script>
<!-- [CHART INITIALIZATION] -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    // Initialize Tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });

    // Neural Activity (ApexCharts)
    // Pulling Mock Data for now - we will connect this to actual interaction tables later
    const options = {
        series: [{
            name: 'Transmissions',
            data: [12, 18, 31, 25, 45, 60, 42]
        }, {
            name: 'Neural_Responses',
            data: [8, 11, 22, 19, 30, 38, 31]
        }],
        chart: {
            height: 350,
            type: 'area',
            toolbar: { show: false },
            background: 'transparent',
            foreColor: '#555'
        },
        colors: ['#00f2ff', '#7b2ff7'],
        stroke: { curve: 'smooth', width: 3 },
        fill: {
            type: 'gradient',
            gradient: {
                shadeIntensity: 1,
                opacityFrom: 0.4,
                opacityTo: 0.05,
                stops: [0, 90, 100]
            }
        },
        grid: { borderColor: 'rgba(255,255,255,0.05)', strokeDashArray: 4 },
        xaxis: {
            categories: ["MON", "TUE", "WED", "THU", "FRI", "SAT", "SUN"],
            axisBorder: { show: false },
            axisTicks: { show: false }
        },
        yaxis: { show: false },
        legend: { position: 'top', horizontalAlign: 'right', labels: { colors: '#aaa' } },
        theme: { mode: 'dark' }
    };

    if(document.querySelector("#activityChart")) {
        const chart = new ApexCharts(document.querySelector("#activityChart"), options);
        chart.render();
    }
});
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>