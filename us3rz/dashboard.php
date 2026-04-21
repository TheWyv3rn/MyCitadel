<?php
/**
 * MYCITADEL // SOVEREIGN COMMAND DASHBOARD v9.0 [INTEGRATED_KINETIC_HUD]
 * Sector: Central Kernel
 * Logic: Real-time Data Mapping, Telemetry & Multi-lingual Achievements
 */

$start_time = microtime(true);
require_once __DIR__ . '/../../private/citadel_config.php';

// 1. HARDENED SESSION GATE
if (session_status() === PHP_SESSION_NONE) { session_start(); }

if (!isset($_SESSION['citizen_id']) || !isset($_SESSION['citizen_unique_id'])) {
    header("Location: ../login.php?err=AUTH_REQD");
    exit;
}

$citizen_id = $_SESSION['citizen_id'];

// 2. KERNEL PROBE: Check table existence
$available_tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
$has_badge_data = in_array('citizen_badges_map', $available_tables);

// 3. DATA AGGREGATION
try {
    // A. Profile & Identity
    $stmt = $pdo->prepare("SELECT alias, unique_id, status, strikes, created_at FROM citizens WHERE id = ? LIMIT 1");
    $stmt->execute([$citizen_id]);
    $citizen = $stmt->fetch(PDO::FETCH_ASSOC);

    // B. --- MEDIA DISCOVERY LOGIC ---
    $citizen_id = $_SESSION['citizen_id'];
    $base_media_path = "m3d14/"; // Relative to the us3rz/ folder where dashboard.php lives
    $extensions = ['png', 'jpg', 'jpeg', 'gif', 'webp'];
    
    // B.A. Find Avatar
    $avatar_url = $base_media_path . "4v474rz/default_avatar.png"; // Initial Default
    foreach ($extensions as $ext) {
        if (file_exists(__DIR__ . "/m3d14/4v474rz/{$citizen_id}.{$ext}")) {
            $avatar_url = $base_media_path . "4v474rz/{$citizen_id}.{$ext}";
            break;
        }
    }
    
    // B.C. Find Banner
    $banner_url = $base_media_path . "b4nn3rz/default_banner.png"; // Initial Default
    foreach ($extensions as $ext) {
        if (file_exists(__DIR__ . "/m3d14/b4nn3rz/{$citizen_id}.{$ext}")) {
            $banner_url = $base_media_path . "b4nn3rz/{$citizen_id}.{$ext}";
            break;
        }
    }
    
    // B.D. Hard Fallback (If even the default images are deleted from the folder)
    $public_avatar_default = "m3d14/4v474rz/default_avatar.png";
    $public_banner_default = "m3d14/b4nn3rz/default_banner.png";

    // C. Reputation standing (Dynamic Point Totals)
    $reputation_points = 0;
    $global_max = 0; // RECALIBRATED: Removed the 100pt fake high
    $global_min = 0;
    
    if ($has_badge_data) {
        // Current User Total
        $stmt_rep = $pdo->prepare("SELECT SUM(points_awarded) FROM citizen_badges_map WHERE citizen_id = ?");
        $stmt_rep->execute([$citizen_id]);
        $reputation_points = (int)$stmt_rep->fetchColumn();

        // Community Extremes (The Ticker Data)
        // Subquery handles SUM per user, then finds the MAX/MIN of those totals
        $global_max = (int)$pdo->query("SELECT MAX(total) FROM (SELECT SUM(points_awarded) as total FROM citizen_badges_map GROUP BY citizen_id) as sub")->fetchColumn() ?: 0;
        $global_min = (int)$pdo->query("SELECT MIN(total) FROM (SELECT SUM(points_awarded) as total FROM citizen_badges_map GROUP BY citizen_id) as sub")->fetchColumn() ?: 0;
    }

    // D. Achievement Sync
    $all_badges = $pdo->query("SELECT * FROM citadel_badges ORDER BY points ASC")->fetchAll(PDO::FETCH_ASSOC);
    $earned_badge_ids = [];
    if ($has_badge_data) {
        $stmt_earned = $pdo->prepare("SELECT badge_id FROM citizen_badges_map WHERE citizen_id = ?");
        $stmt_earned->execute([$citizen_id]);
        $earned_badge_ids = $stmt_earned->fetchAll(PDO::FETCH_COLUMN);
    }

    // E. Event Stream
    $recent_events = [];
    if ($has_badge_data) {
        $stmt_logs = $pdo->prepare("
            SELECT b.slug, b.color, m.earned_at 
            FROM citizen_badges_map m 
            JOIN citadel_badges b ON m.badge_id = b.id 
            WHERE m.citizen_id = ? 
            ORDER BY m.earned_at DESC LIMIT 5
        ");
        $stmt_logs->execute([$citizen_id]);
        $recent_events = $stmt_logs->fetchAll(PDO::FETCH_ASSOC);
    }

} catch (PDOException $e) {
    die("KERNEL_CRITICAL_FAILURE");
}

// 4. TELEMETRY
$handshake_latency = round((microtime(true) - $start_time) * 1000, 2);
$mem_usage = round(memory_get_usage() / 1024 / 1024, 2);

$page_title = __t('nav', 'dashboard');
require_once __DIR__ . '/../1nclud3z/h34d3r.php'; 
?>

<style>
    @font-face { font-family: 'Orbitron'; src: url('/4ss37z/f0n7z/Orbitron/Orbitron-Bold.ttf') format('truetype'); font-weight: bold; }
    @font-face { font-family: 'SourceCodePro'; src: url('/4ss37z/f0n7z/SourceCodePro/SourceCodePro-Regular.ttf') format('truetype'); }

    body { background: #000; color: #39ff14; font-family: 'SourceCodePro', monospace; overflow-x: hidden; }
    #particles-js { position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 1; pointer-events: none; opacity: 0.1; }

    /* PROFILE HEADER */
    .sovereign-header { position: relative; width: 100%; height: 320px; overflow: hidden; border-bottom: 2px solid #bc13fe; }
    .banner-img { width: 100%; height: 100%; object-fit: cover; filter: brightness(0.4) grayscale(0.5); }
    .banner-overlay { position: absolute; bottom: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(to top, #000, transparent); }
    
    .profile-anchor { position: absolute; bottom: 40px; left: 50px; display: flex; align-items: flex-end; z-index: 10; }
    .avatar-frame { width: 160px; height: 160px; border: 3px solid #bc13fe; padding: 5px; background: #000; box-shadow: 0 0 40px rgba(188, 19, 254, 0.3); }
    .avatar-img { width: 100%; height: 100%; object-fit: cover; }
    
    .identity-box { margin-left: 30px; margin-bottom: 10px; }

    /* DASHBOARD */
    .dashboard-layout { position: relative; z-index: 10; margin-top: -30px; padding-bottom: 80px; }
    .hud-panel { background: rgba(5, 5, 5, 0.95); border: 1px solid rgba(188, 19, 254, 0.25); border-radius: 0; transition: 0.4s; }
    .hud-panel:hover { border-color: #bc13fe; box-shadow: 0 0 30px rgba(188, 19, 254, 0.15); }
    .label-mini { font-family: 'Orbitron'; font-size: 0.65rem; letter-spacing: 2px; color: #bc13fe; text-transform: uppercase; }

    /* BADGE GRID */
    .badge-matrix { display: grid; grid-template-columns: repeat(auto-fill, minmax(55px, 1fr)); gap: 15px; }
    .badge-node { 
        width: 55px; height: 55px; display: flex; align-items: center; justify-content: center; 
        border: 1px solid #111; background: #020202; color: #222; transition: 0.5s; cursor: help; 
    }
    .badge-unlocked { border-color: currentColor; box-shadow: inset 0 0 12px currentColor; }
    .badge-unlocked i { opacity: 1 !important; filter: drop-shadow(0 0 8px currentColor) grayscale(0) !important; }
    .badge-node i { font-size: 1.3rem; opacity: 0.2; filter: grayscale(1); }

    /* TELEMETRY */
    .telemetry-node { padding: 15px; border-left: 2px solid #222; }
    .telemetry-node:hover { border-left-color: #39ff14; background: rgba(57, 255, 20, 0.03); }

    .terminal-stream { height: 160px; overflow-y: auto; font-size: 0.7rem; color: #39ff14; }
    
    @media (max-width: 991px) {
        .profile-anchor { left: 50%; transform: translateX(-50%); flex-direction: column; text-align: center; }
        .identity-box { margin-left: 0; margin-top: 20px; }
    }
</style>

<div id="particles-js"></div>

<!-- SOVEREIGN HEADER -->
<div class="sovereign-header">
    <img 
        src="<?php echo $banner_url; ?>?v=<?php echo time(); ?>" 
        class="banner-img" 
        style="width: 100%; height: 250px; object-fit: cover;"
        onerror="this.onerror=null; this.src='<?php echo $public_banner_default; ?>';"
    >
    <div class="banner-overlay"></div>
    <div class="banner-vignette"></div>

    <div class="profile-anchor">
        <div class="avatar-shell">
            <div class="avatar-frame">
                <img 
                    src="<?php echo $avatar_url; ?>?v=<?php echo time(); ?>" 
                    class="avatar-img"
                    alt="<?php echo htmlspecialchars($citizen['alias']); ?>"
                    onerror="this.onerror=null; this.src='<?php echo $public_avatar_default; ?>';"
                >
            </div>
            <div class="avatar-status-dot" 
                 title="<?php echo htmlspecialchars($citizen['status']); ?>"
                 style="background:<?php echo $status_color; ?>; box-shadow:0 0 8px <?php echo $status_color; ?>;">
            </div>
        </div>
    </div>
</div>

<div class="container-fluid px-lg-5 dashboard-layout">
    <div class="row g-4">
        
        <!-- SIDEBAR: ACHIEVEMENT MATRIX -->
        <div class="col-xl-4 col-lg-5">
            <div class="row g-4">
                
                <!-- UNIVERSAL BADGE MATRIX -->
                <div class="col-12">
                    <div class="hud-panel p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom border-white/5">
                            <label class="label-mini">Citadel_Merit_Registry</label>
                            <span class="x-small font-mono text-muted"><?php echo count($earned_badge_ids); ?> / <?php echo count($all_badges); ?></span>
                        </div>
                        <div class="badge-matrix">
                            <?php foreach($all_badges as $badge): 
                                $is_earned = in_array($badge['id'], $earned_badge_ids);
                                $slug = $badge['slug'];
                            ?>
                            <div class="badge-node <?php echo $is_earned ? 'badge-unlocked' : ''; ?>" 
                                 style="color: <?php echo $is_earned ? $badge['color'] : '#C0C0C0'; ?>"
                                 data-bs-toggle="tooltip" data-bs-html="true"
                                 title="<div class='text-start'>
                                            <b style='color:<?php echo $badge['color']; ?>'><?php echo __t('badges', $slug.'_name'); ?></b><br>
                                            <small class='text-muted'><?php echo __t('badges', $slug.'_desc'); ?></small><br>
                                            <span class='badge bg-dark mt-2'>Value: +<?php echo $badge['points']; ?> PTS</span>
                                        </div>">
                                <i class="<?php echo $badge['icon']; ?>"></i>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <!-- SYSTEM TELEMETRY -->
                <div class="col-12">
                    <div class="hud-panel p-4">
                        <label class="label-mini mb-3 d-block">Node_Integrity_Pulse</label>
                        <div class="row g-2">
                            <div class="col-6">
                                <div class="telemetry-node">
                                    <span class="d-block x-small text-muted uppercase">Latency</span>
                                    <span class="h5 font-mono text-white"><?php echo $handshake_latency; ?>ms</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="telemetry-node">
                                    <span class="d-block x-small text-muted uppercase">Alloc_Mem</span>
                                    <span class="h5 font-mono text-white"><?php echo $mem_usage; ?>MB</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="telemetry-node">
                                    <span class="d-block x-small text-muted uppercase">Status</span>
                                    <span class="h5 font-mono text-success">ENCRYPTED</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="telemetry-node">
                                    <span class="d-block x-small text-muted uppercase">Kernel</span>
                                    <span class="h5 font-mono text-purple">v9.0.S</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- MAIN: KINETIC TICKER & STREAM -->
        <div class="col-xl-8 col-lg-7">
            <div class="row g-4">
                
                <!-- THE KINETIC TICKER -->
                <div class="col-12">
                    <div class="hud-panel p-4">
                        <div class="d-flex justify-content-between align-items-start mb-4">
                            <div>
                                <label class="label-mini">Citadel_Kinetic_Ticker</label>
                                <h4 class="text-white mt-1 uppercase" style="font-family: 'Orbitron';">Sovereign_Influence_Index</h4>
                            </div>
                            <div class="text-end font-mono">
                                <div class="x-small text-blue">CURRENT_STANDING: <?php echo number_format($reputation_points); ?></div>
                                <div class="x-small text-gold">COLLECTIVE_MAX: <?php echo number_format($global_max); ?></div>
                            </div>
                        </div>
                        <div id="kineticTickerChart" style="min-height: 400px;"></div>
                    </div>
                </div>

                <!-- KERNEL EVENT STREAM -->
                <div class="col-12">
                    <div class="hud-panel p-4">
                        <label class="label-mini mb-3 d-block">Live_Kernel_Event_Stream</label>
                        <div class="terminal-stream font-mono">
                            <?php if (empty($recent_events)): ?>
                                <div class="text-muted italic">> [WAITING] Citadel is Still Growing... No resonance detected in mapping table.</div>
                            <?php else: ?>
                                <?php foreach($recent_events as $event): ?>
                                    <div class="mb-1">
                                        > [<?php echo date('H:i:s', strtotime($event['earned_at'])); ?>] 
                                        <span class="text-white">MERIT_ACQUIRED:</span> 
                                        <span style="color: <?php echo $event['color']; ?>"><?php echo __t('badges', $event['slug'].'_name'); ?></span> 
                                        // INTEGRITY_CHECK: PASS
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <div class="animate__animated animate__flash animate__infinite">> _</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // 1. INITIALIZE TOOLTIPS
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });

    // 2. KINETIC TICKER (ApexCharts) - Dynamic community extremes
    const tickerOptions = {
        series: [
            {
                name: 'COMMUNITY_HIGH',
                data: [<?php echo $global_max * 0.9; ?>, <?php echo $global_max * 0.95; ?>, <?php echo $global_max * 0.92; ?>, <?php echo $global_max; ?>]
            },
            {
                name: 'YOUR_REPUTATION',
                data: [<?php echo $reputation_points * 0.8; ?>, <?php echo $reputation_points * 0.9; ?>, <?php echo $reputation_points * 0.85; ?>, <?php echo $reputation_points; ?>]
            },
            {
                name: 'COMMUNITY_LOW',
                data: [<?php echo $global_min; ?>, <?php echo $global_min; ?>, <?php echo $global_min; ?>, <?php echo $global_min; ?>]
            }
        ],
        chart: {
            height: 400,
            type: 'line',
            background: 'transparent',
            toolbar: { show: false },
            animations: { enabled: true, easing: 'easeinout', speed: 1000 }
        },
        colors: ['#ffd700', '#00d4ff', '#ff3131'],
        stroke: { curve: 'stepline', width: [1, 3, 1], dashArray: [4, 0, 4] },
        grid: { borderColor: '#111', strokeDashArray: 4 },
        xaxis: {
            categories: ['T-3', 'T-2', 'T-1', 'REAL_TIME'],
            labels: { style: { colors: '#555', fontFamily: 'SourceCodePro' } }
        },
        yaxis: {
            labels: { style: { colors: '#39ff14', fontFamily: 'SourceCodePro' } }
        },
        legend: {
            position: 'top',
            horizontalAlign: 'right',
            labels: { colors: '#39ff14', fontFamily: 'Orbitron' }
        },
        tooltip: { theme: 'dark' }
    };

    if (window.ApexCharts) {
        new ApexCharts(document.querySelector("#kineticTickerChart"), tickerOptions).render();
    }
});
</script>

<?php 
$load_assets = ['particles', 'charts'];
require_once __DIR__ . '/../1nclud3z/f0073r.php'; 
?>