<?php
/**
 * PROJECT: MY CITADEL
 * MODULE: DOSSIER VIEWER (PEEK PROTOCOL)
 * VERSION: 2.0.0
 * DESCRIPTION: Securely decrypts and displays citizen data for connected nodes.
 * FIX: Resolved Badge-Loop Fatal Error and implemented 100% field coverage.
 */

declare(strict_types=1);

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/auth/gatekeeper.php'; 
require_once __DIR__ . '/../includes/header.php';

$db = citadel_db();
$my_id = (int)$_SESSION['citizen_id'];
$target_id = (int)($_GET['id'] ?? 0);

/**
 * 1. SECURITY FIREWALL
 * Prevent self-viewing (redirect to dashboard) and ensure target exists.
 */
if ($target_id === $my_id) {
    echo "<script>window.location.href='dashboard.php';</script>";
    exit;
}

if ($target_id <= 0) {
    die("<div class='container py-5 text-center'><h1 class='stencil-text text-danger'>[CRITICAL_ERROR]: INVALID_TARGET_PROTOCOL</h1></div>");
}

// 2. TRUST HANDSHAKE CHECK
$sql = "
    SELECT status 
    FROM connections 
    WHERE ((user_id_1 = ? AND user_id_2 = ?) OR (user_id_1 = ? AND user_id_2 = ?))
    AND status = 'accepted'
    LIMIT 1
";
$stmt = $db->prepare($sql);
$stmt->execute([$my_id, $target_id, $target_id, $my_id]);
$connection = $stmt->fetch();

// 3. FETCH TARGET RAW DATA
$stmt = $db->prepare("SELECT * FROM citizens WHERE id = ? LIMIT 1");
$stmt->execute([$target_id]);
$target = $stmt->fetch();

if (!$target) {
    echo "<div class='container py-5 text-center'><h1 class='stencil-text text-danger'>404: IDENTITY_NOT_FOUND</h1></div>";
    require_once __DIR__ . '/../includes/footer.php';
    exit;
}

/**
 * 4. DECRYPTION ENGINE
 * Fixed logic to ensure it doesn't return Base64 if decryption fails.
 */
$target_key = hash('sha256', 'Mustang_Sprint_2024_' . $target['id'], true);

function reveal_intel($data, $key) {
    if (empty($data) || !$key) return '---';
    try {
        $decoded = base64_decode((string)$data);
        if (!$decoded || strlen($decoded) < 32) return htmlspecialchars((string)$data); 
        $nonce = substr($decoded, 0, 24);
        $ciphertext = substr($decoded, 24);
        $p = sodium_crypto_secretbox_open($ciphertext, $nonce, $key);
        return ($p === false) ? '<i class="fas fa-lock opacity-50"></i>' : htmlspecialchars((string)$p);
    } catch (Exception $e) { return '[[CORRUPTED]]'; }
}

// 5. BADGE RETRIEVAL
$stmt = $db->prepare("
    SELECT b.*, cb.awarded_at 
    FROM badges b 
    JOIN citizen_badges cb ON b.id = cb.badge_db_id 
    WHERE cb.citizen_id = ?
");
$stmt->execute([$target_id]);
$badges = $stmt->fetchAll();

// Pathing Safeguard
$avatar = (!empty($target['avatar_path']) && strpos($target['avatar_path'], 'default.png') === false) 
          ? SITE_URL . '/' . ltrim($target['avatar_path'], '/') 
          : SITE_URL . '/citizen/media/avatars/default_avatar.png';

$banner = (!empty($target['banner_path']) && strpos($target['banner_path'], 'default.png') === false) 
          ? SITE_URL . '/' . ltrim($target['banner_path'], '/') 
          : SITE_URL . '/citizen/media/banners/default_banner.png';

global $citadel_strings; // Needed for the safe badge lookup
?>

<style>
    .dossier-hero { height: 320px; background: url('<?php echo $banner; ?>') center/cover; position: relative; border-bottom: 3px solid var(--neon-blue); margin-bottom: 80px; }
    .dossier-avatar-anchor { position: absolute; bottom: -65px; left: 50%; transform: translateX(-50%); }
    .hex-avatar-outer { width: 140px; height: 155px; background: var(--neon-blue); clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%); display: flex; align-items: center; justify-content: center; filter: drop-shadow(0 0 15px var(--neon-blue)); }
    .hex-avatar-inner { width: 92%; height: 92%; background: var(--deep-void); clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%); overflow: hidden; }
    .hex-avatar-inner img { width: 100%; height: 100%; object-fit: cover; }

    .data-section-card { background: var(--void-surface); border: 1px solid var(--void-border); border-radius: 20px; padding: 30px; height: 100%; backdrop-filter: var(--glass-blur); }
    .data-label { font-family: var(--font-mono); font-size: 0.65rem; color: var(--text-secondary); text-transform: uppercase; margin-bottom: 5px; letter-spacing: 1px; }
    .data-value { font-family: 'Orbitron', sans-serif; color: #fff; font-size: 0.95rem; margin-bottom: 15px; }
    
    .restricted-overlay { filter: blur(10px); pointer-events: none; opacity: 0.4; user-select: none; }
    .lock-notice { position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 100; text-align: center; background: rgba(0,0,0,0.9); padding: 40px; border: 2px solid var(--glitch-red); color: var(--glitch-red); width: 80%; border-radius: 20px; }
    
    .social-link-icon { width: 45px; height: 45px; background: rgba(0, 242, 255, 0.1); border: 1px solid rgba(0, 242, 255, 0.2); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: var(--neon-blue); transition: 0.3s; }
</style>

<div class="dossier-hero animate__animated animate__fadeIn">
    <div class="dossier-avatar-anchor">
        <div class="hex-avatar-outer">
            <div class="hex-avatar-inner"><img src="<?php echo $avatar; ?>"></div>
        </div>
    </div>
</div>

<div class="container pb-5">
    <!-- IDENTITY HEADER -->
    <div class="text-center mb-5">
        <h1 class="stencil-text text-white display-4"><?php echo htmlspecialchars($target['alias']); ?></h1>
        <div class="font-mono text-neon-blue">REP_STANDING: <?php echo number_format((int)$target['reputation']); ?></div>
    </div>

    <div class="position-relative">
        <?php if (!$connection): ?>
            <!-- THE WALL -->
            <div class="lock-notice shadow-lg animate__animated animate__zoomIn">
                <i class="fas fa-user-lock fa-4x mb-4"></i>
                <h2 class="orbitron mb-2">ACCESS_RESTRICTED</h2>
                <p class="mb-4">Establish a mutual trust handshake to decrypt this citizen's neural fragments.</p>
                <button class="btn btn-cyber px-5" onclick="initiateUplink(<?php echo $target['id']; ?>, 'establish', this)">ESTABLISH UPLINK</button>
            </div>
        <?php endif; ?>

        <div class="row g-4 <?php echo !$connection ? 'restricted-overlay' : ''; ?>">
            
            <!-- 1. VITAL SIGNS -->
            <div class="col-lg-4">
                <div class="data-section-card border-neon-blue">
                    <h5 class="stencil-text text-neon-blue mb-4 small"><i class="fas fa-id-card me-2"></i> BIOMETRIC_INTEL</h5>
                    <div class="data-label">Legal Name</div>
                    <div class="data-value"><?php echo reveal_intel($target['full_name'], $target_key); ?></div>
                    <div class="data-label">Origin / Residence</div>
                    <div class="data-value"><?php echo reveal_intel($target['city'], $target_key); ?>, <?php echo reveal_intel($target['state'], $target_key); ?></div>
                    <div class="data-label">Current Status</div>
                    <div class="data-value text-alien-green"><?php echo strtoupper((string)$target['relationship_status']); ?></div>
                </div>
            </div>

            <!-- 2. NARRATIVE -->
            <div class="col-lg-8">
                <div class="data-section-card">
                    <h5 class="stencil-text text-neon-blue mb-4 small"><i class="fas fa-brain me-2"></i> NEURAL_NARRATIVE</h5>
                    <p class="lead text-white mb-4">"<?php echo reveal_intel($target['short_bio'], $target_key); ?>"</p>
                    <div class="text-secondary small" style="line-height: 1.8; white-space: pre-wrap;">
                        <?php echo reveal_intel($target['bio'], $target_key); ?>
                    </div>
                </div>
            </div>

            <!-- 3. SOCIAL GRID -->
            <div class="col-12">
                <div class="data-section-card">
                    <h5 class="stencil-text text-neon-blue mb-4 small"><i class="fas fa-network-wired me-2"></i> UPLINK_CHANNELS</h5>
                    <div class="row">
                        <?php 
                            $socs = [
                                'gh_handle'=>'GitHub','h1_handle'=>'HackerOne','bc_handle'=>'BugCrowd',
                                'it_handle'=>'Intigriti','x_handle'=>'X-System','fb_handle'=>'Facebook',
                                'yt_handle'=>'YouTube','twitch_handle'=>'Twitch','TikTok'=>'TikTok'
                            ];
                            foreach($socs as $key => $label):
                                $val = reveal_intel($target[$key], $target_key);
                                if($val !== '---' && !empty($val) && strpos($val, 'fa-lock') === false):
                        ?>
                            <div class="col-md-3 mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="social-link-icon me-2"><i class="fas fa-link"></i></div>
                                    <div>
                                        <div class="data-label"><?php echo $label; ?></div>
                                        <div class="data-value" style="font-size: 0.8rem;"><?php echo $val; ?></div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- 4. CAREER & ACADEMIC -->
            <div class="col-md-6">
                <div class="data-section-card border-space-purple">
                    <h5 class="stencil-text text-space-purple mb-4 small"><i class="fas fa-briefcase me-2"></i> CAREER_OPERATIONS</h5>
                    <div class="data-value mb-1"><?php echo reveal_intel($target['job_title'], $target_key); ?></div>
                    <div class="text-alien-green font-mono x-small mb-3">@ <?php echo reveal_intel($target['job_company'], $target_key); ?></div>
                    <p class="text-muted x-small"><?php echo reveal_intel($target['job_description'], $target_key); ?></p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="data-section-card border-space-purple">
                    <h5 class="stencil-text text-space-purple mb-4 small"><i class="fas fa-graduation-cap me-2"></i> ACADEMIC_DEVELOPMENT</h5>
                    <div class="data-value small"><?php echo reveal_intel($target['college_1'], $target_key); ?></div>
                    <div class="data-label mb-3"><?php echo reveal_intel($target['diploma_1'], $target_key); ?></div>
                    <div class="data-label">Verified Certs:</div>
                    <div class="text-white x-small font-mono">
                        <?php echo reveal_intel($target['cert_1'], $target_key); ?>, <?php echo reveal_intel($target['cert_2'], $target_key); ?>
                    </div>
                </div>
            </div>

            <!-- 5. BADGE VAULT (FIXED CRASH LOGIC) -->
            <div class="col-12">
                <div class="data-section-card">
                    <h5 class="stencil-text text-white mb-4 small">EARNED_ACHIEVEMENTS</h5>
                    <div class="d-flex flex-wrap gap-3">
                        <?php foreach($badges as $b): 
                            $b_id = $b['badge_id'];
                            // SAFE LOOKUP: Check if array exists before accessing it
                            $badge_info = $citadel_strings['badges'][$b_id] ?? null;
                            $b_name = is_array($badge_info) ? ($badge_info['name'] ?? $b_id) : $b_id;
                        ?>
                            <div class="text-center" data-bs-toggle="tooltip" title="<strong><?php echo htmlspecialchars($b_name); ?></strong>">
                                <i class="<?php echo $b['badge_icon']; ?> fa-2x" style="color: <?php echo $b['badge_color']; ?>; filter: drop-shadow(0 0 5px <?php echo $b['badge_color']; ?>);"></i>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function initiateUplink(targetId, action, btn) {
    btn.disabled = true;
    fetch('<?php echo SITE_URL; ?>/includes/api/connection_handler.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ target_id: targetId, action: action })
    }).then(res => res.json()).then(data => {
        if(data.success) {
            Toastify({ text: "UPLINK_TRANSMITTED", style: { background: "#00f2ff", color: "#000" } }).showToast();
            setTimeout(() => location.reload(), 1500);
        } else {
            alert("UPLINK_ERROR: " + data.error);
            btn.disabled = false;
        }
    });
}
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>